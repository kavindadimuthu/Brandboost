<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Pending - Brandboost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5e72e4;
            --primary-dark: #4454c3;
            --primary-light: #edf2ff;
            --secondary: #7c44f1;
            --white: #ffffff;
            --light-bg: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --success: #2dce89;
            --warning: #fb6340;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--gray-700);
            line-height: 1.5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Main content */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 80px 20px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            width: 100%;
            max-width: 600px;
            text-align: center;
            animation: fadeIn 0.5s ease forwards;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 40px 30px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            bottom: -50%;
            left: -50%;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
            transform: rotate(-20deg);
        }

        .status-icon {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2.5rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .pulse {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.5;
            }
            50% {
                transform: scale(1.2);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        .card-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
        }

        .card-content {
            padding: 30px;
        }

        .card-description {
            color: var(--gray-600);
            margin-bottom: 30px;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
        }

        .email-highlight {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary);
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 500;
            margin: 5px 0;
        }

        .check-instructions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: var(--gray-100);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            text-align: left;
        }

        .check-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .check-item i {
            color: var(--primary);
            margin-top: 3px;
        }

        .timer {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 10px 15px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 10px rgba(94, 114, 228, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(94, 114, 228, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .email-support {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            color: var(--gray-500);
            font-size: 0.9rem;
        }

        .email-support a {
            color: var(--primary);
            text-decoration: none;
            margin-left: 5px;
        }

        .email-support a:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive styles */
        @media (max-width: 640px) {
            .container {
                padding: 40px 15px;
            }

            .card-header {
                padding: 30px 20px;
            }

            .card-content {
                padding: 25px 20px;
            }

            .status-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .card-title {
                font-size: 1.5rem;
            }

            .button-group {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="status-card">
            <div class="card-header">
                <div class="status-icon">
                    <div class="pulse"></div>
                    <i class="fas fa-envelope"></i>
                </div>
                <h1 class="card-title">Verify Your Email</h1>
                <p>Your account has been registered successfully!</p>
            </div>

            <div class="card-content">
                <p class="card-description">
                    We've sent a verification link to:
                    <div class="email-highlight" id="userEmail"><?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : 'your email address'; ?></div>
                    Please check your inbox and click the link to complete your registration.
                </p>

                <div class="check-instructions">
                    <div class="check-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Check your inbox for an email from <strong>BrandBoost</strong></span>
                    </div>
                    <div class="check-item">
                        <i class="fas fa-check-circle"></i>
                        <span>If you don't see it, check your spam or junk folder</span>
                    </div>
                    <div class="check-item">
                        <i class="fas fa-check-circle"></i>
                        <span>The verification link will expire in 24 hours</span>
                    </div>
                </div>

                <div class="timer">
                    <i class="fas fa-clock"></i>
                    <span id="countdown">30:00</span> to resend verification
                </div>

                <div class="button-group">
                    <a href="/" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Go to Homepage
                    </a>
                    <a href="/login" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Go to Login
                    </a>
                </div>

                <div class="email-support">
                    Didn't receive the email? <a href="#" id="resendLink">Resend verification</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const countdownEl = document.getElementById('countdown');
            const resendLink = document.getElementById('resendLink');
            const userEmail = document.getElementById('userEmail').textContent.trim();
            
            // Start with 30 minutes
            let timeLeft = 30 * 60;
            let countdownTimer;
            
            // Disable resend link initially
            resendLink.style.opacity = '0.5';
            resendLink.style.pointerEvents = 'none';
            
            // Function to update countdown
            function updateCountdown() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                // Format time as MM:SS
                countdownEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(countdownTimer);
                    countdownEl.textContent = "00:00";
                    
                    // Enable resend link
                    resendLink.style.opacity = '1';
                    resendLink.style.pointerEvents = 'auto';
                } else {
                    timeLeft--;
                }
            }
            
            // Start countdown
            updateCountdown();
            countdownTimer = setInterval(updateCountdown, 1000);
            
            // Handle resend click
            resendLink.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Only proceed if the link is active
                if (timeLeft > 0) return;
                
                // Show loading state
                resendLink.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                resendLink.style.pointerEvents = 'none';
                
                // Send request to resend verification
                fetch('/api/resend-verification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: userEmail })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reset countdown
                        timeLeft = 30 * 60;
                        updateCountdown();
                        countdownTimer = setInterval(updateCountdown, 1000);
                        
                        // Show success message
                        alert('Verification email has been resent! Please check your inbox.');
                    } else {
                        throw new Error(data.message || 'Failed to resend verification email');
                    }
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                })
                .finally(() => {
                    // Reset link text
                    resendLink.innerHTML = 'Resend verification';
                    resendLink.style.opacity = '0.5';
                    resendLink.style.pointerEvents = 'none';
                });
            });
        });
    </script>
</body>

</html>