<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Cards</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .header-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .header-subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .filter-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .dropdown select {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border-radius: 25px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            outline: none;
            background-color: white;
            transition: box-shadow 0.2s ease-in-out;
        }

        .dropdown select:focus {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .search-bar-container {
            flex: 1;
            max-width: 600px;
        }

        .search-bar {
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 25px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            outline: none;
            transition: box-shadow 0.2s ease-in-out;
        }

        .search-bar:focus {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .search-bar:focus {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #service-card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }

        .service-card {
            width: 320px;
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .service-card:hover {
            cursor: pointer;
            transform: scale(1.025);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .service-card:hover .main-image {
            transform: scale(1.08);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .main-image {
            width: 100%;
            height: 180px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 15px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            margin-right: 10px;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-details {
            flex-grow: 1;
        }

        .username {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .verified-badge {
            background: #27ae60;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
        }

        .service-title {
            font-size: 15px;
            color: #333;
            margin-bottom: 15px;
        }

        .service-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .rating-number {
            font-weight: 600;
            color: #333;
        }

        .rating-count {
            color: #666;
            font-size: 14px;
        }

        .price {
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

        .star-icon {
            color: #333;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="header-container">
    <div id="header-title" class="header-title">Loading...</div>
    <div class="header-subtitle">Explore the profiles of talented individuals ready to collaborate with you.</div>
    </div>

    <!-- <div class="dropdown"></div> -->

    <div class="filter-container">
        <div class="dropdown"></div>
        <div class="search-bar-container">
            <input
                type="text"
                id="searchBar"
                class="search-bar"
                placeholder="Search here..."
                oninput="filterProfiles()"
            />
        </div>
    </div>

    <div id="service-card-container"></div>
    
    <script>
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


        // Create service cards dynamically
        function createServiceCards(services) {
            const cardsHTML = services.map(data => `
                <div class="service-card">
                <a href="/services/1">
                    <div class="main-image">
                        <img src="${data.imageUrl}" alt="${data.serviceTitle}">
                    </div>
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
                </a>
                </div>
            `).join('');

            document.getElementById('service-card-container').innerHTML = cardsHTML;
        }

        function renderDropdown() {
            const dropdown = document.querySelector('.dropdown');
            const select = document.createElement('select');

            // Add options to the dropdown
            select.innerHTML = `
                <option value="default">Search by Promotions</option>
                <option value="option2">Search by Influencer names</option>
            `;

            // Add event listener for URL redirection
            select.addEventListener('change', function () {
                if (this.value === 'option2') {
                    window.location.href = "http://localhost:8000/BusinessViewController/viewInfluencers";
                }
            });

            dropdown.appendChild(select);
        }


         // Filter profiles
         function filterProfiles() {
            const searchQuery = document.getElementById("searchBar").value.toLowerCase();
            const services = window.location.pathname.includes("viewDesignerGigs") ? designerGigs : influencerPromotions;

            // Use the correct property `username` instead of `name`
            const filteredServices = services.filter(service => service.serviceTitle.toLowerCase().includes(searchQuery));

            // Update the displayed service cards with the filtered results
            createServiceCards(filteredServices);
        }


        // Determine type based on URL
        window.onload = function () {
            const path = window.location.pathname;
            const headerTitle = document.getElementById("header-title");
            if (path.includes("viewDesignerGigs")) {
                headerTitle.textContent = "Designer Gigs";
                createServiceCards(designerGigs);
            } else if (path.includes("viewInfluencerPromotions")) {
                headerTitle.textContent = "Influencer Promotions";
                createServiceCards(influencerPromotions);
                renderDropdown();
            }
        };
    </script>
</body>
</html>