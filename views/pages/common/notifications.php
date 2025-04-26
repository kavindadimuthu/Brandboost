<?php
/**
 * Notifications page to display and manage all user notifications
 * 
 * @var array $user The current authenticated user data
 */
$user = \app\core\Helpers\AuthHelper::getCurrentUser();
?>

<div class="notifications-page">
    <div class="notifications-container">
        <!-- Header with title and mark all read button -->
        <div class="notifications-header">
            <h1>Notifications</h1>
            <div class="notifications-actions">
                <button id="mark-all-read" class="btn-mark-all">Mark All as Read</button>
            </div>
        </div>
        
        <!-- Filter tabs for all/unread notifications -->
        <div class="notifications-filter">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="unread">Unread</button>
        </div>
        
        <!-- Container for notification items -->
        <div class="notifications-list" id="notifications-list">
            <div class="loading-spinner">
                <i class="fas fa-spinner fa-spin"></i>
                <span>Loading notifications...</span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Main container styling */
    .notifications-page {
        padding: 30px 0;
    }
    
    .notifications-container {
        max-width: 1200px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        padding: 30px 3%;

    }
    
    /* Header styling */
    .notifications-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        /* border-bottom: 1px solid rgba(0, 0, 0, 0.1); */
    }
    
    .notifications-header h1 {
        font-size: 24px;
        color: #333;
        margin: 0;
    }
    
    /* Mark all as read button */
    .btn-mark-all {
        background: rgba(65, 105, 225, 0.1);
        color: #4169E1;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .btn-mark-all:hover {
        background: rgba(65, 105, 225, 0.2);
    }
    
    /* Filter tabs styling */
    .notifications-filter {
        display: flex;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.07);
        padding-bottom: 10px;
    }
    
    .filter-btn {
        background: transparent;
        border: none;
        padding: 8px 15px;
        margin-right: 10px;
        border-radius: 5px;
        cursor: pointer;
        color: #666;
        font-weight: 500;
    }
    
    .filter-btn.active {
        background: rgba(65, 105, 225, 0.1);
        color: #4169E1;
    }
    
    /* Notifications list container */
    .notifications-list {
        min-height: 300px;
    }
    
    /* Individual notification item styling */
    .notification-item {
        display: flex;
        padding: 15px;
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
    
    .notification-item.unread .notification-marker {
        display: block;
    }
    
    /* Notification icon styling */
    .notification-icon {
        margin-right: 15px;
        height: 40px;
        width: 40px;
        border-radius: 50%;
        background: rgba(65, 105, 225, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4169E1;
        flex-shrink: 0;
        position: relative;
    }
    
    /* Red dot marker for unread notifications */
    .notification-marker {
        position: absolute;
        top: -2px;
        right: -2px;
        height: 12px;
        width: 12px;
        background: #FF5252;
        border-radius: 50%;
        border: 2px solid white;
        display: none;
    }
    
    /* Notification content styling */
    .notification-content {
        flex: 1;
    }
    
    .notification-message {
        margin: 0;
        font-size: 15px;
        color: #333;
        line-height: 1.4;
    }
    
    .notification-details {
        margin: 5px 0 0;
        font-size: 14px;
        color: #666;
        line-height: 1.3;
    }
    
    .notification-time {
        font-size: 12px;
        color: #888;
        display: block;
        margin-top: 5px;
    }
    
    /* Empty state styling */
    .empty-notifications {
        padding: 30px;
        text-align: center;
        color: #777;
    }
    
    .empty-notifications i {
        font-size: 40px;
        margin-bottom: 15px;
        color: #ccc;
    }
    
    /* Loading spinner styling */
    .loading-spinner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 50px 0;
        color: #777;
    }
    
    .loading-spinner i {
        font-size: 30px;
        margin-bottom: 15px;
        color: #4169E1;
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .notifications-container {
            padding: 15px;
            border-radius: 0;
            box-shadow: none;
        }
        
        .notifications-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .notifications-actions {
            margin-top: 15px;
        }
        
        .notification-item {
            padding: 12px 10px;
        }
        
        .notification-icon {
            height: 36px;
            width: 36px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DOM element references
        const notificationsList = document.getElementById('notifications-list');
        const markAllReadBtn = document.getElementById('mark-all-read');
        const filterButtons = document.querySelectorAll('.filter-btn');
        
        // Current state
        let currentFilter = 'all';
        
        // Load notifications when the page loads
        loadNotifications();
        
        /**
         * Event handler for filter buttons
         * Allows switching between all and unread notifications
         */
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Update filter and reload
                currentFilter = this.dataset.filter;
                loadNotifications();
            });
        });
        
        /**
         * Event handler for "Mark All as Read" button
         * Sends an API request to mark all notifications as read
         */
        markAllReadBtn.addEventListener('click', function() {
            fetch('/api/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload notifications
                    loadNotifications();
                    
                    // Update notification counter in header
                    updateHeaderNotificationCounter(0);
                }
            })
            .catch(error => {
                console.error('Error marking all notifications as read:', error);
            });
        });
        
        /**
         * Loads notifications from the API based on current filter
         */
        function loadNotifications() {
            // Show loading spinner
            notificationsList.innerHTML = `
                <div class="loading-spinner">
                    <i class="fas fa-spinner fa-spin"></i>
                    <span>Loading notifications...</span>
                </div>
            `;
            
            // Prepare URL with query parameters
            let url = '/api/notifications';
            if (currentFilter === 'unread') {
                url += '?filter=unread';
            }
            
            // Fetch notifications from API
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        renderNotifications(data.notifications);
                    } else {
                        notificationsList.innerHTML = `
                            <div class="empty-notifications">
                                <i class="fas fa-exclamation-circle"></i>
                                <p>Failed to load notifications. Please try again.</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Error fetching notifications:', error);
                    notificationsList.innerHTML = `
                        <div class="empty-notifications">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>An error occurred while loading notifications.</p>
                        </div>
                    `;
                });
        }
        
        /**
         * Renders the notifications list in the UI
         * @param {Array} notifications - Array of notification objects
         */
        function renderNotifications(notifications) {
            if (!notifications || notifications.length === 0) {
                notificationsList.innerHTML = `
                    <div class="empty-notifications">
                        <i class="fas fa-bell-slash"></i>
                        <p>You don't have any notifications yet.</p>
                    </div>
                `;
                return;
            }
            
            notificationsList.innerHTML = notifications.map(notification => `
                <div class="notification-item ${notification.read_status === 'unread' ? 'unread' : ''}" data-id="${notification.id}">
                    <div class="notification-icon">
                        <i class="fas ${notification.icon}"></i>
                        ${notification.read_status === 'unread' ? '<span class="notification-marker"></span>' : ''}
                    </div>
                    <div class="notification-content">
                        <p class="notification-message">${notification.message}</p>
                        ${notification.details ? `<p class="notification-details">${notification.details}</p>` : ''}
                        <span class="notification-time">${notification.time_ago}</span>
                    </div>
                </div>
            `).join('');
            
            // Add click event listeners to mark notifications as read
            document.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', function() {
                    const notificationId = this.dataset.id;
                    const isUnread = this.classList.contains('unread');
                    
                    if (isUnread) {
                        markNotificationAsRead(notificationId);
                    }
                });
            });
        }
        
        /**
         * Marks a single notification as read
         * @param {string} notificationId - ID of the notification to mark as read
         */
        function markNotificationAsRead(notificationId) {
            fetch('/api/notifications/mark-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ notification_id: notificationId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI to show notification as read
                    const notificationElement = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
                    if (notificationElement) {
                        notificationElement.classList.remove('unread');
                        notificationElement.querySelector('.notification-marker')?.remove();
                    }
                    
                    // Update unread count in header
                    updateUnreadCounter();
                }
            })
            .catch(error => {
                console.error('Error marking notification as read:', error);
            });
        }
        
        /**
         * Updates the unread notification counter in the header
         */
        function updateUnreadCounter() {
            fetch('/api/notifications/unread-count')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateHeaderNotificationCounter(data.unreadCount);
                    }
                })
                .catch(error => {
                    console.error('Error fetching unread count:', error);
                });
        }
        
        /**
         * Updates the notification counter in the header
         * @param {number} count - Number of unread notifications
         */
        function updateHeaderNotificationCounter(count) {
            const headerCounter = document.querySelector('.notification-count');
            if (headerCounter) {
                headerCounter.textContent = count;
                
                // Hide badge if count is 0
                if (count === 0) {
                    headerCounter.style.display = 'none';
                    
                    // Remove red dot indicator
                    const bellIcon = document.getElementById('notification-bell');
                    if (bellIcon) {
                        bellIcon.classList.remove('has-notifications');
                    }
                } else {
                    headerCounter.style.display = 'inline-block';
                    
                    // Add red dot indicator
                    const bellIcon = document.getElementById('notification-bell');
                    if (bellIcon) {
                        bellIcon.classList.add('has-notifications');
                    }
                }
            }
        }
    });
</script>