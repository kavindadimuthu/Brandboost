<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influencers | BrandBoost</title>
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
            --border-radius: 16px;
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
            padding: 14px 20px 14px 45px;
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
            padding: 14px 20px;
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-200);
            font-size: 0.95rem;
            background-color: var(--white);
            min-width: 180px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-position: right 15px center;
            background-repeat: no-repeat;
            background-size: 18px;
            padding-right: 45px;
            transition: var(--transition);
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

        /* Influencer Card Grid */
        .influencer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .influencer-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .influencer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }

        .card-cover {
            height: 100px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            position: relative;
        }

        .profile-image-container {
            position: absolute;
            left: 50%;
            top: 50px;
            transform: translateX(-50%);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid var(--white);
            background-color: var(--white);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            z-index: 1;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 65px 20px 20px;
            text-align: center;
        }

        .influencer-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            background-color: var(--primary-light);
            color: var(--primary);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .verified-badge i {
            font-size: 0.7rem;
            margin-right: 3px;
        }

        .influencer-specialty {
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .influencer-bio {
            color: var(--gray-600);
            font-size: 0.9rem;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 60px;
        }

        .card-footer {
            padding-top: 15px;
            border-top: 1px solid var(--gray-200);
        }

        .view-profile-btn {
            display: inline-block;
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .view-profile-btn:hover {
            color: var(--primary-dark);
            background-color: var(--primary-light);
        }

        /* Empty and Loading States */
        .empty-state, .loading-state {
            text-align: center;
            padding: 50px 0;
            background: var(--white);
            border-radius: var(--border-radius);
            margin: 20px 0;
            box-shadow: var(--box-shadow);
            grid-column: 1 / -1;
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
            .influencer-grid {
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
                gap: 12px;
            }
            
            .filter-select, .search-bar {
                width: 100%;
            }
            
            .influencer-grid {
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
                <h1><i class="fas fa-users"></i> Top Influencers</h1>
                <p>Connect with trending creators to elevate your brand and reach your target audience</p>
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
                    placeholder="Search influencers by name, specialty or bio..."
                >
            </div>
            
            <select id="categoryFilter" class="filter-select">
                <option value="">All Categories</option>
                <option value="fashion">Fashion</option>
                <option value="beauty">Beauty</option>
                <option value="lifestyle">Lifestyle</option>
                <option value="fitness">Fitness</option>
                <option value="technology">Technology</option>
                <option value="food">Food</option>
                <option value="travel">Travel</option>
            </select>
        </div>

        <!-- Results Count -->
        <div class="results-info" id="resultsInfo">
            <span>Showing all influencers</span>
        </div>

        <!-- Influencer Cards Grid -->
        <div id="influencerGrid" class="influencer-grid">
            <!-- Influencer cards will be dynamically inserted here -->
            <div class="loading-state">
                <div class="spinner"></div>
                <p>Loading influencers...</p>
            </div>
        </div>
    </div>

    <script>
        // Store the original data
        let influencers = [];
        let filteredInfluencers = [];
        
        // Filters
        const filters = {
            search: '',
            category: ''
        };
        
        // Fetch influencers data
        async function fetchInfluencers() {
            try {
                const response = await fetch('/api/users?role=influencer');
                const result = await response.json();
                
                // Add random data for demo purposes since API might not have all fields
                influencers = result.users.map(influencer => ({
                    ...influencer,
                    specialty: influencer.specialty || getRandomSpecialty(),
                    verified: influencer.verified || Math.random() > 0.7
                }));
                
                applyFilters();
            } catch (error) {
                console.error('Error fetching influencers:', error);
                document.getElementById('influencerGrid').innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-exclamation-circle"></i>
                        <h3>Error loading influencers</h3>
                        <p>Please try again later.</p>
                    </div>
                `;
            }
        }

        // Get random specialty for demo
        function getRandomSpecialty() {
            const specialties = ['Fashion', 'Beauty', 'Lifestyle', 'Fitness', 'Technology', 'Food', 'Travel'];
            return specialties[Math.floor(Math.random() * specialties.length)];
        }

        // Apply filters
        function applyFilters() {
            // First filter by search term
            filteredInfluencers = influencers.filter(influencer => {
                if (!filters.search) return true;
                
                const searchTerm = filters.search.toLowerCase();
                return influencer.name?.toLowerCase().includes(searchTerm) ||
                       influencer.bio?.toLowerCase().includes(searchTerm) ||
                       influencer.specialty?.toLowerCase().includes(searchTerm);
            });
            
            // Then filter by category
            if (filters.category) {
                filteredInfluencers = filteredInfluencers.filter(influencer => 
                    influencer.specialty?.toLowerCase() === filters.category
                );
            }
            
            // Sort by newest by default
            filteredInfluencers.sort((a, b) => new Date(b.created_at || 0) - new Date(a.created_at || 0));
            
            // Update results info
            updateResultsInfo();
            
            // Render the filtered list
            renderInfluencers(filteredInfluencers);
        }

        // Update results count info
        function updateResultsInfo() {
            const resultsInfo = document.getElementById('resultsInfo');
            
            if (filteredInfluencers.length === 0) {
                resultsInfo.innerHTML = '<span>No influencers found</span>';
                return;
            }
            
            resultsInfo.innerHTML = `<span>Showing ${filteredInfluencers.length} of ${influencers.length} influencers</span>`;
        }

        // Render influencer cards
        function renderInfluencers(influencersToRender) {
            const grid = document.getElementById('influencerGrid');
            
            if (influencersToRender.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-search"></i>
                        <h3>No influencers found</h3>
                        <p>Try adjusting your search criteria</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = influencersToRender.map(influencer => `
                <div class="influencer-card" onclick="window.location.href='/user/${influencer.user_id}'">
                    <div class="card-cover"></div>
                    <div class="profile-image-container">
                        <img 
                            src="${influencer.profile_picture || '/api/placeholder/200/200'}" 
                            alt="${influencer.name}" 
                            class="profile-image"
                            onerror="this.onerror=null; this.src='/api/placeholder/200/200';"
                        >
                    </div>
                    <div class="card-content">
                        <h2 class="influencer-name">
                            ${influencer.name}
                            ${influencer.verified ? '<span class="verified-badge"><i class="fas fa-check"></i>Verified</span>' : ''}
                        </h2>
                        <div class="influencer-specialty">
                            ${influencer.specialty || 'Content Creator'}
                        </div>
                        <p class="influencer-bio">
                            ${influencer.bio || 'No bio available. This creator has not added a description yet.'}
                        </p>
                        <div class="card-footer">
                            <a href="/user/${influencer.user_id}" class="view-profile-btn">
                                View Profile <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Debounce function to limit search frequency
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

        // Search function
        function handleSearch() {
            filters.search = document.getElementById('searchBar').value;
            applyFilters();
        }

        // Category filter function
        function handleCategoryChange() {
            filters.category = document.getElementById('categoryFilter').value;
            applyFilters();
        }

        // Add event listeners
        document.addEventListener('DOMContentLoaded', () => {
            fetchInfluencers();
            
            // Set up event listeners
            document.getElementById('searchBar').addEventListener('input', debounce(handleSearch, 500));
            document.getElementById('categoryFilter').addEventListener('change', handleCategoryChange);
        });
    </script>
</body>
</html>