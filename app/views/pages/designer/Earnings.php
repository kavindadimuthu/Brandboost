<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings</title>
    <link rel="stylesheet" href="../../styles/influencer/header.css">
    <link rel="stylesheet" href="../../styles/influencer/transactionTable.css">
    <link rel="stylesheet" href="../../styles/influencer/Earnings.css">

</head>
<body>
    <?php include __DIR__ . '/../../components/designer/header.php'; ?>
    <div class="dashboard">
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
    
    <script>document.addEventListener('DOMContentLoaded', function() {
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
    <h2>Transaction History</h2>
</div>
<?php include __DIR__ . '/../../components/designer/transactionTable.php'; ?>

</body>
</html>