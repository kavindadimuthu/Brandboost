<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .orders-container {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;    
        margin: 0 300px;
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

    .status.accepted {
        color: #0a7c42;
        background: #e6f4ed;
    }

    .status.rejected {
        color: #d9534f;
        background: #fbe6e6;
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
        color: white;
    }

    .pagination button.active {
        background: #a29bfe;
        color: white;
    }
  </style>
</head>

<body>
    <div class="orders-container">
        <div class="header-row">
            <h2>Deliveries</h2>
        </div>
        
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Revision Count</th>
                    <th>File</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="ordersTableBody">
                <!-- Data will be loaded here dynamically -->
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
                order: "Dec 2, 2024, 8:10 AM",
                rivisioncount: "2",
                file: "video2.mp4",
                status: "Accepted"
            },
            {
                order: "Dec 1, 2024, 10:30 PM",
                rivisioncount: "1",
                file: "video1.mp4",
                status: "Rejected"
            }
        ];

        // Function to load data into the table
        function loadOrdersData() {
            const tableBody = document.getElementById('ordersTableBody');
            
            orders.forEach(order => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${order.order}</td>
                    <td>${order.rivisioncount}</td>
                    <td>${order.file}</td>
                    <td><span class="status ${order.status.toLowerCase().replace(' ', '-')}">${order.status}</span></td>
                `;

                row.addEventListener('click', () => {
                    window.location.href = 'http://localhost:8000/BusinessViewController/BusinessSingleOrder';
                });

                tableBody.appendChild(row);
            });
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', loadOrdersData);
    </script>
</body>
</html>
