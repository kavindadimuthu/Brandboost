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
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
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
            background: linear-gradient(135deg,rgba(137, 43, 226, 1),rgba(65, 105, 225, 1));
            color: white;
        }

        .pagination button.active {
            background: linear-gradient(135deg,rgba(137, 43, 226, 0.8),rgba(65, 105, 225, 0.8));
            color: white;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .withdraw-modal {
            background-color: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-20px);
            transition: transform 0.3s;
        }

        .modal-overlay.active .withdraw-modal {
            transform: translateY(0);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .modal-header h3 {
            font-size: 1.5em;
            color: #333;
            margin: 0;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #888;
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: #4169E1;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        .input-group input:focus, .input-group select:focus {
            border-color: #4169E1;
            outline: none;
        }

        .balance-info {
            display: flex;
            justify-content: space-between;
            background-color: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .balance-info .label {
            font-size: 0.9em;
            color: #666;
        }

        .balance-info .value {
            font-size: 1em;
        }

        .withdraw-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .withdraw-actions button {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-cancel {
            background-color: #f1f1f1;
            color: #666;
        }

        .btn-cancel:hover {
            background-color: #e5e5e5;
        }

        .btn-withdraw {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
        }

        .btn-withdraw:hover {
            background: linear-gradient(135deg,rgba(137, 43, 226, 0.9),rgba(65, 105, 225, 0.9));
        }

        .btn-withdraw:disabled {
            background: linear-gradient(135deg,rgba(137, 43, 226, 0.5),rgba(65, 105, 225, 0.5));
            cursor: not-allowed;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 5px;
            display: none;
        }

        .success-message {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 6px;
            margin-bottom: 20px;
            display: none;
        }

        .date-range-container {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .date-range-container div {
            flex: 1;
        }

        .date-input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 0.9em;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .section {
                width: 100%;
                margin-bottom: 20px;
            }

            .withdraw-modal {
                width: 95%;
                padding: 20px;
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
                            <!-- <p class="small-text">Withdrawn to date:</p>
                            <p class="value-small" id="withdrawn-to-date">Loading...</p> -->
                            <button id="withdraw-btn">Withdraw balance</button>
                            <a href="/<?php echo $_SESSION['user']['role']; ?>/payout-methods" id="manage-payout">Manage payout methods</a>
                        </div>
                    </div>
                    <div class="section">
                        <h2>Future Payments</h2>
                        <div class="card">
                            <p class="label">Payments being cleared</p>
                            <p class="value" id="payments-clearing">Loading...</p>
                            <!-- <p class="small-text">Payments for active orders</p>
                            <p class="value-small" id="active-orders">Loading...</p> -->
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
                                <th>Order</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="transactionTableBody">
                            <tr><td colspan="5">Loading transactions...</td></tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <button id="prev-page">&lt;</button>
                        <button class="active" data-page="1">1</button>
                        <button data-page="2">2</button>
                        <button data-page="3">3</button>
                        <button id="next-page">&gt;</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdraw Modal -->
        <div class="modal-overlay" id="withdraw-modal-overlay">
            <div class="withdraw-modal">
                <div class="modal-header">
                    <h3>Withdraw Funds</h3>
                    <button class="close-modal" id="close-withdraw-modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="success-message" id="withdraw-success-message">
                        Your withdrawal request has been submitted successfully. You will be notified once processed.
                    </div>
                    
                    <div class="balance-info">
                        <span class="label">Available Balance:</span>
                        <span class="value" id="modal-available-balance">LKR 0.00</span>
                    </div>
                    
                    <div class="input-group">
                        <label for="withdraw-amount">Amount to Withdraw</label>
                        <input type="number" id="withdraw-amount" placeholder="Enter amount" min="0" step="0.01">
                        <p class="error-message" id="amount-error">Please enter a valid amount that doesn't exceed your available balance.</p>
                    </div>
                    
                    <div class="input-group">
                        <label for="payment-method">Select Payment Method</label>
                        <select id="payment-method">
                            <option value="" disabled selected>Select a payment method</option>
                        </select>
                        <p class="error-message" id="method-error">Please select a payment method.</p>
                    </div>
                </div>
                <div class="withdraw-actions">
                    <button class="btn-cancel" id="cancel-withdraw">Cancel</button>
                    <button class="btn-withdraw" id="confirm-withdraw">Withdraw</button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const balanceAvailable = document.getElementById('balance-available');
                const withdrawnToDate = document.getElementById('withdrawn-to-date');
                const paymentsClearing = document.getElementById('payments-clearing');
                const activeOrders = document.getElementById('active-orders');
                const transactionTableBody = document.getElementById('transactionTableBody');
                const withdrawBtn = document.getElementById('withdraw-btn');
                const modalOverlay = document.getElementById('withdraw-modal-overlay');
                const closeModalBtn = document.getElementById('close-withdraw-modal');
                const cancelWithdrawBtn = document.getElementById('cancel-withdraw');
                const confirmWithdrawBtn = document.getElementById('confirm-withdraw');
                const withdrawAmount = document.getElementById('withdraw-amount');
                const paymentMethodSelect = document.getElementById('payment-method');
                const modalAvailableBalance = document.getElementById('modal-available-balance');
                const amountError = document.getElementById('amount-error');
                const methodError = document.getElementById('method-error');
                const successMessage = document.getElementById('withdraw-success-message');
                const startDateInput = document.getElementById('start-date');
                const endDateInput = document.getElementById('end-date');
                
                let currentBalance = 0;
                let paymentMethods = [];
                let currentPage = 1;
                const itemsPerPage = 10; // Number of transactions per page
                
                // Set default date values for date range filters
                const today = new Date();
                const oneMonthAgo = new Date();
                oneMonthAgo.setMonth(today.getMonth() - 1);
                
                startDateInput.valueAsDate = oneMonthAgo;
                endDateInput.valueAsDate = today;

                // API Base URL - use a consistent base for all requests
                const apiBaseUrl = ''; // Empty string for relative URLs
                
                // Fetch balance and transaction data
                async function fetchSellerBalance() {
                    try {
                        const response = await fetch('/api/payments/seller-balance');
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const result = await response.json();
                        console.log('Balance data:', result.balance);

                        // Render financial data
                        currentBalance = parseFloat(result.balance);
                        balanceAvailable.textContent = `LKR ${result.balance}`;
                        modalAvailableBalance.textContent = `LKR ${result.balance}`;
                        
                        // Enable withdraw button if balance is available
                        if (currentBalance > 0) {
                            withdrawBtn.disabled = false;
                            withdrawBtn.style.opacity = "1";
                            withdrawBtn.style.cursor = "pointer";
                        } else {
                            withdrawBtn.disabled = true;
                            withdrawBtn.style.opacity = "0.7";
                            withdrawBtn.style.cursor = "not-allowed";
                        }
                        
                    } catch (error) {
                        console.error('Error fetching dashboard data:', error);
                        balanceAvailable.textContent = 'Error loading data';
                    }
                }

                async function fetchWithdrawnToDate() {
                    try {
                        const response = await fetch('/api/payments/withdrawn-to-date');
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const result = await response.json();
                        withdrawnToDate.textContent = `LKR ${result.withdrawn_amount || '0.00'}`;
                        
                    } catch (error) {
                        console.error('Error fetching withdrawn amount:', error);
                        withdrawnToDate.textContent = 'Error loading data';
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
                        paymentsClearing.textContent = 'Error loading data';
                    }
                }

                async function fetchActiveOrdersAmount() {
                    try {
                        const response = await fetch('/api/payments/active-orders-amount');
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const result = await response.json();
                        activeOrders.textContent = `LKR ${result.active_orders_amount || '0.00'}`;
                        
                    } catch (error) {
                        console.error('Error fetching active orders amount:', error);
                        activeOrders.textContent = 'Error loading data';
                    }
                }
        
                async function fetchPeriodEarnings() {
                    try {
                        const startDate = startDateInput.value;
                        const endDate = endDateInput.value;
                        const periodEarnings = document.getElementById('period-earnings');
                        
                        // Validate dates
                        if (!startDate || !endDate) {
                            showNotification('Please select both start and end dates', 'error');
                            return;
                        }
                        
                        if (new Date(startDate) > new Date(endDate)) {
                            showNotification('Start date cannot be after end date', 'error');
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

                async function fetchTransactionData(page = 1) {
                    try {
                        const response = await fetch(`/api/payments/seller-transactions?page=${page}&limit=${itemsPerPage}`);
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
                        
                        // Update pagination
                        updatePagination(result.total_pages || 3, page);
                        
                    } catch (error) {
                        console.error('Error fetching transaction data:', error);
                        transactionTableBody.innerHTML = '<tr><td colspan="5">Error loading transactions</td></tr>';
                    }
                }
                
                // Function to update pagination UI
                function updatePagination(totalPages, currentPage) {
                    const pagination = document.querySelector('.pagination');
                    const pageButtons = pagination.querySelectorAll('button[data-page]');
                    
                    // Remove the active class from all buttons
                    pageButtons.forEach(btn => {
                        btn.classList.remove('active');
                        
                        // Only show buttons for pages that exist
                        const pageNum = parseInt(btn.dataset.page);
                        if (pageNum <= totalPages) {
                            btn.style.display = 'inline-block';
                            
                            // Set active class on current page
                            if (pageNum === currentPage) {
                                btn.classList.add('active');
                            }
                        } else {
                            btn.style.display = 'none';
                        }
                    });
                    
                    // Disable/enable prev/next buttons
                    document.getElementById('prev-page').disabled = currentPage === 1;
                    document.getElementById('next-page').disabled = currentPage === totalPages;
                }

                async function fetchPaymentMethods() {
                    try {
                        const response = await fetch('/api/payments/get-seller-payoutmethod');
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        const result = await response.json();
                        console.log('Payment methods:', result);

                        // Store all payment methods
                        paymentMethods = result.data || [];
                        
                        // Populate payment method dropdown
                        paymentMethodSelect.innerHTML = '<option value="" disabled selected>Select a payment method</option>';
                        
                        if (paymentMethods.length === 0) {
                            const option = document.createElement('option');
                            option.value = "";
                            option.disabled = true;
                            option.textContent = "No payment methods found";
                            paymentMethodSelect.appendChild(option);
                        } else {
                            paymentMethods.forEach(method => {
                                const option = document.createElement('option');
                                option.value = method.id;
                                
                                // Format display text based on method type
                                if (method.bank_name) {
                                    option.textContent = `Bank: ${method.bank_name} - ${method.account_number.slice(-4).padStart(method.account_number.length, '*')}`;
                                    option.dataset.type = 'bank';
                                } else if (method.email) {
                                    option.textContent = `PayPal: ${method.email}`;
                                    option.dataset.type = 'paypal';
                                } else {
                                    // Handle other payment method types or unknown types
                                    option.textContent = `Payment Method #${method.id}`;
                                    option.dataset.type = method.type || 'unknown';
                                }
                                
                                paymentMethodSelect.appendChild(option);
                            });
                        }
                    } catch (error) {
                        console.error('Error fetching payment methods:', error);
                        paymentMethodSelect.innerHTML = '<option value="" disabled selected>Error loading payment methods</option>';
                    }
                }

                async function processWithdrawal() {
                    try {
                        const amount = parseFloat(withdrawAmount.value);
                        const selectedOption = paymentMethodSelect.options[paymentMethodSelect.selectedIndex];
                        
                        if (!selectedOption || selectedOption.disabled) {
                            methodError.style.display = 'block';
                            return;
                        }
                        
                        const payoutMethodId = selectedOption.value;
                        const methodType = selectedOption.dataset.type;
                        
                        // Validate inputs
                        let isValid = true;
                        
                        if (isNaN(amount) || amount <= 0 || amount > currentBalance) {
                            amountError.style.display = 'block';
                            isValid = false;
                        } else {
                            amountError.style.display = 'none';
                        }
                        
                        if (!payoutMethodId || !methodType) {
                            methodError.style.display = 'block';
                            isValid = false;
                        } else {
                            methodError.style.display = 'none';
                        }
                        
                        if (!isValid) return;
                        
                        // Disable buttons during processing
                        confirmWithdrawBtn.disabled = true;
                        confirmWithdrawBtn.textContent = 'Processing...';
                        
                        // Send withdrawal request
                        const response = await fetch('/api/payments/withdraw-funds', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ 
                                amount: amount,
                                // payout_method_id: payoutMethodId,
                                // payout_method_type: methodType
                            })
                        });
                        
                        if (!response.ok) {
                            throw new Error('Failed to process withdrawal');
                        }
                        
                        const result = await response.json();
                        console.log('Withdrawal result:', result);
                        
                        // Show success message
                        successMessage.style.display = 'block';
                        
                        // Reset form
                        withdrawAmount.value = '';
                        paymentMethodSelect.selectedIndex = 0;
                        
                        // Refresh the balance data
                        setTimeout(() => {
                            fetchSellerBalance();
                            fetchWithdrawnToDate();
                            fetchTransactionData(currentPage);
                            
                            // Close modal after 3 seconds
                            setTimeout(() => {
                                closeModal();
                            }, 3000);
                        }, 1000);
                        
                    } catch (error) {
                        console.error('Error processing withdrawal:', error);
                        showNotification('Failed to process withdrawal. Please try again later.', 'error');
                    } finally {
                        confirmWithdrawBtn.disabled = false;
                        confirmWithdrawBtn.textContent = 'Withdraw';
                    }
                }

                // Modal functions
                function openModal() {
                    modalOverlay.classList.add('active');
                    fetchPaymentMethods();
                    modalAvailableBalance.textContent = balanceAvailable.textContent;
                    
                    // Reset form
                    withdrawAmount.value = '';
                    paymentMethodSelect.selectedIndex = 0;
                    amountError.style.display = 'none';
                    methodError.style.display = 'none';
                    successMessage.style.display = 'none';
                }
                
                function closeModal() {
                    modalOverlay.classList.remove('active');
                }
                
                // Helper function for showing notifications consistently
                function showNotification(message, type = 'info') {
                    // For now, we'll use alert, but this could be replaced with a custom notification system
                    alert(message);
                }
                
                // Event listeners
                withdrawBtn.addEventListener('click', openModal);
                closeModalBtn.addEventListener('click', closeModal);
                cancelWithdrawBtn.addEventListener('click', closeModal);
                confirmWithdrawBtn.addEventListener('click', processWithdrawal);
                
                // Close modal if clicked outside
                modalOverlay.addEventListener('click', function(e) {
                    if (e.target === modalOverlay) {
                        closeModal();
                    }
                });
                
                // Validate withdraw amount as user types
                withdrawAmount.addEventListener('input', function() {
                    const amount = parseFloat(this.value);
                    if (isNaN(amount) || amount <= 0 || amount > currentBalance) {
                        amountError.style.display = 'block';
                    } else {
                        amountError.style.display = 'none';
                    }
                    validateWithdrawalForm();
                });
                
                // Validate payment method selection
                paymentMethodSelect.addEventListener('change', function() {
                    if (!this.value) {
                        methodError.style.display = 'block';
                    } else {
                        methodError.style.display = 'none';
                    }
                    validateWithdrawalForm();
                });
                
                // Function to validate the entire form and enable/disable the withdraw button
                function validateWithdrawalForm() {
                    const amount = parseFloat(withdrawAmount.value);
                    const selectedMethodId = paymentMethodSelect.value;
                    let isValid = true;
                    
                    // Check amount
                    if (isNaN(amount) || amount <= 0 || amount > currentBalance) {
                        isValid = false;
                    }
                    
                    // Check selected payment method
                    if (!selectedMethodId) {
                        isValid = false;
                    }
                    
                    // Enable/disable the withdraw button
                    confirmWithdrawBtn.disabled = !isValid;
                }
                
                // Add pagination event listeners
                document.getElementById('prev-page').addEventListener('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        fetchTransactionData(currentPage);
                    }
                });
                
                document.getElementById('next-page').addEventListener('click', function() {
                    currentPage++;
                    fetchTransactionData(currentPage);
                });
                
                // Add event listeners to page number buttons
                document.querySelectorAll('.pagination button[data-page]').forEach(button => {
                    button.addEventListener('click', function() {
                        currentPage = parseInt(this.dataset.page);
                        fetchTransactionData(currentPage);
                    });
                });

                // Initialize
                fetchSellerBalance();
                fetchWithdrawnToDate();
                fetchHoldBalance();
                fetchActiveOrdersAmount();
                fetchTransactionData(currentPage);
                fetchPeriodEarnings(); // Load initial period earnings with default dates

                // Add event listener to the filter button
                document.getElementById('filter-earnings-btn').addEventListener('click', fetchPeriodEarnings);
            });
        </script>
    </body>
</html>