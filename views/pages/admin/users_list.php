<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
            --blocked-color: #f97316;
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

        .filters-bar .btn-group {
            display: flex;
            gap: 0.5rem;
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

        .badge-active {
            background-color: var(--success-color);
            color: white;
        }

        .badge-inactive {
            background-color: var(--warning-color);
            color: white;
        }

        .badge-blocked {
            background-color: var(--blocked-color);
            color: white;
        }

        .badge-banned {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-verified {
            background-color: var(--success-color);
            color: white;
        }

        .badge-unverified {
            background-color: var(--gray-600);
            color: white;
        }

        .badge-pending {
            background-color: var(--info-color);
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

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
            border: 1px solid var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #dc2626;
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

        .role-filter {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
        }

        .role-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-size: 0.875rem;
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

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
        }

        .user-id-column {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <i class="fas fa-home"></i> Admin Portal &gt; Users
                </div>
                <div class="user-info">
                    <img alt="User profile picture" src="/cdn_uploads/users/dp/admin-deafult.png" />
                    <span><?php echo $_SESSION['user']['username'] ?? 'Admin'; ?></span>
                </div>
            </div>

            <h1 class="page-title">User Management</h1>
            <p class="page-description">Manage your team members and their account permissions here.</p>

            <div class="status-filters" id="statusFilters">
                <button class="status-filter-btn active" data-status="all">All Users</button>
                <button class="status-filter-btn" data-status="active">Active</button>
                <button class="status-filter-btn" data-status="inactive">Inactive</button>
                <button class="status-filter-btn" data-status="blocked">Blocked</button>
                <button class="status-filter-btn" data-status="banned">Banned</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="search-box">
                        <i class="fas fa-search icon"></i>
                        <input type="text" id="searchInput" placeholder="Search by name or email...">
                    </div>
                    <div class="filters-controls">
                        <div class="dropdown">
                            <button class="btn btn-outline dropdown-toggle" id="roleDropdownBtn">
                                <i class="fas fa-user-tag"></i> Role: <span id="currentRole">All</span>
                            </button>
                            <div class="dropdown-menu" id="roleDropdown">
                                <div class="dropdown-header">Select Role</div>
                                <div class="role-filter">
                                    <label class="role-option">
                                        <input type="radio" name="role" value="" checked> All Roles
                                    </label>
                                    <label class="role-option">
                                        <input type="radio" name="role" value="businessman"> Businessman
                                    </label>
                                    <label class="role-option">
                                        <input type="radio" name="role" value="influencer"> Influencer
                                    </label>
                                    <label class="role-option">
                                        <input type="radio" name="role" value="designer"> Designer
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline dropdown-toggle" id="verificationDropdownBtn">
                                <i class="fas fa-check-circle"></i> Verification: <span id="currentVerification">All</span>
                            </button>
                            <div class="dropdown-menu" id="verificationDropdown">
                                <button class="dropdown-item" data-verification="" data-label="All">
                                    <i class="fas fa-users"></i> All Users
                                </button>
                                <button class="dropdown-item" data-verification="verified" data-label="Verified">
                                    <i class="fas fa-check-circle"></i> Verified
                                </button>
                                <button class="dropdown-item" data-verification="unverified" data-label="Unverified">
                                    <i class="fas fa-times-circle"></i> Unverified
                                </button>
                                <button class="dropdown-item" data-verification="pending" data-label="Pending">
                                    <i class="fas fa-clock"></i> Pending
                                </button>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline dropdown-toggle" id="sortDropdownBtn">
                                <i class="fas fa-sort"></i> Sort: <span id="currentSort">Date Added</span>
                            </button>
                            <div class="dropdown-menu" id="sortDropdown">
                                <button class="dropdown-item" data-sort="created_at" data-label="Date Added">
                                    <i class="fas fa-calendar-plus"></i> Date Added
                                </button>
                                <button class="dropdown-item" data-sort="updated_at" data-label="Last Active">
                                    <i class="fas fa-calendar-check"></i> Last Active
                                </button>
                                <button class="dropdown-item" data-sort="name" data-label="Name">
                                    <i class="fas fa-font"></i> Name
                                </button>
                                <button class="dropdown-item" data-sort="role" data-label="Role">
                                    <i class="fas fa-user-tag"></i> Role
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
                    <table class="data-table" id="usersTable" style="display: none;">
                        <thead>
                            <tr>
                                <th class="user-id-column">User ID</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Verification</th>
                                <th>Last Active</th>
                                <th>Date Added</th>
                                <th style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body will be populated by JavaScript -->
                        </tbody>
                    </table>
                    <div id="loadingIndicator" class="loading-indicator">
                        <div class="spinner"></div>
                        <p>Loading users...</p>
                    </div>
                    <div id="emptyState" class="empty-state" style="display: none;">
                        <i class="fas fa-users-slash"></i>
                        <h3>No users found</h3>
                        <p>No users match your current filters or search criteria.</p>
                        <button class="btn btn-primary" id="clearFiltersBtn">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="pagination">
                <div class="pagination-info">
                    Showing <span id="itemsShowing">0</span> of <span id="totalItems">0</span> users
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
                users: [],
                filters: {
                    status: 'all',
                    role: '',
                    verification_status: '',
                    search: ''
                },
                sort: {
                    field: 'created_at',
                    order: 'desc'
                }
            };

            // DOM Elements
            const usersTable = document.getElementById('usersTable');
            const tableBody = usersTable.querySelector('tbody');
            const emptyState = document.getElementById('emptyState');
            const loadingIndicator = document.getElementById('loadingIndicator');
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
            const roleDropdownBtn = document.getElementById('roleDropdownBtn');
            const roleDropdown = document.getElementById('roleDropdown');
            const verificationDropdownBtn = document.getElementById('verificationDropdownBtn');
            const verificationDropdown = document.getElementById('verificationDropdown');
            const sortDropdownBtn = document.getElementById('sortDropdownBtn');
            const sortDropdown = document.getElementById('sortDropdown');
            const orderDropdownBtn = document.getElementById('orderDropdownBtn');
            const orderDropdown = document.getElementById('orderDropdown');
            
            // Current selection indicators
            const currentRole = document.getElementById('currentRole');
            const currentVerification = document.getElementById('currentVerification');
            const currentSort = document.getElementById('currentSort');
            const currentOrder = document.getElementById('currentOrder');
            const roleOptions = document.querySelectorAll('input[name="role"]');

            // Functions
            function showLoading() {
                loadingOverlay.classList.add('show');
                loadingIndicator.style.display = 'flex';
                usersTable.style.display = 'none';
                emptyState.style.display = 'none';
            }

            function hideLoading() {
                loadingOverlay.classList.remove('show');
                loadingIndicator.style.display = 'none';
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

            async function fetchUsers() {
                showLoading();
                
                try {
                    // Build query parameters
                    const queryParams = new URLSearchParams({
                        limit: state.itemsPerPage,
                        offset: (state.currentPage - 1) * state.itemsPerPage,
                        sort_by: state.sort.field,
                        order_dir: state.sort.order
                    });

                    if (state.filters.search) {
                        queryParams.append('search', state.filters.search);
                    }

                    if (state.filters.status && state.filters.status !== 'all') {
                        queryParams.append('account_status', state.filters.status);
                    }

                    if (state.filters.role) {
                        queryParams.append('role', state.filters.role);
                    }

                    if (state.filters.verification_status) {
                        queryParams.append('verification_status', state.filters.verification_status);
                    }

                    const response = await fetch(`/api/users?${queryParams.toString()}`);
                    
                    if (!response.ok) {
                        throw new Error('Failed to fetch users');
                    }

                    const data = await response.json();
                    console.log('Fetched users:', data);
                    
                    state.users = data.users || [];
                    state.totalItems = data.pagination.total_users;
                    state.totalPages = data.pagination.total_pages;
                    
                    renderUsers();
                    renderPagination();
                    updateCounter();
                    
                } catch (error) {
                    console.error('Error fetching users:', error);
                    emptyState.querySelector('p').textContent = 'Error loading users. Please try again.';
                    emptyState.style.display = 'block';
                    usersTable.style.display = 'none';
                } finally {
                    hideLoading();
                }
            }

            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return dateString;
                return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
            }

            function capitalizeFirstLetter(string) {
                if (!string) return '';
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            function renderUsers() {
                tableBody.innerHTML = '';

                if (state.users.length === 0) {
                    usersTable.style.display = 'none';
                    emptyState.style.display = 'block';
                    return;
                }

                usersTable.style.display = 'table';
                emptyState.style.display = 'none';

                state.users.forEach(user => {
                    const row = document.createElement('tr');
                    row.dataset.userId = user.user_id;
                    
                    // Default profile picture if none is set
                    const profilePic = user.profile_picture || '/cdn_uploads/users/dp/dp-empty.png';

                    row.innerHTML = `
                        <td class="user-id-column">${user.user_id}</td>
                        <td>
                            <div class="user-info">
                                <img alt="User profile picture" src="${profilePic}" />
                                <div class="user-details">
                                    <span class="user-name">${user.name}</span>
                                    <span class="user-email">${user.email}</span>
                                </div>
                            </div>
                        </td>
                        <td>${capitalizeFirstLetter(user.role)}</td>
                        <td>
                            <span class="badge badge-${user.account_status.toLowerCase()}">
                                ${capitalizeFirstLetter(user.account_status)}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-${user.verification_status.toLowerCase()}">
                                ${capitalizeFirstLetter(user.verification_status)}
                            </span>
                        </td>
                        <td>${formatDate(user.updated_at)}</td>
                        <td>${formatDate(user.created_at)}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-primary view-btn" data-id="${user.user_id}">
                                    <i class="fas fa-eye"></i>
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
                        const userId = button.dataset.id;
                        window.location.href = `/admin/user-profile/${userId}`;
                    });
                });

            }

            async function deleteUser(userId) {
                showLoading();
                
                try {
                    const response = await fetch(`/api/users/${userId}`, {
                        method: 'DELETE'
                    });
                    
                    if (!response.ok) {
                        throw new Error('Failed to delete user');
                    }
                    
                    // Refresh the user list
                    fetchUsers();
                    
                } catch (error) {
                    console.error('Error deleting user:', error);
                    alert('Error deleting user. Please try again.');
                    hideLoading();
                }
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
                        fetchUsers();
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
                        fetchUsers();
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
                        fetchUsers();
                    }
                });
                paginationControls.appendChild(nextButton);
            }

            function updateCounter() {
                const start = (state.currentPage - 1) * state.itemsPerPage + 1;
                const end = Math.min(start + state.users.length - 1, state.totalItems);

                if (state.totalItems === 0) {
                    itemsShowing.textContent = '0';
                } else {
                    itemsShowing.textContent = `${start}-${end}`;
                }

                totalItems.textContent = state.totalItems;
            }

            // Helper function for debouncing search input
            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            // Event Listeners
            searchInput.addEventListener('input', debounce(function(e) {
                state.filters.search = e.target.value.trim();
                state.currentPage = 1;
                fetchUsers();
            }, 500));

            // Status filter buttons
            statusFilterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    statusFilterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    state.filters.status = this.dataset.status;
                    state.currentPage = 1;
                    fetchUsers();
                });
            });

            // Role filter options
            roleOptions.forEach(option => {
                option.addEventListener('change', function() {
                    state.filters.role = this.value;
                    currentRole.textContent = this.value ? capitalizeFirstLetter(this.value) : 'All';
                    roleDropdown.classList.remove('show');
                    state.currentPage = 1;
                    fetchUsers();
                });
            });

            // Clear filters buttons
            clearFiltersBtn.addEventListener('click', clearAllFilters);
            clearAllFiltersBtn.addEventListener('click', clearAllFilters);

            function clearAllFilters() {
                // Reset search
                searchInput.value = '';
                state.filters.search = '';
                
                // Reset status filter
                statusFilterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.status === 'all') {
                        btn.classList.add('active');
                    }
                });
                state.filters.status = 'all';
                
                // Reset role filter
                roleOptions.forEach(option => {
                    if (option.value === '') {
                        option.checked = true;
                    } else {
                        option.checked = false;
                    }
                });
                state.filters.role = '';
                currentRole.textContent = 'All';
                
                // Reset verification filter
                state.filters.verification_status = '';
                currentVerification.textContent = 'All';
                
                // Reset sort and order
                state.sort.field = 'created_at';
                state.sort.order = 'desc';
                currentSort.textContent = 'Date Added';
                currentOrder.textContent = 'Newest';
                
                // Reset to page 1 and fetch
                state.currentPage = 1;
                fetchUsers();
            }

            // Row click to navigate to user profile
            tableBody.addEventListener('click', function(event) {
                const row = event.target.closest('tr');
                if (row && !event.target.closest('.action-buttons')) {
                    const userId = row.dataset.userId;
                    window.location.href = '/admin/user-profile/' + userId;
                }
            });

            // Dropdown toggling
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

            roleDropdownBtn.addEventListener('click', function(e) {
                toggleDropdown(roleDropdown);
                e.stopPropagation();
            });

            verificationDropdownBtn.addEventListener('click', function(e) {
                toggleDropdown(verificationDropdown);
                e.stopPropagation();
            });

            sortDropdownBtn.addEventListener('click', function(e) {
                toggleDropdown(sortDropdown);
                e.stopPropagation();
            });

            orderDropdownBtn.addEventListener('click', function(e) {
                toggleDropdown(orderDropdown);
                e.stopPropagation();
            });

            // Verification dropdown items
            verificationDropdown.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    const verification = this.dataset.verification;
                    const label = this.dataset.label;

                    state.filters.verification_status = verification;
                    currentVerification.textContent = label;
                    verificationDropdown.classList.remove('show');
                    state.currentPage = 1;
                    fetchUsers();
                });
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
                    fetchUsers();
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
                    fetchUsers();
                });
            });

            // Items per page select
            itemsPerPageSelect.addEventListener('change', function() {
                state.itemsPerPage = parseInt(this.value);
                state.currentPage = 1;
                fetchUsers();
            });

            // Initialize
            fetchUsers();
        });
    </script>
</body>

</html>