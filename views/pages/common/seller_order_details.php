<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            display: flex;
            margin: auto;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            /* background-color: #f0f0f0; */
            border-radius: 20px;
            font-size: 14px;
        }

        .main-content {
            /* margin-top: 60px; */
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }


        .main-content {
            display: flex;
            gap: 20px;
        }

        .chat-section,
        .order-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        /* Chat Section */
        .chat-section {
            flex: 1;
            max-width: 60%;
            /* Adjust as needed */
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
            max-width: 35%;
            /* Adjust as needed */
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-section .time-left,
        .order-section .order-details,
        .order-section .support-section {
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
            background: linear-gradient(135deg, #6201A9 0%, #6a11cb 100%);
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 0.9em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .order-section button:hover {
            background: linear-gradient(135deg, #4e0184 0%, #560ea3 100%);
        }

        .order-section .cancel-button {
            background-color: #d32f2f;
        }

        .order-section .cancel-button:hover {
            background-color: #b71c1c;
        }

        /* Review Popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .popup.active {
            display: block;
        }

        .popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
        }

        .popup h4 {
            margin-bottom: 10px;
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        .popup p {
            margin-bottom: 20px;
            font-size: 1em;
            color: #555;
        }

        .popup .stars {
            display: flex;
            gap: 5px;
            margin-bottom: 20px;
        }

        .popup .stars i {
            font-size: 1.5em;
            color: #ccc;
            cursor: pointer;
        }

        .popup .stars i.active {
            color: #ff9800;
        }

        .popup button {
            background-color: #00796b;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .popup button:hover {
            background-color: #004d40;
        }

        /* Cancel Order Popup */
        .cancel-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .cancel-popup.active {
            display: block;
        }

        .cancel-popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
        }

        .cancel-popup h4 {
            margin-bottom: 10px;
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        .cancel-popup p {
            margin-bottom: 20px;
            font-size: 1em;
            color: #555;
        }

        .cancel-popup textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            resize: none;
            margin-bottom: 20px;
        }

        .cancel-popup button {
            background-color: #d32f2f;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cancel-popup button:hover {
            background-color: #b71c1c;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="content">
            <div class="main-content">
                <div class="chat-section">
                    <div class="chat-header">
                        <div class="user">
                            <div class="avatar"></div>
                            <span class="username" id="username"></span>
                        </div>
                    </div>
                    <div class="chat-box" id="chatBox">
                        <div class="message received">Hello</div>
                        <div class="message received">Hi</div>

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
                        <button id="deliverNow" onclick="window.location.href='/influencerviewcontroller/orderDelivery'">Deliver Now</button>
                        <button class="cancel-button" id="cancelOrder">Request order cancellation</button>
                    </div>
                    <div class="order-details">
                        <h4>Order Details</h4>
                        <p><strong>Ordered By:</strong> <span id="orderedBy">Kaikos Cafe</span></p>
                        <p><strong>Date:</strong> <span id="orderDate">Nov 26, 2024, 8:50 AM</span></p>
                        <p><strong>Due:</strong> <span id="orderDue">Dec 3, 2024, 8:50 AM</span></p>
                    </div>
                    <div class="support-section">
                        <h4>Support</h4>
                        <a href="http://localhost:8000/InfluencerViewController/contactUs">
                            <button id="contactSupport">Contact Us</button>
                        </a>
                        <button id="reviewOrder">Review</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="popup" id="reviewPopup">
        <button class="close-btn" id="closePopup">&times;</button>
        <h4>Review Order</h4>
        <p>Please rate your experience with this order:</p>
        <div class="stars" id="stars">
            <i class="fas fa-star" data-rating="1"></i>
            <i class="fas fa-star" data-rating="2"></i>
            <i class="fas fa-star" data-rating="3"></i>
            <i class="fas fa-star" data-rating="4"></i>
            <i class="fas fa-star" data-rating="5"></i>
        </div>
        <button id="submitReview">Submit Review</button>
    </div>

    <div class="cancel-popup" id="cancelPopup">
        <button class="close-btn" id="closeCancelPopup">&times;</button>
        <h4>Cancel Order</h4>
        <p>Please provide a reason for cancellation:</p>
        <textarea id="cancelReason" placeholder="Type your reason..."></textarea>
        <button id="requestCancel">Request Cancel</button>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const username = document.getElementById('username');
    const chatBox = document.getElementById('chatBox');
    const orderedBy = document.getElementById('orderedBy');
    const orderDate = document.getElementById('orderDate');
    const orderDue = document.getElementById('orderDue');
    const countdown = document.getElementById('countdown');
    const reviewPopup = document.getElementById('reviewPopup');
    const cancelPopup = document.getElementById('cancelPopup');

    // Extract orderId from the URL
    const pathSegments = window.location.pathname.split('/');
    const orderId = pathSegments[pathSegments.length - 1]; // Get the last segment of the URL

    // Fetch order details
    async function fetchOrderDetails() {
        try {
            const response = await fetch(`/api/order/${orderId}?order_id=${orderId}&include_user=true`);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const result = await response.json();

            console.log('Order details:', result);

            // Render order details
            username.textContent = result.data.user.name;
            orderedBy.textContent = result.data.user.name;
            orderDate.textContent = new Date(result.data.order.created_at.replace(' ', 'T')).toLocaleString();

            // Calculate due date
            const createdDate = new Date(result.data.order.created_at.replace(' ', 'T'));
            const deliveryDays = result.data.promise.delivery_days;
            const dueDate = new Date(createdDate.getTime() + deliveryDays * 24 * 60 * 60 * 1000);
            orderDue.textContent = dueDate.toLocaleString();

            // Start countdown
            startCountdown(dueDate);

            // Render chat messages (if applicable)
            if (result.data.messages) {
                result.data.messages.forEach(message => {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message', message.type);
                    messageElement.textContent = message.text;
                    chatBox.appendChild(messageElement);
                });
            }

        } catch (error) {
            console.error('Error fetching order details:', error);
        }
    }

    function startCountdown(dueDate) {
        const countdownElement = document.getElementById('countdown');
        const interval = setInterval(() => {
            const now = new Date().getTime();
            const timeLeft = dueDate - now;

            if (timeLeft <= 0) {
                clearInterval(interval);
                countdownElement.innerText = 'Delivery Time Reached!';
                document.getElementById('deliverNow').disabled = false;
            } else {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                countdownElement.innerText = `${days} Days ${hours} Hours ${minutes} Minutes ${seconds} Seconds`;
            }
        }, 1000);
    }

    // Event listeners for review and cancel popups
    document.getElementById('reviewOrder').addEventListener('click', () => {
        reviewPopup.style.display = 'block';
    });

    document.getElementById('closePopup').addEventListener('click', () => {
        reviewPopup.style.display = 'none';
    });

    document.getElementById('cancelOrder').addEventListener('click', () => {
        cancelPopup.style.display = 'block';
    });

    document.getElementById('closeCancelPopup').addEventListener('click', () => {
        cancelPopup.style.display = 'none';
    });

    // Submit review
    document.getElementById('submitReview').addEventListener('click', () => {
        const stars = document.querySelectorAll('.stars .fa-star.active');
        const rating = stars.length;
        // Send rating to the server
        console.log('Rating submitted:', rating);
        reviewPopup.style.display = 'none';
    });

    // Request cancellation
    document.getElementById('requestCancel').addEventListener('click', () => {
        const cancelReason = document.getElementById('cancelReason').value;
        // Send cancellation request to the server
        console.log('Cancellation reason:', cancelReason);
        cancelPopup.style.display = 'none';
    });

    // Initialize
    fetchOrderDetails();
});
    </script>
</body>

</html>