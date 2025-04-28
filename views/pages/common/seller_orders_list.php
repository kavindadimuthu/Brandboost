<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Orders | BrandBoost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5e72e4;
            --primary-dark: #4454c3;
            --primary-light: #edf2ff;
            --secondary: #7c44f1;
            --white: #ffffff;
            --light-bg: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --success: #2dce89;
            --warning: #fb6340;
            --danger: #f5365c;
            --pending: #6b7280;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--gray-700);
            line-height: 1.5;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            bottom: -50%;
            left: -50%;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
            transform: rotate(-20deg);
        }

        .hero-container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .hero-left {
            flex: 9;
        }

        .hero-right {
            flex: 7;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-end;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin-top: 5px;
        }

        .hero-stat {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 15px 20px;
            min-width: 140px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: var(--transition);
        }

        .hero-stat:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .hero-stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .hero-stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: -30px auto 40px;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        /* Order Controls */
        .order-controls {
            display: flex;
            justify-content: end;
            align-items: center;
            margin-bottom: 15px;
        }

        .sort-container {
            position: relative;
            width: 220px;
        }

        .sort-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            background-color: var(--white);
            appearance: none;
            font-size: 0.95rem;
            color: var(--gray-700);
            cursor: pointer;
            transition: var(--transition);
        }

        .sort-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
        }

        .sort-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            pointer-events: none;
        }

        /* Orders Container */
        .orders-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 40px;
            overflow: hidden;
        }

        /* Orders Table */
        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .orders-table th {
            text-align: left;
            padding: 16px;
            background: var(--gray-100);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.9rem;
            border-bottom: 2px solid var(--gray-200);
            position: relative;
        }

        .orders-table th.sortable {
            cursor: pointer;
        }

        .orders-table th.sortable:hover {
            background-color: var(--gray-200);
        }

        .orders-table th.sortable::after {
            content: "⇅";
            position: absolute;
            right: 10px;
            opacity: 0.5;
        }

        .orders-table th.sorted-asc::after {
            content: "↑";
            opacity: 1;
        }

        .orders-table th.sorted-desc::after {
            content: "↓";
            opacity: 1;
        }

        .orders-table td {
            padding: 16px;
            border-bottom: 1px solid var(--gray-200);
            font-size: 0.95rem;
            vertical-align: middle;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .orders-table tbody tr {
            transition: var(--transition);
        }

        .orders-table tbody tr:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
        }

        /* Status Badges */
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status.pending {
            background-color: rgba(107, 114, 128, 0.1);
            color: var(--pending);
        }

        .status.in-progress {
            background-color: rgba(251, 99, 64, 0.1);
            color: var(--warning);
        }

        .status.completed {
            background-color: rgba(45, 206, 137, 0.1);
            color: var(--success);
        }

        .status.canceled {
            background-color: rgba(245, 54, 92, 0.1);
            color: var(--danger);
        }

        /* Buyer Info */
        .buyer-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .buyer-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--primary);
            font-size: 1rem;
            overflow: hidden;
        }

        .buyer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .buyer-name {
            font-weight: 500;
            color: var(--gray-700);
        }

        .gig-title {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--gray-700);
            font-weight: 500;
        }

        .date-display {
            display: flex;
            flex-direction: column;
        }

        .date-primary {
            font-weight: 500;
            color: var(--gray-700);
        }

        .date-secondary {
            font-size: 0.8rem;
            color: var(--gray-500);
            margin-top: 2px;
        }

        .price {
            font-weight: 600;
            color: var(--gray-700);
        }

        /* Empty and Loading States */
        .empty-state, .loading-state {
            text-align: center;
            padding: 60px 0;
        }

        .empty-state i, .loading-state i {
            font-size: 3.5rem;
            color: var(--gray-300);
            margin-bottom: 20px;
        }

        .empty-state-text {
            color: var(--gray-500);
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .spinner {
            display: inline-block;
            width: 3.5rem;
            height: 3.5rem;
            border: 3px solid rgba(94, 114, 228, 0.1);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-right {
                justify-content: flex-start;
                width: 100%;
            }

            .order-controls {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .search-container, .sort-container {
                width: 100%;
                max-width: none;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 60px 0;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }

            .orders-container {
                padding: 20px 15px;
                overflow-x: auto;
            }
            
            .orders-table {
                min-width: 900px;
            }
            
            .gig-title {
                max-width: 180px;
            }

            .hero-stat {
                min-width: 120px;
                padding: 12px 15px;
            }

            .hero-stat-number {
                font-size: 1.5rem;
            }

            .filter-tabs {
                flex-wrap: wrap;
            }

            .filter-tab {
                padding: 10px 5px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .hero-container {
                padding: 0 15px;
            }
            
            .container {
                padding: 0 15px;
                margin-top: -20px;
            }

            .hero-right {
                flex-wrap: wrap;
                gap: 10px;
            }

            .hero-stat {
                flex: 1;
                min-width: 100px;
            }
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 10px rgba(94, 114, 228, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(94, 114, 228, 0.4);
        }

        /* Order Review Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: var(--white);
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(20px);
            transition: transform 0.3s ease;
            padding: 0;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 20px 25px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--primary-light);
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--gray-600);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger);
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            padding: 20px 25px;
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .order-detail-section {
            margin-bottom: 20px;
        }

        .order-detail-heading {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .order-detail-content {
            background-color: var(--gray-100);
            padding: 15px;
            border-radius: 8px;
            color: var(--gray-700);
        }

        .order-detail-list {
            list-style-type: none;
        }

        .order-detail-list li {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }

        .order-detail-label {
            min-width: 130px;
            font-weight: 500;
            color: var(--gray-600);
        }

        .btn-action-group {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-success {
            background-color: var(--success);
            color: white;
        }

        .btn-success:hover {
            background-color: #25a870;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #e02952;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: var(--gray-500);
            color: white;
        }

        .btn-secondary:hover {
            background-color: var(--gray-600);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1><i class="fas fa-clipboard-list"></i> My Customer Orders</h1>
                    <p>Track, manage, and deliver orders from your customers. Keep track of deadlines and maintain your service quality.</p>
                </div>
                <div class="hero-right">
                    <div class="hero-stat">
                        <div class="hero-stat-number" id="totalOrders">0</div>
                        <div class="hero-stat-label">Total Orders</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number" id="activeOrders">0</div>
                        <div class="hero-stat-label">Active Orders</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number" id="completedOrders">0</div>
                        <div class="hero-stat-label">Completed</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="order-controls">
            <div class="sort-container">
                <select id="sortSelect" class="sort-select">
                    <option value="created_at_desc">Newest First</option>
                    <option value="created_at_asc">Oldest First</option>
                    <!-- <option value="price_desc">Price: High to Low</option> -->
                    <!-- <option value="price_asc">Price: Low to High</option> -->
                    <!-- <option value="delivery_days_asc">Due Date: Soonest First</option> -->
                </select>
                <div class="sort-icon">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>

        <div class="orders-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Buyer</th>
                        <th>Service</th>
                        <th>Order Date</th>
                        <th>Due Date</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                    <tr>
                        <td colspan="6" class="loading-state">
                            <div class="spinner"></div>
                            <p>Loading your orders...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Order Review Modal -->
    <div id="orderReviewModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-clipboard-check"></i> New Order Review</h3>
                <button class="modal-close" id="modalClose">&times;</button>
            </div>
            <div class="modal-body" id="orderReviewModalBody">
                <!-- Modal content will be dynamically populated -->
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" id="rejectOrderBtn">Reject Order</button>
                <button class="btn btn-success" id="acceptOrderBtn">Accept Order</button>
            </div>
        </div>
    </div>

    <script>
        // Global state
        const state = {
            orders: [],
            filteredOrders: [],
            sortField: 'created_at',
            sortDirection: 'desc',
            currentOrderId: null,
            currentSellerRole: null
        };

        // Fetch orders from API
        async function fetchOrders() {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="loading-state">
                        <div class="spinner"></div>
                        <p>Loading your orders...</p>
                    </td>
                </tr>`;
            
            try {
                const response = await fetch(`/api/orders/seller`, {
                    method: 'GET'
                });
                
                const result = await response.json();
                
                if (result.success) {
                    state.orders = result.data;
                    state.filteredOrders = [...state.orders];
                    sortOrders();
                    renderOrders();
                    updateStats();
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="fas fa-exclamation-circle"></i>
                                <p class="empty-state-text">Error: ${result.message}</p>
                            </td>
                        </tr>`;
                }
            } catch (error) {
                console.error('Error fetching orders:', error);
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p class="empty-state-text">Failed to load orders. Please try again later.</p>
                        </td>
                    </tr>`;
            }
        }

        // Sort orders based on the current sort field and direction
        function sortOrders() {
            state.filteredOrders.sort((a, b) => {
                let valueA, valueB;
                
                // Extract values based on sort field
                if (state.sortField === 'created_at') {
                    valueA = new Date(a.created_at || a.order_date || 0);
                    valueB = new Date(b.created_at || b.order_date || 0);
                } else if (state.sortField === 'price') {
                    valueA = parseFloat(a.total?.replace(/[^0-9.]/g, '') || 0);
                    valueB = parseFloat(b.total?.replace(/[^0-9.]/g, '') || 0);
                } else if (state.sortField === 'delivery_days') {
                    // Due date sorting
                    valueA = new Date(a.dueOn || '9999-12-31');
                    valueB = new Date(b.dueOn || '9999-12-31');
                    
                    // Handle "Delivered" text
                    if (a.dueOn === 'Delivered') valueA = new Date('9999-12-31');
                    if (b.dueOn === 'Delivered') valueB = new Date('9999-12-31');
                } else {
                    valueA = a[state.sortField];
                    valueB = b[state.sortField];
                }
                
                // Compare values based on sort direction
                if (state.sortDirection === 'asc') {
                    return valueA > valueB ? 1 : valueA < valueB ? -1 : 0;
                } else {
                    return valueA < valueB ? 1 : valueA > valueB ? -1 : 0;
                }
            });
        }

        // Render orders to table
        function renderOrders() {
            const tableBody = document.getElementById('ordersTableBody');
            
            if (state.filteredOrders.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p class="empty-state-text">No orders found</p>
                        </td>
                    </tr>`;
                return;
            }
            
            tableBody.innerHTML = '';
            
            state.filteredOrders.forEach((order, index) => {
                try {
                    const row = document.createElement('tr');
                    const buyerInitials = getBuyerInitials(order.buyer);
                    const statusClass = order.status.toLowerCase().replace(' ', '-');
                    
                    // Format dates
                    const formattedOrderDate = formatOrderDate(order.created_at || order.order_date);
                    const dueDate = formatDueDate(order.dueOn);
                    
                    // Set animation delay based on index
                    row.classList.add('fade-in');
                    row.style.animationDelay = `${index * 0.05}s`;
                    
                    // Check if this is an influencer with a pending order
                    const isPendingInfluencerOrder = 
                        order.seller_role === 'influencer' && 
                        order.status.toLowerCase() === 'pending';
                    
                    // Prepare status cell content
                    let statusCellContent = `<span class="status ${statusClass}">${order.status}</span>`;
                    
                    // Add action buttons for pending influencer orders
                    if (isPendingInfluencerOrder) {
                        statusCellContent = `
                            <span class="status ${statusClass}">${order.status}</span>
                            <div class="btn-action-group">
                                <button class="btn btn-sm btn-success review-order-btn" 
                                    data-order-id="${order.order_id}" 
                                    data-action="review">Review</button>
                            </div>
                        `;
                    }
                    
                    row.innerHTML = `
                        <td>
                            <div class="buyer-info">
                                <div class="buyer-avatar">
                                    ${order.buyer_profile_pic 
                                        ? `<img src="${order.buyer_profile_pic}" alt="${order.buyer}">` 
                                        : buyerInitials}
                                </div>
                                <span class="buyer-name">${order.buyer}</span>
                            </div>
                        </td>
                        <td>
                            <div class="gig-title">${order.gig}</div>
                        </td>
                        <td>
                            ${formattedOrderDate.html}
                        </td>
                        <td>${dueDate}</td>
                        <td><span class="price">${order.total}</span></td>
                        <td>${statusCellContent}</td>
                    `;
                    
                    // Only add click event for non-pending orders or for row clicks that aren't on buttons
                    if (!isPendingInfluencerOrder) {
                        row.addEventListener('click', () => navigateToOrderDetails(order.order_id, order.seller_role));
                    } else {
                        // For pending orders, add click handlers only to cells other than the status cell
                        const cells = row.querySelectorAll('td:not(:last-child)');
                        cells.forEach(cell => {
                            cell.addEventListener('click', () => showOrderReviewModal(order));
                        });
                    }
                    
                    tableBody.appendChild(row);
                } catch (error) {
                    console.error('Error rendering order:', error, order);
                }
            });
            
            // Add event listeners to review buttons
            document.querySelectorAll('.review-order-btn').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevent row click
                    const orderId = button.getAttribute('data-order-id');
                    const order = state.orders.find(o => o.order_id === orderId);
                    if (order) {
                        showOrderReviewModal(order);
                    }
                });
            });
        }

        // Update dashboard stats
        function updateStats() {
            // Total orders
            document.getElementById('totalOrders').textContent = state.orders.length;
            
            // Active orders (in progress or pending)
            const activeOrders = state.orders.filter(order => 
                order.status.toLowerCase() === 'pending' || 
                order.status.toLowerCase() === 'in progress'
            ).length;
            document.getElementById('activeOrders').textContent = activeOrders;
            
            // Completed orders
            const completedOrders = state.orders.filter(order => 
                order.status.toLowerCase() === 'completed'
            ).length;
            document.getElementById('completedOrders').textContent = completedOrders;
        }

        // Format the order date
        function formatOrderDate(dateString) {
            if (!dateString) return { text: 'N/A', html: 'N/A' };
            
            const orderDate = new Date(dateString);
            if (isNaN(orderDate.getTime())) return { text: 'N/A', html: 'N/A' };
            
            const formattedDate = orderDate.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            
            const formattedTime = orderDate.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            return {
                text: `${formattedDate} ${formattedTime}`,
                html: `<div class="date-display">
                    <span class="date-primary">${formattedDate}</span>
                    <span class="date-secondary">${formattedTime}</span>
                </div>`
            };
        }

        // Format due date
        function formatDueDate(dateString) {
            if (!dateString) return 'N/A';
            if (dateString === 'Delivered') return 'Delivered';
            
            try {
                // Try to parse as a date
                const dueDate = new Date(dateString);
                
                if (!isNaN(dueDate.getTime())) {
                    // Calculate days left
                    const today = new Date();
                    const diffTime = dueDate - today;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    const formattedDate = dueDate.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                    
                    if (diffDays < 0) {
                        return `<span style="color:var(--danger)">${formattedDate} (Overdue)</span>`;
                    } else if (diffDays === 0) {
                        return `<span style="color:var(--warning)">${formattedDate} (Today)</span>`;
                    } else if (diffDays === 1) {
                        return `<span style="color:var(--warning)">${formattedDate} (Tomorrow)</span>`;
                    } else if (diffDays <= 3) {
                        return `<span style="color:var(--warning)">${formattedDate} (${diffDays} days left)</span>`;
                    } else {
                        return `${formattedDate} (${diffDays} days left)`;
                    }
                }
            } catch (e) {
                // If date parsing fails, just return the string
            }
            
            return dateString;
        }

        // Get buyer initials for avatar
        function getBuyerInitials(name) {
            if (!name) return '?';
            return name.split(' ')
                .map(word => word[0])
                .join('')
                .substring(0, 2)
                .toUpperCase();
        }

        // Navigate to order details page
        function navigateToOrderDetails(orderId, sellerRole) {
            // Don't navigate for pending orders
            const order = state.orders.find(o => o.order_id === orderId);
            if (order && order.status.toLowerCase() === 'pending' && order.seller_role === 'influencer') {
                showOrderReviewModal(order);
                return;
            }
            
            if (sellerRole === 'designer') {
                window.location.href = `/designer/order-details/${orderId}`;
            } else if (sellerRole === 'influencer') {
                window.location.href = `/influencer/order-details/${orderId}`;
            } else {
                // Default path if role is not specified
                window.location.href = `/order-details/${orderId}`;
            }
        }

        // Show order review modal
        function showOrderReviewModal(order) {
            const modal = document.getElementById('orderReviewModal');
            const modalBody = document.getElementById('orderReviewModalBody');
            
            // Store current order ID for accept/reject actions
            state.currentOrderId = order.order_id;
            state.currentSellerRole = order.seller_role;
            
            // Format order data for display
            const formattedOrderDate = formatOrderDate(order.created_at || order.order_date);
            
            modalBody.innerHTML = `
                <div class="order-detail-section">
                    <h4 class="order-detail-heading"><i class="fas fa-info-circle"></i> Order Information</h4>
                    <ul class="order-detail-list">
                        <li>
                            <span class="order-detail-label">Order ID:</span>
                            <span>#${order.order_id}</span>
                        </li>
                        <li>
                            <span class="order-detail-label">Buyer:</span>
                            <span>${order.buyer}</span>
                        </li>
                        <li>
                            <span class="order-detail-label">Service:</span>
                            <span>${order.gig}</span>
                        </li>
                        <li>
                            <span class="order-detail-label">Order Date:</span>
                            <span>${formattedOrderDate.text}</span>
                        </li>
                        <li>
                            <span class="order-detail-label">Price:</span>
                            <span>${order.total}</span>
                        </li>
                    </ul>
                </div>
                
                <div class="order-detail-section">
                    <h4 class="order-detail-heading"><i class="fas fa-exclamation-triangle"></i> Important Note</h4>
                    <div class="order-detail-content">
                        <p>By accepting this order, you agree to complete the requested service according to the terms and timeline. The buyer has already paid for this order, and the funds will be released to you upon successful completion.</p>
                        <p>If you reject this order, it will be canceled and the buyer will be refunded.</p>
                    </div>
                </div>
            `;
            
            // Show the modal
            modal.classList.add('active');
            
            // Add event listener to close button
            document.getElementById('modalClose').addEventListener('click', () => {
                modal.classList.remove('active');
            });
            
            // Set up accept button
            document.getElementById('acceptOrderBtn').onclick = () => acceptOrder(order.order_id);
            
            // Set up reject button
            document.getElementById('rejectOrderBtn').onclick = () => rejectOrder(order.order_id);
        }

        // Accept order
        async function acceptOrder(orderId) {
            try {
                // Show loading state
                const acceptBtn = document.getElementById('acceptOrderBtn');
                const rejectBtn = document.getElementById('rejectOrderBtn');
                acceptBtn.disabled = true;
                rejectBtn.disabled = true;
                acceptBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('order_id', orderId);
                formData.append('status', 'in_progress');
                
                // Make API request to accept the order
                const response = await fetch('/api/update-order-status', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Close modal
                    document.getElementById('orderReviewModal').classList.remove('active');
                    
                    // Show success message
                    alert('Order accepted successfully! You can now begin working on this order.');
                    
                    // Refresh orders
                    fetchOrders();
                } else {
                    alert('Failed to accept order: ' + result.message);
                    
                    // Reset buttons
                    acceptBtn.disabled = false;
                    rejectBtn.disabled = false;
                    acceptBtn.innerHTML = 'Accept Order';
                }
            } catch (error) {
                console.error('Error accepting order:', error);
                alert('An error occurred while accepting the order. Please try again.');
                
                // Reset accept button
                const acceptBtn = document.getElementById('acceptOrderBtn');
                const rejectBtn = document.getElementById('rejectOrderBtn');
                acceptBtn.disabled = false;
                rejectBtn.disabled = false;
                acceptBtn.innerHTML = 'Accept Order';
            }
        }

        // Reject order
        async function rejectOrder(orderId) {
            try {
                // Confirm rejection
                if (!confirm('Are you sure you want to reject this order? This action cannot be undone.')) {
                    return;
                }
                
                // Show loading state
                const acceptBtn = document.getElementById('acceptOrderBtn');
                const rejectBtn = document.getElementById('rejectOrderBtn');
                acceptBtn.disabled = true;
                rejectBtn.disabled = true;
                rejectBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                
                // Create form data for the request
                const formData = new FormData();
                formData.append('order_id', orderId);
                formData.append('status', 'accepted'); // This matches the cancellation logic in the controller
                
                // Make API request to reject the order
                const response = await fetch('/api/respond-to-cancellation', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Close modal
                    document.getElementById('orderReviewModal').classList.remove('active');
                    
                    // Show success message
                    alert('Order has been rejected and canceled.');
                    
                    // Refresh orders
                    fetchOrders();
                } else {
                    alert('Failed to reject order: ' + result.message);
                    
                    // Reset buttons
                    acceptBtn.disabled = false;
                    rejectBtn.disabled = false;
                    rejectBtn.innerHTML = 'Reject Order';
                }
            } catch (error) {
                console.error('Error rejecting order:', error);
                alert('An error occurred while rejecting the order. Please try again.');
                
                // Reset reject button
                const acceptBtn = document.getElementById('acceptOrderBtn');
                const rejectBtn = document.getElementById('rejectOrderBtn');
                acceptBtn.disabled = false;
                rejectBtn.disabled = false;
                rejectBtn.innerHTML = 'Reject Order';
            }
        }

        // Format the order date
        function formatOrderDate(dateString) {
            if (!dateString) return { text: 'N/A', html: 'N/A' };
            
            const orderDate = new Date(dateString);
            if (isNaN(orderDate.getTime())) return { text: 'N/A', html: 'N/A' };
            
            const formattedDate = orderDate.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            
            const formattedTime = orderDate.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            return {
                text: `${formattedDate} ${formattedTime}`,
                html: `<div class="date-display">
                    <span class="date-primary">${formattedDate}</span>
                    <span class="date-secondary">${formattedTime}</span>
                </div>`
            };
        }

        // Format due date
        function formatDueDate(dateString) {
            if (!dateString) return 'N/A';
            if (dateString === 'Delivered') return 'Delivered';
            
            try {
                // Try to parse as a date
                const dueDate = new Date(dateString);
                
                if (!isNaN(dueDate.getTime())) {
                    // Calculate days left
                    const today = new Date();
                    const diffTime = dueDate - today;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    const formattedDate = dueDate.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                    
                    if (diffDays < 0) {
                        return `<span style="color:var(--danger)">${formattedDate} (Overdue)</span>`;
                    } else if (diffDays === 0) {
                        return `<span style="color:var(--warning)">${formattedDate} (Today)</span>`;
                    } else if (diffDays === 1) {
                        return `<span style="color:var(--warning)">${formattedDate} (Tomorrow)</span>`;
                    } else if (diffDays <= 3) {
                        return `<span style="color:var(--warning)">${formattedDate} (${diffDays} days left)</span>`;
                    } else {
                        return `${formattedDate} (${diffDays} days left)`;
                    }
                }
            } catch (e) {
                // If date parsing fails, just return the string
            }
            
            return dateString;
        }

        // Get buyer initials for avatar
        function getBuyerInitials(name) {
            if (!name) return '?';
            return name.split(' ')
                .map(word => word[0])
                .join('')
                .substring(0, 2)
                .toUpperCase();
        }

        // Handle sort selection change
        function handleSortChange() {
            const sortSelect = document.getElementById('sortSelect');
            
            sortSelect.addEventListener('change', (e) => {
                const [field, direction] = e.target.value.split('_');
                state.sortField = field;
                state.sortDirection = direction;
                
                sortOrders();
                renderOrders();
            });
        }

        // Handle clicks outside the modal to close it
        window.addEventListener('click', (e) => {
            const modal = document.getElementById('orderReviewModal');
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            handleSortChange();
            fetchOrders();
        });
    </script>
</body>
</html>