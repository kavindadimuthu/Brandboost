<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <style>
         * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
    
        /* main {
            width: 100%;
            height: 100vh;
            background-color: #f4f4f4;
            float: left;
            padding: 20px;
        } */

        .container {
            display: flex;
            width: 100%;
            height: 100vh;
            background-color: #f4f4f4;
            float: left;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s;
            background-color: #f0f0f0;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            font-size: 14px;
        }

        .main-content {
            background-color: #fff;
            border-radius: 20px;
            /* Add curvature */
            padding: 24px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 8px;
            /* Add gap between sidebar and main content */
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header .welcome {
            font-size: 24px;
            font-weight: 600;
        }

        .header .notifications {
            font-size: 14px;
            color: #888;
        }

        .header .profile {
            display: flex;
            align-items: center;
        }

        .header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .header .profile .name {
            font-size: 16px;
            font-weight: 600;
        }

        .header .profile .role {
            font-size: 14px;
            color: #888;
        }

        /* Added styles for collapsed state */
        body.sidebar-collapsed .content {
            margin-left: 100px;
        }
    </style>
</head>
<body>
    <nav>
        <?php include __DIR__ . '../../components/admin/sideNavbar.php'; ?>
    </nav>

    <!-- <main> -->
        <div class="container">
            <div class="content">
                <div class="main-content">
                    <div class="header">
                        <div class="breadcrumb">
                            Admin &gt; Dashboard
                        </div>
                        <div class="user-info">
                            <img alt="User profile picture" height="30"
                                src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                                width="30" />
                            <span><?php echo $_SESSION['user_name']; ?></span>
                        </div>
                    </div>

                    <?php echo $content ?>

                </div>
            </div>
        </div>
    <!-- </main> -->
</body>
</html>