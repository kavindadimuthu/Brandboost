<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Orders</title>
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
            /* margin: auto; */
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
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="main-content">
                <div class="order-container">
                    <div class="search-box">
                        <input type="text" placeholder="Search by Order ID or Username">
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
                            <!-- Data will be loaded dynamically -->
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
            </div>
        </div>
    </div>

    <script>
        const orders = [{
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
        }];

        function loadOrdersData(data) {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = '';

            data.forEach(order => {
                const row = document.createElement('tr');
                const statusClass = order.status.toLowerCase().replace(' ', '-');
                row.innerHTML = `
                    <td onclick="window.location.href='/influencer/order-details/1'">${order.buyer}</td>
                    <td onclick="window.location.href='/influencer/order-details/1'">${order.gig}</td>
                    <td onclick="window.location.href='/influencer/order-details/1'">${order.dueOn}</td>
                    <td onclick="window.location.href='/influencer/order-details/1'">${order.total}</td>
                    <td onclick="window.location.href='/influencer/order-details/1'"><span class="status ${statusClass}">${order.status}</span></td>
                `;
                tableBody.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', () => loadOrdersData(orders));
    </script>
</body>
</html>