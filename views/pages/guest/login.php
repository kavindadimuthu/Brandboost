<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BrandBoost</title>
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

        .forgot-password {
            display: block;
            text-align: right;
            font-size: 0.875rem;
            color: #2563eb;
            text-decoration: none;
            margin-top: 0.5rem;
        }

        .forgot-password:hover {
            color: #1d4ed8;
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

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .checkbox {
            width: 1rem;
            height: 1rem;
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
                    <span>Back to Home</span>
                </button>
                <h1 class="card-title">Welcome Back</h1>
                <p class="card-description">Sign in to your BrandBoost account</p>
            </div>

            <div class="card-content">
                <form id="loginForm" class="form-grid">
                    <div class="input-group">
                        <label class="label" for="email">Email</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <path d="M22 6l-10 7L2 6"/>
                            </svg>
                            <input type="email" id="email" class="input" placeholder="you@example.com" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="label" for="password">Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="password" class="input" required>
                        </div>
                        <a href="/forgot-password" class="forgot-password">Forgot password?</a>
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember" class="checkbox">
                        <label for="remember" class="label" style="margin: 0">Remember me</label>
                    </div>

                    <button type="submit" class="button">Sign In</button>
                </form>
            </div>

            <div class="card-footer">
                <p>
                    Don't have an account? 
                    <a href="/register" class="link">Create account</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;

            // Here you would typically send the data to your server
            console.log('Login attempted:', {
                email,
                password,
                remember
            });

            // For demo purposes, show success message
            alert('Login successful!');
        });

        // Add back button functionality
        document.querySelector('.back-button').addEventListener('click', function() {
            // For demo purposes, just log the action
            console.log('Back button clicked');
            // In a real application, you would use: window.location.href = '/';
        });
    </script>
</body>
</html>