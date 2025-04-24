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
                <div class="card-label">Total Income</div>
                <div class="card-value">$8,500</div>
                <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>4.85% from last month</span>
                </div>
            </div>
            
            <div class="summary-card sales">
                <div class="card-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-label">Total Sales</div>
                <div class="card-value">3,500</div>
                <div class="card-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>5.52% from last month</span>
                </div>
            </div>
            
            <div class="summary-card clients">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-label">New Clients</div>
                <div class="card-value">1,700</div>
                <div class="card-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    <span>9.55% from last month</span>
                </div>
            </div>
            
            <div class="summary-card conversion">
                <div class="card-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-label">Conversion Rate</div>
                <div class="card-value">14.8%</div>
                <div class="card-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    <span>10.30% from last month</span>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-container">
            <div class="chart-card">
                <div class="chart-header">
                    <h2 class="chart-title">Income vs Expenses</h2>
                    <div class="chart-period">
                        <button class="period-btn">Week</button>
                        <button class="period-btn active">Month</button>
                        <button class="period-btn">Year</button>
                    </div>
                </div>
                <div id="statistics-chart" class="chart-content"></div>
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
                <h2 class="chart-title">Recent Orders</h2>
                <a href="/<?php echo $_SESSION['user']['role'] ?>/orders-list" class="view-all" style="color: var(--primary-color); font-size: 0.875rem; text-decoration: none; font-weight: 500;">View All</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Order No.</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="https://storage.googleapis.com/a1aa/image/placeholder_user.jpg" alt="User" class="user-avatar">
                                <span>Regina Cooper</span>
                            </div>
                        </td>
                        <td>#730541</td>
                        <td>$2,500</td>
                        <td>Credit Card</td>
                        <td>12.09.2024</td>
                        <td><span style="background-color: var(--success-color); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="https://storage.googleapis.com/a1aa/image/placeholder_user.jpg" alt="User" class="user-avatar">
                                <span>John Miller</span>
                            </div>
                        </td>
                        <td>#730542</td>
                        <td>$1,800</td>
                        <td>PayPal</td>
                        <td>11.09.2024</td>
                        <td><span style="background-color: var(--info-color); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">In Progress</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="https://storage.googleapis.com/a1aa/image/placeholder_user.jpg" alt="User" class="user-avatar">
                                <span>Sarah Johnson</span>
                            </div>
                        </td>
                        <td>#730543</td>
                        <td>$3,200</td>
                        <td>Credit Card</td>
                        <td>10.09.2024</td>
                        <td><span style="background-color: var(--success-color); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">Completed</span></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-info">
                                <img src="https://storage.googleapis.com/a1aa/image/placeholder_user.jpg" alt="User" class="user-avatar">
                                <span>Michael Brown</span>
                            </div>
                        </td>
                        <td>#730544</td>
                        <td>$950</td>
                        <td>Bank Transfer</td>
                        <td>09.09.2024</td>
                        <td><span style="background-color: var(--warning-color); color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Statistics Chart (Income vs Expenses)
            const statisticsOptions = {
                series: [{
                    name: 'Income',
                    data: [3000, 3500, 4000, 3200, 3800, 2500, 3700, 4200, 3600, 3900, 4500, 4700]
                }, {
                    name: 'Expenses',
                    data: [2000, 2200, 3000, 2300, 2600, 1500, 2500, 2800, 2200, 2400, 2700, 3000]
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif'
                },
                colors: ['#6366f1', '#ef4444'],
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

            const statisticsChart = new ApexCharts(document.getElementById("statistics-chart"), statisticsOptions);
            statisticsChart.render();

            // Sales Distribution Chart
            const salesOptions = {
                series: [55, 45],
                chart: {
                    type: 'donut',
                    height: 350,
                    fontFamily: 'Inter, sans-serif'
                },
                labels: ['Current Week', 'Last Week'],
                colors: ['#6366f1', '#ef4444'],
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

            const salesChart = new ApexCharts(document.getElementById("sales-chart"), salesOptions);
            salesChart.render();
            
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
        });
    </script>
</body>
</html>