<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Brandboost</title>
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

        /* Animated background */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4ecfb 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            position: relative;
            overflow-x: hidden;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        /* @keyframes gradientBG {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        } */

        /* Floating shapes */
        body::before,
        body::after {
            content: "";
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            z-index: -1;
        }

        body::before {
            background: linear-gradient(45deg, rgba(94, 114, 228, 0.1), rgba(130, 94, 228, 0.1));
            top: -100px;
            right: -100px;
            /* animation: float 8s ease-in-out infinite; */
        }

        body::after {
            background: linear-gradient(45deg, rgba(124, 68, 241, 0.1), rgba(94, 114, 228, 0.1));
            bottom: -100px;
            left: -100px;
            /* animation: float 10s ease-in-out infinite alternate; */
        }

        /* Add floating geometric shapes */
        .shape {
            position: fixed;
            z-index: -1;
            opacity: 0.7;
        }

        .shape-1 {
            top: 15%;
            left: 10%;
            /* animation: float 6s ease-in-out infinite; */
        }

        .shape-2 {
            top: 75%;
            right: 15%;
            /* animation: float 7s ease-in-out infinite 1s; */
        }

        .shape-3 {
            bottom: 20%;
            left: 20%;
            /* animation: float 8s ease-in-out infinite 2s; */
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }

            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        /* Enhance the auth container */
        .auth-container {
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            transform: translateY(0);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .auth-container:hover {
            /* transform: translateY(-5px); */
            box-shadow: 0 20px 40px rgba(50, 50, 93, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Add subtle animation to the form button */
        .form-submit:not(:disabled) {
            position: relative;
            overflow: hidden;
        }

        .form-submit:not(:disabled)::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0) translate(-50%, -50%);
            transform-origin: top left;
            opacity: 0;
            transition: transform 0.6s, opacity 0.6s;
        }

        .form-submit:not(:disabled):hover::after {
            transform: scale(20) translate(-50%, -50%);
            opacity: 1;
        }

        .auth-container {
            width: 100%;
            max-width: 1100px;
            margin: 40px auto;
            display: flex;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            background: var(--white);
            height: calc(100vh - 80px);
            max-height: 800px;
        }

        .auth-brand {
            flex: 5;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px;
            color: white;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .auth-brand::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            bottom: -50%;
            left: -50%;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
            transform: rotate(-20deg);
        }

        .brand-content {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .brand-logo {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-tagline {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .brand-description {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .brand-features {
            margin-top: auto;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
        }

        .feature-icon {
            background: rgba(255, 255, 255, 0.1);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-form {
            flex: 7;
            padding: 40px;
            overflow-y: auto;
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            cursor: pointer;
            border: none;
            background: none;
            color: var(--gray-500);
            padding: 0.5rem;
            border-radius: 0.25rem;
            font-weight: 500;
        }

        .back-button:hover {
            color: var(--primary);
            background-color: var(--primary-light);
        }

        .form-header {
            margin-bottom: 2rem;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--gray-500);
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            flex: 1;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-input-wrapper {
            position: relative;
        }

        .form-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            z-index: 1;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.8rem;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 0.95rem;
            color: var(--gray-700);
            background-color: var(--white);
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
        }

        .form-input.error {
            border-color: var(--danger);
        }

        .form-input.valid {
            border-color: var(--success);
        }

        .error-message {
            color: var(--danger);
            font-size: 0.8rem;
            margin-top: 0.4rem;
            display: none;
        }

        .guidelines {
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 0.8rem;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            display: none;
            border: 1px solid var(--gray-200);
        }

        .guidelines ul {
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }

        .guidelines li {
            margin-bottom: 0.4rem;
        }

        .guidelines-title {
            font-weight: 600;
            color: var(--gray-700);
        }

        .password-strength {
            height: 4px;
            width: 100%;
            background-color: var(--gray-200);
            margin-top: 0.5rem;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-meter {
            height: 100%;
            width: 0;
            transition: width 0.3s, background-color 0.3s;
        }

        .form-checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            margin-top: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 1px solid var(--gray-300);
            border-radius: 4px;
            background-color: var(--white);
            cursor: pointer;
            position: relative;
            margin-top: 0.2rem;
        }

        .form-checkbox:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-checkbox:checked::after {
            content: "";
            position: absolute;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .form-checkbox-label {
            font-size: 0.9rem;
            color: var(--gray-600);
        }

        .form-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .form-link:hover {
            text-decoration: underline;
        }

        .form-submit {
            display: block;
            width: 100%;
            padding: 0.9rem;
            border: none;
            border-radius: 8px;
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 1.5rem;
        }

        .form-submit:hover:not(:disabled) {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(94, 114, 228, 0.25);
        }

        .form-submit:disabled {
            background-color: var(--gray-300);
            cursor: not-allowed;
        }

        .form-footer {
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray-500);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .auth-container {
                flex-direction: column;
                max-height: none;
                height: auto;
            }

            .auth-brand {
                padding: 30px;
            }

            .brand-tagline {
                font-size: 2rem;
            }

            .brand-features {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .auth-container {
                margin: 0;
                border-radius: 0;
                box-shadow: none;
                height: 100vh;
                max-height: none;
            }

            .auth-brand {
                display: none;
            }

            .auth-form {
                padding: 30px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
                margin-bottom: 0;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Add floating decoration elements -->
    <div class="shape shape-1">
        <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M35 0L65.3109 25L35 50L4.6891 25L35 0Z" fill="#5e72e4" fill-opacity="0.2" />
        </svg>
    </div>
    <div class="shape shape-2">
        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="80" height="80" rx="15" fill="#7c44f1" fill-opacity="0.2" />
        </svg>
    </div>
    <div class="shape shape-3">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="30" cy="30" r="30" fill="#5e72e4" fill-opacity="0.2" />
        </svg>
    </div>
    <div class="auth-container">
        <!-- Brand Section -->
        <div class="auth-brand">
            <div class="brand-content">
                <div class="brand-logo">
                    <i class="fas fa-bolt"></i> Brandboost
                </div>
                <h2 class="brand-tagline">Amplify your brand presence</h2>
                <p class="brand-description">Join thousands of businesses and influencers who are transforming the digital marketing space.</p>

                <div class="brand-features">
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-check"></i></div>
                        <span>Connect with top-tier influencers</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-check"></i></div>
                        <span>Streamlined campaign management</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-check"></i></div>
                        <span>Real-time analytics and insights</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="auth-form">
            <button class="back-button" onclick="window.location.href='/register'">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Register</span>
            </button>

            <div class="form-header">
                <h1 class="form-title">Create your account</h1>
                <p class="form-subtitle">Register as a <?php echo $data[0] ?> to get started with Brandboost</p>
            </div>

            <form id="registrationForm" method="" action="">
                <input type="hidden" id="role" name="role" value="<?php echo $data[0] ?>" required>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="firstName">First Name</label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-user form-input-icon"></i>
                            <input type="text" id="firstName" name="firstName" class="form-input" placeholder="Enter your first name" required>
                        </div>
                        <div id="firstNameError" class="error-message">Please enter a valid first name</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="lastName">Last Name</label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-user form-input-icon"></i>
                            <input type="text" id="lastName" name="lastName" class="form-input" placeholder="Enter your last name" required>
                        </div>
                        <div id="lastNameError" class="error-message">Please enter a valid last name</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-envelope form-input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com" required>
                    </div>
                    <div id="emailError" class="error-message">Please enter a valid email address</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Phone Number</label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-phone form-input-icon"></i>
                        <input type="tel" id="phone" name="phone" class="form-input" placeholder="+1 (555) 000-0000" required>
                    </div>
                    <div id="phoneError" class="error-message">Please enter a valid phone number</div>
                    <div id="phoneGuidelines" class="guidelines">
                        <div class="guidelines-title">Phone Number Format</div>
                        <ul>
                            <li>Include country code (e.g., +1 for US)</li>
                            <li>Use only numbers, spaces, and these symbols: + - ( )</li>
                            <li>Example: +1 (555) 123-4567</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-lock form-input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Create a strong password" required>
                    </div>
                    <div class="password-strength">
                        <div id="passwordStrengthMeter" class="password-strength-meter"></div>
                    </div>
                    <div id="passwordError" class="error-message">Password doesn't meet the requirements</div>
                    <div id="passwordGuidelines" class="guidelines">
                        <div class="guidelines-title">Password Requirements</div>
                        <ul>
                            <li id="lengthReq">At least 8 characters long</li>
                            <li id="uppercaseReq">At least one uppercase letter</li>
                            <li id="lowercaseReq">At least one lowercase letter</li>
                            <li id="numberReq">At least one number</li>
                            <li id="specialReq">At least one special character (e.g., !@#$%^&*)</li>
                        </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-lock form-input-icon"></i>
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" placeholder="Repeat your password" required>
                    </div>
                    <div id="confirmPasswordError" class="error-message">Passwords do not match</div>
                </div>

                <div class="form-checkbox-group">
                    <input type="checkbox" id="privacy" name="privacy" class="form-checkbox" required>
                    <div>
                        <label for="privacy" class="form-checkbox-label">
                            I agree to the <a href="#" class="form-link">Terms of Service</a> and <a href="#" class="form-link">Privacy Policy</a>
                        </label>
                        <div id="privacyError" class="error-message">You must agree to the terms and privacy policy</div>
                    </div>
                </div>

                <button type="submit" id="submitButton" class="form-submit" disabled>Create Account</button>

                <div class="form-footer">
                    Already have an account? <a href="/login" class="form-link">Sign in</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Get all the form elements
        const form = document.getElementById('registrationForm');
        const firstName = document.getElementById('firstName');
        const lastName = document.getElementById('lastName');
        const email = document.getElementById('email');
        const phone = document.getElementById('phone');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const privacy = document.getElementById('privacy');
        const submitButton = document.getElementById('submitButton');

        // Error message elements
        const firstNameError = document.getElementById('firstNameError');
        const lastNameError = document.getElementById('lastNameError');
        const emailError = document.getElementById('emailError');
        const phoneError = document.getElementById('phoneError');
        const phoneGuidelines = document.getElementById('phoneGuidelines');
        const passwordError = document.getElementById('passwordError');
        const passwordGuidelines = document.getElementById('passwordGuidelines');
        const confirmPasswordError = document.getElementById('confirmPasswordError');
        const privacyError = document.getElementById('privacyError');
        const passwordStrengthMeter = document.getElementById('passwordStrengthMeter');

        // Password requirement elements
        const lengthReq = document.getElementById('lengthReq');
        const uppercaseReq = document.getElementById('uppercaseReq');
        const lowercaseReq = document.getElementById('lowercaseReq');
        const numberReq = document.getElementById('numberReq');
        const specialReq = document.getElementById('specialReq');

        // Validation patterns
        const namePattern = /^[A-Za-z\s'-]{2,50}$/;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const phonePattern = /^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.]?[0-9]{1,3}[-\s\.]?[0-9]{3,4}[-\s\.]?[0-9]{3,4}$/;

        // Password validation patterns
        const lengthPattern = /.{8,}/;
        const uppercasePattern = /[A-Z]/;
        const lowercasePattern = /[a-z]/;
        const numberPattern = /[0-9]/;
        const specialPattern = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        // Track form validation state
        const validationState = {
            firstName: false,
            lastName: false,
            email: false,
            phone: false,
            password: false,
            confirmPassword: false,
            privacy: false
        };

        // Show appropriate guidelines
        phone.addEventListener('focus', () => {
            phoneGuidelines.style.display = 'block';
        });

        password.addEventListener('focus', () => {
            passwordGuidelines.style.display = 'block';
        });

        // Hide guidelines when clicked outside
        document.addEventListener('click', (e) => {
            if (e.target !== phone && e.target !== password) {
                if (!phone.contains(e.target)) {
                    phoneGuidelines.style.display = 'none';
                }
                if (!password.contains(e.target)) {
                    passwordGuidelines.style.display = 'none';
                }
            }
        });

        // First name validation
        firstName.addEventListener('input', validateFirstName);

        function validateFirstName() {
            const isValid = namePattern.test(firstName.value.trim());
            firstName.classList.toggle('error', !isValid && firstName.value.trim() !== '');
            firstName.classList.toggle('valid', isValid);
            firstNameError.style.display = isValid || firstName.value.trim() === '' ? 'none' : 'block';
            validationState.firstName = isValid;
            updateSubmitButton();
            return isValid;
        }

        // Last name validation
        lastName.addEventListener('input', validateLastName);

        function validateLastName() {
            const isValid = namePattern.test(lastName.value.trim());
            lastName.classList.toggle('error', !isValid && lastName.value.trim() !== '');
            lastName.classList.toggle('valid', isValid);
            lastNameError.style.display = isValid || lastName.value.trim() === '' ? 'none' : 'block';
            validationState.lastName = isValid;
            updateSubmitButton();
            return isValid;
        }

        // Email validation
        email.addEventListener('input', validateEmail);

        function validateEmail() {
            const isValid = emailPattern.test(email.value.trim());
            email.classList.toggle('error', !isValid && email.value.trim() !== '');
            email.classList.toggle('valid', isValid);
            emailError.style.display = isValid || email.value.trim() === '' ? 'none' : 'block';
            validationState.email = isValid;
            updateSubmitButton();
            return isValid;
        }

        // Phone validation
        phone.addEventListener('input', validatePhone);

        function validatePhone() {
            const isValid = phonePattern.test(phone.value.trim());
            phone.classList.toggle('error', !isValid && phone.value.trim() !== '');
            phone.classList.toggle('valid', isValid);
            phoneError.style.display = isValid || phone.value.trim() === '' ? 'none' : 'block';
            validationState.phone = isValid;
            updateSubmitButton();
            return isValid;
        }

        // Password validation
        password.addEventListener('input', validatePassword);

        function validatePassword() {
            const passwordValue = password.value;

            // Check individual requirements
            const hasLength = lengthPattern.test(passwordValue);
            const hasUppercase = uppercasePattern.test(passwordValue);
            const hasLowercase = lowercasePattern.test(passwordValue);
            const hasNumber = numberPattern.test(passwordValue);
            const hasSpecial = specialPattern.test(passwordValue);

            // Update visual indicators in guidelines
            lengthReq.style.color = hasLength ? 'var(--success)' : '';
            uppercaseReq.style.color = hasUppercase ? 'var(--success)' : '';
            lowercaseReq.style.color = hasLowercase ? 'var(--success)' : '';
            numberReq.style.color = hasNumber ? 'var(--success)' : '';
            specialReq.style.color = hasSpecial ? 'var(--success)' : '';

            // Calculate password strength (0-5)
            const strength = [hasLength, hasUppercase, hasLowercase, hasNumber, hasSpecial].filter(Boolean).length;

            // Update strength meter
            passwordStrengthMeter.style.width = `${strength * 20}%`;

            if (strength === 0) {
                passwordStrengthMeter.style.backgroundColor = 'var(--gray-300)';
            } else if (strength < 3) {
                passwordStrengthMeter.style.backgroundColor = 'var(--danger)'; // Red - weak
            } else if (strength < 5) {
                passwordStrengthMeter.style.backgroundColor = 'var(--warning)'; // Orange - medium
            } else {
                passwordStrengthMeter.style.backgroundColor = 'var(--success)'; // Green - strong
            }

            // Password is valid if it meets all requirements
            const isValid = hasLength && hasUppercase && hasLowercase && hasNumber && hasSpecial;

            password.classList.toggle('error', !isValid && passwordValue !== '');
            password.classList.toggle('valid', isValid);
            passwordError.style.display = isValid || passwordValue === '' ? 'none' : 'block';
            validationState.password = isValid;

            // If confirm password is already filled, validate it again
            if (confirmPassword.value) {
                validateConfirmPassword();
            }

            updateSubmitButton();
            return isValid;
        }

        // Confirm password validation
        confirmPassword.addEventListener('input', validateConfirmPassword);

        function validateConfirmPassword() {
            const isValid = confirmPassword.value === password.value && confirmPassword.value !== '';
            confirmPassword.classList.toggle('error', !isValid && confirmPassword.value !== '');
            confirmPassword.classList.toggle('valid', isValid);
            confirmPasswordError.style.display = isValid || confirmPassword.value === '' ? 'none' : 'block';
            validationState.confirmPassword = isValid;
            updateSubmitButton();
            return isValid;
        }

        // Privacy checkbox validation
        privacy.addEventListener('change', validatePrivacy);

        function validatePrivacy() {
            const isValid = privacy.checked;
            privacyError.style.display = isValid ? 'none' : 'block';
            validationState.privacy = isValid;
            updateSubmitButton();
            return isValid;
        }

        // Update submit button state
        function updateSubmitButton() {
            const isFormValid = Object.values(validationState).every(Boolean);
            submitButton.disabled = !isFormValid;
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate all fields
            const isFirstNameValid = validateFirstName();
            const isLastNameValid = validateLastName();
            const isEmailValid = validateEmail();
            const isPhoneValid = validatePhone();
            const isPasswordValid = validatePassword();
            const isConfirmPasswordValid = validateConfirmPassword();
            const isPrivacyValid = validatePrivacy();

            // If any field is invalid, stop submission
            if (!isFirstNameValid || !isLastNameValid || !isEmailValid || !isPhoneValid ||
                !isPasswordValid || !isConfirmPasswordValid || !isPrivacyValid) {
                return;
            }

            // Show loading state
            const originalButtonText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Creating Account...';

            // Create data object for submission
            const formData = {
                role: document.getElementById('role').value,
                firstName: firstName.value.trim(),
                lastName: lastName.value.trim(),
                email: email.value.trim(),
                phone: phone.value.trim(),
                password: password.value,
                confirmPassword: confirmPassword.value
            };

            // Send the data using fetch API
            fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'Registration failed');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Success handling
                    window.location.href = `/registration-pending?email=${encodeURIComponent(email.value.trim())}`;
                })
                .catch(error => {
                    // Error handling
                    alert(error.message);
                    submitButton.disabled = false;
                    submitButton.textContent = originalButtonText;
                });
        });
    </script>
</body>

</html>