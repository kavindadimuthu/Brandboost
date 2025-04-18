<html>

<head>
    <title>Admin Actions Log</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            display: flex;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header .breadcrumb {
            font-size: 14px;
            color: #333;
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .header .user-info span {
            font-size: 14px;
        }

        .main-content {
            width: 100%;
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .main-content h2,
        .main-content p {
            color: #666;
            font-size: 14px;
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .main-content .filter-section {
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 15px;
        }

        .main-content .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .main-content .filter-header h3 {
            margin: 0;
            font-size: 16px;
            color: #555;
        }

        .main-content .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .main-content .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .main-content .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .main-content .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            color: #555;
        }

        .main-content .filter-group input,
        .main-content .filter-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 13px;
        }

        .main-content .filter-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 15px;
        }

        .main-content .filter-actions button {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .main-content .filter-actions .reset-btn {
            background-color: #f0f0f0;
            color: #555;
        }

        .main-content .filter-actions .apply-btn {
            background-color: #6a11cb;
            color: #fff;
        }

        .main-content .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .main-content .search-bar input {
            width: 400px;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .main-content .search-bar .filter-container {
            display: flex;
            gap: 10px;
        }

        .main-content .search-bar .filter-container select {
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: white;
        }

        .main-content .search-bar button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .main-content table {
            width: 100%;
            border-collapse: collapse;
        }

        .main-content table th,
        .main-content table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
            font-size: 14px;
            color: #666;
        }

        .main-content table th {
            background-color: #f9f9f9;
            cursor: pointer;
            user-select: none;
        }

        .main-content table th:hover {
            background-color: #f0f0f0;
        }

        .main-content table tr:hover {
            background-color: rgba(106, 17, 203, 0.05);
        }

        .main-content .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .main-content .pagination button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
            margin: 0 4px;
            color: #888;
        }

        .main-content .pagination button.active {
            font-weight: bold;
            color: #000;
            background-color: #f0f0f0;
            border-radius: 4px;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
        }

        .badge.create {
            background-color: #28a745;
        }

        .badge.update {
            background-color: #007bff;
        }

        .badge.delete {
            background-color: #dc3545;
        }

        .badge.login {
            background-color: #17a2b8;
        }

        .badge.logout {
            background-color: #ffc107;
            color: #212529;
        }

        .loading-indicator {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #6a11cb;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #666;
        }

        .export-dropdown {
            position: relative;
            display: inline-block;
        }

        .export-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 8px;
        }

        .export-dropdown-content a {
            color: black;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            font-size: 13px;
        }

        .export-dropdown-content a:hover {
            background-color: #f1f1f1;
            border-radius: 8px;
        }

        .export-dropdown:hover .export-dropdown-content {
            display: block;
        }

        .export-button {
            background-color: #f0f0f0;
            color: #555;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-info {
            text-align: center;
            margin-top: 10px;
            font-size: 13px;
            color: #666;
        }

        .records-per-page {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
        }

        .records-per-page select {
            margin: 0 5px;
            padding: 3px 5px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
        }

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
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            max-width: 700px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .modal-header h3 {
            margin: 0;
            color: #555;
        }

        .close-modal {
            font-size: 24px;
            cursor: pointer;
            color: #aaa;
        }

        .close-modal:hover {
            color: #555;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-body .info-row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .modal-body .info-group {
            flex: 1;
            min-width: 200px;
            margin-bottom: 10px;
        }

        .modal-body .info-label {
            font-weight: bold;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .modal-body .info-value {
            font-size: 14px;
            color: #666;
        }

        .modal-body .note-section {
            margin-top: 15px;
        }

        .modal-body .note-title {
            font-weight: bold;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .modal-body .note-content {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            color: #666;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .modal-footer button {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            background-color: #f0f0f0;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">Brandboost &gt; Admin Actions Log</div>
                <div class="user-info">
                    <img alt="Admin profile picture" height="30"
                        src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
                        width="30" />
                    <span><?php echo $_SESSION['user']['username'] ?? 'Admin'; ?></span>
                </div>
            </div>
            <h2>Admin Actions Log</h2>
            <p>
                Track and monitor all administrative actions performed on the system.
            </p>

            <!-- Filter Section -->
            <div class="filter-section" id="filterSection">
                <div class="filter-header">
                    <h3><i class="fas fa-filter"></i> Filters</h3>
                    <button id="toggleFilters" class="export-button">
                        <i class="fas fa-chevron-up"></i> <span id="toggleText">Hide Filters</span>
                    </button>
                </div>
                <div id="filterContent">
                    <form id="actionsFilterForm">
                        <div class="filter-row">
                            <div class="filter-group">
                                <label for="search">Search</label>
                                <input type="text" id="search" name="search" placeholder="Search by note or type...">
                            </div>
                            <div class="filter-group">
                                <label for="actionType">Action Type</label>
                                <select id="actionType" name="action_type">
                                    <option value="">All Types</option>
                                    <option value="create">Create</option>
                                    <option value="update">Update</option>
                                    <option value="delete">Delete</option>
                                    <option value="login">Login</option>
                                    <option value="logout">Logout</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label for="userId">User ID</label>
                                <input type="text" id="userId" name="user_id" placeholder="Filter by user ID">
                            </div>
                        </div>
                        <div class="filter-row">
                            <div class="filter-group">
                                <label for="dateFrom">Date From</label>
                                <input type="date" id="dateFrom" name="date_from">
                            </div>
                            <div class="filter-group">
                                <label for="dateTo">Date To</label>
                                <input type="date" id="dateTo" name="date_to">
                            </div>
                            <div class="filter-group">
                                <label for="orderId">Order ID</label>
                                <input type="text" id="orderId" name="order_id" placeholder="Filter by order ID">
                            </div>
                            <div class="filter-group">
                                <label for="adminId">Admin ID</label>
                                <input type="text" id="adminId" name="admin_id" placeholder="Filter by admin ID">
                            </div>
                        </div>
                        <div class="filter-actions">
                            <button type="button" id="resetFilters" class="reset-btn">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="apply-btn">
                                <i class="fas fa-search"></i> Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Actions Header -->
            <div class="search-bar">
                <div class="records-per-page">
                    <span>Show</span>
                    <select id="recordsPerPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entries</span>
                </div>
                <div class="export-dropdown">
                    <button class="export-button">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <div class="export-dropdown-content">
                        <a href="#" id="exportCsv"><i class="fas fa-file-csv"></i> CSV</a>
                        <a href="#" id="exportExcel"><i class="fas fa-file-excel"></i> Excel</a>
                        <a href="#" id="exportPdf"><i class="fas fa-file-pdf"></i> PDF</a>
                    </div>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div id="loadingIndicator" class="loading-indicator">
                <i class="fas fa-spinner fa-spin"></i> Loading actions...
            </div>

            <!-- Actions Table -->
            <table id="actionsTable" style="display: none;">
                <thead>
                    <tr>
                        <th data-sort="action_id">ID <i class="fas fa-sort"></i></th>
                        <th data-sort="admin_id">Admin <i class="fas fa-sort"></i></th>
                        <th data-sort="action_type">Action Type <i class="fas fa-sort"></i></th>
                        <th data-sort="user_id">User ID <i class="fas fa-sort"></i></th>
                        <th data-sort="order_id">Order ID <i class="fas fa-sort"></i></th>
                        <th>Action Note</th>
                        <th data-sort="created_at">Date/Time <i class="fas fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody id="actionsTableBody">
                    <!-- Actions data will be inserted here -->
                </tbody>
            </table>

            <!-- No Results Message -->
            <div id="noResults" class="no-results" style="display: none;">
                <i class="fas fa-search" style="font-size: 24px; margin-bottom: 10px;"></i>
                <p>No action records found matching your criteria.</p>
                <button id="clearAllFilters" class="export-button">Clear All Filters</button>
            </div>

            <!-- Error Message -->
            <div id="errorMessage" class="no-results" style="display: none; color: #dc3545;">
                <i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 10px;"></i>
                <p id="errorText">An error occurred while fetching data.</p>
                <button id="retryButton" class="export-button">Retry</button>
            </div>

            <!-- Pagination Controls -->
            <div class="pagination" id="pagination">
                <!-- Pagination buttons will be inserted here -->
            </div>

            <!-- Pagination Info -->
            <div class="pagination-info" id="paginationInfo">
                Showing <span id="showingFrom">0</span> to <span id="showingTo">0</span> of <span id="totalRecords">0</span> entries
            </div>
        </div>
    </div>

    <!-- Action Detail Modal -->
    <div id="actionDetailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Action Details</h3>
                <span class="close-modal" id="closeModal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="info-row">
                    <div class="info-group">
                        <div class="info-label">Action ID:</div>
                        <div class="info-value" id="modalActionId"></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Action Type:</div>
                        <div class="info-value" id="modalActionType"></div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-group">
                        <div class="info-label">Admin ID:</div>
                        <div class="info-value" id="modalAdminId"></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Date/Time:</div>
                        <div class="info-value" id="modalCreatedAt"></div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-group">
                        <div class="info-label">User ID:</div>
                        <div class="info-value" id="modalUserId"></div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Order ID:</div>
                        <div class="info-value" id="modalOrderId"></div>
                    </div>
                </div>
                <div class="note-section">
                    <div class="note-title">Action Note:</div>
                    <div class="note-content" id="modalActionNote"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="closeModalButton">Close</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // State variables
            let currentPage = 1;
            let currentLimit = 10;
            let currentSortBy = 'created_at';
            let currentSortDir = 'DESC';
            let currentFilters = {};
            
            // DOM Elements
            const actionsTable = document.getElementById('actionsTable');
            const actionsTableBody = document.getElementById('actionsTableBody');
            const pagination = document.getElementById('pagination');
            const recordsPerPage = document.getElementById('recordsPerPage');
            const actionsFilterForm = document.getElementById('actionsFilterForm');
            const loadingIndicator = document.getElementById('loadingIndicator');
            const noResults = document.getElementById('noResults');
            const errorMessage = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            const retryButton = document.getElementById('retryButton');
            const resetFilters = document.getElementById('resetFilters');
            const clearAllFilters = document.getElementById('clearAllFilters');
            const showingFrom = document.getElementById('showingFrom');
            const showingTo = document.getElementById('showingTo');
            const totalRecords = document.getElementById('totalRecords');
            const toggleFilters = document.getElementById('toggleFilters');
            const toggleText = document.getElementById('toggleText');
            const filterContent = document.getElementById('filterContent');
            
            // Modal Elements
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
            
            // Export buttons
            const exportCsv = document.getElementById('exportCsv');
            const exportExcel = document.getElementById('exportExcel');
            const exportPdf = document.getElementById('exportPdf');
            
            // Initial data load
            loadActionsData();
            
            // Event: Per page size change
            recordsPerPage.addEventListener('change', function() {
                currentLimit = parseInt(this.value);
                currentPage = 1;
                loadActionsData();
            });
            
            // Event: Filter form submission
            actionsFilterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                currentPage = 1;
                const formData = new FormData(this);
                currentFilters = {};
                
                for (const [key, value] of formData.entries()) {
                    if (value !== '') {
                        currentFilters[key] = value;
                    }
                }
                
                loadActionsData();
            });
            
            // Event: Reset filters
            resetFilters.addEventListener('click', function() {
                actionsFilterForm.reset();
                currentFilters = {};
                currentPage = 1;
                loadActionsData();
            });
            
            // Event: Clear all filters (from no results message)
            clearAllFilters.addEventListener('click', function() {
                actionsFilterForm.reset();
                currentFilters = {};
                currentPage = 1;
                loadActionsData();
            });
            
            // Event: Toggle filters visibility
            toggleFilters.addEventListener('click', function() {
                if (filterContent.style.display === 'none') {
                    filterContent.style.display = 'block';
                    toggleText.textContent = 'Hide Filters';
                    toggleFilters.querySelector('i').className = 'fas fa-chevron-up';
                } else {
                    filterContent.style.display = 'none';
                    toggleText.textContent = 'Show Filters';
                    toggleFilters.querySelector('i').className = 'fas fa-chevron-down';
                }
            });
            
            // Event: Retry button click
            retryButton.addEventListener('click', loadActionsData);
            
            // Event: Sort column headers
            document.querySelectorAll('th[data-sort]').forEach(th => {
                th.addEventListener('click', function() {
                    const sortBy = this.dataset.sort;
                    
                    // Toggle sort direction if clicking the same column
                    if (sortBy === currentSortBy) {
                        currentSortDir = currentSortDir === 'ASC' ? 'DESC' : 'ASC';
                    } else {
                        currentSortBy = sortBy;
                        currentSortDir = 'ASC';
                    }
                    
                    // Update visual sort indicators
                    document.querySelectorAll('th[data-sort] i').forEach(icon => {
                        icon.className = 'fas fa-sort';
                    });
                    
                    const sortIcon = this.querySelector('i');
                    sortIcon.className = currentSortDir === 'ASC' ? 'fas fa-sort-up' : 'fas fa-sort-down';
                    
                    loadActionsData();
                });
            });
            
            // Event: Export buttons
            exportCsv.addEventListener('click', function(e) {
                e.preventDefault();
                exportData('csv');
            });
            
            exportExcel.addEventListener('click', function(e) {
                e.preventDefault();
                exportData('excel');
            });
            
            exportPdf.addEventListener('click', function(e) {
                e.preventDefault();
                exportData('pdf');
            });
            
            // Event: Row click to view details
            actionsTableBody.addEventListener('click', function(e) {
                const row = e.target.closest('tr');
                if (row) {
                    const actionData = row.dataset;
                    showActionDetails(actionData);
                }
            });
            
            // Event: Close modal
            closeModal.addEventListener('click', function() {
                actionDetailModal.style.display = 'none';
            });
            
            closeModalButton.addEventListener('click', function() {
                actionDetailModal.style.display = 'none';
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target === actionDetailModal) {
                    actionDetailModal.style.display = 'none';
                }
            });
            
            // Main function to load actions data from API
            function loadActionsData() {
                showLoading();
                
                // Build query parameters
                const params = new URLSearchParams({
                    page: currentPage,
                    limit: currentLimit,
                    sort_by: currentSortBy,
                    order_dir: currentSortDir,
                    ...currentFilters
                });
                
                // Fetch data from API
                fetch(`/api/actions?${params.toString()}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch actions data');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            if (data.data && data.data.length > 0) {
                                renderActionsTable(data.data);
                                renderPagination(data.pagination);
                                updatePaginationInfo(data.pagination);
                                
                                actionsTable.style.display = 'table';
                                noResults.style.display = 'none';
                            } else {
                                actionsTable.style.display = 'none';
                                noResults.style.display = 'block';
                            }
                            
                            errorMessage.style.display = 'none';
                        } else {
                            throw new Error(data.error || 'Unknown error occurred');
                        }
                    })
                    .catch(error => {
                        actionsTable.style.display = 'none';
                        noResults.style.display = 'none';
                        errorMessage.style.display = 'block';
                        errorText.textContent = error.message;
                    })
                    .finally(() => {
                        hideLoading();
                    });
            }
            
            // Render actions table with data
            function renderActionsTable(actions) {
                actionsTableBody.innerHTML = '';
                
                actions.forEach(action => {
                    // Format date
                    const createdAt = new Date(action.created_at);
                    const formattedDate = createdAt.toLocaleString();
                    
                    // Create row with data attributes
                    const row = document.createElement('tr');
                    
                    // Set data attributes for modal view
                    row.dataset.actionId = action.action_id;
                    row.dataset.adminId = action.admin_id;
                    row.dataset.actionType = action.action_type;
                    row.dataset.userId = action.user_id || 'N/A';
                    row.dataset.orderId = action.order_id || 'N/A';
                    row.dataset.createdAt = formattedDate;
                    row.dataset.actionNote = action.action_note || 'N/A';
                    
                    // Get appropriate badge class based on action type
                    let badgeClass = '';
                    switch(action.action_type?.toLowerCase()) {
                        case 'create': badgeClass = 'create'; break;
                        case 'update': badgeClass = 'update'; break;
                        case 'delete': badgeClass = 'delete'; break;
                        case 'login': badgeClass = 'login'; break;
                        case 'logout': badgeClass = 'logout'; break;
                        default: badgeClass = ''; break;
                    }
                    
                    // Create row HTML
                    row.innerHTML = `
                        <td>${action.action_id}</td>
                        <td>${action.admin_id}</td>
                        <td><span class="badge ${badgeClass}">${action.action_type || 'N/A'}</span></td>
                        <td>${action.user_id || 'N/A'}</td>
                        <td>${action.order_id || 'N/A'}</td>
                        <td>
                            <span style="display: inline-block; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                ${action.action_note || 'N/A'}
                            </span>
                        </td>
                        <td>${formattedDate}</td>
                    `;
                    
                    actionsTableBody.appendChild(row);
                });
            }
            
            // Render pagination controls
            function renderPagination(paginationData) {
                if (!paginationData) return;
                
                const { total_pages, current_page, has_prev, has_next } = paginationData;
                pagination.innerHTML = '';
                
                // Previous button
                const prevButton = document.createElement('button');
                prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
                prevButton.disabled = !has_prev;
                if (has_prev) {
                    prevButton.addEventListener('click', () => goToPage(current_page - 1));
                }
                pagination.appendChild(prevButton);
                
                // Page numbers
                const maxVisiblePages = 5;
                let startPage = Math.max(1, current_page - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(total_pages, startPage + maxVisiblePages - 1);
                
                // Adjust start page if needed
                if (endPage - startPage + 1 < maxVisiblePages && startPage > 1) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }
                
                // First page if not visible
                if (startPage > 1) {
                    const firstPageBtn = document.createElement('button');
                    firstPageBtn.textContent = '1';
                    firstPageBtn.addEventListener('click', () => goToPage(1));
                    pagination.appendChild(firstPageBtn);
                    
                    if (startPage > 2) {
                        const ellipsis = document.createElement('button');
                        ellipsis.textContent = '...';
                        ellipsis.disabled = true;
                        pagination.appendChild(ellipsis);
                    }
                }
                
                // Page buttons
                for (let i = startPage; i <= endPage; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    pageButton.classList.toggle('active', i === current_page);
                    pageButton.addEventListener('click', () => goToPage(i));
                    pagination.appendChild(pageButton);
                }
                
                // Last page if not visible
                if (endPage < total_pages) {
                    if (endPage < total_pages - 1) {
                        const ellipsis = document.createElement('button');
                        ellipsis.textContent = '...';
                        ellipsis.disabled = true;
                        pagination.appendChild(ellipsis);
                    }
                    
                    const lastPageBtn = document.createElement('button');
                    lastPageBtn.textContent = total_pages;
                    lastPageBtn.addEventListener('click', () => goToPage(total_pages));
                    pagination.appendChild(lastPageBtn);
                }
                
                // Next button
                const nextButton = document.createElement('button');
                nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
                nextButton.disabled = !has_next;
                if (has_next) {
                    nextButton.addEventListener('click', () => goToPage(current_page + 1));
                }
                pagination.appendChild(nextButton);
            }
            
            // Go to specific page
            function goToPage(page) {
                currentPage = page;
                loadActionsData();
            }
            
            // Update pagination info text
            function updatePaginationInfo(paginationData) {
                if (!paginationData) return;
                
                const { total_records, current_page, per_page } = paginationData;
                const from = total_records === 0 ? 0 : (current_page - 1) * per_page + 1;
                const to = Math.min(from + per_page - 1, total_records);
                
                showingFrom.textContent = from;
                showingTo.textContent = to;
                totalRecords.textContent = total_records;
            }
            
            // Show action details in modal
            function showActionDetails(actionData) {
                modalActionId.textContent = actionData.actionId || 'N/A';
                modalActionType.textContent = actionData.actionType || 'N/A';
                modalAdminId.textContent = actionData.adminId || 'N/A';
                modalUserId.textContent = actionData.userId || 'N/A';
                modalOrderId.textContent = actionData.orderId || 'N/A';
                modalCreatedAt.textContent = actionData.createdAt || 'N/A';
                modalActionNote.textContent = actionData.actionNote || 'N/A';
                
                actionDetailModal.style.display = 'block';
            }
            
            // Export data
            function exportData(format) {
                const params = new URLSearchParams({
                    format: format,
                    sort_by: currentSortBy,
                    order_dir: currentSortDir,
                    ...currentFilters
                });
                
                window.location.href = `/api/actions/export?${params.toString()}`;
            }
            
            // Helper functions for UI states
            function showLoading() {
                loadingIndicator.style.display = 'block';
                actionsTable.style.display = 'none';
                noResults.style.display = 'none';
                errorMessage.style.display = 'none';
            }
            
            function hideLoading() {
                loadingIndicator.style.display = 'none';
            }
        });
    </script>
</body>

</html>