<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Cards Carousel</title>
    <style>
        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
        }

        .carousel-container {
            width: 100%;
            max-width: 1400px;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="carousel-container">
        <button class="nav-button left disabled" id="prevBtn" aria-label="Previous slide">‹</button>
        <div class="carousel" id="carousel">
            <?php
            $carouselData = [
                [
                    "imageUrl" => "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                    "userAvatar" => "https://via.placeholder.com/40",
                    "username" => "Sallada",
                    "isVerified" => true,
                    "serviceTitle" => "Review on podcast recording recommendation video",
                    "rating" => 5.0,
                    "ratingCount" => 786,
                    "price" => "LKR 25,000"
                ],
                [
                    "imageUrl" => "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                    "userAvatar" => "https://via.placeholder.com/40",
                    "username" => "MarkMedia",
                    "isVerified" => false,
                    "serviceTitle" => "Professional Facebook Ads Campaign Management",
                    "rating" => 4.9,
                    "ratingCount" => 543,
                    "price" => "LKR 35,000"
                ],
                [
                    "imageUrl" => "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                    "userAvatar" => "https://via.placeholder.com/40",
                    "username" => "DigitalPro",
                    "isVerified" => true,
                    "serviceTitle" => "Creative Social Media Ad Designs Media Ad Designs",
                    "rating" => 4.8,
                    "ratingCount" => 329,
                    "price" => "LKR 15,000"
                ],
                [
                    "imageUrl" => "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                    "userAvatar" => "https://via.placeholder.com/40",
                    "username" => "AdExpert",
                    "isVerified" => true,
                    "serviceTitle" => "Facebook & Instagram Ads Setup Media Ad Designs",
                    "rating" => 4.7,
                    "ratingCount" => 892,
                    "price" => "LKR 45,000"
                ],
                [
                    "imageUrl" => "https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/178097622/original/a42b2d3b2f93a703a3dea7b3cc329610fd98a2cd/setup-and-manage-facebook-ads-campaign-to-grow-your-business.jpg",
                    "userAvatar" => "https://via.placeholder.com/40",
                    "username" => "SocialGuru",
                    "isVerified" => true,
                    "serviceTitle" => "Complete Social Media Marketing Package Media Ad Designs",
                    "rating" => 5.0,
                    "ratingCount" => 456,
                    "price" => "LKR 55,000"
                ]
            ];

            // Render carousel items
            foreach ($carouselData as $data) {
                echo '<div class="carousel-item">';
                (function ($data) {
                    include __DIR__ . '/serviceCard.php';
                })($data);
                echo '</div>';
            }
            ?>
        </div>
        <button class="nav-button right" id="nextBtn" aria-label="Next slide">›</button>
    </div>

    <script>
        const carousel = document.getElementById('carousel');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const items = carousel.children;

        let currentIndex = 0;
        const itemWidth = 340; // Card width (320px) + gap (20px)

        const getVisibleItems = () => {
            return Math.max(1, Math.floor((carousel.offsetWidth - 40) / itemWidth));
        };

        const updateButtons = () => {
            const visibleItems = getVisibleItems();
            const maxIndex = Math.max(0, items.length - visibleItems);

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;
        };

        window.addEventListener('resize', updateButtons);

        prevBtn.addEventListener('click', () => {
            currentIndex = Math.max(0, currentIndex - 1);
            carousel.scrollBy({ left: -itemWidth, behavior: 'smooth' });
            updateButtons();
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = Math.min(items.length - getVisibleItems(), currentIndex + 1);
            carousel.scrollBy({ left: itemWidth, behavior: 'smooth' });
            updateButtons();
        });

        updateButtons();
    </script>
</body>
</html>
