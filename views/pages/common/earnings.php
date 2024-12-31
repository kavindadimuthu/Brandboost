<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings</title>

    <!-- <link rel="stylesheet" href="../../styles/influencer/transactionTable.css"> -->
    <!-- <link rel="stylesheet" href="../../styles/influencer/Earnings.css"> -->

    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            display: flex;
            margin: auto;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            /* background-color: #f0f0f0; */
            border-radius: 20px;
            font-size: 14px;
        }

        .main-content {
            /* margin-top: 60px; */
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }





        .main-content {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .section {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Section headers */
        .section h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #444;
        }

        /* Card styles */
        .card {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .card p {
            margin: 0;
        }

        .label {
            font-weight: bold;
            font-size: 1.1em;
            color: #555;
        }

        .value {
            font-size: 1.5em;
            font-weight: bold;
            color: #222;
        }

        .value-small {
            font-size: 1.2em;
            color: #666;
        }

        .small-text {
            font-size: 0.9em;
            color: #888;
        }

        /* Button and link styles */
        #withdraw-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: not-allowed;
            opacity: 0.7;
            margin-top: 15px;
            transition: 0.3s;
        }

        #withdraw-btn:enabled {
            cursor: pointer;
            opacity: 1;
        }

        #manage-payout {
            display: block;
            margin-top: 10px;
            font-size: 0.9em;
            color: #007bff;
            text-decoration: none;
        }

        #manage-payout:hover {
            text-decoration: underline;
        }

        /* Transaction section */
        .transaction {
            /* margin: 20px; */
            width: 100%;
        }

        .transaction h2 {
            margin: 20px 0px;
            font-size: 1.5em;
            color: #333;
        }



        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
                align-items: center;
            }

            .section {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>

</head>

<body>
    <div class="container">

        <div class="content">
            <div class="main-content">
                <div class="section">
                    <h2>Available Funds</h2>
                    <div class="card">
                        <p class="label">Balance available for use</p>
                        <p class="value" id="balance-available">$0.00</p>
                        <p class="small-text">Withdrawn to date:</p>
                        <p class="value-small" id="withdrawn-to-date">$0.00</p>
                        <button id="withdraw-btn" disabled>Withdraw balance</button>
                        <a href="#" id="manage-payout">Manage payout methods</a>
                    </div>
                </div>
                <div class="section">
                    <h2>Future Payments</h2>
                    <div class="card">
                        <p class="label">Payments being cleared</p>
                        <p class="value" id="payments-clearing">$0.00</p>
                        <p class="small-text">Payments for active orders</p>
                        <p class="value-small" id="active-orders">$0.00</p>
                    </div>
                </div>
                <div class="section">
                    <h2>Earnings & Expenses</h2>
                    <div class="card">
                        <p class="label">Earnings to date</p>
                        <p class="value" id="earnings-to-date">$0.00</p>
                        <p class="small-text">Your earnings since joining.</p>
                        <p class="small-text">Expenses to date</p>
                        <p class="value-small" id="expenses-to-date">$0.00</p>
                    </div>
                </div>

            </div>
            <div class="transaction">

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
                            color: #007bff;
                            /* Blue text color on hover */
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
                        const transactions = [{
                                date: "12/01/2024",
                                activity: "Clearing",
                                from: "Global Marketplace",
                                order: "FO60A75801",
                                amount: "LKR 4,000.00"
                            },
                            {
                                date: "11/29/2024",
                                activity: "Clearing",
                                from: "E-commerce Platform",
                                order: "FO1660A701",
                                amount: "LKR 12,000.00"
                            },
                            {
                                date: "11/25/2024",
                                activity: "Clearing",
                                from: "Online Seller Network",
                                order: "FO3235A0E41",
                                amount: "LKR 19,000.00"
                            },
                            {
                                date: "11/20/2024",
                                activity: "Withdrawal",
                                from: "Payment Gateway",
                                order: "-",
                                amount: "-LKR 14,000.00"
                            },
                            {
                                date: "11/18/2024",
                                activity: "Earning",
                                from: "Freelance Platform",
                                order: "FO82C8C9196",
                                amount: "$LKR 2,000.00"
                            },
                            {
                                date: "11/15/2024",
                                activity: "Earning",
                                from: "Digital Marketplace",
                                order: "FO88C9193C6",
                                amount: "LKR 9,000.00"
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
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulated database data
            const data = {
                availableFunds: {
                    balanceAvailable: "0.00",
                    withdrawnToDate: "2,707.70"
                },
                futurePayments: {
                    paymentsBeingCleared: "26, 000.00",
                    paymentsForActiveOrders: "13, 500.00"
                },
                earningsAndExpenses: {
                    earningsToDate: " 100,000.80",
                    expensesToDate: " 19,000.00"
                }
            };

            // Update HTML with data
            document.getElementById('balance-available').textContent = `LKR ${data.availableFunds.balanceAvailable}`;
            document.getElementById('withdrawn-to-date').textContent = `LKR ${data.availableFunds.withdrawnToDate}`;
            document.getElementById('payments-clearing').textContent = `LKR ${data.futurePayments.paymentsBeingCleared}`;
            document.getElementById('active-orders').textContent = `LKR ${data.futurePayments.paymentsForActiveOrders}`;
            document.getElementById('earnings-to-date').textContent = `LKR ${data.earningsAndExpenses.earningsToDate}`;
            document.getElementById('expenses-to-date').textContent = `LKR ${data.earningsAndExpenses.expensesToDate}`;
        });
    </script>



</body>

</html>