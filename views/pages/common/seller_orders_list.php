<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Orders</title>
    <style>
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
            margin: auto;
            max-width: 1200px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            border-radius: 20px;
            font-size: 14px;
        }

        .main-content {
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-box {
            flex: 1;
            margin-left: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            border-color: #007bff;
            outline: none;
        }

        .orders-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            text-align: left;
            padding: 12px 16px;
            background: #f8f9fa;
            color: #666;
            font-weight: 500;
            font-size: 14px;
            border-bottom: 1px solid #eee;
        }

        .orders-table td {
            padding: 16px;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }

        .orders-table tr:hover td {
            color: #007bff;
            cursor: pointer;
        }

        .status {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
        }

        .status.pending {
            color: #6c757d;
            background: #f0f0f0;
        }

        .status.in-progress {
            color: #b86e00;
            background: #fff3e5;
        }

        .status.completed {
            color: #0a7c42;
            background: #e6f4ed;
        }

        .status.canceled {
            color: #dc3545;
            background: #fbe7e9;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-row h2 {
            color: #333;
            font-size: 24px;
            margin: 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination button {
            margin: 0 5px;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            background: #f0f0f0;
        }

        .pagination button:hover:not(:disabled) {
            background: #0056b3;
            color: white;
        }

        .pagination button.active {
            background: #a29bfe;
            color: white;
        }

        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .loading {
            text-align: center;
            padding: 20px;
            font-size: 16px;
            color: #666;
        }

        .no-orders {
            text-align: center;
            padding: 30px;
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="main-content">
                <div class="order-container">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search by Order ID or Customer Name">
                    </div>
                </div>
                <div class="orders-container">
                    <div class="header-row">
                        <h2>Your Orders</h2>
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
                                <td colspan="5" class="loading">Loading orders...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination" id="pagination">
                    <!-- Pagination will be generated dynamically -->
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global state
        const state = {
            // currentPage: 1,
            // limit: 10,
            // totalPages: 1,
            // searchTerm: '',
            orders: []
        };

        // Fetch orders from API
        async function fetchOrders() {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = '<tr><td colspan="5" class="loading">Loading orders...</td></tr>';
            
            try {
                
                const response = await fetch(`/api/orders/seller`, {
                    method: 'GET'
                });
                console.log(response);
                
                const result = await response.json();
                
                if (result.success) {
                    state.orders = result.data;
                    // state.totalPages = result.pagination.pages;
                    
                    renderOrders();
                    // renderPagination();
                } else {
                    tableBody.innerHTML = `<tr><td colspan="5" class="no-orders">Error: ${result.message}</td></tr>`;
                }
            } catch (error) {
                console.error('Error fetching orders:', error);
                tableBody.innerHTML = '<tr><td colspan="5" class="no-orders">Failed to load orders. Please try again later.</td></tr>';
            }
        }

        // Render orders to table
        function renderOrders() {
            const tableBody = document.getElementById('ordersTableBody');
            
            if (state.orders.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="5" class="no-orders">No orders found</td></tr>';
                return;
            }
            
            tableBody.innerHTML = '';
            
            state.orders.forEach(order => {
                const row = document.createElement('tr');
                const statusClass = order.status.toLowerCase().replace(' ', '-');
                
                row.innerHTML = `
                    <td onclick="navigateToOrderDetails(${order.order_id})">${order.buyer}</td>
                    <td onclick="navigateToOrderDetails(${order.order_id})">${order.gig}</td>
                    <td onclick="navigateToOrderDetails(${order.order_id})">${order.dueOn}</td>
                    <td onclick="navigateToOrderDetails(${order.order_id})">${order.total}</td>
                    <td onclick="navigateToOrderDetails(${order.order_id})">
                        <span class="status ${statusClass}">${order.status}</span>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        }

        // Generate pagination controls
        function renderPagination() {
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';
            
            // Previous button
            const prevButton = document.createElement('button');
            prevButton.innerHTML = '&lt;';
            prevButton.disabled = state.currentPage <= 1;
            prevButton.addEventListener('click', () => {
                if (state.currentPage > 1) {
                    state.currentPage--;
                    fetchOrders();
                }
            });
            paginationContainer.appendChild(prevButton);
            
            // Page buttons
            const startPage = Math.max(1, state.currentPage - 2);
            const endPage = Math.min(state.totalPages, startPage + 4);
            
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = i === state.currentPage ? 'active' : '';
                pageButton.addEventListener('click', () => {
                    state.currentPage = i;
                    fetchOrders();
                });
                paginationContainer.appendChild(pageButton);
            }
            
            // Next button
            const nextButton = document.createElement('button');
            nextButton.innerHTML = '&gt;';
            nextButton.disabled = state.currentPage >= state.totalPages;
            nextButton.addEventListener('click', () => {
                if (state.currentPage < state.totalPages) {
                    state.currentPage++;
                    fetchOrders();
                }
            });
            paginationContainer.appendChild(nextButton);
        }

        // Navigate to order details page
        function navigateToOrderDetails(orderId) {
            window.location.href = `/influencer/order-details/${orderId}`;
        }

        // Handle search input
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            let debounceTimeout;
            
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimeout);
                
                debounceTimeout = setTimeout(() => {
                    state.searchTerm = e.target.value.trim();
                    state.currentPage = 1; // Reset to first page on new search
                    fetchOrders();
                }, 500); // Debounce for 500ms
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