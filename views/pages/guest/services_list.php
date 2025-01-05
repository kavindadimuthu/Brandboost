<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Cards</title>
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

        .page-header {
            display: flex;
            flex-direction: column;
            /* position: sticky; */
            top: 0;
            z-index: 10;
            background: var(--bg-primary);
            padding: 1rem;
            /* margin-bottom: 2rem; */
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
        }

        .page-header-content {
            display: flex;
            flex-direction: column;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
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
            margin-bottom: 1rem;
        }

        .search-controls {
            display: flex;
            gap: 1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .dropdown select,
        .search-bar {
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border-radius: var(--radius-md);
            border: 1px solid #e5e7eb;
            background-color: var(--bg-primary);
            transition: all 0.2s ease;
        }

        .dropdown select {
            min-width: 200px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            appearance: none;
        }

        .search-bar-container {
            max-width: 800px;
            width: 100%;
            flex: 1;
            position: relative;
        }

        .search-bar {
            width: 100%;
            width: 800px;
        }

        .search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .dropdown select:hover,
        .search-bar:hover {
            border-color: var(--primary-color);
        }

        .dropdown select:focus,
        .search-bar:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Rest of the styles remain the same */
        .service-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            padding: 1rem;
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
            border: 2px solid #e5e7eb;
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
            border-top: 1px solid #e5e7eb;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .star-icon {
            color: #eab308;
        }

        .price {
            font-weight: 600;
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .page-header {
                padding: 1.5rem 1rem;
            }

            .search-controls {
                flex-direction: column;
            }

            .dropdown select {
                width: 100%;
            }
        }

        .results-summary {
            text-align: left;
            color: var(--text-secondary);
            margin: 1rem 0;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div class="page-header-content">
                <h1 id="header-title" class="header-title">Services</h1>
                <p class="header-subtitle">Discover and connect with talented professionals for your next project</p>
                
                <div class="search-controls">
                    <div class="dropdown"></div>
                    <div class="search-bar-container">
                        <input
                            type="text"
                            id="searchBar"
                            class="search-bar"
                            placeholder="Search by service title..."
                            oninput="filterProfiles()"
                        />
                        <span class="search-icon">🔍</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="results-summary" id="results-summary"></div>
        <div id="service-card-container" class="service-card-grid"></div>
    </div>

    <script>
        // Your existing data arrays remain the same
        // Dynamic data array with 5 service cards
        const designerGigs = [
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "Sallada",
                isVerified: true,
                serviceTitle: "Review on podcast recording recommendation video",
                rating: 5.0,
                ratingCount: 786,
                price: "LKR 25,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/68748376/original/7d9d3d6e4efd2e35bc8e8b3cc2dcf2fde1e27271/design-2-outstanding-logo-in-24-hours.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "MarkMedia",
                isVerified: false,
                serviceTitle: "Professional Facebook Ads Campaign Management",
                rating: 4.9,
                ratingCount: 543,
                price: "LKR 35,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/202847553/original/5277824ba5daa4cf5204a305d978094a2f4363f2/design-outstanding-flyer-or-poster-with-unlimited-revisions.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "DigitalPro",
                isVerified: true,
                serviceTitle: "Creative Social Media Ad Designs",
                rating: 4.8,
                ratingCount: 329,
                price: "LKR 15,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/183533956/original/7ca4175e3ef914e8ca7d632d886d17078c7c1b0d/design-10-unique-facebook-and-instagram-posts-banners-ads.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "AdExpert",
                isVerified: true,
                serviceTitle: "Facebook & Instagram Ads Setup",
                rating: 4.7,
                ratingCount: 892,
                price: "LKR 45,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/videos/t_main1,q_auto,f_auto/feaisnlcn2cval6ddhdh/create-an-instagram-puzzle-grid-feed.png",
                userAvatar: "https://via.placeholder.com/40",
                username: "SocialGuru",
                isVerified: true,
                serviceTitle: "Complete Social Media Marketing Package",
                rating: 5.0,
                ratingCount: 456,
                price: "LKR 55,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/145296688/original/4a8aa1411871dae6ab5c22a7ba489535e0e4b17d/creative-carousel-post-for-your-instagram-account.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "SocialGuru",
                isVerified: true,
                serviceTitle: "Complete Social Media Marketing Package",
                rating: 5.0,
                ratingCount: 456,
                price: "LKR 55,000"
            }
        ];

        const influencerPromotions = [
        {
            imageUrl: "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/126784228/original/d6398878193c5dbb88b9ef92278e250192d62780/be-your-social-media-manager.jpg",
            userAvatar: "https://via.placeholder.com/40",
            username: "PromoExpert",
            isVerified: true,
            serviceTitle: "I will promote your brand on my 500K Instagram followers",
            rating: 4.8,
            ratingCount: 240,
            price: "LKR 50,000"
        },
        {
            imageUrl: "https://fiverr-res.cloudinary.com/videos/so_0.104812,t_main1,q_auto,f_auto/yazvfbtb0a9qqowqc14h/be-your-social-media-marketing-manager-and-content-creator.png",
            userAvatar: "https://via.placeholder.com/40",
            username: "InstaBoost",
            isVerified: false,
            serviceTitle: "I will feature your product in my Instagram story highlights",
            rating: 4.7,
            ratingCount: 360,
            price: "LKR 30,000"
        },
        {
            imageUrl: "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/370540065/original/c8ebc6ffa846e17c4496f7e86c03bf4f6cbac3f4/do-organic-youtube-video-promotion-and-marketing-by-social-media.png",
            userAvatar: "https://via.placeholder.com/40",
            username: "TubePro",
            isVerified: true,
            serviceTitle: "I will promote your business on my 1M subscriber YouTube channel",
            rating: 5.0,
            ratingCount: 500,
            price: "LKR 75,000"
        },
        {
            imageUrl: "https://fiverr-res.cloudinary.com/videos/so_58.345428,t_main1,q_auto,f_auto/lokyruezin7kdrtxkxx1/create-business-commercial-video-or-social-media-video-ad.png",
            userAvatar: "https://via.placeholder.com/40",
            username: "SocialStar",
            isVerified: false,
            serviceTitle: "I will provide product placement on my TikTok videos",
            rating: 4.6,
            ratingCount: 150,
            price: "LKR 20,000"
        },
        {
            imageUrl: "https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs/155959096/original/84e9c92839c7c7fb53b1b9a67ed04c9c6ebf26fa/be-your-professional-social-media-manager.png",
            userAvatar: "https://via.placeholder.com/40",
            username: "AdKing",
            isVerified: true,
            serviceTitle: "I will advertise your business on my Facebook page with 200K followers",
            rating: 4.9,
            ratingCount: 220,
            price: "LKR 40,000"
        },
        {
            imageUrl: "https://fiverr-res.cloudinary.com/videos/so_1.436549,t_main1,q_auto,f_auto/sbvse6ifboxearybu1fy/be-your-social-media-manager-for-your-business.png",
            userAvatar: "https://via.placeholder.com/40",
            username: "TrendSetter",
            isVerified: true,
            serviceTitle: "I will promote your brand on my verified Twitter account",
            rating: 5.0,
            ratingCount: 300,
            price: "LKR 35,000"
        }
    ]; 

        function updateResultsSummary(count) {
            const summary = document.getElementById('results-summary');
            summary.textContent = `Showing ${count} services`;
        }

        function createServiceCards(services) {
            const cardsHTML = services.map(data => `
                <div class="service-card">
                    <a href="/services/1">
                        <div class="main-image">
                            <img src="${data.imageUrl}" alt="${data.serviceTitle}">
                        </div>
                        <div class="card-content">
                            <div class="user-info">
                                <div class="user-avatar">
                                    <img src="${data.userAvatar}" alt="${data.username}">
                                </div>
                                <div class="user-details">
                                    <div class="username">
                                        ${data.username}
                                        ${data.isVerified ? '<span class="verified-badge">Verified</span>' : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="service-title">
                                ${data.serviceTitle}
                            </div>
                            <div class="service-stats">
                                <div class="rating">
                                    <span class="star-icon">★</span>
                                    <span class="rating-number">${data.rating}</span>
                                    <span class="rating-count">(${data.ratingCount})</span>
                                </div>
                                <div class="price">${data.price}</div>
                            </div>
                        </div>
                    </a>
                </div>
            `).join('');

            document.getElementById('service-card-container').innerHTML = cardsHTML;
            updateResultsSummary(services.length);
        }

        function renderDropdown() {
            const dropdown = document.querySelector('.dropdown');
            const select = document.createElement('select');
            
            select.innerHTML = `
                <option value="default">Filter by category</option>
                <option value="option2">Search by Influencer names</option>
            `;
            
            select.addEventListener('change', function() {
                if (this.value === 'option2') {
                    window.location.href = "http://localhost:8000/BusinessViewController/viewInfluencers";
                }
            });
            
            dropdown.appendChild(select);
        }

        function filterProfiles() {
            const searchQuery = document.getElementById("searchBar").value.toLowerCase();
            const services = window.location.pathname.includes("viewDesignerGigs") 
                ? designerGigs 
                : influencerPromotions;

            const filteredServices = services.filter(service => 
                service.serviceTitle.toLowerCase().includes(searchQuery)
            );

            createServiceCards(filteredServices);
        }

        function initializePage() {
            const path = window.location.pathname;
            const headerTitle = document.getElementById("header-title");
            const services = path.includes("viewDesignerGigs") ? designerGigs : influencerPromotions;
            
            if (path.includes("viewDesignerGigs")) {
                headerTitle.textContent = "Designer Gigs";
            } else if (path.includes("viewInfluencerPromotions")) {
                headerTitle.textContent = "Influencer Promotions";
                renderDropdown();
            }
            
            // Initialize with all services
            createServiceCards(services);
        }

        // Call initialization function when page loads
        document.addEventListener('DOMContentLoaded', initializePage);
    </script>
</body>
</html>