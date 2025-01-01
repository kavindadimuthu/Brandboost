<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Brandboost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        .sign-up-button {
            background: white;
            color: #4169E1;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sign-up-button:hover {
            background: #f0f0f0;
        }

        .hero {
            background: linear-gradient(135deg, #4169E1, #8A2BE2);
            color: white;
            padding: 160px 20px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .hero img {
            width: 100%;
            height: auto;
            opacity: 0.3;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .cta-button {
            background: white;
            color: #4169E1;
            padding: 15px 35px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .contact-section {
            padding: 80px 20px;
            background: #f8f9fa;
        }

        .contact-section h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 40px;
        }

        .contact-form {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-form .form-group {
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-form textarea {
            resize: vertical;
            height: 150px;
        }

        .contact-form button {
            background: #4169E1;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .contact-form button:hover {
            background: #365bb5;
        }

        .contact-info {
            text-align: center;
            margin-top: 40px;
        }

        .contact-info p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .contact-info a {
            color: #4169E1;
            text-decoration: none;
            font-weight: bold;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .map-section {
            padding: 80px 20px;
        }

        .map-section h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 40px;
        }

        .map-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 10px;
        }

        .faq-section {
            padding: 40px 20px;
            text-align: center;
        }

        .faq-section p {
            font-size: 18px;
        }

        .faq-section a {
            color: #4169E1;
            text-decoration: none;
            font-weight: bold;
        }

        .faq-section a:hover {
            text-decoration: underline;
        }

        .social-media-section {
            padding: 40px 20px;
            text-align: center;
        }

        .social-media-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .social-media-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-media-icons a {
            color: #4169E1;
            font-size: 24px;
            transition: color 0.3s;
        }

        .social-media-icons a:hover {
            color: #365bb5;
        }

        

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>
    
    <section class="hero">
        <img alt="Illustration of communication and professionalism" height="800"
            src="https://storage.googleapis.com/a1aa/image/4fRZQGefbefdUieCdCQIgm8JYxaEsiNVjbsrWGQAFjerDNPAKA.jpg"
            width="1200" />
        <div class="container">
            <h1>We’re here to help you connect and create!</h1>
            <p>Contact us for inquiries, support, or collaboration opportunities.</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email Address" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your Message" maxlength="500" required></textarea>
                    <small id="charCount">0/500</small>
                </div>
                <button type="submit">Submit</button>
            </div>
            <div class="contact-info">
                <p>Email: <a href="mailto:support@creativehub.com">support@creativehub.com</a></p>
                <p>Phone: <a href="tel:+1234567890">+1 234 567 890</a></p>
                <p><a href="#">Live Chat</a></p>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <h2>Our Office Location</h2>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.086509374634!2d-122.419415484681!3d37.77492927975971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c5b0b0b0b%3A0x0!2zMzfCsDQ2JzI5LjgiTiAxMjLCsDI1JzA3LjkiVw!5e0!3m2!1sen!2sus!4v1633024800000!5m2!1sen!2sus"
                    allowfullscreen="" loading="lazy"></iframe>
                <p>123 CreativeHub St, San Francisco, CA 94103</p>
                <p>Hours of Operation: Mon-Fri, 9am-5pm</p>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <p>For quick answers to common questions, visit our <a href="#">FAQ page</a>.</p>
        </div>
    </section>

    <section class="social-media-section">
        <div class="container">
            <h2>Follow Us</h2>
            <div class="social-media-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </section>

    <script>
        // Smooth scroll animation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
