<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0f2f5;
            /* display: flex;
            flex-direction: column; */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: white;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #1a73e8;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .password-input-container {
            position: relative;
        }

        .password-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .password-input:focus {
            outline: none;
            border-color: #1a73e8;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-meter {
            height: 4px;
            background: #eee;
            margin-top: 5px;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-meter div {
            height: 100%;
            width: 0;
            transition: width 0.3s, background-color 0.3s;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .success-message {
            color: #28a745;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background: #1557b0;
        }

        .submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        /* Password requirements list */
        .requirements {
            margin-top: 8px;
            font-size: 12px;
            color: #666;
        }

        .requirements ul {
            list-style: none;
            margin-top: 5px;
        }

        .requirements li {
            margin-bottom: 3px;
            display: flex;
            align-items: center;
        }

        .requirements li i {
            margin-right: 5px;
            font-size: 10px;
        }

        .requirement-met {
            color: #28a745;
        }

        .requirement-unmet {
            color: #666;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.2s ease-in-out 0s 2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Change Password</h1>
            <p>Create a strong password to protect your account</p>
        </div>
        
        <form id="changePasswordForm">
            <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <div class="password-input-container">
                    <input type="password" id="currentPassword" class="password-input" required>
                    <i class="toggle-password fas fa-eye"></i>
                </div>
                <div class="error-message" id="currentPasswordError"></div>
            </div>

            <div class="form-group">
                <label for="newPassword">New Password</label>
                <div class="password-input-container">
                    <input type="password" id="newPassword" class="password-input" required>
                    <i class="toggle-password fas fa-eye"></i>
                </div>
                <div class="password-strength">
                    <span id="strengthText">Password Strength</span>
                    <div class="strength-meter">
                        <div id="strengthMeter"></div>
                    </div>
                </div>
                <div class="requirements">
                    Password must contain:
                    <ul>
                        <li id="length"><i class="fas fa-circle"></i> At least 8 characters</li>
                        <li id="uppercase"><i class="fas fa-circle"></i> At least one uppercase letter</li>
                        <li id="lowercase"><i class="fas fa-circle"></i> At least one lowercase letter</li>
                        <li id="number"><i class="fas fa-circle"></i> At least one number</li>
                        <li id="special"><i class="fas fa-circle"></i> At least one special character</li>
                    </ul>
                </div>
                <div class="error-message" id="newPasswordError"></div>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm New Password</label>
                <div class="password-input-container">
                    <input type="password" id="confirmPassword" class="password-input" required>
                    <i class="toggle-password fas fa-eye"></i>
                </div>
                <div class="error-message" id="confirmPasswordError"></div>
            </div>

            <button type="submit" class="submit-btn" disabled>Change Password</button>
            <div class="success-message" id="successMessage">Password changed successfully!</div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('changePasswordForm');
            const currentPassword = document.getElementById('currentPassword');
            const newPassword = document.getElementById('newPassword');
            const confirmPassword = document.getElementById('confirmPassword');
            const submitButton = document.querySelector('.submit-btn');
            const strengthMeter = document.getElementById('strengthMeter');
            const strengthText = document.getElementById('strengthText');
            const requirements = {
                length: document.getElementById('length'),
                uppercase: document.getElementById('uppercase'),
                lowercase: document.getElementById('lowercase'),
                number: document.getElementById('number'),
                special: document.getElementById('special')
            };

            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    if (input.type === 'password') {
                        input.type = 'text';
                        this.classList.remove('fa-eye');
                        this.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        this.classList.remove('fa-eye-slash');
                        this.classList.add('fa-eye');
                    }
                });
            });

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;
                const checks = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[^A-Za-z0-9]/.test(password)
                };

                // Update requirement indicators
                for (const [requirement, met] of Object.entries(checks)) {
                    const element = requirements[requirement];
                    if (met) {
                        strength++;
                        element.classList.add('requirement-met');
                        element.classList.remove('requirement-unmet');
                        element.querySelector('i').classList.remove('fa-circle');
                        element.querySelector('i').classList.add('fa-check-circle');
                    } else {
                        element.classList.remove('requirement-met');
                        element.classList.add('requirement-unmet');
                        element.querySelector('i').classList.remove('fa-check-circle');
                        element.querySelector('i').classList.add('fa-circle');
                    }
                }

                // Calculate percentage and update meter
                const strengthPercentage = (strength / 5) * 100;
                strengthMeter.style.width = `${strengthPercentage}%`;

                // Update color and text based on strength
                if (strengthPercentage <= 20) {
                    strengthMeter.style.backgroundColor = '#dc3545';
                    strengthText.textContent = 'Very Weak';
                    strengthText.style.color = '#dc3545';
                } else if (strengthPercentage <= 40) {
                    strengthMeter.style.backgroundColor = '#ffc107';
                    strengthText.textContent = 'Weak';
                    strengthText.style.color = '#ffc107';
                } else if (strengthPercentage <= 60) {
                    strengthMeter.style.backgroundColor = '#fd7e14';
                    strengthText.textContent = 'Medium';
                    strengthText.style.color = '#fd7e14';
                } else if (strengthPercentage <= 80) {
                    strengthMeter.style.backgroundColor = '#28a745';
                    strengthText.textContent = 'Strong';
                    strengthText.style.color = '#28a745';
                } else {
                    strengthMeter.style.backgroundColor = '#20c997';
                    strengthText.textContent = 'Very Strong';
                    strengthText.style.color = '#20c997';
                }

                return strengthPercentage;
            }

            // Validate form
            function validateForm() {
                let isValid = true;
                const currentPasswordError = document.getElementById('currentPasswordError');
                const newPasswordError = document.getElementById('newPasswordError');
                const confirmPasswordError = document.getElementById('confirmPasswordError');

                // Reset error messages
                currentPasswordError.style.display = 'none';
                newPasswordError.style.display = 'none';
                confirmPasswordError.style.display = 'none';

                // Current password validation
                if (currentPassword.value.length < 1) {
                    currentPasswordError.textContent = 'Please enter your current password';
                    currentPasswordError.style.display = 'block';
                    isValid = false;
                }

                // New password validation
                if (checkPasswordStrength(newPassword.value) < 60) {
                    newPasswordError.textContent = 'Please create a stronger password';
                    newPasswordError.style.display = 'block';
                    isValid = false;
                }

                // Confirm password validation
                if (newPassword.value !== confirmPassword.value) {
                    confirmPasswordError.textContent = 'Passwords do not match';
                    confirmPasswordError.style.display = 'block';
                    isValid = false;
                }

                submitButton.disabled = !isValid;
                return isValid;
            }

            // Event listeners
            newPassword.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                validateForm();
            });

            confirmPassword.addEventListener('input', validateForm);
            currentPassword.addEventListener('input', validateForm);

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    // Simulate API call
                    submitButton.textContent = 'Changing Password...';
                    submitButton.disabled = true;

                    setTimeout(() => {
                        const successMessage = document.getElementById('successMessage');
                        successMessage.style.display = 'block';
                        submitButton.textContent = 'Change Password';
                        submitButton.disabled = false;
                        
                        // Reset form after success
                        setTimeout(() => {
                            form.reset();
                            successMessage.style.display = 'none';
                            strengthMeter.style.width = '0';
                            strengthText.textContent = 'Password Strength';
                            strengthText.style.color = '#666';
                            Object.values(requirements).forEach(req => {
                                req.classList.remove('requirement-met');
                                req.classList.add('requirement-unmet');
                                req.querySelector('i').classList.remove('fa-check-circle');
                                req.querySelector('i').classList.add('fa-circle');
                            });
                        }, 3000);
                    }, 1500);
                } else {
                    // Shake the form if validation fails
                    form.classList.add('shake');
                    setTimeout(() => form.classList.remove('shake'), 500);
                }
            });
        });
    </script>
</body>
</html>