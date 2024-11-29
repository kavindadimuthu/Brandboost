<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../../public/styles/business-owner/paymentTable.css">
</head>

<body>
    <div class="orders-container">
        
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Influencer</th>
                    <th>Paid</th>
                    <th>Remaining</th>
                    <th>Total</th>
                    <th>Designer</th>
                    <th>Paid</th>
                    <th>Remaining</th>
                    <th>Total</th>
                    <th>Due On</th>
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
                gig: "Promotional Post",
                influencer: "kavindya Adhikari",
                paid: "$5",
                remaining: "$15",
                total: "$20",
                designer: "Amal Perera",
                paid: "$5",
                remaining: "$15",
                total: "$20",  
                dueOn: "3 Days",
                status: "In Progress"
            },
            {
                gig: "Promotional Post",
                influencer: "Sugar Lips",
                paid: "$5",
                remaining: "$15",
                total: "$20",
                designer: "Gayashan Rathnayake",
                paid: "$5",
                remaining: "$15",
                total: "$20",  
                dueOn: "3 Days",
                status: "In Progress"
            },
            {
                gig: "Promotional Post",
                influencer: "Shanudrie Priyasad",
                paid: "$5",
                remaining: "$15",
                total: "$20",
                designer: "Nadn Sandanayake",
                paid: "$5",
                remaining: "$15",
                total: "$20",  
                dueOn: "3 Days",
                status: "Completed"
            },
            {
                gig: "Promotional Post",
                influencer: "Dinakshie Priyasad",
                paid: "$5",
                remaining: "$15",
                total: "$20",
                designer: "Kaviru Hapuarachchi",
                paid: "$5",
                remaining: "$15",
                total: "$20",  
                dueOn: "3 Days",
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
                    <td>${order.gig}</td>
                    <td>${order.influencer}</td>
                    <td>${order.paid}</td>
                    <td>${order.remaining}</td>
                    <td>${order.total}</td>
                    <td>${order.designer}</td>
                    <td>${order.paid}</td>
                    <td>${order.remaining}</td>
                    <td>${order.total}</td>
                    <td>${order.dueOn}</td>
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