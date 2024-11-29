<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Portfolio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .portfolio-container {
            width: 80%;
            max-width: 1200px;
            margin-top: 20px;
        }

        .portfolio-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .portfolio-header h1 {
            font-size: 2rem;
            margin: 0;
        }

        .portfolio-header p {
            font-size: 1rem;
            color: #555;
        }

        .images-container {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: repeat(2, 1fr);
            gap: 10px;
        }

        .cover-box {
            grid-column: 1 / span 2;
            grid-row: 1 / span 2;
            background-color: #ccc;
            border: 2px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .other-box {
            background-color: #ccc;
            border: 2px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .cover-box img,
        .other-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="portfolio-container">
        <?php
        // Check if portfolio data exists
        if (!empty($portfolio)) {
            // Display title and description
            echo '<div class="portfolio-header">';
            echo '<h1>' . htmlspecialchars($portfolio['title']) . '</h1>';
            echo '<p>' . htmlspecialchars($portfolio['description']) . '</p>';
            echo '</div>';

            // Cover Image
            echo '<div class="images-container">';
            echo '<div class="cover-box">';
            echo '<img src="uploads/designer/portfolio' . htmlspecialchars($portfolio['cover_image']) . '" alt="Cover Image">';
            echo '</div>';

            // Other Images
            $otherImages = explode(',', $portfolio['other_images']);
            foreach ($otherImages as $key => $image) {
                if (!empty($image)) {
                    echo '<div class="other-box">';
                    echo '<img src="uploads/designer/portfolio' . htmlspecialchars($image) . '" alt="Other Image ' . ($key + 1) . '">';
                    echo '</div>';
                }
            }
            echo '</div>';
        } else {
            echo '<p>No portfolio found.</p>';
        }
        ?>
    </div>
</body>
</html>
