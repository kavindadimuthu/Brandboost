<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            display: flex;
            margin: auto;
        }

        .content {
            flex-grow: 1;
            padding: 20px 0px;
        }

        .main-content {
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cards {
            display: flex;
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
        }

        .card .value {
            font-size: 1.8em;
            font-weight: bold;
            margin: 10px 0;
        }

        .card img {
            width: 60px;
            height: 60px;
            margin-left: 20px;
        }

        .orders-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
            margin: 0 20px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th, .orders-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .orders-table th {
            background: #f8f9fa;
            color: #666;
            font-weight: 500;
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

        .status.in-progress {
            color: #b86e00;
            background: #fff3e5;
        }

        .status.completed {
            color: #0a7c42;
            background: #e6f4ed;
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
        }

        .pagination button:hover {
            background: #0056b3;
        }

        .pagination button.active {
            background: #a29bfe;
        }

        .charts-row {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .chart-container {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        canvas {
            max-width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="main-content">
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

                <div class="orders-container">
                    <div class="header-row">
                        <h2>Customer Orders</h2>
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
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <button>&lt;</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>&gt;</button>
                </div>

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
        const orders = [
            {
                buyer: "Apple Asia",
                gig: "Do Business Promotion through Tiktok and Youtube",
                dueOn: "7 Days",
                total: "LKR 25,000",
                status: "Pending"
            },
            {
                buyer: "Spa Ceylon",
                gig: "Do Business Promotion through Facebook and Instagram",
                dueOn: "Delivered",
                total: "LKR 30,000",
                status: "In Progress"
            },
            {
                buyer: "CAMERA.LK",
                gig: "Do Business Promotion through my 1M Youtube channel",
                dueOn: "Delivered",
                total: "LKR 40,000",
                status: "Completed"
            }
        ];

        function loadOrdersData(data) {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = '';

            data.forEach(order => {
                const row = document.createElement('tr');
                const statusClass = order.status.toLowerCase().replace(' ', '-');
                
                row.innerHTML = `
                    <td onclick="window.location.href='/influencerviewcontroller/orderrequestview'">${order.buyer}</td>
                    <td onclick="window.location.href='/influencerviewcontroller/orderrequestview'">${order.gig}</td>
                    <td onclick="window.location.href='/influencerviewcontroller/orderrequestview'">${order.dueOn}</td>
                    <td onclick="window.location.href='/influencerviewcontroller/orderrequestview'">${order.total}</td>
                    <td onclick="window.location.href='/influencerviewcontroller/orderrequestview'"><span class="status ${statusClass}">${order.status}</span></td>
                `;
                
                tableBody.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadOrdersData(orders);

            // Order Status Chart
            new Chart(document.getElementById('orderStatusChart').getContext('2d'), {
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
            new Chart(document.getElementById('monthlyOrdersChart').getContext('2d'), {
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
            new Chart(document.getElementById('profileViewsChart').getContext('2d'), {
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
        });
    </script>
</body>
</html>