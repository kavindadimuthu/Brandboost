<html>

<head>
    <title>
        Verifications
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
            /* Reduced gap between header and breadcrumb */
        }

        .header .breadcrumb {
            font-size: 14px;
            color: #333;
            /* Make breadcrumb font color visible */
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
            /* Add curvature */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Add gap between sidebar and main content */
            color: #333;
        }

        .main-content h2,
        .main-content p,
        .main-content th,
        .main-content td {
            color: #666;
            /* Grey color for text */
            font-size: 14px;
            /* Smaller font size for elegant look */
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
            /* Larger font size for header */
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
            /* Add curvature */
        }

        .main-content .search-bar button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            /* Add curvature */
            cursor: pointer;
            margin-left: 8px;
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

        .badge.verified {
            background-color: #28a745;
        }

        .badge.rejected {
            background-color: #dc3545;
        }

        .badge.pending {
            background-color: #6c757d;
        }

        /* Action buttons Styles.......... */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .action-buttons .approve-btn {
            background-color: #28a745;
        }

        .action-buttons .reject-btn {
            background-color: #dc3545;
        }

        .action-buttons .view-btn {
            background-color: #007bff;
        }

        /* Loading indicator */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #6a11cb;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Error message */
        .error-message {
            color: #dc3545;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="breadcrumb">Admin portal &gt; Verification requests</div>
                <div class="user-info">
                    <img alt="User profile picture" height="30"
                        src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
                        width="30" />
                    <span><?php echo $_SESSION['user']['username']; ?></span>
                </div>
            </div>
            <h2>Verifications</h2>
            <p>Manage verification requests for businesses and influencers.</p>
            <div class="search-bar">
                <input id="searchInput" placeholder="Search by name or type..." type="text" />
                <div>
                    <button id="filterButton">Filters</button>
                    <button id="searchButton">Search</button>
                </div>
            </div>
            <div id="tableContainer">
                <div class="loading">
                    <div class="loading-spinner"></div>
                </div>
            </div>
            <div id="paginationContainer" class="pagination">
                <!-- Pagination will be added here dynamically -->
            </div>
        </div>
    </div>

    <script>
        // Current state
        let currentPage = 1;
        let searchQuery = '';
        let currentFilters = {};
        
        // Default profile image if none is available
        const defaultProfileImage = "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg";
        
        // Main function to load verification data
        function loadVerificationData() {
            const tableContainer = document.getElementById('tableContainer');
            tableContainer.innerHTML = `<div class="loading"><div class="loading-spinner"></div></div>`;
            
            // Build the query parameters
            let queryParams = `page=${currentPage}`;
            if (searchQuery) {
                queryParams += `&search=${encodeURIComponent(searchQuery)}`;
            }
            
            // Add any filters
            Object.keys(currentFilters).forEach(key => {
                if (currentFilters[key]) {
                    queryParams += `&${key}=${encodeURIComponent(currentFilters[key])}`;
                }
            });

            console.log('Fetching verification data with query params:', queryParams);
            
            // Make the API request
            fetch(`/api/verifications?${queryParams}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.success) {
                        throw new Error(data.error || 'Failed to fetch data');
                    }
                    
                    renderVerificationTable(data.data);
                    renderPagination(data.pagination);
                })
                .catch(error => {
                    tableContainer.innerHTML = `<div class="error-message">
                        <p>Failed to load verification requests: ${error.message}</p>
                        <button onclick="loadVerificationData()">Try Again</button>
                    </div>`;
                    console.error('Error fetching verification data:', error);
                });
        }
        
        // Render the verification table with the data from API
        function renderVerificationTable(verifications) {
            const tableContainer = document.getElementById('tableContainer');
            
            if (!verifications || verifications.length === 0) {
                tableContainer.innerHTML = '<p>No verification requests found.</p>';
                return;
            }
            
            const tableHTML = `
                <table id="verificationTable">
                    <thead>
                        <tr>
                            <th>Verification Type</th>
                            <th>User</th>
                            <th>Business/Profile</th>
                            <th>BR/Platform</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${verifications.map(item => {
                            // Format the created_at date
                            const date = new Date(item.created_at);
                            const formattedDate = date.toLocaleString('en-US', { 
                                month: 'short', 
                                day: 'numeric', 
                                year: 'numeric' 
                            });
                            
                            // Determine the badge class based on status
                            let badgeClass;
                            if (item.status === 'verified') {
                                badgeClass = 'verified';
                            } else if (item.status === 'rejected') {
                                badgeClass = 'rejected';
                            } else {
                                badgeClass = 'pending';
                            }
                            
                            // Format the display type
                            const displayType = item.type === 'business' ? 'Business Registration' : 'Social media profile';
                            
                            return `
                                <tr data-id="${item.id}" data-type="${item.type}">
                                    <td>${displayType}</td>
                                    <td>
                                        <div class="user-info">
                                            <img alt="User profile picture" height="30" src="/${item.profile_picture}" width="30" />
                                            <span>${item.name}</span>
                                        </div>
                                    </td>
                                    <td>${item.display_name}</td>
                                    <td>${item.platform ? item.platform : item.identifier}</td>
                                    <td>${formattedDate}</td>
                                    <td>
                                        <span class="badge ${badgeClass}">
                                            ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            ${item.status === 'pending' ? `
                                                <button class="view-btn" onclick="viewDetails('${item.id}', '${item.type}')">View</button>
                                            ` : `
                                                <button class="view-btn" onclick="viewDetails('${item.id}', '${item.type}')">View</button>
                                            `}
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }).join('')}
                    </tbody>
                </table>
            `;
            
            tableContainer.innerHTML = tableHTML;
        }
        
        // Render pagination based on API response
        function renderPagination(pagination) {
            if (!pagination) return;
            
            const paginationContainer = document.getElementById('paginationContainer');
            let paginationHTML = '';
            
            // Previous button
            if (pagination.currentPage > 1) {
                paginationHTML += `<button onclick="goToPage(${pagination.currentPage - 1})">Previous</button>`;
            }
            
            // Page numbers
            for (let i = 1; i <= pagination.totalPages; i++) {
                if (
                    i === 1 || 
                    i === pagination.totalPages || 
                    (i >= pagination.currentPage - 2 && i <= pagination.currentPage + 2)
                ) {
                    paginationHTML += `<button class="${i === pagination.currentPage ? 'active' : ''}" 
                                       onclick="goToPage(${i})">${i}</button>`;
                } else if (
                    i === pagination.currentPage - 3 || 
                    i === pagination.currentPage + 3
                ) {
                    paginationHTML += `<button>...</button>`;
                }
            }
            
            // Next button
            if (pagination.currentPage < pagination.totalPages) {
                paginationHTML += `<button onclick="goToPage(${pagination.currentPage + 1})">Next</button>`;
            }
            
            paginationContainer.innerHTML = paginationHTML;
        }
        
        // Function to change page
        function goToPage(page) {
            currentPage = page;
            loadVerificationData();
        }
        
        // Function to update verification status
        function updateStatus(id, type, status) {
            // Show a loading indicator
            const tableContainer = document.getElementById('tableContainer');
            tableContainer.innerHTML = `<div class="loading"><div class="loading-spinner"></div></div>`;
            
            fetch('/api/update-verification-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: id,
                    type: type,
                    status: status
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Reload the data to show the updated status
                    loadVerificationData();
                } else {
                    throw new Error(data.error || 'Failed to update status');
                }
            })
            .catch(error => {
                tableContainer.innerHTML = `<div class="error-message">
                    <p>Failed to update status: ${error.message}</p>
                    <button onclick="loadVerificationData()">Reload Data</button>
                </div>`;
                console.error('Error updating verification status:', error);
            });
        }
        
        // Function to view verification details
        function viewDetails(id, type) {
            window.location.href = `/admin/verification-details/${type}/${id}`;
        }
        
        // Search functionality
        document.getElementById('searchButton').addEventListener('click', function() {
            searchQuery = document.getElementById('searchInput').value.trim();
            currentPage = 1; // Reset to first page when searching
            loadVerificationData();
        });
        
        // Search on Enter key
        document.getElementById('searchInput').addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                searchQuery = document.getElementById('searchInput').value.trim();
                currentPage = 1;
                loadVerificationData();
            }
        });
        
        // Filter functionality (simplified for now)
        document.getElementById('filterButton').addEventListener('click', function() {
            const filterType = prompt('Filter by type (business/social_media):');
            if (filterType) {
                currentFilters.type = filterType;
                currentPage = 1;
                loadVerificationData();
            }
        });
        
        // Load verification data when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadVerificationData();
        });
    </script>
</body>

</html>