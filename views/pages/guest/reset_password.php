<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - BrandBoost</title>
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

        .button:disabled {
            background-color: #93c5fd;
            cursor: not-allowed;
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

        .error-message {
            display: none;
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }

        .password-requirements {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.25rem;
        }

        .requirement-icon {
            width: 1rem;
            height: 1rem;
        }

        .requirement.valid {
            color: #16a34a;
        }

        .requirement.invalid {
            color: #6b7280;
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
                <h1 class="card-title">Create New Password</h1>
                <p class="card-description">Your new password must be different from previously used passwords.</p>
            </div>

            <div class="card-content">
                <div id="successMessage" class="success-message">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: inline">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                    Password has been successfully reset. You can now log in with your new password.
                </div>

                <form id="resetPasswordForm" class="form-grid">
                    <div class="input-group">
                        <label class="label" for="password">New Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="password" class="input" required>
                        </div>
                        <div class="password-requirements">
                            <div class="requirement" data-requirement="length">
                                <svg class="requirement-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                                At least 8 characters long
                            </div>
                            <div class="requirement" data-requirement="uppercase">
                                <svg class="requirement-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                                Contains uppercase letter
                            </div>
                            <div class="requirement" data-requirement="lowercase">
                                <svg class="requirement-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                                Contains lowercase letter
                            </div>
                            <div class="requirement" data-requirement="number">
                                <svg class="requirement-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                                Contains number
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="label" for="confirmPassword">Confirm New Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="confirmPassword" class="input" required>
                        </div>
                        <div id="passwordError" class="error-message">Passwords do not match</div>
                    </div>

                    <button type="submit" class="button" id="submitButton">Reset Password</button>
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
        const form = document.getElementById('resetPasswordForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const submitButton = document.getElementById('submitButton');
        const passwordError = document.getElementById('passwordError');
        const requirements = {
            length: str => str.length >= 8,
            uppercase: str => /[A-Z]/.test(str),
            lowercase: str => /[a-z]/.test(str),
            number: str => /[0-9]/.test(str)
        };

        function updateRequirements(password) {
            for (const [requirement, validationFn] of Object.entries(requirements)) {
                const element = document.querySelector(`[data-requirement="${requirement}"]`);
                if (validationFn(password)) {
                    element.classList.add('valid');
                    element.classList.remove('invalid');
                } else {
                    element.classList.add('invalid');
                    element.classList.remove('valid');
                }
            }
        }

        function validatePasswords() {
            const isValid = Object.values(requirements).every(fn => fn(password.value));
            const passwordsMatch = password.value === confirmPassword.value;
            
            if (password.value && confirmPassword.value) {
                passwordError.style.display = passwordsMatch ? 'none' : 'block';
            }

            submitButton.disabled = !isValid || !passwordsMatch;
        }

        password.addEventListener('input', () => {
            updateRequirements(password.value);
            validatePasswords();
        });

        confirmPassword.addEventListener('input', validatePasswords);

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Here you would typically send the request to your server
            console.log('Password reset submitted');

            // Show success message
            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            
            // Disable form
            form.password.disabled = true;
            form.confirmPassword.disabled = true;
            submitButton.disabled = true;

            // In a real application, you would redirect to login after a short delay
            setTimeout(() => {
                // window.location.href = '/login';
                console.log('Would redirect to login page');
            }, 3000);
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