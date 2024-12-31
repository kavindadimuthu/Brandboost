<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost Dashboard</title>
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
    margin: auto;
}

.content {
    flex-grow: 1;
    padding: 20px;
    /* background-color: #f0f0f0; */
    border-radius: 20px;
    font-size: 14px;
}

.main-content {
    /* margin-top: 60px; */
    background-color: #fff;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    color: #333;
}

    </style>

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
                <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light background for contrast */
            margin: 0;
            padding: 20px; /* Add padding around the body */
        }

        .orders-container {
            background: white; /* White background for the table container */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            overflow: hidden; /* Prevent content overflow */
            padding: 20px; /* Padding inside the container */
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse; /* Collapsed borders for a cleaner look */
        }

        .orders-table th {
            text-align: left; /* Left-align text in headers */
            padding: 12px 16px; /* Padding for headers */
            background: #f8f9fa; /* Header background color */
            color: #666; /* Header text color */
            font-weight: 500; /* Medium weight for header text */
            font-size: 14px; /* Font size for header */
            border-bottom: 1px solid #eee; /* Bottom border for separation */
        }

        .orders-table td {
            padding: 16px; /* Padding for table cells */
            color: #333; /* Dark text color for cells */
            font-size: 14px; /* Font size for cell text */
            border-bottom: 1px solid #eee; /* Bottom border for cells */
            transition: all 0.3s ease; /* Transition for hover effects */
        }

        .orders-table tr:hover td {
            color: #007bff; /* Blue text color on row hover */
            cursor: pointer;
        }

        .status {
            padding: 6px 12px; /* Padding for status indicators */
            border-radius: 16px; /* Rounded corners for status */
            font-size: 12px; /* Smaller font size for status */
            font-weight: 500; /* Medium weight for status text */
        }

        .status.in-progress {
            color: #b86e00; /* Text color for 'In Progress' status */
            background: #fff3e5; /* Light background for 'In Progress' */
        }

        .status.completed {
            color: #0a7c42; /* Text color for 'Completed' status */
            background: #e6f4ed; /* Light background for 'Completed' */
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px; /* Margin below header */
        }

        .header-row h2 {
            color: #333; /* Color for header text */
            font-size: 24px; /* Font size for header */
            margin: 0; /* No margin */
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
        background: #a29bfe;;
        }
    </style>
</head>

<body>
    <div class="orders-container">
        <div class="header-row">
            <h2>Customer Orders</h2> <!-- Header for the orders section -->
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

    <script>
        // Sample data structure - replace this with your actual data source
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

        // Function to load data into the table
        function loadOrdersData(data) {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = ''; // Clear existing content

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

        // Function to fetch data from an API
        async function fetchOrders() {
            try {
                // Replace this with your actual API endpoint
                // const response = await fetch('your-api-endpoint');
                // const data = await response.json();
                
                // For now, using the sample data
                loadOrdersData(orders);
            } catch (error) {
                console.error('Error fetching orders:', error);
            }
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', fetchOrders);
    </script>
</body>
</html>


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
