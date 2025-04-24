<style>
    :root {
        --primary: #2d6a4f;
        --primary-light: #40916c;
        --secondary: #a8df65;
        --secondary-light: #d9ed92;
        --dark: #1b4332;
        --light: #f8f9fa;
        --grey: #6c757d;
        --light-grey: #e9ecef;
        --danger: #dc3545;
        --success: #28a745;
        --warning: #ffc107;
        --info: #17a2b8;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        --border-radius: 12px;
    }

    body {
        background-color: #f5f7f9;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #333;
        margin: 0;
    }

    .dashboard-wrapper {
        max-width: 1440px;
        margin: 0 auto;
    }

    /* Top navigation styling */
    .top-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
        box-shadow: var(--shadow);
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 1.5rem;
    }

    .logo-container {
        display: flex;
        align-items: center;
    }

    .logo-container h1 {
        font-size: 1.25rem;
        margin: 0 0 0 10px;
        font-weight: 600;
        color: var(--primary);
    }

    .logo-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--primary);
        color: white;
        border-radius: 8px;
        font-weight: bold;
    }

    .nav-controls {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .search-container {
        position: relative;
    }

    .search-input {
        padding: 0.5rem 0.75rem 0.5rem 2.25rem;
        border: 1px solid var(--light-grey);
        border-radius: 50px;
        outline: none;
        min-width: 250px;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--grey);
    }

    .icon-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--light);
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .icon-btn:hover {
        background-color: var(--light-grey);
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: var(--danger);
        color: white;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .admin-profile {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .admin-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    .admin-name {
        font-weight: 500;
    }

    /* Analytics summary cards styling */
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 1.5rem;
    }

    .summary-card {
        background-color: #fff;
        padding: 1.5rem;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        transition: transform 0.2s ease;
    }

    .summary-card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .card-icon.users {
        background-color: rgba(45, 106, 79, 0.1);
        color: var(--primary);
    }

    .card-icon.gigs {
        background-color: rgba(23, 162, 184, 0.1);
        color: var(--info);
    }

    .card-icon.orders {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success);
    }

    .card-icon.revenue {
        background-color: rgba(255, 193, 7, 0.1);
        color: var(--warning);
    }

    .card-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .card-trend {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-size: 0.875rem;
    }

    .trend-up {
        color: var(--success);
    }

    .trend-down {
        color: var(--danger);
    }

    .card-label {
        font-size: 0.875rem;
        color: var(--grey);
    }

    /* Charts section styling */
    .charts-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 1.5rem;
    }

    .chart-card {
        background-color: #fff;
        border-radius: var(--border-radius);
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
        margin: 0;
    }

    .chart-period {
        display: flex;
        gap: 0.5rem;
    }

    .period-btn {
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        border: 1px solid var(--light-grey);
        background-color: transparent;
        font-size: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .period-btn.active {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .chart-content {
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .legend {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 1rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }

    /* Stats cards styling */
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-icon.signups {
        background-color: rgba(45, 106, 79, 0.1);
        color: var(--primary);
    }

    .stat-icon.ongoing {
        background-color: rgba(23, 162, 184, 0.1);
        color: var(--info);
    }

    .stat-icon.pending {
        background-color: rgba(255, 193, 7, 0.1);
        color: var(--warning);
    }

    .stat-icon.disputes {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--danger);
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--grey);
    }

    /* Recent activity styling */
    .activity-card {
        background-color: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .view-all {
        color: var(--primary);
        font-size: 0.875rem;
        text-decoration: none;
        font-weight: 500;
    }

    .activity-list {
        max-height: 350px;
        overflow-y: auto;
    }

    .activity-item {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--light-grey);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .activity-icon.order {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success);
    }

    .activity-icon.user {
        background-color: rgba(45, 106, 79, 0.1);
        color: var(--primary);
    }

    .activity-icon.post {
        background-color: rgba(23, 162, 184, 0.1);
        color: var(--info);
    }

    .activity-content {
        flex: 1;
    }

    .activity-text {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .activity-user {
        font-weight: 500;
    }

    .activity-time {
        font-size: 0.75rem;
        color: var(--grey);
    }



    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .primary-btn {
        background-color: var(--primary);
        color: white;
    }

    .primary-btn:hover {
        background-color: var(--primary-light);
    }

    .secondary-btn {
        background-color: var(--light);
        color: var(--dark);
    }

    .secondary-btn:hover {
        background-color: var(--light-grey);
    }

    /* Tables styles */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background-color: var(--light);
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 500;
        color: var(--grey);
        font-size: 0.875rem;
        border-bottom: 1px solid var(--light-grey);
    }

    .data-table td {
        padding: 0.875rem 1rem;
        border-bottom: 1px solid var(--light-grey);
        font-size: 0.875rem;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .table-title {
        margin-bottom: 1rem;
    }

    /* Responsive design */
    @media (max-width: 1200px) {
        .summary-cards, .stats-cards {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .charts-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .top-navbar {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .nav-controls {
            width: 100%;
            justify-content: space-between;
        }
        
        .search-input {
            min-width: unset;
            width: 100%;
        }
        
        .summary-cards, .stats-cards {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-wrapper">
    <!-- Top Navigation Bar -->
    <div class="top-navbar">
        <div class="logo-container">
            <div class="logo-icon">BB</div>
            <h1>BrandBoost</h1>
        </div>
        <div class="nav-controls">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search...">
            </div>
            <button class="icon-btn">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            <button class="icon-btn">
                <i class="fas fa-moon"></i>
            </button>
            <div class="admin-profile">
                <div class="admin-avatar">A</div>
                <span class="admin-name">Admin</span>
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </div>

    <!-- Analytics Summary Cards -->
    <div class="summary-cards">
        <div class="summary-card">
            <div class="card-header">
                <div>
                    <div class="card-value">2,350</div>
                    <div class="card-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>12.5%</span>
                    </div>
                    <div class="card-label">Total Users</div>
                </div>
                <div class="card-icon users">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div id="users-sparkline" class="sparkline"></div>
        </div>
        
        <div class="summary-card">
            <div class="card-header">
                <div>
                    <div class="card-value">567</div>
                    <div class="card-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>8.3%</span>
                    </div>
                    <div class="card-label">Active Gigs</div>
                </div>
                <div class="card-icon gigs">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
            <div id="gigs-sparkline" class="sparkline"></div>
        </div>
        
        <div class="summary-card">
            <div class="card-header">
                <div>
                    <div class="card-value">230</div>
                    <div class="card-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>2.15%</span>
                    </div>
                    <div class="card-label">Completed Orders</div>
                </div>
                <div class="card-icon orders">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div id="orders-sparkline" class="sparkline"></div>
        </div>
        
        <div class="summary-card">
            <div class="card-header">
                <div>
                    <div class="card-value">$193,000</div>
                    <div class="card-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>35%</span>
                    </div>
                    <div class="card-label">Total Revenue</div>
                </div>
                <div class="card-icon revenue">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div id="revenue-sparkline" class="sparkline"></div>
        </div>
    </div>

    <!-- Analytics Charts Section -->
    <div class="charts-container">
        <div class="chart-card">
            <div class="chart-header">
                <h2 class="chart-title">Revenue Overview</h2>
                <div class="chart-period">
                    <button class="period-btn">Week</button>
                    <button class="period-btn active">Month</button>
                    <button class="period-btn">Year</button>
                </div>
            </div>
            <div id="revenue-chart" class="chart-content"></div>
            <div class="legend">
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #2d6a4f;"></span>
                    <span>Income</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #a8df65;"></span>
                    <span>Withdrawals</span>
                </div>
            </div>
        </div>
        
        <div class="chart-card">
            <div class="chart-header">
                <h2 class="chart-title">User Distribution</h2>
            </div>
            <div id="user-chart" class="chart-content"></div>
        </div>
    </div>

    <!-- Live Stats Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon signups">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">48</div>
                <div class="stat-label">New Signups Today</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon ongoing">
                <i class="fas fa-sync-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">137</div>
                <div class="stat-label">Ongoing Orders</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">25</div>
                <div class="stat-label">Pending Approvals</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon disputes">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">12</div>
                <div class="stat-label">Active Disputes</div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Feed -->
    <div class="activity-card">
        <div class="activity-header">
            <h2 class="chart-title">Recent Activity</h2>
            <a href="#" class="view-all">View All</a>
        </div>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon post">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">
                        <span class="activity-user">@influencer123</span> posted a new gig: "Social Boost Package"
                    </div>
                    <div class="activity-time">5 minutes ago</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon order">
                    <i class="fas fa-check"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">
                        Order <strong>#1023</strong> completed by <span class="activity-user">@designking</span>
                    </div>
                    <div class="activity-time">32 minutes ago</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon user">
                    <i class="fas fa-user"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">
                        New signup: <span class="activity-user">@trendbiz</span>
                    </div>
                    <div class="activity-time">1 hour ago</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon order">
                    <i class="fas fa-check"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">
                        Order <strong>#986</strong> completed by <span class="activity-user">@creativedesigns</span>
                    </div>
                    <div class="activity-time">3 hours ago</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon post">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">
                        <span class="activity-user">@marketingpro</span> posted a new gig: "Viral TikTok Campaign"
                    </div>
                    <div class="activity-time">5 hours ago</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Posts Table -->
    <div class="chart-card">
        <h2 class="table-title">Top Performing Posts</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Revenue</th>
                    <th>Sales</th>
                    <th>Reviews</th>
                    <th>Views</th>
                    <th>Conversion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Premium T-Shirt</td>
                    <td><strong>$26,680.90</strong></td>
                    <td>1,072</td>
                    <td>1,727</td>
                    <td>2,680</td>
                    <td>40%</td>
                </tr>
                <tr>
                    <td>Vintage T-Shirt</td>
                    <td><strong>$16,729.19</strong></td>
                    <td>1,016</td>
                    <td>720</td>
                    <td>2,186</td>
                    <td>46%</td>
                </tr>
                <tr>
                    <td>New Premium Polo</td>
                    <td><strong>$12,872.24</strong></td>
                    <td>987</td>
                    <td>964</td>
                    <td>1,872</td>
                    <td>53%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
            colors: ['#2d6a4f', '#a8df65'],
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
            series: [233, 23, 482],
            chart: {
                type: 'donut',
                height: 350,
                fontFamily: 'Inter, sans-serif'
            },
            labels: ['Businesses', 'Designers', 'Influencers'],
            colors: ['#2d6a4f', '#a8df65', '#40916c'],
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

        // Sparklines for summary cards
        const sparklineOptions = {
            chart: {
                type: 'line',
                height: 30,
                sparkline: {
                    enabled: true
                },
                fontFamily: 'Inter, sans-serif'
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                marker: {
                    show: false
                }
            },
            grid: {
                padding: {
                    top: 5,
                    bottom: 5
                }
            }
        };

        // Users Sparkline
        new ApexCharts(document.getElementById("users-sparkline"), {
            ...sparklineOptions,
            series: [{
                data: [25, 35, 28, 47, 42, 55, 50, 60, 55, 65]
            }],
            colors: ['#2d6a4f']
        }).render();

        // Gigs Sparkline
        new ApexCharts(document.getElementById("gigs-sparkline"), {
            ...sparklineOptions,
            series: [{
                data: [45, 55, 48, 57, 62, 55, 65, 70, 65, 80]
            }],
            colors: ['#17a2b8']
        }).render();

        // Orders Sparkline
        new ApexCharts(document.getElementById("orders-sparkline"), {
            ...sparklineOptions,
            series: [{
                data: [35, 25, 38, 57, 32, 55, 25, 40, 55, 30]
            }],
            colors: ['#28a745']
        }).render();

        // Revenue Sparkline
        new ApexCharts(document.getElementById("revenue-sparkline"), {
            ...sparklineOptions,
            series: [{
                data: [45, 65, 58, 87, 82, 95, 90, 120, 110, 135]
            }],
            colors: ['#ffc107']
        }).render();

        // Theme toggle functionality
        const themeToggle = document.querySelector('.fa-moon');
        themeToggle.addEventListener('click', function() {
            this.classList.toggle('fa-moon');
            this.classList.toggle('fa-sun');
            document.body.classList.toggle('dark-mode');
        });

        // Period button functionality
        const periodButtons = document.querySelectorAll('.period-btn');
        periodButtons.forEach(button => {
            button.addEventListener('click', function() {
                periodButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>