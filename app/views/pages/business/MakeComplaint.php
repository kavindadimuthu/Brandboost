<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/common/header.css">
</head>


<style>
    
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}
.container {
    max-width: 800px;
    margin: 100px auto;
    background: #fff;
    padding: 1px 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h1 {
    text-align: center;
    color: #333;
}
form {
    display: flex;
    flex-direction: column;
}
label {
    margin: 10px 0 5px;
    font-weight: 500;
}
input, textarea {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}
button {
    padding: 10px 20px;
    background-color: #0288d1;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
.contact-info {
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
}
.contact-info div {
    text-align: center;
}
.contact-info i {
    font-size: 24px;
    color: #007BFF;
    margin-bottom: 10px;
}

</style>


<div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">
    <div class="container">
        <h1>Make complaint</h1>
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