<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* General container styles */
  

        .orders-container {
            margin: 20px auto;
            padding: 20px;
            max-width: 1000px;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        /* Table styles */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        /* Table header styles */
        .orders-table thead {
            /* background-color: #007bff; */
            /* color: #fff; */
        }

        .orders-table th {
            padding: 12px 8px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
            border-bottom: 2px solid #ddd;
        }

        /* Table body styles */
        .orders-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            color: #333;
        }

        /* Zebra striping */
        .orders-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Hover effect */
        .orders-table tbody tr:hover {
            background-color: #e9f5ff;
            cursor: pointer;
        }

        /* Specific column styling */
        .orders-table td:nth-child(6) {
            font-weight: bold;
            color: #28a745; /* Green for positive amounts */
        }

        .orders-table td:nth-child(6):contains("-") {
            color: #dc3545; /* Red for negative amounts */
        }

        /* Responsive table */
        @media (max-width: 768px) {
            .orders-table {
                font-size: 12px;
            }

            .orders-container {
                padding: 15px;
            }
        }

    </style>
</head>

<body>
    <div class="orders-container">
        
        <table class="orders-table">
        <thead>
        <tr>
            <th>Date</th>
            <th>Activity</th>
            <th>Description</th>
            <th>From</th>
            <th>Order</th>
            <th>Amount</th>
        </tr>
    </thead>
            <h2>Transaction History</h2>
            <tbody id="ordersTableBody">
                    <!-- Data will be loaded here dynamically -->
                </tbody>
            
        </table>
    </div>

    <script>
       const orders = [
    {
        date: "11/25/2024",
        activity: "Clearing",
        description: "Order will clear in 7 days",
        from: "daisymaas",
        order: "FO60A75801",
        amount: "$12.00"
    },
    {
        date: "11/25/2024",
        activity: "Clearing",
        description: "Order extra will clear in 7 days",
        from: "daisymaas",
        order: "FO1660A701",
        amount: "$8.00"
    },
    {
        date: "11/24/2024",
        activity: "Clearing",
        description: "Order will clear in 7 days",
        from: "oluebube30",
        order: "FO3235A0E41",
        amount: "$12.00"
    },
    {
        date: "11/17/2024",
        activity: "Withdrawal",
        description: "Transferred successfully",
        from: "Payoneer",
        order: "-",
        amount: "-$63.42"
    },
    {
        date: "11/17/2024",
        activity: "Earning",
        description: "Order extra",
        from: "guessoka",
        order: "FO82C8C9196",
        amount: "$12.00"
    },
    {
        date: "11/17/2024",
        activity: "Earning",
        description: "Order",
        from: "guessoka",
        order: "FO88C9193C6",
        amount: "$8.00"
    }
];

function loadOrdersData(data) {
    const tableBody = document.getElementById('ordersTableBody');
    tableBody.innerHTML = ''; // Clear existing content

    data.forEach(order => {
        const row = document.createElement('tr');
        
        row.innerHTML = `
            <td>${order.date}</td>
            <td>${order.activity}</td>
            <td>${order.description}</td>
            <td>${order.from}</td>
            <td>${order.order}</td>
            <td>${order.amount}</td>
        `;
        
        tableBody.appendChild(row);
    });
}

// Load data when page loads
document.addEventListener('DOMContentLoaded', () => loadOrdersData(orders));

    </script>
</body>
</html>