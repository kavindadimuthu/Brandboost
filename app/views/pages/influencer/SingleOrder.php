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
            <div class="requirements-section">
                <h2>Requirements</h2>
                <div class="requirements">
                    <p>1. Provide a detailed project description.</p>
                    <p>2. Include any specific guidelines or preferences.</p>
                    <p>3. Attach any necessary files or documents.</p>
                    <div class="file-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Project_Guidelines.pdf</span>
                    </div>
                    <div class="file-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Design_Specifications.docx</span>
                    </div>
                </div>
            </div>
            <div class="delivery-section">
                <h2>Delivered Items</h2>
                <div class="delivered-items">
                    <div class="file-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Final_Report.pdf</span>
                    </div>
                    <div class="file-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Project_Designs.zip</span>
                    </div>
                    <div class="file-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Source_Code.tar.gz</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>