<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        /* Button Styles */
        .cta-button,
        .cta-button-mini {
            background: white;
            color: #4169E1;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .cta-button {
            padding: 15px 35px;
            font-size: 18px;
        }

        .cta-button-mini {
            padding: 10px 20px;
            font-size: 16px;
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
            padding: 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        .container { /* This container styles replicted for header class */
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }

        .header.scrolled {
            padding: 15px;
        }

        .header-content {
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
            gap: 40px;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
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

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            padding: 80px 20px 30px;
            position: relative;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
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
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-content container">
            <div class="logo" onclick="window.location.href='/'">BrandBoost</div>
            <nav class="nav-links">
            <?php

            use app\core\BaseController;
            use app\core\Helpers\AuthHelper;

            if (!isset($_SESSION['user']['role'])) {
                echo '
                    <a href="/services">Services</a>
                    <a href="/about">About</a>
                    <a href="/faq">Faq</a>
                    <a href="/contact">Contact</a>
                    <button class="cta-button-mini" onclick="window.location.href=`/register`">Sign Up</button>
                    <button class="cta-button-mini" onclick="window.location.href=`/login`">Login</button>
                ';
            } else if ($_SESSION['user']['role'] === 'businessman') {
                echo '
                    <a href="/services">Services</a>
                    <a href="/influencers">Influencers</a>
                    <a href="/businessman/orders-list">Orders</a>
                    <a href="/businessman/custom-packages">Custom Packages</a>
                    <button class="cta-button-mini" onclick="window.location.href=`/auth/logout`">Logout</button>
                ';
            } else if ($_SESSION['user']['role'] === 'influencer') {
                echo '
                    <a href="/influencer/dashboard">Dashboard</a>
                    <a href="/influencer/my-promotions">My Promotions</a>
                    <a href="/influencer/orders-list">Orders</a>
                    <a href="/influencer/custom-packages">Custom Packages</a>
                    <a href="/influencer/earnings">Earnings</a>
                    <button class="cta-button-mini" onclick="window.location.href=`/auth/logout`">Logout</button>
                ';
            } else if ($_SESSION['user']['role'] === 'designer') {
                echo '
                    <a href="/designer/dashboard">Dashboard</a>
                    <a href="/designer/my-gigs">My Gigs</a>
                    <a href="/designer/orders-list">Orders</a>
                    <a href="/designer/custom-packages">Custom Packages</a>
                    <a href="/designer/earnings">Earnings</a>
                    <button class="cta-button-mini" onclick="window.location.href=`/auth/logout`">Logout</button>
                ';
            }
            ?>
            </nav>
        </div>
    </header>

    <main>
        <!-- Inject dynamic content -->
        <?php echo $content ?>
    </main>

    <footer class="footer">
        <div class="container">
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
        </div>
    </footer>
</body>

</html> -->