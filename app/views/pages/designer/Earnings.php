<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">

    <!-- <link rel="stylesheet" href="../../styles/influencer/transactionTable.css"> -->
    <!-- <link rel="stylesheet" href="../../styles/influencer/Earnings.css"> -->

    <style>
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
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

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
        </div>
    </div>

    <script>document.addEventListener('DOMContentLoaded', function () {
            // Simulated database data
            const data = {
                availableFunds: {
                    balanceAvailable: "0.00",
                    withdrawnToDate: "2707.70"
                },
                futurePayments: {
                    paymentsBeingCleared: "32.00",
                    paymentsForActiveOrders: "56.00"
                },
                earningsAndExpenses: {
                    earningsToDate: "2896.80",
                    expensesToDate: "189.10"
                }
            };

            // Update HTML with data
            document.getElementById('balance-available').textContent = `$${data.availableFunds.balanceAvailable}`;
            document.getElementById('withdrawn-to-date').textContent = `$${data.availableFunds.withdrawnToDate}`;
            document.getElementById('payments-clearing').textContent = `$${data.futurePayments.paymentsBeingCleared}`;
            document.getElementById('active-orders').textContent = `$${data.futurePayments.paymentsForActiveOrders}`;
            document.getElementById('earnings-to-date').textContent = `$${data.earningsAndExpenses.earningsToDate}`;
            document.getElementById('expenses-to-date').textContent = `$${data.earningsAndExpenses.expensesToDate}`;
        });</script>

    <div class="transaction">

        <?php include __DIR__ . '/../../components/designer/transactionTable.php'; ?>
    </div>
    <script src="../scripts/common/header.js"></script>

</body>

</html>