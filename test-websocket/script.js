const ws = new WebSocket("ws://localhost:8080");

ws.onopen = () => {
    console.log("Connected to WebSocket server.");
};

ws.onmessage = (event) => {
    let chatBox = document.getElementById("chat-box");
    chatBox.innerHTML += "<p>" + event.data + "</p>";
    chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll
};

function sendMessage() {
    let message = document.getElementById("message").value;
    if (message.trim() !== "") {
        ws.send(message);
        document.getElementById("message").value = "";
    }
}

function handleKeyPress(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
}
