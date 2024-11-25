<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Brandboost</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
     <link rel="stylesheet" href="../../styles/common/footer.css">

    <style>
        /* Add your custom CSS here */
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Navigation */
        nav {
            padding: 1rem 2rem;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            margin: 0 1rem;
        }

        .auth-buttons .login {
            color: #333;
            text-decoration: none;
            margin-right: 1rem;
        }

        .auth-buttons .signup {
            background: #6366F1;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
        }

        /* Header */
        header {
            text-align: center;
            padding: 4rem 2rem;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Contact Section */
        .contact-section {
            background: #6366F1;
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
        }

        .form-container h2 {
            color: #6366F1;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: #6366F1;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .submit-btn:hover {
            background: #4F46E5;
        }

        .map-container {
            background: #f5f5f5;
            border-radius: 8px;
            overflow: hidden;
            height: 100%;
            min-height: 400px;
        }

        /* Footer */
        footer {
            background: white;
            padding: 4rem 2rem;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin: 2rem 0;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
        }

        .footer-section a {
            display: block;
            color: #666;
            text-decoration: none;
            margin-bottom: 0.5rem;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        .social-links a {
            margin-left: 1rem;
            color: #666;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }

            .footer-links {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-bottom {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
    <link rel="stylesheet" href="../../styles/common/index.css">
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <img src="logo.png" alt="Brandboost">
            </div>
            <div class="nav-links">
                <a href="#">Services</a>
                <a href="#">About us</a>
                <a href="#">Contact us</a>
                <a href="#">FAQs</a>
                <a href="#">Careers</a>
            </div>
            <div class="auth-buttons">
                <a href="#" class="login">Login</a>
                <a href="#" class="signup">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Contact Header -->
    <header>
        <h1>Contact Us</h1>
        <div class="contact-info">
            <div class="info-item">
                <i class="location-icon"></i>
                <span>Colombo, Sri Lanka</span>
            </div>
            <div class="info-item">
                <i class="email-icon"></i>
                <span>brandboost@email.com</span>
            </div>
            <div class="info-item">
                <i class="phone-icon"></i>
                <span>+94-77-387-2122</span>
            </div>
        </div>
    </header>

    <!-- Contact Form Section -->
    <section class="contact-section">
        <div class="container">
            <div class="form-container">
                <h2>Drop us a message</h2>
                <form id="contactForm" action="submit.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea id="question" name="question" placeholder="Enter question or feedback"
                            required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
            <div class="map-container" id="map">
                <!-- Map will be inserted here by JavaScript -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/../../components/common/footer.php'; ?>

    <!-- Add your custom JavaScript here -->
    <script>
        // Initialize Google Map
        function initMap() {
            // Coordinates for Colombo, Sri Lanka
            const colombo = { lat: 6.9271, lng: 79.8612 };

            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: colombo,
                styles: [
                    {
                        "featureType": "all",
                        "elementType": "geometry",
                        "stylers": [{ "color": "#f5f5f5" }]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [{ "color": "#ffffff" }]
                    }
                ]
            });

            // Add marker
            new google.maps.Marker({
                position: colombo,
                map: map,
            });
        }

        // Form validation and submission
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const question = document.getElementById('question').value;

            // Basic validation
            if (!name || !email || !question) {
                alert('Please fill in all fields');
                return;
            }

            if (!isValidEmail(email)) {
                alert('Please enter a valid email address');
                return;
            }

            // Submit form
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('question', question);

            fetch('submit.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Thank you for your message. We will get back to you soon!');
                        this.reset();
                    } else {
                        alert('There was an error sending your message. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('There was an error sending your message. Please try again.');
                });
        });

        // Email validation helper function
        function isValidEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        // Initialize map when the page loads
        window.addEventListener('load', initMap);
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <!-- <script src="script.js"></script> -->
</body>

</html>