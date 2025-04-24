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
        .settings-content{
            min-height: 50vh;
        }

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

        .add-buttons {
            display: flex;
            gap: 16px;
            margin-top: 20px;
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

            <div id="notification" class="notification" style="display: none;"></div>

            <!-- Bank Account Section -->
            <div class="payment-methods-section">
                <!-- <h2>Your Payout Methods</h2> -->
                <div id="payout-methods-container">
                    <!-- Payout methods will be loaded here dynamically -->
                    <div class="loading-spinner">Loading your payout methods...</div>
                </div>
            </div>

            <div class="add-buttons">
                <button class="add-button" onclick="openAddBankModal()">
                    <i class="fas fa-university"></i>
                    Add Bank Account
                </button>
                <button class="add-button" onclick="openAddPayPalModal()">
                    <i class="fab fa-paypal"></i>
                    Add PayPal
                </button>
            </div>
        </div>
    </div>

    <!-- Add/Edit Bank Account Modal -->
    <div id="bank-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="bank-modal-title">Add Bank Account</h2>
                <button class="close-modal" onclick="closeBankModal()">×</button>
            </div>
            <form id="bank-account-form">
                <input type="hidden" id="bank-account-id">
                <input type="hidden" name="payment_type" value="bank">
                
                <div class="form-group">
                    <label for="bank-name">Bank Name</label>
                    <input type="text" id="bank-name" name="bank_name" placeholder="Enter bank name" required>
                </div>
                
                <div class="form-group">
                    <label for="branch">Branch</label>
                    <input type="text" id="branch" name="branch" placeholder="Enter branch name" required>
                </div>
                
                <div class="form-group">
                    <label for="account-number">Account Number</label>
                    <input type="text" id="account-number" name="account_number" placeholder="Enter account number" required>
                </div>
                
                <div class="form-group">
                    <label for="name-on-card">Name on Account</label>
                    <input type="text" id="name-on-card" name="name_on_card" placeholder="Enter name on account" required>
                </div>

                <button type="submit" class="save-button">Save Bank Account</button>
            </form>
        </div>
    </div>

    <!-- Add/Edit PayPal Modal -->
    <div id="paypal-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="paypal-modal-title">Add PayPal Account</h2>
                <button class="close-modal" onclick="closePayPalModal()">×</button>
            </div>
            <form id="paypal-form">
                <input type="hidden" id="paypal-id">
                <input type="hidden" name="payment_type" value="paypal">
                
                <div class="form-group">
                    <label for="paypal-name">Full Name</label>
                    <input type="text" id="paypal-name" name="paypal_name" placeholder="Enter your full name" required>
                </div>
                
                <div class="form-group">
                    <label for="paypal-email">PayPal Email</label>
                    <input type="email" id="paypal-email" name="paypal_email" placeholder="Enter PayPal email">
                </div>
                
                <div class="form-group">
                    <label for="paypal-mobile">PayPal Mobile Number</label>
                    <input type="text" id="paypal-mobile" name="paypal_mobile_number" placeholder="Enter PayPal mobile number">
                </div>
                
                <p class="form-note">* Either email or mobile number is required</p>

                <button type="submit" class="save-button">Save PayPal Account</button>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Deletion</h2>
                <button class="close-modal" onclick="closeDeleteModal()">×</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this payout method?</p>
                <input type="hidden" id="delete-method-id">
                <div class="modal-actions">
                    <button class="cancel-button" onclick="closeDeleteModal()">Cancel</button>
                    <button class="delete-button" onclick="confirmDeletePayoutMethod()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let payoutMethods = [];
        let currentAction = 'add'; // 'add' or 'edit'

        // Load payout methods when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadPayoutMethods();
        });

        // Load payout methods from the server
        function loadPayoutMethods() {
            fetch('/api/payments/get-seller-payoutmethod')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        payoutMethods = data.data;
                        renderPayoutMethods();
                    } else {
                        showNotification('Failed to load payout methods: ' + (data.message || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error loading payout methods:', error);
                    showNotification('Failed to load payout methods. Please try again later.', 'error');
                })
                .finally(() => {
                    // Hide loading spinner
                    document.querySelector('.loading-spinner').style.display = 'none';
                });
        }

        // Render payout methods in the UI
        function renderPayoutMethods() {
            const container = document.getElementById('payout-methods-container');
            
            // Clear previous content
            container.innerHTML = '';
            
            if (payoutMethods.length === 0) {
                container.innerHTML = '<p class="no-accounts">No payout methods found. Add one to receive payments.</p>';
                return;
            }
            
            // Create HTML for each payout method
            payoutMethods.forEach(method => {
                const methodCard = document.createElement('div');
                methodCard.className = 'payment-method-card';
                
                // Check if this is a bank account or PayPal
                if (method.bank_name) {
                    // This is a bank account
                    methodCard.innerHTML = `
                        <div class="payment-method-info">
                            <div class="payment-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="payment-details">
                                <div class="payment-method-type">Bank Account</div>
                                <h3>${method.bank_name}</h3>
                                <p>****${method.account_number.slice(-4)} • ${method.branch}</p>
                                <p class="account-name">${method.name_on_card}</p>
                            </div>
                        </div>
                        <div class="payment-actions">
                            <button class="action-button" onclick="editBankAccount(${method.id})">
                                <i class="fas fa-pencil"></i>
                            </button>
                            <button class="action-button" onclick="deletePayoutMethod(${method.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                } else if (method.paypal_name) {
                    // This is a PayPal account
                    let contactInfo = '';
                    if (method.paypal_email) {
                        contactInfo = method.paypal_email;
                    } else if (method.paypal_mobile_number) {
                        contactInfo = method.paypal_mobile_number;
                    }
                    
                    methodCard.innerHTML = `
                        <div class="payment-method-info">
                            <div class="payment-icon">
                                <i class="fab fa-paypal"></i>
                            </div>
                            <div class="payment-details">
                                <div class="payment-method-type">PayPal</div>
                                <h3>${method.paypal_name}</h3>
                                <p>${contactInfo}</p>
                            </div>
                        </div>
                        <div class="payment-actions">
                            <button class="action-button" onclick="editPayPalAccount(${method.id})">
                                <i class="fas fa-pencil"></i>
                            </button>
                            <button class="action-button" onclick="deletePayoutMethod(${method.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
                
                container.appendChild(methodCard);
            });
        }

        // Modal functions
        function openAddBankModal() {
            currentAction = 'add';
            document.getElementById('bank-modal-title').textContent = 'Add Bank Account';
            document.getElementById('bank-account-form').reset();
            document.getElementById('bank-account-id').value = '';
            document.getElementById('bank-modal').style.display = 'block';
        }

        function openAddPayPalModal() {
            currentAction = 'add';
            document.getElementById('paypal-modal-title').textContent = 'Add PayPal Account';
            document.getElementById('paypal-form').reset();
            document.getElementById('paypal-id').value = '';
            document.getElementById('paypal-modal').style.display = 'block';
        }

        function editBankAccount(id) {
            currentAction = 'edit';
            document.getElementById('bank-modal-title').textContent = 'Edit Bank Account';
            
            // Find the payout method by ID
            const method = payoutMethods.find(m => m.id == id);
            if (!method || !method.bank_name) return;
            
            // Fill the form with account data
            document.getElementById('bank-account-id').value = method.id;
            document.getElementById('bank-name').value = method.bank_name;
            document.getElementById('branch').value = method.branch;
            document.getElementById('account-number').value = method.account_number;
            document.getElementById('name-on-card').value = method.name_on_card;
            
            document.getElementById('bank-modal').style.display = 'block';
        }

        function editPayPalAccount(id) {
            currentAction = 'edit';
            document.getElementById('paypal-modal-title').textContent = 'Edit PayPal Account';
            
            // Find the payout method by ID
            const method = payoutMethods.find(m => m.id == id);
            if (!method || !method.paypal_name) return;
            
            // Fill the form with account data
            document.getElementById('paypal-id').value = method.id;
            document.getElementById('paypal-name').value = method.paypal_name;
            
            if (method.paypal_email) {
                document.getElementById('paypal-email').value = method.paypal_email;
            }
            
            if (method.paypal_mobile_number) {
                document.getElementById('paypal-mobile').value = method.paypal_mobile_number;
            }
            
            document.getElementById('paypal-modal').style.display = 'block';
        }

        function closeBankModal() {
            document.getElementById('bank-modal').style.display = 'none';
        }

        function closePayPalModal() {
            document.getElementById('paypal-modal').style.display = 'none';
        }

        function deletePayoutMethod(id) {
            document.getElementById('delete-method-id').value = id;
            document.getElementById('delete-modal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').style.display = 'none';
        }

        function confirmDeletePayoutMethod() {
            const methodId = document.getElementById('delete-method-id').value;
            
            const formData = new FormData();
            formData.append('id', methodId);
            
            fetch('/api/payments/delete-payoutmethod', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Payout method deleted successfully', 'success');
                    loadPayoutMethods(); // Reload the list
                } else {
                    showNotification('Failed to delete payout method: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error deleting payout method:', error);
                showNotification('Failed to delete payout method. Please try again later.', 'error');
            })
            .finally(() => {
                closeDeleteModal();
            });
        }

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type}`;
            notification.style.display = 'block';
            
            // Hide notification after 5 seconds
            setTimeout(() => {
                notification.style.display = 'none';
            }, 5000);
        }

        // Bank account form submission
        document.getElementById('bank-account-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            // If editing, include the ID
            if (currentAction === 'edit') {
                const methodId = document.getElementById('bank-account-id').value;
                formData.append('id', methodId);
            }
            
            const url = currentAction === 'add' 
                ? '/api/payments/add-payoutmethod' 
                : '/api/payments/update-payoutmethod';
            
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(
                        currentAction === 'add' 
                            ? 'Bank account added successfully' 
                            : 'Bank account updated successfully',
                        'success'
                    );
                    loadPayoutMethods(); // Reload the list
                    closeBankModal();
                } else {
                    showNotification('Failed: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error saving bank account:', error);
                showNotification('Failed to save bank account. Please try again later.', 'error');
            });
        });

        // PayPal form submission
        document.getElementById('paypal-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate that at least email or mobile is provided
            const email = document.getElementById('paypal-email').value.trim();
            const mobile = document.getElementById('paypal-mobile').value.trim();
            
            if (!email && !mobile) {
                showNotification('Either PayPal email or mobile number is required', 'error');
                return;
            }
            
            const formData = new FormData(this);
            
            // If editing, include the ID
            if (currentAction === 'edit') {
                const methodId = document.getElementById('paypal-id').value;
                formData.append('id', methodId);
            }
            
            const url = currentAction === 'add' 
                ? '/api/payments/add-payoutmethod' 
                : '/api/payments/update-payoutmethod';
            
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(
                        currentAction === 'add' 
                            ? 'PayPal account added successfully' 
                            : 'PayPal account updated successfully',
                        'success'
                    );
                    loadPayoutMethods(); // Reload the list
                    closePayPalModal();
                } else {
                    showNotification('Failed: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error saving PayPal account:', error);
                showNotification('Failed to save PayPal account. Please try again later.', 'error');
            });
        });

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('bank-modal')) {
                closeBankModal();
            }
            if (event.target == document.getElementById('paypal-modal')) {
                closePayPalModal();
            }
            if (event.target == document.getElementById('delete-modal')) {
                closeDeleteModal();
            }
        }
    </script>
</body>
</html>