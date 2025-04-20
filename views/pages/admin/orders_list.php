<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --pending-color: #f97316;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
            --radius: 8px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            color: var(--gray-800);
            line-height: 1.5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            /* padding: 1.5rem; */
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .header .breadcrumb {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header .user-info img {
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .header .user-info span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .page-title {
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        .page-description {
            color: var(--gray-600);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .card-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-body {
            padding: 1rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            flex: 1;
            max-width: 300px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            font-size: 0.875rem;
            transition: border-color 0.2s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .search-box .icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .filters-controls {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .status-filters {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .status-filter-btn {
            font-size: 0.8125rem;
            padding: 0.35rem 0.75rem;
            border-radius: 1rem;
            border: 1px solid var(--gray-300);
            background: white;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .status-filter-btn:hover {
            border-color: var(--primary-light);
            color: var(--primary-color);
        }

        .status-filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .date-range-filter {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 8px 0;
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 2px;
        }

        .date-input {
            padding: 6px 10px;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            font-size: 0.875rem;
            width: 100%;
        }

        .date-input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
        }

        .filter-presets {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 10px;
        }

        .preset-btn {
            background-color: var(--gray-100);
            border: 1px solid var(--gray-300);
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .preset-btn:hover {
            background-color: var(--gray-200);
            border-color: var(--gray-400);
        }

        .active-date-filter {
            color: var(--primary-color);
            font-weight: 600;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.2s ease;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-dark);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: white;
            color: var(--gray-600);
            border: 1px solid var(--gray-300);
        }

        .btn-outline:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            display: none;
        }

        .dropdown-menu-wide {
            min-width: 15rem;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-header {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid var(--gray-200);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            color: var(--gray-800);
            font-size: 0.875rem;
            background-color: transparent;
            border: 0;
            cursor: pointer;
            width: 100%;
            text-align: left;
            gap: 0.5rem;
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--gray-100);
        }

        .dropdown-item i {
            width: 1rem;
            text-align: center;
        }

        .filter-actions {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 1rem;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .data-table th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background-color: var(--gray-100);
            border-bottom: 1px solid var(--gray-200);
            position: relative;
            cursor: pointer;
        }

        .data-table th:first-child {
            border-top-left-radius: var(--radius);
        }

        .data-table th:last-child {
            border-top-right-radius: var(--radius);
        }

        .data-table th .sort-icon {
            margin-left: 0.25rem;
            opacity: 0.5;
        }

        .data-table th.sorted .sort-icon {
            opacity: 1;
        }

        .data-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--gray-200);
            font-size: 0.875rem;
            color: var(--gray-800);
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr {
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .data-table tr:hover td {
            background-color: rgba(99, 102, 241, 0.05);
        }

        .data-table .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .data-table .user-info img {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .data-table .user-info .user-details {
            display: flex;
            flex-direction: column;
        }

        .data-table .user-info .user-name {
            font-weight: 600;
            color: var(--gray-800);
        }

        .data-table .user-info .user-email {
            font-size: 0.75rem;
            color: var(--gray-600);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
            line-height: 1;
        }

        .badge-pending {
            background-color: var(--warning-color);
            color: white;
        }

        .badge-in_progress {
            background-color: var(--info-color);
            color: white;
        }

        .badge-completed {
            background-color: var(--success-color);
            color: white;
        }

        .badge-canceled {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-disputed {
            background-color: var(--danger-color);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .action-buttons .view-btn {
            background-color: var(--info-color);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            font-size: 0.875rem;
        }

        .pagination-info {
            color: var(--gray-600);
        }

        .pagination-options {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .items-per-page {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-600);
        }

        .items-per-page select {
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
            border: 1px solid var(--gray-300);
            background: white;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s ease;
            outline: none;
        }

        .pagination-controls {
            display: flex;
            gap: 0.25rem;
        }

        .pagination-btn {
            padding: 0.3rem 0.5rem;
            border: 1px solid var(--gray-300);
            background: white;
            border-radius: 0.25rem;
            color: var(--gray-600);
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pagination-btn:hover:not(:disabled) {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .pagination-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .price {
            font-weight: bold;
            color: var(--gray-800);
        }

        .card-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .info-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: var(--radius);
            padding: 1.25rem;
            flex: 1;
            min-width: 220px;
            box-shadow: var(--shadow);
        }

        .info-card h3 {
            margin-top: 0;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .info-card .value {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .info-card .trend {
            display: flex;
            align-items: center;
            font-size: 0.75rem;
            font-weight: 900;
            opacity: 0.9;
        }

        .info-card .trend i {
            margin-right: 0.25rem;
        }

        .info-card .trend.up {
            color: #4ade80;
        }

        .info-card .trend.down {
            color: #f87171;
        }

        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

        .loading-overlay.show {
            visibility: visible;
            opacity: 1;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(99, 102, 241, 0.2);
            border-radius: 50%;
            border-top-color: var(--primary-color);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .empty-state {
            padding: 2rem;
            text-align: center;
            color: var(--gray-600);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .empty-state p {
            margin-bottom: 1.5rem;
        }

        /* Card view for mobile */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-box {
                max-width: 100%;
                width: 100%;
            }

            .filters-controls {
                width: 100%;
                justify-content: space-between;
            }

            .data-table th, .data-table td {
                padding: 0.75rem 0.5rem;
            }

            .truncate {
                max-width: 120px;
            }

            .action-buttons button span {
                display: none;
            }

            .card-info {
                flex-direction: column;
            }
            
            .info-card {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <i class="fas fa-home"></i> Admin portal &gt; Order management
                </div>
                <div class="user-info">
                    <img alt="User profile picture" src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg" />
                    <span><?php echo $_SESSION['user']['username'] ?? 'Admin'; ?></span>
                </div>
            </div>

            <h1 class="page-title">Order Management</h1>
            <p class="page-description">View and manage all orders placed on your platform. Track delivery status, process payments, and handle customer requests.</p>

            <div class="card-info">
                <div class="info-card">
                    <h3>Total Orders</h3>
                    <div class="value" id="totalOrders">-</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </div>
                </div>
                <div class="info-card">
                    <h3>Pending Orders</h3>
                    <div class="value" id="pendingOrders">-</div>
                    <div class="trend down">
                        <i class="fas fa-arrow-down"></i> 5% from last month
                    </div>
                </div>
                <div class="info-card">
                    <h3>Completed Orders</h3>
                    <div class="value" id="completedOrders">-</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 8% from last month
                    </div>
                </div>
                <div class="info-card">
                    <h3>Total Revenue</h3>
                    <div class="value" id="totalRevenue">-</div>
                    <div class="trend up">
                        <i class="fas fa-arrow-up"></i> 15% from last month
                    </div>
                </div>
            </div>

            <div class="status-filters">
                <button class="status-filter-btn active" data-status="all">All Orders</button>
                <button class="status-filter-btn" data-status="pending">Pending</button>
                <button class="status-filter-btn" data-status="in_progress">In Progress</button>
                <button class="status-filter-btn" data-status="completed">Completed</button>
                <button class="status-filter-btn" data-status="canceled">Canceled</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="search-box">
                        <i class="fas fa-search icon"></i>
                        <input type="text" id="searchInput" placeholder="Search by order ID, customer name...">
                    </div>
                    <div class="filters-controls">
                        <div class="dropdown">
                            <button class="btn btn-outline dropdown-toggle" id="filterDropdownBtn">
                                <i class="fas fa-calendar-alt"></i> Date Range
                            </button>
                            <div class="dropdown-menu dropdown-menu-wide" id="filterDropdown">
                                <div class="dropdown-header">Select Date Range</div>
                                <div class="date-range-filter">
                                    <label class="filter-label">From Date:</label>
                                    <input type="date" id="dateFrom" class="date-input" max="<?php echo date('Y-m-d'); ?>">

                                    <label class="filter-label">To Date:</label>
                                    <input type="date" id="dateTo" class="date-input" max="<?php echo date('Y-m-d'); ?>">
                                </div>

                                <div class="filter-presets">
                                    <button class="preset-btn" data-days="7">Last 7 days</button>
                                    <button class="preset-btn" data-days="30">Last 30 days</button>
                                    <button class="preset-btn" data-days="90">Last 90 days</button>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="filter-actions">
                                    <button class="btn btn-sm btn-primary" id="applyDateFilterBtn">Apply</button>
                                    <button class="btn btn-sm btn-outline" id="resetDateFilterBtn">Reset</button>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline dropdown-toggle" id="sortDropdownBtn">
                                <i class="fas fa-sort"></i> Sort: <span id="currentSort">Date</span>
                            </button>
                            <div class="dropdown-menu" id="sortDropdown">
                                <button class="dropdown-item" data-sort="created_at" data-label="Date">
                                    <i class="fas fa-calendar-alt"></i> Date
                                </button>
                                <button class="dropdown-item" data-sort="order_id" data-label="Order ID">
                                    <i class="fas fa-hashtag"></i> Order ID
                                </button>
                                <button class="dropdown-item" data-sort="price" data-label="Price">
                                    <i class="fas fa-dollar-sign"></i> Price
                                </button>
                                <button class="dropdown-item" data-sort="delivery_days" data-label="Delivery Time">
                                    <i class="fas fa-clock"></i> Delivery Time
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline dropdown-toggle" id="orderDropdownBtn">
                                <i class="fas fa-arrow-down"></i> Order: <span id="currentOrder">Newest</span>
                            </button>
                            <div class="dropdown-menu" id="orderDropdown">
                                <button class="dropdown-item" data-order="desc" data-label="Newest">
                                    <i class="fas fa-arrow-down"></i> Newest
                                </button>
                                <button class="dropdown-item" data-order="asc" data-label="Oldest">
                                    <i class="fas fa-arrow-up"></i> Oldest
                                </button>
                            </div>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-primary" id="clearAllFiltersBtn">
                                <i class="fas fa-times"></i> Clear Filters
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="data-table" id="ordersTable">
                        <thead>
                            <tr>
                                <th data-sort="order_id">Order # <i class="fas fa-sort sort-icon"></i></th>
                                <th data-sort="customer_name">Customer <i class="fas fa-sort sort-icon"></i></th>
                                <th data-sort="seller_name">Seller <i class="fas fa-sort sort-icon"></i></th>
                                <th data-sort="service">Service <i class="fas fa-sort sort-icon"></i></th>
                                <th data-sort="price">Price <i class="fas fa-sort sort-icon"></i></th>
                                <th data-sort="order_status">Status <i class="fas fa-sort sort-icon"></i></th>
                                <th data-sort="delivery_days">Delivery <i class="fas fa-sort sort-icon"></i></th>
                                <th data-sort="created_at">Date <i class="fas fa-sort sort-icon"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body will be populated by JavaScript -->
                        </tbody>
                    </table>
                    <div id="emptyState" class="empty-state" style="display: none;">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>No orders found</h3>
                        <p>No orders match your current filters or search criteria.</p>
                        <button class="btn btn-primary" id="clearFiltersBtn">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="pagination">
                <div class="pagination-info">
                    Showing <span id="itemsShowing">0</span> of <span id="totalItems">0</span> orders
                </div>
                <div class="pagination-options">
                    <div class="items-per-page">
                        <label for="itemsPerPage">Items per page:</label>
                        <select id="itemsPerPage">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="pagination-controls" id="paginationControls">
                        <!-- Pagination controls will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // App state
            const state = {
                currentPage: 1,
                itemsPerPage: 10,
                totalItems: 0,
                totalPages: 0,
                orders: [],
                filters: {
                    status: 'all',
                    search: '',
                    dateFrom: null,
                    dateTo: null
                },
                sort: {
                    field: 'created_at',
                    order: 'desc'
                },
                stats: {
                    total: 0,
                    pending: 0,
                    completed: 0,
                    revenue: 0
                }
            };

            // DOM Elements
            const ordersTable = document.getElementById('ordersTable');
            const tableBody = ordersTable.querySelector('tbody');
            const emptyState = document.getElementById('emptyState');
            const paginationControls = document.getElementById('paginationControls');
            const itemsShowing = document.getElementById('itemsShowing');
            const totalItems = document.getElementById('totalItems');
            const searchInput = document.getElementById('searchInput');
            const statusFilterButtons = document.querySelectorAll('.status-filter-btn');
            const clearFiltersBtn = document.getElementById('clearFiltersBtn');
            const clearAllFiltersBtn = document.getElementById('clearAllFiltersBtn');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const itemsPerPageSelect = document.getElementById('itemsPerPage');
            
            // Sorting and filtering elements
            const sortDropdownBtn = document.getElementById('sortDropdownBtn');
            const sortDropdown = document.getElementById('sortDropdown');
            const orderDropdownBtn = document.getElementById('orderDropdownBtn');
            const orderDropdown = document.getElementById('orderDropdown');
            const filterDropdownBtn = document.getElementById('filterDropdownBtn');
            const filterDropdown = document.getElementById('filterDropdown');
            
            const dateFromInput = document.getElementById('dateFrom');
            const dateToInput = document.getElementById('dateTo');
            const applyDateFilterBtn = document.getElementById('applyDateFilterBtn');
            const resetDateFilterBtn = document.getElementById('resetDateFilterBtn');
            const presetButtons = document.querySelectorAll('.preset-btn');
            
            // Statistics elements
            const totalOrdersEl = document.getElementById('totalOrders');
            const pendingOrdersEl = document.getElementById('pendingOrders');
            const completedOrdersEl = document.getElementById('completedOrders');
            const totalRevenueEl = document.getElementById('totalRevenue');
            
            const currentSort = document.getElementById('currentSort');
            const currentOrder = document.getElementById('currentOrder');

            // Helper Functions
            function showLoading() {
                loadingOverlay.classList.add('show');
            }

            function hideLoading() {
                loadingOverlay.classList.remove('show');
            }

            function toggleDropdown(dropdown) {
                // Close all other dropdowns first
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    if (menu !== dropdown) {
                        menu.classList.remove('show');
                    }
                });

                // Toggle the current dropdown
                dropdown.classList.toggle('show');
            }

            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return dateString;
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }

            function formatPrice(price) {
                return '$' + parseFloat(price).toFixed(2);
            }

            function formatDelivery(days) {
                return days === 1 ? '1 day' : days + ' days';
            }

            function extractServiceTitle(jsonData) {
                try {
                    const data = JSON.parse(jsonData);
                    return data.title || 'Unknown Service';
                } catch (e) {
                    return 'Unknown Service';
                }
            }

            function capitalizeFirstLetter(string) {
                if (!string) return '';
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            function updateFilterIndicator() {
                if (state.filters.dateFrom || state.filters.dateTo) {
                    filterDropdownBtn.classList.add('active-date-filter');
                    
                    // Update the button text to show active date filter
                    let filterText = 'Date Range';
                    if (state.filters.dateFrom && state.filters.dateTo) {
                        const fromDate = new Date(state.filters.dateFrom);
                        const toDate = new Date(state.filters.dateTo);
                        filterText = `${fromDate.toLocaleDateString()} - ${toDate.toLocaleDateString()}`;
                    } else if (state.filters.dateFrom) {
                        const fromDate = new Date(state.filters.dateFrom);
                        filterText = `From: ${fromDate.toLocaleDateString()}`;
                    } else if (state.filters.dateTo) {
                        const toDate = new Date(state.filters.dateTo);
                        filterText = `To: ${toDate.toLocaleDateString()}`;
                    }
                    
                    filterDropdownBtn.innerHTML = `<i class="fas fa-calendar-alt"></i> ${filterText}`;
                } else {
                    filterDropdownBtn.classList.remove('active-date-filter');
                    filterDropdownBtn.innerHTML = `<i class="fas fa-calendar-alt"></i> Date Range`;
                }
            }

            function updateStatsDisplay() {
                totalOrdersEl.textContent = state.stats.total;
                pendingOrdersEl.textContent = state.stats.pending;
                completedOrdersEl.textContent = state.stats.completed;
                totalRevenueEl.textContent = formatPrice(state.stats.revenue);
            }

            function calculateOrderStats(orders) {
                const stats = {
                    total: orders.length,
                    pending: 0,
                    completed: 0,
                    revenue: 0
                };

                orders.forEach(order => {
                    if (order.order_status === 'pending') {
                        stats.pending++;
                    } else if (order.order_status === 'completed') {
                        stats.completed++;
                    }

                    if (order.promise && order.promise.price) {
                        stats.revenue += parseFloat(order.promise.price);
                    }
                });

                return stats;
            }

            async function fetchOrders() {
                showLoading();
                
                try {
                    // Build query parameters
                    const queryParams = new URLSearchParams({
                        limit: state.itemsPerPage,
                        offset: (state.currentPage - 1) * state.itemsPerPage,
                        sort_by: state.sort.field,
                        order_dir: state.sort.order,
                    });

                    if (state.filters.search) {
                        queryParams.append('search', state.filters.search);
                    }

                    if (state.filters.status && state.filters.status !== 'all') {
                        queryParams.append('order_status', state.filters.status);
                    }

                    if (state.filters.dateFrom) {
                        queryParams.append('date_from', state.filters.dateFrom);
                    }

                    if (state.filters.dateTo) {
                        queryParams.append('date_to', state.filters.dateTo);
                    }

                    const response = await fetch(`/api/orders?${queryParams.toString()}`);
                    
                    if (!response.ok) {
                        throw new Error('Failed to fetch orders');
                    }

                    const data = await response.json();
                    console.log('Fetched orders:', data);
                    
                    if (data.success) {
                        state.orders = data.data || [];
                        state.totalItems = data.pagination.total_records;
                        state.totalPages = data.pagination.total_pages;
                        
                        // Calculate stats
                        state.stats = calculateOrderStats(state.orders);
                        updateStatsDisplay();
                        
                        renderOrders();
                        renderPagination();
                        updateCounter();
                        updateFilterIndicator();
                    } else {
                        throw new Error(data.message || 'Failed to fetch orders');
                    }
                } catch (error) {
                    console.error('Error fetching orders:', error);
                    // Use mock data if API fails
                    useMockData();
                } finally {
                    hideLoading();
                }
            }

            function useMockData() {
                // Generate some mock orders if the API call fails
                const statuses = ['pending', 'in_progress', 'completed', 'canceled'];
                const mockOrders = [];
                
                for (let i = 1; i <= 25; i++) {
                    const status = statuses[Math.floor(Math.random() * statuses.length)];
                    const price = (Math.random() * 500 + 50).toFixed(2);
                    const deliveryDays = Math.floor(Math.random() * 14) + 1;
                    
                    mockOrders.push({
                        order_id: i,
                        order_status: status,
                        created_at: new Date(Date.now() - Math.random() * 60 * 86400000).toISOString(),
                        customer: {
                            name: `Customer ${i}`,
                            email: `customer${i}@example.com`,
                            profile_picture: null
                        },
                        seller: {
                            name: `Seller ${i % 10 + 1}`,
                            email: `seller${i % 10 + 1}@example.com`,
                            profile_picture: null
                        },
                        promise: {
                            accepted_service: JSON.stringify({
                                title: `Service #${i % 5 + 1}`,
                                description: 'Mock service description'
                            }),
                            price: price,
                            delivery_days: deliveryDays
                        }
                    });
                }

                // Filter mockOrders based on current filters
                let filteredOrders = [...mockOrders];
                
                if (state.filters.status !== 'all') {
                    filteredOrders = filteredOrders.filter(order => order.order_status === state.filters.status);
                }
                
                if (state.filters.search) {
                    const search = state.filters.search.toLowerCase();
                    filteredOrders = filteredOrders.filter(order => 
                        order.order_id.toString().includes(search) || 
                        order.customer.name.toLowerCase().includes(search) ||
                        order.seller.name.toLowerCase().includes(search)
                    );
                }
                
                if (state.filters.dateFrom || state.filters.dateTo) {
                    const fromDate = state.filters.dateFrom ? new Date(state.filters.dateFrom) : new Date(0);
                    const toDate = state.filters.dateTo ? new Date(state.filters.dateTo) : new Date();
                    
                    filteredOrders = filteredOrders.filter(order => {
                        const orderDate = new Date(order.created_at);
                        return orderDate >= fromDate && orderDate <= toDate;
                    });
                }
                
                // Sort the data
                filteredOrders.sort((a, b) => {
                    let aValue, bValue;
                    
                    if (state.sort.field === 'created_at') {
                        aValue = new Date(a.created_at).getTime();
                        bValue = new Date(b.created_at).getTime();
                    } else if (state.sort.field === 'price') {
                        aValue = parseFloat(a.promise.price);
                        bValue = parseFloat(b.promise.price);
                    } else if (state.sort.field === 'delivery_days') {
                        aValue = a.promise.delivery_days;
                        bValue = b.promise.delivery_days;
                    } else if (state.sort.field === 'order_id') {
                        aValue = a.order_id;
                        bValue = b.order_id;
                    } else if (state.sort.field === 'customer_name') {
                        aValue = a.customer.name;
                        bValue = b.customer.name;
                    } else if (state.sort.field === 'seller_name') {
                        aValue = a.seller.name;
                        bValue = b.seller.name;
                    } else {
                        aValue = a[state.sort.field];
                        bValue = b[state.sort.field];
                    }
                    
                    if (state.sort.order === 'asc') {
                        return aValue > bValue ? 1 : -1;
                    } else {
                        return aValue < bValue ? 1 : -1;
                    }
                });
                
                // Paginate
                const start = (state.currentPage - 1) * state.itemsPerPage;
                const end = start + parseInt(state.itemsPerPage);
                const paginatedOrders = filteredOrders.slice(start, end);
                
                // Update state
                state.orders = paginatedOrders;
                state.totalItems = filteredOrders.length;
                state.totalPages = Math.ceil(filteredOrders.length / state.itemsPerPage);
                state.stats = calculateOrderStats(filteredOrders);
                
                // Render UI
                updateStatsDisplay();
                renderOrders();
                renderPagination();
                updateCounter();
            }

            function renderOrders() {
                tableBody.innerHTML = '';

                if (state.orders.length === 0) {
                    ordersTable.style.display = 'none';
                    emptyState.style.display = 'block';
                    return;
                }

                ordersTable.style.display = 'table';
                emptyState.style.display = 'none';

                state.orders.forEach(order => {
                    const row = document.createElement('tr');
                    
                console.log('Rendering orders:', order);
                    // Extract data safely
                    const orderId = order.order_id;
                    const orderNumber = `#${orderId.toString().padStart(6, '0')}`;
                    const customer = order.customer_name ? order.customer_name : 'Unknown Customer';
                    const customerEmail = order.customer_email ? order.customer_email : '';
                    const seller = order.seller_name ? order.seller_name : 'Unknown Seller';
                    const sellerEmail = order.seller_email ? order.seller_email : '';
                    const serviceTitle = order.accepted_service ? extractServiceTitle(order.accepted_service) : 'Unknown Service';
                    const price = order.price ? parseFloat(order.price).toFixed(2) : '0.00';
                    const status = order.order_status;
                    const deliveryDays = order.delivery_days ? order.delivery_days : 0;
                    const createdDate = formatDate(order.created_at);
                    
                    // Default profile picture if none is set
                    const customerPic = (order.customer_profile_picture && order.customer_profile_picture) || 'cdn_uploads/users/dp/dp-empty.png';
                    const sellerPic = (order.seller_profile_picture && order.seller_profile_picture) || 'cdn_uploads/users/dp/dp-empty.png';

                    row.innerHTML = `
                        <td><strong>${orderNumber}</strong></td>
                        <td>
                            <div class="user-info">
                                <img src="/${customerPic}" alt="${customer}" />
                                <div class="user-details">
                                    <span class="user-name">${customer}</span>
                                    <span class="user-email">${customerEmail}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-info">
                                <img src="/${sellerPic}" alt="${seller}" />
                                <div class="user-details">
                                    <span class="user-name">${seller}</span>
                                    <span class="user-email">${sellerEmail}</span>
                                </div>
                            </div>
                        </td>
                        <td class="truncate">${serviceTitle}</td>
                        <td><span class="price">${formatPrice(price)}</span></td>
                        <td>
                            <span class="badge badge-${status}">
                                ${capitalizeFirstLetter(status.replace('_', ' '))}
                            </span>
                        </td>
                        <td>${formatDelivery(deliveryDays)}</td>
                        <td>${createdDate}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="view-btn" data-id="${orderId}">
                                    <i class="fas fa-eye"></i> <span>View</span>
                                </button>
                            </div>
                        </td>
                    `;

                    tableBody.appendChild(row);
                });

                // Add event listeners for action buttons
                setupActionButtons();
            }

            function setupActionButtons() {
                // View button event handlers
                document.querySelectorAll('.view-btn').forEach(button => {
                    button.addEventListener('click', event => {
                        event.stopPropagation();
                        const orderId = button.dataset.id;
                        window.location.href = `/admin/order-details/${orderId}`;
                    });
                });
            }

            function renderPagination() {
                paginationControls.innerHTML = '';

                if (state.totalPages <= 1) {
                    return;
                }

                // Previous button
                const prevButton = document.createElement('button');
                prevButton.className = 'pagination-btn';
                prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
                prevButton.disabled = state.currentPage === 1;
                prevButton.addEventListener('click', () => {
                    if (state.currentPage > 1) {
                        state.currentPage--;
                        fetchOrders();
                    }
                });
                paginationControls.appendChild(prevButton);

                // Page numbers
                const startPage = Math.max(1, state.currentPage - 2);
                const endPage = Math.min(state.totalPages, startPage + 4);

                for (let i = startPage; i <= endPage; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.className = 'pagination-btn';
                    pageButton.textContent = i;

                    if (i === state.currentPage) {
                        pageButton.classList.add('active');
                    }

                    pageButton.addEventListener('click', () => {
                        state.currentPage = i;
                        fetchOrders();
                    });

                    paginationControls.appendChild(pageButton);
                }

                // Next button
                const nextButton = document.createElement('button');
                nextButton.className = 'pagination-btn';
                nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
                nextButton.disabled = state.currentPage === state.totalPages;
                nextButton.addEventListener('click', () => {
                    if (state.currentPage < state.totalPages) {
                        state.currentPage++;
                        fetchOrders();
                    }
                });
                paginationControls.appendChild(nextButton);
            }

            function updateCounter() {
                const start = (state.currentPage - 1) * state.itemsPerPage + 1;
                const end = Math.min(start + state.orders.length - 1, state.totalItems);

                if (state.totalItems === 0) {
                    itemsShowing.textContent = '0';
                } else {
                    itemsShowing.textContent = `${start}-${end}`;
                }

                totalItems.textContent = state.totalItems;
            }

            // Event Listeners
            searchInput.addEventListener('input', debounce(function(e) {
                state.filters.search = e.target.value.trim();
                state.currentPage = 1;
                fetchOrders();
            }, 500));

            statusFilterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    statusFilterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    state.filters.status = this.dataset.status;
                    state.currentPage = 1;
                    fetchOrders();
                });
            });

            applyDateFilterBtn.addEventListener('click', function() {
                state.filters.dateFrom = dateFromInput.value || null;
                state.filters.dateTo = dateToInput.value || null;
                
                // Validate that from date isn't after to date
                if (state.filters.dateFrom && state.filters.dateTo && state.filters.dateFrom > state.filters.dateTo) {
                    alert('From date cannot be after To date');
                    return;
                }
                
                filterDropdown.classList.remove('show');
                state.currentPage = 1;
                fetchOrders();
            });

            resetDateFilterBtn.addEventListener('click', function() {
                dateFromInput.value = '';
                dateToInput.value = '';
                state.filters.dateFrom = null;
                state.filters.dateTo = null;
                updateFilterIndicator();
            });

            clearFiltersBtn.addEventListener('click', function() {
                resetAllFilters();
            });

            clearAllFiltersBtn.addEventListener('click', function() {
                resetAllFilters();
            });

            function resetAllFilters() {
                // Clear search
                searchInput.value = '';
                state.filters.search = '';
                
                // Clear date filters
                dateFromInput.value = '';
                dateToInput.value = '';
                state.filters.dateFrom = null;
                state.filters.dateTo = null;
                
                // Reset status to 'all'
                statusFilterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.status === 'all') {
                        btn.classList.add('active');
                    }
                });
                state.filters.status = 'all';
                
                // Reset sorting
                state.sort.field = 'created_at';
                state.sort.order = 'desc';
                currentSort.textContent = 'Date';
                currentOrder.textContent = 'Newest';
                
                // Reset to page 1 and fetch
                state.currentPage = 1;
                updateFilterIndicator();
                fetchOrders();
            }

            // Table row click event
            tableBody.addEventListener('click', function(e) {
                const row = e.target.closest('tr');
                if (row && !e.target.closest('button')) {
                    const viewBtn = row.querySelector('.view-btn');
                    if (viewBtn) {
                        viewBtn.click();
                    }
                }
            });

            // Dropdown event listeners
            document.addEventListener('click', function(e) {
                const isDropdownButton = e.target.closest('.dropdown-toggle');
                const isDropdownMenu = e.target.closest('.dropdown-menu');

                if (!isDropdownButton && !isDropdownMenu) {
                    // Close all dropdowns if clicking outside
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            sortDropdownBtn.addEventListener('click', function(e) {
                toggleDropdown(sortDropdown);
                e.stopPropagation();
            });

            orderDropdownBtn.addEventListener('click', function(e) {
                toggleDropdown(orderDropdown);
                e.stopPropagation();
            });

            filterDropdownBtn.addEventListener('click', function(e) {
                toggleDropdown(filterDropdown);
                e.stopPropagation();
            });

            // Sort dropdown items
            sortDropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    const field = this.dataset.sort;
                    const label = this.dataset.label;

                    state.sort.field = field;
                    currentSort.textContent = label;
                    sortDropdown.classList.remove('show');
                    state.currentPage = 1;
                    fetchOrders();
                });
            });

            // Order dropdown items
            orderDropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    const order = this.dataset.order;
                    const label = this.dataset.label;

                    state.sort.order = order;
                    currentOrder.textContent = label;
                    orderDropdown.classList.remove('show');
                    state.currentPage = 1;
                    fetchOrders();
                });
            });

            // Items per page select
            itemsPerPageSelect.addEventListener('change', function() {
                state.itemsPerPage = parseInt(this.value);
                state.currentPage = 1;
                fetchOrders();
            });

            // Preset date buttons
            presetButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const days = parseInt(this.dataset.days);
                    const today = new Date();
                    const fromDate = new Date();
                    fromDate.setDate(today.getDate() - days);
                    
                    // Format dates as YYYY-MM-DD for input fields
                    dateToInput.value = today.toISOString().split('T')[0];
                    dateFromInput.value = fromDate.toISOString().split('T')[0];
                });
            });

            // Helper function for debouncing search input
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Initialize
            const today = new Date().toISOString().split('T')[0];
            dateFromInput.setAttribute('max', today);
            dateToInput.setAttribute('max', today);
            
            // Initial fetch
            fetchOrders();
        });
    </script>
</body>

</html>