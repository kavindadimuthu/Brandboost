<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Gigs | BrandBoost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5e72e4;
            --primary-dark: #4454c3;
            --secondary: #7c44f1;
            --white: #ffffff;
            --light-bg: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --danger: #f5365c;
            --success: #2dce89;
            --warning: #fb6340;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--gray-700);
            line-height: 1.5;
        }

        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 40px 0;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero-content {
            text-align: left;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-content {
            margin-top: -30px;
            position: relative;
            z-index: 1;
        }

        .orders-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 40px;
            transition: var(--transition);
        }

        .orders-container h2 {
            font-size: 1.3rem;
            color: var(--gray-700);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .orders-container h2 i {
            margin-right: 10px;
            color: var(--primary);
        }

        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .orders-table th {
            text-align: left;
            padding: 16px;
            background: var(--gray-100);
            color: var(--gray-700);
            font-weight: 600;
            font-size: 0.9rem;
            border-bottom: 2px solid var(--gray-200);
        }

        .orders-table td {
            text-align: left;
            padding: 16px;
            border-bottom: 1px solid var(--gray-200);
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .orders-table tr:hover td {
            background-color: var(--gray-100);
        }

        .gig-title-cell {
            display: flex;
            align-items: center;
            transition: transform 0.2s ease;
            gap: 15px;
        }
        
        .gig-title-cell:hover {
            transform: scale(1.01);
        }

        .gig-thumb {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .gig-title {
            font-weight: 600;
            color: var(--gray-700);
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background-color: rgba(45, 206, 137, 0.1);
            color: var(--success);
        }

        .status-pending {
            background-color: rgba(251, 99, 64, 0.1);
            color: var(--warning);
        }

        .status-paused {
            background-color: rgba(245, 54, 92, 0.1);
            color: var(--danger);
        }

        .price-column {
            font-weight: 600;
            color: var(--gray-700);
        }

        .date-column {
            color: var(--gray-500);
            font-size: 0.85rem;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            color: var(--gray-500);
        }

        .edit-btn:hover {
            background-color: rgba(94, 114, 228, 0.1);
            color: var(--primary);
        }

        .delete-btn:hover {
            background-color: rgba(245, 54, 92, 0.1);
            color: var(--danger);
        }

        .view-btn:hover {
            background-color: rgba(45, 206, 137, 0.1);
            color: var(--success);
        }

        .create-btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 12px 25px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(94, 114, 228, 0.3);
        }

        .create-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(94, 114, 228, 0.4);
        }

        .create-btn i {
            font-size: 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 50px 0;
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: var(--gray-600);
            margin-bottom: 15px;
        }

        .empty-state p {
            color: var(--gray-500);
            margin-bottom: 25px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Modal Styles */
        .modal {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: var(--white);
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            max-width: 450px;
            width: 90%;
            position: relative;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .modal.show .modal-content {
            transform: translateY(0);
        }

        .modal-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: rgba(245, 54, 92, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }

        .modal-icon i {
            font-size: 30px;
            color: var(--danger);
        }

        .modal-content h3 {
            margin-bottom: 15px;
            color: var(--gray-700);
            font-size: 1.3rem;
        }

        .modal-content p {
            margin: 0 0 30px;
            font-size: 1rem;
            color: var(--gray-500);
            line-height: 1.6;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .modal-btn {
            padding: 12px 25px;
            border-radius: var(--border-radius);
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .confirm-btn {
            background: var(--danger);
            color: var(--white);
        }

        .confirm-btn:hover {
            background: #e02955;
            box-shadow: 0 4px 15px rgba(245, 54, 92, 0.3);
        }

        .cancel-btn {
            background: var(--gray-100);
            color: var(--gray-700);
        }

        .cancel-btn:hover {
            background: var(--gray-200);
        }

        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .hero {
                padding: 30px 0;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }

            .orders-container {
                padding: 20px 15px;
                overflow-x: auto;
            }
            
            .orders-table {
                min-width: 800px;
            }
            
            .orders-table th, 
            .orders-table td {
                padding: 12px;
            }

            .action-buttons {
                flex-direction: row;
            }
            
        }

        @media (max-width: 480px) {
            .hero-container {
                padding: 0 15px;
            }
            
            .container {
                padding: 0 15px;
            }
            
            .modal-content {
                padding: 30px 20px;
            }
            
            .modal-buttons {
                flex-direction: column;
            }
        }

        .search-filters {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
            position: relative;
        }

        .search-input input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            color: var(--gray-700);
            transition: var(--transition);
            background-color: var(--white);
        }

        .search-input input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
        }

        .search-input i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }
    </style>
</head>

<body>
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1><i class="fas fa-briefcase"></i> My Gigs</h1>
                <p>Manage and track all your gigs in one place.</p>
            </div>
            <button class="create-btn" onclick="window.location.href='/designer/add-gig'">
                <i class="fas fa-plus"></i> Create New Gig
            </button>
        </div>
    </div>

    <div class="container page-content">
        <div class="orders-container">
            <div class="search-filters">
                <div class="search-input">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchGigs" placeholder="Search gigs...">
                </div>
            </div>

            <table class="orders-table" id="gigs-table">
                <thead>
                    <tr>
                        <th>Gig</th>
                        <th>Basic Price (LKR)</th>
                        <th>Premium Price (LKR)</th>
                        <th>Updated</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                    <!-- Empty state placeholder, will be replaced by JS -->
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-spinner fa-spin"></i>
                                <h3>Loading your gigs...</h3>
                                <p>Please wait while we fetch your gig data.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h3>Delete Gig</h3>
            <p>Are you sure you want to delete this gig? This action cannot be undone.</p>
            <div class="modal-buttons">
                <button id="cancelDelete" class="modal-btn cancel-btn">Cancel</button>
                <button id="confirmDelete" class="modal-btn confirm-btn">Yes, Delete</button>
            </div>
        </div>
    </div>

    <script>
        let selectedGigId = null;
        let allGigs = [];

        document.addEventListener('DOMContentLoaded', async () => {
            await fetchGigs();
            
            // Add event listener for search
            document.getElementById('searchGigs').addEventListener('input', filterGigs);
        });

        async function fetchGigs() {
            try {
                const queryParams = new URLSearchParams({
                    current_user: true
                });

                const response = await fetch(`/api/services?${queryParams}`);
                const result = await response.json();

                allGigs = result.services || [];
                
                // Render gigs
                renderGigs(allGigs);
                
                console.log('Gigs loaded:', allGigs);
            } catch (error) {
                console.error('Error fetching gigs:', error);
                
                // Show error state
                const tableBody = document.getElementById('ordersTableBody');
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-exclamation-circle"></i>
                                <h3>Couldn't load gigs</h3>
                                <p>An error occurred while loading your gigs. Please try refreshing the page.</p>
                            </div>
                        </td>
                    </tr>
                `;
            }
        }

        function renderGigs(gigs) {
            const tableBody = document.getElementById('ordersTableBody');
            tableBody.innerHTML = ''; // Clear existing table content

            if (gigs.length > 0) {
                gigs.forEach(gig => {
                    // Find packages
                    const basicPackage = gig.packages.find(pkg => pkg.package_type === 'basic');
                    const premiumPackage = gig.packages.find(pkg => pkg.package_type === 'premium');
                    
                    // Format status
                    const status = gig.status || 'Active';
                    const statusClass = 
                        status.toLowerCase() === 'active' ? 'status-active' : 
                        status.toLowerCase() === 'pending' ? 'status-pending' : 
                        'status-paused';

                    const row = document.createElement('tr');

                    // Dynamically populate the table row
                    row.innerHTML = `
                        <td>
                            <div class="gig-title-cell" onclick="window.location.href='/services/${gig.service_id}'" style="cursor: pointer;">
                                <img src="${gig.cover_image}" class="gig-thumb" alt="${gig.title}">
                                <span class="gig-title">${gig.title}</span>
                            </div>
                        </td>
                        <td class="price-column">${basicPackage ? basicPackage.price : 'N/A'}</td>
                        <td class="price-column">${premiumPackage ? premiumPackage.price : 'N/A'}</td>
                        <td class="date-column">${formatDate(gig.updated_at)}</td>
                        <td class="date-column">${formatDate(gig.created_at)}</td>
                        <td><span class="status-badge ${statusClass}">${status}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button onclick="window.location.href='/designer/edit-gig/${gig.service_id}'" class="action-btn edit-btn" title="Edit Gig">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="confirmDelete(${gig.service_id})" class="action-btn delete-btn" title="Delete Gig">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    `;

                    // Append the new row to the table
                    tableBody.appendChild(row);
                });
            } else {
                // If no gigs are found, show a message
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-clipboard-list"></i>
                                <h3>No gigs found</h3>
                                <p>You haven't created any gigs yet. Get started by creating your first gig.</p>
                                <button class="create-btn" onclick="window.location.href='/designer/add-gig'">
                                    <i class="fas fa-plus"></i> Create Your First Gig
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
        }

        function filterGigs(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            if (!searchTerm) {
                renderGigs(allGigs);
                return;
            }
            
            const filteredGigs = allGigs.filter(gig => 
                gig.title.toLowerCase().includes(searchTerm)
            );
            
            renderGigs(filteredGigs);
        }

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

        function confirmDelete(serviceId) {
            selectedGigId = serviceId;
            console.log('Selected Gig ID:', selectedGigId);

            document.getElementById('deleteModal').classList.add('show');
        }

        async function deleteGig() {
            if (selectedGigId !== null) {
                console.log('Deleting Gig ID:', selectedGigId);

                try {
                    const response = await fetch(`/api/delete-gig/${selectedGigId}`, {
                        method: 'GET'
                    });

                    console.log(response);

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Failed to delete gig.');
                    }
                } catch (error) {
                    console.error('Error deleting gig:', error);
                } finally {
                    selectedGigId = null; // Reset selected gig ID
                    document.getElementById('deleteModal').classList.remove('show');
                }
            }
        }

        // Add event listeners to the confirm and cancel buttons
        document.getElementById('confirmDelete').addEventListener('click', deleteGig);
        document.getElementById('cancelDelete').addEventListener('click', () => {
            selectedGigId = null;
            document.getElementById('deleteModal').classList.remove('show');
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
                selectedGigId = null;
            }
        });
    </script>
</body>

</html>