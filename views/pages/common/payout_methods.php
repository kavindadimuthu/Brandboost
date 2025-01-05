<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout Methods - BrandBoost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            min-height: 100vh;
        }

        .settings-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        /* Sidebar Styles */
        .settings-sidebar {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: fit-content;
            position: sticky;
            top: 90px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #666;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: #f5f7fb;
            color: #4169E1;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
        }

        /* Content Styles */
        .payout-header {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .payout-header h1 {
            font-size: 24px;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .payout-header p {
            color: #666;
            font-size: 14px;
        }

        .payment-method-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .payment-method-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .payment-icon {
            width: 48px;
            height: 48px;
            background: #f5f7fb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #4169E1;
        }

        .payment-details h3 {
            font-size: 16px;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .payment-details p {
            color: #666;
            font-size: 14px;
        }

        .payment-actions {
            display: flex;
            gap: 12px;
        }

        .action-button {
            background: none;
            border: none;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
            color: #666;
            transition: all 0.2s ease;
        }

        .action-button:hover {
            background: #f5f7fb;
            color: #4169E1;
        }

        .add-button {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            /* font-weight: 500; */
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .add-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(65, 105, 225, 0.2);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 24px;
            width: 90%;
            max-width: 500px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            font-size: 20px;
            color: #1a1a1a;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 20px;
            color: #666;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #4a4a4a;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4169E1;
            box-shadow: 0 0 0 3px rgba(65, 105, 225, 0.1);
        }

        .save-button {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
        }

        .save-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(65, 105, 225, 0.2);
        }

        @media (max-width: 768px) {
            .settings-container {
                grid-template-columns: 1fr;
            }

            .settings-sidebar {
                position: static;
            }
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <!-- Sidebar Navigation -->
        <div class="settings-sidebar">
            <a href="/<?php echo $_SESSION['user']['role']; ?>/edit-profile" class="sidebar-link">
                <i class="fas fa-user"></i>
                Edit Profile
            </a>
            <a href="/<?php echo $_SESSION['user']['role']; ?>/change-password" class="sidebar-link">
                <i class="fas fa-lock"></i>
                Change Password
            </a>
            <a href="/<?php echo $_SESSION['user']['role']; ?>/payout-methods" class="sidebar-link active">
                <i class="fas fa-credit-card"></i>
                Payout Methods
            </a>
        </div>

        <!-- Main Content -->
        <div class="settings-content">
            <div class="payout-header">
                <h1>Payout Methods</h1>
                <p>Manage your payout methods and preferences</p>
            </div>

            <!-- Existing Payment Methods -->
            <div class="payment-method-card">
                <div class="payment-method-info">
                    <div class="payment-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="payment-details">
                        <h3>Bank Account</h3>
                        <p>****6789 • Bank of America</p>
                    </div>
                </div>
                <div class="payment-actions">
                    <button class="action-button" onclick="editPaymentMethod('bank')">
                        <i class="fas fa-pencil"></i>
                    </button>
                    <button class="action-button" onclick="deletePaymentMethod('bank')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <div class="payment-method-card">
                <div class="payment-method-info">
                    <div class="payment-icon">
                        <i class="fab fa-paypal"></i>
                    </div>
                    <div class="payment-details">
                        <h3>PayPal</h3>
                        <p>ravi.fernando@example.com</p>
                    </div>
                </div>
                <div class="payment-actions">
                    <button class="action-button" onclick="editPaymentMethod('paypal')">
                        <i class="fas fa-pencil"></i>
                    </button>
                    <button class="action-button" onclick="deletePaymentMethod('paypal')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <button class="add-button" onclick="openAddPaymentModal()">
                <i class="fas fa-plus"></i>
                Add Payout Method
            </button>
        </div>
    </div>

    <!-- Add/Edit Payment Method Modal -->
    <div id="payment-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Add Payout Method</h2>
                <button class="close-modal" onclick="closeModal()">×</button>
            </div>
            <form id="payment-form">
                <div class="form-group">
                    <label for="payment-type">Payment Method Type</label>
                    <select id="payment-type" required>
                        <option value="">Select payment method</option>
                        <option value="bank">Bank Account</option>
                        <option value="paypal">PayPal</option>
                        <option value="wise">Wise</option>
                    </select>
                </div>

                <!-- Bank Account Fields -->
                <div id="bank-fields" style="display: none;">
                    <div class="form-group">
                        <label for="bank-name">Bank Name</label>
                        <input type="text" id="bank-name" placeholder="Enter bank name">
                    </div>
                    <div class="form-group">
                        <label for="account-number">Account Number</label>
                        <input type="text" id="account-number" placeholder="Enter account number">
                    </div>
                    <div class="form-group">
                        <label for="routing-number">Routing Number</label>
                        <input type="text" id="routing-number" placeholder="Enter routing number">
                    </div>
                </div>

                <!-- PayPal Fields -->
                <div id="paypal-fields" style="display: none;">
                    <div class="form-group">
                        <label for="paypal-email">PayPal Email</label>
                        <input type="email" id="paypal-email" placeholder="Enter PayPal email">
                    </div>
                </div>

                <!-- Wise Fields -->
                <div id="wise-fields" style="display: none;">
                    <div class="form-group">
                        <label for="wise-email">Wise Email</label>
                        <input type="email" id="wise-email" placeholder="Enter Wise email">
                    </div>
                </div>

                <button type="submit" class="save-button">Save Payment Method</button>
            </form>
        </div>
    </div>

    <script>
        // Show/hide payment method fields based on selection
        document.getElementById('payment-type').addEventListener('change', function() {
            document.getElementById('bank-fields').style.display = 'none';
            document.getElementById('paypal-fields').style.display = 'none';
            document.getElementById('wise-fields').style.display = 'none';

            const selectedType = this.value;
            if (selectedType) {
                document.getElementById(`${selectedType}-fields`).style.display = 'block';
            }
        });

        // Modal functions
        function openAddPaymentModal() {
            document.getElementById('modal-title').textContent = 'Add Payout Method';
            document.getElementById('payment-modal').style.display = 'block';
        }

        function editPaymentMethod(type) {
            document.getElementById('modal-title').textContent = 'Edit Payout Method';
            document.getElementById('payment-modal').style.display = 'block';
            document.getElementById('payment-type').value = type;
            document.getElementById('payment-type').dispatchEvent(new Event('change'));
        }

        function closeModal() {
            document.getElementById('payment-modal').style.display = 'none';
            document.getElementById('payment-form').reset();
        }

        function deletePaymentMethod(type) {
            if (confirm('Are you sure you want to delete this payment method?')) {
                console.log(`Deleting payment method: ${type}`);
                // Add deletion logic here
            }
        }

        // Form submission
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add form submission logic here
            console.log('Saving payment method...');
            closeModal();
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('payment-modal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>