<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Actions Log</title>
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
            --logout-color: #f97316;
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
            /* padding: 2rem; */
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
            margin-bottom: 2rem;
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
            flex-wrap: wrap;
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
            cursor: pointer;
            user-select: none;
        }

        .data-table th:first-child {
            border-top-left-radius: var(--radius);
        }

        .data-table th:last-child {
            border-top-right-radius: var(--radius);
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

        .badge-user_banned {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-user_blocked {
            background-color: var(--warning-color);
            color: var(--gray-800);
        }

        .badge-user_inactive {
            background-color: var(--gray-600);
            color: white;
        }

        .badge-user_active {
            background-color: var(--success-color);
            color: white;
        }

        .badge-order_reversed {
            background-color: var(--info-color);
            color: white;
        }

        .badge-order_canceled {
            background-color: var(--logout-color);
            color: white;
        }

        .badge-complaint_open {
            background-color: var(--gray-800);
            color: white;
        }

        .badge-complaint_resolved {
            background-color: var(--success-color);
            color: white;
        }

        .badge-other {
            background-color: var(--success-color);
            color: white;
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

        .filter-options {
            padding: 0 1rem;
            max-height: 200px;
            overflow-y: auto;
        }

        .filter-actions {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 1rem;
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

        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .tooltip {
            position: relative;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: var(--gray-800);
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.75rem;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 2rem;
            border-radius: var(--radius);
            width: 90%;
            max-width: 600px;
            box-shadow: var(--shadow-md);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-800);
        }

        .close-modal {
            font-size: 1.5rem;
            line-height: 1;
            cursor: pointer;
            color: var(--gray-600);
            background: none;
            border: none;
        }

        .close-modal:hover {
            color: var(--gray-800);
        }

        .modal-body {
            margin-bottom: 1.5rem;
        }

        .modal-section {
            margin-bottom: 1.5rem;
        }

        .modal-section-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-600);
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 0.875rem;
            color: var(--gray-800);
        }

        .action-note {
            background-color: var(--gray-100);
            padding: 1rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
            color: var(--gray-800);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <i class="fas fa-home"></i> Admin Portal &gt; Actions Log
                </div>
                <div class="user-info">
                    <img alt="Admin profile picture" 
                        src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg" />
                    <span><?php echo $_SESSION['user']['username'] ?? 'Admin'; ?></span>
                </div>
            </div>

            <h1 class="page-title">Admin Actions Log</h1>
            <p class="page-description">Track and monitor all administrative actions performed on the system. Review user and order-related changes.</p>

            <div class="status-filters">
                <button class="status-filter-btn active" data-type="all">All Types</button>
                <button class="status-filter-btn" data-type="user_banned">User Banned</button>
                <button class="status-filter-btn" data-type="user_blocked">User Blocked</button>
                <button class="status-filter-btn" data-type="user_active">User Active</button>
                <button class="status-filter-btn" data-type="order_reversed">Order Reversed</button>
                <button class="status-filter-btn" data-type="order_canceled">Order Canceled</button>
                <button class="status-filter-btn" data-type="complaint_open">Complaint Open</button>
                <button class="status-filter-btn" data-type="complaint_resolved">Complaint Resolved</button>
                <button class="status-filter-btn" data-type="other">Other</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="search-box">
                        <i class="fas fa-search icon"></i>
                        <input type="text" id="searchInput" placeholder="Search by ID, user, or action type...">
                    </div>
                    <div class="filters-controls">
                        <div class="dropdown">
                            <button class="btn btn-outline dropdown-toggle" id="filterDropdownBtn">
                                <i class="fas fa-calendar-alt"></i> Date Range
                            </button>
                            <div class="dropdown-menu dropdown-menu-wide" id="filterDropdown">
                                <div class="dropdown-header">Select Date Range</div>
                                <div class="filter-options">
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
                                <button class="dropdown-item" data-sort="action_id" data-label="ID">
                                    <i class="fas fa-hashtag"></i> ID
                                </button>
                                <button class="dropdown-item" data-sort="action_type" data-label="Type">
                                    <i class="fas fa-tag"></i> Action Type
                                </button>
                                <button class="dropdown-item" data-sort="user_id" data-label="User ID">
                                    <i class="fas fa-user"></i> User ID
                                </button>
                                <button class="dropdown-item" data-sort="admin_id" data-label="Admin ID">
                                    <i class="fas fa-user-shield"></i> Admin ID
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
                        <button class="btn btn-primary" id="clearAllFiltersBtn">
                            <i class="fas fa-times"></i> Clear All Filters
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="data-table" id="actionsTable">
                        <thead>
                            <tr>
                                <th data-sort="action_id">ID <i class="fas fa-sort"></i></th>
                                <th data-sort="admin_id">Admin <i class="fas fa-sort"></i></th>
                                <th data-sort="action_type">Action Type <i class="fas fa-sort"></i></th>
                                <th data-sort="user_id">User ID <i class="fas fa-sort"></i></th>
                                <!-- <th data-sort="order_id">Order ID <i class="fas fa-sort"></i></th> -->
                                <th>Action Note</th>
                                <th data-sort="created_at">Date <i class="fas fa-sort"></i></th>
                            </tr>
                        </thead>
                        <tbody id="actionsTableBody">
                            <!-- Actions data will be inserted here -->
                        </tbody>
                    </table>
                    <div id="emptyState" class="empty-state" style="display: none;">
                        <i class="fas fa-inbox"></i>
                        <h3>No action records found</h3>
                        <p>No actions match your current filters or search criteria.</p>
                        <button class="btn btn-primary" id="clearFiltersBtn">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="pagination">
                <div class="pagination-info">
                    Showing <span id="itemsShowing">0</span> of <span id="totalItems">0</span> actions
                </div>
                <div class="pagination-options">
                    <div class="items-per-page">
                        <label for="itemsPerPage">Items per page:</label>
                        <select id="itemsPerPage">
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="pagination-controls" id="paginationControls">
                        <!-- Pagination controls will be populated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Detail Modal -->
    <div id="actionDetailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Action Details</h3>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <div class="modal-section-title">Basic Information</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Action ID:</div>
                            <div class="info-value" id="modalActionId"></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Action Type:</div>
                            <div class="info-value" id="modalActionType"></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Admin ID:</div>
                            <div class="info-value" id="modalAdminId"></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Date/Time:</div>
                            <div class="info-value" id="modalCreatedAt"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-section">
                    <div class="modal-section-title">Related Information</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">User ID:</div>
                            <div class="info-value" id="modalUserId"></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Order ID:</div>
                            <div class="info-value" id="modalOrderId"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-section">
                    <div class="modal-section-title">Action Note</div>
                    <div class="action-note" id="modalActionNote"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline" id="closeModalButton">Close</button>
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
                actions: [],
                filters: {
                    type: 'all',
                    search: '',
                    dateFrom: null,
                    dateTo: null,
                    userId: null,
                    adminId: null,
                    orderId: null
                },
                sort: {
                    field: 'created_at',
                    order: 'desc'
                }
            };

            // DOM Elements
            const actionsTable = document.getElementById('actionsTable');
            const actionsTableBody = document.getElementById('actionsTableBody');
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
            
            // Dropdown elements
            const sortDropdownBtn = document.getElementById('sortDropdownBtn');
            const sortDropdown = document.getElementById('sortDropdown');
            const orderDropdownBtn = document.getElementById('orderDropdownBtn');
            const orderDropdown = document.getElementById('orderDropdown');
            const exportDropdown = document.getElementById('exportDropdown');
            const filterDropdownBtn = document.getElementById('filterDropdownBtn');
            const filterDropdown = document.getElementById('filterDropdown');
            
            // Sort and order labels
            const currentSort = document.getElementById('currentSort');
            const currentOrder = document.getElementById('currentOrder');
            
            // Date filter elements
            const dateFromInput = document.getElementById('dateFrom');
            const dateToInput = document.getElementById('dateTo');
            const applyDateFilterBtn = document.getElementById('applyDateFilterBtn');
            const resetDateFilterBtn = document.getElementById('resetDateFilterBtn');
            const presetButtons = document.querySelectorAll('.preset-btn');
            
            // Modal elements
            const actionDetailModal = document.getElementById('actionDetailModal');
            const closeModal = document.getElementById('closeModal');
            const closeModalButton = document.getElementById('closeModalButton');
            const modalActionId = document.getElementById('modalActionId');
            const modalActionType = document.getElementById('modalActionType');
            const modalAdminId = document.getElementById('modalAdminId');
            const modalUserId = document.getElementById('modalUserId');
            const modalOrderId = document.getElementById('modalOrderId');
            const modalCreatedAt = document.getElementById('modalCreatedAt');
            const modalActionNote = document.getElementById('modalActionNote');

            // Functions
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

            async function fetchActions() {
                showLoading();
                
                try {
                    // Build query parameters
                    const queryParams = new URLSearchParams({
                        page: state.currentPage,
                        limit: state.itemsPerPage,
                        sort_by: state.sort.field,
                        order_dir: state.sort.order
                    });

                    if (state.filters.search) {
                        queryParams.append('search', state.filters.search);
                    }

                    if (state.filters.type && state.filters.type !== 'all') {
                        queryParams.append('action_type', state.filters.type);
                    }

                    if (state.filters.dateFrom) {
                        queryParams.append('date_from', state.filters.dateFrom);
                    }

                    if (state.filters.dateTo) {
                        queryParams.append('date_to', state.filters.dateTo);
                    }

                    if (state.filters.userId) {
                        queryParams.append('user_id', state.filters.userId);
                    }

                    if (state.filters.adminId) {
                        queryParams.append('admin_id', state.filters.adminId);
                    }

                    if (state.filters.orderId) {
                        queryParams.append('order_id', state.filters.orderId);
                    }

                    const response = await fetch(`/api/actions?${queryParams.toString()}`);
                    
                    if (!response.ok) {
                        throw new Error('Failed to fetch actions');
                    }

                    const data = await response.json();
                    console.log('Fetched actions:', data);
                    
                    if (data.success) {
                        state.actions = data.data;
                        state.totalItems = data.pagination.total_records;
                        state.totalPages = data.pagination.total_pages;
                        renderActions();
                        renderPagination();
                        updateCounter();
                        updateFilterIndicator();
                    } else {
                        throw new Error(data.error || 'Failed to fetch actions');
                    }
                } catch (error) {
                    console.error('Error fetching actions:', error);
                } finally {
                    hideLoading();
                }
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

            function formatDate(dateString) {
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            function renderActions() {
                actionsTableBody.innerHTML = '';

                if (state.actions.length === 0) {
                    actionsTable.style.display = 'none';
                    emptyState.style.display = 'block';
                    return;
                }

                actionsTable.style.display = 'table';
                emptyState.style.display = 'none';

                state.actions.forEach(action => {
                    const row = document.createElement('tr');
                    row.dataset.id = action.action_id;
                    
                    // Set data attributes for modal view
                    row.dataset.actionId = action.action_id;
                    row.dataset.adminId = action.admin_id;
                    row.dataset.actionType = action.action_type || 'N/A';
                    row.dataset.userId = action.user_id || 'N/A';
                    row.dataset.orderId = action.order_id || 'N/A';
                    row.dataset.createdAt = formatDate(action.created_at);
                    row.dataset.actionNote = action.action_note || 'N/A';

                    const actionTypeDisplay = action.action_type || 'N/A';
                    const badgeClass = `badge-${action.action_type}` || '';

                    row.innerHTML = `
                        <td><strong>#${action.action_id}</strong></td>
                        <td>${action.admin_id}</td>
                        <td><span class="badge ${badgeClass}">${actionTypeDisplay}</span></td>
                        <td>${action.user_id || 'N/A'}</td>
                        <td>${action.order_id || 'N/A'}</td>
                        <td class="tooltip">
                            <div class="truncate">${action.action_note || 'N/A'}</div>
                            <span class="tooltip-text">${action.action_note || 'N/A'}</span>
                        </td>
                        <td>${formatDate(action.created_at)}</td>
                    `;

                    actionsTableBody.appendChild(row);
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
                        fetchActions();
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
                        fetchActions();
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
                        fetchActions();
                    }
                });
                paginationControls.appendChild(nextButton);
            }

            function updateCounter() {
                const start = (state.currentPage - 1) * state.itemsPerPage + 1;
                const end = Math.min(start + state.actions.length - 1, state.totalItems);

                if (state.totalItems === 0) {
                    itemsShowing.textContent = '0';
                } else {
                    itemsShowing.textContent = `${start}-${end}`;
                }

                totalItems.textContent = state.totalItems;
            }

            function showActionDetails(actionData) {
                modalActionId.textContent = actionData.actionId;
                modalActionType.textContent = actionData.actionType;
                modalAdminId.textContent = actionData.adminId;
                modalUserId.textContent = actionData.userId;
                modalOrderId.textContent = actionData.orderId;
                modalCreatedAt.textContent = actionData.createdAt;
                modalActionNote.textContent = actionData.actionNote;
                
                actionDetailModal.style.display = 'block';
            }

            function exportData(format) {
                // Build export parameters based on current filters
                const params = new URLSearchParams({
                    format: format,
                    sort_by: state.sort.field,
                    order_dir: state.sort.order
                });

                if (state.filters.search) {
                    params.append('search', state.filters.search);
                }

                if (state.filters.type && state.filters.type !== 'all') {
                    params.append('action_type', state.filters.type);
                }

                if (state.filters.dateFrom) {
                    params.append('date_from', state.filters.dateFrom);
                }

                if (state.filters.dateTo) {
                    params.append('date_to', state.filters.dateTo);
                }

                if (state.filters.userId) {
                    params.append('user_id', state.filters.userId);
                }

                if (state.filters.adminId) {
                    params.append('admin_id', state.filters.adminId);
                }

                if (state.filters.orderId) {
                    params.append('order_id', state.filters.orderId);
                }

                window.location.href = `/api/actions/export?${params.toString()}`;
            }

            // Event Listeners
            searchInput.addEventListener('input', debounce(function(e) {
                state.filters.search = e.target.value.trim();
                state.currentPage = 1;
                fetchActions();
            }, 500));

            statusFilterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    statusFilterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    state.filters.type = this.dataset.type;
                    state.currentPage = 1;
                    fetchActions();
                });
            });

            // Items per page select
            itemsPerPageSelect.addEventListener('change', function() {
                state.itemsPerPage = parseInt(this.value);
                state.currentPage = 1;
                fetchActions();
            });

            // Clear filters button
            clearFiltersBtn.addEventListener('click', function() {
                resetAllFilters();
            });

            // Clear all filters button
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
                
                // Reset action type to 'all'
                statusFilterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.type === 'all') {
                        btn.classList.add('active');
                    }
                });
                state.filters.type = 'all';
                
                // Reset sorting
                state.sort.field = 'created_at';
                state.sort.order = 'desc';
                currentSort.textContent = 'Date';
                currentOrder.textContent = 'Newest';
                
                // Reset to page 1 and fetch
                state.currentPage = 1;
                updateFilterIndicator();
                fetchActions();
            }

            // Date filter buttons
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
                fetchActions();
            });

            resetDateFilterBtn.addEventListener('click', function() {
                dateFromInput.value = '';
                dateToInput.value = '';
                state.filters.dateFrom = null;
                state.filters.dateTo = null;
                updateFilterIndicator();
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

            // Dropdown toggle handlers
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
                    fetchActions();
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
                    fetchActions();
                });
            });

            // Table row click to view details
            actionsTableBody.addEventListener('click', function(e) {
                const row = e.target.closest('tr');
                if (row) {
                    showActionDetails(row.dataset);
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                }
            });

            // Modal close handlers
            closeModal.addEventListener('click', function() {
                actionDetailModal.style.display = 'none';
            });

            closeModalButton.addEventListener('click', function() {
                actionDetailModal.style.display = 'none';
            });

            window.addEventListener('click', function(e) {
                if (e.target === actionDetailModal) {
                    actionDetailModal.style.display = 'none';
                }
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
            fetchActions();
            
            // Set max date for date inputs to today
            const today = new Date().toISOString().split('T')[0];
            dateFromInput.setAttribute('max', today);
            dateToInput.setAttribute('max', today);
        });
    </script>
</body>

</html>