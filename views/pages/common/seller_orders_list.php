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
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--gray-700);
            line-height: 1.5;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 40px 0;
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
            text-align: left;
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
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-content {
            margin-top: -30px;
            position: relative;
            z-index: 1;
        }

        /* Stats Grid */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .stat-label {
            color: var(--gray-500);
            font-size: 0.9rem;
        }

        /* Orders Container */
        .orders-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 40px;
        }

        .search-container {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .search-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }

        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: var(--white);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
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
        }

        /* Status Badges */
        .status {
            display: inline-block;
            padding: 5px 12px;
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

        .price {
            font-weight: 600;
            color: var(--gray-700);
        }

        /* Empty and Loading States */
        .empty-state, .loading-state {
            text-align: center;
            padding: 50px 0;
        }

        .empty-state i, .loading-state i {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 20px;
        }

        .empty-state-text {
            color: var(--gray-500);
            font-size: 1rem;
        }

        .spinner {
            display: inline-block;
            width: 3rem;
            height: 3rem;
            border: 3px solid rgba(94, 114, 228, 0.1);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin: 1.5rem 0;
            gap: 0.5rem;
        }

        .pagination button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border: none;
            background-color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            color: var(--gray-700);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .pagination button:hover:not(:disabled) {
            background-color: var(--primary);
            color: white;
        }

        .pagination button.active {
            background-color: var(--primary);
            color: white;
        }

        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 30px 0;
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
                min-width: 800px;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .gig-title {
                max-width: 180px;
            }
        }

        @media (max-width: 480px) {
            .hero-container {
                padding: 0 15px;
            }
            
            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1><i class="fas fa-clipboard-list"></i> Your Orders</h1>
                <p>Track and manage orders from your customers.</p>
            </div>
        </div>
    </div>

    <div class="container page-content">
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number" id="totalOrders">0</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="pendingOrders">0</div>
                <div class="stat-label">Pending Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="completedOrders">0</div>
                <div class="stat-label">Completed Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalRevenue">$0</div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>

        <div class="orders-container">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Search by buyer name or gig title">
            </div>
            
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Buyer</th>
                        <th>Gig</th>
                        <th>Due On</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                    <tr>
                        <td colspan="5" class="loading-state">
                            <div class="spinner"></div>
                            <p>Loading your orders...</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="pagination" id="pagination">
                <!-- Pagination will be generated dynamically -->
            </div>
        </div>
    </div>

    <script>
        // Global state
        const state = {
            orders: [],
            filteredOrders: [],
            searchTerm: ''
        };

        // Fetch orders from API
        async function fetchOrders() {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="loading-state">
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
                    renderOrders();
                    updateStats(state.orders);
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="fas fa-exclamation-circle"></i>
                                <p class="empty-state-text">Error: ${result.message}</p>
                            </td>
                        </tr>`;
                }
            } catch (error) {
                console.error('Error fetching orders:', error);
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p class="empty-state-text">Failed to load orders. Please try again later.</p>
                        </td>
                    </tr>`;
            }
        }

        // Render orders to table
        function renderOrders() {
            const tableBody = document.getElementById('ordersTableBody');
            
            if (state.filteredOrders.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p class="empty-state-text">No orders found</p>
                        </td>
                    </tr>`;
                return;
            }
            
            tableBody.innerHTML = '';
            
            state.filteredOrders.forEach(order => {
                if (!order.order_id) {
                    console.error('Invalid order ID:', order);
                    return;
                }
                
                const row = document.createElement('tr');
                const statusClass = order.status.toLowerCase().replace(' ', '-');
                const buyerInitials = getBuyerInitials(order.buyer);
                
                row.innerHTML = `
                    <td>
                        <div class="buyer-info">
                            <div class="buyer-avatar">${buyerInitials}</div>
                            <span class="buyer-name">${order.buyer}</span>
                        </div>
                    </td>
                    <td><div class="gig-title">${order.gig}</div></td>
                    <td>${formatDate(order.dueOn)}</td>
                    <td><span class="price">$${order.total}</span></td>
                    <td><span class="status ${statusClass}">${order.status}</span></td>
                `;
                
                row.addEventListener('click', () => navigateToOrderDetails(order.order_id, order.seller_role));
                tableBody.appendChild(row);
            });
        }
        
        // Update dashboard stats
        function updateStats(orders) {
            // Total orders
            document.getElementById('totalOrders').textContent = orders.length;
            
            // Pending orders
            const pendingOrders = orders.filter(order => 
                order.status.toLowerCase() === 'pending' || 
                order.status.toLowerCase() === 'in progress'
            ).length;
            document.getElementById('pendingOrders').textContent = pendingOrders;
            
            // Completed orders
            const completedOrders = orders.filter(order => 
                order.status.toLowerCase() === 'completed'
            ).length;
            document.getElementById('completedOrders').textContent = completedOrders;
            
            // Total revenue from completed orders
            const totalRevenue = orders
                .filter(order => order.status.toLowerCase() === 'completed')
                .reduce((sum, order) => sum + parseFloat(order.total || 0), 0);
            document.getElementById('totalRevenue').textContent = '$' + totalRevenue.toFixed(2);
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
        
        // Format date to be more readable
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            
            const options = { month: 'short', day: 'numeric', year: 'numeric' };
            const date = new Date(dateString);
            
            if (isNaN(date)) return dateString;
            
            return date.toLocaleDateString('en-US', options);
        }
        
        // Navigate to order details page
        function navigateToOrderDetails(orderId, sellerRole) {
            if (sellerRole == 'designer') {
                window.location.href = `/designer/order-details/${orderId}`;
            } else if (sellerRole == 'influencer') {
                window.location.href = `/influencer/order-details/${orderId}`;
            }
        }

        // Filter orders based on search term
        function filterOrders() {
            if (!state.searchTerm) {
                state.filteredOrders = [...state.orders];
            } else {
                const term = state.searchTerm.toLowerCase();
                state.filteredOrders = state.orders.filter(order => 
                    order.buyer.toLowerCase().includes(term) || 
                    order.gig.toLowerCase().includes(term)
                );
            }
            renderOrders();
        }

        // Handle search input
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            let debounceTimeout;
            
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimeout);
                
                debounceTimeout = setTimeout(() => {
                    state.searchTerm = e.target.value.trim();
                    filterOrders();
                }, 300); // Debounce for 300ms
            });
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            setupSearch();
            fetchOrders();
        });
    </script>
</body>
</html>