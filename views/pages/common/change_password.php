<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - BrandBoost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            min-height: 100vh;
        }

        .settings-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        /* Sidebar Styles */
        .settings-sidebar {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: fit-content;
            position: sticky;
            top: 90px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #666;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: #f5f7fb;
            color: #4169E1;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
        }

        /* Main Content Styles */
        .settings-content {
            /* max-width: 600px; */
        }

        .page-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            color: #1a1a1a;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .page-description {
            color: #666;
            font-size: 14px;
        }

        .form-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #4a4a4a;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4169E1;
            box-shadow: 0 0 0 3px rgba(65, 105, 225, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 38px;
            color: #666;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
        }

        .password-requirements {
            margin-top: 16px;
            padding: 16px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .requirement-list {
            list-style: none;
            margin-top: 8px;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .requirement-item i {
            font-size: 12px;
        }

        .requirement-item.valid {
            color: #28a745;
        }

        .requirement-item.invalid {
            color: #dc3545;
        }

        .save-button {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
        }

        .save-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(65, 105, 225, 0.2);
        }

        .save-button:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Alert Styles */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .settings-container {
                grid-template-columns: 1fr;
            }

            .settings-sidebar {
                position: static;
            }

            .settings-content {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <!-- Sidebar Navigation -->
        <div class="settings-sidebar">
            <a href="/<?php echo $_SESSION['user']['role']; ?>/edit-profile" class="sidebar-link">
                <i class="fas fa-user"></i>
                Edit Profile
            </a>
            <a href="/<?php echo $_SESSION['user']['role']; ?>/change-password" class="sidebar-link active">
                <i class="fas fa-lock"></i>
                Change Password
            </a>
            <a href="/<?php echo $_SESSION['user']['role']; ?>/payout-methods" class="sidebar-link">
                <i class="fas fa-credit-card"></i>
                Payout Methods
            </a>
        </div>

        <!-- Main Content -->
        <div class="settings-content">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Change Password</h1>
                <p class="page-description">Ensure your account is using a strong password to stay secure</p>
            </div>

            <!-- Alert Messages -->
            <div id="success-alert" class="alert alert-success">
                Password successfully updated!
            </div>
            <div id="error-alert" class="alert alert-error">
                Failed to update password. Please try again.
            </div>

            <!-- Password Form -->
            <form id="password-form">
                <div class="form-section">
                    <div class="form-group">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" required>
                        <button type="button" class="password-toggle" data-target="current-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" required>
                        <button type="button" class="password-toggle" data-target="new-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password</label>
                        <input type="password" id="confirm-password" required>
                        <button type="button" class="password-toggle" data-target="confirm-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="password-requirements">
                        <div class="requirement-title">Password must contain:</div>
                        <ul class="requirement-list">
                            <li class="requirement-item" data-requirement="length">
                                <i class="fas fa-times-circle"></i>
                                At least 8 characters
                            </li>
                            <li class="requirement-item" data-requirement="uppercase">
                                <i class="fas fa-times-circle"></i>
                                At least one uppercase letter
                            </li>
                            <li class="requirement-item" data-requirement="lowercase">
                                <i class="fas fa-times-circle"></i>
                                At least one lowercase letter
                            </li>
                            <li class="requirement-item" data-requirement="number">
                                <i class="fas fa-times-circle"></i>
                                At least one number
                            </li>
                            <li class="requirement-item" data-requirement="special">
                                <i class="fas fa-times-circle"></i>
                                At least one special character
                            </li>
                            <li class="requirement-item" data-requirement="match">
                                <i class="fas fa-times-circle"></i>
                                Passwords match
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="form-section">
                    <button type="submit" class="save-button" disabled>Update Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('password-form');
            const newPasswordInput = document.getElementById('new-password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const submitButton = form.querySelector('.save-button');
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');

            // Password toggle functionality
            document.querySelectorAll('.password-toggle').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Password validation
            function validatePassword() {
                const password = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                let isValid = true;

                const requirements = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[!@#$%^&*(),.?":{}|<>]/.test(password),
                    match: password === confirmPassword && password !== ''
                };

                // Update requirement items
                Object.entries(requirements).forEach(([requirement, valid]) => {
                    const item = document.querySelector(`[data-requirement="${requirement}"]`);
                    const icon = item.querySelector('i');

                    item.classList.toggle('valid', valid);
                    item.classList.toggle('invalid', !valid);
                    icon.classList.toggle('fa-check-circle', valid);
                    icon.classList.toggle('fa-times-circle', !valid);

                    if (!valid) isValid = false;
                });

                submitButton.disabled = !isValid;
            }

            newPasswordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', validatePassword);

            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simulate API call
                setTimeout(() => {
                    // Show success message
                    successAlert.style.display = 'block';
                    errorAlert.style.display = 'none';

                    // Reset form
                    form.reset();
                    validatePassword();

                    // Hide success message after 3 seconds
                    setTimeout(() => {
                        successAlert.style.display = 'none';
                    }, 3000);
                }, 1000);
            });
        });
    </script>
</body>
</html>