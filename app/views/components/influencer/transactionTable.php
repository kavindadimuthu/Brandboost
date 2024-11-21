<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../../public/styles/influencer/orderTable.css">
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