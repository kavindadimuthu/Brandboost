<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Brandboost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4169E1;
            --primary-light: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8A2BE2;
            --success-color: #10B981;
            --success-light: #34D399;
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

        .success-content {
            display: flex;
            align-items: center;
            gap: 40px;
            margin-bottom: 30px;
        }

        .success-illustration {
            flex: 1;
            max-width: 250px;
        }

        .success-text {
            flex: 1;
            text-align: left;
        }

        .success-icon {
            font-size: 90px;
            background: linear-gradient(135deg, var(--success-color), var(--primary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1;
            margin-bottom: 15px;
        }

        .success-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--gray-800);
        }

        .success-message {
            font-size: 16px;
            color: var(--gray-600);
            margin-bottom: 20px;
        }

        .order-details {
            background: var(--gray-100);
            border-radius: var(--radius);
            padding: 20px;
            margin-bottom: 20px;
        }

        .order-details h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: var(--gray-800);
        }

        .order-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            text-align: left;
        }

        .order-info-item {
            margin-bottom: 8px;
        }

        .order-info-label {
            font-weight: 500;
            color: var(--gray-600);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .order-info-value {
            font-weight: 600;
            color: var(--gray-800);
        }

        .redirect-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: var(--radius);
            padding: 12px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: var(--success-color);
        }

        .redirect-message i {
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background-color: var(--gray-200);
            border-radius: 3px;
            margin-top: 10px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--success-color));
            border-radius: 3px;
            width: 0%;
            transition: width 0.5s ease;
        }

        /* Success check animation */
        .check-animation {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto;
        }

        .check-circle {
            position: absolute;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, var(--success-light), var(--success-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 70px;
            color: white;
            top: 15px;
            left: 15px;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
            animation: scaleUp 0.5s ease-out;
        }

        @keyframes scaleUp {
            0% {
                transform: scale(0);
            }
            80% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        .check-icon {
            opacity: 0;
            transform: scale(0.5);
            animation: fadeInAndScale 0.5s 0.3s forwards;
        }

        @keyframes fadeInAndScale {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Confetti animation */
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: var(--primary-color);
            opacity: 0;
            animation: confetti-fall linear forwards;
            z-index: -1;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .success-content {
                flex-direction: column;
                gap: 20px;
            }

            .success-text {
                text-align: center;
            }

            .order-info {
                grid-template-columns: 1fr;
            }

            .nav-links {
                gap: 15px;
                padding: 8px 15px;
            }

            .nav-link span {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 15px;
            }

            .logo span {
                display: none;
            }

            .success-illustration {
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
            <a href="/dashboard" class="nav-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="/orders" class="nav-link">
                <i class="fas fa-shopping-bag"></i>
                <span>Orders</span>
            </a>
            <a href="/help" class="nav-link">
                <i class="fas fa-question-circle"></i>
                <span>Help</span>
            </a>
            <a href="/account" class="nav-link">
                <i class="fas fa-user-circle"></i>
                <span>Account</span>
            </a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="success-content">
                <div class="success-illustration">
                    <div class="check-animation">
                        <div class="check-circle">
                            <i class="fas fa-check check-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="success-text">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h1 class="success-title">Payment Successful!</h1>
                    <p class="success-message">Your payment has been processed successfully. Thank you for your order!</p>
                    
                    <div class="order-details">
                        <h3>Order Information</h3>
                        <div class="order-info">
                            <div class="order-info-item">
                                <div class="order-info-label">Order ID</div>
                                <div class="order-info-value">#ORD-<?php echo rand(10000, 99999); ?></div>
                            </div>
                            <div class="order-info-item">
                                <div class="order-info-label">Date</div>
                                <div class="order-info-value"><?php echo date('M d, Y'); ?></div>
                            </div>
                            <div class="order-info-item">
                                <div class="order-info-label">Amount</div>
                                <div class="order-info-value">$<?php echo number_format(rand(100, 1000), 2); ?></div>
                            </div>
                            <div class="order-info-item">
                                <div class="order-info-label">Payment Method</div>
                                <div class="order-info-value">Credit Card (****<?php echo rand(1000, 9999); ?>)</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="redirect-message">
                        <i class="fas fa-circle-notch"></i>
                        <span>Redirecting to your dashboard in <span id="countdown">7</span> seconds...</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" id="progress-fill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create confetti effect
            createConfetti();
            
            // Start countdown and progress bar
            const countdownEl = document.getElementById('countdown');
            const progressFill = document.getElementById('progress-fill');
            const totalTime = 7;
            let timeLeft = totalTime;
            
            progressFill.style.width = '0%';
            
            const countdownInterval = setInterval(() => {
                timeLeft--;
                countdownEl.textContent = timeLeft;
                
                // Update progress bar
                const progress = ((totalTime - timeLeft) / totalTime) * 100;
                progressFill.style.width = `${progress}%`;
                
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    // Redirect to dashboard - change this URL as needed
                    window.location.href = '/businessman/orders-list';
                }
            }, 1000);
            
            // Confetti effect function
            function createConfetti() {
                const colors = [
                    '#4169E1', '#8A2BE2', '#10B981', '#6366f1', '#34D399'
                ];
                
                for (let i = 0; i < 100; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    
                    // Random position, size and color
                    const size = Math.random() * 10 + 5;
                    const xPos = Math.random() * 100;
                    const yDelay = Math.random() * 5;
                    const color = colors[Math.floor(Math.random() * colors.length)];
                    const duration = Math.random() * 3 + 3;
                    
                    confetti.style.left = `${xPos}vw`;
                    confetti.style.width = `${size}px`;
                    confetti.style.height = `${size}px`;
                    confetti.style.backgroundColor = color;
                    confetti.style.animationDuration = `${duration}s`;
                    confetti.style.animationDelay = `${yDelay}s`;
                    
                    // Different shapes
                    if (Math.random() > 0.5) {
                        confetti.style.borderRadius = '50%';
                    } else if (Math.random() > 0.5) {
                        confetti.style.borderRadius = '2px';
                        confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
                    }
                    
                    document.body.appendChild(confetti);
                    
                    // Remove confetti element when animation ends
                    setTimeout(() => {
                        confetti.remove();
                    }, (duration + yDelay) * 1000);
                }
            }
        });
    </script>
</body>

</html>