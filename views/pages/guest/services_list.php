<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Listings | BrandBoost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
            --accent-yellow: #ffc107;
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

        /* Main Container */
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

        /* Search and Filter Section */
        .search-filters-container {
            background-color: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .search-bar-wrapper {
            flex: 1;
            position: relative;
        }

        .search-bar {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-200);
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: var(--white);
        }

        .search-bar:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
        }

        .filter-select {
            padding: 12px 20px;
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-200);
            font-size: 0.95rem;
            background-color: var(--white);
            min-width: 150px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-position: right 10px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 40px;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
        }

        /* Results Info */
        .results-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        /* Service Card Grid */
        .service-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .service-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1);
        }

        .service-card a {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-image {
            position: relative;
            height: 180px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .service-card:hover .card-image img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 12px;
            border: 2px solid var(--gray-200);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .username {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--gray-700);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            background-color: var(--primary-light);
            color: var(--primary);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .verified-badge i {
            font-size: 0.7rem;
            margin-right: 3px;
        }

        .service-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: auto;
            line-height: 1.4;
        }

        .service-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--gray-200);
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 4px;
            color: var(--gray-600);
            font-size: 0.85rem;
        }

        .star {
            color: var(--accent-yellow);
        }

        .price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
        }

        /* Empty and Loading States */
        .empty-state, .loading-state {
            text-align: center;
            padding: 50px 0;
            background: var(--white);
            border-radius: var(--border-radius);
            margin: 20px 0;
            box-shadow: var(--box-shadow);
        }

        .empty-state i, .loading-state i {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 20px;
        }

        .spinner {
            display: inline-block;
            width: 3rem;
            height: 3rem;
            border: 3px solid rgba(94, 114, 228, 0.1);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .service-card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .search-filters-container {
                flex-direction: column;
                gap: 10px;
            }
            
            .filter-select, .search-bar {
                width: 100%;
            }
            
            .service-card-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .container, .hero-container {
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
                <h1><i class="fas fa-list"></i> Browse Services</h1>
                <p>Find talented professionals to bring your ideas to life with our collection of high-quality services</p>
            </div>
        </div>
    </div>

    <div class="container page-content">
        <!-- Search and Filters -->
        <div class="search-filters-container">
            <div class="search-bar-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input 
                    type="text" 
                    id="searchBar" 
                    class="search-bar" 
                    placeholder="Search for services..."
                >
            </div>
            
            <select id="serviceType" class="filter-select" onchange="handleServiceTypeChange()">
                <option value="gig">Gigs</option>
                <option value="promotion">Promotions</option>
            </select>
            
            <select id="sortOrder" class="filter-select" onchange="handleSortChange()">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="price_high">Price: High to Low</option>
                <option value="price_low">Price: Low to High</option>
            </select>
        </div>

        <!-- Results Count -->
        <div class="results-info" id="resultsInfo">
            <span>Showing all services</span>
        </div>

        <!-- Service Cards Grid -->
        <div id="serviceCardContainer" class="service-card-grid">
            <!-- Service cards will be dynamically inserted here -->
        </div>
    </div>

    <script>
        // State management
        let services = [];
        let filters = {
            type: 'gig',
            search: '',
            sort: 'newest'
        };

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Fetch services with filters
        async function fetchServices() {
            const container = document.getElementById('serviceCardContainer');
            container.innerHTML = `
                <div class="loading-state">
                    <div class="spinner"></div>
                    <p>Loading services...</p>
                </div>
            `;

            try {
                const queryParams = new URLSearchParams({
                    type: filters.type,
                    query: filters.search,
                    sort: filters.sort,
                    include_user: true
                });

                const response = await fetch(`/api/services?${queryParams}`);
                const result = await response.json();
                services = result.services;
                
                updateURL();
                updateUI();
            } catch (error) {
                console.error('Error fetching services:', error);
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-exclamation-circle"></i>
                        <h3>Error loading services</h3>
                        <p>Please try again later</p>
                    </div>
                `;
            }
        }

        // Update UI with filtered and sorted services
        function updateUI() {
            const container = document.getElementById('serviceCardContainer');
            const resultsInfo = document.getElementById('resultsInfo');

            if (services.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-search"></i>
                        <h3>No services found</h3>
                        <p>Try adjusting your search criteria</p>
                    </div>
                `;
                resultsInfo.innerHTML = '<span>No services found</span>';
                return;
            }

            // Update results info
            resultsInfo.innerHTML = `
                <span>Showing ${services.length} service${services.length === 1 ? '' : 's'}</span>
            `;

            // Render service cards
            container.innerHTML = services.map(service => {
                const basicPackage = service.packages.find(pkg => pkg.package_type === 'basic') || {};
                const price = basicPackage.price ? `LKR ${basicPackage.price.toLocaleString()}` : 'LKR 25,000';
                
                return `
                <div class="service-card">
                    <a href="/services/${service.service_id}">
                        <div class="card-image">
                            <img src="${service.cover_image || '/api/placeholder/400/225'}" 
                                alt="${service.title}"
                                onerror="this.onerror=null; this.src='/api/placeholder/400/225';">
                        </div>
                        <div class="card-content">
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img src="${service.user?.profile_picture || '/api/placeholder/40/40'}" 
                                        alt="${service.user?.name || `User ${service.user_id}`}"
                                        onerror="this.onerror=null; this.src='/api/placeholder/40/40';">
                                </div>
                                <div class="username">
                                    ${service.user?.name || `User ${service.user_id}`}
                                    ${service.is_verified ? '<span class="verified-badge"><i class="fas fa-check"></i>Verified</span>' : ''}
                                </div>
                            </div>
                            <h3 class="service-title">${service.title}</h3>
                            <div class="service-footer">
                                <div class="rating">
                                    <span class="star"><i class="fas fa-star"></i></span>
                                    <span>${service.rating || '5.0'}</span>
                                    <span>(${service.rating_count || '0'})</span>
                                </div>
                                <div class="price">${price}</div>
                            </div>
                        </div>
                    </a>
                </div>`;
            }).join('');
        }

        // Event Handlers
        function handleServiceTypeChange() {
            filters.type = document.getElementById('serviceType').value;
            fetchServices();
        }

        function handleSortChange() {
            filters.sort = document.getElementById('sortOrder').value;
            fetchServices();
        }

        // Debounced search handler
        const handleSearch = debounce(() => {
            filters.search = document.getElementById('searchBar').value;
            fetchServices();
        }, 500);

        // Update URL with current filters
        function updateURL() {
            const url = new URL(window.location);
            
            Object.entries(filters).forEach(([key, value]) => {
                if (value) {
                    url.searchParams.set(key, value);
                } else {
                    url.searchParams.delete(key);
                }
            });
            
            window.history.pushState({}, '', url);
        }

        // Initialize page
        function initializePage() {
            // Set up search input listener
            document.getElementById('searchBar').addEventListener('input', handleSearch);

            // Initialize filters from URL parameters if any
            const urlParams = new URLSearchParams(window.location.search);
            filters.type = urlParams.get('type') || 'gig';
            filters.search = urlParams.get('search') || '';
            filters.sort = urlParams.get('sort') || 'newest';

            // Set initial form values
            document.getElementById('serviceType').value = filters.type;
            document.getElementById('searchBar').value = filters.search;
            document.getElementById('sortOrder').value = filters.sort;

            // Fetch initial data
            fetchServices();
        }

        // Call initialization function when page loads
        document.addEventListener('DOMContentLoaded', initializePage);

        // Handle browser back/forward buttons
        window.addEventListener('popstate', () => {
            initializePage();
        });
    </script>
</body>
</html>