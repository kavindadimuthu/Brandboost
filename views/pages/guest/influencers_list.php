<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influencers Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-primary: #1f2937;
            --text-secondary: #4b5563;
            --bg-primary: #ffffff;
            --bg-secondary: #f3f4f6;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --radius-md: 0.5rem;
            --radius-lg: 1rem;
            --radius-full: 9999px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header-title {
            font-size: 2.5rem;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .header-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .search-container {
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .search-input {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--bg-secondary);
            border-radius: var(--radius-md);
            font-size: 1rem;
            transition: border-color 0.2s ease;
            background-color: var(--bg-primary);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .influencer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .influencer-card {
            background: var(--bg-primary);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .influencer-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: var(--radius-full);
            object-fit: cover;
            margin-bottom: 1rem;
            border: 3px solid var(--accent-color);
        }

        .influencer-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .influencer-bio {
            color: var(--text-secondary);
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .influencer-email {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .no-results {
            text-align: center;
            grid-column: 1 / -1;
            padding: 2rem;
            color: var(--text-secondary);
            background: var(--bg-primary);
            border-radius: var(--radius-lg);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header-title {
                font-size: 2rem;
            }

            .influencer-grid {
                grid-template-columns: 1fr;
            }

            .search-container {
                padding: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="header-title">Featured Influencers</h1>
            <p class="header-subtitle">Connect with trending creators in your industry</p>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search influencers by name or bio..." id="searchInput">
            </div>
        </div>

        <div class="influencer-grid" id="influencerGrid">
            <!-- Influencer cards will be dynamically inserted here -->
        </div>
    </div>

    <script>
        // Store the original data
        let influencers = [];
        
        // Fetch influencers data
        async function fetchInfluencers() {
            try {
                const response = await fetch('/api/influencers');
                influencers = await response.json();
                renderInfluencers(influencers);
            } catch (error) {
                console.error('Error fetching influencers:', error);
                document.getElementById('influencerGrid').innerHTML = `
                    <div class="no-results">
                        <h2>Error loading influencers</h2>
                        <p>Please try again later.</p>
                    </div>
                `;
            }
        }

        // Render influencer cards
        function renderInfluencers(influencersToRender) {
            const grid = document.getElementById('influencerGrid');
            
            if (influencersToRender.length === 0) {
                grid.innerHTML = `
                    <div class="no-results">
                        <h2>No influencers found</h2>
                        <p>Try adjusting your search criteria</p>
                    </div>
                `;
                return;
            }

            grid.innerHTML = influencersToRender.map(influencer => `
                <div class="influencer-card">
                    <img 
                        src="${influencer.profile_picture ? influencer.profile_picture : '/api/placeholder/120/120'}" 
                        alt="${influencer.name}" 
                        class="profile-image"
                    >
                    <h2 class="influencer-name">${influencer.name}</h2>
                    <p class="influencer-email">${influencer.email}</p>
                    <p class="influencer-bio">
                        ${influencer.bio || 'No bio available'}
                    </p>
                </div>
            `).join('');

            // Add hover effects to new cards
            addCardHoverEffects();
        }

        // Add hover effects to cards
        function addCardHoverEffects() {
            document.querySelectorAll('.influencer-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-4px)';
                    card.style.boxShadow = 'var(--shadow-lg)';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = 'var(--shadow-md)';
                });
            });
        }

        // Search functionality
        function handleSearch(event) {
            const searchTerm = event.target.value.toLowerCase();
            const filteredInfluencers = influencers.filter(influencer => 
                influencer.name.toLowerCase().includes(searchTerm) ||
                (influencer.bio && influencer.bio.toLowerCase().includes(searchTerm))
            );
            renderInfluencers(filteredInfluencers);
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

        // Add event listeners
        document.addEventListener('DOMContentLoaded', () => {
            fetchInfluencers();
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', debounce(handleSearch, 500));
        });
    </script>
</body>
</html>