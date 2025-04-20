<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - BrandBoost Admin</title>
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
            gap: 0.75rem;
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

        .badge-pending, .badge-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .badge-in-progress {
            background-color: var(--info-color);
            color: white;
        }

        .badge-completed, .badge-success {
            background-color: var(--success-color);
            color: white;
        }

        .badge-canceled, .badge-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-disputed {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-info {
            background-color: var(--info-color);
            color: white;
        }

        .badge-secondary {
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

        .card-header h2, .card-header h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header h2 i, .card-header h3 i {
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

        .user-avatar, .profile-img {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .user-details, .profile-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .user-role, .profile-role {
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

        .btn-outline-primary {
            color: var(--primary-color);
            background-color: transparent;
            border: 1px solid var(--primary-color);
        }

        .btn-outline-primary:hover {
            color: white;
            background-color: var(--primary-color);
        }

        .btn-outline-danger {
            color: var(--danger-color);
            background-color: transparent;
            border: 1px solid var(--danger-color);
        }

        .btn-outline-danger:hover {
            color: white;
            background-color: var(--danger-color);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }

        .input-group {
            display: flex;
            position: relative;
        }

        .input-group .form-control {
            flex: 1;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0.625rem;
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--gray-700);
            text-align: center;
            background-color: var(--gray-100);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius) 0 0 var(--radius);
        }

        .input-group .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 1.5rem;
            overflow-x: auto;
        }

        .tab-link {
            padding: 0.75rem 1.25rem;
            cursor: pointer;
            font-weight: 500;
            color: var(--gray-600);
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .tab-link:hover {
            color: var(--primary-color);
        }

        .tab-link.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 28px;
            margin-top: 1rem;
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

        /* Chat Messages */
        .message {
            padding: 0.75rem 1rem;
            border-radius: var(--radius);
            margin-bottom: 1rem;
            max-width: 80%;
            position: relative;
        }

        .message-sender {
            background-color: var(--gray-100);
            margin-right: auto;
        }

        .message-receiver {
            background-color: #e8f0fe;
            margin-left: auto;
        }

        .message-time {
            font-size: 0.7rem;
            color: var(--gray-500);
            display: block;
            text-align: right;
            margin-top: 0.25rem;
        }

        /* File Items */
        .file-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            padding: 0.75rem;
            background-color: var(--gray-50);
            border-radius: var(--radius);
            transition: background-color 0.15s;
        }

        .file-item:hover {
            background-color: var(--gray-100);
        }

        .file-icon {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            color: var(--gray-600);
        }

        .file-name {
            flex: 1;
            font-size: 0.875rem;
        }

        /* Star Rating */
        .star-rating {
            color: #ffc107;
        }

        /* Notification */
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

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        table th,
        table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        table th {
            background-color: var(--gray-50);
            font-weight: 600;
            color: var(--gray-700);
        }

        table tr:hover {
            background-color: var(--gray-50);
        }

        /* Loading Spinner */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
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

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
        }

        .alert-light {
            background-color: var(--gray-50);
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
        }

        /* Responsive */
        @media (max-width: 767px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .tabs {
                flex-wrap: wrap;
            }

            .tab-link {
                flex: 1 0 auto;
                text-align: center;
            }
        }

        /* Dropdown styling */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 10;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin-top: 0.125rem;
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            display: none;
        }

        .dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            clear: both;
            font-weight: 400;
            color: var(--gray-700);
            text-decoration: none;
        }

        .dropdown-item:hover {
            background-color: var(--gray-50);
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <ul class="breadcrumb">
                <li><a href="/admin/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="/admin/orders">Orders</a></li>
                <li>Order Details</li>
            </ul>
            <div class="user-info">
                <img alt="Admin" src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg" />
                <span id="admin-name">Admin User</span>
            </div>
        </div>

        <div id="loading" class="loading">
            <div class="spinner"></div>
        </div>

        <div id="order-content" style="display: none;">
            <h1 class="page-title">
                Order #<span id="order-id">Loading...</span>
                <span id="order-status-badge" class="badge badge-pending">Loading...</span>
            </h1>

            <div class="grid">
                <!-- Main content column -->
                <div>
                    <!-- Order Summary Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-clipboard-list"></i> Order Summary</h2>
                        </div>
                        <div class="card-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Order Title</div>
                                    <div class="info-value" id="order-title">Loading...</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Service Type</div>
                                    <div class="info-value" id="service-type">Loading...</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Order Date</div>
                                    <div class="info-value" id="order-date">Loading...</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Delivery Date</div>
                                    <div class="info-value" id="delivery-date">Loading...</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Price</div>
                                    <div class="info-value" id="order-price">Loading...</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Payment Status</div>
                                    <div class="info-value" id="payment-status">Loading...</div>
                                </div>
                            </div>

                            <div class="alert alert-light mt-4">
                                <div class="info-label">Delivery Requirements</div>
                                <div id="delivery-requirements">Loading...</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs for different sections -->
                    <div class="tabs" id="orderDetailsTabs">
                        <div class="tab-link active" data-tab="deliveries"><i class="fas fa-inbox"></i> Deliveries</div>
                        <div class="tab-link" data-tab="conversation"><i class="fas fa-comments"></i> Conversation</div>
                        <div class="tab-link" data-tab="attachments"><i class="fas fa-paperclip"></i> Attachments</div>
                        <div class="tab-link" data-tab="timeline"><i class="fas fa-history"></i> Timeline</div>
                        <div class="tab-link" data-tab="reviews"><i class="fas fa-star"></i> Reviews</div>
                    </div>

                    <!-- Tab content -->
                    <div id="tabsContainer">
                        <!-- Deliveries Tab -->
                        <div id="deliveries" class="tab-content active">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-3">
                                        <span class="info-label">Revisions Remaining:</span>
                                        <span class="badge badge-info" id="remaining-revisions">0</span>
                                    </p>
                                    <div id="deliveries-container">
                                        <div class="loading">
                                            <div class="spinner"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Conversation Tab -->
                        <div id="conversation" class="tab-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="conversation-container">
                                        <div class="loading">
                                            <div class="spinner"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Attachments Tab -->
                        <div id="attachments" class="tab-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="attachments-container">
                                        <div class="loading">
                                            <div class="spinner"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Tab -->
                        <div id="timeline" class="tab-content">
                            <div class="card">
                                <div class="card-body">
                                    <div class="timeline" id="timeline-container">
                                        <div class="loading">
                                            <div class="spinner"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div id="reviews" class="tab-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="reviews-container">
                                        <div class="loading">
                                            <div class="spinner"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar column for profiles and actions -->
                <div>
                    <!-- Admin Actions Panel -->
                    <div class="card" style="position: sticky; top: 1rem;">
                        <div class="card-header" style="background-color: var(--primary-color); color: white;">
                            <h2><i class="fas fa-tools"></i> Admin Actions</h2>
                        </div>
                        <div class="card-body">
                            <form id="adminActionsForm">
                                <input type="hidden" name="order_id" id="form-order-id">

                                <div class="form-group">
                                    <label for="orderStatus" class="form-label">Change Order Status</label>
                                    <select class="form-control" id="orderStatus" name="order_status">
                                        <option value="">Select status...</option>
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                        <option value="canceled">Cancelled</option>
                                        <option value="disputed">Disputed</option>
                                    </select>
                                </div>

                                <hr style="margin: 20px 0; border-top: 1px solid var(--gray-200);">

                                <div class="form-group">
                                    <label for="refundAmount" class="form-label">Issue Refund</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="refundAmount" name="refund_amount" placeholder="Amount" step="0.01" min="0">
                                        <button type="button" class="btn btn-warning" id="refundBtn">Process Refund</button>
                                    </div>
                                    <small class="text-muted" id="max-refund">Max refund: $0.00</small>
                                </div>

                                <div style="margin-top: 20px;">
                                    <div id="dispute-action-container" style="margin-bottom: 10px; display: none;">
                                        <button type="button" class="btn btn-success btn-block" id="resolveDisputeBtn">
                                            <i class="fas fa-check-circle"></i> Mark Dispute as Resolved
                                        </button>
                                    </div>

                                    <div class="btn-group" style="display: flex; margin-bottom: 10px;">
                                        <div class="dropdown" style="flex: 1; margin-right: 5px;">
                                            <button type="button" class="btn btn-outline-danger" id="actOnBuyerBtn" style="width: 100%;">
                                                <i class="fas fa-user-slash"></i> Act on Buyer
                                            </button>
                                            <div class="dropdown-menu" id="buyerActionMenu">
                                                <a href="#" class="dropdown-item buyer-action" data-action="blocked">
                                                    <i class="fas fa-ban text-warning"></i> Block Buyer
                                                </a>
                                                <a href="#" class="dropdown-item buyer-action" data-action="banned">
                                                    <i class="fas fa-user-slash text-danger"></i> Ban Buyer
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown" style="flex: 1; margin-left: 5px;">
                                            <button type="button" class="btn btn-outline-danger" id="actOnSellerBtn" style="width: 100%;">
                                                <i class="fas fa-user-slash"></i> Act on Seller
                                            </button>
                                            <div class="dropdown-menu" id="sellerActionMenu">
                                                <a href="#" class="dropdown-item seller-action" data-action="blocked">
                                                    <i class="fas fa-ban text-warning"></i> Block Seller
                                                </a>
                                                <a href="#" class="dropdown-item seller-action" data-action="banned">
                                                    <i class="fas fa-user-slash text-danger"></i> Ban Seller
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block" id="saveChangesBtn">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Buyer Profile Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-user-check"></i> Buyer Profile</h2>
                        </div>
                        <div class="card-body">
                            <div class="user-profile" id="buyer-profile">
                                <div class="loading">
                                    <div class="spinner"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Profile Card -->
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-user-tie"></i> Seller Profile</h2>
                        </div>
                        <div class="card-body">
                            <div class="user-profile" id="seller-profile">
                                <div class="loading">
                                    <div class="spinner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notification" class="notification">
        <div class="notification-content">
            <div class="notification-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="notification-message">
                <div class="notification-title">Success</div>
                <div class="notification-text" id="notification-message">Operation completed successfully</div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the order ID from the URL path
            const pathSegments = window.location.pathname.split('/');
            const orderId = pathSegments[pathSegments.length - 1]; // Get the last segment

            console.log('Order ID:', orderId);

            if (!orderId) {
                showNotification('No order ID provided', 'error');
                return;
            }

            // Initialize order data
            let orderData = null;

            // Set order ID in the form
            document.getElementById('form-order-id').value = orderId;

            // Fetch order details from API
            fetchOrderDetails(orderId);

            // Tab switching functionality
            setupTabs();

            // Setup form submission
            setupFormHandlers();
        });

        // Fetch order details from API
        function fetchOrderDetails(orderId) {
            fetch(`/api/order/${orderId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch order details');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        console.log('Order data:', data);
                        orderData = data.data;
                        displayOrderDetails(orderData);

                        // Hide loading spinner and show content
                        document.getElementById('loading').style.display = 'none';
                        document.getElementById('order-content').style.display = 'block';

                        // Load all tab data
                        loadTabData(orderData);
                    } else {
                        showNotification('Error: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error fetching order details', 'error');
                });
        }

        // Display order details in the summary section
        function displayOrderDetails(data) {
            const order = data.order;
            const promise = data.promise || {};

            // Extract service details from promise
            const acceptedService = JSON.parse(promise.accepted_service || '{}');
            const requestedService = JSON.parse(promise.requested_service || '{}');

            // Set order ID
            document.getElementById('order-id').textContent = order.order_id;

            // Set order status
            const statusElement = document.getElementById('order-status-badge');
            statusElement.className = `badge badge-${order.order_status.replace('_', '-')}`;
            statusElement.textContent = capitalizeFirstLetter(order.order_status);

            // Set order summary details
            document.getElementById('order-title').textContent = acceptedService.title || 'N/A';
            document.getElementById('service-type').textContent = capitalizeFirstLetter(acceptedService.service_type || 'Unknown');
            document.getElementById('order-date').textContent = formatDate(order.created_at);
            document.getElementById('delivery-date').textContent = formatDate(order.delivered_date) || 'Not delivered yet';
            document.getElementById('order-price').textContent = formatPrice(promise.price || 0);

            // Set payment status
            const paymentStatusElement = document.getElementById('payment-status');
            paymentStatusElement.innerHTML = `<span class="badge ${order.payment_type === 'paid' ? 'badge-success' : 'badge-warning'}">${capitalizeFirstLetter(order.payment_type)}</span>`;

            // Set delivery requirements
            document.getElementById('delivery-requirements').textContent = requestedService.requirements || 'No specific requirements provided';

            // Set remaining revisions
            document.getElementById('remaining-revisions').textContent = order.remained_revisions || 0;

            // Set max refund amount
            document.getElementById('max-refund').textContent = `Max refund: ${formatPrice(promise.price || 0)}`;
            document.getElementById('refundAmount').setAttribute('max', promise.price || 0);

            // Set order status dropdown
            const orderStatusSelect = document.getElementById('orderStatus');
            orderStatusSelect.value = order.order_status;

            // Show/hide dispute resolution button
            const disputeActionContainer = document.getElementById('dispute-action-container');
            if (order.order_status === 'disputed') {
                disputeActionContainer.style.display = 'block';
            } else {
                disputeActionContainer.style.display = 'none';
            }
        }

        // Load data for all tabs
        function loadTabData(data) {
            loadDeliveriesTab(data);
            loadConversationTab(data);
            loadAttachmentsTab(data);
            loadTimelineTab(data);
            loadReviewsTab(data);
            loadBuyerProfile(data);
            loadSellerProfile(data);
        }

        // Load deliveries tab content
        function loadDeliveriesTab(data) {
            const container = document.getElementById('deliveries-container');

            // For demo purposes, using mock data
            // In a real implementation, this would come from an API
            const mockDeliveries = [{
                    'id': 1,
                    'delivery_date': '2025-04-15 09:30:00',
                    'notes': 'First draft as requested',
                    'files': ['design_v1.pdf', 'preview.jpg']
                },
                {
                    'id': 2,
                    'delivery_date': '2025-04-17 14:20:00',
                    'notes': 'Revised version with requested changes',
                    'files': ['design_v2.pdf', 'preview_updated.jpg']
                }
            ];

            if (mockDeliveries.length === 0) {
                container.innerHTML = `
                    <div class="alert alert-light text-center">
                        <p>No deliveries yet</p>
                    </div>
                `;
                return;
            }

            let html = '';

            mockDeliveries.forEach(delivery => {
                let filesHtml = '';

                delivery.files.forEach(file => {
                    filesHtml += `
                        <div class="file-item">
                            <span class="file-icon">
                                <i class="far fa-file"></i>
                            </span>
                            <span class="file-name">${file}</span>
                            <a href="#" class="btn btn-primary btn-sm">Download</a>
                        </div>
                    `;
                });

                html += `
                    <div class="card mb-3">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Delivery #${delivery.id}</span>
                                <span class="text-muted">${formatDateTime(delivery.delivery_date)}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>${delivery.notes}</p>
                            
                            <div style="margin-top: 15px;">
                                <p style="font-weight: 600; margin-bottom: 10px;">Files:</p>
                                ${filesHtml}
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // Load conversation tab content
        function loadConversationTab(data) {
            const container = document.getElementById('conversation-container');
            const order = data.order;
            const user = data.user || {};

            // Mock conversation data
            // In a real implementation, this would come from an API
            const mockConversation = [{
                    'sender_id': order.customer_id,
                    'message': 'Hi, I need this design by next week.',
                    'timestamp': '2025-04-10 14:32:00'
                },
                {
                    'sender_id': 'seller',
                    'message': 'Sure, I can do that. Let me know if you have specific requirements.',
                    'timestamp': '2025-04-10 15:05:00'
                },
                {
                    'sender_id': order.customer_id,
                    'message': 'I want it to be blue and minimalist.',
                    'timestamp': '2025-04-10 15:10:00'
                }
            ];

            if (mockConversation.length === 0) {
                container.innerHTML = `
                    <div class="alert alert-light text-center">
                        <p>No messages yet</p>
                    </div>
                `;
                return;
            }

            let html = '<div class="conversation-wrapper">';

            mockConversation.forEach(message => {
                const isBuyer = message.sender_id === order.customer_id;
                const messageClass = isBuyer ? 'message-sender' : 'message-receiver';
                const senderName = isBuyer ? (user.username || 'Buyer') : 'Seller';

                html += `
                    <div class="message ${messageClass}">
                        <div style="display: flex; align-items: center; margin-bottom: 5px;">
                            <span style="font-weight: 600;">${senderName}</span>
                        </div>
                        <p>${message.message}</p>
                        <span class="message-time">
                            ${formatDateTime(message.timestamp)}
                        </span>
                    </div>
                `;
            });

            html += '</div>';
            container.innerHTML = html;
        }

        // Load attachments tab content
        function loadAttachmentsTab(data) {
            const container = document.getElementById('attachments-container');
            const order = data.order;
            const user = data.user || {};

            // Mock attachments data
            // In a real implementation, this would come from an API
            const mockAttachments = [{
                    'filename': 'reference.jpg',
                    'uploaded_by': order.customer_id,
                    'upload_date': '2025-04-09 10:15:00'
                },
                {
                    'filename': 'brief.pdf',
                    'uploaded_by': order.customer_id,
                    'upload_date': '2025-04-09 10:17:00'
                }
            ];

            if (mockAttachments.length === 0) {
                container.innerHTML = `
                    <div class="alert alert-light text-center">
                        <p>No attachments found</p>
                    </div>
                `;
                return;
            }

            let html = `
                <table>
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Uploaded By</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            mockAttachments.forEach(attachment => {
                const uploaderName = attachment.uploaded_by === order.customer_id ? (user.username || 'Buyer') : 'Seller';

                html += `
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <i class="far fa-file" style="margin-right: 10px;"></i>
                                ${attachment.filename}
                            </div>
                        </td>
                        <td>${uploaderName}</td>
                        <td>${formatDateTime(attachment.upload_date)}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Download</a>
                        </td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                </table>
            `;

            container.innerHTML = html;
        }

        // Load timeline tab content
        function loadTimelineTab(data) {
            const container = document.getElementById('timeline-container');
            const order = data.order;

            // Mock timeline data
            // In a real implementation, this would come from an API
            const mockTimeline = [{
                    'event': 'Order created',
                    'timestamp': order.created_at
                },
                {
                    'event': 'Order accepted',
                    'timestamp': new Date(new Date(order.created_at).getTime() + 86400000).toISOString()
                },
                {
                    'event': 'First delivery',
                    'timestamp': '2025-04-15 09:30:00'
                },
                {
                    'event': 'Revision requested',
                    'timestamp': '2025-04-16 11:20:00'
                },
                {
                    'event': 'Revised delivery',
                    'timestamp': '2025-04-17 14:20:00'
                }
            ];

            if (mockTimeline.length === 0) {
                container.innerHTML = `
                    <div class="alert alert-light text-center">
                        <p>No timeline events</p>
                    </div>
                `;
                return;
            }

            let html = '';

            mockTimeline.forEach(event => {
                html += `
                    <div class="timeline-item">
                        <div class="timeline-date">
                            ${formatDateTime(event.timestamp)}
                        </div>
                        <div class="timeline-title">${event.event}</div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // Load reviews tab content
        function loadReviewsTab(data) {
            const container = document.getElementById('reviews-container');

            // Mock reviews data
            // In a real implementation, this would come from an API
            const mockReviews = {
                'buyer': {
                    'rating': 4.5,
                    'comment': 'Great work, just needed a few tweaks but overall very satisfied!',
                    'date': '2025-04-19 16:45:00'
                },
                'seller': {
                    'rating': 5,
                    'comment': 'Clear requirements and prompt communication. Would work with again!',
                    'date': '2025-04-19 17:30:00'
                }
            };

            if (!mockReviews.buyer && !mockReviews.seller) {
                container.innerHTML = `
                    <div class="alert alert-light text-center">
                        <p>No reviews yet</p>
                    </div>
                `;
                return;
            }

            let html = '';

            // Buyer's review
            if (mockReviews.buyer) {
                html += `
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3><i class="fas fa-comment-alt"></i> Buyer's Review</h3>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div class="star-rating">
                                    ${generateStarRating(mockReviews.buyer.rating)}
                                    <span style="margin-left: 10px;">${mockReviews.buyer.rating}/5</span>
                                </div>
                                <small class="text-muted">
                                    ${formatDate(mockReviews.buyer.date)}
                                </small>
                            </div>
                            <p>${mockReviews.buyer.comment}</p>
                        </div>
                    </div>
                `;
            }

            // Seller's review
            if (mockReviews.seller) {
                html += `
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fas fa-comment-alt"></i> Seller's Review</h3>
                        </div>
                        <div class="card-body">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div class="star-rating">
                                    ${generateStarRating(mockReviews.seller.rating)}
                                    <span style="margin-left: 10px;">${mockReviews.seller.rating}/5</span>
                                </div>
                                <small class="text-muted">
                                    ${formatDate(mockReviews.seller.date)}
                                </small>
                            </div>
                            <p>${mockReviews.seller.comment}</p>
                        </div>
                    </div>
                `;
            }

            container.innerHTML = html;
        }

        // Load buyer profile
        function loadBuyerProfile(data) {
            const container = document.getElementById('buyer-profile');
            const order = data.order;

            fetchBuyerProfile(order.customer_id)
                .then(buyer => {
                    if (buyer) {
                        container.innerHTML = `
                            <img src="/${buyer.profile_picture}" alt="Buyer profile" class="user-avatar">
                            <div class="user-details">
                                <div class="user-name">${buyer.name || 'Unknown'}</div>
                                <div class="user-role">Business</div>
                                <div class="user-id">Member since: ${buyer.created_at ? formatDate(buyer.created_at) : 'N/A'}</div>
                                <a href="/admin/user-profile/${buyer.user_id}" class="btn btn-outline-primary btn-sm mt-2">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        `;
                    } else {
                        container.innerHTML = `
                            <p class="text-muted text-center">Buyer information not available</p>
                        `;
                    }
                });

        }

        async function fetchBuyerProfile(userId) {
            try {
                const response = await fetch(`/// filepath: c:\Users\ASUS TUF\Desktop\Brandboost\views\pages\admin\order_details.php`);
                if (!response.ok) {
                    throw new Error('Failed to fetch buyer profile');
                }


    </script>  
</body>
</html>