<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Portfolio</title>
    <link rel="stylesheet" href="../../styles/designer/viewPortfolio.css">
</head>
<body><?php include __DIR__ . '/../../components/common/header.php'; ?>
<div class="container">


        <h2>Portfolio Details</h2>
        <div id="portfolioDetails" class="portfolio-details">
            <!-- Portfolio details will be dynamically injected here -->
        </div>

        <!-- Update Button -->
        <a href="/DesignerViewController/updatePortfolio" class="update-button">Update Portfolio</a>
        <!-- Delete Button -->
        <a href="/DesignerDataController/deletePortfolio" class="delete-button">Delete Portfolio</a>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', async () => {
                try {
                    const response = await fetch(`/DesignerDataController/viewPortfolio`);
                    const portfolio = await response.json();

                    renderPortfolioDetails(portfolio);
                } catch (error) {
                    console.error('Error fetching portfolio details:', error);
                }
            
        });

        function renderPortfolioDetails(portfolio) {
            const portfolioContainer = document.getElementById('portfolioDetails');

            if (portfolio) {
                const imagesHTML = `
                    <h3>${escapeHtml(portfolio.title)}</h3>
                    <p class="description">${escapeHtml(portfolio.description)}</p>
                    <div class="images">
                        <h4>Portfolio Images</h4>
                        <div class="image-gallery">
                            ${portfolio.cover_image ? `<img src="/${escapeHtml(portfolio.cover_image)}" alt="Cover Image">` : ''}
                            ${portfolio.first_image ? `<img src="/${escapeHtml(portfolio.first_image)}" alt="First Image">` : ''}
                            ${portfolio.second_image ? `<img src="/${escapeHtml(portfolio.second_image)}" alt="Second Image">` : ''}
                            ${portfolio.third_image ? `<img src="/${escapeHtml(portfolio.third_image)}" alt="Third Image">` : ''}
                            ${portfolio.fourth_image ? `<img src="/${escapeHtml(portfolio.fourth_image)}" alt="Fourth Image">` : ''}
                        </div>
                    </div>
                `;
                portfolioContainer.innerHTML = imagesHTML;
            } else {
                portfolioContainer.innerHTML = '<p>No portfolio details available.</p>';
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.innerText = text;
            return div.innerHTML;
        }
    </script>
</body>
</html>