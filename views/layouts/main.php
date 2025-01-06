<!DOCTYPE html>
<html lang="en">
<!-- Previous head content remains the same until body styling -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
            scroll-behavior: smooth;
        }

        html,
        body {
            height: 100%;
            /* overflow-x: hidden; */
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: white!important;
        }

        main {
            flex: 1;
            margin-top: 70px;
            /* Add spacing below fixed header */
        }

        /* Rest of the existing button styles remain the same */

        .header-btn {
            background: white;
            color: #4169E1;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 6px 18px;
            font-size: 14px;
            margin-left: 0.2rem;
        }

        .header-btn:hover,
        .header-btn-mini:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .cta-button {
            padding: 15px 35px;
            font-size: 18px;
        }

        .cta-button-mini {
            padding: 5px 20px;
            font-size: 16px;
            /* background-color: red; */
        }

        .cta-button:hover,
        .cta-button-mini:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .secondary-button {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .secondary-button:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            backdrop-filter: blur(10px);
            padding: 15px;
            position: fixed;
            width: 100%;
            height: 70px;
            display: flex;
            align-items: center;
            top: 0;
            z-index: 10;
            transition: all 0.3s ease;
        }
        .header-content{
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 20px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }

        /* .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        } */

        .header.scrolled {
            padding: 15px;
        }

        .header-content,
        .navigations,
        .nav-icons {
            /* width: 100%; */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            cursor: pointer;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
            background:rgba(37, 37, 37, 0.34);
            background:rgba(150, 150, 150, 0.25);
            padding: 8px 40px;
            border-radius: 15px;

            position: absolute;
            z-index: 100;
            left: 50%;
            transform: translateX(-50%);

        }
        .nav-links:hover{
            background:rgba(37, 37, 37, 0.34);
            background:rgba(150, 150, 150, 0.25);
            /* scale: 1.01; */
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .auth-buttons{
            margin-left: 10px;
        }

        /* Add these styles in the head section, alongside other existing styles */

        /* Profile Section Styles */
        .profile {
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 12px;
            transition: all 0.3s ease;
            color: white;
        }

        .profile:hover {
            background: rgba(255, 255, 255, 0.1);
            cursor: pointer;
        }

        .profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .profile-info {
            margin-right: 10px;
            min-width: 30px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .profile-username {
            font-size: 14px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.9);
        }

        .profile-role {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Icons Styles */
        .header-icons {
            display: flex;
            align-items: center;
            gap: 5px;
            margin: 0 10px 0 30px;
        }

        .header-icon {
            color: rgba(255, 255, 255, 0.9);
            font-size: 18px;
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .header-icon:hover {
            color: white;
            background:rgba(212, 212, 212, 0.25);
            /* transform: scale(1.05); */
        }

        /* Dropdown Menu Styles */
        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 12px;
            padding: 10px 0 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* background:rgba(255, 255, 255, 0.98); */
            background: rgba(65, 105, 225, 1);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            min-width: 140px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .profile-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown-link {
            display: flex;
            align-items: center;
            width: 90%;
            text-align: center;
            padding: 8px 10px;
            border-radius: 15px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.1s ease;
        }

        .profile-dropdown-link:hover {
            color: #4169E1;
            background: #f5f5f5;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .header-icons {
                margin-right: 16px;
            }

            .profile-username {
                display: none;
            }

            .profile-role {
                display: none;
            }
        }

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 80px 20px 30px;
            margin-top: auto;
            /* This pushes the footer to the bottom */
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .footer-section {
            flex: 1;
            padding: 0 20px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #999;
            text-decoration: none;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
            opacity: 1;
            transform: translateX(5px);
        }

        .footer-bottom {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #333;
            color: #999;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Media Query for Responsive Footer */
        @media (max-width: 768px) {
            .footer-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-section {
                padding: 0;
            }

            .footer-links a:hover {
                transform: none;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="logo" onclick="window.location.href='/'">BrandBoost</div>
            <div class="navigations">
                <nav class="nav-links">
                    <?php

                    if (!isset($_SESSION['user']['role'])) {
                        echo '
                        <a href="/services">Services</a>
                        <a href="/influencers">Influencers</a>
                        <a href="/about">About</a>
                        <a href="/faq">Faq</a>
                        <a href="/contact">Contact</a>
                        
                    ';
                    } else if ($_SESSION['user']['role'] === 'businessman') {
                        echo '
                        <a href="/services">Services</a>
                        <a href="/influencers">Influencers</a>
                        <a href="/businessman/orders-list">Orders</a>
                        <a href="/businessman/custom-packages">Custom Packages</a>
                    ';
                    } else if ($_SESSION['user']['role'] === 'influencer') {
                        echo '
                        <a href="/influencer/dashboard">Dashboard</a>
                        <a href="/influencer/my-promotions">My Promotions</a>
                        <a href="/influencer/orders-list">Orders</a>
                        <a href="/influencer/custom-packages">Custom Packages</a>
                        <a href="/influencer/earnings">Earnings</a>
                    ';
                    } else if ($_SESSION['user']['role'] === 'designer') {
                        echo '
                        <a href="/designer/dashboard">Dashboard</a>
                        <a href="/designer/my-gigs">My Gigs</a>
                        <a href="/designer/orders-list">Orders</a>
                        <a href="/designer/custom-packages">Custom Packages</a>
                        <a href="/designer/earnings">Earnings</a>
                    ';
                    }
                    ?>
                </nav>
                <div class="nav-icons">
                    <?php if (!isset($_SESSION['user']['role'])): ?>
                        <div class="auth-buttons">
                            <button class="header-btn log-btn" onclick="window.location.href=`/register`">Sign Up</button>
                            <button class="header-btn signup-btn" onclick="window.location.href=`/login`">Login</button>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user']['role']) && isset($_SESSION['user']['username'])): ?>
                        <div class="header-icons">
                            <i class="fas fa-bell header-icon"></i>
                            <i class="fas fa-comments header-icon" onclick="window.location.href='/chat'"></i>
                        </div>
                        <div class="profile" onclick="toggleProfileMenu()">
                            <div class="profile-info">
                                <span class="profile-username">
                                    <?php
                                    $username = $_SESSION['user']['username'];
                                    $firstname = explode(' ', $username)[0];
                                    echo $firstname;
                                    ?>
                                </span>
                                <!-- <span class="profile-role"><?php echo $_SESSION['user']['role']; ?></span> -->
                            </div>
                            <img src="<?php echo $_SESSION['user']['profile_picture'] ?? 'https://storage.googleapis.com/a1aa/image/BVZIkfG5F3XHY60sFbAWhIslKzm9KR8eUunlaCcIJfA5e6oPB.jpg'; ?>"
                                alt="User profile picture">
                        </div>
                        <div class="profile-dropdown" id="profile-menu">
                            <a href="/<?php echo strtolower($_SESSION['user']['role']); ?>/edit-profile" class="profile-dropdown-link">
                                Change Profile
                            </a>
                            <a href="/<?php echo strtolower($_SESSION['user']['role']); ?>/change-password" class="profile-dropdown-link">
                                Change Password
                            </a>
                            <?php if ($_SESSION['user']['role'] === 'designer' || $_SESSION['user']['role'] === 'influencer'): ?>
                                <a href="/<?php echo strtolower($_SESSION['user']['role']); ?>/payout-methods" class="profile-dropdown-link">
                                    Payout Methods
                                </a>
                            <?php endif; ?>
                            <a href="/auth/logout" class="profile-dropdown-link">Logout</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <script>
                function toggleProfileMenu() {
                    const profileMenu = document.getElementById('profile-menu');
                    profileMenu.classList.toggle('show');
                }

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    const profile = document.querySelector('.profile');
                    const profileMenu = document.getElementById('profile-menu');

                    if (!profile?.contains(event.target)) {
                        profileMenu?.classList.remove('show');
                    }
                });
            </script>
        </div>

    </header>

    <main>
        <!-- Inject dynamic content -->
        <?php echo $content ?>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Company</h3>
                <ul class="footer-links">
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="#">Press</a></li>
                    <li><a href="/faq">Faqs</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul class="footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Safety</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Resources</h3>
                <ul class="footer-links">
                    <li><a href="#">Guidelines</a></li>
                    <li><a href="#">Partner Program</a></li>
                    <li><a href="#">Developers</a></li>
                    <li><a href="#">Community</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 BrandBoost. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>