<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BrandBoost</title>
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
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }

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
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            background: linear-gradient(45deg, rgba(124, 68, 241, 0.1), rgba(94, 114, 228, 0.1));
            bottom: -100px;
            left: -100px;
            animation: float 10s ease-in-out infinite alternate;
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
            animation: float 6s ease-in-out infinite;
        }

        .shape-2 {
            top: 75%;
            right: 15%;
            animation: float 7s ease-in-out infinite 1s;
        }

        .shape-3 {
            bottom: 20%;
            left: 20%;
            animation: float 8s ease-in-out infinite 2s;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }

        .auth-container {
            width: 100%;
            max-width: 1000px;
            margin: 40px auto;
            display: flex;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            background: var(--white);
            height: calc(100vh - 80px);
            max-height: 650px;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .auth-container:hover {
            box-shadow: 0 20px 40px rgba(50, 50, 93, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .auth-brand {
            flex: 6;
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
            flex: 4;
            padding: 40px;
            display: flex;
            flex-direction: column;
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
            align-self: flex-start;
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

        .form-group {
            margin-bottom: 1.5rem;
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

        .forgot-password {
            display: inline-block;
            font-size: 0.85rem;
            color: var(--primary);
            text-decoration: none;
            margin-top: 0.5rem;
            font-weight: 500;
            align-self: flex-end;
        }

        .forgot-password:hover {
            text-decoration: underline;
            color: var(--primary-dark);
        }

        .form-checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 0.8rem;
            margin-top: 1rem;
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
            margin-top: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .form-submit:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(94, 114, 228, 0.25);
        }

        .form-submit:disabled {
            background-color: var(--gray-300);
            cursor: not-allowed;
        }

        .form-submit::after {
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

        .form-footer {
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray-500);
            margin-top: auto;
            padding-top: 2rem;
        }

        .form-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .form-link:hover {
            text-decoration: underline;
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
                <h2 class="brand-tagline">Welcome back</h2>
                <p class="brand-description">Sign in to continue your journey with BrandBoost. Access your campaigns, analytics, and messages in one place.</p>
                
                <div class="brand-features">
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <span>Real-time performance tracking</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-comments"></i></div>
                        <span>Direct messaging with partners</span>
                    </div>
                    <div class="brand-feature">
                        <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                        <span>Secure and encrypted login</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="auth-form">
            <button class="back-button" onclick="window.location.href='/'">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Home</span>
            </button>

            <div class="form-header">
                <h1 class="form-title">Welcome Back</h1>
                <p class="form-subtitle">Sign in to your BrandBoost account</p>
            </div>

            <form id="loginForm">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-envelope form-input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com" required>
                    </div>
                    <div id="emailError" class="error-message">Please enter a valid email address</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-lock form-input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Enter your password" required>
                    </div>
                    <div id="passwordError" class="error-message">Please enter your password</div>
                    <div id="passwordGuidelines" class="guidelines">
                        <div class="guidelines-title">Password Tips</div>
                        <ul>
                            <li>Make sure caps lock is off</li>
                            <li>Passwords are case sensitive</li>
                            <li>Try using special characters if you're having trouble</li>
                        </ul>
                    </div>
                </div>

                <a href="/forgot-password" class="forgot-password">Forgot password?</a>

                <button type="submit" id="submitButton" class="form-submit">Sign In</button>

                <div class="form-footer">
                    Don't have an account? <a href="/register" class="form-link">Create account</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Get all the form elements
        const form = document.getElementById('loginForm');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const passwordGuidelines = document.getElementById('passwordGuidelines');
        const submitButton = document.getElementById('submitButton');

        // Validation patterns
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        // Track form validation state
        const validationState = {
            email: false,
            password: false
        };

        // Show password guidelines when password field is focused
        password.addEventListener('focus', () => {
            passwordGuidelines.style.display = 'block';
        });

        // Hide guidelines when clicked outside
        document.addEventListener('click', (e) => {
            if (e.target !== password && !password.contains(e.target)) {
                passwordGuidelines.style.display = 'none';
            }
        });

        // Email validation
        email.addEventListener('input', validateEmail);
        email.addEventListener('blur', validateEmail);

        function validateEmail() {
            const isValid = emailPattern.test(email.value.trim());
            email.classList.toggle('error', !isValid && email.value.trim() !== '');
            email.classList.toggle('valid', isValid);
            emailError.style.display = isValid || email.value.trim() === '' ? 'none' : 'block';
            validationState.email = isValid;
            return isValid;
        }

        // Password validation
        password.addEventListener('input', validatePassword);
        password.addEventListener('blur', validatePassword);

        function validatePassword() {
            const isValid = password.value.trim().length >= 1;
            password.classList.toggle('error', !isValid);
            password.classList.toggle('valid', isValid);
            passwordError.style.display = isValid ? 'none' : 'block';
            validationState.password = isValid;
            return isValid;
        }

        // Form submission
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validate all fields
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();

            // If any field is invalid, stop submission
            if (!isEmailValid || !isPasswordValid) {
                return;
            }

            // Show loading state
            const originalButtonText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Signing In...';

            try {
                // Create data object for submission
                const formData = {
                    email: email.value.trim(),
                    password: password.value
                };

                // Send the data using fetch API
                const response = await fetch('/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();
                
                if (!response.ok) {
                    // Handle different error status codes
                    if (response.status === 401) {
                        throw new Error('Invalid email or password');
                    } 
                    if (response.status === 403) {
                        window.location.href = data.redirect || '/account-suspended';
                        throw new Error('Account is inactive or suspended');
                    }
                    
                    // Handle error messages from server
                    throw new Error(data.message || data.error || 'Login failed');
                }
                
                // Success - redirect to dashboard or appropriate page
                window.location.href = data.redirect_url || '/dashboard';
                
            } catch (error) {
                // Display error messages based on error content
                displayErrorMessage(error.message);
            } finally {
                // Reset button state regardless of success/failure
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });

        /**
         * Displays error messages in the appropriate location based on error content
         * @param {string} errorMessage - The error message to display
         */
        function displayErrorMessage(errorMessage) {
            const message = errorMessage.toLowerCase();
            
            // Clear previous errors first
            clearErrorMessages();
            
            if (message.includes('password')) {
                password.classList.add('error');
                passwordError.textContent = errorMessage;
                passwordError.style.display = 'block';
            } else if (message.includes('email')) {
                email.classList.add('error');
                emailError.textContent = errorMessage;
                emailError.style.display = 'block';
            } else {
                // General error using a more user-friendly approach than alert()
                const formContainer = document.querySelector('.auth-form');
                const formHeader = document.querySelector('.form-header');
                
                // Create general error element if it doesn't exist
                let generalError = document.getElementById('generalError');
                if (!generalError) {
                    generalError = document.createElement('div');
                    generalError.id = 'generalError';
                    generalError.className = 'error-message';
                    generalError.style.display = 'block';
                    generalError.style.marginBottom = '1rem';
                    generalError.style.padding = '0.75rem';
                    generalError.style.backgroundColor = 'rgba(245, 54, 92, 0.1)';
                    generalError.style.borderRadius = '5px';
                    formContainer.insertBefore(generalError, formHeader.nextSibling);
                }
                
                generalError.textContent = errorMessage;
            }
        }

        /**
         * Clears all error messages and styling
         */
        function clearErrorMessages() {
            // Reset form field errors
            email.classList.remove('error');
            password.classList.remove('error');
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            
            // Remove general error if it exists
            const generalError = document.getElementById('generalError');
            if (generalError) {
                generalError.style.display = 'none';
            }
        }
    </script>
</body>

</html>