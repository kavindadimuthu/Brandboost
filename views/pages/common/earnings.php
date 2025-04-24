<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings Dashboard | BrandBoost</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Core color palette */
            --primary-color: #5D5FEF;
            --primary-light: #7678FF;
            --primary-dark: #4547B8;
            --secondary-color: #7c44f1;
            --secondary: #7c44f1;
            
            /* Text colors */
            --dark-text: #111827;
            --medium-text: #374151;
            --light-text: #6B7280;
            --muted-text: #9CA3AF;
            
            /* Layout colors */
            --background: #F9FAFB;
            --card-bg: #FFFFFF;
            --divider: #E5E7EB;
            
            /* Status colors */
            --success: #10B981;
            --success-light: #ECFDF5;
            --warning: #F59E0B;
            --warning-light: #FFFBEB;
            --danger: #EF4444;
            --danger-light: #FEF2F2;
            --info: #3B82F6;
            --info-light: #EFF6FF;
            
            /* Effects */
            --border-radius-sm: 6px;
            --border-radius: 8px;
            --border-radius-lg: 12px;
            --border-radius-xl: 16px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            /* Spacing */
            --space-1: 4px;
            --space-2: 8px;
            --space-3: 12px;
            --space-4: 16px;
            --space-5: 20px;
            --space-6: 24px;
            --space-8: 32px;
            --space-10: 40px;
            --space-12: 48px;
            
            /* Transitions */
            --transition-fast: 150ms ease;
            --transition-normal: 250ms ease;
            --transition-slow: 350ms ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--background);
            color: var(--dark-text);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 40px 0 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            bottom: -50%;
            left: -50%;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
            transform: rotate(-20deg);
        }

        .hero-container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            text-align: left;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--space-6);
        }

        .page-content {
            margin-top: -120px;
            position: relative;
            z-index: 1;
        }

        /* ===== Earnings Summary Cards ===== */
        .earnings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-8);
        }

        .earnings-card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            padding: var(--space-5);
            transition: transform var(--transition-normal), box-shadow var(--transition-normal);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .earnings-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .earnings-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-light));
            opacity: 0;
            transition: opacity var(--transition-normal);
        }

        .earnings-card:hover::before {
            opacity: 1;
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: var(--space-3);
        }

        .card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: var(--border-radius);
            background-color: var(--primary-light);
            color: white;
            margin-right: var(--space-3);
            font-size: 1rem;
        }

        .card-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--medium-text);
        }

        .card-body {
            flex: 1;
            margin-bottom: var(--space-3);
        }

        .card-label {
            font-size: 0.813rem;
            color: var(--light-text);
            margin-bottom: var(--space-1);
        }

        .card-value {
            font-size: 1.625rem;
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: var(--space-2);
            letter-spacing: -0.025em;
        }

        .card-trend {
            display: flex;
            align-items: center;
            font-size: 0.813rem;
            color: var(--muted-text);
        }

        .trend-up {
            color: var(--success);
        }

        .trend-down {
            color: var(--danger);
        }

        .card-footer {
            margin-top: auto;
        }

        /* Card-specific styles */
        #available-funds-card .card-icon {
            background-color: var(--primary-light);
        }

        #pending-payments-card .card-icon {
            background-color: var(--warning);
        }

        #period-earnings-card .card-icon {
            background-color: var(--info);
        }

        /* ===== Date Range Selector ===== */
        .date-range-wrapper {
            display: flex;
            gap: var(--space-3);
            margin-bottom: var(--space-3);
        }

        .date-input-group {
            flex: 1;
        }

        .date-input-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--light-text);
            margin-bottom: var(--space-1);
        }

        .date-input {
            width: 100%;
            padding: var(--space-2);
            border: 1px solid var(--divider);
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 0.813rem;
            color: var(--medium-text);
            transition: border-color var(--transition-fast);
            background-color: white;
        }

        .date-input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 2px rgba(93, 95, 239, 0.2);
        }

        /* ===== Buttons ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: var(--space-2) var(--space-4);
            border-radius: var(--border-radius);
            font-weight: 500;
            font-size: 0.813rem;
            line-height: 1.5;
            cursor: pointer;
            transition: all var(--transition-fast);
            border: none;
            gap: var(--space-2);
            white-space: nowrap;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.4);
        }

        .btn-secondary {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--divider);
        }

        .btn-secondary:hover {
            background-color: var(--background);
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--primary-color);
        }

        .btn-ghost:hover {
            background-color: rgba(93, 95, 239, 0.05);
        }

        .btn-primary:disabled,
        .btn-secondary:disabled,
        .btn-ghost:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            border-radius: 50%;
            font-size: 1rem;
        }

        .btn-fullwidth {
            width: 100%;
        }

        /* ===== Link Styles ===== */
        .link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.813rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            transition: color var(--transition-fast);
        }

        .link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .link i {
            font-size: 0.75rem;
        }

        /* ===== Transactions Section ===== */
        .section-container {
            background-color: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow);
            margin-bottom: var(--space-8);
            overflow: hidden;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-5);
            border-bottom: 1px solid var(--divider);
        }

        .section-title {
            display: flex;
            align-items: center;
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark-text);
            gap: var(--space-2);
        }

        .section-title i {
            color: var(--primary-color);
        }

        .section-actions {
            display: flex;
            gap: var(--space-3);
        }

        .section-content {
            padding: 0;
        }

        /* ===== Transaction Table ===== */
        .transactions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .transactions-table th {
            padding: var(--space-3) var(--space-5);
            text-align: left;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--light-text);
            background-color: var(--background);
            border-bottom: 1px solid var(--divider);
        }

        .transactions-table td {
            padding: var(--space-4) var(--space-5);
            font-size: 0.875rem;
            color: var(--medium-text);
            border-bottom: 1px solid var(--divider);
        }

        .transactions-table tr:last-child td {
            border-bottom: none;
        }

        .transactions-table tr:hover td {
            background-color: rgba(93, 95, 239, 0.03);
        }

        /* Transaction item styles */
        .transaction-date {
            color: var(--medium-text);
            white-space: nowrap;
        }

        .transaction-amount {
            font-weight: 600;
            color: var(--dark-text);
            white-space: nowrap;
        }

        .transaction-positive {
            color: var(--success);
        }

        .transaction-negative {
            color: var(--danger);
        }

        .transaction-id {
            font-family: monospace;
            font-size: 0.8rem;
            color: var(--muted-text);
        }

        /* Status Badge Styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: var(--space-1) var(--space-3);
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            line-height: 1.5;
            white-space: nowrap;
        }

        .status-badge i {
            margin-right: var(--space-1);
            font-size: 0.7rem;
        }

        .status-completed {
            background-color: var(--success-light);
            color: var(--success);
        }

        .status-pending {
            background-color: var(--warning-light);
            color: var(--warning);
        }

        .status-failed {
            background-color: var(--danger-light);
            color: var(--danger);
        }

        .status-processing {
            background-color: var(--info-light);
            color: var(--info);
        }

        /* ===== Pagination ===== */
        .pagination-container {
            display: flex;
            justify-content: center;
            padding: var(--space-4);
            border-top: 1px solid var(--divider);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .pagination-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: var(--border-radius);
            border: 1px solid var(--divider);
            background-color: white;
            color: var(--medium-text);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all var(--transition-fast);
        }

        .pagination-btn:hover:not(:disabled):not(.active) {
            border-color: var(--primary-light);
            color: var(--primary-color);
            background-color: var(--background);
        }

        .pagination-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .pagination-info {
            margin-left: var(--space-4);
            font-size: 0.875rem;
            color: var(--light-text);
        }

        /* ===== Modal Styles ===== */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(17, 24, 39, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity var(--transition-normal), visibility var(--transition-normal);
        }

        .modal-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-dialog {
            width: 90%;
            max-width: 500px;
            background-color: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            transform: translateY(20px);
            opacity: 0;
            transition: transform var(--transition-normal), opacity var(--transition-normal);
        }

        .modal-backdrop.active .modal-dialog {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-5);
            border-bottom: 1px solid var(--divider);
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-text);
        }

        .modal-close {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: none;
            border: none;
            color: var(--light-text);
            cursor: pointer;
            transition: background-color var(--transition-fast);
        }

        .modal-close:hover {
            background-color: var(--divider);
        }

        .modal-body {
            padding: var(--space-5);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: var(--space-3);
            padding: var(--space-4) var(--space-5);
            border-top: 1px solid var(--divider);
        }

        /* ===== Form Elements ===== */
        .form-group {
            margin-bottom: var(--space-4);
        }

        .form-label {
            display: block;
            margin-bottom: var(--space-2);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--medium-text);
        }

        .form-control {
            display: block;
            width: 100%;
            padding: var(--space-3);
            font-size: 0.875rem;
            line-height: 1.5;
            color: var(--dark-text);
            background-color: #fff;
            border: 1px solid var(--divider);
            border-radius: var(--border-radius);
            transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
        }

        .form-control:focus {
            border-color: var(--primary-light);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(93, 95, 239, 0.25);
        }

        .form-control::placeholder {
            color: var(--muted-text);
        }

        .form-control:disabled {
            background-color: var(--background);
            opacity: 0.75;
            cursor: not-allowed;
        }

        .form-text {
            display: block;
            margin-top: var(--space-1);
            font-size: 0.75rem;
            color: var(--light-text);
        }

        .form-error {
            display: none;
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: var(--space-1);
        }

        .form-balance {
            background-color: var(--background);
            padding: var(--space-4);
            border-radius: var(--border-radius);
            margin-bottom: var(--space-4);
        }

        .form-balance-title {
            font-size: 0.875rem;
            color: var(--light-text);
            margin-bottom: var(--space-2);
        }

        .form-balance-amount {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-text);
        }

        /* ===== Alerts and Notifications ===== */
        .alert {
            padding: var(--space-3);
            border-radius: var(--border-radius);
            font-size: 0.875rem;
            margin-bottom: var(--space-4);
            display: flex;
            align-items: flex-start;
            gap: var(--space-3);
        }

        .alert i {
            margin-top: 2px;
        }

        .alert-success {
            background-color: var(--success-light);
            color: var(--success);
        }

        .alert-warning {
            background-color: var(--warning-light);
            color: var(--warning);
        }

        .alert-danger {
            background-color: var(--danger-light);
            color: var(--danger);
        }

        .alert-info {
            background-color: var(--info-light);
            color: var(--info);
        }

        /* ===== Empty States ===== */
        .empty-state {
            padding: var(--space-8) var(--space-6);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .empty-state-icon {
            font-size: 2.5rem;
            color: var(--divider);
            margin-bottom: var(--space-4);
        }

        .empty-state-title {
            font-size: 1rem;
            font-weight: 500;
            color: var(--medium-text);
            margin-bottom: var(--space-2);
        }

        .empty-state-text {
            font-size: 0.875rem;
            color: var(--light-text);
            max-width: 300px;
            margin: 0 auto;
        }

        /* ===== Loading States ===== */
        .loading-spinner {
            display: inline-block;
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 0.875rem;
            color: var(--light-text);
            text-align: center;
            margin-top: var(--space-2);
        }

        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: var(--space-8);
        }

        /* ===== Responsive Utilities ===== */
        @media (max-width: 992px) {
            .earnings-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 30px 0;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .container {
                padding: var(--space-4);
            }
            
            .earnings-grid {
                grid-template-columns: 1fr;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: var(--space-4);
            }
            
            .section-actions {
                width: 100%;
            }
            
            /* Make table scrollable on small screens */
            .transactions-table-container {
                overflow-x: auto;
                margin: 0 -1rem;
            }
            
            .transactions-table {
                min-width: 700px;
            }
            
            .modal-dialog {
                width: 95%;
            }
        }

        @media (max-width: 480px) {
            .hero-container {
                padding: 0 15px;
            }
            
            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1><i class="fas fa-wallet"></i> Earnings</h1>
                <p>Track your earnings, withdrawals, and payment history</p>
            </div>
        </div>
    </div>

    <div class="container page-content">
        <!-- Earnings Summary Cards -->
        <div class="earnings-grid">
            <!-- Available Funds Card -->
            <div class="earnings-card" id="available-funds-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h2 class="card-title">Available Funds</h2>
                </div>
                <div class="card-body">
                    <div class="card-label">Balance available for withdrawal</div>
                    <div class="card-value" id="balance-available">Loading...</div>
                </div>
                <div class="card-footer">
                    <button id="withdraw-btn" class="btn btn-primary btn-fullwidth" disabled>
                        <i class="fas fa-money-bill-transfer"></i> Withdraw Funds
                    </button>
                    <a href="/<?php echo $_SESSION['user']['role']; ?>/payout-methods" class="link" style="margin-top: 8px; display: inline-block;">
                        <i class="fas fa-gear"></i> Manage payout methods
                    </a>
                </div>
            </div>

            <!-- Pending Payments Card -->
            <div class="earnings-card" id="pending-payments-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <h2 class="card-title">Pending Payments</h2>
                </div>
                <div class="card-body">
                    <div class="card-label">Payments being processed</div>
                    <div class="card-value" id="payments-clearing">Loading...</div>
                    <div class="card-trend">
                        <i class="fas fa-info-circle" style="margin-right: 4px;"></i>
                        These funds will be available after clearing period
                    </div>
                </div>
            </div>

            <!-- Period Earnings Card -->
            <div class="earnings-card" id="period-earnings-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h2 class="card-title">Period Earnings</h2>
                </div>
                <div class="card-body">
                    <!-- <div class="card-label">Select date range</div> -->
                    <div class="date-range-wrapper">
                        <div class="date-input-group">
                            <label class="date-input-label" for="start-date">From</label>
                            <input type="date" id="start-date" class="date-input">
                        </div>
                        <div class="date-input-group">
                            <label class="date-input-label" for="end-date">To</label>
                            <input type="date" id="end-date" class="date-input">
                        </div>
                        <div class="date-input-group" style="display: flex; flex-direction: column; justify-content: end;">
                            <button id="filter-earnings-btn" class="btn btn-secondary btn-fullwidth" style="height: 65%; display: flex; align-items: center;">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-label" style="margin-top: 12px;">Total for period</div>
                    <div class="card-value" id="period-earnings">LKR 0.00</div>
                </div>
            </div>
        </div>

        <!-- Transactions Section -->
        <div class="section-container">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-receipt"></i>
                    Transaction History
                </h3>
                <div class="section-actions">
                    <!-- Transaction filter options could go here -->
                </div>
            </div>
            <div class="section-content">
                <div class="transactions-table-container">
                    <table class="transactions-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="transactionTableBody">
                            <tr>
                                <td colspan="4">
                                    <div class="loading-container">
                                        <div class="loading-spinner"></div>
                                        <p class="loading-text">Loading transactions...</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container">
                    <div class="pagination">
                        <button id="prev-page" class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active" data-page="1">1</button>
                        <button class="pagination-btn" data-page="2">2</button>
                        <button class="pagination-btn" data-page="3">3</button>
                        <button id="next-page" class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Withdraw Modal -->
    <div class="modal-backdrop" id="withdraw-modal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h4 class="modal-title">Withdraw Funds</h4>
                <button class="modal-close" id="close-withdraw-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="withdraw-success-message" style="display: none;">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        Your withdrawal request has been submitted successfully. You will be notified once processed.
                    </div>
                </div>
                
                <div class="form-balance">
                    <div class="form-balance-title">Available Balance</div>
                    <div class="form-balance-amount" id="modal-available-balance">LKR 0.00</div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="withdraw-amount">Amount to Withdraw</label>
                    <input type="number" id="withdraw-amount" class="form-control" placeholder="Enter amount" min="0" step="0.01">
                    <div class="form-error" id="amount-error">
                        Please enter a valid amount that doesn't exceed your available balance.
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="payment-method">Select Payment Method</label>
                    <select id="payment-method" class="form-control">
                        <option value="" disabled selected>Select a payment method</option>
                    </select>
                    <div class="form-error" id="method-error">
                        Please select a payment method.
                    </div>
                    <div class="form-text">
                        You can add or edit payment methods in account settings.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancel-withdraw">Cancel</button>
                <button class="btn btn-primary" id="confirm-withdraw" disabled>
                    <i class="fas fa-check"></i> Withdraw
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get DOM elements
            const balanceAvailable = document.getElementById('balance-available');
            const paymentsClearing = document.getElementById('payments-clearing');
            const transactionTableBody = document.getElementById('transactionTableBody');
            const withdrawBtn = document.getElementById('withdraw-btn');
            const modalBackdrop = document.getElementById('withdraw-modal');
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
            const filterEarningsBtn = document.getElementById('filter-earnings-btn');
            const periodEarnings = document.getElementById('period-earnings');
            
            // Variables
            let currentBalance = 0;
            let paymentMethods = [];
            let currentPage = 1;
            const itemsPerPage = 10;
            
            // Set default date values for date range filters
            const today = new Date();
            const oneMonthAgo = new Date();
            oneMonthAgo.setMonth(today.getMonth() - 1);
            
            startDateInput.valueAsDate = oneMonthAgo;
            endDateInput.valueAsDate = today;
            
            // ===== API Functions =====
            
            // Fetch available balance
            async function fetchSellerBalance() {
                try {
                    balanceAvailable.innerHTML = '<div class="loading-spinner" style="width: 20px; height: 20px; border-width: 2px; border-top-color: var(--primary-color);"></div>';
                    
                    const response = await fetch('/api/payments/seller-balance');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();
                    console.log('Balance data:', result.balance);

                    // Render financial data
                    currentBalance = parseFloat(result.balance);
                    balanceAvailable.textContent = `LKR ${formatCurrency(currentBalance)}`;
                    modalAvailableBalance.textContent = `LKR ${formatCurrency(currentBalance)}`;
                    
                    // Enable withdraw button if balance is available
                    if (currentBalance > 0) {
                        withdrawBtn.disabled = false;
                    } else {
                        withdrawBtn.disabled = true;
                    }
                    
                } catch (error) {
                    console.error('Error fetching balance:', error);
                    balanceAvailable.textContent = 'Error loading data';
                    balanceAvailable.style.color = 'var(--danger)';
                    
                    // Show retry button
                    setTimeout(() => {
                        balanceAvailable.innerHTML = `
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="color: var(--danger);">Failed to load</span>
                                <button class="btn btn-secondary" style="padding: 4px 8px; font-size: 12px;" onclick="fetchSellerBalance()">
                                    Retry
                                </button>
                            </div>
                        `;
                    }, 1000);
                }
            }

            // Fetch pending payments (in clearing)
            async function fetchHoldBalance() {
                try {
                    paymentsClearing.innerHTML = '<div class="loading-spinner" style="width: 20px; height: 20px; border-width: 2px; border-top-color: var(--warning);"></div>';
                    
                    const response = await fetch('/api/payments/seller-holds');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();
                    console.log('Hold balance:', result);

                    // Render hold balance data
                    paymentsClearing.textContent = `LKR ${formatCurrency(result.hold_balance)}`;
                    
                } catch (error) {
                    console.error('Error fetching hold balance:', error);
                    paymentsClearing.textContent = 'Error loading data';
                    paymentsClearing.style.color = 'var(--danger)';
                }
            }
    
            // Fetch earnings for a specific period
            async function fetchPeriodEarnings() {
                try {
                    const startDate = startDateInput.value;
                    const endDate = endDateInput.value;
                    
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
                    periodEarnings.innerHTML = '<div class="loading-spinner" style="width: 20px; height: 20px; border-width: 2px; border-top-color: var(--info);"></div>';
                    filterEarningsBtn.disabled = true;
                    
                    // Make API request with date parameters
                    const response = await fetch(`/api/payments/period-earnings?start=${startDate}&end=${endDate}`);
                    
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    
                    const result = await response.json();
                    console.log('Period earnings data:', result);
                    
                    // Update the display with the earnings amount
                    periodEarnings.textContent = `LKR ${formatCurrency(result.total_earnings || 0)}`;
                    
                } catch (error) {
                    console.error('Error fetching period earnings:', error);
                    periodEarnings.textContent = 'Error loading data';
                    periodEarnings.style.color = 'var(--danger)';
                } finally {
                    filterEarningsBtn.disabled = false;
                }
            }

            // Fetch transaction history
            async function fetchTransactionData(page = 1) {
                try {
                    // Show loading state
                    transactionTableBody.innerHTML = `
                        <tr>
                            <td colspan="4">
                                <div class="loading-container">
                                    <div class="loading-spinner"></div>
                                    <p class="loading-text">Loading transactions...</p>
                                </div>
                            </td>
                        </tr>
                    `;
                    
                    const response = await fetch(`/api/payments/seller-transactions?page=${page}&limit=${itemsPerPage}`);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const result = await response.json();
                    console.log('Transaction data:', result);

                    // Use correct key to access the data
                    const transactions = result.data || [];
                    if (transactions.length === 0) {
                        transactionTableBody.innerHTML = `
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-receipt empty-state-icon"></i>
                                        <h3 class="empty-state-title">No transactions found</h3>
                                        <p class="empty-state-text">When you receive payments or make withdrawals, they will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                        `;
                        return;
                    }

                    transactionTableBody.innerHTML = transactions.map(tx => {
                        // Determine status class and icon
                        let statusClass = '';
                        let statusIcon = '';
                        
                        if (tx.status.toLowerCase() === 'completed') {
                            statusClass = 'status-completed';
                            statusIcon = 'fa-check-circle';
                        } else if (tx.status.toLowerCase() === 'pending') {
                            statusClass = 'status-pending';
                            statusIcon = 'fa-clock';
                        } else if (tx.status.toLowerCase() === 'failed') {
                            statusClass = 'status-failed';
                            statusIcon = 'fa-times-circle';
                        } else if (tx.status.toLowerCase() === 'processing') {
                            statusClass = 'status-processing';
                            statusIcon = 'fa-sync';
                        }
                        
                        // Format date
                        const date = new Date(tx.created_at);
                        const formattedDate = date.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        
                        // Determine amount class (positive for earnings, negative for withdrawals)
                        const amountClass = tx.type === 'withdrawal' ? 'transaction-negative' : 'transaction-positive';
                        const amountPrefix = tx.type === 'withdrawal' ? '-' : '+';
                        
                        return `
                            <tr>
                                <td class="transaction-date">${formattedDate}</td>
                                <td>
                                    <span class="status-badge ${statusClass}">
                                        <i class="fas ${statusIcon}"></i>
                                        ${tx.status}
                                    </span>
                                </td>
                                <td>
                                    ${tx.order_id ? `Order #${tx.order_id}` : 'Withdrawal'} 
                                    <div class="transaction-id">${tx.id}</div>
                                </td>
                                <td class="transaction-amount ${amountClass}">
                                    ${amountPrefix} LKR ${formatCurrency(tx.amount)}
                                </td>
                            </tr>
                        `;
                    }).join('');
                    
                    // Update pagination
                    updatePagination(result.total_pages || 3, page);
                    
                } catch (error) {
                    console.error('Error fetching transaction data:', error);
                    transactionTableBody.innerHTML = `
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-exclamation-circle empty-state-icon" style="color: var(--danger);"></i>
                                    <h3 class="empty-state-title">Failed to load transactions</h3>
                                    <p class="empty-state-text">
                                        There was an error loading your transactions. 
                                        <a href="#" onclick="fetchTransactionData(${currentPage}); return false;">Try again</a>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    `;
                }
            }
            
            // Fetch available payment methods
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

            // Process withdrawal request
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
                    confirmWithdrawBtn.innerHTML = '<div class="loading-spinner" style="width: 16px; height: 16px; border-width: 2px; margin-right: 8px;"></div> Processing...';
                    
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
                    successMessage.style.display = 'flex';
                    
                    // Reset form
                    withdrawAmount.value = '';
                    paymentMethodSelect.selectedIndex = 0;
                    
                    // Refresh the balance data
                    setTimeout(() => {
                        fetchSellerBalance();
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
                    confirmWithdrawBtn.innerHTML = '<i class="fas fa-check"></i> Withdraw';
                }
            }
            
            // ===== Helper Functions =====
            
            // Update pagination display
            function updatePagination(totalPages, currentPage) {
                const paginationBtns = document.querySelectorAll('.pagination-btn[data-page]');
                
                // Remove the active class from all buttons
                paginationBtns.forEach(btn => {
                    btn.classList.remove('active');
                    
                    // Only show buttons for pages that exist
                    const pageNum = parseInt(btn.dataset.page);
                    if (pageNum <= totalPages) {
                        btn.style.display = 'flex';
                        
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
                document.getElementById('next-page').disabled = currentPage >= totalPages;
            }
            
            // Open withdraw modal
            function openModal() {
                modalBackdrop.classList.add('active');
                fetchPaymentMethods();
                modalAvailableBalance.textContent = balanceAvailable.textContent;
                
                // Reset form
                withdrawAmount.value = '';
                paymentMethodSelect.selectedIndex = 0;
                amountError.style.display = 'none';
                methodError.style.display = 'none';
                successMessage.style.display = 'none';
                
                // Focus on amount input after modal animation completes
                setTimeout(() => {
                    withdrawAmount.focus();
                }, 300);
            }
            
            // Close withdraw modal
            function closeModal() {
                modalBackdrop.classList.remove('active');
            }
            
            // Show notification
            function showNotification(message, type = 'info') {
                // For now, we'll use alert, but this could be replaced with a custom notification system
                alert(message);
            }
            
            // Format currency numbers
            function formatCurrency(value) {
                return parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
            
            // Validate withdraw form inputs
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
            
            // ===== Event Listeners =====
            
            // Withdraw button
            withdrawBtn.addEventListener('click', openModal);
            
            // Modal close buttons
            closeModalBtn.addEventListener('click', closeModal);
            cancelWithdrawBtn.addEventListener('click', closeModal);
            
            // Confirm withdrawal button
            confirmWithdrawBtn.addEventListener('click', processWithdrawal);
            
            // Close modal if clicked outside
            modalBackdrop.addEventListener('click', function(e) {
                if (e.target === modalBackdrop) {
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
            
            // Filter earnings button
            filterEarningsBtn.addEventListener('click', fetchPeriodEarnings);
            
            // Pagination - previous page button
            document.getElementById('prev-page').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    fetchTransactionData(currentPage);
                }
            });
            
            // Pagination - next page button
            document.getElementById('next-page').addEventListener('click', function() {
                currentPage++;
                fetchTransactionData(currentPage);
            });
            
            // Pagination - page number buttons
            document.querySelectorAll('.pagination-btn[data-page]').forEach(button => {
                button.addEventListener('click', function() {
                    currentPage = parseInt(this.dataset.page);
                    fetchTransactionData(currentPage);
                });
            });
            
            // ===== Initialize App =====
            fetchSellerBalance();
            fetchHoldBalance();
            fetchTransactionData(currentPage);
            fetchPeriodEarnings(); // Load initial period earnings with default dates
        });
    </script>
</body>
</html>