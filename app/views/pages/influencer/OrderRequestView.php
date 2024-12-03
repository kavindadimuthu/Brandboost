<html>
<head>
    <title>Order Review</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin-top: 50px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        .gig-details, .order-review {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fafafa;
        }
        .gig-details h2, .order-review h2 {
            margin-bottom: 15px;
            color: #333;
            border-bottom: 2px solid #28a745;
            padding-bottom: 5px;
        }
        .gig-details p, .order-review p {
            margin: 8px 0;
            color: #555;
        }
        .order-review label {
            display: block;
            margin: 15px 0 5px;
            color: #333;
        }
        .order-review textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }
        .order-review button {
            background: linear-gradient(135deg, #6201A9 0%, #6a11cb 100%);
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s;
        }
        .order-review button:hover {
            background: linear-gradient(135deg, #4e0184 0%, #560ea3 100%);
        }
        .reject-button {
            background-color: #dc3545;
        }
        .reject-button:hover {
            background-color: #c82333;
        }
        .business-owner {
            padding-top: 100px;
            margin-bottom: 20px;
            padding: 15px;
            background: #e9ecef;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
    </style>
</head>
<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>
    <div class="container">
        <div class="business-owner">
            <h2>Business Owner Details</h2>
            <p><strong>Name:</strong>Apple Asia</p>
            <p><strong>Email:</strong> appleasia@mail.com</p>
        </div>
        <div class="gig-details">
            <h2>Gig Details</h2>
            <p><strong>Gig Name:</strong>Do Business Promotion through my 1M Youtube channel</p>
            <p><strong>Benefits:</strong>Comprehensive market analysis, financial projections, and strategic planning.</p>
            <p><strong>Time Duration:</strong> 7 days</p>
            <p><strong>Price:</strong> LKR 75,000</p>
        </div>
        <div class="order-review">
            <h2>Review Order</h2>
            <p><strong>Your Requirements:</strong></p>
            <p>Comprehensive market analysis required with emphasis on the tech industry.</p>
            <p><strong>Uploaded Documents:</strong> Business plan template.pdf, Financial data.xlsx</p>
            <p><strong>Description about the Job:</strong></p>
            <p>Looking for a detailed business plan that outlines the market strategy and financial projections.</p>

            <label for="feedback">Feedback (if rejecting):</label>
            <textarea id="feedback" name="feedback" rows="5" placeholder="Provide your feedback here..."></textarea>
            
            <a href="http://localhost:8000/influencerviewcontroller/singleorder">
                <button type="submit">Accept Order</button>
            </a>
            <a href="http://localhost:8000/influencerviewcontroller/allorders">
                <button type="submit">Reject Order</button>
            </a>
        </div>
    </div>

    <script>
        function acceptOrder() {
            alert("Order Accepted!");
            // Redirect or perform further actions for accepted order
            window.location.href = "/order/accepted"; // Example redirect
        }

        function rejectOrder() {