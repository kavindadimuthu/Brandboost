<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* General container styles */
    .transaction-container {
      margin: 20px;
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

    .transaction-table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
      overflow: hidden;
    }

    .transaction-table th {
      text-align: left;
      padding: 12px 16px;
      background: #f8f9fa;
      color: #666;
      font-weight: 500;
      font-size: 14px;
      border-bottom: 1px solid #eee;
    }

    .transaction-table td {
      padding: 16px;
      color: #333;
      font-size: 14px;
      border-bottom: 1px solid #eee;
    }

    .transaction-table tr {
      transition: all 0.3s ease;
    }

    .transaction-table tr:hover td {
      color: #007bff; /* Blue text color on hover */
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
      background: #a29bfe;
    }
  </style>
</head>

<body>
  <div class="transaction-container">
    <div class="header-row">
      <h2>Transaction History</h2>
    </div>
    
    <table class="transaction-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Activity</th>
          <th>From</th>
          <th>Order</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody id="transactionTableBody">
        <!-- Data will be loaded here dynamically -->
      </tbody>
    </table>
  </div>
  <div class="pagination">
    <button>&lt;</button>
    <button class="active">1</button>
    <button>2</button>
    <button>3</button>
    <button>&gt;</button>
  </div>

  <script>
    const transactions = [
      {
        date: "12/01/2024",
        activity: "Clearing",
        from: "Global Marketplace",
        order: "FO60A75801",
        amount: "$12.00"
      },
      {
        date: "11/29/2024",
        activity: "Clearing",
        from: "E-commerce Platform",
        order: "FO1660A701",
        amount: "$8.00"
      },
      {
        date: "11/25/2024",
        activity: "Clearing",
        from: "Online Seller Network",
        order: "FO3235A0E41",
        amount: "$12.00"
      },
      {
        date: "11/20/2024",
        activity: "Withdrawal",
        from: "Payment Gateway",
        order: "-",
        amount: "-$63.42"
      },
      {
        date: "11/18/2024",
        activity: "Earning",
        from: "Freelance Platform",
        order: "FO82C8C9196",
        amount: "$12.00"
      },
      {
        date: "11/15/2024",
        activity: "Earning",
        from: "Digital Marketplace",
        order: "FO88C9193C6",
        amount: "$8.00"
      }
    ];

    function loadOrdersData(data) {
      const tableBody = document.getElementById('transactionTableBody');
      tableBody.innerHTML = ''; // Clear existing content

      // Sort transactions by date (most recent first)
      const sortedTransactions = data.sort((a, b) => {
        return new Date(b.date.split('/').reverse().join('/')) - 
               new Date(a.date.split('/').reverse().join('/'));
      });

      sortedTransactions.forEach(transaction => {
        const row = document.createElement('tr');
        
        row.innerHTML = `
          <td>${transaction.date}</td>
          <td>${transaction.activity}</td>
          <td>${transaction.from}</td>
          <td>${transaction.order}</td>
          <td>${transaction.amount}</td>
        `;
        
        tableBody.appendChild(row);
      });
    }

    // Load data when page loads
    document.addEventListener('DOMContentLoaded', () => loadOrdersData(transactions));
  </script>
</body>
</html>