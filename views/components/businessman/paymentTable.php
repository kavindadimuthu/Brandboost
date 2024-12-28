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
</style>

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