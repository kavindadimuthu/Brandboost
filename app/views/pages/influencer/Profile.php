<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../styles/influencer/header.css">
  <link rel="stylesheet" href="../../styles/influencer/Profile.css">

</head>

<body>
  <?php include __DIR__ . '/../../components/common/header.php'; ?>

  <div class="profile-container">
    <h2>Profile</h2>
    <div class="profile-card">
      <div class="profile-header">
        <img src="../../assets/user_logo.png" alt="Profile Picture" class="profile-picture">
        <div class="profile-details">
          <h3>Ariana Grande</h3>
          <p>@arianagrande80</p>
        </div>
        <button id="editButton" class="edit-icon">
          <i>&#9998;</i>
        </button>
      </div>
      <form id="profileForm">
        <div class="form-row">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" value="Ariana Grande">
        </div>
        <div class="form-row">
          <label for="email">Email</label>
          <input type="email" id="email" value="ariana38@gmail.com">
        </div>
        <div class="form-row">
          <label for="phoneNumber">Phone Number</label>
          <input type="tel" id="phoneNumber" value="0770009999">
        </div>
        <div class="form-row">
          <label for="facebookLink">Facebook Link</label>
          <input type="url" id="facebookLink" value="facebook.com/ariana38">
        </div>
        <div class="form-row">
          <label for="youtubeLink">YouTube Link</label>
          <input type="url" id="youtubeLink" value="youtube.com/ariana38">
        </div>
        <div class="form-row">
          <label for="instagramLink">Instagram Link</label>
          <input type="url" id="instagramLink" value="instagram.com/ariana38">
        </div>
        <div class="form-row">
          <label for="tiktokLink">Tiktok Link</label>
          <input type="url" id="tiktokLink" value="tiktok.com/ariana38">
        </div>

        <div class="buttons">
          <button type="submit" id="saveButton">Save</button>
          <button id="previewButton" class="preview-button">
            Preveiw BrandBoost Profile
          </button>
        </div>
      </form>

    </div>
  </div>

  <script>

    document.getElementById("previewButton").addEventListener("click", () => {
      window.location.href = "http://localhost:8000/InfluencerViewController/influencerpreviewprofile";
    });


    // Handle form submission
    document.getElementById("profileForm").addEventListener("submit", async (event) => {
      event.preventDefault();

      // Gather form data
      const profileData = {
        fullName: document.getElementById("fullName").value,
        email: document.getElementById("email").value,
        phoneNumber: document.getElementById("phoneNumber").value,
        facebookLink: document.getElementById("facebookLink").value,
        youtubeLink: document.getElementById("youtubeLink").value,
      };

      try {
        // Simulate a database call (replace this with your backend API endpoint)
        const response = await fetch("http://localhost:8000/api/updateProfile", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(profileData),
        });

        const result = await response.json();
        if (result.success) {
          alert("Profile updated successfully!");
        } else {
          alert("Failed to update profile.");
        }
      } catch (error) {
        console.error("Error updating profile:", error);
        alert("An error occurred while updating the profile.");
      }
    });

  </script>
</body>

</html>