<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Chat Test Page</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    #chatBox { width: 100%; height: 300px; border: 1px solid #ccc; overflow-y: scroll; padding: 10px; margin-bottom: 10px; }
    input, button { margin: 5px 0; padding: 5px; }
  </style>
</head>
<body>
  <h2>WebSocket Chat Test</h2>

  <label>Auth Token: </label>
  <input type="text" id="token" placeholder="Enter your auth token" />
  <button onclick="connect()">Connect</button><br />

  <div id="authStatus"></div>

  <div id="chatUI" style="display: none;">
    <label>Send To (User ID): </label>
    <input type="text" id="toUser" /><br />

    <label>Message: </label>
    <input type="text" id="messageInput" />
    <button onclick="sendMessage()">Send</button><br />

    <button onclick="fetchHistory()">Fetch Chat History</button>

    <div id="chatBox"></div>
  </div>

  <script>
    let socket;
    let userId;

    function log(msg) {
      const box = document.getElementById("chatBox");
      box.innerHTML += `<div>${msg}</div>`;
      box.scrollTop = box.scrollHeight;
    }

    function connect() {
      const token = document.getElementById("token").value;
      socket = new WebSocket("ws://localhost:8080"); // update to your actual WebSocket address

      socket.onopen = () => {
        log("Socket connected. Authenticating...");
        socket.send(JSON.stringify({ type: "auth", token }));
      };

      socket.onmessage = (event) => {
        const data = JSON.parse(event.data);
        console.log(data);

        switch (data.type) {
          case "auth_required":
            log("Authentication required.");
            break;
          case "auth_success":
            document.getElementById("authStatus").textContent = `Authenticated as User ID: ${data.userId}`;
            document.getElementById("chatUI").style.display = "block";
            userId = data.userId;
            break;
          case "auth_failed":
            alert("Authentication failed.");
            break;
          case "message":
            log(`📩 Message from ${data.from}: ${data.message}`);
            break;
          case "message_sent":
            log(`✅ You sent to ${data.to}: ${data.message}`);
            break;
          case "history":
            log("📜 Chat History:");
            data.messages.forEach(m => {
              log(`${m.sender_id} ➡️ ${m.receiver_id}: ${m.message} (${m.created_at})`);
            });
            break;
          case "error":
            alert("Error: " + data.message);
            break;
        }
      };

      socket.onerror = (err) => {
        console.error("WebSocket Error", err);
      };

      socket.onclose = () => {
        log("Connection closed.");
        document.getElementById("chatUI").style.display = "none";
      };
    }

    function sendMessage() {
      const to = document.getElementById("toUser").value;
      const msg = document.getElementById("messageInput").value;
      if (!to || !msg) return alert("Both fields are required");

      socket.send(JSON.stringify({
        type: "message",
        to: parseInt(to),
        message: msg
      }));
    }

    function fetchHistory() {
      const to = document.getElementById("toUser").value;
      if (!to) return alert("Enter the user ID to fetch history with.");

      socket.send(JSON.stringify({
        type: "fetch_history",
        withUserId: parseInt(to)
      }));
    }
  </script>
</body>
</html>
