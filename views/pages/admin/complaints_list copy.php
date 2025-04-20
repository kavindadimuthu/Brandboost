<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Management</title>
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
            /* padding: 2rem; */
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
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .card-body {
            padding: 1rem;
        }

        .sort-controls {
            display: flex;
            gap: 0.5rem;
        }

        .sort-select {
            padding: 0.5rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            background-color: white;
            font-size: 0.875rem;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sort-select:hover {
            border-color: var(--primary-light);
        }

        .sort-select:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .filters-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-box {
            display: flex;
            align-items: center;
            flex: 1;
            max-width: 400px;
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

        .data-table .user-info .user-role {
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

        .badge-open {
            background-color: var(--info-color);
            color: white;
        }

        .badge-resolved {
            background-color: var(--success-color);
            color: white;
        }

        .badge-pending {
            background-color: var(--pending-color);
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

        .pagination-controls {
            display: flex;
            gap: 0.25rem;
        }

        .pagination-btn {
            padding: 0.5rem 0.75rem;
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

        .dropdown {
            position: relative;
            display: inline-block;
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
            /* display: inline-block; */
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


        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: none;
            }

            .sort-controls {
                order: 2;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">
                    <i class="fas fa-home"></i> Admin portal &gt; Complaints
                </div>
                <div class="user-info">
                    <img alt="User profile picture" src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg" />
                    <span><?php echo isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : 'Admin User'; ?></span>
                </div>
            </div>

            <h1 class="page-title">Complaints Management</h1>
            <p class="page-description">Review and manage user complaints submitted to the platform. Address issues efficiently to maintain platform quality.</p>

            <div class="status-filters">
                <button class="status-filter-btn active" data-status="all">All</button>
                <button class="status-filter-btn" data-status="open">Open</button>
                <button class="status-filter-btn" data-status="pending">Pending</button>
                <button class="status-filter-btn" data-status="resolved">Resolved</button>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="search-box">
                        <i class="fas fa-search icon"></i>
                        <input type="text" id="searchInput" placeholder="Search by ID, user, or complaint type...">
                    </div>
                    <div class="sort-controls">
                        <select id="sortColumn" class="sort-select">
                            <option value="complaint_id">Sort by: ID</option>
                            <option value="complaint_type">Sort by: Type</option>
                            <option value="status">Sort by: Status</option>
                            <option value="created_at" selected>Sort by: Date</option>
                        </select>
                        <select id="sortOrder" class="sort-select">
                            <option value="desc" selected>Order: Newest First</option>
                            <option value="asc">Order: Oldest First</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-outline" id="filterBtn">
                            <i class="fas fa-filter"></i> Filters
                        </button>
                        <button class="btn btn-primary" id="refreshBtn">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="data-table" id="complaintsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Complainant</th>
                                <th>Reported User</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Admin</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table body will be populated by JavaScript -->
                        </tbody>
                    </table>
                    <div id="emptyState" class="empty-state" style="display: none;">
                        <i class="fas fa-inbox"></i>
                        <h3>No complaints found</h3>
                        <p>No complaints match your current filters or search criteria.</p>
                        <button class="btn btn-primary" id="clearFiltersBtn">
                            <i class="fas fa-times"></i> Clear Filters
                        </button>
                    </div>
                </div>
            </div>

            <div class="pagination">
                <div class="pagination-info">
                    Showing <span id="itemsShowing">0</span> of <span id="totalItems">0</span> complaints
                </div>
                <div class="pagination-controls" id="paginationControls">
                    <!-- Pagination controls will be populated by JavaScript -->
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
                complaints: [],
                filters: {
                    status: 'all',
                    search: '',
                    sortBy: 'created_at',
                    orderDir: 'desc'
                }
            };

            // DOM Elements
            const complaintsTable = document.getElementById('complaintsTable');
            const tableBody = complaintsTable.querySelector('tbody');
            const emptyState = document.getElementById('emptyState');
            const paginationControls = document.getElementById('paginationControls');
            const itemsShowing = document.getElementById('itemsShowing');
            const totalItems = document.getElementById('totalItems');
            const searchInput = document.getElementById('searchInput');
            const statusFilterButtons = document.querySelectorAll('.status-filter-btn');
            const refreshBtn = document.getElementById('refreshBtn');
            const clearFiltersBtn = document.getElementById('clearFiltersBtn');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const sortColumn = document.getElementById('sortColumn');
            const sortOrder = document.getElementById('sortOrder');

            // Functions
            function showLoading() {
                loadingOverlay.classList.add('show');
            }

            function hideLoading() {
                loadingOverlay.classList.remove('show');
            }

            async function fetchComplaints() {
                showLoading();

                try {
                    // Build query parameters
                    const queryParams = new URLSearchParams({
                        limit: state.itemsPerPage,
                        offset: (state.currentPage - 1) * state.itemsPerPage,
                        sort_by: state.filters.sortBy,
                        order_dir: state.filters.orderDir
                    });

                    if (state.filters.search) {
                        queryParams.append('search', state.filters.search);
                    }

                    if (state.filters.status && state.filters.status !== 'all') {
                        queryParams.append('status', state.filters.status);
                    }

                    const response = await fetch(`/api/complaints?${queryParams.toString()}`);

                    if (!response.ok) {
                        throw new Error('Failed to fetch complaints');
                    }

                    const data = await response.json();
                    console.log('Fetched complaints:', data);

                    if (data.success) {
                        state.complaints = data.data;
                        state.totalItems = data.pagination.total_disputes;
                        state.totalPages = data.pagination.total_pages;
                        renderComplaints();
                        renderPagination();
                        updateCounter();
                    } else {
                        throw new Error(data.error || 'Failed to fetch complaints');
                    }
                } catch (error) {
                    console.error('Error fetching complaints:', error);
                    // For demo, use mock data if API call fails
                    useMockData();
                } finally {
                    hideLoading();
                }
            }

            function useMockData() {
                // Mock data for demo purposes when API is not available
                const mockComplaints = [{
                        complaint_id: 1,
                        complainant_user_id: 101,
                        reported_user_id: 201,
                        complaint_type: "Account Access",
                        description: "Unable to access my account despite multiple password reset attempts.",
                        status: "open",
                        resolved_by_admin_id: null,
                        resolution_notes: null,
                        created_at: "2025-04-15T10:30:00",
                        updated_at: "2025-04-15T10:30:00",
                        complainant: {
                            user_id: 101,
                            username: "Florence Shaw",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        reported_user: {
                            user_id: 201,
                            username: "Support Team",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        admin: null
                    },
                    {
                        complaint_id: 2,
                        complainant_user_id: 102,
                        reported_user_id: 202,
                        complaint_type: "Payment",
                        description: "Payment was processed but service not delivered. Order #45678.",
                        status: "pending",
                        resolved_by_admin_id: 301,
                        resolution_notes: "Investigating with payment provider",
                        created_at: "2025-04-14T15:45:00",
                        updated_at: "2025-04-16T09:20:00",
                        complainant: {
                            user_id: 102,
                            username: "Amélie Laurent",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        reported_user: {
                            user_id: 202,
                            username: "Vendor XYZ",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        admin: {
                            admin_id: 301,
                            username: "John Doe"
                        }
                    },
                    {
                        complaint_id: 3,
                        complainant_user_id: 103,
                        reported_user_id: 203,
                        complaint_type: "Technical",
                        description: "App crashes consistently when uploading images larger than 5MB.",
                        status: "open",
                        resolved_by_admin_id: 302,
                        resolution_notes: "Assigned to technical team",
                        created_at: "2025-04-13T09:15:00",
                        updated_at: "2025-04-13T14:30:00",
                        complainant: {
                            user_id: 103,
                            username: "Ammar Foley",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        reported_user: {
                            user_id: 203,
                            username: "System",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        admin: {
                            admin_id: 302,
                            username: "Jane Smith"
                        }
                    },
                    {
                        complaint_id: 4,
                        complainant_user_id: 104,
                        reported_user_id: 204,
                        complaint_type: "Content",
                        description: "User posted inappropriate content that violates community guidelines.",
                        status: "resolved",
                        resolved_by_admin_id: 301,
                        resolution_notes: "Content removed and warning issued to user",
                        created_at: "2025-04-10T16:20:00",
                        updated_at: "2025-04-12T11:05:00",
                        complainant: {
                            user_id: 104,
                            username: "Caitlyn King",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        reported_user: {
                            user_id: 204,
                            username: "User123",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        admin: {
                            admin_id: 301,
                            username: "John Doe"
                        }
                    },
                    {
                        complaint_id: 5,
                        complainant_user_id: 105,
                        reported_user_id: 205,
                        complaint_type: "Performance",
                        description: "Platform becomes extremely slow during peak hours making it unusable.",
                        status: "pending",
                        resolved_by_admin_id: null,
                        resolution_notes: null,
                        created_at: "2025-04-17T13:40:00",
                        updated_at: "2025-04-17T13:40:00",
                        complainant: {
                            user_id: 105,
                            username: "Sienna Hewitt",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        reported_user: {
                            user_id: 205,
                            username: "System",
                            profile_image: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                        },
                        admin: null
                    }
                ];

                // Set mock data and pagination info
                state.complaints = mockComplaints;
                state.totalItems = mockComplaints.length;
                state.totalPages = Math.ceil(mockComplaints.length / state.itemsPerPage);

                // Render the UI with mock data
                renderComplaints();
                renderPagination();
                updateCounter();
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

            function renderComplaints() {
                tableBody.innerHTML = '';

                if (state.complaints.length === 0) {
                    complaintsTable.style.display = 'none';
                    emptyState.style.display = 'block';
                    return;
                }

                complaintsTable.style.display = 'table';
                emptyState.style.display = 'none';

                state.complaints.forEach(complaint => {
                    const row = document.createElement('tr');
                    row.dataset.id = complaint.complaint_id;
                    row.classList.add('clickable-row');

                    const complainantInfo = complaint.complainant || {
                        username: 'Unknown User',
                        profile_image: 'https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg'
                    };

                    const reportedUserInfo = complaint.reported_user || {
                        username: 'Unknown User',
                        profile_image: 'https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg'
                    };

                    const adminInfo = complaint.admin ? complaint.admin.username : 'Not Assigned';

                    row.innerHTML = `
                        <td><strong>#${complaint.complaint_id}</strong></td>
                        <td>
                            <div class="user-info">
                                <img src="${complainantInfo.profile_image}" alt="${complainantInfo.username}">
                                <div class="user-details">
                                    <span class="user-name">${complainantInfo.username}</span>
                                    <span class="user-role">Complainant</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-info">
                                <img src="${reportedUserInfo.profile_image}" alt="${reportedUserInfo.username}">
                                <div class="user-details">
                                    <span class="user-name">${reportedUserInfo.username}</span>
                                    <span class="user-role">Reported</span>
                                </div>
                            </div>
                        </td>
                        <td>${complaint.complaint_type}</td>
                        <td class="tooltip">
                            <div class="truncate">${complaint.description}</div>
                            <span class="tooltip-text">${complaint.description}</span>
                        </td>
                        <td>
                            <span class="badge badge-${complaint.status}">${complaint.status}</span>
                        </td>
                        <td>${adminInfo}</td>
                        <td>${formatDate(complaint.created_at)}</td>
                    `;

                    tableBody.appendChild(row);
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
                        fetchComplaints();
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
                        fetchComplaints();
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
                        fetchComplaints();
                    }
                });
                paginationControls.appendChild(nextButton);
            }

            function updateCounter() {
                const start = (state.currentPage - 1) * state.itemsPerPage + 1;
                const end = Math.min(start + state.complaints.length - 1, state.totalItems);

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
                fetchComplaints();
            }, 500));

            statusFilterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    statusFilterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    state.filters.status = this.dataset.status;
                    state.currentPage = 1;
                    fetchComplaints();
                });
            });

            refreshBtn.addEventListener('click', function() {
                fetchComplaints();
            });

            // Add sort handlers
            sortColumn.addEventListener('change', function() {
                state.filters.sortBy = this.value;
                state.currentPage = 1;
                fetchComplaints();
            });

            sortOrder.addEventListener('change', function() {
                state.filters.orderDir = this.value;
                state.currentPage = 1;
                fetchComplaints();
            });

            // Modify the clearFiltersBtn handler to also reset sort options
            clearFiltersBtn.addEventListener('click', function() {
                searchInput.value = '';
                state.filters.search = '';

                statusFilterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.status === 'all') {
                        btn.classList.add('active');
                    }
                });

                // Reset sort options to defaults
                sortColumn.value = 'created_at';
                sortOrder.value = 'desc';
                state.filters.sortBy = 'created_at';
                state.filters.orderDir = 'desc';

                state.filters.status = 'all';
                state.currentPage = 1;
                fetchComplaints();
            });

            tableBody.addEventListener('click', function(e) {
                const row = e.target.closest('tr');
                if (row) {
                    const id = row.dataset.id;
                    if (id) {
                        window.location.href = `/admin/complaint-details/${id}`;
                    }
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
            fetchComplaints();
        });
    </script>
</body>

</html>