<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

        #withdraw-btn {
            background: linear-gradient(135deg, #6201A9 0%, #6a11cb 100%);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
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
            color: #6201A9;
            text-decoration: none;
        }

        #manage-payout:hover {
            text-decoration: underline;
        }

        .transaction {
            width: 100%;
        }

        .transaction h2 {
            margin: 20px 0px;
            font-size: 1.5em;
            color: #333;
        }

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

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .popup.active {
            display: block;
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .popup-header h3 {
            margin: 0;
            font-size: 1.2em;
            color: #444;
        }

        .popup-header .close-btn {
            cursor: pointer;
            font-size: 1.2em;
            color: #888;
        }

        .popup-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .popup-content label {
            font-size: 1em;
            color: #555;
        }

        .popup-content input,
        .popup-content select {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .popup-content button {
            background: linear-gradient(135deg, #6201A9 0%, #6a11cb 100%);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
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
                        <p class="value" id="balance-available"></p>
                        <p class="small-text">Withdrawn to date:</p>
                        <p class="value-small" id="withdrawn-to-date"></p>
                        <button id="withdraw-btn" disabled>Withdraw balance</button>
                        <a href="#" id="manage-payout">Manage payout methods</a>
                    </div>
                </div>
                <div class="section">
                    <h2>Future Payments</h2>
                    <div class="card">
                        <p class="label">Payments being cleared</p>
                        <p class="value" id="payments-clearing"></p>
                        <p class="small-text">Payments for active orders</p>
                        <p class="value-small" id="active-orders"></p>
                    </div>
                </div>
                <div class="section">
                    <h2>Earnings</h2>
                    <div class="card">
                        <p class="label">Earnings to date</p>
                        <p class="value" id="earnings-to-date"></p>
                        <p class="small-text">Your earnings since joining.</p>
                        <p class="small-text">Expenses to date</p>
                        <p class="value-small" id="expenses-to-date"></p>
                    </div>
                </div>
            </div>
            <div class="transaction">
                <?php include __DIR__ . '/../../components/designer/transactionTable.php'; ?>
            </div>
        </div>
    </div>

    <div class="popup" id="withdraw-popup">
        <div class="popup-header">
            <h3>Withdraw Balance</h3>
            <span class="close-btn" id="close-withdraw-popup">&times;</span>
        </div>
        <div class="popup-content">
            <label for="withdraw-amount">Amount to Withdraw</label>
            <input type="number" id="withdraw-amount" min="0" step="0.01">
            <button id="confirm-withdraw">Confirm</button>
        </div>
    </div>

    <div class="popup" id="manage-payout-popup">
        <div class="popup-header">
            <h3>Manage Payout Methods</h3>
            <span class="close-btn" id="close-manage-payout-popup">&times;</span>
        </div>
        <div class="popup-content">
            <label for="payout-method">Select Payout Method</label>
            <select id="payout-method">
                <option value="paypal">PayPal</option>
                <option value="bank">Bank Transfer</option>
                <option value="crypto">Cryptocurrency</option>
            </select>
            <button id="confirm-payout-method">Confirm</button>
        </div>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const data = {
        availableFunds: {
            balanceAvailable: "26,455.00",
            withdrawnToDate: " 2707.70"
        },
        futurePayments: {
            paymentsBeingCleared: " 32, 000.00",
            paymentsForActiveOrders: " 56, 000.00"
        },
        earningsAndExpenses: {
            earningsToDate: " 98, 096.80",
            expensesToDate: " 18, 899.10"
        }
    };

    document.getElementById('balance-available').textContent = `LKR ${data.availableFunds.balanceAvailable}`;
    document.getElementById('withdrawn-to-date').textContent = `LKR${data.availableFunds.withdrawnToDate}`;
    document.getElementById('payments-clearing').textContent = `LKR${data.futurePayments.paymentsBeingCleared}`;
    document.getElementById('active-orders').textContent = `LKR${data.futurePayments.paymentsForActiveOrders}`;
    document.getElementById('earnings-to-date').textContent = `LKR${data.earningsAndExpenses.earningsToDate}`;
    document.getElementById('expenses-to-date').textContent = `LKR${data.earningsAndExpenses.expensesToDate}`;

    const withdrawBtn = document.getElementById('withdraw-btn');
    const managePayoutLink = document.getElementById('manage-payout');
    const withdrawPopup = document.getElementById('withdraw-popup');
    const managePayoutPopup = document.getElementById('manage-payout-popup');
    const closeWithdrawPopup = document.getElementById('close-withdraw-popup');
    const closeManagePayoutPopup = document.getElementById('close-manage-payout-popup');
    
    // Enable withdraw button if balance is available
    const balanceAvailable = parseFloat(data.availableFunds.balanceAvailable);
    if (balanceAvailable > 0) {
        withdrawBtn.disabled = false;
    }

    withdrawBtn.addEventListener('click', () => {
        const confirmWithdrawPopup = document.createElement('div');
        confirmWithdrawPopup.classList.add('popup', 'active');
        confirmWithdrawPopup.innerHTML = `
            <div class="popup-header">
                <h3>Confirm Withdrawal</h3>
                <span class="close-btn" id="close-confirm-popup">&times;</span>
            </div>
            <div class="popup-content">
                <p>Do you want to withdraw $${balanceAvailable}?</p>
                <input type="number" id="custom-withdraw-amount" min="0" max="${balanceAvailable}" step="0.01" placeholder="Enter amount (optional)">
                <div style="display: flex; justify-content: space-between;">
                    <button id="confirm-withdraw-yes">Yes</button>
                    <button id="confirm-withdraw-no">No</button>
                </div>
            </div>
        `;
        document.body.appendChild(confirmWithdrawPopup);

        const closeConfirmPopup = document.getElementById('close-confirm-popup');
        const confirmYes = document.getElementById('confirm-withdraw-yes');
        const confirmNo = document.getElementById('confirm-withdraw-no');
        const customAmount = document.getElementById('custom-withdraw-amount');

        closeConfirmPopup.addEventListener('click', () => {
            document.body.removeChild(confirmWithdrawPopup);
        });

        confirmYes.addEventListener('click', () => {
            let withdrawAmount = balanceAvailable;
            if (customAmount.value) {
                const customWithdrawAmount = parseFloat(customAmount.value);
                if (customWithdrawAmount > 0 && customWithdrawAmount <= balanceAvailable) {
                    withdrawAmount = customWithdrawAmount;
                }
            }
            alert(`You have withdrawn $${withdrawAmount.toFixed(2)}`);
            document.body.removeChild(confirmWithdrawPopup);
        });

        confirmNo.addEventListener('click', () => {
            document.body.removeChild(confirmWithdrawPopup);
        });
    });

    managePayoutLink.addEventListener('click', (e) => {
        e.preventDefault();
        managePayoutPopup.classList.add('active');
    });

    closeWithdrawPopup.addEventListener('click', () => {
        withdrawPopup.classList.remove('active');
    });

    closeManagePayoutPopup.addEventListener('click', () => {
        managePayoutPopup.classList.remove('active');
    });

    document.getElementById('confirm-withdraw').addEventListener('click', () => {
        const amount = document.getElementById('withdraw-amount').value;
        alert(`You have withdrawn $${amount}`);
        withdrawPopup.classList.remove('active');
    });

    document.getElementById('confirm-payout-method').addEventListener('click', () => {
        const method = document.getElementById('payout-method').value;
        alert(`You have selected ${method} as your payout method`);
        managePayoutPopup.classList.remove('active');
    });
});
    </script>

    <!-- <script src="../scripts/common/header.js"></script> -->
</body>

</html>