<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Failed - Brandboost</title>
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
            --danger: #f5365c;
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
            background: linear-gradient(135deg, var(--danger), #ff6b6b);
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

        .shake {
            animation: shake 0.6s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-10px); }
            40%, 80% { transform: translateX(10px); }
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

        .error-message {
            background: rgba(245, 54, 92, 0.1);
            color: var(--danger);
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            text-align: left;
            border-left: 4px solid var(--danger);
        }

        .possible-reasons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: var(--gray-100);
            padding: 20px;
            border-radius: var(--border-radius);
            margin-bottom: 30px;
            text-align: left;
        }

        .reason-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .reason-item i {
            color: var(--warning);
            margin-top: 3px;
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

        .btn-danger {
            background: var(--danger);
            color: white;
            box-shadow: 0 4px 10px rgba(245, 54, 92, 0.3);
        }

        .btn-danger:hover {
            background: #e01e4c;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(245, 54, 92, 0.4);
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
                <div class="status-icon shake">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h1 class="card-title">Registration Failed</h1>
                <p>We encountered an issue while processing your registration</p>
            </div>

            <div class="card-content">
                <p class="card-description">
                    Unfortunately, we couldn't complete your registration. Please review the error details below
                    and try again.
                </p>

                <div class="error-message">
                    <strong>Error:</strong> <?php echo isset($_GET['error']) ? htmlspecialchars($_GET['error']) : 'An unexpected error occurred during the registration process.'; ?>
                </div>

                <div class="possible-reasons">
                    <h3 style="margin-bottom: 10px; color: var(--gray-700);">Possible reasons:</h3>
                    <div class="reason-item">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>The email address may already be registered</span>
                    </div>
                    <div class="reason-item">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>There might be issues with your password format</span>
                    </div>
                    <div class="reason-item">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Our system might be experiencing temporary issues</span>
                    </div>
                </div>

                <div class="button-group">
                    <a href="/" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Go to Homepage
                    </a>
                    <a href="/register" class="btn btn-primary">
                        <i class="fas fa-redo"></i> Try Again
                    </a>
                </div>

                <div class="email-support">
                    Need help? <a href="mailto:support@brandboost.com">Contact our support team</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the status icon element
            const statusIcon = document.querySelector('.status-icon');
            
            // Re-trigger the shake animation when clicked
            statusIcon.addEventListener('click', function() {
                this.classList.remove('shake');
                void this.offsetWidth; // Trigger reflow
                this.classList.add('shake');
            });
            
            // Add analytics tracking for failed registrations
            const errorMessage = document.querySelector('.error-message').textContent.trim();
            
            // You could implement analytics tracking here
            // Example: trackEvent('Registration', 'Failed', errorMessage);
        });
    </script>
</body>

</html>