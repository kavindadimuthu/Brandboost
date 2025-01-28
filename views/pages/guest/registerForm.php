<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
            padding: 3rem;
        }

        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 40rem;
        }

        .card-header {
            padding: 1.5rem 2rem;
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
            padding: 1.5rem 2rem;
        }

        .form-grid {
            display: grid;
            gap: 1.5rem;
        }

        .input-group {
            position: relative;
        }

        .two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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

        select.input {
            padding-left: 0.75rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .checkbox {
            width: 1rem;
            height: 1rem;
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
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .link {
            color: #2563eb;
            text-decoration: none;
        }

        .link:hover {
            color: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="min-h-screen">
        <div class="card">
            <div class="card-header">
                <button class="back-button" onclick="window.location.href='/register'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    <span>Back to Register</span>
                </button>
                <h1 class="card-title">Create an Account</h1>
                <p class="card-description">Register as a <?php echo $data[0] ?> user to get started with BrandBoost</p>
            </div>

            <div class="card-content">
                <form id="registrationForm" class="form-grid" method="POST" action="/api/register">
                    <input type="hidden" id="role" name="role" value="<?php echo $data[0] ?>" required>
                    <div class="two-columns">
                        <div class="input-group">
                            <label class="label" for="firstName">First Name</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 3a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                </svg>
                                <input type="text" id="firstName" name="firstName" class="input" placeholder="John" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label class="label" for="lastName">Last Name</label>
                            <div class="input-wrapper">
                                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 3a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                                </svg>
                                <input type="text" id="lastName" name="lastName" class="input" placeholder="Doe" required>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="label" for="email">Email</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <path d="M22 6l-10 7L2 6"/>
                            </svg>
                            <input type="email" id="email" name="email" class="input" placeholder="you@example.com" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="label" for="phone">Phone Number</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            <input type="tel" id="phone" name="phone" class="input" placeholder="+1 (555) 000-0000" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="label" for="password">Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="password" name="password" class="input" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label class="label" for="confirmPassword">Confirm Password</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input type="password" id="confirmPassword" name="confirmPassword" class="input" required>
                        </div>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="privacy" class="checkbox" required>
                        <label for="privacy" class="label" style="margin: 0">
                            I agree to the <a href="#" class="link">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="button">Create Account</button>
                </form>
            </div>

            <div class="card-footer">
                <p>
                    Already have an account? 
                    <a href="/login" class="link">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // document.getElementById('registrationForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     // Get form values
        //     const firstName = document.getElementById('firstName').value;
        //     const lastName = document.getElementById('lastName').value;
        //     const email = document.getElementById('email').value;
        //     const phone = document.getElementById('phone').value;
        //     const gender = document.getElementById('gender').value;
        //     const password = document.getElementById('password').value;
        //     const confirmPassword = document.getElementById('confirmPassword').value;
        //     const privacy = document.getElementById('privacy').checked;

        //     // Basic validation
        //     if (password !== confirmPassword) {
        //         alert('Passwords do not match!');
        //         return;
        //     }

        //     if (!privacy) {
        //         alert('Please agree to the Privacy Policy');
        //         return;
        //     }

        //     // Here you would typically send the data to your server
        //     console.log('Form submitted:', {
        //         firstName,
        //         lastName,
        //         email,
        //         phone,
        //         gender,
        //         password
        //     });

        //     // For demo purposes, show success message
        //     alert('Registration successful!');
        // });

        
    </script>
</body>
</html>