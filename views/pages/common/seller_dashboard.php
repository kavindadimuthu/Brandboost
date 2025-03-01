<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost Dashboard</title>
    <!-- Include Chart.js for graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e6d5ff 0%, #e5eaff 100%);
            min-height: 100vh;
        }

        .container {
            /* display: flex; */
            max-width: 1200px;
            margin: 1rem auto;
            padding: 20px;
            /* background: rgb(235, 235, 235) ; */
            background:rgb(242, 237, 250);
            border-radius: 10px;
        }

        

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 20px;
        }


        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-title {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
        }

        .stat-change {
            font-size: 12px;
            margin-left: 10px;
        }

        .positive {
            color: #00b894;
        }

        .negative {
            color: #ff7675;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* Table Styles */
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }


        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #6c5ce7;
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
            <!-- Main Content -->
            <div class="main-content">

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-title">Total Income</div>
                        <div class="stat-value">$8,500<span class="stat-change positive">+4.85%</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-title">Total Sales</div>
                        <div class="stat-value">3,500K<span class="stat-change negative">-5.52%</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-title">New Clients</div>
                        <div class="stat-value">1,700K<span class="stat-change positive">+9.55%</span></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-title">Total Users</div>
                        <div class="stat-value">14,800K<span class="stat-change negative">-10.30%</span></div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-section">
                    <div class="chart-container">
                        <canvas id="statisticsChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Tables Section -->
                <div class="table-container">
                    <h3>Last Orders</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Order No.</th>
                                <th>Amount</th>
                                <th>Payment Type</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="/api/placeholder/32/32" alt="User" class="user-avatar">
                                        Regina Cooper
                                    </div>
                                </td>
                                <td>#730541</td>
                                <td>$2,500</td>
                                <td>Credit Card</td>
                                <td>12.09.2019</td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        
    </div>

    <script>
        // Statistics Chart
        const statisticsCtx = document.getElementById('statisticsChart').getContext('2d');
        new Chart(statisticsCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Income',
                    data: [3000, 3500, 4000, 3200, 3800, 2500, 3700],
                    backgroundColor: '#6c5ce7',
                }, {
                    label: 'Expense',
                    data: [2000, 2200, 3000, 2300, 2600, 1500, 2500],
                    backgroundColor: '#ff7675',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Current Week', 'Last Week'],
                datasets: [{
                    data: [2500, 1000],
                    backgroundColor: ['#6c5ce7', '#ff7675'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
</body>
</html>