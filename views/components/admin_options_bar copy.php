<!-- Admin Action Bar (Only visible in admin view) -->
<?php if (isset($isAdminView) && $isAdminView === true): ?>
<div class="admin-action-bar">
    <div class="admin-action-bar-content">
        <div class="admin-user-overview">
            <div class="admin-user-status <?php echo strtolower($user['account_status'] ?? 'unknown'); ?>">
                <span class="status-indicator"></span>
                <span class="status-text"><?php echo ucfirst(htmlspecialchars($user['account_status'] ?? 'Unknown')); ?></span>
            </div>
            <div class="admin-user-id">
                ID: <?php echo htmlspecialchars($user['user_id'] ?? 'N/A'); ?>
            </div>
            <div class="admin-user-joined">
                <i class="far fa-calendar-alt"></i> Joined: <?php echo !empty($user['created_at']) ? date('M d, Y', strtotime($user['created_at'])) : 'Unknown'; ?>
            </div>
        </div>
        
        <div class="admin-actions">
            <div class="admin-action-dropdown">
                <button class="admin-action-btn status-change-btn">
                    <i class="fas fa-user-shield"></i> Change Status
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="admin-dropdown-content">
                    <a href="#" class="admin-dropdown-item <?php echo ($user['account_status'] ?? '') === 'active' ? 'active' : ''; ?>" 
                       data-action="change-status" data-status="active" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-check-circle"></i> Active
                    </a>
                    <a href="#" class="admin-dropdown-item <?php echo ($user['account_status'] ?? '') === 'inactive' ? 'active' : ''; ?>" 
                       data-action="change-status" data-status="inactive" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-pause-circle"></i> Inactive
                    </a>
                    <a href="#" class="admin-dropdown-item <?php echo ($user['account_status'] ?? '') === 'blocked' ? 'active' : ''; ?>" 
                       data-action="change-status" data-status="blocked" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-ban"></i> Blocked
                    </a>
                    <a href="#" class="admin-dropdown-item <?php echo ($user['account_status'] ?? '') === 'banned' ? 'active' : ''; ?>" 
                       data-action="change-status" data-status="banned" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-user-slash"></i> Banned
                    </a>
                </div>
            </div>
            
            <?php if (($user['verification_status'] ?? '') === 'pending' || ($user['verification_status'] ?? '') === 'unverified'): ?>
            <button class="admin-action-btn verify-btn" data-action="verify-user" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                <i class="fas fa-user-check"></i> Verify User
            </button>
            <?php endif; ?>
            
            <button class="admin-action-btn message-btn" data-action="message-user" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                <i class="fas fa-envelope"></i> Message
            </button>
            
            <div class="admin-action-dropdown">
                <button class="admin-action-btn more-actions-btn">
                    <i class="fas fa-ellipsis-h"></i> More Actions
                </button>
                <div class="admin-dropdown-content">
                    <a href="#" class="admin-dropdown-item" data-action="edit-user" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                    <a href="#" class="admin-dropdown-item" data-action="view-login-history" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-history"></i> Login History
                    </a>
                    <a href="#" class="admin-dropdown-item" data-action="reset-password" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-key"></i> Reset Password
                    </a>
                    <div class="admin-dropdown-divider"></div>
                    <a href="#" class="admin-dropdown-item danger" data-action="delete-user" data-user-id="<?php echo htmlspecialchars($user['user_id'] ?? ''); ?>">
                        <i class="fas fa-trash-alt"></i> Delete Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add CSS for Admin Bar -->
