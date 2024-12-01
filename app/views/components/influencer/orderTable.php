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
                        buyer: "Spa Ceylon",
                        gig: "Do Business Promotion through Tiktok",
                        dueOn: "7 Days",
                        total: "$300",
                        status: "In Progress"
                    },
                    {
                        buyer: "Janet",
                        gig: "Do Business Promotion through Tiktok and Instagram",
                        dueOn: "Delivered",
                        total: "$500",
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
                    <td onclick="window.location.href='/influencerviewcontroller/singleOrder'">${order.buyer}</td>
                    <td onclick="window.location.href='/influencerviewcontroller/singleOrder'">${order.gig}</td>
                    <td onclick="window.location.href='/influencerviewcontroller/singleOrder'">${order.dueOn}</td>
                    <td onclick="window.location.href='/influencerviewcontroller/singleOrder'">${order.total}</td>
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
