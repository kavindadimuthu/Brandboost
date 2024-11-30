<!DOCTYPE html>
< lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../../public/styles/business-owner/DeliveriesTable.css">
</head>

<body>
    <div class="orders-container">
        
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Influencer/Designer</th>
                    <th>RivisionCount</th>
                    <th>Delivery</th>
                    <th>File</th>
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
                order: "Promotional Video",
                provider: "Kavindya Adhikari",
                rivisioncount: "2",
                delivery: "-",
                file: "video2.mp4",
                status: "In Progress"
            },
            {
                order: "Promotional Video",
                provider: "Kavindya Adhikari",
                rivisioncount: "1",
                delivery: "-",
                file: "video1.mp4",
                status: "In Progress"
            },
            {
                order: "Promotional Post Design",
                provider: "Nadun Sandanayake",
                rivisioncount: "3",
                delivery: "done",
                file: "finalpost.png",
                status: "Completed"
            },
            {
                order: "Promotional Post Design",
                provider: "Nadun Sandanayake",
                rivisioncount: "3",
                delivery: "-",
                file: "post3.png",
                status: "In Progress"
            }
        ];
        // Function to load data into the table
        function loadOrdersData() {
            const tableBody = document.getElementById('ordersTableBody');
            
            orders.forEach(order => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${order.order}</td>
                    <td>${order.provider}</td>
                    <td>${order.rivisioncount}</td>
                    <td>${order.delivery}</td>
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