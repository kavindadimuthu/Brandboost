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
                    <th>Influencer</th>
                    <th>Designer</th>
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
        // Sample data structure - replace this with your actual data source
        const orders = [
            {
                influencer: "kavindya Adhikari",
                designer: "Amal Perera",
                gig: "Promotional Post",
                dueOn: "3 Days",
                total: "$20",
                status: "In Progress"
            },
            {
                influencer: "sugar Lips",
                designer: "Gayashan Rathnayake",
                gig: "Promotional Post",
                dueOn: "3 Days",
                total: "$20",
                status: "In Progress"
            },
            {
                influencer: "Shanudrie Priyasad",
                designer: "Nadn Sandanayake",
                gig: "Promotional Post",
                dueOn: "3 Days",
                total: "$20",
                status: "Completed"
            },
            {
                influencer: "Dinakshie Priyasad",
                designer: "Kaviru Hapuarachchi",
                gig: "Promotional Post",
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
                    <td>${order.influencer}</td>
                    <td>${order.designer}</td>
                    <td>${order.gig}</td>
                    <td>${order.dueOn}</td>
                    <td>${order.total}</td>
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