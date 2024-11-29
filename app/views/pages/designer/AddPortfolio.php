<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Designer Portfolio</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/packagesTable.css">
    <link rel="stylesheet" href="../../styles/designer/addPortfolio.css">
</head>
<body>
    <div class="container">
        <h2>Add Designer Portfolio</h2>
        <form id="portfolioForm" >
            <label for="title">Portfolio Title</label>
            <input type="text" id="title" name="title" placeholder="Enter portfolio title" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Write a brief description of your portfolio" rows="5" required></textarea>

            <label for="skills">Skills</label>
            <input type="text" id="skills" name="skills" placeholder="E.g., Graphic Design, Photoshop, etc." required>

            <label for="cover_image">Upload Cover Image</label>
            <input type="file" id="cover_image" name="cover_image" accept=".png, .jpg, .jpeg" required>

            <label for="other_images">Upload Other Portfolio Images (up to 4)</label>
            <input type="file" id="other_images" name="other_images[]" accept=".png, .jpg, .jpeg" multiple>

            <small>At least 2 images are required (1 cover image and 1 other image).</small>

            <button type="submit">Submit Portfolio</button>
            <button type="reset">Reset</button>
        </form>
    </div>

    <script>
        // Handle form submission
        document.getElementById('portfolioForm').addEventListener('submit', async (e) => {
            e.preventDefault(); // Prevent the default form submission behavior

            const formData = new FormData(e.target);

            try {
                const response = await fetch('/DesignerDataController/addPortfolio', {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.json();
                console.log(result);
                
                if (result.status === 'success') {
                    alert('Portfolio submitted successfully!');
                    e.target.reset(); // Clear the form
                } else {
                    alert('Failed to submit portfolio: ' + result.message);
                }
            } catch (error) {
                console.error('Error submitting portfolio:', error);
                alert('An error occurred while submitting the portfolio.');
            }
        });
    </script>
</body>
</html>
