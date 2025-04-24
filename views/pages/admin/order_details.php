<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrandBoost Admin - Order Details</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom styles -->
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

        /* CSS Reset */
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

        .grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 20px;
        }

        @media (min-width: 992px) {
            .grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        /* Add these styles to the existing CSS in the header */
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

        .description-content {
            background-color: var(--gray-50);
            border-radius: var(--radius);
            padding: 1.25rem;
            white-space: pre-line;
            line-height: 1.6;
            font-size: 0.875rem;
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

        /* Cards */
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* overflow: hidden; */
        }

        .card-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e3e6f0;
            border-radius: 10px 10px 0 0;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 20px;
        }

        /* Typography */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: 10px;
            font-weight: 600;
            line-height: 1.2;
        }

        p {
            margin-bottom: 10px;
        }

        a {
            color: #3a86ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Utility */
        .text-muted {
            color: #6c757d;
        }

        .text-center {
            text-align: center;
        }

        .mb-1 {
            margin-bottom: 5px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .mt-3 {
            margin-top: 15px;
        }

        .mt-4 {
            margin-top: 20px;
        }

        /* Header & Navigation */
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

        .page-title {
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-800);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Badge & Status */
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

        .badge-in-progress {
            background-color: var(--info-color);
            color: white;
        }

        .badge-completed {
            background-color: var(--success-color);
            color: white;
        }

        .badge-canceled {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-disputed {
            background-color: var(--danger-color);
            color: white;
        }

        /* badge types */
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

        /* Alerts */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-light {
            background-color: #f8f9fa;
            border: 1px solid #e3e6f0;
        }

        .alert-danger {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        /* Forms */
        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 8px 12px;
            font-size: 14px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 4px;
            transition: border-color 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
        }

        select.form-control {
            height: 38px;
        }

        textarea.form-control {
            resize: vertical;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 8px 16px;
            font-size: 14px;
            line-height: 1.5;
            border-radius: 4px;
            cursor: pointer;
            transition: color 0.15s, background-color 0.15s, border-color 0.15s;
        }

        .btn-primary {
            color: #fff;
            /* background-color: #3a86ff; */
            background-color: var(--primary-color);
            border-color: #3a86ff;
        }

        .btn-primary:hover {
            background-color: #2971e6;
            border-color: #2971e6;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-danger {
            /* color: #fff; */
            color: #dc3545;
            /* background-color: #dc3545; */
            background-color: #fff;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-outline-primary {
            /* color: #3a86ff; */
            color: var(--primary-color);
            background-color: transparent;
            border-color: #3a86ff;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #3a86ff;
        }

        .btn-outline-danger {
            color: #dc3545;
            background-color: transparent;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #dc3545;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .btn-group {
            width: 100%;
            display: flex;
            justify-content: space-between;
            gap: 5px;
        }

        /* Input groups */
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
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 4px 0 0 4px;
        }

        .input-group .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        /* Grid Layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }

        .col {
            flex: 1 0 0%;
            padding-right: 10px;
            padding-left: 10px;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 10px;
            padding-left: 10px;
        }

        @media (max-width: 767px) {
            .col-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* User profile styles */
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

        /* Responsive adjustments for mobile */
        @media (max-width: 768px) {
            .user-profile {
                flex-direction: column;
                align-items: flex-start;
                text-align: center;
            }

            .user-avatar {
                margin-bottom: 0.75rem;
                margin-right: 0;
            }

            .user-details {
                width: 100%;
                text-align: center;
            }
        }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline:before {
            content: '';
            position: absolute;
            left: 9px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #e3e6f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            left: -25px;
            top: 15px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            /* background-color: #3a86ff; */
            background-color: var(--primary-color);
        }

        .timeline-date {
            color: #6c757d;
            font-size: 0.85rem;
        }

        /* Chat Messages */
        .message {
            padding: 10px 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            max-width: 80%;
        }

        .message-sender {
            background-color: #e9ecef;
            margin-right: auto;
        }

        .message-receiver {
            background-color: #d4edda;
            margin-left: auto;
        }

        .message-time {
            font-size: 0.75rem;
            color: #6c757d;
            display: block;
            text-align: right;
        }

        /* Admin Actions */
        .admin-actions {
            /* position: sticky; */
            top: 20px;
        }

        /* Star Rating */
        .star-rating {
            color: #ffc107;
        }

        /* File Items */
        .file-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            padding: 8px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .file-icon {
            margin-right: 10px;
            font-size: 1.2rem;
            color: #6c757d;
        }

        .file-name {
            flex: 1;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .tab-link {
            padding: 10px 15px;
            cursor: pointer;
            border: 1px solid transparent;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            margin-bottom: -1px;
            font-weight: 500;
        }

        .tab-link:hover {
            background-color: #f8f9fa;
        }

        .tab-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }

        .notification.success {
            background-color: #28a745;
        }

        .notification.error {
            background-color: #dc3545;
        }

        .notification.show {
            opacity: 1;
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
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-left-color: #3a86ff;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 767px) {
            .admin-actions {
                position: static;
            }

            .tabs {
                flex-wrap: wrap;
            }

            .tab-link {
                flex: 1 0 auto;
                text-align: center;
            }
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        table tr:hover {
            background-color: #f8f9fa;
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
                <span id="admin-name"><?php echo $_SESSION['user']['username'] ?></span>
            </div>
        </div>

        <div id="loading" class="loading">
            <div class="spinner"></div>
        </div>

        <div id="order-content" style="display: none;">
            <h1 class="page-title">
                Order #<span id="order-id">Loading...</span>
                <span id="order-status-badge" class="badge">Loading...</span>
            </h1>

            <div class="grid">
                <!-- Main content column -->
                <div>
                    <!-- Order Summary Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2><i class="fas fa-clipboard-list"></i> Order Summary</h2>
                            <span class="text-muted" id="order-id-span"></span>
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

                            <div class="description-content" style="margin-top: 20px;">
                                <p class="info-label">Delivery Requirements</p>
                                <p id="delivery-requirements">Loading...</p>
                            </div>
                        </div>
                    </div>

                    

                    <!-- Tabs for different sections -->
                    <div class="tabs" id="orderDetailsTabs">
                        <div class="tab-link active" data-tab="deliveries">Deliveries</div>
                        <div class="tab-link" data-tab="conversation">Conversation</div>
                        <div class="tab-link" data-tab="attachments">Attachments</div>
                        <div class="tab-link" data-tab="timeline">Timeline</div>
                        <div class="tab-link" data-tab="reviews">Reviews</div>
                    </div>

                    <!-- Tab content -->
                    <div id="tabsContainer">
                        <!-- Deliveries Tab -->
                        <div id="deliveries" class="tab-content active">
                            <div class="card">
                                <div class="card-body">
                                    <p class="mb-3 text-muted">
                                        Revisions Remaining:
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
                    <div style="position: sticky; top: 1rem;">
                        <!-- Admin Actions Panel -->
                        <div class="card" >
                            <div class="card-header">
                                <h2><i class="fas fa-tools"></i> Admin Actions</h2>
                            </div>
                            <div class="card-body">
                                <form id="adminActionsForm">
                                    <input type="hidden" name="order_id" id="form-order-id">
                                    <div class="form-group">
                                        <label for="orderStatus" class="form-label">Change Order Status</label>
                                        <div class="input-group">
                                            <select class="form-control" id="orderStatus" name="order_status">
                                                <option value="">Select status...</option>
                                                <option value="pending">Pending</option>
                                                <option value="in_progress">In Progress</option>
                                                <option value="completed">Completed</option>
                                                <option value="canceled">Cancelled</option>
                                                <option value="disputed">Disputed</option>
                                            </select>
                                            <button type="submit" id="saveChangesBtn" class="btn btn-primary" style="margin-left: 0.2rem;">
                                                <i class="fas fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="refundAmount" class="form-label">Issue Refund</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="refundAmount" name="refund_amount" placeholder="Amount" step="0.01" min="0">
                                            <button type="button" id="refundBtn" class="btn btn-warning" style="margin-left: 0.2rem;">
                                                <i class="fas fa-money-bill-wave"></i> Process Refund
                                            </button>
                                        </div>
                                        <small class="text-muted" id="max-refund">Max refund: $0.00</small>
                                    </div>
                                    <div id="dispute-action-container" style="margin-top: 10px; display: none;">
                                        <button type="button" id="resolveDisputeBtn" class="btn btn-success" style="width: 100%;">
                                            <i class="fas fa-check-circle"></i> Mark Dispute as Resolved
                                        </button>
                                    </div>
                                    <div style="margin-top: 20px; display: flex; justify-content: space-between; gap: 0.5rem;">
                                        <div class="dropdown" style="margin-bottom: 10px; position: relative; width: 100%;">
                                            <button type="button" class="btn btn-danger" id="actOnBuyerBtn" style="width: 100%;">
                                                <i class="fas fa-user-times"></i> Act on Buyer
                                            </button>
                                            <div class="dropdown-menu" id="buyerActionMenu" style="display: none; position: absolute; background-color: white; border: 1px solid var(--gray-300); border-radius: var(--radius); width: 100%; z-index: 10; box-shadow: var(--shadow);">
                                                <a href="#" class="dropdown-item buyer-action" data-action="blocked" style="padding: 8px 16px; display: block; text-decoration: none; color: var(--gray-800);">
                                                    <i class="fas fa-ban text-warning"></i> Block Buyer
                                                </a>
                                                <a href="#" class="dropdown-item buyer-action" data-action="banned" style="padding: 8px 16px; display: block; text-decoration: none; color: var(--gray-800); border-top: 1px solid var(--gray-200);">
                                                    <i class="fas fa-user-slash text-danger"></i> Ban Buyer
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown" style="position: relative; width: 100%;">
                                            <button type="button" class="btn btn-danger" id="actOnSellerBtn" style="width: 100%;">
                                                <i class="fas fa-user-times"></i> Act on Seller
                                            </button>
                                            <div class="dropdown-menu" id="sellerActionMenu" style="display: none; position: absolute; background-color: white; border: 1px solid var(--gray-300); border-radius: var(--radius); width: 100%; z-index: 10; box-shadow: var(--shadow);">
                                                <a href="#" class="dropdown-item seller-action" data-action="blocked" style="padding: 8px 16px; display: block; text-decoration: none; color: var(--gray-800);">
                                                    <i class="fas fa-ban text-warning"></i> Block Seller
                                                </a>
                                                <a href="#" class="dropdown-item seller-action" data-action="banned" style="padding: 8px 16px; display: block; text-decoration: none; color: var(--gray-800); border-top: 1px solid var(--gray-200);">
                                                    <i class="fas fa-user-slash text-danger"></i> Ban Seller
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
                            <!-- Buyer Profile Card -->
                            <div class="card" style="flex: 1; min-width: 300px;">
                                <div class="card-header">
                                    <h2><i class="fas fa-user-check"></i> Buyer Details</h2>
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
                            <div class="card" style="flex: 1; min-width: 300px;">
                                <div class="card-header">
                                    <h2><i class="fas fa-store"></i> Seller Details</h2>
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
        </div>
    </div>

    <div id="notification" class="notification">
        <span id="notification-message"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the gig ID from the URL path
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

            // Set order ID in page title
            document.getElementById('order-id').textContent = order.order_id;
            document.getElementById('order-id-span').textContent = `Order #${order.order_id}`;

            // Set order status badge in page title
            const statusBadge = document.getElementById('order-status-badge');
            statusBadge.className = `badge badge-${order.order_status.replace('_', '-')}`;
            statusBadge.textContent = capitalizeFirstLetter(order.order_status);

            // Set order summary details
            document.getElementById('order-title').textContent = acceptedService.title || 'N/A';
            document.getElementById('service-type').textContent = capitalizeFirstLetter(acceptedService.service_type || 'Unknown');
            document.getElementById('order-date').textContent = formatDate(order.created_at);
            document.getElementById('delivery-date').textContent = formatDate(order.delivered_date);
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
                        <div style="font-weight: 600;">${event.event}</div>
                        <div class="timeline-date">
                            ${formatDateTime(event.timestamp)}
                        </div>
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
                            <h4 style="margin: 0;">Buyer's Review</h4>
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
                            <h4 style="margin: 0;">Seller's Review</h4>
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
                    <img src="/${buyer.profile_picture || 'https://via.placeholder.com/70'}" alt="Buyer" class="user-avatar">
                    <div class="user-details">
                        <div class="user-name">${buyer.name || buyer.username || 'Unknown'}</div>
                        <div class="user-role">Business</div>
                        <div class="user-id">User ID: ${buyer.user_id || order.customer_id}</div>
                        <div>${buyer.email || ''}</div>
                        <div style="margin-top: 0.5rem;">
                            <a href="/admin/user-profile/${buyer.user_id || order.customer_id}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt"></i> View Profile
                            </a>
                        </div>
                    </div>
                `;
                    } else {
                        container.innerHTML = `
                    <div class="text-muted text-center" style="width: 100%;">Buyer information not available</div>
                `;
                    }
                });
        }

        async function fetchBuyerProfile(userId) {
            try {
                const response = await fetch(`/api/user/${userId}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch buyer profile');
                }
                const user = await response.json();
                return user;
            } catch (error) {
                console.error('Error fetching buyer profile:', error);
                return null;
            }
        }

        // Load seller profile
        function loadSellerProfile(data) {
            const container = document.getElementById('seller-profile');
            const order = data.order;
            const promise = data.promise || {};

            // Extract service type
            const acceptedService = JSON.parse(promise.accepted_service || '{}');
            const serviceType = acceptedService.service_type || 'Unknown';

            fetchSellerProfile(order.seller_id)
                .then(seller => {
                    if (seller) {
                        container.innerHTML = `
                    <img src="/${seller.profile_picture || 'https://via.placeholder.com/70'}" alt="Seller" class="user-avatar">
                    <div class="user-details">
                        <div class="user-name">${seller.name || seller.username || 'Unknown'}</div>
                        <div class="user-role">${serviceType === 'promotion' ? 'Influencer' : 'Designer'}</div>
                        <div class="user-id">User ID: ${seller.user_id || order.seller_id}</div>
                        <div>${seller.email || ''}</div>
                        <div style="margin-top: 0.5rem;">
                            <a href="/admin/user-profile/${seller.user_id || order.seller_id}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt"></i> View Profile
                            </a>
                        </div>
                    </div>
                `;
                    } else {
                        container.innerHTML = `
                    <div class="text-muted text-center" style="width: 100%;">Seller information not available</div>
                `;
                    }
                });
        }

        async function fetchSellerProfile(userId) {
            try {
                const response = await fetch(`/api/user/${userId}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch seller profile');
                }
                const seller = await response.json();
                return seller;
            } catch (error) {
                console.error('Error fetching seller profile:', error);
                return null;
            }
        }

        // Setup tab switching functionality
        function setupTabs() {
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            tabLinks.forEach(tabLink => {
                tabLink.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabLinks.forEach(tab => tab.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to current tab
                    this.classList.add('active');
                    document.getElementById(this.dataset.tab).classList.add('active');
                });
            });
        }

        // Setup form handlers
        function setupFormHandlers() {
            // Form submission handler
            document.getElementById('adminActionsForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const data = {};

                formData.forEach((value, key) => {
                    if (value) data[key] = value;
                });

                // Send API request to update order
                updateOrder(data);
            });

            // Refund button handler
            document.getElementById('refundBtn').addEventListener('click', function() {
                const amount = document.getElementById('refundAmount').value;
                if (!amount || amount <= 0) {
                    showNotification('Please enter a valid refund amount', 'error');
                    return;
                }

                if (confirm(`Are you sure you want to issue a refund of $${amount}?`)) {
                    // In a real implementation, this would call a refund API
                    showNotification(`Refund of $${amount} processed successfully`, 'success');
                }
            });

            // Dispute resolution handler
            const resolveDisputeBtn = document.getElementById('resolveDisputeBtn');
            if (resolveDisputeBtn) {
                resolveDisputeBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to mark this dispute as resolved?')) {
                        // Update order status to completed
                        const data = {
                            order_id: document.getElementById('form-order-id').value,
                            order_status: 'completed'
                        };

                        updateOrder(data, 'Dispute marked as resolved');
                    }
                });
            }

            // Toggle dropdown menus for buyer and seller actions
            document.getElementById('actOnBuyerBtn').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('buyerActionMenu').style.display =
                    document.getElementById('buyerActionMenu').style.display === 'none' ? 'block' : 'none';
                // Hide the other dropdown if open
                document.getElementById('sellerActionMenu').style.display = 'none';
            });

            document.getElementById('actOnSellerBtn').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('sellerActionMenu').style.display =
                    document.getElementById('sellerActionMenu').style.display === 'none' ? 'block' : 'none';
                // Hide the other dropdown if open
                document.getElementById('buyerActionMenu').style.display = 'none';
            });

            // Hide dropdowns when clicking elsewhere
            document.addEventListener('click', function(e) {
                if (!e.target.closest('#actOnBuyerBtn') && !e.target.closest('#buyerActionMenu')) {
                    document.getElementById('buyerActionMenu').style.display = 'none';
                }
                if (!e.target.closest('#actOnSellerBtn') && !e.target.closest('#sellerActionMenu')) {
                    document.getElementById('sellerActionMenu').style.display = 'none';
                }
            });

            // Handle buyer action menu clicks
            const buyerActions = document.querySelectorAll('.buyer-action');
            buyerActions.forEach(action => {
                action.addEventListener('click', function(e) {
                    e.preventDefault();
                    const actionType = this.dataset.action;
                    const buyerId = orderData.order.customer_id;

                    if (confirm(`Are you sure you want to ${actionType} this buyer?`)) {
                        updateUserAccountStatus(buyerId, actionType);
                    }

                    // Close the dropdown
                    document.getElementById('buyerActionMenu').style.display = 'none';
                });
            });

            // Handle seller action menu clicks
            const sellerActions = document.querySelectorAll('.seller-action');
            sellerActions.forEach(action => {
                action.addEventListener('click', function(e) {
                    e.preventDefault();
                    const actionType = this.dataset.action;
                    const sellerId = orderData.order.seller_id;

                    if (confirm(`Are you sure you want to ${actionType} this seller?`)) {
                        updateUserAccountStatus(sellerId, actionType);
                    }

                    // Close the dropdown
                    document.getElementById('sellerActionMenu').style.display = 'none';
                });
            });
        }

        // Update order via API
        function updateOrder(data, successMessage = 'Order updated successfully') {
            fetch('/api/update-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update order');
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.success) {
                        showNotification(successMessage, 'success');

                        // Refresh order data
                        fetchOrderDetails(data.order_id);
                    } else {
                        showNotification('Error: ' + result.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error updating order', 'error');
                });
        }

        // Function to update user account status
        function updateUserAccountStatus(userId, status) {
            fetch(`/api/update-user-account-status?id=${userId}&status=${status}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update user account status');
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.success) {
                        showNotification(`User has been ${status} successfully`, 'success');
                    } else {
                        showNotification('Error: ' + result.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error updating user account status', 'error');
                });
        }

        // Add admin note (mock implementation)
        function addAdminNote(noteText) {
            const container = document.getElementById('admin-notes-container');
            const noNotesMessage = container.querySelector('.text-muted.text-center');

            if (noNotesMessage) {
                noNotesMessage.remove();
            }

            const now = new Date();
            const formattedDate = formatDateTime(now.toISOString());

            const noteElement = document.createElement('div');
            noteElement.style.padding = '15px';
            noteElement.style.marginBottom = '15px';
            noteElement.style.backgroundColor = '#f8f9fa';
            noteElement.style.borderRadius = '5px';

            noteElement.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-weight: 600;">Admin User</span>
                    <small class="text-muted">${formattedDate}</small>
                </div>
                <p style="margin: 0;">${noteText}</p>
            `;

            container.insertBefore(noteElement, container.firstChild);
            document.getElementById('adminNote').value = '';

            showNotification('Note added successfully', 'success');
        }

        // Generate star rating HTML
        function generateStarRating(rating) {
            let html = '';

            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    html += '<i class="fas fa-star"></i>';
                } else if (i <= rating + 0.5) {
                    html += '<i class="fas fa-star-half-alt"></i>';
                } else {
                    html += '<i class="far fa-star"></i>';
                }
            }

            return html;
        }

        // Helper Functions
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        function formatDateTime(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }

        function formatPrice(price) {
            return '$' + parseFloat(price).toFixed(2);
        }

        function capitalizeFirstLetter(string) {
            if (!string) return '';
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function getStatusBadgeClass(status) {
            switch (status.toLowerCase()) {
                case 'pending':
                    return 'badge-warning';
                case 'in_progress':
                    return 'badge-info';
                case 'completed':
                    return 'badge-success';
                case 'canceled':
                    return 'badge-danger';
                case 'disputed':
                    return 'badge-danger';
                default:
                    return 'badge-secondary';
            }
        }

        // Show notification
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            const notificationMessage = document.getElementById('notification-message');

            notification.className = `notification ${type}`;
            notificationMessage.textContent = message;

            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 5000);
        }
    </script>
</body>

</html>