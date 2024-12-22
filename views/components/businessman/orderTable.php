<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

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
    </style>

<body>
    <div class="orders-container">
        
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Influencer/Designer</th>
                    <th>Service Type</th>
                    <th>Service</th>
                    <th>Due On</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="ordersTableBody">
                <!-- Data will be loaded here dynamically -->
            </tbody>
        </table>
    </div>

    <script>
        // Sample data structure - replace this with your actual data source
        const orders = [
            {
                provider: "Kavindya Adhikari",
                service_type: "Promotion",
                service: "Promotional Post",
                dueOn: "3 Days",
                total: "LKR 10 000",
                status: "In Progress"
            },
            {
                provider: "Nadun Sandanayake",
                service_type: "Design",
                service: "Promotional Post Design",
                dueOn: "3 Days",
                total: "LKR 20 000",
                status: "In Progress"
            },
            {
                provider: "Nethsilu Marasinghe",
                service_type: "Promotion",
                service: "Promotional Video",
                dueOn: "3 Days",
                total: "LKR 15 000",
                status: "Completed"
            },
            {
                provider: "Safran Zahim",
                service_type: "Design",
                service: "Promotional Post Design",
                dueOn: "3 Days",
                total: "LKR 7 500",
                status: "Completed"
            }
        ];

        // Function to load data into the table
        function loadOrdersData() {
            const tableBody = document.getElementById('ordersTableBody');
            
            orders.forEach(order => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${order.provider}</td>
                    <td>${order.service_type}</td>
                    <td>${order.service}</td>
                    <td>${order.dueOn}</td>
                    <td>${order.total}</td>
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