<style>
    /* Admin Action Bar Styles */
    .admin-action-bar {
        background: linear-gradient(to right, #ffffff, #f9fafc);
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 10;
        /* overflow: hidden; */
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .admin-action-bar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: #4338ca;
    }
    
    .admin-action-bar-content {
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    /* User Overview Section */
    .admin-user-overview {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .admin-user-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .status-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #9ca3af;
    }
    
    .admin-user-status.active .status-indicator {
        background-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }
    
    .admin-user-status.inactive .status-indicator {
        background-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
    }
    
    .admin-user-status.blocked .status-indicator,
    .admin-user-status.banned .status-indicator {
        background-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
    }
    
    .admin-user-id {
        font-size: 0.9rem;
        color: #6b7280;
        font-family: 'Courier New', monospace;
        background: #f3f4f6;
        padding: 0.3rem 0.6rem;
        border-radius: 0.5rem;
    }
    
    .admin-user-joined {
        font-size: 0.9rem;
        color: #6b7280;
    }
    
    /* Admin Actions Section */
    .admin-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .admin-action-btn {
        background-color: #ffffff;
        color: #374151;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        white-space: nowrap;
    }
    
    .admin-action-btn:hover {
        background-color: #f9fafb;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    
    .admin-action-btn:active {
        transform: translateY(1px);
    }
    
    .status-change-btn {
        background-color: #f3f4f7;
        border-color: #e5e7eb;
    }
    
    .verify-btn {
        background-color: #ecfdf5;
        color: #059669;
        border-color: #d1fae5;
    }
    
    .verify-btn:hover {
        background-color: #d1fae5;
    }
    
    .message-btn {
        background-color: #eff6ff;
        color: #3b82f6;
        border-color: #dbeafe;
    }
    
    .message-btn:hover {
        background-color: #dbeafe;
    }
    
    /* Dropdown Styles */
    .admin-action-dropdown {
        position: relative;
        display: inline-block;
    }
    
    .admin-dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 0.5rem);
        min-width: 200px;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        z-index: 20;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .admin-action-dropdown:hover .admin-dropdown-content {
        display: block;
    }
    
    .admin-dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        color: #4b5563;
        text-decoration: none;
        font-size: 0.875rem;
        transition: background-color 0.2s;
    }
    
    .admin-dropdown-item:hover {
        background-color: #f9fafb;
    }
    
    .admin-dropdown-item.active {
        background-color: #eff6ff;
        color: #3b82f6;
        font-weight: 500;
    }
    
    .admin-dropdown-item.danger {
        color: #ef4444;
    }
    
    .admin-dropdown-item.danger:hover {
        background-color: #fee2e2;
    }
    
    .admin-dropdown-divider {
        height: 1px;
        background-color: #e5e7eb;
        margin: 0.5rem 0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .admin-action-bar-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .admin-user-overview,
        .admin-actions {
            width: 100%;
        }
        
        .admin-actions {
            margin-top: 0.5rem;
            justify-content: flex-start;
        }
    }
    
    @media (max-width: 640px) {
        .admin-action-btn {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }
        
        .admin-user-overview {
            gap: 1rem;
        }
    }
</style>

<!-- Add JavaScript for Admin Bar functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle status change action
    const statusItems = document.querySelectorAll('[data-action="change-status"]');
    statusItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const userId = this.getAttribute('data-user-id');
            const status = this.getAttribute('data-status');
            
            if (confirm(`Are you sure you want to change this user's status to ${status}?`)) {
                // Send AJAX request to update user status
                fetch(`/api/update-user-account-status?id=${userId}&status=${status}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        // Reload the page to reflect the changes
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the user status.');
                });
            }
        });
    });
    
    // Handle verify user action
    const verifyBtn = document.querySelector('[data-action="verify-user"]');
    if (verifyBtn) {
        verifyBtn.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            
            if (confirm('Are you sure you want to verify this user?')) {
                // Send AJAX request to verify user
                fetch(`/api/users/${userId}/verify`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while verifying the user.');
                });
            }
        });
    }
    
    // Handle message user action
    const messageBtn = document.querySelector('[data-action="message-user"]');
    if (messageBtn) {
        messageBtn.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            // Open message dialog or redirect to messaging interface
            window.location.href = `/admin/messages/compose?recipient=${userId}`;
        });
    }
    
    // Handle delete user action
    const deleteBtn = document.querySelector('[data-action="delete-user"]');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const userId = this.getAttribute('data-user-id');
            
            if (confirm('WARNING: This will permanently delete this user account and all associated data. This action cannot be undone. Are you absolutely sure?')) {
                // Confirm with a second prompt
                if (confirm('Please confirm once more that you want to permanently delete this user account.')) {
                    // Send AJAX request to delete user
                    fetch(`/api/users/${userId}/delete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);
                            // Redirect to users list
                            window.location.href = '/admin/users';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the user.');
                    });
                }
            }
        });
    }
    
    // Handle other action buttons as needed
    const actionButtons = document.querySelectorAll('[data-action]');
    actionButtons.forEach(button => {
        if (!button.getAttribute('data-action').match(/^(change-status|verify-user|message-user|delete-user)$/)) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.getAttribute('data-action');
                const userId = this.getAttribute('data-user-id');
                
                switch(action) {
                    case 'edit-user':
                        window.location.href = `/admin/users/${userId}/edit`;
                        break;
                    case 'view-login-history':
                        window.location.href = `/admin/users/${userId}/login-history`;
                        break;
                    case 'reset-password':
                        if (confirm('Are you sure you want to reset this user\'s password?')) {
                            // Send request to reset password
                            fetch(`/api/users/${userId}/reset-password`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                credentials: 'same-origin'
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.message) {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while resetting the password.');
                            });
                        }
                        break;
                    default:
                        console.log(`Action not implemented: ${action}`);
                }
            });
        }
    });
});
</script>
<?php endif; ?>