<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Custom Package Requests - Brandboost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5e72e4;
            --primary-dark: #4454c3;
            --primary-light: #edf2ff;
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
            --success: #2dce89;
            --warning: #fb6340;
            --danger: #f5365c;
            --pending: #6b7280;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--gray-700);
            line-height: 1.5;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 80px 0;
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .hero-left {
            flex: 9;
        }

        .hero-right {
            flex: 7;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: flex-end;
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
            margin-top: 5px;
        }

        .hero-stat {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 15px 20px;
            min-width: 140px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .hero-stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .hero-stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: -30px auto 40px;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            padding: 5px;
            overflow: hidden;
        }

        .filter-tab {
            flex: 1;
            text-align: center;
            padding: 15px;
            cursor: pointer;
            font-weight: 600;
            color: var(--gray-600);
            transition: var(--transition);
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }

        .filter-tab.active {
            color: var(--primary);
            background: var(--primary-light);
        }

        .filter-tab:hover:not(.active) {
            background: var(--gray-100);
        }

        .filter-tab .count {
            display: inline-block;
            padding: 2px 8px;
            background: var(--gray-200);
            border-radius: 20px;
            font-size: 0.8rem;
            margin-left: 8px;
            min-width: 24px;
        }

        .filter-tab.active .count {
            background: var(--primary);
            color: white;
        }

        /* Requests Grid */
        .requests-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .request-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid var(--gray-200);
        }

        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }

        .request-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 1px solid var(--gray-200);
        }

        .request-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--gray-700);
            margin: 0;
        }

        .request-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: rgba(251, 99, 64, 0.1);
            color: var(--warning);
        }

        .status-accepted {
            background-color: rgba(45, 206, 137, 0.1);
            color: var(--success);
        }

        .status-rejected {
            background-color: rgba(245, 54, 92, 0.1);
            color: var(--danger);
        }

        .request-body {
            padding: 20px;
            display: flex;
        }

        .request-main {
            flex: 1;
        }

        .request-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
            color: var(--gray-500);
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-item i {
            color: var(--primary);
        }

        .request-description {
            color: var(--gray-600);
            line-height: 1.6;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .request-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 15px;
        }

        .tag {
            display: inline-block;
            padding: 5px 10px;
            background-color: var(--gray-100);
            color: var(--gray-600);
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .request-side {
            width: 250px;
            padding-left: 20px;
            margin-left: 20px;
            border-left: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .price-label {
            color: var(--gray-500);
            font-size: 0.9rem;
            margin-bottom: 5px;
            text-align: center;
        }

        .request-price {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            text-align: center;
        }

        .request-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
            width: 100%;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 10px rgba(94, 114, 228, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(94, 114, 228, 0.4);
        }

        .btn-danger {
            background: white;
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .btn-danger:hover {
            background: var(--danger);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--gray-300);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--gray-700);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--gray-500);
            margin-bottom: 25px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Error Message */
        .error-message {
            background: rgba(245, 54, 92, 0.1);
            color: var(--danger);
            padding: 20px;
            border-radius: var(--border-radius);
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* Loading Spinner */
        .loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 30px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(94, 114, 228, 0.1);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-content {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-right {
                justify-content: flex-start;
                width: 100%;
            }

            .request-body {
                flex-direction: column;
            }

            .request-side {
                width: 100%;
                padding-left: 0;
                margin-left: 0;
                margin-top: 20px;
                padding-top: 20px;
                border-left: none;
                border-top: 1px solid var(--gray-200);
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
            }

            .price-container {
                margin-bottom: 0;
            }

            .request-actions {
                flex-direction: row;
                width: auto;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero-stat {
                min-width: 120px;
                padding: 12px 15px;
            }

            .hero-stat-number {
                font-size: 1.5rem;
            }

            .filter-tabs {
                flex-wrap: wrap;
            }

            .filter-tab {
                flex: none;
                width: calc(33.333% - 4px);
            }

            .request-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .request-side {
                flex-direction: column;
                align-items: flex-start;
            }

            .request-actions {
                width: 100%;
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .hero-content {
                gap: 20px;
            }

            .hero-right {
                flex-wrap: wrap;
                gap: 10px;
            }

            .hero-stat {
                flex: 1;
                min-width: 100px;
            }

            .filter-tab {
                width: 100%;
                margin-bottom: 5px;
            }

            .request-meta {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-left">
                    <h1><i class="fas fa-bullhorn"></i> Custom Package Requests</h1>
                    <p>Track the status of your custom promotion requests sent to influencers.</p>
                </div>
                <div class="hero-right">
                    <div class="hero-stat">
                        <div class="hero-stat-number" id="totalRequests">0</div>
                        <div class="hero-stat-label">Total</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number" id="pendingRequests">0</div>
                        <div class="hero-stat-label">Pending</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number" id="acceptedRequests">0</div>
                        <div class="hero-stat-label">Accepted</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <div class="filter-tab active" data-filter="all">
                All Requests <span class="count" id="allCount">0</span>
            </div>
            <div class="filter-tab" data-filter="pending">
                Pending <span class="count" id="pendingCount">0</span>
            </div>
            <div class="filter-tab" data-filter="accepted">
                Accepted <span class="count" id="acceptedCount">0</span>
            </div>
        </div>

        <!-- Requests Container -->
        <div id="requestsContainer" class="requests-grid">
            <!-- Loading state shown initially -->
            <div class="loading">
                <div class="spinner"></div>
                <p>Loading your custom package requests...</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Get elements
            const requestsContainer = document.getElementById('requestsContainer');
            const filterTabs = document.querySelectorAll('.filter-tab');
            
            let allRequests = [];
            let currentFilter = 'all';
            
            // Initialize tabs
            filterTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Update active tab
                    filterTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    
                    // Get filter and apply
                    currentFilter = tab.dataset.filter;
                    filterAndDisplayRequests();
                });
            });
            
            // Function to filter and display requests
            function filterAndDisplayRequests() {
                let filteredRequests = [...allRequests];
                
                // Apply status filter if not 'all'
                if (currentFilter !== 'all') {
                    filteredRequests = filteredRequests.filter(request => 
                        request.status?.toLowerCase() === currentFilter
                    );
                }
                
                renderRequests(filteredRequests);
            }
            
            // Function to update stats
            function updateStats() {
                const pendingCount = allRequests.filter(r => r.status === 'pending' || !r.status).length;
                const acceptedCount = allRequests.filter(r => r.status === 'accepted').length;
                
                // Update hero stats
                document.getElementById('totalRequests').textContent = allRequests.length;
                document.getElementById('pendingRequests').textContent = pendingCount;
                document.getElementById('acceptedRequests').textContent = acceptedCount;
                
                // Update tab counts
                document.getElementById('allCount').textContent = allRequests.length;
                document.getElementById('pendingCount').textContent = pendingCount;
                document.getElementById('acceptedCount').textContent = acceptedCount;
            }
            
            // Function to render requests
            function renderRequests(requests) {
                // Check if requests exist
                if (!requests || requests.length === 0) {
                    requestsContainer.innerHTML = `
                    <div class="empty-state fade-in">
                        <div class="empty-state-icon"><i class="fas fa-clipboard"></i></div>
                        <h3>No custom package requests found</h3>
                        <p>You haven't created any custom package requests that match your current filter. Create a new request to get started.</p>
                        <a href="/businessman/create-custom-request" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create New Request
                        </a>
                    </div>
                    `;
                    return;
                }
                
                // Map requests to HTML and render them
                requestsContainer.innerHTML = requests.map((request, index) => {
                    const date = new Date(request.created_at);
                    const formattedDate = date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
                    
                    const statusDisplay = request.status ? request.status : 'pending';
                    
                    // Extract a few keywords from benefits for tags
                    const benefits = request.benefits_requested || '';
                    const keywords = benefits.split(' ')
                        .filter(word => word.length > 5)
                        .slice(0, 3)
                        .map(word => word.replace(/[^a-zA-Z]/g, ''));
                    
                    // Only show buttons for accepted requests
                    const actionButtons = statusDisplay === 'accepted' ? `
                        <div class="request-actions">
                            <a href="/businessman/place-order?request_id=${request.custom_package_id}" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Place Order
                            </a>
                            <button class="btn btn-danger" onclick="rejectRequest(${request.custom_package_id})">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    ` : '';
                    
                    return `
                    <div class="request-card fade-in" style="animation-delay: ${index * 0.1}s">
                        <div class="request-header">
                            <h3 class="request-title">${request.service_title}</h3>
                            <div class="request-status status-${statusDisplay}">
                                <i class="fas fa-${statusDisplay === 'accepted' ? 'check-circle' : statusDisplay === 'rejected' ? 'times-circle' : 'clock'}"></i> 
                                ${statusDisplay.charAt(0).toUpperCase() + statusDisplay.slice(1)}
                            </div>
                        </div>
                        <div class="request-body">
                            <div class="request-main">
                                <div class="request-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Requested: ${formattedDate}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Delivery: ${request.delivery_days_requested} days</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-hashtag"></i>
                                        <span>ID: ${request.custom_package_id}</span>
                                    </div>
                                </div>
                                
                                <p class="request-description">${request.benefits_requested}</p>
                                
                                <div class="request-tags">
                                    ${keywords.map(keyword => `<span class="tag">${keyword}</span>`).join('')}
                                    <span class="tag"><i class="fas fa-tag"></i> Custom</span>
                                </div>
                            </div>
                            
                            <div class="request-side">
                                <div class="price-container">
                                    <div class="price-label">Requested Budget</div>
                                    <div class="request-price">LKR ${Number(request.price_requested).toLocaleString()}</div>
                                </div>
                                
                                ${actionButtons}
                            </div>
                        </div>
                    </div>
                    `;
                }).join('');
            }
            
            // Fetch data
            try {
                // Show loading state
                requestsContainer.innerHTML = `
                <div class="loading">
                    <div class="spinner"></div>
                    <p>Loading your custom package requests...</p>
                </div>
                `;
                
                const response = await fetch('/api/custom-packages');
                const data = await response.json();
                
                console.log("Data fetched successfully:", data);
                
                allRequests = data;
                updateStats();
                filterAndDisplayRequests();
                
            } catch (error) {
                console.error("Error fetching data:", error);
                requestsContainer.innerHTML = `
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <p>Unable to load your package requests. Please try again later.</p>
                </div>
                `;
            }
        });
        
        // Function to reject/cancel a request
        function rejectRequest(requestId) {
            if (confirm("Are you sure you want to cancel this custom package request?")) {
                // TODO: Implement API call to cancel the request
                console.log(`Cancelling request with ID: ${requestId}`);
                
                // Show feedback and reload
                alert("Request cancelled successfully!");
                location.reload();
            }
        }
    </script>
</body>
</html>