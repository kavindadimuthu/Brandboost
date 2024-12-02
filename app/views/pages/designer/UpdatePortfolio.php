<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Portfolio</title>
    <link rel="stylesheet" href="../../styles/designer/updatePortfolio.css">
</head>

<body>



    <div class="container">
        <h2>Update Portfolio</h2>
        <form id="updatePortfolioForm" method="POST" enctype="multipart/form-data" action="">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required></textarea>

            <label for="cover_image">Current Cover Image</label>
            <div id="currentCoverImage"></div>
            <input type="file" id="cover_image" name="cover_image" accept="image/*">

            <label for="first_image">Current First Image</label>
            <div id="currentFirstImage"></div>
            <input type="file" id="first_image" name="first_image" accept="image/*">

            <label for="second_image">Current Second Image</label>
            <div id="currentSecondImage"></div>
            <input type="file" id="second_image" name="second_image" accept="image/*">

            <label for="third_image">Current Third Image</label>
            <div id="currentThirdImage"></div>
            <input type="file" id="third_image" name="third_image" accept="image/*">

            <label for="fourth_image">Current Fourth Image</label>
            <div id="currentFourthImage"></div>
            <input type="file" id="fourth_image" name="fourth_image" accept="image/*">

            <button type="submit">Update Portfolio</button>
        </form>

        <!-- Back Button -->
        <a href="/DesignerDataController/viewPortfolio" class="back-button">Back to Portfolio</a>
    </div>

    <script>
        document.getElementById('cover_image').addEventListener('change', function (event) {
            const fileInput = event.target;
            const file = fileInput.files[0];

            if (file) {
                console.log('File name:', file.name);
                console.log('File path:', URL.createObjectURL(file));
            } else {
                console.log('No file selected');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch(`/DesignerDataController/viewPortfolio`);
                const portfolio = await response.json();

                if (portfolio) {
                    populateForm(portfolio);
                } else {
                    console.error('Portfolio data not found');
                }
            } catch (error) {
                console.error('Error fetching portfolio details:', error);
            }
        });

        function populateForm(portfolios) {
            console.log(portfolios);
            const portfolio = portfolios[0];
            document.getElementById('title').value = portfolio.title || '';
            document.getElementById('description').value = portfolio.description || '';

            const currentCoverImage = portfolio.cover_image ? `<img src="/${portfolio.cover_image}" alt="Cover Image" class="thumbnail" width="200px">` : 'No image available';
            const currentFirstImage = portfolio.first_image ? `<img src="/${portfolio.first_image}" alt="First Image" class="thumbnail" width="200px">` : 'No image available';
            const currentSecondImage = portfolio.second_image ? `<img src="/${portfolio.second_image}" alt="Second Image" class="thumbnail" width="200px">` : 'No image available';
            const currentThirdImage = portfolio.third_image ? `<img src="/${portfolio.third_image}" alt="Third Image" class="thumbnail" width="200px">` : 'No image available';
            const currentFourthImage = portfolio.fourth_image ? `<img src="/${portfolio.fourth_image}" alt="Fourth Image" class="thumbnail" width="200px">` : 'No image available';

            document.getElementById('currentCoverImage').innerHTML = currentCoverImage;
            document.getElementById('currentFirstImage').innerHTML = currentFirstImage;
            document.getElementById('currentSecondImage').innerHTML = currentSecondImage;
            document.getElementById('currentThirdImage').innerHTML = currentThirdImage;
            document.getElementById('currentFourthImage').innerHTML = currentFourthImage;

            console.log(currentCoverImage);
        }

        //collect form data and send to server
        document.getElementById('updatePortfolioForm').addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(event.target);

            console.log('Form data:', formData);

            // Log each key-value pair in the FormData object
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }

            // Check specific image paths
            const imageKeys = ['coverImage', 'firstImage', 'secondImage', 'thirdImage', 'fourthImage'];
            imageKeys.forEach(key => {
                if (formData.has(key)) {
                    const file = formData.get(key);
                    if (file instanceof File) {
                        console.log(`${key} path: ${URL.createObjectURL(file)}`);
                    } else {
                        console.log(`${key} path: ${file}`);
                    }
                }
            });

            try {
                const response = await fetch('/DesignerDataController/updatePortfolio', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {
                    alert('Portfolio updated successfully');
                    // window.location.href = '/DesignerDataController/viewPortfolio';
                } else {
                    const errorData = await response.json();
                    alert(`Error updating portfolio: ${errorData.message}`);
                }
            } catch (error) {
                console.error('Error updating portfolio:', error);
                alert('An error occurred while updating the portfolio. Please try again.');
            }
        });
    </script>
</body>

</html>