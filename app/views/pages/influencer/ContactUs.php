<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/influencer/ContactUs.css">
    <link rel="stylesheet" href="../../styles/common/header.css">
</head>
<body>
<?php include __DIR__ . '/../../components/common/header.php'; ?>
    <div class="container">
        <h1>Contact Us</h1>
        <form action="/submit-complaint" method="POST">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Send Complaint</button>
        </form>
        <div class="contact-info">
            <div>
                <i class="fas fa-phone-alt"></i>
                <p>+94 729 444 55</p>
            </div>
            <div>
                <i class="fas fa-envelope"></i>
                <p>brandboost@gmail.com</p>
            </div>
            <div>
                <i class="fas fa-map-marker-alt"></i>
                <p>123 Main Street, Colombo, Srilanka</p>
            </div>
        </div>
    </div>
</body>
</html>