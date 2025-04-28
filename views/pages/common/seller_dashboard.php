<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost Seller Dashboard</title>
    <!-- Include necessary libraries -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e6d5ff 0%, #e5eaff 100%);
            min-height: 100vh;
            color: var(--gray-800);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 1rem auto;
            padding: 20px;
            background: rgb(250, 248, 254);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .page-title {
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        .page-description {
            color: var(--gray-600);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        /* Summary cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .summary-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .summary-card:hover {
            transform: translateY(-5px);
        }

        .summary-card.income {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        }

        .summary-card.sales {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .summary-card.clients {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .summary-card.conversion {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .card-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 2rem;
            opacity: 0.2;
        }

        .card-label {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .card-value {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            opacity: 0.9;
        }

        .trend-up {
            color: #4ade80;
        }

        .trend-down {
            color: #f87171;
        }

        /* Charts section */
        .charts-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .chart-card {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .chart-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-800);
            margin: 0;
        }

        .chart-period {
            display: flex;
            gap: 0.5rem;
        }

        .period-btn {
            padding: 0.35rem 0.75rem;
            border-radius: 2rem;
            border: 1px solid var(--gray-300);
            background-color: white;
            color: var(--gray-600);
            font-size: 0.75rem;
            /* cursor: pointer; */
            transition: all 0.2s ease;
        }

        .period-btn:hover {
            border-color: var(--primary-light);
            color: var(--primary-color);
        }

        .period-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .chart-content {
            min-height: 300px;
        }

        /* Table Styles */
        .table-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .data-table th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background-color: var(--gray-100);
            border-bottom: 1px solid var(--gray-200);
        }

        .data-table th:first-child {
            border-top-left-radius: var(--radius);
        }

        .data-table th:last-child {
            border-top-right-radius: var(--radius);
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-200);
            font-size: 0.875rem;
            color: var(--gray-800);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
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

        /* Responsive design */
        @media (max-width: 1200px) {
            .summary-cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .charts-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .summary-cards {
                grid-template-columns: 1fr;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <h1 class="page-title"><?php echo ucfirst($_SESSION['user']['role']) ?> Dashboard</h1>
        <p class="page-description">Welcome to your BrandBoost <?php echo $_SESSION['user']['role'] ?> dashboard. Monitor your performance and manage your orders.</p>

        <!-- Summary Cards -->
        <div class="summary-cards">
            <div class="summary-card income">
                <div class="card-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-label">Total Income in last month</div>
                <div class="card-value" id="income-card"></div>
                <!-- <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>4.85% from last month</span>
                </div> -->
            </div>
            
            <div class="summary-card sales">
                <div class="card-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-label">Pending Orders</div>
                <div class="card-value" id="pending-card">0</div>
                <!-- <div class="card-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>5.52% from last month</span>
                </div> -->
            </div>
            
            <div class="summary-card clients">
                <div class="card-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-label">Completed Orders</div>
                <div class="card-value" id="completed-card">0</div>
                <!-- <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>9.55% from last month</span>
                </div> -->
            </div>
            
            <div class="summary-card conversion">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-label">Member of BrandBoost Since</div>
                <div class="card-value" id="member-since-card"></div>
                <!-- <div class="card-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>10.30% from last month</span>
                </div> -->
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-card">
                <div class="chart-header">
                    <h2 class="chart-title">Income Overview</h2>
                    <div class="chart-period">
                        <!-- <button class="period-btn">Week</button> -->
                        <button class="period-btn active">Income within last month</button>
                    </div>
                </div>
                <div id="income-chart" class="chart-content"></div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <h2 class="chart-title">Sales Distribution</h2>
                </div>
                <div id="sales-chart" class="chart-content"></div>
            </div>
        </div>

        <!-- Order History Table -->
        <div class="table-container">
            <div class="chart-header">
                <h2 class="chart-title">Recent 5 orders</h2>
            </div>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Buyer</th>
                        <th>Gig</th>
                        <th>Due On</th>
                        <th>Total (LKR)</th>
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
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const incomeCard = document.getElementById('income-card');
            const pendingCard = document.getElementById('pending-card');
            const completedCard = document.getElementById('completed-card');
            const memberSinceCard = document.getElementById('member-since-card');

            const state = {
                orders: [],
                filteredOrders: [],
                incomeData: []
            };

            // Fetch total income for last 30 days
            async function getTotalIncome() {
                try {
                    const currentDate = new Date();
                    const thirtyDaysAgo = new Date(currentDate);
                    thirtyDaysAgo.setDate(currentDate.getDate() - 30);

                    const start = thirtyDaysAgo.toISOString().split('T')[0];
                    const end = currentDate.toISOString().split('T')[0];

                    const response = await fetch(`/api/payments/period-earnings?start=${start}&end=${end}`);
                    const data = await response.json();

                    if (data.success) {
                        incomeCard.textContent = `LKR ${parseFloat(data.total_earnings).toLocaleString()}`;
                        // Also fetch monthly income data for the chart
                        fetchMonthlyIncome();
                    } else {
                        console.error('Failed to fetch income:', data);
                    }
                } catch (error) {
                    console.error('Error fetching total income:', error);
                }
            }

             // Fetch order count for status cards
             async function getOrderCount() {
                try {
                    const response = await fetch('/api/orders/seller');
                    const data = await response.json();

                    if (data.success) {
                        pendingCard.textContent = data.count.by_status.pending || 0;
                        completedCard.textContent = data.count.by_status.completed || 0;
                    } else {
                        console.error('Failed to fetch order counts:', data);
                    }
                } catch (error) {
                    console.error('Error fetching order counts:', error);
                }
            }

            async function getRegisterDate() {
                try {
                    const userId = <?php echo (int)$_SESSION['user']['user_id']; ?>;
                    console.log('userId', userId);
                    
                    const response = await fetch(`/api/user/${userId}`);
                    const data = await response.json();
                    
                    console.log('getRegisterDate', data);

                    if (data.created_at) {
                        const registerDate = new Date(data.created_at);
                        console.log('registerDate', registerDate);
                        
                        // Format the date as YYYY Month DD
                        const year = registerDate.getFullYear();
                        const month = registerDate.toLocaleString('default', { month: 'long' });
                        const day = registerDate.getDate();
                        
                        memberSinceCard.textContent = `${year} ${month} ${day}`;
                    } else {
                        console.error('Failed to fetch register date:', data);
                    }
                } catch (error) {
                    console.error('Error fetching register date:', error);
                }
            }

            // Fetch monthly income data for chart
            async function fetchMonthlyIncome() {
                try {
                    // Get date for the past month
                    const today = new Date() ;
                    const oneMonthAgo = new Date();
                    oneMonthAgo.setMonth(today.getMonth() - 1);

                    const start = oneMonthAgo.toISOString().split('T')[0];
                    const end = today.toISOString().split('T')[0];
                    
                    const response = await fetch(`/api/payments/period-earnings?start=${start}&end=${end}`);
                    const data = await response.json();
                    
                    console.log('getMonthlyIncome', data);

                    if (data.success && Array.isArray(data.transactions)) {
                        // Store transactions in state with amounts converted to numbers
                        state.incomeData = data.transactions.map(transaction => ({
                            date: transaction.created_at,
                            amount: parseFloat(transaction.amount) // Convert string amount to number
                        }));
                        
                        console.log('Processed income data:', state.incomeData);
                        renderIncomeChart();
                    } else {
                        console.error('Failed to fetch monthly income data:', data);
                    }
                } catch (error) {
                    console.error('Error fetching monthly income data:', error);
                }
            }

            // Render income chart
            function renderIncomeChart() {
                // Process transaction data to organize by date
                const dateFormat = { month: 'short', day: 'numeric' };
                const processedData = processTransactionsByDate(state.incomeData, dateFormat);
                
                // Create the income chart
                const incomeOptions = {
                    series: [{
                        name: 'Income',
                        data: processedData.values
                    }],
                    chart: {
                        height: 350,
                        type: 'area',
                        fontFamily: 'Inter, sans-serif',
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    colors: ['#10b981'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.2,
                            stops: [0, 90, 100]
                        }
                    },
                    xaxis: {
                        categories: processedData.dates,
                        labels: {
                            rotate: -45,
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return 'LKR' + ' ' + value.toFixed(0);
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return 'LKR'+ ' ' + value.toLocaleString();
                            }
                        }
                    },
                    grid: {
                        borderColor: '#e0e0e0',
                        strokeDashArray: 4
                    }
                };

                const incomeChart = new ApexCharts(document.getElementById("income-chart"), incomeOptions);
                incomeChart.render();
                
                // Update the period buttons to change chart view
                setupPeriodButtons(incomeChart);
            }
            
            // Process transactions and organize them by date
            function processTransactionsByDate(transactions, dateFormatOptions) {
                // Create a map to aggregate transactions by date
                const transactionsByDate = new Map();
                
                // Sort transactions by date
                const sortedTransactions = [...transactions].sort((a, b) => {
                    return new Date(a.date) - new Date(b.date);
                });
                
                // Process each transaction
                sortedTransactions.forEach(transaction => {
                    // Format the date string
                    const transactionDate = new Date(transaction.date);
                    const dateKey = transactionDate.toISOString().split('T')[0]; // YYYY-MM-DD format
                    const formattedDate = transactionDate.toLocaleDateString('en-US', dateFormatOptions);
                    
                    // Add to or create entry in the map
                    if (transactionsByDate.has(dateKey)) {
                        transactionsByDate.get(dateKey).amount += parseFloat(transaction.amount);
                    } else {
                        transactionsByDate.set(dateKey, {
                            displayDate: formattedDate,
                            amount: parseFloat(transaction.amount)
                        });
                    }
                });
                
                // Convert map to arrays for the chart
                const dateKeys = Array.from(transactionsByDate.keys()).sort();
                const dates = dateKeys.map(key => transactionsByDate.get(key).displayDate);
                const values = dateKeys.map(key => transactionsByDate.get(key).amount);
                
                return { dates, values, dateKeys };
            }
            
            // Filter transactions based on period
            function filterTransactionsByPeriod(transactions, period) {
                const today = new Date();
                let filterDate = new Date(today);
                
                if (period === 'week') {
                    filterDate.setDate(today.getDate() - 7);
                } else if (period === 'month') {
                    filterDate.setMonth(today.getMonth() - 1);
                } else if (period === 'year') {
                    filterDate.setFullYear(today.getFullYear() - 1);
                }
                
                return transactions.filter(transaction => {
                    const transactionDate = new Date(transaction.date);
                    return transactionDate >= filterDate && transactionDate <= today;
                });
            }
            
            //Set up period buttons functionality for the income chart
            function setupPeriodButtons(chart) {
                const periodBtns = document.querySelectorAll('.period-btn');
                
                periodBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        // Remove active class from all buttons
                        periodBtns.forEach(b => b.classList.remove('active'));
                        
                        // Add active class to clicked button
                        this.classList.add('active');
                        
                        const period = this.textContent.toLowerCase();
                        updateChartPeriod(chart, period);
                    });
                });
            }
            
            // Update chart based on selected period
            function updateChartPeriod(chart, period) {
                // Filter transactions based on selected period
                const filteredTransactions = filterTransactionsByPeriod(state.incomeData, period);
                
                // Format date display based on period
                let dateFormat;
                if (period === 'week') {
                    dateFormat = { weekday: 'short', day: 'numeric' };
                } else if (period === 'month') {
                    dateFormat = { month: 'short', day: 'numeric' };
                } else {
                    dateFormat = { month: 'short', year: '2-digit' };
                }
                
                // Process the filtered data
                const processedData = processTransactionsByDate(filteredTransactions, dateFormat);
                
                // Update chart with new data
                chart.updateOptions({
                    xaxis: {
                        categories: processedData.dates
                    }
                });
                
                chart.updateSeries([{
                    name: 'Income',
                    data: processedData.values
                }]);
            }

            // Fetch orders for table and update charts
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
                    const response = await fetch(`/api/orders/seller`);
                    const result = await response.json();
                    console.log('fetchOrders', result);                    

                    if (result.success) {
                        state.orders = result.data;
                        // Get only the last 5 orders (most recent orders)
                        const lastFiveOrders = [...state.orders].slice(-5);
                        state.filteredOrders = lastFiveOrders;
                        renderOrders();
                        updateSalesChart(result.count);
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

            // Render order rows
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
                    if (!order.order_id) return;

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
                        <td><span class="price">${order.total}</span></td>
                        <td><span class="status ${statusClass}">${order.status}</span></td>
                    `;

                    row.addEventListener('click', () => navigateToOrderDetails(order.order_id, order.seller_role));
                    tableBody.appendChild(row);
                });
            }

            // Create sales chart with given data
            function updateSalesChart(orderCount) {
                const salesOptions = {
                    series: [
                        orderCount.by_status.pending || 0,
                        orderCount.by_status.in_progress || 0,
                        orderCount.by_status.completed || 0,
                        orderCount.by_status.canceled || 0
                    ],
                    chart: {
                        type: 'donut',
                        height: 350,
                        fontFamily: 'Inter, sans-serif'
                    },
                    labels: ['Pending', 'In Progress', 'Completed', 'Cancelled'],
                    colors: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'],
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        fontSize: '16px',
                                        label: 'Total Orders',
                                        formatter: () => orderCount.total
                                    }
                                }
                            }
                        }
                    }
                };

                const salesChart = new ApexCharts(document.getElementById("sales-chart"), salesOptions);
                salesChart.render();
            }

            // === Utility Functions ===

            function getBuyerInitials(name) {
                return name
                    .split(' ')
                    .map(part => part.charAt(0).toUpperCase())
                    .join('')
                    .slice(0, 2);
            }

            function formatDate(dateStr) {
                const date = new Date(dateStr);
                return date.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' });
            }

            // Navigate to order details page
            function navigateToOrderDetails(orderId, sellerRole) {
                if (sellerRole == 'designer') {
                    window.location.href = `/designer/order-details/${orderId}`;
                } else if (sellerRole == 'influencer') {
                    window.location.href = `/influencer/order-details/${orderId}`;
                }
            }

            // === Initialization ===
            getTotalIncome();
            getOrderCount();
            getRegisterDate();
            fetchOrders();
        });
    </script>

</body>
</html>