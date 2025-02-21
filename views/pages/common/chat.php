<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Chat Application</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        /* Base styles */
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f7f8fc;
        }

        /* Layout */
        .container {
            display: flex;
            height: 100vh;
        }

        /* Left Sidebar */
        .sidebar {
            width: 300px;
            background-color: #fff;
            border-right: 1px solid #e6e6e6;
            display: flex;
            flex-direction: column;
        }

        .sidebar input {
            margin: 20px;
            padding: 10px;
            border: 1px solid #e6e6e6;
            border-radius: 5px;
            font-size: 16px;
        }

        .sidebar .all-messages {
            padding: 0 20px;
            font-weight: 600;
            color: #333;
        }

        /* Message List */
        .message-list {
            flex-grow: 1;
            overflow-y: auto;
        }

        .message-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            cursor: pointer;
        }

        .message-item:hover {
            background-color: #f0f0f0;
        }

        .message-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Main Chat Area */
        .chat-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-bottom: 1px solid #e6e6e6;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f7f8fc;
        }

        .message {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .message-content {
            max-width: 60%;
        }

        .message-content .text {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        /* Chat Input Area */
        .chat-input {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-top: 1px solid #e6e6e6;
        }

        .chat-input input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #e6e6e6;
            border-radius: 5px;
            font-size: 16px;
            margin-right: 10px;
        }

        .chat-input button {
            padding: 10px 20px;
            background-color: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Right Sidebar - Profile */
        .profile-sidebar {
            width: 300px;
            background-color: #fff;
            border-left: 1px solid #e6e6e6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .profile-sidebar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-sidebar .images .image-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .profile-sidebar .images .image-list img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <a href="/">Brandboost</a>
            <input type="text" placeholder="Search..."/>
            <div class="all-messages">All messages</div>
            <div class="message-list">
                <!-- Message items will be dynamically added here -->
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="chat-container">
            <div class="chat-header">
                <img src="profile-pic.jpg" alt="Current chat user" width="50" height="50"/>
                <div class="chat-info">
                    <div class="name">User Name</div>
                    <div class="status">Active now</div>
                </div>
            </div>
            
            <div class="chat-messages" id="chat-messages">
                <!-- Messages will be dynamically added here -->
            </div>

            <div class="chat-input">
                <i class="fas fa-paperclip"></i>
                <input type="text" placeholder="Type a message..." id="chat-input"/>
                <button id="send-button">Send</button>
            </div>
        </div>

        <!-- Right Sidebar - Profile -->
        <div class="profile-sidebar">
            <img src="profile-pic.jpg" alt="Profile picture"/>
            <div class="name">User Name</div>
            <div class="role">Role</div>
            <div class="email">
                <i class="fas fa-envelope"></i>
                email@example.com
            </div>
            <div class="images">
                <!-- Shared images will be displayed here -->
            </div>
        </div>
    </div>

    <script>
        // WebSocket Connection
        const socket = new WebSocket("ws://localhost:8080");
        
        // DOM Elements
        const chatMessages = document.getElementById("chat-messages");
        const chatInput = document.getElementById("chat-input");
        const sendButton = document.getElementById("send-button");

        // Handle incoming messages
        socket.addEventListener("message", (event) => {
            const message = document.createElement("div");
            message.classList.add("message", "received");
            message.textContent = event.data;
            chatMessages.appendChild(message);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });

        // Send message function
        function sendMessage() {
            const messageText = chatInput.value.trim();
            if (messageText !== "") {
                socket.send(messageText);
                
                const message = document.createElement("div");
                message.classList.add("message", "sent");
                message.textContent = messageText;
                chatMessages.appendChild(message);

                chatInput.value = "";
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        // Event Listeners
        sendButton.addEventListener("click", sendMessage);
        chatInput.addEventListener("keypress", (event) => {
            if (event.key === "Enter") {
                sendMessage();
            }
        });
    </script>
</body>
</html>