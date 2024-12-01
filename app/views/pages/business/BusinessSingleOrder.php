<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/business-owner/BusinessSingleOrder.css">

</head>
<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

    <div class="container">
        <div class="chat-section">
            <div class="chat-header">
                <div class="user">
                    <div class="avatar"></div>
                    <span class="username">Kavindya</span>
                </div>
            </div>
            <div class="chat-box" id="chatBox">
                <!-- Chat messages will be appended here -->
            </div>
            <div class="chat-input">
                <textarea id="messageInput" placeholder="Type a message..."></textarea>
                <button id="sendMessage">Send</button>
            </div>
        </div>

        <div class="order-section">
            <div class="time-left">
                <div id="countdown"></div>
                <a href="http://localhost:8000/BusinessViewController/Deliveries">
                    <button id="deliverNow">Deliveries</button>
                </a>
            </div>
            <div class="order-details">
                <h4>Order Details</h4>
                <p><strong>Ordered By:</strong> <span id="orderedBy"></span></p>
                <p><strong>Date:</strong> <span id="orderDate"></span></p>
                <p><strong>Due:</strong> <span id="orderDue"></span></p>
            </div>
            <div class="support-section">
                <h4>Support</h4>
                <a href="http://localhost:8000/InfluencerViewController/contactus">
                    <button id="contactSupport">Contact Us</button>
                 </a>
            </div>
        </div>
        
    </div>
    <script>
        // Mock data
const orderDetails = {
    orderedBy: "Kavindya",
    orderDate: "Aug 17, 2024, 8:50 AM",
    orderDue: "Aug 18, 2024, 8:50 AM",
};

const messages = [
    { sender: "Kavinda", text: "Hello" },
    { sender: "Me", text: "Hi" },
    { sender: "Kavinda", text: "How is the project progress" },
    { sender: "Me", text: "All good" },
    { sender: "Kavinda", text: "ok" },
];

// Populate order details
document.getElementById("orderedBy").innerText = orderDetails.orderedBy;
document.getElementById("orderDate").innerText = orderDetails.orderDate;
document.getElementById("orderDue").innerText = orderDetails.orderDue;

// Populate chat messages
const chatBox = document.getElementById("chatBox");
messages.forEach((msg) => {
    const messageDiv = document.createElement("div");
    messageDiv.classList.add("message", msg.sender === "Me" ? "sent" : "received");
    messageDiv.innerText = msg.text;
    chatBox.appendChild(messageDiv);
});

// Handle new messages
document.getElementById("sendMessage").addEventListener("click", () => {
    const messageInput = document.getElementById("messageInput");
    if (messageInput.value.trim() !== "") {
        const newMessage = { sender: "Me", text: messageInput.value.trim() };
        messages.push(newMessage);

        const messageDiv = document.createElement("div");
        messageDiv.classList.add("message", "sent");
        messageDiv.innerText = newMessage.text;
        chatBox.appendChild(messageDiv);

        messageInput.value = "";
        chatBox.scrollTop = chatBox.scrollHeight;
    }
});

// Countdown timer
function startCountdown() {
    const countdownElement = document.getElementById("countdown");
    const dueDate = new Date(orderDetails.orderDue).getTime();
    const interval = setInterval(() => {
        const now = Date.now();
        const timeLeft = dueDate - now;

        if (timeLeft <= 0) {
            clearInterval(interval);
            countdownElement.innerText = "Delivery Time Reached!";
            document.getElementById("deliverNow").disabled = false;
        } else {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            countdownElement.innerText = `${days} Days ${hours} Hours ${minutes} Minutes ${seconds} Seconds`;
        }
    }, 1000);
}

startCountdown();

    </script>
    

</body>
</html>