<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Portfolio</title>
    <link rel="stylesheet" href="../../styles/designer/viewPortfolio.css">
    <style>
        .add-button{
            background-color: #4CAF50;
            width: full;
            height: 3rem;
            color: white;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body><?php include __DIR__ . '/../../components/common/header.php'; ?>
<div class="container">


        <div class="" style="width: full; display: flex;justify-content: space-between; align-items: center;">
            <h2 style="width: 700px; text-align: left;">My Portfolio</h2>
            <a href="/DesignerViewController/AddPortfolio" class="add-button">Add Portfolio</a>
        </div>


        <div id="portfolioDetails" class="portfolio-details">
            <!-- Portfolio details will be dynamically injected here -->
        </div>


    </div>


    <script>
        document.addEventListener('DOMContentLoaded', async () => {
                try {
                    const response = await fetch(`/DesignerDataController/viewPortfolio`);
                    const portfolio = await response.json();

                    console.log(portfolio[0]);

                    renderPortfolioDetails(portfolio);
                } catch (error) {
                    console.error('Error fetching portfolio details:', error);
                }
            
        });

        function renderPortfolioDetails(portfolio) {
            const portfolioContainer = document.getElementById('portfolioDetails');

            console.log(portfolio);

            portfolio.forEach(item => {
                const portfolioHTML = `
                    <h3>${escapeHtml(item.title)}</h3>
                    <p class="description">${escapeHtml(item.description)}</p>
                    <div class="images">
                        <h4>Portfolio Images</h4>
                        <div class="image-gallery">
                            ${item.cover_image ? `<img src="/${escapeHtml(item.cover_image)}" alt="Cover Image">` : ''}
                            ${item.first_image ? `<img src="/${escapeHtml(item.first_image)}" alt="First Image">` : ''}
                            ${item.second_image ? `<img src="/${escapeHtml(item.second_image)}" alt="Second Image">` : ''}
                            ${item.third_image ? `<img src="/${escapeHtml(item.third_image)}" alt="Third Image">` : ''}
                            ${item.fourth_image ? `<img src="/${escapeHtml(item.fourth_image)}" alt="Fourth Image">` : ''}
                        </div>
                    </div>

                    <a href="/DesignerViewController/updatePortfolio" class="update-button">Update Portfolio</a>
                    <a href="/DesignerDataController/deleteSinglePortfolio/${escapeHtml(item.portfolio_id)}" class="delete-button">Delete Portfolio</a>
                `;
                portfolioContainer.innerHTML += portfolioHTML;

                console.log(item.portfolio_id);
                console.log(portfolioHTML);
            });

        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.innerText = text;
            return div.innerHTML;
        }
    </script>
</body>
</html>