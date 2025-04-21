<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', 'Arial', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            color: #1f2937;
        }

        .container {
            display: flex;
            margin: 0px 300px;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            font-size: 14px;
        }

        .main-content {
            display: flex;
            gap: 24px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Chat Section */
        .chat-section {
            flex: 1;
            max-width: 60%;
            display: flex;
            flex-direction: column;
            gap: 16px;
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .chat-header {
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .chat-header .user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-header .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 18px;
        }

        .chat-header .username {
            font-size: 1.1em;
            font-weight: 600;
            color: #111827;
        }

        .chat-box {
            flex: 1;
            max-height: 300px;
            overflow-y: auto;
            padding: 16px;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 12px 16px;
            margin-bottom: 12px;
            border-radius: 14px;
            max-width: 70%;
            font-size: 0.95em;
            line-height: 1.5;
            position: relative;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .sent {
            align-self: flex-end;
            background-color: #4f46e5;
            color: #ffffff;
            margin-left: auto;
        }

        .received {
            align-self: flex-start;
            background-color: #f3f4f6;
            color: #1f2937;
        }

        .chat-input {
            display: flex;
            gap: 10px;
            margin-top: 8px;
        }

        .chat-input textarea {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            resize: none;
            font-size: 0.95em;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .chat-input textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .chat-input button {
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 0.95em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .chat-input button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        /* Order Section */
        .order-section {
            flex: 1;
            max-width: 35%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .order-section > div {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .order-section h4 {
            margin-top: 0;
            margin-bottom: 12px;
            font-size: 1.1em;
            font-weight: 600;
            color: #111827;
            padding-bottom: 8px;
            border-bottom: 1px solid #f3f4f6;
        }

        .order-section p {
            font-size: 0.95em;
            color: #4b5563;
            margin: 8px 0;
            display: flex;
            justify-content: space-between;
        }

        .order-section p strong {
            font-weight: 600;
        }

        .time-left {
            position: relative;
        }

        .time-card {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 16px;
            margin-top: 12px;
            text-align: center;
        }

        .timer-display {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin: 12px 0;
        }

        .timer-unit {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .timer-value {
            font-size: 1.5em;
            font-weight: 700;
            color: #4f46e5;
            background-color: #ffffff;
            border-radius: 6px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .timer-label {
            font-size: 0.75em;
            color: #6b7280;
            margin-top: 4px;
            text-transform: uppercase;
        }

        #countdown {
            font-size: 1em;
            font-weight: 600;
            color: #dc2626;
            margin-top: 12px;
            text-align: center;
        }

        .timer-progress {
            height: 6px;
            width: 100%;
            background-color: #e5e7eb;
            border-radius: 3px;
            margin: 16px 0;
            overflow: hidden;
        }

        .timer-bar {
            height: 100%;
            background-color: #4f46e5;
            border-radius: 3px;
            transition: width 1s linear;
        }

        .order-section button {
            margin-top: 12px;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 0.95em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            width: 100%;
        }

        .order-section button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        .cancel-button {
            background-color: #ffffff !important;
            color: #dc2626 !important;
            border: 1px solid #dc2626 !important;
        }

        .cancel-button:hover {
            background-color: #fee2e2 !important;
            color: #b91c1c !important;
        }

        /* Deliverables Section - Redesigned as Table */
        .deliverables-section {
            margin-top: 24px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .deliverables-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .deliverables-header h3 {
            font-size: 1.25em;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .deliverables-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .deliverables-table th,
        .deliverables-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .deliverables-table th {
            background-color: #f9fafb;
            font-weight: 600;
        }

        .deliverables-table tr:hover {
            background-color: #f9fafb;
            cursor: pointer;
        }

        .status-delivered {
            color: #065f46;
            background-color: #d1fae5;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.85em;
        }

        .status-revision {
            color: #92400e;
            background-color: #fef3c7;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.85em;
        }

        .delivery-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        max-width: 700px;
        width: 90%;
        z-index: 1000;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .delivery-popup.active {
        display: block;
        animation: popIn 0.3s forwards;
    }

    @keyframes popIn {
        0% { opacity: 0; transform: translate(-50%, -48%); }
        100% { opacity: 1; transform: translate(-50%, -50%); }
    }

    .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        background-color: #f9fafb;
    }

    .popup-header h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #111827;
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #6b7280;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
    }

    .close-btn:hover {
        color: #111827;
        background-color: #f3f4f6;
    }

    .popup-content {
        padding: 24px;
    }

    .popup-media {
        width: 100%;
        max-height: 100px;
        object-fit: contain;
        margin-bottom: 24px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background-color: #f9fafb;
    }

    .delivery-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-weight: 500;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 1rem;
        color: #111827;
    }

    .revision-section {
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid #e5e7eb;
    }

    .revision-section h4 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #111827;
        margin-top: 0;
        margin-bottom: 16px;
    }

    .revision-item {
        background-color: #f9fafb;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 16px;
        border-left: 3px solid #4f46e5;
    }

    .revision-item:last-child {
        margin-bottom: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 16px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-delivered {
        color: #065f46;
        background-color: #d1fae5;
    }

    .status-revision {
        color: #92400e;
        background-color: #fef3c7;
    }

    .status-pending {
        color: #1e40af;
        background-color: #dbeafe;
    }

        .backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .backdrop.active {
            display: block;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #6b7280;
        }

        .file-list {
            margin-top: 10px;
        }

        .file-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
        }

        .file-item i {
            margin-right: 10px;
            color: #4f46e5;
        }

        /* Popups */
        .popup,
        .cancel-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 100%;
            max-width: 420px;
        }

        .popup.active,
        .cancel-popup.active {
            display: block;
        }

        .popup h4,
        .cancel-popup h4 {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 16px;
            color: #111827;
        }

        .popup p,
        .cancel-popup p {
            font-size: 0.95em;
            color: #4b5563;
            margin-bottom: 20px;
        }

        .popup button,
        .cancel-popup button {
            background-color: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 18px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .popup button:hover,
        .cancel-popup button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        .popup .close-btn,
        .cancel-popup .close-btn {
            position: absolute;
            top: 12px;
            right: 16px;
            font-size: 1.2em;
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            padding: 4px;
            transition: all 0.2s;
        }

        .popup .close-btn:hover,
        .cancel-popup .close-btn:hover {
            color: #374151;
            transform: none;
        }

        .stars {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .stars i {
            font-size: 1.8em;
            color: #e5e7eb;
            cursor: pointer;
            transition: all 0.2s;
        }

        .stars i:hover {
            transform: scale(1.1);
        }

        .stars i.active {
            color: #fbbf24;
        }

        .cancel-popup textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            padding: 12px;
            border-radius: 8px;
            resize: none;
            font-size: 0.95em;
            font-family: inherit;
            margin-bottom: 20px;
            min-height: 120px;
        }

        .cancel-popup textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        /* Delivery Form */
        .delivery-form {
            padding: 24px;
            background-color: #ffffff;
            border-radius: 12px;
            margin-top: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 2px solid #4f46e5;
        }

        .delivery-form h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 1.25em;
            font-weight: 600;
            color: #111827;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #111827;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95em;
            transition: border-color 0.2s;
            font-family: inherit;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.1);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group .note {
            font-size: 0.85em;
            color: #6b7280;
            margin-top: 6px;
        }

        .screenshot-upload {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 24px 16px;
            text-align: center;
            transition: all 0.2s;
            background-color: #f9fafb;
        }

        .upload-area:hover {
            border-color: #4f46e5;
            background-color: #f5f5ff;
        }

        .upload-area i {
            font-size: 2em;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .upload-area h4 {
            margin: 0 0 8px 0;
            font-size: 1em;
            font-weight: 500;
            color: #111827;
        }

        .upload-area p {
            margin: 0;
            font-size: 0.85em;
            color: #6b7280;
        }

        .preview-images {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .preview-image {
            width: 100px;
            height: 100px;
            border-radius: 6px;
            overflow: hidden;
            position: relative;
            border: 1px solid #e5e7eb;
        }

        .preview-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-image .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.8em;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }

        .form-buttons button {
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .submit-btn {
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
        }

        .submit-btn:hover {
            background-color: #4338ca;
        }

        .cancel-btn {
            background-color: #ffffff;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .cancel-btn:hover {
            background-color: #f3f4f6;
        }

        /* Image preview modal */
        .image-preview-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 90%;
            max-height: 90%;
            overflow: auto;
        }

        .image-preview-modal.active {
            display: block;
        }

        .image-preview-modal img {
            max-width: 100%;
            border-radius: 8px;
        }

        .image-preview-modal .close-preview {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.6);
            color: #ffffff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.2em;
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
                            <div class="avatar">
                                <i class="fas fa-user"></i>
                            </div>
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
                        <div class="time-card">
                            <div class="timer-display">
                                <div class="timer-unit">
                                    <div class="timer-value" id="days">0</div>
                                    <div class="timer-label">Days</div>
                                </div>
                                <div class="timer-unit">
                                    <div class="timer-value" id="hours">0</div>
                                    <div class="timer-label">Hours</div>
                                </div>
                                <div class="timer-unit">
                                    <div class="timer-value" id="minutes">0</div>
                                    <div class="timer-label">Mins</div>
                                </div>
                                <div class="timer-unit">
                                    <div class="timer-value" id="seconds">0</div>
                                    <div class="timer-label">Secs</div>
                                </div>
                            </div>
                            <div class="timer-progress">
                                <div class="timer-bar" id="progressBar"></div>
                            </div>
                        </div>
                        <!-- <div id="countdown"></div> -->
                        <button id="deliverNow">Deliver Now</button>
                        <button class="cancel-button" id="cancelOrder">Request order cancellation</button>
                    </div>
                    <div class="order-details">
                        <h4>Order Details</h4>
                        <p><strong>Ordered By:</strong> <span id="orderedBy"></span></p>
                        <p><strong>Date:</strong> <span id="orderDate"></span></p>
                        <p><strong>Due:</strong> <span id="orderDue"></span></p>
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

            <!-- Redesigned Deliverables Section -->
            <div class="deliverables-section">
                <div class="deliverables-header">
                    <h3>Deliverables</h3>
                    <span id="deliverableCount">2 items</span>
                </div>
                <table class="deliverables-table">
                    <thead>
                        <tr>
                            <th>Delivery #</th>
                            <th>Delivery Note</th>
                            <th>Delivered Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Review Popup -->
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

    <!-- Cancel Order Popup -->
    <div class="cancel-popup" id="cancelPopup">
        <button class="close-btn" id="closeCancelPopup">&times;</button>
        <h4>Cancel Order</h4>
        <p>Please provide a reason for cancellation:</p>
        <textarea id="cancelReason" placeholder="Type your reason..."></textarea>
        <button id="requestCancel">Request Cancel</button>
    </div>

    <!-- Delivery Form Popup -->
    <div class="delivery-popup" id="deliveryPopup">
        <button class="close-btn" id="closeDeliveryPopup">&times;</button>
        <h4>Submit Delivery</h4>
        <div class="form-group">
            <label for="contentLink">Content Link</label>
            <input type="text" id="contentLink" placeholder="https://instagram.com/p/..." />
            <div class="note">Please provide the direct link to your Instagram post, YouTube video, TikTok, etc.</div>
        </div>
        <div class="form-group">
            <label for="deliveryNotes">Delivery Notes</label>
            <textarea id="deliveryNotes" placeholder="Any additional information about your delivery..."></textarea>
        </div>
        <div class="form-group">
            <label>Analytics Proof</label>
            <div class="screenshot-upload">
                <div class="upload-area" id="uploadArea">
                    <i class="fas fa-chart-bar"></i>
                    <h4>Upload Analytics Screenshots</h4>
                    <p>Upload engagement metrics, reach, impressions, etc. (JPG, PNG up to 5MB)</p>
                    <input type="file" id="fileUpload" style="display: none;" multiple accept="image/*" />
                </div>
                <div class="preview-images" id="previewContainer">
                    <!-- Preview images will appear here -->
                </div>
            </div>
        </div>
        <div class="form-buttons">
            <button class="cancel-btn" id="cancelDelivery">Cancel</button>
            <button class="submit-btn" id="submitDelivery">Submit Delivery</button>
        </div>
    </div>

    <!-- Delivery Details Popup -->
        <div class="delivery-popup" id="deliveryDetailsPopup">
            <div class="popup-header">
                <h3>Delivery Details</h3>
                <button class="close-btn" id="closeDetailsPopup">&times;</button>
            </div>
            <div class="popup-content">
                <img class="popup-media" id="popupMedia" src="" alt="Delivery Media">
                
                <div class="delivery-details">
                    <div class="detail-item">
                        <div class="detail-label">Delivery Number</div>
                        <div class="detail-value" id="popupNumber">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            <span class="status-badge" id="popupStatusBadge">
                                <span id="popupStatus">-</span>
                            </span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Delivered Time</div>
                        <div class="detail-value" id="popupTime">-</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Content Link</div>
                        <div class="detail-value" id="popupLink">-</div>
                    </div>
                </div>
                
                <div class="detail-item" style="grid-column: 1 / span 2;">
                    <div class="detail-label">Delivery Note</div>
                    <div class="detail-value" id="popupNote">-</div>
                </div>
                
                <div class="revision-section" id="revisionSection">
                    <h4>Revision Requests</h4>
                    <img class="popup-media" id="popupRevisionMedia" src="" alt="Delivery Media">
                    <div id="revisionList">
                        <div class="revision-item">
                            <div class="detail-item">
                                <div class="detail-label">Revision Number</div>
                                <div class="detail-value" id="popupRevisionNumber">-</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Requested On</div>
                                <div class="detail-value" id="popupRevisionTime">-</div>
                            </div>
                            <div class="detail-item" style="margin-top: 12px;">
                                <div class="detail-label">Revision Note</div>
                                <div class="detail-value" id="popupRevisionNote">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Image Preview Modal -->
    <div class="image-preview-modal" id="imagePreviewModal">
        <button class="close-preview" id="closeImagePreview">&times;</button>
        <img id="previewImage" src="" alt="Screenshot preview" />
    </div>

    <!-- Backdrop overlay -->
    <div class="backdrop" id="backdrop"></div>

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
            const deliveryPopup = document.getElementById('deliveryPopup');
            const deliveryDetailsPopup = document.getElementById('deliveryDetailsPopup');
            const daysEl = document.getElementById('days');
            const hoursEl = document.getElementById('hours');
            const minutesEl = document.getElementById('minutes');
            const secondsEl = document.getElementById('seconds');
            const progressBar = document.getElementById('progressBar');
            const deliverableCount = document.getElementById('deliverableCount');
            const backdrop = document.getElementById('backdrop');
            const imagePreviewModal = document.getElementById('imagePreviewModal');
            const previewImage = document.getElementById('previewImage');

            // Extract orderId from the URL
            const pathSegments = window.location.pathname.split('/');
            const orderId = pathSegments[pathSegments.length - 1]; // Get the last segment of the URL

            async function fetchdeliveryDetails() {
                try {
                    const response = await fetch(`/api/delivery/${orderId}`);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const delivery = await response.json();

                    console.log('delivery details:', delivery);
                }
                catch (error) {
                    console.error('Error fetching delivery details:', error);
                }
            }

            // Function to load delivery data and set up the table
async function loadDeliveryData() {
  try {
    const url = `/api/delivery/${orderId}`;
    console.log('Fetching delivery data from:', url);
    
    const response = await fetch(url);
    console.log('Response status:', response.status);
    
    if (!response.ok) {
      const errorText = await response.text();
      console.error('API error response:', errorText);
      throw new Error(`Network response was not ok: ${response.status} ${response.statusText}`);
    }
    
    let data = await response.json();
    console.log('Delivery data received:', data);
    
    // Handle different response formats
    let deliveries = Array.isArray(data) ? data : (data.data || []);
    
    const tbody = document.querySelector(".deliverables-table tbody");
    tbody.innerHTML = ''; // Clear existing rows
    
    if (deliveries.length === 0) {
      const tr = document.createElement("tr");
      tr.innerHTML = '<td colspan="4">No deliveries found</td>';
      tbody.appendChild(tr);
      
      // Update the deliverable count
      document.getElementById('deliverableCount').textContent = '0 items';
      return;
    }
    
    deliveries.forEach((delivery, index) => {
      const tr = document.createElement("tr");
      tr.className = "delivery-row";
      tr.dataset.delivery = JSON.stringify(delivery);
      
      tr.innerHTML = `
        <td>${delivery.delivery_id || delivery['Delivery #'] || index + 1}</td>
        <td>${delivery.delivery_note || delivery.description || delivery['Delivery Note'] || 'No note provided'}</td>
        <td>${delivery.delivered_at || delivery.deliveredTime || delivery['Delivered Time'] || 'N/A'}</td>
        <td>
          <span class="${delivery.status === 'Delivered' ? 'status-delivered' : 'status-revision'}">
            ${delivery.status || 'Pending'}
          </span>
        </td>
      `;
      
      // Add event listener for showing delivery details
      tr.addEventListener('click', function() {
        const deliveryData = JSON.parse(this.dataset.delivery);
        showDeliveryDetails(deliveryData);
        
        // Make sure to show the popup and backdrop
        document.getElementById('deliveryDetailsPopup').classList.add('active');
        document.getElementById('backdrop').classList.add('active');
      });
      
      tbody.appendChild(tr);
    });
    
    // Update the deliverable count
    document.getElementById('deliverableCount').textContent = `${deliveries.length} item${deliveries.length !== 1 ? 's' : ''}`;

  } catch (error) {
    console.error('Fetch error:', error);
    
    // Show more user-friendly error message in the table
    const tbody = document.querySelector(".deliverables-table tbody");
    if (tbody) {
      tbody.innerHTML = `<tr><td colspan="4">Error loading deliveries: ${error.message}</td></tr>`;
    }
  }
}

        // Function to display delivery details in the popup
        function showDeliveryDetails(data) {
        console.log('Showing delivery details:', data);
        
        // Populate main details with fallbacks for missing data
        document.getElementById('popupNumber').textContent = data.delivery_id || 'N/A';
        document.getElementById('popupNote').textContent = data.delivery_note || 'No notes provided';
        document.getElementById('popupTime').textContent = data.delivered_at || 'N/A';
        
        // Set status and appropriate class
        const statusElement = document.getElementById('popupStatus');
        const statusBadge = document.getElementById('popupStatusBadge');
        const status = data.status || 'Pending';
        
        statusElement.textContent = status;
        
        // Remove all existing status classes and add the appropriate one
        statusBadge.className = 'status-badge';
        if (status.toLowerCase() === 'delivered') {
            statusBadge.classList.add('status-delivered');
        } else if (status.toLowerCase().includes('revision')) {
            statusBadge.classList.add('status-revision');
        } else {
            statusBadge.classList.add('status-pending');
        }
        
        // Set content link if available
        const linkElement = document.getElementById('popupLink');
        if (data.content_link) {
            linkElement.innerHTML = `<a href="${data.content_link}" target="_blank">${data.content_link}</a>`;
        } else {
            linkElement.textContent = 'Not provided';
        }

        // Handle media display
        // const mediaElement = document.getElementById('popupMedia');
        // if (data.screenshots && data.screenshots.length > 0) {
        //     mediaElement.src = data.screenshots[0];
        //     mediaElement.style.display = 'block';
        // } else if (data.media_url) {
        //     mediaElement.src = data.media_url;
        //     mediaElement.style.display = 'block';
        // } else if (data.content_link) {
        //     // For content links, you might want to show a placeholder
        //     mediaElement.src = '/placeholder-image.jpg';
        //     mediaElement.style.display = 'block';
        // } else {
        //     mediaElement.style.display = 'none';
        // }

        

        // Handle revisions
        const revisionSection = document.getElementById('revisionSection');
        
        if (data.revisions && data.revisions.length > 0) {
            revisionSection.style.display = 'block';
            document.getElementById('popupRevisionNumber').textContent = data.revisions[0].revision_id || '1';
            document.getElementById('popupRevisionNote').textContent = data.revisions[0].revision_note || 'No notes provided';
            document.getElementById('popupRevisionTime').textContent = data.revisions[0].created_at || 'N/A';
        } else {
            // Hide revision section if no revisions exist
            revisionSection.style.display = 'none';
        }

        // Make sure the popup and backdrop are visible
        const deliveryDetailsPopup = document.getElementById('deliveryDetailsPopup');
        const backdrop = document.getElementById('backdrop');
        
        deliveryDetailsPopup.classList.add('active');
        backdrop.classList.add('active');
    }

            // Delivery row click handler
            document.querySelectorAll('.delivery-row').forEach(row => {
                row.addEventListener('click', function() {
                    const deliveryData = JSON.parse(this.dataset.deliveries);
                    showDeliveryDetails(deliveryData);
                });
            });

            function showDeliveryDetails(data) {
                // Populate main details with fallbacks for missing data
                document.getElementById('popupNumber').textContent = data.delivery_id;
                document.getElementById('popupNote').textContent = data.delivery_note|| 'No notes provided';
                document.getElementById('popupTime').textContent = data.delivered_at || 'N/A';
                document.getElementById('popupStatus').textContent = data.status || 'Pending';

                // Handle media display
                const mediaElement = document.getElementById('popupMedia');
                if (data.deliveries && data.deliveries.length > 0) {
                    mediaElement.src = "/" + data.deliveries;
                    mediaElement.style.display = 'block';
                } else if (data.screenshots && data.screenshots.length > 0) {
                    mediaElement.src = data.screenshots[0];
                    mediaElement.style.display = 'block';
                } else {
                    mediaElement.style.display = 'none';
                }

                // Handle revisions
                document.getElementById('popupRevisionNumber').textContent = data.revision_number;
                document.getElementById('popupRevisionNote').textContent = data.revision_note|| 'No notes provided';
                document.getElementById('popupRevisionTime').textContent = data.delivered_at || 'N/A';

                const revisionMediaElement = document.getElementById('popupRevisionMedia');
                if (data.revision_files && data.revision_files.length > 0) {
                    revisionMediaElement.src = "/" + data.revision_files;
                    revisionMediaElement.style.display = 'block';
                } else if (data.screenshots && data.screenshots.length > 0) {
                    revisionMediaElement.src = data.screenshots[0];
                    revisionMediaElement.style.display = 'block';
                } else {
                    revisionMediaElement.style.display = 'none';
                }

            }

            // Close delivery details popup
            document.getElementById('closeDetailsPopup').addEventListener('click', () => {
                deliveryDetailsPopup.classList.remove('active');
                backdrop.classList.remove('active');
            });

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
                    startCountdown(dueDate, createdDate);

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

            function startCountdown(dueDate, createdDate) {
                const countdownElement = document.getElementById('countdown');
                const totalDuration = dueDate - createdDate;
                
                const interval = setInterval(() => {
                    const now = new Date().getTime();
                    const timeLeft = dueDate - now;
                    
                    // Update progress bar
                    const progressPercentage = 100 - Math.min(100, Math.max(0, (timeLeft / totalDuration) * 100));
                    progressBar.style.width = `${progressPercentage}%`;

                    if (timeLeft <= 0) {
                        clearInterval(interval);
                        countdownElement.innerText = 'Delivery Time Reached!';
                        document.getElementById('deliverNow').disabled = false;
                        
                        daysEl.textContent = '0';
                        hoursEl.textContent = '0';
                        minutesEl.textContent = '0';
                        secondsEl.textContent = '0';
                    } else {
                        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                        // Update timer values
                        daysEl.textContent = days;
                        hoursEl.textContent = hours;
                        minutesEl.textContent = minutes;
                        secondsEl.textContent = seconds;
                        
                        countdownElement.innerText = `${days}d ${hours}h ${minutes}m ${seconds}s remaining`;
                    }
                }, 1000);
            }

            // Event listeners for review and cancel popups
            document.getElementById('reviewOrder').addEventListener('click', () => {
                reviewPopup.classList.add('active');
                backdrop.classList.add('active');
            });

            document.getElementById('closePopup').addEventListener('click', () => {
                reviewPopup.classList.remove('active');
                backdrop.classList.remove('active');
            });

            document.getElementById('cancelOrder').addEventListener('click', () => {
                cancelPopup.classList.add('active');
                backdrop.classList.add('active');
            });

            document.getElementById('closeCancelPopup').addEventListener('click', () => {
                cancelPopup.classList.remove('active');
                backdrop.classList.remove('active');
            });

            // Star rating functionality
            const stars = document.querySelectorAll('.stars i');
            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const rating = star.getAttribute('data-rating');
                    stars.forEach(s => {
                        if (s.getAttribute('data-rating') <= rating) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                });
            });

            // Submit review
            document.getElementById('submitReview').addEventListener('click', () => {
                const stars = document.querySelectorAll('.stars .fa-star.active');
                const rating = stars.length;
                // Send rating to the server
                console.log('Rating submitted:', rating);
                reviewPopup.classList.remove('active');
                backdrop.classList.remove('active');
            });

            // Request cancellation
            document.getElementById('requestCancel').addEventListener('click', () => {
                const cancelReason = document.getElementById('cancelReason').value;
                // Send cancellation request to the server
                console.log('Cancellation reason:', cancelReason);
                cancelPopup.classList.remove('active');
                backdrop.classList.remove('active');
            });

            // Deliver Now button
            document.getElementById('deliverNow').addEventListener('click', () => {
                deliveryPopup.classList.add('active');
                backdrop.classList.add('active');
            });

            // Close delivery popup
            document.getElementById('closeDeliveryPopup').addEventListener('click', () => {
                deliveryPopup.classList.remove('active');
                backdrop.classList.remove('active');
            });

            document.getElementById('cancelDelivery').addEventListener('click', () => {
                deliveryPopup.classList.remove('active');
                backdrop.classList.remove('active');
            });

            // File upload area
            const uploadArea = document.getElementById('uploadArea');
            const fileUpload = document.getElementById('fileUpload');
            const previewContainer = document.getElementById('previewContainer');
            
            uploadArea.addEventListener('click', () => {
                fileUpload.click();
            });

            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#4f46e5';
                uploadArea.style.backgroundColor = '#f5f5ff';
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.backgroundColor = '#f9fafb';
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.backgroundColor = '#f9fafb';
                
                if (e.dataTransfer.files.length > 0) {
                    handleFiles(e.dataTransfer.files);
                }
            });

            fileUpload.addEventListener('change', () => {
                if (fileUpload.files.length > 0) {
                    handleFiles(fileUpload.files);
                }
            });

            function handleFiles(files) {
                for (let i = 0; i < files.length; i++) {
                    if (files[i].type.startsWith('image/')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const previewDiv = document.createElement('div');
                            previewDiv.className = 'preview-image';
                            
                            previewDiv.innerHTML = `
                                <img src="${e.target.result}" alt="Screenshot preview">
                                <button class="remove-btn">&times;</button>
                            `;
                            
                            previewContainer.appendChild(previewDiv);
                            
                            // Add event listener to remove button
                            previewDiv.querySelector('.remove-btn').addEventListener('click', function() {
                                previewDiv.remove();
                            });
                        }
                        
                        reader.readAsDataURL(files[i]);
                    }
                }
            }

            // Submit delivery
            document.getElementById('submitDelivery').addEventListener('click', async () => {
                const contentLink = document.getElementById('contentLink').value;
                const deliveryNotes = document.getElementById('deliveryNotes').value;
                
                // Validate form
                if (!contentLink) {
                    alert('Please provide a content link');
                    return;
                }
                
                // Get all preview images
                const screenshots = Array.from(previewContainer.querySelectorAll('.preview-image img')).map(img => img.src);
                
                if (screenshots.length === 0) {
                    alert('Please upload at least one screenshot as proof');
                    return;
                }
                
                try {
                    // Show loading state
                    const submitBtn = document.getElementById('submitDelivery');
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Submitting...';
                    submitBtn.disabled = true;
                    
                    // Create FormData for file uploads
                    const formData = new FormData();
                    formData.append('order_id', orderId);
                    formData.append('content_link', contentLink);
                    formData.append('delivery_note', deliveryNotes);
                    
                    // Convert base64 screenshots to files and append them
                    for (let i = 0; i < screenshots.length; i++) {
                        // Skip the data URL prefix to get just the base64 data
                        const base64Data = screenshots[i].split(',')[1];
                        const blob = await fetch(screenshots[i]).then(r => r.blob());
                        formData.append('screenshots[]', blob, `screenshot_${i+1}.png`);
                    }
                    
                    // Send data to the server
                    const response = await fetch('/api/create-delivery', {
                        method: 'POST',
                        body: formData
                    });
                    
                    if (!response.ok) {
                        throw new Error(`Server responded with status: ${response.status}`);
                    }
                    
                    const result = await response.json();
                    
                    // Close popup
                    deliveryPopup.classList.remove('active');
                    backdrop.classList.remove('active');
                    
                    // Reset form
                    document.getElementById('contentLink').value = '';
                    document.getElementById('deliveryNotes').value = '';
                    previewContainer.innerHTML = '';
                    
                    // Show success message
                    alert('Delivery submitted successfully!');
                    
                    // Refresh delivery data to show the new submission
                    await loadDeliveryData();
                    
                } catch (error) {
                    console.error('Error submitting delivery:', error);
                    alert(`Failed to submit delivery. Please try again. Error: ${error.message}`);
                } finally {
                    // Reset button state
                    const submitBtn = document.getElementById('submitDelivery');
                    submitBtn.textContent = 'Submit Delivery';
                    submitBtn.disabled = false;
                }
            });

            // Send message functionality
            document.getElementById('sendMessage').addEventListener('click', () => {
                const messageInput = document.getElementById('messageInput');
                const message = messageInput.value.trim();
                
                if (message) {
                    const messageElement = document.createElement('div');
                    messageElement.classList.add('message', 'sent');
                    messageElement.textContent = message;
                    chatBox.appendChild(messageElement);
                    
                    // Clear input
                    messageInput.value = '';
                    
                    // Scroll to bottom of chat
                    chatBox.scrollTop = chatBox.scrollHeight;
                    
                    // Here you would also send the message to your backend
                }
            });

            // Initialize
            fetchOrderDetails();
            fetchdeliveryDetails();
            loadDeliveryData();

            });
        </script>
    </body>
</html>