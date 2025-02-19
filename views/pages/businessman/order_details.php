<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Business View Controller</title>
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    
    body {
      background-color: #f3f4f6;
      color: #1f2937;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 16px;
    }
    
    .main-card {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 24px;
    }
    
    .flex-container {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }
    
    @media (min-width: 1024px) {
      .flex-container {
        flex-direction: row;
      }
    }
    
    /* Chat section */
    .chat-section {
      /* flex: 1; */
      width: 60%;
      background-color: #f9fafb;
      padding: 16px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .order-section {
      width: 40%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-color: #f9fafb;
      padding: 16px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    
    .chat-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #e5e7eb;
      padding-bottom: 8px;
      margin-bottom: 16px;
    }
    
    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }
    
    .user-name {
      font-size: 18px;
      font-weight: 600;
    }
    
    .chat-messages {
      display: flex;
      flex-direction: column;
      gap: 12px;
      overflow-y: auto;
      height: 256px;
      padding: 8px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      background-color: white;
    }
    
    .message {
      padding: 8px;
      border-radius: 8px;
      max-width: 75%;
    }
    
    .self-end {
      align-self: flex-end;
      background-color: #dbeafe;
      color: #1e40af;
    }
    
    .self-start {
      align-self: flex-start;
      background-color: #d1fae5;
      color: #065f46;
    }
    
    .chat-input {
      display: flex;
      gap: 12px;
      margin-top: 16px;
    }
    
    .message-textarea {
      flex: 1;
      padding: 8px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      resize: none;
    }
    
    /* Buttons */
    .btn {
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      border: none;
    }
    
    .btn-primary {
      background-color: #2563eb;
      color: white;
    }
    
    .btn-primary:hover {
      background-color: #1d4ed8;
    }
    
    .btn-secondary {
      background-color: #9333ea;
      color: white;
    }
    
    .btn-secondary:hover {
      background-color: #7e22ce;
    }
    
    /* Order section */
    .section-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
    }
    
    .countdown {
      color: #dc2626;
      font-weight: bold;
    }
    
    .order-detail {
      margin-bottom: 4px;
    }
    
    .detail-label {
      font-weight: bold;
    }
    
    .mb-4 {
      margin-bottom: 16px;
    }
    
    .mb-2 {
      margin-bottom: 8px;
    }
    
    .mt-2 {
      margin-top: 8px;
    }
    
    /* Deliveries section */
    .deliveries-section {
      margin-top: 24px;
    }
    
    .section-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }
    
    .section-heading {
      font-size: 24px;
      font-weight: 600;
    }
    
    table {
      width: 100%;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }
    
    thead {
      background-color: #e5e7eb;
    }
    
    th {
      padding: 12px 24px;
      text-align: left;
      color: #4b5563;
      font-size: 14px;
      text-transform: uppercase;
      font-weight: 600;
    }
    
    td {
      padding: 12px 24px;
      text-align: left;
      color: #4b5563;
      font-size: 14px;
      font-weight: 300;
      border-bottom: 1px solid #e5e7eb;
    }
    
    tr:hover {
      background-color: #f9fafb;
    }
    
    .badge {
      padding: 4px 12px;
      border-radius: 9999px;
      font-size: 12px;
    }
    
    .badge-success {
      background-color: #d1fae5;
      color: #065f46;
    }
    
    .badge-danger {
      background-color: #fee2e2;
      color: #991b1b;
    }
    
    .ml-2 {
      margin-left: 8px;
    }
    
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 16px;
    }
    
    .pagination-btn {
      background-color: #e5e7eb;
      color: #4b5563;
      padding: 4px 12px;
      border-radius: 8px;
      margin: 0 4px;
      border: none;
      cursor: pointer;
    }
    
    .pagination-btn:hover {
      background-color: #d1d5db;
    }
    
    .pagination-btn.active {
      background-color: #2563eb;
      color: white;
    }
    
    /* Popups */
    .popup {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      visibility: hidden;
      opacity: 0;
      transition: visibility 0s linear 0.25s, opacity 0.25s 0s;
    }
    
    .popup.active {
      visibility: visible;
      opacity: 1;
      transition-delay: 0s;
    }
    
    .popup-content {
      background-color: white;
      padding: 24px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 500px;
    }
    
    .close-button {
      color: #6b7280;
      font-size: 24px;
      cursor: pointer;
      float: right;
    }
    
    .popup-title {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 16px;
    }
    
    .popup-textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      margin-bottom: 16px;
      resize: none;
    }
    
    .star-rating {
      display: flex;
      justify-content: center;
      margin-bottom: 16px;
    }
    
    .star {
      font-size: 30px;
      color: #d1d5db;
      cursor: pointer;
    }
    
    .star.selected {
      color: #facc15;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="main-card">
      <div class="flex-container">
        <!-- Chat Section -->
        <div class="chat-section">
          <div class="chat-header">
            <div class="user-info">
              <img alt="User avatar" class="user-avatar" height="40" src="https://storage.googleapis.com/a1aa/image/tvVS3EK0kC7GFRT3AeucwmFew2yZr4G8rmf8W2n2PKMS2WfPB.jpg" width="40"/>
              <span class="user-name">Kavindya</span>
            </div>
          </div>
          <div class="chat-messages">
            <div class="message self-end">Hello</div>
            <div class="message self-start">Hi</div>
            <div class="message self-end">I need to do a promotion</div>
            <div class="message self-start">Tell me more details</div>
            <div class="message self-end">ok</div>
          </div>
          <div class="chat-input">
            <textarea class="message-textarea" id="messageInput" placeholder="Type a message..."></textarea>
            <button class="btn btn-primary" id="sendMessage">Send</button>
          </div>
        </div>
        
        <!-- Order Section -->
        <div class="order-section">
          <div class="mb-4">
            <h4 class="section-title">Time Left To Delivery</h4>
            <div class="countdown" id="countdown"></div>
            <button class="btn btn-secondary mt-2" id="deliverNow" onclick="openPopup()">Request Revision</button>
          </div>
          <div class="mb-4">
            <h4 class="section-title">Order Details</h4>
            <p class="order-detail">
              <span class="detail-label">Ordered By:</span>
              <span id="orderedBy">Me</span>
            </p>
            <p class="order-detail">
              <span class="detail-label">Date:</span>
              <span id="orderDate">Nov 27, 2024, 8:50 AM</span>
            </p>
            <p class="order-detail">
              <span class="detail-label">Due:</span>
              <span id="orderDue">Dec 8, 2024, 8:50 AM</span>
            </p>
          </div>
          <div>
            <h4 class="section-title">Support</h4>
            <button class="btn btn-secondary mb-2" id="contactSupport" onclick="window.location.href='/BusinessViewController/makeComplaint'">Complaint</button>
            <button class="btn btn-secondary" id="reviewButton" onclick="openReviewPopup()">Review</button>
          </div>
        </div>
      </div>
      
      <!-- Deliveries Section -->
      <div class="deliveries-section">
        <div class="section-header">
          <h2 class="section-heading">Deliveries</h2>
        </div>
        <table>
          <thead>
            <tr>
              <th>Order</th>
              <th>Influencer/Designer</th>
              <th>Revision Count</th>
              <th>File</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="ordersTableBody">
            <tr>
              <td>Promotional Video</td>
              <td>Kavindya Adhikari</td>
              <td>2</td>
              <td>
                video2.mp4
                <button class="btn btn-primary ml-2" onclick="downloadFile('video2.mp4')">Download</button>
              </td>
              <td>
                <span class="badge badge-success">Accepted</span>
              </td>
            </tr>
            <tr>
              <td>Promotional Video</td>
              <td>Kavindya Adhikari</td>
              <td>1</td>
              <td>
                video1.mp4
                <button class="btn btn-primary ml-2" onclick="downloadFile('video1.mp4')">Download</button>
              </td>
              <td>
                <span class="badge badge-danger">Rejected</span>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="pagination">
          <button class="pagination-btn">&lt;</button>
          <button class="pagination-btn active">1</button>
          <button class="pagination-btn">2</button>
          <button class="pagination-btn">3</button>
          <button class="pagination-btn">&gt;</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Popup for Revision Request -->
  <div class="popup" id="revisionPopup">
    <div class="popup-content">
      <span class="close-button" onclick="closePopup()">×</span>
      <h2 class="popup-title">Request Revision</h2>
      <textarea class="popup-textarea" id="revisionDescription" placeholder="Enter your description here..." rows="4"></textarea>
      <input accept="*/*" id="revisionAttachment" type="file" style="margin-bottom: 16px;">
      <button class="btn btn-secondary" id="submitRevision" onclick="submitRevision()">Submit</button>
    </div>
  </div>
  
  <!-- Popup for Review -->
  <div class="popup" id="reviewPopup">
    <div class="popup-content">
      <span class="close-button" onclick="closeReviewPopup()">×</span>
      <h2 class="popup-title">Review</h2>
      <div class="star-rating">
        <span class="star" data-value="1">★</span>
        <span class="star" data-value="2">★</span>
        <span class="star" data-value="3">★</span>
        <span class="star" data-value="4">★</span>
        <span class="star" data-value="5">★</span>
      </div>
      <input id="starRating" type="hidden" value="0">
      <textarea class="popup-textarea" id="reviewDescription" placeholder="Enter your review here..." rows="4"></textarea>
      <button class="btn btn-secondary" id="submitReview" onclick="submitReview()">Submit Review</button>
    </div>
  </div>
  
  <script>

    window.onload = function () {
      // startCountdown();
      setupStarRating();
    };

    const pathSegments = window.location.pathname.split('/');
    const orderId = pathSegments[pathSegments.length - 1]; // Get the last segment

    if (!orderId) {
      throw new Error('Gig ID is required in the URL');
    }

    async function fetchOrderDetails(orderId) {
      try {
        const response = await fetch(`/api/order/${orderId}?order_id=${orderId}`);
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const result = await response.json();
        const data = result.data;
        console.log(data);
        document.getElementById("orderedBy").innerText = "Me ("+ data.order.customer_id + ")"; // Assuming customer_id represents the person who ordered
        document.getElementById("orderDate").innerText = new Date(data.order.created_at).toLocaleString();
        document.getElementById("orderDue").innerText = new Date(new Date(data.order.created_at).getTime() + data.promise.delivery_days * 24 * 60 * 60 * 1000).toLocaleString();
        startCountdown(new Date(new Date(data.order.created_at).getTime() + data.promise.delivery_days * 24 * 60 * 60 * 1000));
      } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
      }
    }

    // Example usage:
    fetchOrderDetails(orderId);

    const orderDetails = {
      orderedBy: "Me",
      orderDate: "Nov 27, 2024, 8:50 AM",
      orderDue: "Dec 8, 2025, 8:50 AM",
    };

    document.getElementById("orderedBy").innerText = orderDetails.orderedBy;
    document.getElementById("orderDate").innerText = orderDetails.orderDate;
    document.getElementById("orderDue").innerText = orderDetails.orderDue;

    const chatMessages = document.querySelector(".chat-messages");
    document.getElementById("sendMessage").addEventListener("click", () => {
      const messageInput = document.getElementById("messageInput");
      if (messageInput.value.trim() !== "") {
        const messageDiv = document.createElement("div");
        messageDiv.classList.add("message", "self-end");
        messageDiv.innerText = messageInput.value.trim();
        chatMessages.appendChild(messageDiv);

        messageInput.value = "";
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }
    });

    function startCountdown(orderDue) {
      const countdownElement = document.getElementById("countdown");
      const dueDate = new Date(orderDue).getTime();
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

    function setupStarRating() {
      const stars = document.querySelectorAll('.star');
      stars.forEach(star => {
        star.addEventListener('click', function () {
          const rating = this.getAttribute('data-value');
          document.getElementById('starRating').value = rating;

          stars.forEach(s => s.classList.remove('selected'));

          this.classList.add('selected');
          let prevStar = this;
          while (prevStar = prevStar.previousElementSibling) {
            prevStar.classList.add('selected');
          }
        });
      });
    }

    function openPopup() {
      document.getElementById('revisionPopup').classList.add('active');
    }

    function closePopup() {
      document.getElementById('revisionPopup').classList.remove('active');
    }

    function submitRevision() {
      const description = document.getElementById('revisionDescription').value;
      const attachment = document.getElementById('revisionAttachment').files[0];

      console.log('Description:', description);
      console.log('Attachment:', attachment);

      closePopup();
    }

    function openReviewPopup() {
      document.getElementById('reviewPopup').classList.add('active');
    }

    function closeReviewPopup() {
      document.getElementById('reviewPopup').classList.remove('active');
      resetReviewForm();
    }

    function submitReview() {
      const reviewText = document.getElementById('reviewDescription').value;
      const starRating = document.getElementById('starRating').value;

      if (reviewText.trim() === "" || starRating === "0") {
        alert("Please enter a review and select a star rating before submitting.");
        return;
      }

      console.log("Review submitted:", reviewText, "Rating:", starRating);

      closeReviewPopup();
    }

    function resetReviewForm() {
      document.getElementById('reviewDescription').value = '';
      document.getElementById('starRating').value = '0';
      const stars = document.querySelectorAll('.star');
      stars.forEach(star => {
        star.classList.remove('selected');
      });
    }

    function downloadFile(fileName) {
      alert(`Downloading ${fileName}...`);
    }
  </script>
</body>
</html>