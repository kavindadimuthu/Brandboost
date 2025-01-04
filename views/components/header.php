<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            backdrop-filter: blur(10px);
            /* padding: 20px; */
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .container {
            /* This container styles replicted for header class */
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
    </style>
</head>

<body>
    <header class="header">
        <div class="header-content container">
            <div class="logo" onclick="window.location.href='/'">BrandBoost</div>
            <nav class="nav-links">
                <?php

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
        </div>
    </header>
</body>

</html>