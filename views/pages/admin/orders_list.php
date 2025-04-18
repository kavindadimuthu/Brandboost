<html>

<head>
    <title>
        Order Management
    </title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            display: flex;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header .breadcrumb {
            font-size: 14px;
            color: #333;
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .header .user-info span {
            font-size: 14px;
        }

        .main-content {
            width: 100%;
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .main-content h2,
        .main-content p,
        .main-content th,
        .main-content td {
            color: #666;
            font-size: 14px;
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .main-content .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .main-content .search-bar input {
            width: 400px;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .main-content .search-bar .filter-container {
            display: flex;
            gap: 10px;
        }

        .main-content .search-bar .filter-container select {
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: white;
        }

        .main-content .search-bar button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .main-content table {
            width: 100%;
            border-collapse: collapse;
        }

        .main-content table th,
        .main-content table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }

        .main-content table th {
            background-color: #f9f9f9;
            position: relative;
            cursor: pointer;
        }

        .main-content table th:hover {
            background-color: #f2f2f2;
        }

        .main-content table th .sort-icon {
            margin-left: 5px;
            opacity: 0.5;
        }

        .main-content table th.sorted .sort-icon {
            opacity: 1;
        }

        .order-id-column {
            display: none;
        }

        .main-content table td .user-info {
            display: flex;
            align-items: center;
        }

        .main-content table td .user-info img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .main-content .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .main-content .pagination button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
            margin: 0 4px;
            color: #888;
        }

        .main-content .pagination button.active {
            font-weight: bold;
            color: #000;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
        }

        .badge.pending {
            background-color: #ffc107;
            color: #212529;
        }

        .badge.in_progress {
            background-color: #17a2b8;
        }

        .badge.completed {
            background-color: #28a745;
        }

        .badge.canceled {
            background-color: #dc3545;
        }

        /* Action buttons Styles */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .action-buttons .view-btn {
            background-color: #634ce1;
        }

        .action-buttons .edit-btn {
            background-color: #28a745;
        }

        .loading-indicator {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #6a11cb;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #666;
        }

        .price {
            font-weight: bold;
            color: #333;
        }

        /* Card view for mobile */
        @media (max-width: 768px) {
            .main-content table {
                display: none;
            }

            .order-cards {
                display: grid;
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .order-card {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                padding: 15px;
            }

            .order-card-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                border-bottom: 1px solid #eee;
                padding-bottom: 10px;
            }

            .order-card-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .order-card-footer {
                margin-top: 15px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }

        /* Date range picker styles */
        .date-range-container {
            position: relative;
        }

        .date-range-container input {
            padding-right: 30px;
        }

        .date-range-container .calendar-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6a11cb;
            pointer-events: none;
        }

        .card-info {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .info-card {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 10px;
            padding: 15px;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .info-card h3 {
            margin-top: 0;
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 5px;
        }

        .info-card .value {
            font-size: 28px;
            font-weight: bold;
        }

        .info-card .trend {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 12px;
        }

        .info-card .trend i {
            margin-right: 5px;
        }

        .info-card .trend.up {
            color: #4cd964;
        }

        .info-card .trend.down {
            color: #ff3b30;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">Sisyphus Ventures &gt; Order management</div>
                <div class="user-info">
                    <img alt="User profile picture" height="30"
                        src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
                        width="30" />
                    <span><?php echo $_SESSION['user']['username'] ?? 'Admin'; ?></span>
                </div>
            </div>
            <h2>Order management</h2>
            <p>
                View and manage all orders placed on your platform.
            </p>

            <div class="card-info">
                <div class="info-card">
                    <h3>Total Orders</h3>
                    <div class="value" id="totalOrders">-</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </div>
                </div>
                <div class="info-card">
                    <h3>Pending Orders</h3>
                    <div class="value" id="pendingOrders">-</div>
                    <div class="trend down">
                        <i class="fas fa-arrow-down"></i> 5% from last month
                    </div>
                </div>
                <div class="info-card">
                    <h3>Completed Orders</h3>
                    <div class="value" id="completedOrders">-</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 8% from last month
                    </div>
                </div>
                <div class="info-card">
                    <h3>Total Revenue</h3>
                    <div class="value" id="totalRevenue">-</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 15% from last month
                    </div>
                </div>
            </div>

            <div class="search-bar">
                <input id="searchInput" placeholder="Search by order ID or customer name" type="text" />
                <div class="filter-container">
                    <select id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                    <div class="date-range-container">
                        <input id="dateRange" placeholder="Date range" type="text" />
                        <i class="fas fa-calendar calendar-icon"></i>
                    </div>
                    <select id="sortBy">
                        <option value="created_at">Sort by Date</option>
                        <option value="price">Sort by Price</option>
                        <option value="delivery_days">Sort by Delivery Days</option>
                    </select>
                    <button id="searchButton">Search</button>
                </div>
            </div>
            <div id="loadingIndicator" class="loading-indicator">Loading orders...</div>
            <table id="ordersTable" style="display: none;">
                <thead>
                    <tr>
                        <th class="order-id-column">Order ID</th>
                        <th data-sort="order_id">Order # <i class="fas fa-sort sort-icon"></i></th>
                        <th data-sort="customer">Customer <i class="fas fa-sort sort-icon"></i></th>
                        <th data-sort="seller">Seller <i class="fas fa-sort sort-icon"></i></th>
                        <th data-sort="service">Service <i class="fas fa-sort sort-icon"></i></th>
                        <th data-sort="price">Price <i class="fas fa-sort sort-icon"></i></th>
                        <th data-sort="order_status">Status <i class="fas fa-sort sort-icon"></i></th>
                        <th data-sort="delivery_days">Delivery <i class="fas fa-sort sort-icon"></i></th>
                        <th data-sort="created_at">Date <i class="fas fa-sort sort-icon"></i></th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="orderCards" class="order-cards" style="display: none;"></div>
            <div id="noResults" class="no-results" style="display: none;">No orders found matching your criteria.</div>
            <div class="pagination" id="pagination">
                <!-- Pagination buttons will be generated here -->
            </div>
        </div>
    </div>

    <script>
        // State management
        let orders = [];
        let currentPage = 1;
        let itemsPerPage = 10;
        let totalPages = 1;
        let orderStats = {
            total: 0,
            pending: 0,
            completed: 0,
            revenue: 0
        };
        let currentFilters = {
            search: '',
            order_status: '',
            date_from: '',
            date_to: '',
            limit: itemsPerPage,
            offset: 0,
            sort_by: 'created_at',
            order_dir: 'desc',
            include_customer: true,
            include_seller: true
        };

        // DOM elements
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const dateRange = document.getElementById('dateRange');
        const sortByFilter = document.getElementById('sortBy');
        const searchButton = document.getElementById('searchButton');
        const ordersTable = document.getElementById('ordersTable');
        const orderCards = document.getElementById('orderCards');
        const tableBody = document.querySelector('#ordersTable tbody');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const noResults = document.getElementById('noResults');
        const pagination = document.getElementById('pagination');
        
        // Stats elements
        const totalOrdersEl = document.getElementById('totalOrders');
        const pendingOrdersEl = document.getElementById('pendingOrders');
        const completedOrdersEl = document.getElementById('completedOrders');
        const totalRevenueEl = document.getElementById('totalRevenue');

        // Helper functions to format dates
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString;
            return date.toLocaleDateString();
        }

        // Format price with currency
        function formatPrice(price) {
            return '$' + parseFloat(price).toFixed(2);
        }

        // Format delivery timeframe
        function formatDelivery(days) {
            return days === 1 ? '1 day' : days + ' days';
        }

        // Extract service name from JSON
        function extractServiceTitle(jsonData) {
            try {
                const data = JSON.parse(jsonData);
                return data.title || 'Unknown Service';
            } catch (e) {
                return 'Unknown Service';
            }
        }

        // Calculate order statistics
        function calculateOrderStats(orders) {
            const stats = {
                total: orders.length,
                pending: 0,
                completed: 0,
                revenue: 0
            };

            orders.forEach(order => {
                if (order.order_status === 'pending') {
                    stats.pending++;
                } else if (order.order_status === 'completed') {
                    stats.completed++;
                }

                if (order.promise && order.promise.price) {
                    stats.revenue += parseFloat(order.promise.price);
                }
            });

            return stats;
        }

        // Update statistics display
        function updateStatsDisplay() {
            totalOrdersEl.textContent = orderStats.total;
            pendingOrdersEl.textContent = orderStats.pending;
            completedOrdersEl.textContent = orderStats.completed;
            totalRevenueEl.textContent = formatPrice(orderStats.revenue);
        }

        // Fetch orders from API with filters
        async function fetchOrders() {
            loadingIndicator.style.display = 'block';
            ordersTable.style.display = 'none';
            orderCards.style.display = 'none';
            noResults.style.display = 'none';

            // Build query string from filters
            const queryParams = new URLSearchParams();
            for (const [key, value] of Object.entries(currentFilters)) {
                if (value !== '') {
                    queryParams.append(key, value);
                }
            }

            try {
                const response = await fetch(`/api/orders?${queryParams.toString()}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const result = await response.json();
                console.log('Fetched orders:', result);
                
                if (result.success) {
                    orders = result.data || [];
                    
                    // Calculate stats
                    orderStats = calculateOrderStats(orders);
                    updateStatsDisplay();
                    
                    // Show appropriate UI based on results
                    if (orders.length === 0) {
                        ordersTable.style.display = 'none';
                        orderCards.style.display = 'none';
                        noResults.style.display = 'block';
                    } else {
                        const isMobile = window.innerWidth <= 768;
                        ordersTable.style.display = isMobile ? 'none' : 'table';
                        orderCards.style.display = isMobile ? 'grid' : 'none';
                        noResults.style.display = 'none';
                        renderOrders(orders);
                    }

                    // Calculate pagination
                    const totalItems = result.pagination.total_records; // In a real API, this would come from pagination metadata
                    totalPages = Math.ceil(totalItems / itemsPerPage);
                    renderPagination();
                } else {
                    throw new Error(result.message || 'Failed to fetch orders');
                }

            } catch (error) {
                console.error('Error fetching orders:', error);
                noResults.textContent = 'Error loading orders. Please try again.';
                noResults.style.display = 'block';
            } finally {
                loadingIndicator.style.display = 'none';
            }
        }

        // Render orders in the table and cards
        function renderOrders(orders) {
            tableBody.innerHTML = '';
            orderCards.innerHTML = '';

            // const startIndex = (currentPage - 1) * itemsPerPage;
            // const paginatedOrders = orders.slice(startIndex, startIndex + itemsPerPage);

            // paginatedOrders.forEach(function(order) {
            orders.forEach(function(order) {
                // Extract data safely
                const orderId = order.order_id;
                const orderNumber = `#${orderId.toString().padStart(6, '0')}`;
                const customer = order.customer ? order.customer.name : 'Unknown Customer';
                const customerEmail = order.customer ? order.customer.email : '';
                const seller = order.seller ? order.seller.name : 'Unknown Seller';
                const sellerEmail = order.seller ? order.seller.email : '';
                const serviceTitle = order.promise ? extractServiceTitle(order.promise.accepted_service) : 'Unknown Service';
                const price = order.promise ? parseFloat(order.promise.price).toFixed(2) : '0.00';
                const status = order.order_status;
                const deliveryDays = order.promise ? order.promise.delivery_days : 0;
                const createdDate = formatDate(order.created_at);
                
                // Default profile picture if none is set
                const customerPic = (order.customer && order.customer.profile_picture) || 'cdn_uploads/users/dp/dp-empty.png';
                const sellerPic = (order.seller && order.seller.profile_picture) || 'cdn_uploads/users/dp/dp-empty.png';

                // Create table row
                const row = document.createElement('tr');
                row.dataset.orderId = orderId;
                
                row.innerHTML = `
                    <td class="order-id-column">${orderId}</td>
                    <td>${orderNumber}</td>
                    <td>
                        <div class="user-info">
                            <img alt="Customer profile picture" src="/${customerPic}" width="30" height="30" />
                            <div class="user-details">
                                <span>${customer}</span>
                                <span class="email">${customerEmail}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="user-info">
                            <img alt="Seller profile picture" src="/${sellerPic}" width="30" height="30" />
                            <div class="user-details">
                                <span>${seller}</span>
                                <span class="email">${sellerEmail}</span>
                            </div>
                        </div>
                    </td>
                    <td>${serviceTitle}</td>
                    <td><span class="price">$${price}</span></td>
                    <td>
                        <span class="badge ${status}">
                            ${capitalizeFirstLetter(status.replace('_', ' '))}
                        </span>
                    </td>
                    <td>${formatDelivery(deliveryDays)}</td>
                    <td>${createdDate}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="view-btn" data-id="${orderId}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="edit-btn" data-id="${orderId}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);

                // Create card view for mobile
                const card = document.createElement('div');
                card.className = 'order-card';
                card.dataset.orderId = orderId;
                
                card.innerHTML = `
                    <div class="order-card-header">
                        <div>${orderNumber}</div>
                        <span class="badge ${status}">${capitalizeFirstLetter(status.replace('_', ' '))}</span>
                    </div>
                    <div class="order-card-content">
                        <div>
                            <strong>Customer:</strong> ${customer}
                        </div>
                        <div>
                            <strong>Seller:</strong> ${seller}
                        </div>
                        <div>
                            <strong>Service:</strong> ${serviceTitle}
                        </div>
                        <div>
                            <strong>Price:</strong> <span class="price">$${price}</span>
                        </div>
                        <div>
                            <strong>Delivery:</strong> ${formatDelivery(deliveryDays)}
                        </div>
                        <div>
                            <strong>Date:</strong> ${createdDate}
                        </div>
                    </div>
                    <div class="order-card-footer">
                        <div class="action-buttons">
                            <button class="view-btn" data-id="${orderId}">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button class="edit-btn" data-id="${orderId}">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </button>
                        </div>
                    </div>
                `;
                orderCards.appendChild(card);
            });

            // Add event listeners for action buttons
            setupActionButtons();
        }

        // Capitalize the first letter of a string
        function capitalizeFirstLetter(string) {
            if (!string) return '';
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Set up action buttons
        function setupActionButtons() {
            // View button event handlers
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', event => {
                    event.stopPropagation();
                    const orderId = button.dataset.id;
                    window.location.href = `/admin/order-details/${orderId}`;
                });
            });

            // Edit button event handlers
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', event => {
                    event.stopPropagation();
                    const orderId = button.dataset.id;
                    window.location.href = `/admin/edit-order/${orderId}`;
                });
            });
        }

        // Render pagination controls
        function renderPagination() {
            pagination.innerHTML = '';
            
            // Only show pagination if we have more than one page
            if (totalPages <= 1) return;
            
            // Previous button
            const prevButton = document.createElement('button');
            prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    goToPage(currentPage - 1);
                }
            });
            pagination.appendChild(prevButton);
            
            // Page buttons
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, startPage + 4);
            
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.classList.toggle('active', i === currentPage);
                pageButton.addEventListener('click', () => goToPage(i));
                pagination.appendChild(pageButton);
            }
            
            // Next button
            const nextButton = document.createElement('button');
            nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    goToPage(currentPage + 1);
                }
            });
            pagination.appendChild(nextButton);
        }

        // Go to a specific page
        function goToPage(page) {
            currentPage = page;
            currentFilters.offset = (page - 1) * itemsPerPage;
            fetchOrders();
            // renderOrders(orders);
            renderPagination();
        }

        // Sort table by column
        function setupTableSorting() {
            const sortableHeaders = document.querySelectorAll('th[data-sort]');
            
            sortableHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const sortKey = header.dataset.sort;
                    
                    // Toggle sort direction
                    if (currentFilters.sort_by === sortKey) {
                        currentFilters.order_dir = currentFilters.order_dir === 'asc' ? 'desc' : 'asc';
                    } else {
                        currentFilters.sort_by = sortKey;
                        currentFilters.order_dir = 'asc';
                    }
                    
                    // Update header classes
                    sortableHeaders.forEach(h => h.classList.remove('sorted'));
                    header.classList.add('sorted');
                    
                    // Update sort icons
                    const sortIcon = header.querySelector('.sort-icon');
                    sortIcon.className = 'fas sort-icon ' + 
                        (currentFilters.order_dir === 'asc' ? 'fa-sort-up' : 'fa-sort-down');
                    
                    // Fetch with new sort
                    fetchOrders();
                });
            });
        }

        // Handle responsive design
        function handleResponsiveLayout() {
            const isMobile = window.innerWidth <= 768;
            if (orders.length > 0) {
                ordersTable.style.display = isMobile ? 'none' : 'table';
                orderCards.style.display = isMobile ? 'grid' : 'none';
            }
        }

        // Event listener for search button
        searchButton.addEventListener('click', function() {
            currentFilters.search = searchInput.value.trim();
            currentFilters.order_status = statusFilter.value;
            
            // Parse date range if provided
            const dates = dateRange.value.split(' - ');
            if (dates.length === 2) {
                currentFilters.date_from = dates[0];
                currentFilters.date_to = dates[1];
            } else {
                currentFilters.date_from = '';
                currentFilters.date_to = '';
            }

            currentFilters.sort_by = sortByFilter.value;
            
            // Reset pagination
            currentFilters.offset = 0;
            currentPage = 1;
            
            fetchOrders();
        });

        // Event listener for search input (search on Enter key)
        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                searchButton.click();
            }
        });

        // Event listener for window resize
        window.addEventListener('resize', handleResponsiveLayout);

        // Initial setup when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            setupTableSorting();
            fetchOrders();
            handleResponsiveLayout();
            
            // For demo purposes, we're using a placeholder for daterangepicker
            // In a real implementation, you would initialize a date range picker library here
            dateRange.addEventListener('click', function() {
                alert('In a real implementation, this would open a date range picker!');
            });
        });
    </script>
</body>

</html>