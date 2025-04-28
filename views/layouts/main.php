<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use app\core\Helpers\AuthHelper;
?>

<!DOCTYPE html>
<html lang="en">
<!-- Previous head content remains the same until body styling -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
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
            padding: 10px 10px 15px;
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
            width: 100%;
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
        
        /* Notification Dropdown Styles */
        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 50px;
            margin-top: 12px;
            width: 320px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .notification-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        .notification-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .notification-count {
            background:rgb(90, 65, 225);
            color: white;
            border-radius: 12px;
            padding: 2px 8px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .notification-list {
            max-height: 320px;
            overflow-y: auto;
        }
        
        .notification-item {
            display: flex;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: background-color 0.2s;
            cursor: pointer;
        }
        
        .notification-item:hover {
            background-color: rgba(65, 105, 225, 0.05);
        }
        
        .notification-item.unread {
            background-color: rgba(65, 105, 225, 0.08);
        }
        
        .notification-icon {
            margin-right: 15px;
            height: 36px;
            width: 36px;
            border-radius: 50%;
            background: rgba(65, 105, 225, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color:rgb(90, 65, 225);
            flex-shrink: 0;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-content p {
            margin: 0;
            font-size: 14px;
            color: #333;
            line-height: 1.4;
        }
        
        .notification-time {
            font-size: 12px;
            color: #888;
            display: block;
            margin-top: 4px;
        }
        
        .notification-footer {
            padding: 12px 20px;
            text-align: center;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        .view-all {
            color: rgb(90, 65, 225);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        
        .view-all:hover {
            opacity: 0.8;
        }
        
        /* Add notification indicator dot */
        #notification-bell {
            position: relative;
        }
        
        #notification-bell:after {
            content: '';
            position: absolute;
            top: 5px;
            right: 6px;
            height: 8px;
            width: 8px;
            background: #FF5252;
            border-radius: 50%;
            border: 2px solid rgba(65, 105, 225, 1);
        }
        
        /* Add scroll styling for notification list */
        .notification-list::-webkit-scrollbar {
            width: 6px;
        }
        
        .notification-list::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
        }
        
        .notification-list::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15);
            border-radius: 3px;
        }
        
        .notification-list::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.25);
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
                            <i class="fas fa-bell header-icon" id="notification-bell" onclick="toggleNotifications()"></i>
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
                                <span class="profile-role"><?php echo $_SESSION['user']['role']; ?></span>
                            </div>
                            <?php if (AuthHelper::getCurrentUser()['role'] != 'admin'): ?>
                                <img src="<?php echo AuthHelper::getCurrentUser()['profile_picture'] ?? '\assets\images\dp-empty.png'; ?>"
                                    alt="User profile picture">
                            <?php endif; ?>
                        </div>
                        <div class="profile-dropdown" id="profile-menu">
                            
                            <a href="/user/<?php echo AuthHelper::getCurrentUser()['user_id'] ?>" class="profile-dropdown-link">
                                My Profile
                            </a>
                            <a href="/<?php echo strtolower($_SESSION['user']['role']); ?>/edit-profile" class="profile-dropdown-link">
                                Edit Profile
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
                        <!-- Add notification dropdown -->
                        <div class="notification-dropdown" id="notification-menu">
                            <div class="notification-header">
                                <h3>Notifications</h3>
                                <span class="notification-count" id="notification-count">0</span>
                            </div>
                            <div class="notification-list" id="notification-list">
                                <!-- Notifications will be loaded dynamically -->
                                <div class="notification-loading">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>
                            <div class="notification-footer">
                                <a href="/notifications" class="view-all">View All Notifications</a>
                            </div>
                        </div>
                        <!-- End notification dropdown -->
                    <?php endif; ?>
                </div>
            </div>

            <script>
                function toggleProfileMenu() {
                    const profileMenu = document.getElementById('profile-menu');
                    profileMenu.classList.toggle('show');
                    // Hide notifications when profile menu is opened
                    document.getElementById('notification-menu')?.classList.remove('show');
                }
                
                function toggleNotifications() {
                    const notificationMenu = document.getElementById('notification-menu');
                    notificationMenu.classList.toggle('show');
                    // Hide profile menu when notifications are opened
                    document.getElementById('profile-menu')?.classList.remove('show');
                    
                    // Mark notifications as read when dropdown is opened
                    if (notificationMenu.classList.contains('show')) {
                        notificationSocket.send(JSON.stringify({
                            type: 'mark_all_read'
                        }));
                    }
                }
            
                // Close dropdowns when clicking outside
                document.addEventListener('click', function(event) {
                    const profile = document.querySelector('.profile');
                    const profileMenu = document.getElementById('profile-menu');
                    const notificationBell = document.getElementById('notification-bell');
                    const notificationMenu = document.getElementById('notification-menu');
            
                    if (!profile?.contains(event.target)) {
                        profileMenu?.classList.remove('show');
                    }
                    
                    if (!notificationBell?.contains(event.target) && !notificationMenu?.contains(event.target)) {
                        notificationMenu?.classList.remove('show');
                    }
                });
                
                // Notification WebSocket Handling
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['user_id'])): ?>
                    let notificationSocket;
                    let notificationRetryCount = 0;
                    const MAX_RETRY_ATTEMPTS = 5;
                    const RETRY_INTERVAL = 3000; // 3 seconds
                    
                    function connectNotificationSocket() {
                        // Connect to the notification WebSocket server
                        notificationSocket = new WebSocket('ws://localhost:8081');
                        
                        notificationSocket.onopen = function() {
                            console.log('Connected to notification server');
                            notificationRetryCount = 0;
                            
                            // Authenticate with the server using user ID or token
                            notificationSocket.send(JSON.stringify({
                                type: 'auth',
                                token: '<?php echo AuthHelper::getCurrentSessionToken(); ?>'
                            }));
                        };
                        
                        notificationSocket.onmessage = function(event) {
                            const data = JSON.parse(event.data);
                            
                            switch(data.type) {
                                case 'auth_required':
                                    // Authentication required
                                    break;
                                    
                                case 'auth_success':
                                    // Successfully authenticated
                                    // Fetch the notifications list
                                    notificationSocket.send(JSON.stringify({
                                        type: 'fetch_notifications'
                                    }));
                                    break;
                                    
                                case 'auth_failed':
                                    // Authentication failed
                                    console.error('Authentication failed with notification server');
                                    break;
                                    
                                case 'notifications_list':
                                    // Received notifications list
                                    renderNotifications(data.notifications);
                                    updateNotificationCounter(data.unread_count);
                                    break;
                                    
                                case 'new_notification':
                                    // New notification received
                                    addNewNotification(data.notification);
                                    playNotificationSound();
                                    showNotificationPopup(data.notification);
                                    break;
                                    
                                case 'notification_marked_read':
                                    // Single notification marked as read
                                    updateNotificationCounter(data.unread_count);
                                    break;
                                    
                                case 'all_notifications_marked_read':
                                    // All notifications marked as read
                                    updateNotificationCounter(0);
                                    break;
                                    
                                case 'error':
                                    console.error('Error from notification server:', data.message);
                                    break;
                            }
                        };
                        
                        notificationSocket.onclose = function(event) {
                            console.log('Disconnected from notification server');
                            
                            // Attempt to reconnect with backoff
                            if (notificationRetryCount < MAX_RETRY_ATTEMPTS) {
                                setTimeout(function() {
                                    notificationRetryCount++;
                                    connectNotificationSocket();
                                }, RETRY_INTERVAL * notificationRetryCount);
                            }
                        };
                        
                        notificationSocket.onerror = function(error) {
                            console.error('WebSocket error:', error);
                        };
                    }
                    
                    // Function to render notifications in the dropdown
                    function renderNotifications(notifications) {
                        const notificationList = document.getElementById('notification-list');
                        
                        if (!notifications || notifications.length === 0) {
                            notificationList.innerHTML = `
                                <div class="notification-empty">
                                    <p>No notifications yet</p>
                                </div>
                            `;
                            return;
                        }
                        
                        // Show max 5 notifications in the header dropdown
                        const recentNotifications = notifications.slice(0, 5);
                        
                        let notificationsHTML = '';
                        
                        recentNotifications.forEach(notification => {
                            const icon = getNotificationIcon(notification.message);
                            
                            notificationsHTML += `
                                <div class="notification-item ${!notification.read ? 'unread' : ''}" data-id="${notification.id}">
                                    <div class="notification-icon">
                                        <i class="fas ${icon}"></i>
                                    </div>
                                    <div class="notification-content">
                                        <p>${notification.message}</p>
                                        <span class="notification-time">${notification.time_ago}</span>
                                    </div>
                                </div>
                            `;
                        });
                        
                        notificationList.innerHTML = notificationsHTML;
                        
                        // Add click handler to mark notifications as read
                        document.querySelectorAll('.notification-item').forEach(item => {
                            item.addEventListener('click', function() {
                                const notificationId = this.dataset.id;
                                
                                // If unread, mark as read
                                if (this.classList.contains('unread')) {
                                    notificationSocket.send(JSON.stringify({
                                        type: 'mark_read',
                                        notification_id: notificationId
                                    }));
                                    
                                    this.classList.remove('unread');
                                }
                            });
                        });
                    }
                    
                    // Function to add a new notification to the top of the list
                    function addNewNotification(notification) {
                        const notificationList = document.getElementById('notification-list');
                        const emptyNotification = notificationList.querySelector('.notification-empty');
                        
                        if (emptyNotification) {
                            notificationList.innerHTML = '';
                        }
                        
                        // Create new notification element
                        const notificationElement = document.createElement('div');
                        notificationElement.className = 'notification-item unread';
                        notificationElement.dataset.id = notification.id;
                        
                        const icon = getNotificationIcon(notification.message);
                        
                        notificationElement.innerHTML = `
                            <div class="notification-icon">
                                <i class="fas ${icon}"></i>
                            </div>
                            <div class="notification-content">
                                <p>${notification.message}</p>
                                <span class="notification-time">${notification.time_ago}</span>
                            </div>
                        `;
                        
                        // Add click handler
                        notificationElement.addEventListener('click', function() {
                            if (this.classList.contains('unread')) {
                                notificationSocket.send(JSON.stringify({
                                    type: 'mark_read',
                                    notification_id: notification.id
                                }));
                                
                                this.classList.remove('unread');
                            }
                        });
                        
                        // Add to the beginning of the list
                        notificationList.insertBefore(notificationElement, notificationList.firstChild);
                        
                        // Remove excess notifications to keep only 5
                        const allNotifications = notificationList.querySelectorAll('.notification-item');
                        if (allNotifications.length > 5) {
                            allNotifications[allNotifications.length - 1].remove();
                        }
                        
                        // Update notification counter
                        updateNotificationCounter(parseInt(document.getElementById('notification-count').textContent || '0') + 1);
                    }
                    
                    // Function to update the notification counter
                    function updateNotificationCounter(count) {
                        const counterElement = document.getElementById('notification-count');
                        const bellIcon = document.getElementById('notification-bell');
                        
                        counterElement.textContent = count;
                        
                        if (count > 0) {
                            // Add notification indicator
                            bellIcon.classList.add('has-notifications');
                            counterElement.style.display = 'inline-block';
                        } else {
                            // Remove notification indicator
                            bellIcon.classList.remove('has-notifications');
                            counterElement.style.display = 'none';
                        }
                    }
                    
                    // Function to determine icon for notification
                    function getNotificationIcon(message) {
                        const lowerMessage = message.toLowerCase();
                        
                        if (lowerMessage.includes('order')) {
                            return 'fa-shopping-bag';
                        } else if (lowerMessage.includes('payment') || lowerMessage.includes('paid') || lowerMessage.includes('payout')) {
                            return 'fa-comment-dollar';
                        } else if (lowerMessage.includes('message') || lowerMessage.includes('chat')) {
                            return 'fa-envelope';
                        } else if (lowerMessage.includes('approved') || lowerMessage.includes('verified')) {
                            return 'fa-check-circle';
                        } else if (lowerMessage.includes('rejected') || lowerMessage.includes('warning')) {
                            return 'fa-exclamation-triangle';
                        } else if (lowerMessage.includes('profile') || lowerMessage.includes('account')) {
                            return 'fa-user';
                        } else if (lowerMessage.includes('custom package') || lowerMessage.includes('package')) {
                            return 'fa-box';
                        } else {
                            return 'fa-bell';
                        }
                    }
                    
                    // Function to play notification sound
                    function playNotificationSound() {
                        // Create an audio element and play a sound
                        const audio = new Audio('/assets/sounds/notification.mp3');
                        audio.volume = 0.5;
                        audio.play().catch(e => {
                            // Browser may block autoplay
                            // console.log('Could not play notification sound', e);
                        });
                    }
                    
                    // Function to show notification popup
                    function showNotificationPopup(notification) {
                        // Only show if notification is not currently open
                        if (!document.getElementById('notification-menu').classList.contains('show')) {
                            // Create popup element
                            const popup = document.createElement('div');
                            popup.className = 'notification-popup';
                            popup.innerHTML = `
                                <div class="notification-popup-content">
                                    <div class="notification-popup-icon">
                                        <i class="fas ${getNotificationIcon(notification.message)}"></i>
                                    </div>
                                    <div class="notification-popup-message">
                                        <p>${notification.message}</p>
                                    </div>
                                </div>
                            `;
                            
                            // Add styles
                            popup.style.position = 'fixed';
                            popup.style.top = '20px';
                            popup.style.right = '20px';
                            popup.style.backgroundColor = 'white';
                            popup.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.15)';
                            popup.style.borderRadius = '10px';
                            popup.style.padding = '15px';
                            popup.style.zIndex = '1000';
                            popup.style.transition = 'all 0.3s ease';
                            popup.style.cursor = 'pointer';
                            popup.style.opacity = '0';
                            popup.style.transform = 'translateY(-20px)';
                            
                            // Style the content
                            const content = popup.querySelector('.notification-popup-content');
                            content.style.display = 'flex';
                            content.style.alignItems = 'center';
                            
                            // Style the icon
                            const iconDiv = popup.querySelector('.notification-popup-icon');
                            iconDiv.style.marginRight = '15px';
                            iconDiv.style.height = '40px';
                            iconDiv.style.width = '40px';
                            iconDiv.style.borderRadius = '50%';
                            iconDiv.style.backgroundColor = 'rgba(65, 105, 225, 0.1)';
                            iconDiv.style.display = 'flex';
                            iconDiv.style.alignItems = 'center';
                            iconDiv.style.justifyContent = 'center';
                            iconDiv.style.color = '#4169E1';
                            
                            // Add to body
                            document.body.appendChild(popup);
                            
                            // Show popup with animation
                            setTimeout(() => {
                                popup.style.opacity = '1';
                                popup.style.transform = 'translateY(0)';
                            }, 100);
                            
                            // Add click handler to open notifications
                            popup.addEventListener('click', () => {
                                toggleNotifications();
                                popup.remove();
                            });
                            
                            // Auto remove after 5 seconds
                            setTimeout(() => {
                                popup.style.opacity = '0';
                                popup.style.transform = 'translateY(-20px)';
                                
                                setTimeout(() => {
                                    popup.remove();
                                }, 300);
                            }, 5000);
                        }
                    }
                    
                    // Connect to notification socket when page loads
                    document.addEventListener('DOMContentLoaded', function() {
                        connectNotificationSocket();
                    });
                <?php endif; ?>
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