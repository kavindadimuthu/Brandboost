<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost Dashboard</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">

    <style>
        .cards {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
        }

        .card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            flex: 1;
        }

        .card h2 {
            font-size: 1.2em;
            margin: 0;
            color: #333;
        }

        .card .value {
            font-size: 1.8em;
            font-weight: bold;
            margin: 10px 0;
        }

        .card .change {
            font-size: 0.9em;
            margin: 5px 0;
        }

        .card .change.positive {
            color: green;
        }

        .card .change.negative {
            color: red;
        }

        .card img {
            width: 60px;
            height: 60px;
            margin-left: 20px;
        }

        .main-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .main-content table th,
        .main-content table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }

        .main-content table th {
            background-color: #f9f9f9;
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
        }

        .main-content h2 {
            padding-left: 20px;
        }

        .orders-container {
            margin: 0 20px;
        }

        .charts-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px;
        }

        .chart-container {
            flex: 1;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .chart-container canvas {
            max-width: 100%;
            height: 100%;
        }

        canvas {
            max-width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">
                <!-- Metric Cards -->
                <div class="cards">
                    <div class="card">
                        <div>
                            <h2>Gross Revenue</h2>
                            <div class="value">LKR 9500.32</div>
                            
                            <p>From Jan 01, 2024 - March 30, 2024</p>
                        </div>
                        <img src="../../assets/dollar.png" alt="Gross Revenue">
                    </div>
                    <div class="card">
                        <div>
                            <h2>Avg. Order Value</h2>
                            <div class="value">LKR 7000.12</div>
                            
                            <p>From Jan 01, 2024 - March 30, 2024</p>
                        </div>
                        <img src="../../assets/satisfaction.png" alt="Avg. Order Value">
                    </div>
                    <div class="card">
                        <div>
                            <h2>Total Orders</h2>
                            <div class="value">LKR 45000.00</div>
                            
                            <p>From Jan 01, 2024 - March 30, 2024</p>
                        </div>
                        <img src="../../assets/layer.png" alt="Total Orders">
                    </div>
                </div>

                <!-- Orders Table -->
                    <?php include __DIR__ . '/../../components/influencer/orderTable.php'; ?>

                <!-- Charts Section -->
                <div class="charts-row">
                    <div class="chart-container">
                        <h2>Order Status</h2>
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h2>Orders Over Last 6 Months</h2>
                        <canvas id="monthlyOrdersChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h2>Profile Views (Last Month)</h2>
                        <canvas id="profileViewsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Order Status Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        new Chart(orderStatusCtx, {
            type: 'pie',
            data: {
                labels: ['Delivered', 'In Progress', 'Pending'],
                datasets: [{
                    data: [12, 19, 8],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
                }]
            }
        });

        // Monthly Orders Chart
        const monthlyOrdersCtx = document.getElementById('monthlyOrdersChart').getContext('2d');
        new Chart(monthlyOrdersCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Orders',
                    data: [65, 59, 80, 81, 56, 55],
                    backgroundColor: '#42A5F5'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Profile Views Chart
        const profileViewsCtx = document.getElementById('profileViewsChart').getContext('2d');
        new Chart(profileViewsCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
                datasets: [{
                    label: 'Profile Views',
                    data: [30, 50, 75, 40, 60],
                    borderColor: '#FF6384',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }]
            }
        });
    </script>
</body>
</html>
