<?php
$host = '0.0.0.0'; 
$port = 8080;
$clients = [];

$server = stream_socket_server("tcp://$host:$port", $errno, $errstr);
if (!$server) {
    die("Error: $errstr ($errno)");
}
echo "WebSocket server running on ws://$host:$port\n";

while (true) {
    $read_sockets = $clients;
    $read_sockets[] = $server;

    if (stream_select($read_sockets, $write, $except, 0)) {
        if (in_array($server, $read_sockets)) {
            $client = stream_socket_accept($server);
            $clients[] = $client;
            handshake($client);
            unset($read_sockets[array_search($server, $read_sockets)]);
        }

        foreach ($read_sockets as $socket) {
            $message = fread($socket, 1024);
            if (!$message) {
                fclose($socket);
                unset($clients[array_search($socket, $clients)]);
                continue;
            }
            $decodedMessage = decode_websocket_frame($message);
            broadcast($clients, encode_websocket_frame($decodedMessage));
        }
    }
}

function handshake($client) {
    $request = fread($client, 1024);
    if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $request, $matches)) {
        $key = trim($matches[1]);
        $acceptKey = base64_encode(pack('H*', sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11")));
        $response = "HTTP/1.1 101 Switching Protocols\r\n"
                  . "Upgrade: websocket\r\n"
                  . "Connection: Upgrade\r\n"
                  . "Sec-WebSocket-Accept: $acceptKey\r\n\r\n";
        fwrite($client, $response);
    }
}

function decode_websocket_frame($frame) {
    $payload = substr($frame, 6);
    $mask = substr($frame, 2, 4);
    $decoded = '';
    for ($i = 0; $i < strlen($payload); $i++) {
        $decoded .= $payload[$i] ^ $mask[$i % 4];
    }
    return $decoded;
}

function encode_websocket_frame($message) {
    return "\x81" . chr(strlen($message)) . $message;
}

function broadcast($clients, $message) {
    foreach ($clients as $client) {
        fwrite($client, $message);
    }
}
?>
