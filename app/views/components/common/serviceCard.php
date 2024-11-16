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
    <div id="service-card-container"></div>

    <script>
        // Dynamic data array with 5 service cards
        const servicesData = [
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
                imageUrl: "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "MarkMedia",
                isVerified: false,
                serviceTitle: "Professional Facebook Ads Campaign Management",
                rating: 4.9,
                ratingCount: 543,
                price: "LKR 35,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "DigitalPro",
                isVerified: true,
                serviceTitle: "Creative Social Media Ad Designs",
                rating: 4.8,
                ratingCount: 329,
                price: "LKR 15,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "AdExpert",
                isVerified: true,
                serviceTitle: "Facebook & Instagram Ads Setup",
                rating: 4.7,
                ratingCount: 892,
                price: "LKR 45,000"
            },
            {
                imageUrl: "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                userAvatar: "https://via.placeholder.com/40",
                username: "SocialGuru",
                isVerified: true,
                serviceTitle: "Complete Social Media Marketing Package",
                rating: 5.0,
                ratingCount: 456,
                price: "LKR 55,000"
            }
        ];

        // Create service cards
        function createServiceCards(services) {
            const cardsHTML = services.map(data => `
                <div class="service-card">
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
                </div>
            `).join('');

            document.getElementById('service-card-container').innerHTML = cardsHTML;
        }

        // Initialize the components
        createServiceCards(servicesData);
    </script>
</body>
</html>