<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Unavailable - Brandboost</title>
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

        .logo i {
            font-size: 24px;
        }

        .social-links {
            display: flex;
            align-items: center;
            gap: 20px;
            background: rgba(255, 255, 255, 0.15);
            padding: 8px 25px;
            border-radius: 15px;
            backdrop-filter: blur(5px);
        }

        .social-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            position: relative;
        }

        .social-link:hover {
            color: white;
            transform: translateY(-2px);
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
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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

        .notification-form {
            background-color: white;
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-top: 30px;
        }

        .notification-form h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: var(--gray-800);
        }

        .form-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .form-input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: var(--primary-color);
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

        .status-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            border-radius: var(--radius);
            padding: 12px 20px;
            background-color: #ffedd5;
            border-left: 4px solid #f97316;
            color: #9a3412;
            font-weight: 500;
            font-size: 15px;
        }

        .progress-container {
            margin-top: 25px;
            width: 100%;
            background-color: var(--gray-200);
            border-radius: 999px;
            height: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            width: 75%;
            animation: progress-animation 2s ease-in-out infinite;
        }

        @keyframes progress-animation {
            0% {
                width: 10%;
            }
            50% {
                width: 75%;
            }
            100% {
                width: 10%;
            }
        }

        .estimated-time {
            font-size: 14px;
            color: var(--gray-600);
            margin-top: 10px;
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

            .social-links {
                gap: 15px;
                padding: 8px 15px;
            }

            .social-link span {
                display: none;
            }

            .form-group {
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

            .social-links {
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
        <div class="social-links">
            <a href="https://twitter.com/brandboost" target="_blank" class="social-link">
                <i class="fab fa-twitter"></i>
                <span>Twitter</span>
            </a>
            <a href="https://facebook.com/brandboost" target="_blank" class="social-link">
                <i class="fab fa-facebook-f"></i>
                <span>Facebook</span>
            </a>
            <a href="https://instagram.com/brandboost" target="_blank" class="social-link">
                <i class="fab fa-instagram"></i>
                <span>Instagram</span>
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="error-content">
                <div class="error-illustration">
                    <svg viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M250 470C370.457 470 468 372.457 468 252C468 131.543 370.457 34 250 34C129.543 34 32 131.543 32 252C32 372.457 129.543 470 250 470Z" fill="#F3F4F6" />
                        <path d="M250 420C342.843 420 418 344.843 418 252C418 159.157 342.843 84 250 84C157.157 84 82 159.157 82 252C82 344.843 157.157 420 250 420Z" fill="white" />
                        <path d="M160 250H340" stroke="#4169E1" stroke-width="15" stroke-linecap="round" />
                        <path d="M160 190H340" stroke="#8A2BE2" stroke-width="15" stroke-linecap="round" />
                        <path d="M200 310H300" stroke="#4169E1" stroke-width="15" stroke-linecap="round" />
                        <circle cx="400" cy="120" r="30" fill="#f97316" opacity="0.2">
                            <animate attributeName="opacity" values="0.2;0.5;0.2" dur="2s" repeatCount="indefinite" />
                        </circle>
                        <circle cx="100" cy="380" r="20" fill="#4169E1" opacity="0.2">
                            <animate attributeName="opacity" values="0.2;0.5;0.2" dur="3s" repeatCount="indefinite" />
                        </circle>
                    </svg>
                </div>
                <div class="error-text">
                    <div class="error-code">503</div>
                    <h1 class="error-title">Service Unavailable</h1>
                    <p class="error-message">We're doing some maintenance. We'll be back shortly. Our team is working hard to improve your experience.</p>
                    
                    <div class="status-indicator">
                        <i class="fas fa-tools"></i>
                        <span>Scheduled maintenance in progress</span>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <p class="estimated-time">Estimated completion: <span id="completion-time">30 minutes</span></p>
                </div>
            </div>
            
            <div class="notification-form">
                <h3>Get notified when we're back online</h3>
                <form id="notification-form">
                    <div class="form-group">
                        <input type="email" class="form-input" placeholder="Enter your email" required>
                        <button type="submit" class="cta-button">
                            <i class="fas fa-bell"></i> Notify Me
                        </button>
                    </div>
                </form>
                <p id="form-response" style="margin-top: 10px; font-size: 14px;"></p>
            </div>
        </div>
    </div>

    <script>
        // Animated progress bar logic
        document.addEventListener('DOMContentLoaded', function() {
            const illustration = document.querySelector('.error-illustration svg');
            
            // Gently animate the illustration
            const animate = () => {
                let time = Date.now() * 0.001;
                let translateY = Math.sin(time) * 5;
                illustration.style.transform = `translateY(${translateY}px)`;
                requestAnimationFrame(animate);
            };
            
            animate();
            
            // Form submission logic
            const form = document.getElementById('notification-form');
            const response = document.getElementById('form-response');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const email = form.querySelector('input[type="email"]').value;
                
                // Simulate API call
                setTimeout(() => {
                    response.innerHTML = `<span style="color: #10b981;"><i class="fas fa-check-circle"></i> Thanks! We'll notify ${email} when we're back online.</span>`;
                    form.reset();
                }, 1000);
                
                response.innerHTML = '<span style="color: #6366f1;"><i class="fas fa-spinner fa-spin"></i> Submitting...</span>';
            });
            
            // Dynamic countdown timer
            const completionTime = document.getElementById('completion-time');
            let minutes = 30;
            
            const updateTime = () => {
                completionTime.textContent = `${minutes} minute${minutes !== 1 ? 's' : ''}`;
                if (minutes > 0) {
                    minutes--;
                    setTimeout(updateTime, 60000); // Update every minute
                } else {
                    completionTime.textContent = 'any moment now';
                }
            };
            
            updateTime();
        });
    </script>
</body>

</html>