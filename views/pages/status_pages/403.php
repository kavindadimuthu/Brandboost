<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - Brandboost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4169E1;
            --primary-light: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #8A2BE2;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
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

        .error-code {
            font-size: 90px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--danger-color), var(--warning-color));
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

        .cta-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
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

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .secondary-button {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: var(--radius);
            font-weight: 600;
            padding: 10px 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .secondary-button:hover {
            background-color: rgba(65, 105, 225, 0.1);
            transform: translateY(-2px);
        }

        .lock-animation {
            animation: pulse 2s infinite ease-in-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
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

            .cta-buttons {
                flex-direction: column;
                gap: 10px;
                align-items: center;
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
                    <svg class="lock-animation" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M250 470C370.457 470 468 372.457 468 252C468 131.543 370.457 34 250 34C129.543 34 32 131.543 32 252C32 372.457 129.543 470 250 470Z" fill="#F3F4F6" />
                        <path d="M250 420C342.843 420 418 344.843 418 252C418 159.157 342.843 84 250 84C157.157 84 82 159.157 82 252C82 344.843 157.157 420 250 420Z" fill="white" />
                        <!-- Lock body -->
                        <rect x="175" y="220" width="150" height="130" rx="20" fill="#4169E1" />
                        <!-- Lock shackle -->
                        <path d="M205 220V180C205 142 295 142 295 180V220" stroke="#8A2BE2" stroke-width="20" stroke-linecap="round" />
                        <!-- Lock keyhole -->
                        <circle cx="250" cy="275" r="25" fill="white" />
                        <path d="M250 285V310" stroke="white" stroke-width="10" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="error-text">
                    <div class="error-code">403</div>
                    <h1 class="error-title">Access Denied</h1>
                    <p class="error-message">You don't have permission to view this page. This area might be restricted to certain user roles or requires special authorization.</p>
                    <div class="cta-buttons">
                        <a href="/" class="cta-button">
                            <i class="fas fa-home"></i> Go to Homepage
                        </a>
                        <a href="/login" class="secondary-button">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive elements to the page
        document.addEventListener('DOMContentLoaded', function() {
            const illustration = document.querySelector('.error-illustration svg');
            
            // Add subtle movement to the lock
            const animate = () => {
                let time = Date.now() * 0.001;
                let translateY = Math.sin(time) * 3;
                illustration.style.transform = `translateY(${translateY}px)`;
                requestAnimationFrame(animate);
            };
            
            animate();

            // Check if user is logged in (by checking if there's a session)
            const isLoggedIn = document.referrer.includes('/dashboard') || 
                              document.referrer.includes('/businessman') || 
                              document.referrer.includes('/influencer') || 
                              document.referrer.includes('/designer');

            // If logged in, we can change the secondary button to "Back to Dashboard"
            if (isLoggedIn) {
                const secondaryButton = document.querySelector('.secondary-button');
                secondaryButton.innerHTML = '<i class="fas fa-arrow-left"></i> Back to Dashboard';
                secondaryButton.href = document.referrer || '/';
            }
        });
    </script>
</body>

</html>