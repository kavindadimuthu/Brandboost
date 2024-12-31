<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profiles</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        body {
            padding: 20px;
            background-color: #f9f9f9;
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

        #card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            width: 260px;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            cursor: pointer;
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 15px;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .name {
            font-weight: 600;
            font-size: 18px;
            color: #333;
            margin-bottom: 8px;
        }

        .specialization {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-bottom: 8px;
        }

        .star-icon {
            color: #27ae60;
            font-size: 16px;
        }

        .rating-number {
            font-weight: 600;
            color: #333;
        }

        .verified-badge {
            background: #27ae60;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div id="header-title" class="header-title">Loading...</div>
        <div class="header-subtitle">Explore the profiles of talented individuals ready to collaborate with you.</div>
    </div>

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

    <div id="card-container"></div>
    
    <script>
        const designersData = [
            { avatarUrl: "https://via.placeholder.com/80", name: "Sarah Adams", specialization: "Graphic Designer", rating: 4.9, isVerified: true },
            { avatarUrl: "https://via.placeholder.com/80", name: "John Miller", specialization: "UI/UX Designer", rating: 4.8, isVerified: true },
        ];

        const influencersData = [
            { avatarUrl: "https://via.placeholder.com/80", name: "Emma Watson", specialization: "Social Media Influencer", rating: 4.7, isVerified: true },
            { avatarUrl: "https://via.placeholder.com/80", name: "Chris Johnson", specialization: "YouTube Content Creator", rating: 4.6, isVerified: false },
        ];

        function renderProfiles(profiles) {
            const container = document.getElementById("card-container");
            container.innerHTML = profiles.map(profile => `
                <div class="card" onclick="location.href='/user/1';" style="cursor: pointer;">
                    <div class="avatar"><img src="${profile.avatarUrl}" alt="${profile.name}"></div>
                    <div class="name">${profile.name}</div>
                    <div class="specialization">${profile.specialization}</div>
                    <div class="rating">
                        <span class="star-icon">★</span>
                        <span class="rating-number">${profile.rating}</span>
                    </div>
                    ${profile.isVerified ? '<span class="verified-badge">Verified</span>' : ""}
                </div>
            `).join('');
        }

        function renderDropdown() {
            const dropdown = document.querySelector('.dropdown');
            const select = document.createElement('select');
            select.innerHTML = `
                <option value="default">Search by Influencer names</option>
                <option value="option1">Search by Promotions</option>
            `;

            select.addEventListener('change', function () {
                if (this.value === 'option1') {
                    window.location.href = "http://localhost:8000/BusinessViewController/viewInfluencerPromotions";
                }
            });

            dropdown.appendChild(select);
        }

        function filterProfiles() {
            const searchQuery = document.getElementById("searchBar").value.toLowerCase();
            const profiles = window.location.pathname.includes("viewDesigners") ? designersData : influencersData;
            const filteredProfiles = profiles.filter(profile => profile.name.toLowerCase().includes(searchQuery));
            renderProfiles(filteredProfiles);
        }

        window.onload = function () {
            const path = window.location.pathname;
            const headerTitle = document.getElementById("header-title");
            if (path.includes("viewDesigners")) {
                headerTitle.textContent = "Meet Our Designers";
                renderProfiles(designersData);
            } else if (path.includes("viewInfluencers")) {
                headerTitle.textContent = "Meet Our Influencers";
                renderProfiles(influencersData);
                renderDropdown();
            }
        };
    </script>
</body>
</html>
