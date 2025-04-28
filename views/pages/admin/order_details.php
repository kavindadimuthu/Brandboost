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
        h1, h2, h3, h4, h5, h6 {
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
            color: #dc3545;
            background-color: #fff;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-danger:disabled, .btn-danger.disabled {
            color: #dc3545;
            background-color: #fff;
            border-color: #dc3545;
            opacity: 0.65;
            cursor: not-allowed;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            background-color: transparent;
            border-color: #3a86ff;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #3a86ff;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
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
            .grid {
                grid-template-columns: 1fr;
            }
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
                </div>

                <!-- Sidebar column for profiles and actions -->
                <div>
                    <div style="position: sticky; top: 1rem;">
                        <!-- Admin Actions Panel -->
                        <div class="card">
                            <div class="card-header">
                                <h2><i class="fas fa-tools"></i> Admin Actions</h2>
                            </div>
                            <div class="card-body">
                                <form id="adminActionsForm">
                                    <input type="hidden" name="order_id" id="form-order-id">
                                    
                                    <!-- Cancel Order Button -->
                                    <div class="form-group">
                                        <button type="button" id="cancelOrderBtn" class="btn btn-danger" style="width: 100%;">
                                            <i class="fas fa-ban"></i> Cancel Order & Process Refund
                                        </button>
                                        <small class="text-muted mt-2 d-block">This action will cancel the order and refund the buyer.</small>
                                    </div>
                                    
                                    <div id="dispute-action-container" style="margin-top: 15px; display: none;">
                                        <button type="button" id="resolveDisputeBtn" class="btn btn-success" style="width: 100%;">
                                            <i class="fas fa-check-circle"></i> Mark Dispute as Resolved
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- User Profiles -->
                        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1.5rem;">
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

                        // Load profile data
                        loadBuyerProfile(orderData);
                        loadSellerProfile(orderData);
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

            // Show/hide dispute resolution button
            const disputeActionContainer = document.getElementById('dispute-action-container');
            if (order.order_status === 'disputed') {
                disputeActionContainer.style.display = 'block';
            } else {
                disputeActionContainer.style.display = 'none';
            }

            // Disable cancel button if order is already canceled
            const cancelOrderBtn = document.getElementById('cancelOrderBtn');
            if (order.order_status === 'canceled') {
                cancelOrderBtn.disabled = true;
                cancelOrderBtn.classList.add('disabled');
                cancelOrderBtn.innerHTML = '<i class="fas fa-ban"></i> Order Already Canceled';
            }
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

        // Setup form handlers
        function setupFormHandlers() {
            // Handle order cancellation
            document.getElementById('cancelOrderBtn').addEventListener('click', function() {
                if (this.disabled) return;
                
                const orderId = document.getElementById('form-order-id').value;
                
                if (confirm('Are you sure you want to cancel this order and process a refund? This action cannot be undone.')) {
                    // Call the API to cancel the order and process refund
                    cancelOrder(orderId);
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
        }

        // Function to cancel order and process refund
        function cancelOrder(orderId) {
            // Prepare form data
            const formData = new FormData();
            formData.append('order_id', orderId);
            formData.append('status', 'accepted'); // 'accepted' triggers cancellation and refund in the API
            formData.append('responder', 'admin'); // Assuming the responder is admin for cancellation

            // Call the API to cancel the order
            fetch('/api/respond-to-cancellation', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to cancel order');
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    showNotification('Order cancelled and refund processed successfully', 'success');
                    
                    // Refresh order data to update the status display
                    fetchOrderDetails(orderId);
                } else {
                    showNotification('Error: ' + (result.message || 'Failed to cancel order'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error cancelling order: ' + error.message, 'error');
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