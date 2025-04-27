<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Suspended - Brandboost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4169E1;
            --primary-light: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8A2BE2;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
            --warning-color: #e53e3e;
            --radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            color: var(--gray-800);
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 25px;
            border-radius: 15px;
            backdrop-filter: blur(5px);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
        }

        .container {
            max-width: 800px;
            text-align: center;
        }

        .error-content {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 30px;
        }

        .error-illustration {
            flex: 1;
            max-width: 250px;
        }

        .error-illustration svg {
            width: 100%;
            height: auto;
        }

        .error-text {
            flex: 1;
            text-align: left;
        }

        .error-icon {
            font-size: 70px;
            color: var(--warning-color);
            margin-bottom: 15px;
            display: block;
        }

        .error-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--gray-800);
        }

        .error-message {
            font-size: 16px;
            color: var(--gray-600);
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .cta-button {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: var(--radius);
            font-weight: 600;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .warning-button {
            background: linear-gradient(135deg, #e53e3e, #c53030);
        }

        .secondary-button {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--gray-300);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .info-card {
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            margin-top: 30px;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--warning-color);
        }

        .info-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card ul {
            text-align: left;
            margin-top: 15px;
            margin-left: 20px;
        }

        .info-card li {
            margin-bottom: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .error-content {
                flex-direction: column;
                gap: 20px;
            }

            .error-text {
                text-align: center;
            }

            .error-icon {
                font-size: 60px;
            }

            .error-title {
                font-size: 24px;
            }

            .nav-links {
                gap: 15px;
                padding: 8px 15px;
            }

            .nav-link span {
                display: none;
            }

            .action-buttons {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 15px;
            }

            .logo span {
                display: none;
            }

            .error-illustration {
                max-width: 180px;
            }

            .nav-links {
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Navigation -->
    <header class="header">
        <a href="/" class="logo">
            <i class="fas fa-rocket"></i>
            <span>Brandboost</span>
        </a>
        <nav class="nav-links">
            <a href="/login" class="nav-link">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
            <a href="/about" class="nav-link">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a>
            <a href="/contact" class="nav-link">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="error-content">
                <div class="error-illustration">
                    <svg viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M250 470C370.457 470 468 372.457 468 252C468 131.543 370.457 34 250 34C129.543 34 32 131.543 32 252C32 372.457 129.543 470 250 470Z" fill="#F3F4F6" />
                        <path d="M250 420C342.843 420 418 344.843 418 252C418 159.157 342.843 84 250 84C157.157 84 82 159.157 82 252C82 344.843 157.157 420 250 420Z" fill="white" />
                        <path d="M163 163L317 317M317 163L163 317" stroke="#e53e3e" stroke-width="18" stroke-linecap="round" />
                        <circle cx="250" cy="250" r="120" stroke="#e53e3e" stroke-width="18"/>
                    </svg>
                </div>
                <div class="error-text">
                    <i class="fas fa-lock error-icon"></i>
                    <h1 class="error-title">Account Suspended</h1>
                    <p class="error-message">Your account has been suspended. This may be due to a violation of our terms of service or a security concern with your account.</p>
                    <div class="action-buttons">
                        <a href="/contact" class="cta-button warning-button">
                            <i class="fas fa-headset"></i> Contact Support
                        </a>
                        <a href="/" class="cta-button secondary-button">
                            <i class="fas fa-home"></i> Return Home
                        </a>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <h3><i class="fas fa-info-circle"></i> What This Means</h3>
                <p>Your account access has been temporarily restricted. Common reasons for account suspension include:</p>
                <ul>
                    <li>Violation of our community guidelines or terms of service</li>
                    <li>Multiple reports from other users</li>
                    <li>Suspicious activity detected on your account</li>
                    <li>Payment issues or billing concerns</li>
                </ul>
                <p>For assistance and to discuss reinstating your account, please contact our support team.</p>
            </div>
        </div>
    </div>

    <script>
        // Animation for the illustration
        document.addEventListener('DOMContentLoaded', function() {
            const illustration = document.querySelector('.error-illustration svg');
            
            // Gentle pulse animation
            const animate = () => {
                let time = Date.now() * 0.001;
                let scale = 1 + Math.sin(time) * 0.02;
                illustration.style.transform = `scale(${scale})`;
                requestAnimationFrame(animate);
            };
            
            animate();
        });
    </script>
</body>

</html>