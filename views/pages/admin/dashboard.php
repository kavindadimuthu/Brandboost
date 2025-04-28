<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            color: var(--gray-800);
            line-height: 1.5;
        }

        .container {
            min-height: 100vh;
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .header .breadcrumb {
            font-size: 0.875rem;
            color: var(--gray-600);
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

        .summary-card.users {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        }

        .summary-card.gigs {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .summary-card.orders {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .summary-card.revenue {
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
            cursor: pointer;
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

        /* Action logs section */
        .action-logs {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            margin-bottom: 1.5rem;
        }

        .action-logs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .view-all {
            color: var(--primary-color);
            font-size: 0.875rem;
            text-decoration: none;
            font-weight: 500;
        }

        .action-logs-list {
            max-height: 350px;
            overflow-y: auto;
        }

        .action-log-item {
            display: flex;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .action-log-item:last-child {
            border-bottom: none;
        }

        .action-log-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .action-log-icon.user_active {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .action-log-icon.user_banned,
        .action-log-icon.user_blocked,
        .action-log-icon.user_inactive {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .action-log-icon.order_reversed,
        .action-log-icon.order_canceled {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .action-log-content {
            flex: 1;
        }

        .action-log-text {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
            color: var(--gray-800);
        }

        .action-log-time {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
            line-height: 1;
        }

        .badge-user_banned {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-user_blocked {
            background-color: var(--warning-color);
            color: var(--gray-800);
        }

        .badge-user_inactive {
            background-color: var(--gray-600);
            color: white;
        }

        .badge-user_active {
            background-color: var(--success-color);
            color: white;
        }

        .badge-order_reversed {
            background-color: var(--info-color);
            color: white;
        }

        .badge-order_canceled {
            background-color: var(--warning-color);
            color: white;
        }

        /* Top performers table */
        .data-card {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.25rem;
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

        .price-positive {
            color: var(--success-color);
            font-weight: 600;
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
            .main-content {
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
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <i class="fas fa-home"></i> Admin Portal &gt; Dashboard
                </div>
                <div class="user-info">
                    <img alt="Admin profile picture" src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg" />
                    <span><?php echo $_SESSION['user']['username'] ?? 'Admin'; ?></span>
                </div>
            </div>

            <h1 class="page-title">Dashboard</h1>
            <p class="page-description">Welcome to the BrandBoost admin panel. Monitor platform performance and manage your users from this centralized dashboard.</p>

            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="summary-card users">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-label">Total Users</div>
                    <div class="card-value" id="total-users-card">0</div>
                </div>
                
                <div class="summary-card gigs">
                    <div class="card-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="card-label">Active Services</div>
                    <div class="card-value" id="total-services-card">0</div>
                </div>
                
                <div class="summary-card orders">
                    <div class="card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-label">Completed Orders</div>
                    <div class="card-value" id="complete-orders-card">0</div>
                </div>
                
                <div class="summary-card revenue">
                    <div class="card-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-label">Total Revenue</div>
                    <div class="card-value" id="total-revenue-card">$193,000</div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-container">
                <div class="chart-card">
                    <div class="chart-header">
                        <h2 class="chart-title">Revenue Overview</h2>
                        <div class="chart-period">
                            <!-- <button class="period-btn">Week</button> -->
                            <button class="period-btn active">Month</button>
                            <!-- <button class="period-btn">Year</button> -->
                        </div>
                    </div>
                    <div id="revenue-chart" class="chart-content"></div>
                </div>
                
                <div class="chart-card">
                    <div class="chart-header">
                        <h2 class="chart-title">User Distribution</h2>
                    </div>
                    <div id="user-chart" class="chart-content"></div>
                </div>
            </div>

            <!-- Admin Action Logs -->
            <div class="action-logs">
                <div class="action-logs-header">
                    <h2 class="chart-title">Recent Admin Actions</h2>
                    <a href="/admin/actions-list" class="view-all">View All</a>
                </div>
                <div class="action-logs-list">
                    <div class="action-log-item">
                        <div class="action-log-icon user_blocked">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <div class="action-log-content">
                            <div class="action-log-text">
                                <span class="badge badge-user_blocked">User Blocked</span>
                                Admin blocked user ID: 41 - Action note: User account status changed to blocked
                            </div>
                            <div class="action-log-time">5 minutes ago</div>
                        </div>
                    </div>
                    
                    <div class="action-log-item">
                        <div class="action-log-icon user_active">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="action-log-content">
                            <div class="action-log-text">
                                <span class="badge badge-user_active">User Active</span>
                                Admin activated user ID: 43 - Action note: User account status changed to active
                            </div>
                            <div class="action-log-time">32 minutes ago</div>
                        </div>
                    </div>
                    
                    <div class="action-log-item">
                        <div class="action-log-icon user_inactive">
                            <i class="fas fa-user-times"></i>
                        </div>
                        <div class="action-log-content">
                            <div class="action-log-text">
                                <span class="badge badge-user_inactive">User Inactive</span>
                                Admin deactivated user ID: 43 - Action note: User account status changed to inactive
                            </div>
                            <div class="action-log-time">1 hour ago</div>
                        </div>
                    </div>
                    
                    <div class="action-log-item">
                        <div class="action-log-icon order_reversed">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div class="action-log-content">
                            <div class="action-log-text">
                                <span class="badge badge-order_reversed">Order Reversed</span>
                                Admin reversed order ID: 1023 - Action note: Order reversed due to dispute
                            </div>
                            <div class="action-log-time">3 hours ago</div>
                        </div>
                    </div>
                    
                    <div class="action-log-item">
                        <div class="action-log-icon order_canceled">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="action-log-content">
                            <div class="action-log-text">
                                <span class="badge badge-order_canceled">Order Canceled</span>
                                Admin canceled order ID: 986 - Action note: Customer requested cancellation
                            </div>
                            <div class="action-log-time">5 hours ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        let userCount = 0; // Initialize user count variable
        let businessmen_count = 0; // Initialize businessmen count variable
        let designers_count = 0; // Initialize designers count variable
        let influencers_count = 0; // Initialize influencers count variable

        document.addEventListener('DOMContentLoaded', function() {

            fetchUserCount().then(() => {
                // Now initialize charts after data is available
                initializeCharts();
            }).catch(error => {
                console.error('Error fetching user count:', error);
            });

            fetchServiceCount().catch(error => {
                console.error('Error fetching service count:', error);
            });

            fetchOrdersCount().catch(error => {
                console.error('Error fetching orders count:', error);
            });

            fetchWalletBalance().catch(error => {
                console.error('Error fetching wallet balance:', error);
            });

            fetchComplaintsCount().catch(error => {
                console.error('Error fetching complaints count:', error);
            });
            
        });

        async function fetchUserCount() {
            try {
                 // Calculate the time 24 hours ago
                const currentDate = new Date();
                const yesterday = new Date(currentDate.getTime() - 24 * 60 * 60 * 1000);
                const yesterdayTime = yesterday.toISOString();
                
                // Make API request with the time 24 hours ago
                const response = await fetch(`/api/user-count?sinceTime=${encodeURIComponent(yesterdayTime)}`);
                const data = await response.json();
                console.log('User data: ', data);
                
                userCount = data.counts.total - 1; // Exclude the admin user from the count
                businessmen_count = data.counts.businessmen;
                designers_count = data.counts.designers;
                influencers_count = data.counts.influencers;
                
                document.getElementById('total-users-card').textContent = userCount.toLocaleString();
                document.getElementById('new-signups-today').textContent = data.counts.newSignupsToday.toLocaleString();
            } catch (error) {
                console.error('Error fetching user count:', error);
            }
        }

        async function fetchServiceCount() {
            try {
                const response = await fetch('/api/service-count');
                const data = await response.json();
                console.log('Service Count:', data);
                
                document.getElementById('total-services-card').textContent = data.counts.total.toLocaleString();
            } catch (error) {
                console.error('Error fetching gig count:', error);
            }
        }

        async function fetchOrdersCount() {
            try {
                const response = await fetch('/api/orders-count');
                
                const data = await response.json();
                console.log('Orders Count:', data);
                
                document.getElementById('complete-orders-card').textContent = data.counts.completedCount.toLocaleString();
                document.getElementById('ongoing-orders').textContent = data.counts.inProgressCount.toLocaleString();
            } catch (error) {
                console.error('Error fetching complete orders count:', error);
            }
        }

        async function fetchWalletBalance() {
            try {
                const response = await fetch('/api/payments/system-wallet-balance');
                const data = await response.json();
                console.log('Wallet Balance:', data);
                
                document.getElementById('total-revenue-card').textContent = data.balance.toLocaleString();
            } catch (error) {
                console.error('Error fetching wallet balance:', error);
            }
        }

        async function fetchComplaintsCount() {
            try {
                const response = await fetch('/api/complaints-count');
                const data = await response.json();
                console.log('Complaints Count:', data);

                document.getElementById('pending-approvals').textContent = data.counts.pending.toLocaleString();
                document.getElementById('active-disputes').textContent = data.counts.open.toLocaleString();
            } catch (error) {
                console.error('Error fetching complaints count:', error);
            }
        }


        
        // Initialize charts
        function initializeCharts() {
            // Revenue Chart
            const revenueOptions = {
                series: [{
                    name: 'Income',
                    data: [31, 40, 28, 51, 42, 109, 100, 120, 80, 95, 110, 140]
                }, {
                    name: 'Withdrawals',
                    data: [11, 32, 45, 32, 34, 52, 41, 60, 50, 40, 60, 80]
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif'
                },
                colors: ['#6366f1', '#10b981'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.1,
                        stops: [0, 100]
                    }
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                    y: {
                        formatter: function (value) {
                            return "$" + value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f1f1',
                    padding: {
                        bottom: 0
                    }
                }
            };

            const revenueChart = new ApexCharts(document.getElementById("revenue-chart"), revenueOptions);
            revenueChart.render();

            // User Distribution Chart
            const userOptions = {
                series: [businessmen_count, designers_count, influencers_count],
                chart: {
                    type: 'donut',
                    height: 350,
                    fontFamily: 'Inter, sans-serif'
                },
                labels: ['Businesses', 'Designers', 'Influencers'],
                colors: ['#6366f1', '#10b981', '#3b82f6'],
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
                                    label: 'Total',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                }
            };

            const userChart = new ApexCharts(document.getElementById("user-chart"), userOptions);
            userChart.render();
            
            // Period button functionality
            const periodButtons = document.querySelectorAll('.period-btn');
            periodButtons.forEach(button => {
                button.addEventListener('click', function() {
                    periodButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // In a real implementation, this would trigger a data refresh
                    // based on the selected period (week/month/year)
                });
            });

        }
    </script>
</body>

</html>