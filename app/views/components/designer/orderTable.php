<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="../../../../public/styles/influencer/orderTable.css"> -->
  <style>
        .orders-table tr {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .orders-table tr:hover td {
            color: #007bff; /* Blue text color on hover */
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



        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
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
            color: #333;
            font-size: 14px;
            border-bottom: 1px solid #eee;
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
    </style>
</head>

<body>
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

    <script>
        // Sample data structure - replace this with your actual data source
        const orders = [
            {
                buyer: "Consequat",
                gig: "Deserunt minim indidunt cillum no",
                dueOn: "3 Days",
                total: "$20",
                status: "In Progress"
            },
            {
                buyer: "Reprehende",
                gig: "Deserunt minim indidunt cillum no",
                dueOn: "3 Days",
                total: "$20",
                status: "In Progress"
            },
            {
                buyer: "Content",
                gig: "Deserunt minim indidunt cillum no",
                dueOn: "3 Days",
                total: "$20",
                status: "Completed"
            },
            {
                buyer: "Content",
                gig: "Deserunt minim indidunt cillum no",
                dueOn: "3 Days",
                total: "$20",
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
                    <td onclick="window.location.href='/designerviewcontroller/singleOrder'">${order.buyer}</td>
                    <td onclick="window.location.href='/designerviewcontroller/singleOrder'">${order.gig}</td>
                    <td onclick="window.location.href='/designerviewcontroller/singleOrder'">${order.dueOn}</td>
                    <td onclick="window.location.href='/designerviewcontroller/singleOrder'">${order.total}</td>
                    <td><span class="status ${statusClass}">${order.status}</span></td>
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