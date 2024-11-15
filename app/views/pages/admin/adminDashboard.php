<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/admin/sidebar.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    
    
</body>
</html> -->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard UI</title>
    <link rel="stylesheet" href="../../styles/admin/dashboard.css">
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <script src="../../scripts/admin/dashboard.js"></script>

</head>
<body>
    <div class="container">
        <div id="sidebar-container">
            <!-- <div id="sidebar"></div> -->
                 <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>

        </div>
        <div class="main-content">
            <h1>Dashboard</h1>
    
            <!-- Main content here -->
            <div class="stats">
                <div class="influencers">
                    <h2>Influencers</h2>
                    <p>0</p>
                    <p>0%</p>
                </div>
                <div class="designers">
                    <h2>Designers</h2>
                    <p>0</p>
                    <p>0%</p>
                </div>
                <div class="businesses">
                    <h2>Businesses</h2>
                    <p>0</p>
                    <p>0%</p>
                </div>
            </div>
    
            <div class="chart">
                <h2>Statistics</h2>
                <div width="600" height="300">
                    <div class="bar-chart">
            
                    </div>
                    <div class="identify">
                        <div class="influencer-identity-outer">
                            <div class="influencer-identity" ></div>
                            <div class="influencer-name">Influencer orders</div>
                        </div>
                        <div class="designer-identity-outer">
                            <div class="designer-identity" ></div>
                            <div class="designer-name">Designer orders</div>
                        </div>
            
                    </div>
                </div>
            </div>
    
            <div class="customer-complaints">
                <h2>Customer Complaints</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Date</th>
                            <th>Complaint</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    
        <!-- New right-side column for registered users -->
        <div class="right-sidebar">



            <div class="registered-users">
                <h2>Registered Users</h2>
                <div width="300" height="300">
                    <div id="user2"></div>
                    <!-- <div class="user">
                        <div class="user-img">
                            <img src="../../assets/user_logo.png" alt="user">
                        </div>
                        <div class="description">
                            <h3>John Doe</h3>
                            <p>Lorem ipsum dolor sit, amet consectetur </p>
                        </div>
                    </div>

                    <div class="user">
                        <div class="user-img">
                            <img src="../../assets/user_logo.png" alt="user">
                        </div>
                        <div class="description">
                            <h3>John Doe</h3>
                            <p>Lorem ipsum dolor sit, amet consectetur </p>
                        </div>
                    </div>

                    <div class="user">
                        <div class="user-img">
                            <img src="../../assets/user_logo.png" alt="user">
                        </div>
                        <div class="description">
                            <h3>John Doe</h3>
                            <p>Lorem ipsum dolor sit, amet consectetur </p>
                        </div>
                    </div> -->
                    
                </div>
            </div>

            
        </div>
    </div>
    

   
</body>
</html>
