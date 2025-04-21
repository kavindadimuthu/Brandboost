<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            display: flex;
            margin: auto;
            max-width: 1200px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            font-size: 14px;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .section h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #444;
        }

        .card {
            display: flex;
            flex-direction: column;
            gap: 10px;
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

        #withdraw-btn {
            /* background-color: #007bff; */
            
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
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

        #filter-earnings-btn{
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        #filter-earnings-btn:hover {
            background: linear-gradient(135deg,rgba(137, 43, 226, 0.8),rgba(65, 105, 225, 0.8));
        }

        #withdraw-btn:enabled {
            cursor: pointer;
            opacity: 1;
        }

        #manage-payout {
            display: block;
            margin-top: 10px;
            font-size: 0.9em;
            /* color: #007bff; */
            color: #4169E1;
            text-decoration: none;
        }

        #manage-payout:hover {
            text-decoration: underline;
        }

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

        .transaction-table th, .transaction-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .transaction-table th {
            background: #f8f9fa;
            color: #666;
            font-weight: 500;
        }

        .transaction-table tr:hover td {
            /* color: #007bff; */
            color: #4169E1;
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
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s;
        }

        .pagination button:hover {
            /* background: #0056b3; */
            background: linear-gradient(135deg,rgba(137, 43, 226, 1),rgba(65, 105, 225, 1));
            color: white;
        }

        .pagination button.active {
            /* background: #a29bfe; */
            background: linear-gradient(135deg,rgba(137, 43, 226, 0.8),rgba(65, 105, 225, 0.8));
            color: white;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
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
                        <p class="value" id="balance-available">Loading...</p>
                        <p class="small-text">Withdrawn to date:</p>
                        <p class="value-small" id="withdrawn-to-date">Loading...</p>
                        <button id="withdraw-btn" disabled>Withdraw balance</button>
                        <a href="/<?php echo $_SESSION['user']['role']; ?>/payout-methods" id="manage-payout">Manage payout methods</a>
                    </div>
                </div>
                <div class="section">
                    <h2>Future Payments</h2>
                    <div class="card">
                        <p class="label">Payments being cleared</p>
                        <p class="value" id="payments-clearing">Loading...</p>
                        <p class="small-text">Payments for active orders</p>
                        <p class="value-small" id="active-orders">Loading...</p>
                    </div>
                </div>
                <div class="section">
                    <h2>Earnings by Period</h2>
                    <div class="card">
                        <p class="label">Select Date Range</p>
                        <div class="date-range-container">
                            <div>
                                <p class="small-text">From</p>
                                <input type="date" id="start-date" class="date-input">
                            </div>
                            <div>
                                <p class="small-text">To</p>
                                <input type="date" id="end-date" class="date-input">
                            </div>
                        </div>
                        <button id="filter-earnings-btn" class="filter-btn">View Earnings</button>
                        <p class="label">Total Earnings</p>
                        <p class="value" id="period-earnings">LKR 0.00</p>
                        <p class="small-text">Select a date range to view your earnings for that period.</p>
                    </div>
                </div>
            </div>

            <div class="transaction-container">
                <div class="header-row">
                    <h2>Transaction History</h2>
                </div>
                <table class="transaction-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <!-- <th>From</th> -->
                            <th>Order</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTableBody">
                        <tr><td colspan="5">Loading transactions...</td></tr>
                    </tbody>
                </table>
                <div class="pagination">
                    <button>&lt;</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>&gt;</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const balanceAvailable = document.getElementById('balance-available');
            const withdrawnToDate = document.getElementById('withdrawn-to-date');
            const paymentsClearing = document.getElementById('payments-clearing');
            const activeOrders = document.getElementById('active-orders');
            const earningsToDate = document.getElementById('earnings-to-date');
            const expensesToDate = document.getElementById('expenses-to-date');
            const transactionTableBody = document.getElementById('transactionTableBody');

            // Fetch balance and transaction data
            async function fetchSellerBalance() {
                try {
                    const response = await fetch('http://localhost:8000/api/payments/seller-balance');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();
                    console.log('Balance data:', result.balance);

                    // Render financial data
                    balanceAvailable.textContent = `LKR ${result.balance}`;
                    // withdrawnToDate.textContent = `LKR ${result.availableFunds.withdrawnToDate}`;
                    // paymentsClearing.textContent = `LKR ${result.futurePayments.paymentsBeingCleared}`;
                    // activeOrders.textContent = `LKR ${result.futurePayments.paymentsForActiveOrders}`;
                    // earningsToDate.textContent = `LKR ${result.earningsAndExpenses.earningsToDate}`;
                    // expensesToDate.textContent = `LKR ${result.earningsAndExpenses.expensesToDate}`;
                    
                } catch (error) {
                    console.error('Error fetching dashboard data:', error);
                    balanceAvailable.textContent = 'Error loading data';
                }
            }

            async function fetchHoldBalance() {
                try {
                    const response = await fetch('/api/payments/seller-holds');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();
                    console.log('Hold balance:', result);

                    // Render hold balance data
                   paymentsClearing.textContent = `LKR ${result.hold_balance}`;
                    
                } catch (error) {
                    console.error('Error fetching hold balance:', error);
                }
            }

            async function fetchPeriodEarnings() {
                try {
                    const startDate = document.getElementById('start-date').value;
                    const endDate = document.getElementById('end-date').value;
                    const periodEarnings = document.getElementById('period-earnings');
                    
                    // Validate dates
                    if (!startDate || !endDate) {
                        alert('Please select both start and end dates');
                        return;
                    }
                    
                    if (new Date(startDate) > new Date(endDate)) {
                        alert('Start date cannot be after end date');
                        return;
                    }
                    
                    // Update UI to show loading state
                    periodEarnings.textContent = 'Loading...';
                    
                    // Make API request with date parameters
                    const response = await fetch(`/api/payments/period-earnings?start=${startDate}&end=${endDate}`);
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const result = await response.json();
                    console.log('Period earnings data:', result);
                    
                    // Update the display with the earnings amount
                    periodEarnings.textContent = `LKR ${result.total_earnings || '0.00'}`;
                    
                } catch (error) {
                    console.error('Error fetching period earnings:', error);
                    document.getElementById('period-earnings').textContent = 'Error loading data';
                }
            }

            // Add event listener to the filter button
            document.getElementById('filter-earnings-btn').addEventListener('click', fetchPeriodEarnings);

            async function fetchTransactionData() {
                try {
                    const response = await fetch('/api/payments/seller-transactions');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();
                    console.log('Transaction data:', result);

                    // Use correct key to access the data
                    const transactions = result.data || [];
                    if (transactions.length === 0) {
                        transactionTableBody.innerHTML = '<tr><td colspan="5">No transactions found</td></tr>';
                        return;
                    }

                    transactionTableBody.innerHTML = transactions.map(tx => `
                        <tr>
                            <td>${tx.created_at}</td>
                            <td>${tx.status}</td>
                            <td>${tx.order_id}</td>
                            <td>${tx.amount}</td>
                        </tr>
                    `).join('');
                } catch (error) {
                    console.error('Error fetching transaction data:', error);
                }
            }


            // Initialize
            fetchSellerBalance();
            fetchHoldBalance();
            fetchPeriodEarnings();
            fetchTransactionData();
        });
    </script>
</body>


</html>