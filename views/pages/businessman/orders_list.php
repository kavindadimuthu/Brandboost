<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | BrandBoost</title>
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
            justify-content: flex-end;
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

        /* Provider Info */
        .provider-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .provider-avatar {
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

        .provider-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .provider-name {
            font-weight: 500;
            color: var(--gray-700);
        }

        .service-title {
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
            
            .service-title {
                max-width: 180px;
            }

            .hero-stat {
                min-width: 120px;
                padding: 12px 15px;
            }

            .hero-stat-number {
                font-size: 1.5rem;
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

            .order-controls {
                flex-direction: column;
                gap: 10px;
            }

            .sort-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1><i class="fas fa-shopping-bag"></i> My Orders</h1>
                    <p>Track and manage your orders from influencers and designers. View order status, delivery times, and complete history.</p>
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
                        <th>Provider</th>
                        <th>Service</th>
                        <th>Order Date</th>
                        <th>Delivery</th>
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

    <script>
        // Global state
        const state = {
            orders: [],
            filteredOrders: [],
            sortField: 'created_at',
            sortDirection: 'desc'
        };

        // Function to load data into the table
        async function loadOrdersData() {
            const tableBody = document.getElementById('ordersTableBody');
            
            try {
                const response = await fetch(`/api/orders?include_seller=true`);
                const result = await response.json();

                console.log('Orders data:', result);
                
                if (result.success !== false) {
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
                                <p class="empty-state-text">Error: ${result.message || 'Failed to load orders'}</p>
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
                    valueA = new Date(a.created_at);
                    valueB = new Date(b.created_at);
                } else if (state.sortField === 'price') {
                    valueA = parseFloat(a.promise.price.replace(/[^0-9.]/g, '')) || 0;
                    valueB = parseFloat(b.promise.price.replace(/[^0-9.]/g, '')) || 0;
                } else if (state.sortField === 'delivery_days') {
                    valueA = parseInt(a.promise.delivery_days) || 999;
                    valueB = parseInt(b.promise.delivery_days) || 999;
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
                            <a href="/businessman/request-order" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Place New Order
                            </a>
                        </td>
                    </tr>`;
                return;
            }
            
            tableBody.innerHTML = '';
            
            state.filteredOrders.forEach((order, index) => {
                try {
                    const jsonData = JSON.parse(order.promise.accepted_service);
                    const row = document.createElement('tr');
                    const providerInitials = getProviderInitials(order.seller.name);
                    const statusClass = order.order_status.toLowerCase().replace(' ', '-');
                    
                    // Format dates
                    const orderDate = new Date(order.created_at);
                    const formattedDate = orderDate.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                    const formattedTime = orderDate.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    
                    // Set animation delay based on index
                    row.classList.add('fade-in');
                    row.style.animationDelay = `${index * 0.05}s`;
                    
                    row.innerHTML = `
                        <td>
                            <div class="provider-info">
                                <div class="provider-avatar">
                                    ${order.seller.profile_pic 
                                        ? `<img src="${order.seller.profile_pic}" alt="${order.seller.name}">` 
                                        : providerInitials}
                                </div>
                                <span class="provider-name">${order.seller.name}</span>
                            </div>
                        </td>
                        <td>
                            <div class="service-title">${jsonData ? jsonData.title : 'N/A'}</div>
                            <small>${jsonData ? jsonData.service_type : 'Service'}</small>
                        </td>
                        <td>
                            <div class="date-display">
                                <span class="date-primary">${formattedDate}</span>
                                <span class="date-secondary">${formattedTime}</span>
                            </div>
                        </td>
                        <td>${formatDeliveryDays(order.promise.delivery_days)}</td>
                        <td><span class="price">${order.promise.price}</span></td>
                        <td><span class="status ${statusClass}">${order.order_status}</span></td>
                    `;
                    
                    row.addEventListener('click', () => {
                        window.location.href = '/businessman/order-details/' + order.order_id;
                    });
                    
                    tableBody.appendChild(row);
                } catch (error) {
                    console.error('Error rendering order:', error, order);
                }
            });
        }
        
        // Update dashboard stats
        function updateStats() {
            // Total orders
            document.getElementById('totalOrders').textContent = state.orders.length;
            
            // Active orders (in progress or pending)
            const activeOrders = state.orders.filter(order => 
                order.order_status.toLowerCase().includes('in progress') || 
                order.order_status.toLowerCase().includes('pending')
            ).length;
            document.getElementById('activeOrders').textContent = activeOrders;
            
            // Completed orders
            const completedOrders = state.orders.filter(order => 
                order.order_status.toLowerCase().includes('completed')
            ).length;
            document.getElementById('completedOrders').textContent = completedOrders;
        }
        
        // Get provider initials for avatar fallback
        function getProviderInitials(name) {
            if (!name) return '?';
            return name.split(' ')
                .map(word => word[0])
                .join('')
                .substring(0, 2)
                .toUpperCase();
        }
        
        // Format delivery days to be more readable
        function formatDeliveryDays(days) {
            if (!days) return 'N/A';
            
            if (days.toString().includes('Days')) {
                return days;
            }
            
            return `${days} Days`;
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

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            handleSortChange();
            loadOrdersData();
        });
    </script>
</body>
</html>