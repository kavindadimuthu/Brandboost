<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - Brandboost</title>
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
            --radius: 12px;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --error-color: #e53e3e;
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

        .error-code {
            font-size: 90px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--error-color), var(--secondary-color));
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

        .action-buttons {
            display: flex;
            gap: 12px;
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
            display: inline-block;
            text-decoration: none;
        }

        .cta-button.secondary {
            background: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .cta-button.secondary:hover {
            background: var(--gray-100);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Server Status Indicator */
        .server-status {
            margin-top: 30px;
            padding: 15px;
            background: var(--gray-100);
            border-radius: var(--radius);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--error-color);
            position: relative;
        }

        .status-indicator::after {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border-radius: 50%;
            background: var(--error-color);
            opacity: 0.3;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.3;
            }
            100% {
                transform: scale(0.95);
                opacity: 0.5;
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

            .action-buttons {
                justify-content: center;
            }

            .error-code {
                font-size: 70px;
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
                        <!-- Server icon with "danger" sign -->
                        <rect x="175" y="150" width="150" height="180" rx="10" fill="#4169E1" />
                        <rect x="195" y="170" width="110" height="20" rx="5" fill="white" opacity="0.5" />
                        <rect x="195" y="200" width="110" height="20" rx="5" fill="white" opacity="0.5" />
                        <rect x="195" y="230" width="110" height="20" rx="5" fill="white" opacity="0.5" />
                        <circle cx="250" cy="290" r="30" fill="#e53e3e" />
                        <path d="M240 280L260 300M260 280L240 300" stroke="white" stroke-width="6" stroke-linecap="round" />
                        <!-- Lightning bolt -->
                        <path d="M140 130L160 80L170 110L190 60" stroke="#8A2BE2" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M360 130L340 80L330 110L310 60" stroke="#8A2BE2" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="error-text">
                    <div class="error-code">500</div>
                    <h1 class="error-title">Internal Server Error</h1>
                    <p class="error-message">Something went wrong on our side. Our team has been notified and is working to fix the issue. Please try again later.</p>
                    <div class="action-buttons">
                        <a href="javascript:location.reload();" class="cta-button">
                            <i class="fas fa-sync-alt"></i> Refresh Page
                        </a>
                        <a href="/contact" class="cta-button secondary">
                            <i class="fas fa-bug"></i> Report Issue
                        </a>
                    </div>
                </div>
            </div>
            <div class="server-status">
                <span class="status-indicator"></span>
                <span>We're experiencing some technical difficulties. Please check back soon.</span>
            </div>
        </div>
    </div>

    <script>
        // Animation for the server error illustration
        document.addEventListener('DOMContentLoaded', function() {
            const illustration = document.querySelector('.error-illustration svg');
            
            // Add a gentle "broken server" shake effect
            const animate = () => {
                let time = Date.now() * 0.002;
                let translateX = Math.sin(time) * 3;
                illustration.style.transform = `translateX(${translateX}px)`;
                requestAnimationFrame(animate);
            };
            
            animate();
            
            // Log the error for analytics purposes
            console.log('500 error page viewed at:', new Date().toISOString());
            
            // Optional: Automatically try to refresh after a certain period
            /* 
            setTimeout(() => {
                const shouldRefresh = confirm('Would you like us to try refreshing the page for you?');
                if (shouldRefresh) {
                    location.reload();
                }
            }, 30000); // 30 seconds
            */
        });
    </script>
</body>

</html>