<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/SingleOrder.css">

</head>

<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

<body>
<div class="container">
        <div class="left-section">
            <div class="chat-section">
                <h2>Chat with Buyer</h2>
                <div class="chat-box">
                    <div class="message buyer">
                        <div class="text">Hello, I have a question about the order.</div>
                    </div>
                    <div class="message seller">
                        <div class="text">Sure, what would you like to know?</div>
                    </div>
                    <div class="message buyer">
                        <div class="text">Can you provide an update on the progress?</div>
                    </div>
                    <div class="message seller">
                        <div class="text">Yes, I am currently working on the final touches.</div>
                    </div>
                    <div class="message buyer">
                        <div class="text">Great, looking forward to it!</div>
                    </div>
                </div>
                <div class="chat-input">
                    <input type="text" placeholder="Type your message here...">
                    <button><i class="fas fa-paper-plane"></i> Send</button>
                </div>
            </div>
        </div>
        <div class="right-section">
            <div class="header">
                <h1>Order Delivery</h1>
                <div class="actions">
                    <a href="http://localhost:8000/InfluencerViewController/orderdelivery">
                        <button class="deliver-btn">Deliver</button>
                    </a>
                    <a href="http://localhost:8000/InfluencerViewController/contactus">
                        <button class="contact-btn">Contact Us</button>
                    </a>
                </div>
            </div>
            <div class="order-details">
                <div class="detail">
                    <span>Remaining Time:</span>
                    <span>2 days 4 hours</span>
                </div>
                <div class="detail">
                    <span>Date Created:</span>
                    <span>2023-10-01</span>
                </div>
                <div class="detail">
                    <span>Order End Date:</span>
                    <span>2023-10-10</span>
                </div>
                <div class="detail">
                    <span>Buyer Name:</span>
                    <span>John Doe</span>
                </div>
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
            orderedBy: "Kavinda",
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