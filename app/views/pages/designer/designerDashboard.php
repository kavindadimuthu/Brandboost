<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost Dashboard</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
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
            background: #f0f0f0;;
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
            margin: 20px 0;
            padding: 0 20px;
        }

        .total-orders {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .chart-container {
            flex: 1;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center; /* Centering the charts */
        }


        .charts-row {
            display: flex;
            justify-content: space-between;
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
                            <div class="value">$2,480.32</div>
                            <div class="change positive">+2.15%</div>
                            <p>From Jan 01, 2024 - March 30, 2024</p>
                        </div>
                        <img src="../../assets/dollar.png" alt="Gross Revenue">
                    </div>
                    <div class="card">
                        <div>
                            <h2>Avg. Order Value</h2>
                            <div class="value">$56.12</div>
                            <div class="change negative">-2.15%</div>
                            <p>From Jan 01, 2024 - March 30, 2024</p>
                        </div>
                        <img src="../../assets/satisfaction.png" alt="Avg. Order Value">
                    </div>
                    <div class="card">
                        <div>
                            <h2>Total Orders</h2>
                            <div class="value">230</div>
                            <div class="change positive">+2.15%</div>
                            <p>From Jan 01, 2024 - March 30, 2024</p>
                        </div>
                        <img src="../../assets/layer.png" alt="Total Orders">
                    </div>
                </div>

                <!-- Orders Table -->
                <h2>Active Orders</h2>
                <div class="orders-container">
                    <table>
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
                            <!-- Data will be loaded dynamically -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button>&lt;</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>&gt;</button>
                </div>

                <!-- Total Orders Section with Three Charts -->
                <!-- Total Orders Section with Three Charts -->
                <div class="charts-row">
                    <div class="chart-container">
                        <h2>Order Status</h2>
                        <div class="order-status-chart">
                            <canvas id="orderStatusChart" width="300" height="300"></canvas> <!-- Reduced size -->
                        </div>
                    </div>
                    <div class="chart-container">
                        <h2>Orders Over Last 6 Months</h2>
                        <div class="monthly-orders-chart">
                            <canvas id="monthlyOrdersChart" width="300" height="300"></canvas> <!-- Reduced size -->
                        </div>
                    </div>
                    <div class="chart-container">
                        <h2>Profile Views (Last Month)</h2>
                        <div class="profile-views-chart">
                            <canvas id="profileViewsChart" width="300" height="300"></canvas> <!-- Reduced size -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Populate Orders Table
        const orders = [
            { buyer: "Consequat", gig: "Gig 1", dueOn: "3 Days", total: "$20", status: "In Progress" },
            { buyer: "Reprehende", gig: "Gig 2", dueOn: "5 Days", total: "$35", status: "Completed" },
            { buyer: "Content", gig: "Gig 3", dueOn: "2 Days", total: "$50", status: "Delivered" },
        ];

        function loadOrdersData(data) {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = '';

            data.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${order.buyer}</td>
                    <td>${order.gig}</td>
                    <td>${order.dueOn}</td>
                    <td>${order.total}</td>
                    <td><span class="status ${order.status.toLowerCase().replace(' ', '-')}">${order.status}</span></td>
                `;
                tableBody.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', () => loadOrdersData(orders));

        // Chart.js Setup for Order Status Chart
        const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
        const orderStatusChart = new Chart(orderStatusCtx, {
            type: 'pie',
            data: {
                labels: ['Delivered', 'In Progress', 'Pending'],
                datasets: [{
                    data: [12, 19, 8],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
                    hoverOffset: 4
                }]
            },
        });

        // Chart.js Setup for Monthly Orders Chart
        const monthlyOrdersCtx = document.getElementById('monthlyOrdersChart').getContext('2d');
        const monthlyOrdersChart = new Chart(monthlyOrdersCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Orders',
                    data: [65, 59, 80, 81, 56, 55],
                    backgroundColor: '#42A5F5',
                    borderColor: '#1E88E5',
                    borderWidth: 1
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

        // Chart.js Setup for Profile Views Chart
        const profileViewsCtx = document.getElementById('profileViewsChart').getContext('2d');
        const profileViewsChart = new Chart(profileViewsCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
                datasets: [{
                    label: 'Profile Views',
                    data: [30, 50, 75, 40, 60],
                    borderColor: '#FF6384',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
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
    </script>
</body>
</html>
