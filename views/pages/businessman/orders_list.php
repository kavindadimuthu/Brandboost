<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
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
<body class="bg-gray-100">
    <div class="container mx-auto p-4 md:p-8">
        <h1 class="text-2xl font-bold mb-4">My Orders</h1>
        <div class="bg-white p-4 rounded-lg shadow-md mb-6 flex items-center">
            <i class="fas fa-search text-gray-500 mr-2"></i>
            <input type="text" placeholder="Search by Order ID or Username" class="w-full border-none focus:outline-none text-sm">
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Influencer/Designer</th>
                        <th class="py-3 px-6 text-left">Service Type</th>
                        <th class="py-3 px-6 text-left">Service</th>
                        <th class="py-3 px-6 text-left">Due On</th>
                        <th class="py-3 px-6 text-left">Total</th>
                        <th class="py-3 px-6 text-left">Status</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody" class="text-gray-600 text-sm font-light">
                    <!-- Data will be loaded here dynamically -->
                </tbody>
            </table>
        </div>
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
                row.classList.add('border-b', 'border-gray-200', 'hover:bg-gray-100');
                
                row.innerHTML = `
                    <td class="py-3 px-6 text-left whitespace-nowrap">${order.provider}</td>
                    <td class="py-3 px-6 text-left">${order.service_type}</td>
                    <td class="py-3 px-6 text-left">${order.service}</td>
                    <td class="py-3 px-6 text-left">${order.dueOn}</td>
                    <td class="py-3 px-6 text-left">${order.total}</td>
                    <td class="py-3 px-6 text-left"><span class="status ${order.status.toLowerCase().replace(' ', '-')} py-1 px-3 rounded-full text-xs">${order.status}</span></td>
                `;
                
                row.addEventListener('click', () => {
                    window.location.href = '/businessman/order-details/2';
                });
                
                tableBody.appendChild(row);
            });
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', loadOrdersData);
    </script>
</body>
</html>