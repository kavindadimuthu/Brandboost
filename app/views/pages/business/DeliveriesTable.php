<!DOCTYPE html>
< lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="../../../../public/styles/business-owner/DeliveriesTable.css"> -->
   <style>
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

        .download-button {
            background-color: #6a11cb; /* Blue color for the button */
            color: white; /* White text color */
            border: none; /* No border */
            padding: 5px 10px; /* Padding */
            cursor: pointer; /* Pointer cursor on hover */
            margin-left: 10px; /* Space between file name and button */
        }

        .download-button:hover {
            background-color: darkblue; /* Darker blue on hover */
        }
   </style>
</head>

<body>
    <div class="orders-container">
    <div class="header-row">
            <h2>My Orders</h2> <!-- Header for the orders section -->
        </div>
        
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
                    <td>${order.file}<button class="download-button" onclick="downloadFile('${order.file}')">Download</button></td>
                    <td><span class="status ${order.status.toLowerCase().replace(' ', '-')}">${order.status}</span></td>
                `;
                
                row.addEventListener('click', () => {
                    window.location.href = 'http://localhost:8000/BusinessViewController/BusinessSingleOrder';
                });
                
                tableBody.appendChild(row);
            });
        }

        // Function to handle file download
        function downloadFile(fileName) {
            // Replace with your actual download logic
            alert(`Downloading ${fileName}...`);
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', loadOrdersData);
    </script>
</body>
</html>