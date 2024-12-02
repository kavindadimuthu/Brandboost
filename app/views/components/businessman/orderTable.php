<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../../public/styles/business-owner/orderTable.css">
</head>

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