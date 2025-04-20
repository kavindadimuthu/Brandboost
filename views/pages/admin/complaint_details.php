<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details - BrandBoost Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --pending-color: #f97316;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --radius: 8px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            color: var(--gray-800);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .header {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .breadcrumb {
            font-size: 0.875rem;
            color: var(--gray-600);
            list-style: none;
            display: flex;
            flex-wrap: wrap;
        }
        .breadcrumb a {
            font-size: 0.875rem;
            text-decoration: none;
            color: var(--gray-600);
            transition: color 0.2s;
        }
        .breadcrumb a:hover {
            color: var(--primary-color);
        }

        .breadcrumb li {
            display: inline-block;
            margin-right: 5px;
        }

        .breadcrumb li:after {
            content: '>';
            margin-left: 5px;
        }

        .breadcrumb li:last-child:after {
            content: '';
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header .user-info img {
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .header .user-info span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .page-title {
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            /* gap: 0.25rem; */
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-pending {
            background-color: var(--pending-color);
            color: white;
        }

        .badge-open {
            background-color: var(--info-color);
            color: white;
        }

        .badge-in-progress, .badge-under-review {
            background-color: var(--info-color);
            color: white;
        }

        .badge-resolved {
            background-color: var(--success-color);
            color: white;
        }

        .badge-closed {
            background-color: var(--gray-500);
            color: white;
        }

        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 1024px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--gray-50);
        }

        .card-header h2 {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header h2 i {
            color: var(--primary-color);
        }

        .card-body {
            padding: 1.25rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.25rem;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            color: var(--gray-500);
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 500;
            color: var(--gray-800);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .user-profile:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .user-avatar {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .user-role {
            display: inline-block;
            font-size: 0.75rem;
            padding: 0.125rem 0.5rem;
            background-color: var(--gray-100);
            border-radius: 9999px;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .user-id {
            font-size: 0.75rem;
            color: var(--gray-500);
        }

        .description-content {
            background-color: var(--gray-50);
            border-radius: var(--radius);
            padding: 1.25rem;
            white-space: pre-line;
            line-height: 1.6;
            font-size: 0.875rem;
        }

        .order-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .order-link:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.625rem;
            font-size: 0.875rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            transition: border-color 0.15s ease-in-out;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn-group {
            display: flex;
            gap: 0.75rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #0b9668;
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--gray-600);
            border: 1px solid var(--gray-300);
        }

        .btn-outline:hover {
            background-color: var(--gray-100);
            color: var(--gray-800);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fff;
            border-radius: var(--radius);
            width: 90%;
            max-width: 500px;
            padding: 1.5rem;
            position: relative;
            box-shadow: var(--shadow-md);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .modal-header h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
            color: var(--gray-600);
        }

        .modal-body {
            margin-bottom: 1.5rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .image-modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            align-items: center;
            justify-content: center;
        }

        .image-modal-content {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .image-modal-close {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            background: none;
            border: none;
        }

        .notification {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            background-color: white;
            box-shadow: var(--shadow-md);
            max-width: 24rem;
            z-index: 1000;
            transform: translateX(120%);
            transition: transform 0.3s ease-out;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification-success {
            border-left: 4px solid var(--success-color);
        }

        .notification-error {
            border-left: 4px solid var(--danger-color);
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
        }

        .notification-icon {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        .notification-success .notification-icon {
            color: var(--success-color);
        }

        .notification-error .notification-icon {
            color: var(--danger-color);
        }

        .notification-message {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .notification-text {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        /* Loading Spinner */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .loading-overlay.show {
            visibility: visible;
            opacity: 1;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(99, 102, 241, 0.2);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .timeline {
            position: relative;
            padding-left: 28px;
            margin-top: 1.5rem;
        }

        .timeline:before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: var(--gray-200);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            left: -28px;
            top: 4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid var(--primary-color);
            z-index: 1;
        }

        .timeline-date {
            font-size: 0.75rem;
            color: var(--gray-500);
            margin-bottom: 0.25rem;
        }

        .timeline-title {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .timeline-content {
            font-size: 0.875rem;
            color: var(--gray-700);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="breadcrumb">
                <!-- <li><i class="fas fa-home"></i> Dashboard</li> -->
                <li><a href="/admin/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="/admin/complaints-list">Complaints</a></li>
                <li>Order Details</li>
            </div>
            <div class="user-info">
                <img alt="Admin" src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg" />
                <span id="admin-name"><?php echo $_SESSION['user']['username'] ?></span>
            </div>
        </div>

        <h1 class="page-title">
            Complaint #<span id="complaint-id">Loading...</span>
            <span id="status-badge" class="badge badge-open">Loading...</span>
        </h1>

        <div class="grid">
            <!-- Main content column -->
            <div>
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-clipboard-list"></i> Complaint Summary</h2>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Complaint Type</div>
                                <div class="info-value" id="complaint-type">Loading...</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Filed On</div>
                                <div class="info-value" id="complaint-date">Loading...</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Current Status</div>
                                <div class="info-value" id="complaint-status">Loading...</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Last Updated</div>
                                <div class="info-value" id="last-updated">Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-user-check"></i> Complainant Details</h2>
                    </div>
                    <div class="card-body">
                        <div class="user-profile">
                            <img id="complainant-img" src="https://via.placeholder.com/70" alt="Complainant" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name" id="complainant-name">Loading...</div>
                                <div class="user-role" id="complainant-role">User</div>
                                <div class="user-id">User ID: <span id="complainant-id">Loading...</span></div>
                                <div class="user-email" id="complainant-email">Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-flag"></i> Reported User Details</h2>
                    </div>
                    <div class="card-body">
                        <div class="user-profile">
                            <img id="reported-img" src="https://via.placeholder.com/70" alt="Reported User" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name" id="reported-name">Loading...</div>
                                <div class="user-role" id="reported-role">User</div>
                                <div class="user-id">User ID: <span id="reported-id">Loading...</span></div>
                                <div class="user-email" id="reported-email">Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-align-left"></i> Description of Complaint</h2>
                    </div>
                    <div class="card-body">
                        <div id="description" class="description-content">
                            Loading...
                        </div>
                    </div>
                </div>

                <div id="related-order-card" class="card" style="display: none;">
                    <div class="card-header">
                        <h2><i class="fas fa-shopping-cart"></i> Related Order</h2>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Order ID</div>
                                <div class="info-value">
                                    <a id="order-id-link" href="#" class="order-link">Loading...</a>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Order Date</div>
                                <div class="info-value" id="order-date">Loading...</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Service Type</div>
                                <div class="info-value" id="order-service">Loading...</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Amount</div>
                                <div class="info-value" id="order-amount">Loading...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar column for admin actions -->
            <div>
                <div class="card" style="position: sticky; top: 1rem;">
                    <div class="card-header">
                        <h2><i class="fas fa-tools"></i> Admin Actions</h2>
                    </div>
                    <div class="card-body">
                        <form id="admin-actions-form">
                            <div class="form-group">
                                <label for="assign-admin" class="form-label">Assign to Admin</label>
                                <select id="assign-admin" class="form-control">
                                    <option value="">Select Admin</option>
                                    <option value="1">John Smith</option>
                                    <option value="2">Jane Doe</option>
                                    <option value="3">Robert Brown</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="complaint-status" class="form-label">Change Status</label>
                                <select id="complaint-status" class="form-control">
                                    <option value="open">Open</option>
                                    <option value="in_progress">Under Review</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="resolution-notes" class="form-label">Resolution Notes</label>
                                <textarea id="resolution-notes" class="form-control" placeholder="Add notes about how this complaint was resolved..."></textarea>
                            </div>

                            <div class="btn-group">
                                <button type="button" id="save-changes-btn" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <button type="button" id="close-complaint-btn" class="btn btn-danger">
                                    <i class="fas fa-times-circle"></i> Close Complaint
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-reply"></i> Send Response</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="admin-response" class="form-label">Response Message</label>
                            <textarea id="admin-response" class="form-control" placeholder="Enter your response to this complaint..."></textarea>
                        </div>
                        <button type="button" id="send-response-btn" class="btn btn-success btn-block">
                            <i class="fas fa-paper-plane"></i> Send Response
                        </button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Status change modal -->
    <div id="status-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Change Complaint Status</h3>
                <button type="button" class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to change the status to <strong id="new-status-text">New Status</strong>?</p>
                <div class="form-group">
                    <label for="status-notes" class="form-label">Add notes (optional)</label>
                    <textarea id="status-notes" class="form-control" placeholder="Add notes about this status change..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline modal-cancel">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-status-btn">Confirm Change</button>
            </div>
        </div>
    </div>

    <!-- Image preview modal -->
    <div id="image-modal" class="image-modal">
        <button type="button" class="image-modal-close">&times;</button>
        <img class="image-modal-content" id="expanded-image">
    </div>

    <!-- Loading overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Notification -->
    <div id="notification" class="notification">
        <div class="notification-content">
            <div class="notification-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="notification-message">
                <div class="notification-title">Success</div>
                <div class="notification-text" id="notification-msg">Operation completed successfully</div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the complaint ID from the URL path
            const pathSegments = window.location.pathname.split('/');
            const complaintId = pathSegments[pathSegments.length - 1];
            
            console.log('Complaint ID:', complaintId);

            // State variables
            let complaintData = null;
            
            // DOM elements
            const statusModal = document.getElementById('status-modal');
            const imageModal = document.getElementById('image-modal');
            const notification = document.getElementById('notification');
            const loadingOverlay = document.getElementById('loading-overlay');
            
            // Initialize UI elements
            initUIElements();
            
            // Fetch complaint data
            if (complaintId) {
                fetchComplaintDetails(complaintId);
            } else {
                showNotification('Complaint ID is missing from the URL', 'error');
            }
            
            // Initialize UI elements and event listeners
            function initUIElements() {
                // Modal close buttons
                document.querySelector('.modal-close').addEventListener('click', () => {
                    statusModal.style.display = 'none';
                });
                
                document.querySelector('.modal-cancel').addEventListener('click', () => {
                    statusModal.style.display = 'none';
                });
                
                document.querySelector('.image-modal-close').addEventListener('click', () => {
                    imageModal.style.display = 'none';
                });
                
                // Click outside modal to close
                window.addEventListener('click', (event) => {
                    if (event.target === statusModal) {
                        statusModal.style.display = 'none';
                    }
                    if (event.target === imageModal) {
                        imageModal.style.display = 'none';
                    }
                });
                
                // Save changes button
                document.getElementById('save-changes-btn').addEventListener('click', () => {
                    saveChanges();
                });
                
                // Close complaint button
                document.getElementById('close-complaint-btn').addEventListener('click', () => {
                    confirmStatusChange('closed');
                });
                
                // Confirm status change button
                document.getElementById('confirm-status-btn').addEventListener('click', () => {
                    const newStatus = document.getElementById('complaint-status').value;
                    const statusNotes = document.getElementById('status-notes').value;
                    
                    updateComplaintStatus(newStatus, statusNotes);
                });
                
                // Status dropdown change event
                document.getElementById('complaint-status').addEventListener('change', (event) => {
                    // If they select a new status, ask for confirmation
                    if (complaintData && event.target.value !== complaintData.status) {
                        confirmStatusChange(event.target.value);
                    }
                });
            }
            
            // Fetch complaint details from API
            async function fetchComplaintDetails(id) {
                showLoading();
                
                try {
                    const response = await fetch(`/api/complaint/${id}`);
                    if (!response.ok) {
                        throw new Error('Failed to fetch complaint details');
                    }
                    
                    const data = await response.json();
                    if (!data.success) {
                        throw new Error(data.error || 'Failed to fetch complaint details');
                    }
                    
                    console.log('Complaint data:', data);
                    
                    complaintData = data.data;
                    renderComplaintDetails();
                    
                    // If there's an order ID, fetch order details
                    if (complaintData.order_id) {
                        fetchOrderDetails(complaintData.order_id);
                    }
                    
                } catch (error) {
                    showNotification(error.message, 'error');
                    console.error('Error:', error);
                } finally {
                    hideLoading();
                }
            }
            
            // Fetch order details if available
            async function fetchOrderDetails(orderId) {
                try {
                    const response = await fetch(`/api/order/${orderId}`);
                    if (!response.ok) {
                        throw new Error('Failed to fetch order details');
                    }
                    
                    const data = await response.json();
                    if (!data.success) {
                        throw new Error(data.error || 'Failed to fetch order details');
                    }
                    
                    renderOrderDetails(data.data);
                } catch (error) {
                    console.error('Error fetching order details:', error);
                    // Don't show notification for this - it's not critical
                }
            }
            
            // Render complaint details in the UI
            function renderComplaintDetails() {
                if (!complaintData) return;
                
                // Basic info
                document.getElementById('complaint-id').textContent = complaintData.complaint_id;
                document.getElementById('complaint-type').textContent = complaintData.complaint_type;
                document.getElementById('complaint-date').textContent = formatDateTime(complaintData.created_at);
                document.getElementById('complaint-status').textContent = formatStatus(complaintData.status);
                document.getElementById('last-updated').textContent = formatDateTime(complaintData.updated_at);
                
                // Set form values
                document.getElementById('complaint-status').value = complaintData.status;
                if (complaintData.resolution_notes) {
                    document.getElementById('resolution-notes').value = complaintData.resolution_notes;
                }
                
                // Status badge
                const statusBadge = document.getElementById('status-badge');
                statusBadge.textContent = formatStatus(complaintData.status);
                statusBadge.className = `badge badge-${complaintData.status.replace('_', '-')}`;
                
                // User info - Complainant
                document.getElementById('complainant-name').textContent = complaintData.complainant?.username || 'Unknown User';
                document.getElementById('complainant-email').textContent = complaintData.complainant?.email || 'No email available';
                document.getElementById('complainant-id').textContent = complaintData.complainant_user_id;
                document.getElementById('complainant-img').src = complaintData.complainant?.profile_image || 'https://via.placeholder.com/70';
                
                // Set role based on user type if available
                document.getElementById('complainant-role').textContent = determineUserRole(complaintData.complainant);
                
                // User info - Reported User
                document.getElementById('reported-name').textContent = complaintData.reported_user?.username || 'Unknown User';
                document.getElementById('reported-email').textContent = complaintData.reported_user?.email || 'No email available';
                document.getElementById('reported-id').textContent = complaintData.reported_user_id;
                document.getElementById('reported-img').src = complaintData.reported_user?.profile_image || 'https://via.placeholder.com/70';
                
                // Set role based on user type if available
                document.getElementById('reported-role').textContent = determineUserRole(complaintData.reported_user);
                
                // Description
                document.getElementById('description').textContent = complaintData.description || 'No description provided.';
                
                // Related order
                if (complaintData.order_id) {
                    document.getElementById('related-order-card').style.display = 'block';
                    document.getElementById('order-id-link').textContent = complaintData.order_id;
                    document.getElementById('order-id-link').href = `/admin/order-details/${complaintData.order_id}`;
                } else {
                    document.getElementById('related-order-card').style.display = 'none';
                }
            }
            
            // Render order details if available
            function renderOrderDetails(orderData) {
                if (!orderData || !orderData.order) return;
                
                const order = orderData.order;
                const promise = orderData.promise || {};
                
                document.getElementById('order-date').textContent = formatDate(order.created_at);
                
                // Extract service details
                const acceptedService = typeof promise.accepted_service === 'string' && promise.accepted_service 
                    ? JSON.parse(promise.accepted_service) 
                    : {};
                
                document.getElementById('order-service').textContent = 
                    acceptedService.title || acceptedService.service_type || 'Unknown';
                
                document.getElementById('order-amount').textContent = formatPrice(promise.price || 0);
            }
            
            // Open status change confirmation modal
            function confirmStatusChange(newStatus) {
                document.getElementById('new-status-text').textContent = formatStatus(newStatus);
                document.getElementById('complaint-status').value = newStatus;
                document.getElementById('status-notes').value = '';
                statusModal.style.display = 'flex';
            }
            
            // Save all changes to the complaint
            async function saveChanges() {
                const assignedAdmin = document.getElementById('assign-admin').value;
                const status = document.getElementById('complaint-status').value;
                const resolutionNotes = document.getElementById('resolution-notes').value;
                
                // Check if anything changed
                if (
                    (complaintData.status === status) && 
                    (!resolutionNotes || resolutionNotes === complaintData.resolution_notes)
                ) {
                    showNotification('No changes to save', 'info');
                    return;
                }
                
                updateComplaintStatus(status, resolutionNotes);
            }
            
            // Update complaint status
            async function updateComplaintStatus(newStatus, notes) {
                showLoading();
                
                try {
                    const response = await fetch('/api/update-complaint-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            complaint_id: complaintId,
                            status: newStatus,
                            resolution_notes: notes || undefined,
                            previous_status: complaintData.status
                        })
                    });
                    
                    if (!response.ok) {
                        throw new Error('Failed to update status');
                    }
                    
                    const data = await response.json();
                    if (!data.success) {
                        throw new Error(data.error || 'Failed to update status');
                    }
                    
                    // Close modal
                    statusModal.style.display = 'none';
                    
                    // Show success message
                    showNotification(`Status updated to ${formatStatus(newStatus)}`, 'success');
                    
                    // Refresh data
                    fetchComplaintDetails(complaintId);
                } catch (error) {
                    showNotification(error.message, 'error');
                    console.error('Error:', error);
                } finally {
                    hideLoading();
                }
            }
            
            // Show loading overlay
            function showLoading() {
                loadingOverlay.classList.add('show');
            }
            
            // Hide loading overlay
            function hideLoading() {
                loadingOverlay.classList.remove('show');
            }
            
            // Show notification
            function showNotification(message, type = 'success') {
                const notif = document.getElementById('notification');
                const icon = notif.querySelector('.notification-icon i');
                const title = notif.querySelector('.notification-title');
                const text = notif.querySelector('.notification-text');
                
                // Set the type
                notif.className = 'notification';
                notif.classList.add(`notification-${type}`);
                
                // Set the icon
                if (type === 'error') {
                    icon.className = 'fas fa-exclamation-circle';
                    title.textContent = 'Error';
                } else if (type === 'info') {
                    icon.className = 'fas fa-info-circle';
                    title.textContent = 'Information';
                } else {
                    icon.className = 'fas fa-check-circle';
                    title.textContent = 'Success';
                }
                
                // Set the message
                text.textContent = message;
                
                // Show the notification
                notif.classList.add('show');
                
                // Hide after a delay
                setTimeout(() => {
                    notif.classList.remove('show');
                }, 5000);
            }
            
            // Helper functions
            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }
            
            function formatDateTime(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                return date.toLocaleString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
            
            function formatStatus(status) {
                if (!status) return 'Unknown';
                
                const statuses = {
                    'open': 'Open',
                    'in_progress': 'Under Review',
                    'resolved': 'Resolved', 
                    'closed': 'Closed'
                };
                
                return statuses[status] || status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
            }
            
            function formatPrice(price) {
                return '$' + parseFloat(price).toFixed(2);
            }
            
            // Determine user role based on user data
            function determineUserRole(user) {
                if (!user) return 'User';
                
                // Check user type or role from user object
                if (user.user_role === 'businessman') return 'Businessman';
                if (user.user_role === 'influencer') return 'Influencer';
                if (user.user_role === 'designer') return 'Designer';
                if (user.role) return user.role;
                
                return 'User';
            }
        });
    </script>
</body>

</html>