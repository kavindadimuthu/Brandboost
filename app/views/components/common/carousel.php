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
            position: relative;
            overflow: hidden;
            padding: 0 40px;
        }

        .carousel {
            display: flex;
            gap: 20px;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            flex: 0 0 320px;
            max-width: 320px;
        }

        .nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: white;
            border: none;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #333;
            transition: all 0.3s ease;
        }

        .nav-button:hover {
            background-color: #f0f0f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .nav-button.left {
            left: 0;
        }

        .nav-button.right {
            right: 0;
        }

        .nav-button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="carousel-container">
        <button class="nav-button left disabled" id="prevBtn" aria-label="Previous slide">‹</button>
        <div class="carousel" id="carousel">
            <?php
            // Create a scope for including the service card
            for ($i = 0; $i < 5; $i++) {
                echo '<div class="carousel-item">';
                (function() {
                    include __DIR__ . '/serviceCard.php';
                })();
                echo '</div>';
            }
            ?>
        </div>
        <button class="nav-button right" id="nextBtn" aria-label="Next slide">›</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('carousel');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const items = carousel.children;
            
            let currentIndex = 0;
            const itemWidth = 340; // card width (320px) + gap (20px)
            
            const getVisibleItems = () => {
                return Math.max(1, Math.floor((carousel.offsetWidth - 40) / itemWidth));
            };
            
            const updateButtons = () => {
                const visibleItems = getVisibleItems();
                const maxIndex = Math.max(0, items.length - visibleItems);
                prevBtn.classList.toggle('disabled', currentIndex === 0);
                nextBtn.classList.toggle('disabled', currentIndex >= maxIndex);
            };

            const scrollCarousel = (direction) => {
                const visibleItems = getVisibleItems();
                const maxIndex = Math.max(0, items.length - visibleItems);
                currentIndex = Math.max(0, Math.min(currentIndex + direction, maxIndex));
                carousel.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
                updateButtons();
            };

            prevBtn.addEventListener('click', () => scrollCarousel(-1));
            nextBtn.addEventListener('click', () => scrollCarousel(1));

            // Initial setup
            updateButtons();

            // Handle window resize
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    currentIndex = 0;
                    carousel.style.transform = 'translateX(0)';
                    updateButtons();
                }, 100);
            });
        });
    </script>
</body>
</html>