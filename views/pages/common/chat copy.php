<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Chat Application
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f7f8fc;
        }

        .container {
            display: flex;
            height: 100vh;
        }

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

        .sidebar .message-list {
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar .message-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            cursor: pointer;
        }

        .sidebar .message-item:hover {
            background-color: #f0f0f0;
        }

        .sidebar .message-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .sidebar .message-item .message-info {
            flex-grow: 1;
        }

        .sidebar .message-item .message-info .name {
            font-weight: 500;
            color: #333;
        }

        .sidebar .message-item .message-info .text {
            color: #888;
            font-size: 14px;
        }

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

        .chat-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-header .chat-info {
            flex-grow: 1;
        }

        .chat-header .chat-info .name {
            font-weight: 600;
            color: #333;
        }

        .chat-header .chat-info .status {
            color: #888;
            font-size: 14px;
        }

        .chat-header .chat-options {
            color: #888;
            font-size: 20px;
            cursor: pointer;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f7f8fc;
        }

        .chat-messages .message {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .chat-messages .message img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-messages .message .message-content {
            max-width: 60%;
        }

        .chat-messages .message .message-content .text {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        .chat-messages .message .message-content .file {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            color: #333;
            display: flex;
            align-items: center;
        }

        .chat-messages .message .message-content .file i {
            margin-right: 10px;
        }

        .chat-messages .message .message-content .time {
            font-size: 12px;
            color: #888;
        }

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

        .profile-sidebar .name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .profile-sidebar .role {
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .profile-sidebar .email {
            color: #6c63ff;
            font-size: 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .profile-sidebar .email i {
            margin-right: 5px;
        }

        .profile-sidebar .images {
            width: 100%;
        }

        .profile-sidebar .images .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .profile-sidebar .images .header .title {
            font-weight: 600;
            color: #333;
        }

        .profile-sidebar .images .header .view-all {
            color: #6c63ff;
            font-size: 14px;
            cursor: pointer;
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
   <div class="sidebar">
    <a href="/">Brandboost</a>
    <input placeholder="Search..." type="text"/>
    <div class="all-messages">
     All messages
    </div>
    <div class="message-list">
     <div class="message-item">
      <img alt="Profile picture of Sachini Ariyarathne" height="40" src="https://storage.googleapis.com/a1aa/image/H0J8J1zKvgr8HBQPCQST3b8CHYHfszF2apkXvjs6tE2Pz1fTA.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Sachini Ariyarathne
       </div>
       <div class="text">
        You: ha ha
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of Safran Zahim" height="40" src="https://storage.googleapis.com/a1aa/image/Xdxb8fam3uTFLSFlI8ZOyDLfdSUedpqq9ib7HP6hyTJQNXfPB.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Safran Zahim
       </div>
       <div class="text">
        Ok I will
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of Isuru Naveen" height="40" src="https://storage.googleapis.com/a1aa/image/mTbe5QLO7PUMESW1iLmLATenhOgSOObeT5xFzXyvCN4HNXfPB.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Isuru Naveen
       </div>
       <div class="text">
        How can I help you
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of Hansika Kularathne" height="40" src="https://storage.googleapis.com/a1aa/image/HadVVm7SmKYlDNYUfftrfnDJAcQ1qf9fYhngNbmsDxiB2c9fE.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Hansika Kularathne
       </div>
       <div class="text">
        good morning
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of Charitha Sudewa" height="40" src="https://storage.googleapis.com/a1aa/image/ivkl4OAxuf22OKpxqsQ6gMliDj2oCMjuCwqAb1lQCJEXz1fTA.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Charitha Sudewa
       </div>
       <div class="text">
        Okay
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of Manilka Rajapaksha" height="40" src="https://storage.googleapis.com/a1aa/image/isCWq2WvlXoJGBYzvE075dzOaaiIMxW8xd0Y20PKKfNPz1fTA.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Manilka Rajapaksha
       </div>
       <div class="text">
        My packages are in the gig. you can order
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of T.M. Dilshan" height="40" src="https://storage.googleapis.com/a1aa/image/p2M4uyZHq4pONRrfnOSlRzfhF51bLfHrnCfsD9i2hKSEauefE.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        T.M. Dilshan
       </div>
       <div class="text">
        How can i help you
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of Kavinda Dewmith" height="40" src="https://storage.googleapis.com/a1aa/image/bWE8lf7WfMmXIEA5oLLzUY1c5CjxZM2pvNWT2BfbNrtrNXfPB.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Kavinda Dewmith
       </div>
       <div class="text">
        bye
       </div>
      </div>
     </div>
     <div class="message-item">
      <img alt="Profile picture of Anura Kumara" height="40" src="https://storage.googleapis.com/a1aa/image/hBgsB1SUDezJOiyinUNPv11WsSP0O7Rp89SfSdRD1kVqmrfnA.jpg" width="40"/>
      <div class="message-info">
       <div class="name">
        Anura Kumara
       </div>
       <div class="text">
        good bye
       </div>
      </div>
     </div>
    </div>
   </div>
   <div class="chat-container">
    <div class="chat-header">
     <img alt="Profile picture of Sachini Ariyarathne" height="50" src="https://storage.googleapis.com/a1aa/image/H0J8J1zKvgr8HBQPCQST3b8CHYHfszF2apkXvjs6tE2Pz1fTA.jpg" width="50"/>
     <div class="chat-info">
      <div class="name">
       Sachini Ariyarathne
      </div>
      <div class="status">
       Active now
      </div>
     </div>
     <div class="chat-options">
      <i class="fas fa-ellipsis-h">
      </i>
     </div>
    </div>
    <div class="chat-messages">
     <div class="message">
      <img alt="Profile picture of Sachini Ariyarathne" height="40" src="https://storage.googleapis.com/a1aa/image/H0J8J1zKvgr8HBQPCQST3b8CHYHfszF2apkXvjs6tE2Pz1fTA.jpg" width="40"/>
      <div class="message-content">
       <div class="text">
        Hi good morning.
       </div>
      </div>
     </div>
     <div class="message">
      <div class="message-content" style="margin-left: auto;">
       <div class="text" style="background-color: #e6e6ff;">
        good morning
       </div>
      </div>
      <img alt="Profile picture of User" height="40" src="https://storage.googleapis.com/a1aa/image/fMWfT0wQm9vFfJQgwakXmQJFMLS9QXTQ89WmgqIKNr3jNXfPB.jpg" width="40"/>
     </div>
     <div class="message">
      <img alt="Profile picture of Sachini Ariyarathne" height="40" src="https://storage.googleapis.com/a1aa/image/H0J8J1zKvgr8HBQPCQST3b8CHYHfszF2apkXvjs6tE2Pz1fTA.jpg" width="40"/>
      <div class="message-content">
       <div class="text">
        lol
       </div>
      </div>
     </div>
     <div class="message">
      <img alt="Profile picture of Sachini Ariyarathne" height="40" src="https://storage.googleapis.com/a1aa/image/H0J8J1zKvgr8HBQPCQST3b8CHYHfszF2apkXvjs6tE2Pz1fTA.jpg" width="40"/>
      <div class="message-content">
       <img alt="Image of a yellow flower in a vase" height="200" src="https://storage.googleapis.com/a1aa/image/0MuVeQGWIfo2pU94WfbAMWcev5QheZQCRCIryeq9NT6yt56fJA.jpg" width="200"/>
      </div>
     </div>
     <div class="message">
      <div class="message-content" style="margin-left: auto;">
       <div class="text" style="background-color: #e6e6ff;">
        lol
       </div>
      </div>
      <img alt="Profile picture of User" height="40" src="https://storage.googleapis.com/a1aa/image/fMWfT0wQm9vFfJQgwakXmQJFMLS9QXTQ89WmgqIKNr3jNXfPB.jpg" width="40"/>
     </div>
    </div>
    <div class="chat-input">
     <i class="fas fa-paperclip" style="font-size: 20px; color: #888; margin-right: 10px;">
     </i>
     <input placeholder="Type a message..." type="text"/>
     <button>
      Send
     </button>
    </div>
   </div>
   <div class="profile-sidebar">
    <img alt="Profile picture of Cynthia Snyder" height="100" src="https://storage.googleapis.com/a1aa/image/oTPivVMJUhpSNVfp1xdDWUcMrizFOQR39NG2A1Due32mmrfnA.jpg" width="100"/>
    <div class="name">
     Cynthia Snyder
    </div>
    <div class="role">
     Business Owner
    </div>
    <div class="email">
     <i class="fas fa-envelope">
     </i>
     cysnyder@gmail.com
    </div>
    <div class="images">
     <div class="header">
      <div class="title">
       Images
      </div>
      <div class="view-all">
       View All
      </div>
     </div>
     <div class="image-list">
      <img alt="Image of a sunset over the mountains" height="60" src="https://storage.googleapis.com/a1aa/image/nOSnNNFHm8qZLd6193Zp1KjNgkJNmrX5iW6Aqd1GenQOz1fTA.jpg" width="60"/>
      <img alt="Image of a beach with palm trees" height="60" src="https://storage.googleapis.com/a1aa/image/Bhq7EUHBPlJ5FRz7FeCVTTy1wAYJJfvpJzSvQZSX8jvlmrfnA.jpg" width="60"/>
      <img alt="Image of a city skyline at night" height="60" src="https://storage.googleapis.com/a1aa/image/Ht2e0BM3xYRte0wEBMbEbJTDLPk8hQArxAe5lbhh1slmNXfPB.jpg" width="60"/>
      <img alt="Image of a forest with tall trees" height="60" src="https://storage.googleapis.com/a1aa/image/tRFkSeF1LA2SW6RkQpN9nwcX9gpJM3fiX0oWfobu4eZzauefE.jpg" width="60"/>
     </div>
    </div>
   </div>
  </div>
 </body>
 <script>
    // Establish WebSocket connection
const socket = new WebSocket("ws://localhost:8080"); // Update with your WebSocket server URL

// Get DOM elements
const chatMessages = document.getElementById("chat-messages");
const chatInput = document.getElementById("chat-input");
const sendButton = document.getElementById("send-button");

// Event listener for incoming messages
socket.addEventListener("message", (event) => {
    const message = document.createElement("div");
    message.classList.add("message", "received");
    message.textContent = event.data;
    chatMessages.appendChild(message);
    chatMessages.scrollTop = chatMessages.scrollHeight; // Auto-scroll
});

// Function to send a message
function sendMessage() {
    const messageText = chatInput.value.trim();
    if (messageText !== "") {
        // Send message via WebSocket
        socket.send(messageText);

        // Display sent message in chat window
        const message = document.createElement("div");
        message.classList.add("message", "sent");
        message.textContent = messageText;
        chatMessages.appendChild(message);

        chatInput.value = "";
        chatMessages.scrollTop = chatMessages.scrollHeight; // Auto-scroll
    }
}

// Send message on button click
sendButton.addEventListener("click", sendMessage);

// Send message on Enter key press
chatInput.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
        sendMessage();
    }
});

 </script>
</html>
