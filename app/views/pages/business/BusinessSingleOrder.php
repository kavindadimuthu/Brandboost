<!DOCTYPE html>
< lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">
    <link rel="stylesheet" href="../../styles/business-owner/DeliveriesTable.css">

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

    /* Popup Background */
.popup {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0, 0, 0, 0.7); /* Black w/ opacity */
}

/* Popup Content */
.popup-content {
    background-color: #fff; /* White background */
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px; /* Padding inside the popup */
    border: 1px solid #888; /* Border around the popup */
    width: 80%; /* Could be more or less, depending on screen size */
    max-width: 500px; /* Maximum width */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
}

/* Close Button */
.close-button {
    color: #aaa; /* Light gray color */
    float: right; /* Float to the right */
    font-size: 28px; /* Font size */
    font-weight: bold; /* Bold font */
    cursor: pointer; /* Pointer cursor on hover */
}

.close-button:hover,
.close-button:focus {
    color: black; /* Change color on hover */
    text-decoration: none; /* No underline */
    cursor: pointer; /* Pointer cursor */
}

/* Heading */
h2 {
    margin-top: 0; /* Remove top margin */
    color: #333; /* Darker text color */
}

/* Textarea */
#revisionDescription {
    width: 100%; /* Full width */
    padding: 10px; /* Padding inside the textarea */
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 5px; /* Rounded corners */
    resize: none; /* Disable resizing */
    font-size: 16px; /* Font size */
    margin-bottom: 15px; /* Margin at the bottom */
}

/* File Input */
#revisionAttachment {
    margin-bottom: 15px; /* Margin at the bottom */
}

/* Submit Button */
#submitRevision {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    padding: 10px 15px; /* Padding */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor */
    font-size: 16px; /* Font size */
}

#submitRevision:hover {
    background-color: #45a049; /* Darker green on hover */
}

/* Responsive Design */
@media (max-width: 600px) {
    .popup-content {
        width: 90%; /* Adjust width for smaller screens */
    }
}

.star-rating {
    direction: rtl; /* Allows for right-to-left star selection */
    display: flex; /* Align stars in a row */
    justify-content: center; /* Center the stars */
    margin-bottom: 15px; /* Space below the stars */
}

.star {
    font-size: 30px; /* Size of the stars */
    color: #ccc; /* Default color */
    cursor: pointer; /* Pointer cursor on hover */
}

.star:hover,
.star:hover ~ .star {
    color: #f39c12; /* Color when hovering */
}

.star.selected {
    color: #f39c12; /* Color for selected stars */
}
    </style>

</head>

    <div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">

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
                            <h4>Time Left To Delivery</h4>
                            <div id="countdown"></div>
                            <button id="deliverNow" onclick="window.location.href='/BusinessViewController/RequestRivision'">Request Rivision</button>
                        </div>
                        <div class="order-details">
                            <h4>Order Details</h4>
                            <p><strong>Ordered By:</strong> <span id="orderedBy"></span></p>
                            <p><strong>Date:</strong> <span id="orderDate"></span></p>
                            <p><strong>Due:</strong> <span id="orderDue"></span></p>
                        </div>
                        <div class="support-section">
                            <h4>Support</h4>
                            <button id="contactSupport"
                            onclick="window.location.href='BusinessViewController/makeComplaint">Contact Us</button>
                            <button id="contactSupport"
                            <button id="reviewButton" onclick="openReviewPopup()">Review</button>
                        </div>
                        <div id="reviewPopup" class="popup" style="display:none;">
                            <div class="popup-content">
                                <span class="close-button" onclick="closeReviewPopup()">&times;</span>
                                <h2>Review</h2>
        
                                <!-- Star Rating -->
                                <div class="star-rating">
                                    <span class="star" data-value="1">&#9733;</span>
                                    <span class="star" data-value="2">&#9733;</span>
                                    <span class="star" data-value="3">&#9733;</span>
                                    <span class="star" data-value="4">&#9733;</span>
                                    <span class="star" data-value="5">&#9733;</span>
                                </div>
                                <input type="hidden" id="starRating" value="0">
        
                                <textarea id="reviewDescription" placeholder="Enter your review here..." rows="4"></textarea>
                                <button id="submitReview" onclick="submitReview()">Submit Review</button>
                            </div>
                        </div>
                    </div>
            </div>
            <?php include __DIR__ . '/../../pages/business/DeliveriesTable.php'; ?>

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
    <!-- <script src="../scripts/common/header.js"></script> -->
    
        <!-- Popup HTML -->
<div id="revisionPopup" class="popup" style="display:none;">
    <div class="popup-content">
        <span class="close-button" onclick="closePopup()">&times;</span>
        <h2>Request Revision</h2>
        <textarea id="revisionDescription" placeholder="Enter your description here..." rows="4"></textarea>
        <input type="file" id="revisionAttachment" accept="*/*">
        <button id="submitRevision" onclick="submitRevision()">Submit</button>
    </div>
</div>



<script>
    // Function to open the popup
    function openPopup() {
        document.getElementById('revisionPopup').style.display = 'flex';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('revisionPopup').style.display = 'none';
    }

    // Function to handle the submission of the revision request
    function submitRevision() {
        const description = document.getElementById('revisionDescription').value;
        const attachment = document.getElementById('revisionAttachment').files[0];

        // Here you can handle the submission logic, such as sending the data to your server
        console.log('Description:', description);
        console.log('Attachment:', attachment);

        // Close the popup after submission
        closePopup();
    }

    // Attach the openPopup function to the Request Revision button
    document.getElementById('deliverNow').onclick = openPopup;
    function openReviewPopup() {
    document.getElementById('reviewPopup').style.display = 'block';
}

// Function to close the review popup
function closeReviewPopup() {
    document.getElementById('reviewPopup').style.display = 'none';
    resetReviewForm(); // Reset the form when closing
}

// Function to submit the review
function submitReview() {
    const reviewText = document.getElementById('reviewDescription').value;
    const starRating = document.getElementById('starRating').value;

    if (reviewText.trim() === "" || starRating === "0") {
        alert("Please enter a review and select a star rating before submitting.");
        return;
    }

    // Here you can add code to send the review to your server
    console.log("Review submitted:", reviewText, "Rating:", starRating);
    
    // Close the popup after submission
    closeReviewPopup();
}

// Function to reset the review form
function resetReviewForm() {
    document.getElementById('reviewDescription').value = '';
    document.getElementById('starRating').value = '0';
    const stars = document.querySelectorAll('.star');
    stars.forEach(star => {
        star.classList.remove('selected'); // Remove selected class
    });
}

// Add event listeners to the stars
const stars = document.querySelectorAll('.star');
stars.forEach(star => {
    star.addEventListener('click', function() {
        const rating = this.getAttribute('data-value');
        document.getElementById('starRating').value = rating;

        // Remove selected class from all stars
        stars.forEach(s => s.classList.remove('selected'));

        // Add selected class to the clicked star and all previous stars
        this.classList.add('selected');
        let prevStar = this;
        while (prevStar = prevStar.previousElementSibling) {
            prevStar.classList.add('selected');
        }
    });
});
</script>



</body>
</html>