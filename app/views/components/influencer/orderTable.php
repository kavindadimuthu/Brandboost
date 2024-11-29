<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="orders-container">
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
                <!-- Data will be loaded here dynamically -->
            </tbody>
        </table>
    </div>

    <script>
        // Sample data structure
        const orders = [
            {
                buyer: "Kavinds",
                gig: "Do Resturant Promotion through tiktok and facebook",
                dueOn: "5 Days",
                total: "$100",
                status: "In Progress"
            },
            {
                buyer: "Nethsilu",
                gig: "Do Business Promotion",
                dueOn: "14 Days",
                total: "$200",
                status: "In Progress"
            },
            
        ];

        // Function to load data into the table
        function loadOrdersData() {
            const tableBody = document.getElementById('ordersTableBody');
            
            orders.forEach(order => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${order.buyer}</td>
                    <td>${order.gig}</td>
                    <td>${order.dueOn}</td>
                    <td>${order.total}</td>
                    <td><span class="status ${order.status.toLowerCase().replace(' ', '-')}">${order.status}</span></td>
                `;
                
                row.addEventListener('click', () => {
                    window.location.href = 'http://localhost:8000/InfluencerViewController/singleorder';
                });
                
                tableBody.appendChild(row);
            });
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', loadOrdersData);
    </script>
</body>
</html>