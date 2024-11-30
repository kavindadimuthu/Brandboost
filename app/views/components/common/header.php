<header>
    <div class="wrapper">
        <div class="header-logo">
            <img src="../../assets/images/sample-logo.png" alt="">
            <span>Brandboost</span>
        </div>
        <nav class="header-nav-links">
            <ul class="nav-list">
                <?php
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'businessman'){
                        echo '
                        <li class="nav-list-item" data-tab="about"><a
                            href="http://localhost:8000/BusinessViewController/viewInfluencers">Influencers</a></li>
                        <li class="nav-list-item" data-tab="services"><a
                            href="http://localhost:8000/BusinessViewController/viewDesigners">Designers</a></li>
                        <li class="nav-list-item" data-tab="contact"><a
                            href="http://localhost:8000/BusinessViewController/myOrders">Orders</a></li>
                        ';
                    }
                    else if(isset($_SESSION['role']) && $_SESSION['role'] == 'influencer'){
                        echo '
                        <li class="nav-list-item" data-tab="Dashboard"><a
                            href="http://localhost:8000/InfluencerViewController/influencerDashboard">Dashboard</a></li>
                        <li class="nav-list-item" data-tab="Orders"><a
                            href="http://localhost:8000/InfluencerViewController/AllOrders">Orders</a></li>
                        <li class="nav-list-item" data-tab="Promotions"><a
                            href="http://localhost:8000/InfluencerViewController/influencerPromotions">Promotions</a></li>
                        <li class="nav-list-item" data-tab="contact"><a
                            href="http://localhost:8000/InfluencerViewController/earnings">Earnings</a></li>
                        ';
                    }
                    else if(isset($_SESSION['role']) && $_SESSION['role'] == 'designer'){
                        echo '
                        <li class="nav-list-item" data-tab="Dashboard"><a
                            href="http://localhost:8000/DesignerViewController/designerDashboard">Dashboard</a></li>
                        <li class="nav-list-item" data-tab="Gigs"><a
                            href="http://localhost:8000/DesignerViewController/designerGigs">Gigs</a></li>
                        <li class="nav-list-item" data-tab="Orders"><a
                            href="http://localhost:8000/DesignerViewController/allOrders">Orders</a></li>
                        <li class="nav-list-item" data-tab="Earnings"><a
                            href="http://localhost:8000/DesignerViewController/earnings">Earnings</a></li>
                        ';
                    }
                ?>
            </ul>
        </nav>
        <div class="header-icons">
            <div class="chat-icon" onclick="window.location.href='/InfluencerViewController/chat'">
                <img src="../../assets/chat-icon.svg" alt="chat">
            </div>
            <div class="notification-icon">
                <img src="../../assets/notification.svg" alt="notifi">
            </div>
            <div class="user-icon">
                <img src="../../assets/user-icon.svg" alt="User Icon">
                <div class="popup">
                    <ul>
                        <li><span>
                            <?php 
                                echo $_SESSION['user_name'];
                            ?>
                        </span></li>
                        <li><a href="http://localhost:8000/<?php echo $_SESSION['role']?>ViewController/profile">Profile</a></li>
                        <li><a href="http://localhost:8000/LoginController/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>