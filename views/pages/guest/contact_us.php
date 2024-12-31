<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Brandboost</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="../../styles/common/index.css">
    <link rel="stylesheet" href="../../styles/common/guestHeader.css">
    <link rel="stylesheet" href="../../styles/common/footer.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

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


        .upper-contact-section {
            text-align: center;
            padding: 50px 0;
        }

        .upper-contact-section h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .contact-info div {
            margin: 10px 20px;
            display: flex;
            align-items: center;
        }

        .contact-info div i {
            margin-right: 10px;
            color: #4a6cf7;
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
</head>

<body>

<!-- Upper Contact Section -->
<section class="upper-contact-section">
    <h1>
        Contact Us
    </h1>
    <div class="contact-info">
        <div>
            <i class="fas fa-map-marker-alt">
            </i>
            <span>
                    Colombo, Sri Lanka
                </span>
        </div>
        <div>
            <i class="fas fa-envelope">
            </i>
            <span>
                    brandboost@email.com
                </span>
        </div>
        <div>
            <i class="fas fa-phone">
            </i>
            <span>
                    +94-77-387-2122
                </span>
        </div>
    </div>
</section>


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