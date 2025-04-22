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

            <div id="notification" class="notification" style="display: none;"></div>

            <!-- Bank Account Section -->
            <div class="payment-methods-section">
                <h2>Bank Accounts</h2>
                <div id="bank-accounts-container">
                    <!-- Bank accounts will be loaded here dynamically -->
                    <div class="loading-spinner">Loading your bank accounts...</div>
                </div>
            </div>

            <button class="add-button" onclick="openAddPaymentModal()">
                <i class="fas fa-plus"></i>
                Add Bank Account
            </button>
        </div>
    </div>

    <!-- Add/Edit Bank Account Modal -->
    <div id="payment-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Add Bank Account</h2>
                <button class="close-modal" onclick="closeModal()">×</button>
            </div>
            <form id="bank-account-form">
                <input type="hidden" id="bank-account-id">
                
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

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Deletion</h2>
                <button class="close-modal" onclick="closeDeleteModal()">×</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this bank account?</p>
                <input type="hidden" id="delete-bank-id">
                <div class="modal-actions">
                    <button class="cancel-button" onclick="closeDeleteModal()">Cancel</button>
                    <button class="delete-button" onclick="confirmDeleteBankAccount()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let bankAccounts = [];
        let currentAction = 'add'; // 'add' or 'edit'

        // Load bank accounts when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadBankAccounts();
        });

        // Load bank accounts from the server
        function loadBankAccounts() {
            fetch('/api/payments/get-seller-bank')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        bankAccounts = data.data;
                        renderBankAccounts();
                    } else {
                        showNotification('Failed to load bank accounts: ' + (data.message || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error loading bank accounts:', error);
                    showNotification('Failed to load bank accounts. Please try again later.', 'error');
                })
                .finally(() => {
                    // Hide loading spinner
                    document.querySelector('.loading-spinner').style.display = 'none';
                });
        }

        // Render bank accounts in the UI
        function renderBankAccounts() {
            const container = document.getElementById('bank-accounts-container');
            
            // Clear previous content
            container.innerHTML = '';
            
            if (bankAccounts.length === 0) {
                container.innerHTML = '<p class="no-accounts">No bank accounts found. Add one to receive payments.</p>';
                return;
            }
            
            // Create HTML for each bank account
            bankAccounts.forEach(account => {
                const accountCard = document.createElement('div');
                accountCard.className = 'payment-method-card';
                accountCard.innerHTML = `
                    <div class="payment-method-info">
                        <div class="payment-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="payment-details">
                            <h3>${account.bank_name}</h3>
                            <p>****${account.account_number.slice(-4)} • ${account.branch}</p>
                            <p class="account-name">${account.name_on_card}</p>
                        </div>
                    </div>
                    <div class="payment-actions">
                        <button class="action-button" onclick="editBankAccount(${account.id})">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <button class="action-button" onclick="deleteBankAccount(${account.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                container.appendChild(accountCard);
            });
        }

        // Modal functions
        function openAddPaymentModal() {
            currentAction = 'add';
            document.getElementById('modal-title').textContent = 'Add Bank Account';
            document.getElementById('bank-account-form').reset();
            document.getElementById('bank-account-id').value = '';
            document.getElementById('payment-modal').style.display = 'block';
        }

        function editBankAccount(id) {
            currentAction = 'edit';
            document.getElementById('modal-title').textContent = 'Edit Bank Account';
            
            // Find the bank account by ID
            const account = bankAccounts.find(acc => acc.id == id);
            if (!account) return;
            
            // Fill the form with account data
            document.getElementById('bank-account-id').value = account.id;
            document.getElementById('bank-name').value = account.bank_name;
            document.getElementById('branch').value = account.branch;
            document.getElementById('account-number').value = account.account_number;
            document.getElementById('name-on-card').value = account.name_on_card;
            
            document.getElementById('payment-modal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('payment-modal').style.display = 'none';
        }

        function deleteBankAccount(id) {
            document.getElementById('delete-bank-id').value = id;
            document.getElementById('delete-modal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').style.display = 'none';
        }

        function confirmDeleteBankAccount() {
            const bankId = document.getElementById('delete-bank-id').value;
            
            const formData = new FormData();
            formData.append('id', bankId);
            
            fetch('/api/payments/delete-bank', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Bank account deleted successfully', 'success');
                    loadBankAccounts(); // Reload the list
                } else {
                    showNotification('Failed to delete bank account: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error deleting bank account:', error);
                showNotification('Failed to delete bank account. Please try again later.', 'error');
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

        // Form submission
        document.getElementById('bank-account-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('bank_name', document.getElementById('bank-name').value);
            formData.append('branch', document.getElementById('branch').value);
            formData.append('account_number', document.getElementById('account-number').value);
            formData.append('name_on_card', document.getElementById('name-on-card').value);
            
            let url = '/api/payments/add-bank';
            
            // If editing, include the ID and change the URL
            if (currentAction === 'edit') {
                const bankId = document.getElementById('bank-account-id').value;
                formData.append('id', bankId);
                url = '/api/payments/update-bank';
            }
            
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
                    loadBankAccounts(); // Reload the list
                    closeModal();
                } else {
                    showNotification('Failed: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error saving bank account:', error);
                showNotification('Failed to save bank account. Please try again later.', 'error');
            });
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == document.getElementById('payment-modal')) {
                closeModal();
            }
            if (event.target == document.getElementById('delete-modal')) {
                closeDeleteModal();
            }
        }
    </script>
</body>
</html>