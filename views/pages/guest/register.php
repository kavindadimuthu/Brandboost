<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Brandboost</title>
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
            justify-content: center;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .page-header p {
            font-size: 1.1rem;
            color: var(--gray-600);
            max-width: 600px;
            margin: 0 auto;
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
            gap: 10px;
            text-decoration: none;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .role-selection {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 50px;
        }

        .role-card {
            width: 290px;
            border-radius: var(--border-radius);
            overflow: hidden;
            background: var(--white);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: 1px solid var(--gray-200);
            cursor: pointer;
        }

        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }

        .role-image {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .role-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .role-card:hover .role-image img {
            transform: scale(1.05);
        }

        .role-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 50%, rgba(0, 0, 0, 0.5));
        }

        .role-content {
            padding: 25px;
            text-align: center;
        }

        .role-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 12px;
            color: var(--gray-700);
        }

        .role-description {
            font-size: 0.95rem;
            color: var(--gray-500);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
            width: 100%;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 10px rgba(94, 114, 228, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(94, 114, 228, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
        }

        .card-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(94, 114, 228, 0.9);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 20px;
            z-index: 1;
        }

        /* Footer link */
        .footer-link {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: var(--gray-500);
        }

        .footer-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
        }

        .role-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .role-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .role-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .role-selection {
                flex-wrap: wrap;
            }
            
            .role-card {
                width: 280px;
            }
        }

        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }
            
            .role-card {
                width: 100%;
                max-width: 320px;
            }
        }

        @media (max-width: 480px) {
            .logo {
                position: relative;
                top: auto;
                left: auto;
                justify-content: center;
                margin: 30px 0;
            }
            
            .page-header {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>
    <a href="/" class="logo">
        <i class="fas fa-bolt"></i>
        <span>BrandBoost</span>
    </a>

    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-user-plus"></i> Join BrandBoost</h1>
            <p>Select your role to register and start growing your brand or career today</p>
        </div>

        <div class="role-selection">
            <div class="role-card fade-in-up" onclick="window.location.href='/register/businessman'">
                <div class="role-image">
                    <div class="card-badge">Popular</div>
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Business Owner">
                </div>
                <div class="role-content">
                    <h3 class="role-title">Business Owner</h3>
                    <p class="role-description">Find the perfect influencers to promote your products and boost your brand awareness.</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-briefcase"></i> Register as Business
                    </button>
                </div>
            </div>

            <div class="role-card fade-in-up" onclick="window.location.href='/register/influencer'">
                <div class="role-image">
                    <img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Influencer">
                </div>
                <div class="role-content">
                    <h3 class="role-title">Influencer</h3>
                    <p class="role-description">Connect with brands, create sponsored content, and monetize your social media presence.</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-star"></i> Register as Influencer
                    </button>
                </div>
            </div>

            <div class="role-card fade-in-up" onclick="window.location.href='/register/designer'">
                <div class="role-image">
                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Designer">
                </div>
                <div class="role-content">
                    <h3 class="role-title">Designer</h3>
                    <p class="role-description">Showcase your design skills and collaborate with brands on creative projects.</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-paint-brush"></i> Register as Designer
                    </button>
                </div>
            </div>
        </div>

        <div class="footer-link">
            Already have an account? <a href="/login">Log in here</a>
        </div>
    </div>
</body>

</html>