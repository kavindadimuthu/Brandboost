<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed - Brandboost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4169E1;
            --primary-light: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8A2BE2;
            --error-color: #DC2626;
            --error-light: #EF4444;
            --warning-color: #F59E0B;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
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
            font-size: 90px;
            background: linear-gradient(135deg, var(--error-color), var(--warning-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin-bottom: 15px;
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

        .payment-details {
            background: var(--gray-100);
            border-radius: var(--radius);
            padding: 15px;
            margin-bottom: 20px;
        }

        .payment-details h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--gray-800);
        }

        .payment-details ul {
            list-style-type: none;
            text-align: left;
            margin-bottom: 0;
        }

        .payment-details li {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .payment-details li i {
            color: var(--warning-color);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .primary-button {
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

        .secondary-button {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            border-radius: var(--radius);
            font-weight: 600;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .primary-button:hover, .secondary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Card animation */
        .card-animation {
            position: relative;
            height: 170px;
            width: 270px;
            margin: 0 auto;
        }

        .card {
            position: absolute;
            width: 200px;
            height: 120px;
            border-radius: 14px;
            background: linear-gradient(135deg, #f2f2f2, #e6e6e6);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px;
            transition: all 0.5s ease;
            top: 25px;
            left: 35px;
        }

        .card-chip {
            width: 35px;
            height: 25px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border-radius: 5px;
        }

        .card-error {
            position: absolute;
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: var(--error-color);
            top: 10px;
            right: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            z-index: 2;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
            }
            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0);
            }
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

            .nav-links {
                gap: 15px;
                padding: 8px 15px;
            }

            .nav-link span {
                display: none;
            }

            .action-buttons {
                flex-direction: column;
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
            <a href="/register" class="nav-link">
                <i class="fas fa-user-plus"></i>
                <span>Register</span>
            </a>
            <a href="/help" class="nav-link">
                <i class="fas fa-question-circle"></i>
                <span>Help</span>
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
                    <div class="card-animation">
                        <div class="card">
                            <div class="card-chip"></div>
                            <div class="card-number" style="font-size: 12px; color: #666;">**** **** **** 1234</div>
                        </div>
                        <div class="card-error">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="error-text">
                    <div class="error-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <h1 class="error-title">Payment Failed</h1>
                    <p class="error-message">Your payment could not be processed. Please check your card or try another method.</p>
                    
                    <div class="payment-details">
                        <h3>Common reasons for payment failure:</h3>
                        <ul>
                            <li><i class="fas fa-info-circle"></i> Insufficient funds</li>
                            <li><i class="fas fa-info-circle"></i> Incorrect card details</li>
                            <li><i class="fas fa-info-circle"></i> Card expired or blocked for online transactions</li>
                            <li><i class="fas fa-info-circle"></i> Payment gateway error</li>
                        </ul>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="/checkout" class="primary-button">
                            <i class="fas fa-sync-alt"></i> Retry Payment
                        </a>
                        <a href="/support" class="secondary-button">
                            <i class="fas fa-headset"></i> Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animation for the credit card
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.card');
            
            // Create a subtle movement effect
            const animate = () => {
                let time = Date.now() * 0.001;
                let translateX = Math.sin(time) * 3;
                let translateY = Math.cos(time) * 2;
                let rotate = Math.sin(time) * 1;
                
                card.style.transform = `translate(${translateX}px, ${translateY}px) rotate(${rotate}deg)`;
                requestAnimationFrame(animate);
            };
            
            animate();
            
            // Add event listeners to buttons for hover effect
            const buttons = document.querySelectorAll('.primary-button, .secondary-button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    button.style.transform = 'translateY(-3px)';
                });
                
                button.addEventListener('mouseleave', () => {
                    button.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>

</html>