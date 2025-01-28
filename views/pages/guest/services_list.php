<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Listings</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --text-primary: #1f2937;
            --text-secondary: #4b5563;
            --bg-primary: #ffffff;
            --bg-secondary: #f3f4f6;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --radius-md: 0.5rem;
            --radius-lg: 1rem;
            --accent-yellow: #eab308;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            line-height: 1.5;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb-separator {
            color: var(--text-secondary);
        }

        .page-header {
            /* background: var(--bg-primary); */
            /* padding: 1.5rem; */
            border-radius: var(--radius-lg);
            /* box-shadow: var(--shadow-md); */
            margin-bottom: 1rem;
        }

        .page-header-content {
            max-width: 800px;
            /* margin: 0 auto; */
            /* text-align: center; */
        }

        .header-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .header-subtitle {
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        .search-controls {
            display: flex;
            gap: 1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .search-controls select,
        .search-controls input {
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background-color: var(--bg-primary);
            transition: all 0.2s ease;
        }

        .search-controls select {
            min-width: 200px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            appearance: none;
        }

        .search-bar-container {
            flex: 1;
            position: relative;
        }

        .search-bar {
            width: 100%;
            outline: none;
        }

        .search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        #serviceType{
            outline: none;
        }

        .results-summary {
            /* padding: 1rem; */
            color: var(--text-secondary);
            font-size: 0.875rem;
            /* background: var(--bg-primary); */
            border-radius: var(--radius-md);
            /* margin-bottom: 1rem; */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #sortOrder{
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background-color: var(--bg-primary);
            transition: all 0.2s ease;
            outline: none;
        }

        .service-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 2rem;
            /* padding: 1rem; */
            padding: 1rem 0;
        }

        .service-card {
            background: var(--bg-primary);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .service-card a {
            text-decoration: none;
            color: inherit;
        }

        .main-image {
            position: relative;
            padding-top: 56.25%;
            overflow: hidden;
        }

        .main-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .service-card:hover .main-image img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .user-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 0.75rem;
            border: 2px solid var(--border-color);
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .username {
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .verified-badge {
            background: var(--primary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-md);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .service-title {
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1rem;
            color: var(--text-primary);
            line-height: 1.5;
        }

        .service-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .star-icon {
            color: var(--accent-yellow);
        }

        .price {
            font-weight: 600;
            color: var(--primary-color);
        }

        .loading-spinner {
            text-align: center;
            padding: 2rem;
            color: var(--text-secondary);
        }

        .no-results {
            text-align: center;
            padding: 2rem;
            background: var(--bg-primary);
            border-radius: var(--radius-lg);
            color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .search-controls {
                flex-direction: column;
            }

            .search-controls select,
            .search-bar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Breadcrumb navigation -->
        <div class="breadcrumb">
            <a href="/"><i class="fas fa-home"></i></a>
            <span class="breadcrumb-separator">/</span>
            <a href="/services">Services</a>
            <span class="breadcrumb-separator">/</span>
            <span id="current-category">All Services</span>
        </div>

        <div class="page-header">
            <div class="page-header-content">
                <h1 id="header-title" class="header-title">Services</h1>
                <p class="header-subtitle">Discover and connect with talented professionals for your next project</p>
                
                <div class="search-controls">
                    <!-- <select id="categoryFilter" class="category-filter" onchange="handleCategoryChange()">
                        <option value="">All Categories</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                        <option value="development">Development</option>
                    </select> -->
                    
                    <div class="search-bar-container">
                        <input
                            type="text"
                            id="searchBar"
                            class="search-bar"
                            placeholder="Search services..."
                        />
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    
                    <select id="serviceType" class="service-type" onchange="handleServiceTypeChange()">
                        <option value="gig">Gigs</option>
                        <option value="promotion">Promotions</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="results-summary" id="resultsSummary">
            <span>Showing all services</span>
            <select id="sortOrder" onchange="handleSortChange()">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <!-- <option value="price_high">Price: High to Low</option> -->
                <!-- <option value="price_low">Price: Low to High</option> -->
            </select>
        </div>

        <div id="serviceCardContainer" class="service-card-grid">
            <!-- Service cards will be dynamically inserted here -->
        </div>
    </div>

    <script>
        // State management
        let services = [];
        let filters = {
            // category: '',
            type: 'gig',
            search: '',
            sort: 'title'
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
            container.innerHTML = '<div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading services...</div>';

                const queryParams = new URLSearchParams({
                    type: filters.type,
                    // category: filters.category,
                    query: filters.search,
                    sort: filters.sort,
                    include_user: true
                });

                const response = await fetch(`/api/services?${queryParams}`);
                result = await response.json();

                services = result.services;

                console.log(services);
            try {
                
                updateUI();
            } catch (error) {
                console.error('Error fetching services:', error);
                container.innerHTML = `
                    <div class="no-results">
                        <h2>Error loading services</h2>
                        <p>Please try again later</p>
                    </div>
                `;
            }
        }

        // Update UI with filtered and sorted services
        function updateUI() {
            const container = document.getElementById('serviceCardContainer');
            const summary = document.getElementById('resultsSummary');
            const currentCategory = document.getElementById('current-category');

            if (services.length === 0) {
                container.innerHTML = `
                    <div class="no-results">
                        <h2>No services found</h2>
                        <p>Try adjusting your search criteria</p>
                    </div>
                `;
                summary.innerHTML = '<span>No services found</span>';
                return;
            }

            // Update breadcrumb
            currentCategory.textContent = filters.type ? 
                filters.type.charAt(0).toUpperCase() + filters.type.slice(1) + 's' : 
                'All Services';

            // Update results summary
            summary.innerHTML = `
                <span>Showing ${services.length} service${services.length === 1 ? '' : 's'}</span>
                <select id="sortOrder" onchange="handleSortChange()">
                    <option value="newest" ${filters.sort === 'newest' ? 'selected' : ''}>Newest First</option>
                    <option value="oldest" ${filters.sort === 'oldest' ? 'selected' : ''}>Oldest First</option>
                </select>
            `;

            // Render service cards
            container.innerHTML = services.map(service => {
                const basicPackage = service.packages.find(pkg => pkg.package_type === 'basic');
                return `
                <div class="service-card">
                    <a href="/services/${service.service_id}">
                        <div class="main-image">
                            <img src="${service.cover_image || '/api/placeholder/400/225'}" 
                                 alt="${service.title}"
                                 >
                        </div>
                        <div class="card-content">
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img src="${service.user.profile_picture || '/api/placeholder/40/40'}" 
                                         alt="User ${service.user_id}"
                                         >
                                </div>
                                <div class="user-details">
                                    <div class="username">
                                        ${service.user?.name || `User ${service.user_id}`}
                                        ${service.is_verified ? '<span class="verified-badge">Verified</span>' : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="service-title">
                                ${service.title}
                            </div>
                            <div class="service-stats">
                                <div class="rating">
                                    <span class="star-icon">★</span>
                                    <span class="rating-number">${service.rating || '5.0'}</span>
                                    <span class="rating-count">(${service.rating_count || '0'})</span>
                                </div>
                                <div class="price">LKR ${basicPackage.price?.toLocaleString() || '25,000'}</div>
                            </div>
                        </div>
                    </a>
                </div>`;
                }).join('');
            }

        // Event Handlers
        function handleCategoryChange() {
            filters.category = document.getElementById('categoryFilter').value;
            fetchServices();
        }

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

        // Initialize page
        function initializePage() {
            // Set up search input listener
            document.getElementById('searchBar').addEventListener('input', handleSearch);

            // Initialize filters from URL parameters if any
            const urlParams = new URLSearchParams(window.location.search);
            // filters.category = urlParams.get('category') || '';
            filters.type = urlParams.get('type') || 'gig';
            filters.search = urlParams.get('search') || '';
            filters.sort = urlParams.get('sort') || 'newest';

            // Set initial form values
            // document.getElementById('categoryFilter').value = filters.category;
            document.getElementById('serviceType').value = filters.type;
            document.getElementById('searchBar').value = filters.search;
            document.getElementById('sortOrder').value = filters.sort;

            // Fetch initial data
            fetchServices();
        }

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

        // Error handler for images
        function handleImageError(img) {
            img.onerror = null; // Prevent infinite loop
            img.src = '/api/placeholder/400/225';
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