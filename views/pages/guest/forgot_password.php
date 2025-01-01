<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - BrandBoost</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto;
        }

        .min-h-screen {
            min-height: 100vh;
            background: linear-gradient(to bottom right, #2563eb, #9333ea);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 28rem;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            cursor: pointer;
            border: none;
            background: none;
            color: #6b7280;
            padding: 0.5rem;
            border-radius: 0.25rem;
        }

        .back-button:hover {
            background-color: #f3f4f6;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-description {
            color: #6b7280;
            line-height: 1.5;
        }

        .card-content {
            padding: 1.5rem;
        }

        .form-grid {
            display: grid;
            gap: 1.5rem;
        }

        .input-group {
            position: relative;
        }

        .label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            width: 1rem;
            height: 1rem;
        }

        .input {
            width: 100%;
            padding: 0.5rem 0.75rem 0.5rem 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
        }

        .button {
            width: 100%;
            padding: 0.75rem;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            margin-top: 1.5rem;
        }

        .button:hover {
            background-color: #1d4ed8;
        }

        .card-footer {
            padding: 1.5rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .link:hover {
            color: #1d4ed8;
        }

        .success-message {
            display: none;
            background-color: #f0fdf4;
            border: 1px solid #86efac;
            color: #166534;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }

        .success-icon {
            color: #16a34a;
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <div class="card">
            <div class="card-header">
                <button class="back-button">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    <span>Back to Login</span>
                </button>
                <h1 class="card-title">Reset Password</h1>
                <p class="card-description">Enter your email address and we'll send you instructions to reset your password.</p>
            </div>

            <div class="card-content">
                <div id="successMessage" class="success-message">
                    <svg class="success-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                    Password reset instructions have been sent to your email.
                </div>

                <form id="resetForm" class="form-grid">
                    <div class="input-group">
                        <label class="label" for="email">Email Address</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <path d="M22 6l-10 7L2 6"/>
                            </svg>
                            <input type="email" id="email" class="input" placeholder="you@example.com" required>
                        </div>
                    </div>

                    <button type="submit" class="button">Send Reset Instructions</button>
                </form>
            </div>

            <div class="card-footer">
                <p>
                    Remember your password? 
                    <a href="/login" class="link">Back to login</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const email = document.getElementById('email').value;

            // Here you would typically send the request to your server
            console.log('Password reset requested for:', email);

            // Show success message
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            
            // Optionally disable the form
            const form = document.getElementById('resetForm');
            form.email.disabled = true;
            form.querySelector('button').disabled = true;
        });

        // Add back button functionality
        document.querySelector('.back-button').addEventListener('click', function() {
            // For demo purposes, just log the action
            console.log('Back button clicked');
            // In a real application, you would use: window.location.href = '/login';
        });
    </script>
</body>
</html>