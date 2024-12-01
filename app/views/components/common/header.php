<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Top Header Navigation Bar Styles Begin */
        .top-nav {
            width: 100%;
            background: linear-gradient(135deg, #6201A9 0%, #6a11cb 100%);
            color: #fff;
            padding: 14px 30px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .top-nav .logo {
            font-size: 20px;
            font-weight: 700;
        }

        .top-nav .nav-links {
            display: flex;
            align-items: center;
        }

        .top-nav .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 15px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .top-nav .nav-links a:hover {
            color: #ddd;
        }

        .top-nav .profile-group {
            display: flex;
            align-items: center;
            position: relative;
        }

        .top-nav .profile-group .icons {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }

        .top-nav .profile-group .icons i {
            font-size: 18px;
            margin-left: 15px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .top-nav .profile-group .icons i:hover {
            color: #ddd;
        }

        .top-nav .profile-group .profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .top-nav .profile-group .profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .top-nav .profile-group .profile .name {
            font-size: 14px;
            font-weight: 600;
        }

        .top-nav .profile-group .profile .role {
            font-size: 12px;
            color: #ddd;
        }

        .top-nav .profile-group .profile-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff;
            color: #333;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1001;
        }

        .top-nav .profile-group .profile-menu a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }

        .top-nav .profile-group .profile-menu a:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="top-nav">
        <div class="logo">
            Brand Boost
        </div>
        <div class="nav-links">

            <?php
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'businessman'){
                        echo '
                        <a href="http://localhost:8000/BusinessViewController/viewInfluencers">Influencers</a>
                        <a href="http://localhost:8000/BusinessViewController/AllOrders">Designers</a>
                        <a href="http://localhost:8000/BusinessViewController/myOrders">Orders</a>
                        <a href="http://localhost:8000/BusinessViewController/viewInfluencers">Verifications</a>
                        <a href="http://localhost:8000/BusinessViewController/viewInfluencers">FAQ</a>
                        ';
                    }
                    else if(isset($_SESSION['role']) && $_SESSION['role'] == 'influencer'){
                        echo '
                        <a href="http://localhost:8000/InfluencerViewController/influencerDashboard">Dashboard</a>
                        <a href="http://localhost:8000/InfluencerViewController/AllOrders">Orders</a>
                        <a href="http://localhost:8000/InfluencerViewController/influencerPackages">Promotions</a>
                        <a href="http://localhost:8000/InfluencerViewController/earnings">Earnings</a>
                        <a href="http://localhost:8000/InfluencerViewController/viewAllFaqs">FAQ</a>
                        ';
                    }
                    else if(isset($_SESSION['role']) && $_SESSION['role'] == 'designer'){
                        echo '
                        <a href="http://localhost:8000/DesignerViewController/designerDashboard">Dashboard</a>
                        <a href="http://localhost:8000/DesignerViewController/designerGigs">Gigs</a>
                        <a href="http://localhost:8000/DesignerViewController/allOrders">Orders</a>
                        <a href="http://localhost:8000/DesignerViewController/earnings">Earnings</a>
                        <a href="http://localhost:8000/DesignerViewController/viewAllFaqs">FAQ</a>
                        ';
                    }
                ?>
        </div>
        <div class="profile-group">
            <div class="icons">
                <i class="fas fa-bell"></i>
                <i class="fas fa-comments"></i>
            </div>
            <div class="profile" onclick="toggleProfileMenu()">
                <img alt="User profile picture" height="35" src="https://storage.googleapis.com/a1aa/image/f4Xi8aW22b1PRSBffeuGrxtSCAKTfzHz8ph7lhKJeGeL2bB7JA.jpg" width="35"/>
                <div>
                    <div class="name">
                        <?php echo $_SESSION['user_name']; ?>
                    </div>
                    <div class="role">
                        <?php echo $_SESSION['role']; ?>
                    </div>
                </div>
            </div>
            <div class="profile-menu" id="profile-menu">
                <a href="http://localhost:8000/<?php echo $_SESSION['role']?>ViewController/profile">Profile</a>
                <a href="http://localhost:8000/logincontroller/logout">Logout</a>
            </div>
        </div>
    </div>

    <script>
        function toggleProfileMenu() {
            const profileMenu = document.getElementById('profile-menu');
            profileMenu.style.display = profileMenu.style.display === 'block' ? 'none' : 'block';
        }

        // Close the profile menu if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.profile') && !event.target.matches('.profile *')) {
                const profileMenu = document.getElementById('profile-menu');
                if (profileMenu.style.display === 'block') {
                    profileMenu.style.display = 'none';
                }
            }
        }
    </script>
</body>