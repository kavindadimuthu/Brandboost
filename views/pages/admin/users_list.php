<html>

<head>
    <title>
        User Management
    </title>
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
        .main-content p,
        .main-content th,
        .main-content td {
            color: #666;
            font-size: 14px;
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
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
        }

        .main-content table th {
            background-color: #f9f9f9;
        }

        .user-id-column {
            display: none;
        }

        .main-content table td img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .main-content table td .user-info {
            display: flex;
            align-items: center;
        }

        .main-content table td .user-info img {
            margin-right: 10px;
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

        .badge.active {
            background-color: #28a745;
        }

        .badge.inactive {
            background-color: #ffc107;
            color: #212529;
        }

        .badge.blocked {
            background-color:rgb(205, 109, 30);
        }
        .badge.banned {
            background-color: #dc3545;
        }

        .badge.verified {
            background-color: #28a745;
        }

        .badge.unverified {
            background-color: #6c757d;
        }

        .badge.pending {
            background-color: #17a2b8;
        }

        /* Action buttons Styles */
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
            background-color: #634ce1;
        }

        .action-buttons .delete-btn {
            background-color: #dc3545;
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

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-details .email {
            color: #888;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">Sisyphus Ventures &gt; User management</div>
                <div class="user-info">
                    <img alt="User profile picture" height="30"
                        src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
                        width="30" />
                    <span><?php echo $_SESSION['user']['username'] ?? 'Admin'; ?></span>
                </div>
            </div>
            <h2>User management</h2>
            <p>
                Manage your team members and their account permissions here.
            </p>
            <div class="search-bar">
                <input id="searchInput" placeholder="Search by name or email" type="text" />
                <div class="filter-container">
                    <select id="roleFilter">
                        <option value="">All Roles</option>
                        <option value="businessman">Businessman</option>
                        <option value="influencer">Influencer</option>
                        <option value="designer">Designer</option>
                    </select>
                    <select id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="suspended">Suspended</option>
                    </select>
                    <button id="searchButton">Search</button>
                </div>
            </div>
            <div id="loadingIndicator" class="loading-indicator">Loading users...</div>
            <table id="usersTable" style="display: none;">
                <thead>
                    <tr>
                        <th class="user-id-column">User ID</th>
                        <th>User name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Verification</th>
                        <th>Last active</th>
                        <th>Date added</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <div id="noResults" class="no-results" style="display: none;">No users found matching your criteria.</div>
            <div class="pagination" id="pagination">
                <!-- Pagination buttons will be generated here -->
            </div>
        </div>
    </div>

    <script>
        // State management
        let users = [];
        let currentPage = 1;
        let itemsPerPage = 10;
        let totalPages = 1;
        let currentFilters = {
            search: '',
            role: '',
            status: '',
            limit: itemsPerPage,
            offset: 0,
            sort_by: 'created_at',
            order_dir: 'desc'
        };

        // Dom elements
        const searchInput = document.getElementById('searchInput');
        const roleFilter = document.getElementById('roleFilter');
        const statusFilter = document.getElementById('statusFilter');
        const searchButton = document.getElementById('searchButton');
        const usersTable = document.getElementById('usersTable');
        const tableBody = document.querySelector('#usersTable tbody');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const noResults = document.getElementById('noResults');
        const pagination = document.getElementById('pagination');

        // Helper functions to format dates
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString;
            return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
        }

        // Fetch users from API with filters
        async function fetchUsers() {
            loadingIndicator.style.display = 'block';
            usersTable.style.display = 'none';
            noResults.style.display = 'none';

            // Build query string from filters
            const queryParams = new URLSearchParams();
            for (const [key, value] of Object.entries(currentFilters)) {
                if (value !== '') {
                    queryParams.append(key, value);
                }
            }

            try {
                const response = await fetch(`/api/users?${queryParams.toString()}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const result = await response.json();
                console.log(result);

                users = result.users || [];
                
                // Show appropriate UI based on results
                if (users.length === 0) {
                    usersTable.style.display = 'none';
                    noResults.style.display = 'block';
                } else {
                    usersTable.style.display = 'table';
                    noResults.style.display = 'none';
                    renderUsers(users);
                }

                // Calculate pagination
                const totalItems = result.pagination.total_users; // In a real app, this would come from the API
                totalPages = Math.ceil(totalItems / itemsPerPage);
                renderPagination();

            } catch (error) {
                console.error('Error fetching users:', error);
                noResults.textContent = 'Error loading users. Please try again.';
                noResults.style.display = 'block';
            } finally {
                loadingIndicator.style.display = 'none';
            }
        }

        // Render users in the table
        function renderUsers(users) {
            tableBody.innerHTML = '';

            users.forEach(function(user) {
                const row = document.createElement('tr');
                row.dataset.userId = user.user_id;
                
                // Default profile picture if none is set
                const profilePic = user.profile_picture || '/cdn_uploads/users/dp/dp-empty.png';

                row.innerHTML = `
                    <td class="user-id-column">${user.user_id}</td>
                    <td>
                        <div class="user-info">
                            <img alt="User profile picture" src="${profilePic}" width="30" height="30" />
                            <div class="user-details">
                                <span>${user.name}</span>
                                <span class="email">${user.email}</span>
                            </div>
                        </div>
                    </td>
                    <td>${capitalizeFirstLetter(user.role)}</td>
                    <td>
                        <span class="badge ${user.account_status.toLowerCase()}">
                            ${capitalizeFirstLetter(user.account_status)}
                        </span>
                    </td>
                    <td>
                        <span class="badge ${user.verification_status.toLowerCase()}">
                            ${capitalizeFirstLetter(user.verification_status)}
                        </span>
                    </td>
                    <td>${formatDate(user.updated_at)}</td>
                    <td>${formatDate(user.created_at)}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="view-btn" data-id="${user.user_id}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="delete-btn" data-id="${user.user_id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Add event listeners for action buttons
            setupActionButtons();
        }

        // Capitalize the first letter of a string
        function capitalizeFirstLetter(string) {
            if (!string) return '';
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        // Set up action buttons
        function setupActionButtons() {
            // Edit button event handlers
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', event => {
                    event.stopPropagation();
                    const userId = button.dataset.id;
                    window.location.href = `/admin/user-profile/${userId}`;
                });
            });

            // Delete button event handlers
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', event => {
                    event.stopPropagation();
                    const userId = button.dataset.id;
                    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                        deleteUser(userId);
                    }
                });
            });
        }

        // Delete a user
        async function deleteUser(userId) {
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
            }
        }

        // Render pagination controls
        function renderPagination() {
            pagination.innerHTML = '';
            
            // Previous button
            const prevButton = document.createElement('button');
            prevButton.innerHTML = '<i class="fas fa-chevron-left"></i>';
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    goToPage(currentPage - 1);
                }
            });
            pagination.appendChild(prevButton);
            
            // Page buttons
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, startPage + 4);
            
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.classList.toggle('active', i === currentPage);
                pageButton.addEventListener('click', () => goToPage(i));
                pagination.appendChild(pageButton);
            }
            
            // Next button
            const nextButton = document.createElement('button');
            nextButton.innerHTML = '<i class="fas fa-chevron-right"></i>';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    goToPage(currentPage + 1);
                }
            });
            pagination.appendChild(nextButton);
        }

        // Go to a specific page
        function goToPage(page) {
            currentPage = page;
            currentFilters.offset = (page - 1) * itemsPerPage;
            fetchUsers();
        }

        // Event listener for row clicks to navigate to user profile
        tableBody.addEventListener('click', function(event) {
            const row = event.target.closest('tr');
            if (row && !event.target.closest('.action-buttons')) {
                const userId = row.dataset.userId;
                window.location.href = '/admin/user-profile/' + userId;
            }
        });

        // Event listener for search button
        searchButton.addEventListener('click', function() {
            currentFilters.search = searchInput.value.trim();
            currentFilters.role = roleFilter.value;
            currentFilters.status = statusFilter.value;
            currentFilters.offset = 0; // Reset to first page
            currentPage = 1;
            fetchUsers();
        });

        // Event listener for search input (search on Enter key)
        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                searchButton.click();
            }
        });

        // Initial fetch of users when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            fetchUsers();
        });
    </script>
</body>

</html>