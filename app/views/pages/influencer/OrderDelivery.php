<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../styles/influencer/header.css">
  <link rel="stylesheet" href="../../styles/influencer/OrderDelivery.css">

</head>

<body>
  <?php include __DIR__ . '/../../components/common/header.php'; ?>

  <<div class="container">
    <h2>Proof Documents</h2>
    <div class="links-container">
      <ul class="content-links" id="contentLinks">
        <li>
          <textarea rows="1" placeholder="Enter new link">Content Link</textarea>
        </li>
      </ul>
      <!-- Plus button -->
      <button class="add-link-btn" id="addLinkBtn">+</button>
    </div>

    <form id="uploadForm" enctype="multipart/form-data">
      <div class="upload-section">
        <p>Drop files here</p>
        <small>Supported format: PNG, JPG</small>
        <input type="file" id="fileUpload" name="files" accept=".png, .jpg" multiple />
        <label for="fileUpload">Browse</label>
        <div class="upload-buttons">
          <button type="button" class="cancel-btn" id="cancelBtn">Cancel</button>

          <a href="http://localhost:8000/InfluencerViewController/singleorder"><button type="submit"
              class="upload-btn">Upload</button></a>
        </div>
      </div>
    </form>
    </div>
    <script>
      // Select the relevant elements
      const contentLinks = document.getElementById('contentLinks');
      const addLinkBtn = document.getElementById('addLinkBtn');
      const uploadForm = document.getElementById('uploadForm');
      const cancelBtn = document.getElementById('cancelBtn');

      // Add a new link input field when the + button is clicked
      addLinkBtn.addEventListener('click', () => {
        // Create a new list item
        const newLinkItem = document.createElement('li');

        // Add a textarea for the link
        const newTextarea = document.createElement('textarea');
        newTextarea.setAttribute('placeholder', 'Enter new link');
        newTextarea.setAttribute('rows', '1');

        // Append the textarea to the list item
        newLinkItem.appendChild(newTextarea);

        // Append the list item to the links list
        contentLinks.appendChild(newLinkItem);
      });

      // Handle form submission
      uploadForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Collect files and links
        const fileInput = document.getElementById('fileUpload');
        const files = fileInput.files;
        const links = Array.from(contentLinks.querySelectorAll('textarea')).map(
          (textarea) => textarea.value
        );

        // Prepare FormData for submission
        const formData = new FormData();
        for (let i = 0; i < files.length; i++) {
          formData.append('files[]', files[i]);
        }
        links.forEach((link, index) => {
          formData.append(`link${index + 1}`, link);
        });

        try {
          // Send the data to the server
          const response = await fetch('upload.php', {
            method: 'POST',
            body: formData,
          });

          // Check if the upload was successful
          if (response.ok) {
            alert('Files and links uploaded successfully!');
            // Redirect to the singleorder page
            window.location.href = 'singleorder.html';
          } else {
            alert('Error uploading files or links. Please try again.');
          }
        } catch (error) {
          console.error('Error:', error);
          alert('Something went wrong. Please try again.');
        }
      });

      // Handle cancel button
      cancelBtn.addEventListener('click', () => {
        document.getElementById('fileUpload').value = ''; // Clear file input
      });

    </script>

</body>

</html>