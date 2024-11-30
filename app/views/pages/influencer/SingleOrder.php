<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">

    <style>
        .main-content {
            display: flex;
            gap: 20px;
        }

    .chat-section, .order-section {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0e0e0;
    }

    /* Chat Section */
    .chat-section {
        flex: 1;
        max-width: 60%; /* Adjust as needed */
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .chat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .chat-header .user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chat-header .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #dcdcdc;
    }

    .chat-header .username {
        font-size: 1.2em;
        font-weight: bold;
        color: #333;
    }

    .chat-box {
        flex: 1;
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #e0e0e0;
        padding: 10px;
        border-radius: 5px;
        background-color: #fff;
    }

    .chat-box .message {
        padding: 8px 12px;
        margin-bottom: 8px;
        border-radius: 15px;
        max-width: 70%;
        word-wrap: break-word;
    }

    .chat-box .sent {
        align-self: flex-end;
        background-color: #e0f7fa;
        color: #00796b;
    }

    .chat-box .received {
        align-self: flex-start;
        background-color: #e8f5e9;
        color: #388e3c;
    }

    .chat-input {
        display: flex;
        gap: 10px;
    }

    .chat-input textarea {
        flex: 1;
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        resize: none;
    }

    .chat-input button {
        background-color: #00796b;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .chat-input button:hover {
        background-color: #004d40;
    }

    /* Order Section */
    .order-section {
        flex: 1;
        max-width: 35%; /* Adjust as needed */
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .order-section .time-left, .order-section .order-details, .order-section .support-section {
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .order-section h4 {
        margin-bottom: 10px;
        font-size: 1.1em;
        font-weight: bold;
        color: #333;
    }

    .order-section p {
        margin: 5px 0;
        font-size: 0.95em;
        color: #555;
    }

    .order-section .time-left #countdown {
        font-size: 1.1em;
        color: #d32f2f;
        margin-top: 10px;
        font-weight: bold;
    }

    .order-section button {
        display: block;
        margin-top: 10px;
        background-color: #0288d1;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 8px 15px;
        font-size: 0.9em;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .order-section button:hover {
        background-color: #01579b;
    }
    </style>

</head>

<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">

                    <div class="chat-section">
                        <div class="chat-header">
                            <div class="user">
                                <div class="avatar"></div>
                                <span class="username">Nethsilu</span>
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
                            <h4>Time Left To Delivery</h4>
                            <div id="countdown"></div>
                            <button id="deliverNow" onclick="window.location.href='/designerviewcontroller/orderDelivery'">Deliver
                                Now</button>
                        </div>
                        <div class="order-details">
                            <h4>Order Details</h4>
                            <p><strong>Ordered By:</strong> <span id="orderedBy"></span></p>
                            <p><strong>Date:</strong> <span id="orderDate"></span></p>
                            <p><strong>Due:</strong> <span id="orderDue"></span></p>
                        </div>
                        <div class="support-section">
                            <h4>Support</h4>
                            <button id="contactSupport">Contact Us</button>
                            <button id="contactSupport"
                                onclick="window.location.href='/designerviewcontroller/allOrders'">Back</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script>
        window.onload = function () {
            startCountdown();
        };

        // Mock data
        const orderDetails = {
            orderedBy: "Nethsilu",
            orderDate: "Nov 27, 2024, 8:50 AM",
            orderDue: "Dec 8, 2024, 8:50 AM",
        };

        const messages = [
            { sender: "Nethsilu", text: "Hello" },
            { sender: "Me", text: "Hi" },
            { sender: "Nethsilu", text: "I need to do a promotion" },
            { sender: "Me", text: "Tell me more details" },
            { sender: "Nethsilu", text: "ok" },
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

        // startCountdown();

    </script>
    <script src="../scripts/common/header.js"></script>


</body>

</html>