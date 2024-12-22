<html>
<head>
    <title>Order Placement Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container-inner {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* margin-top: 100px; */
            border-radius: 10px;
        }
        .gig-details, .order-form {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .gig-details h2, .order-form h2 {
            margin-bottom: 10px;
            color: #333;
        }
        .gig-details p, .order-form p {
            margin: 5px 0;
            color: #555;
        }
        .order-form label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .order-form input[type="text"], .order-form input[type="email"], .order-form textarea, .order-form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .order-form button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .order-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container-inner">
        <div class="gig-details">
            <h2>Gig Details</h2>
            <p><strong>Gig Name:</strong> Professional Business Plan Writing</p>
            <p><strong>Benefits:</strong> Comprehensive market analysis, financial projections, and strategic planning.</p>
            <p><strong>Time Duration:</strong> 7 days</p>
            <p><strong>Price:</strong> $500</p>
        </div>
        <div class="order-form">
            <h2>Place Your Order</h2>
            <form>
                <label for="requirements">Your Requirements</label>
                <textarea id="requirements" name="requirements" rows="5" required></textarea>
                
                <label for="documents">Upload Documents</label>
                <input type="file" id="documents" name="documents" multiple>
                
                <label for="description">Description about the Job</label>
                <textarea id="description" name="description" rows="5" required></textarea>
                
                <a href="/businessviewcontroller/businessSingleOrder">
                    <button type="button">Submit Order</button>
                </a>
            </form>
        </div>
    </div>
</body>
</html>