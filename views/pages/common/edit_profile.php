<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - BrandBoost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            min-height: 100vh;
        }

        .settings-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        /* Sidebar Styles */
        .settings-sidebar {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            height: fit-content;
            position: sticky;
            top: 90px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #666;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: #f5f7fb;
            color: #4169E1;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
        }

        /* Profile Header Styles */
        .profile-header {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .cover-photo-container {
            position: relative;
            height: 200px;
            background-color: #f0f2f5;
        }

        .cover-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info-section {
            padding: 20px;
            position: relative;
        }

        .profile-photo-wrapper {
            position: absolute;
            top: -50px;
            left: 20px;
        }

        .profile-photo-container {
            width: 100px;
            height: 100px;
            position: relative;
        }

        .profile-photo {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            background-color: #f0f2f5;
        }

        .edit-icon {
            position: absolute;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .edit-icon:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        .cover-photo-container .edit-icon {
            top: 20px;
            right: 20px;
        }

        .profile-photo-container .edit-icon {
            bottom: 0;
            right: 0;
        }

        .profile-title {
            margin-left: 120px;
        }

        .profile-title h1 {
            font-size: 24px;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .profile-title p {
            color: #666;
            font-size: 14px;
        }

        /* Form Section Styles */
        .form-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-title {
            color: #1a1a1a;
            font-size: 18px;
            font-weight: 600;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #4a4a4a;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4169E1;
            box-shadow: 0 0 0 3px rgba(65, 105, 225, 0.1);
        }

        /* Portfolio & Social Media Styles */
        .portfolio-item,
        .social-media-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .remove-btn:hover {
            background: rgba(220, 53, 69, 0.1);
        }

        .add-button {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .add-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(65, 105, 225, 0.2);
        }

        .save-button {
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
        }

        .save-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(65, 105, 225, 0.2);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .settings-container {
                grid-template-columns: 1fr;
            }

            .settings-sidebar {
                position: static;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .profile-title {
                margin-left: 0;
                margin-top: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="settings-container">
        <!-- Sidebar Navigation -->
        <div class="settings-sidebar">
            <a href="/<?php echo $_SESSION['user']['role']; ?>/edit-profile" class="sidebar-link active">
                <i class="fas fa-user"></i>
                Edit Profile
            </a>
            <a href="/<?php echo $_SESSION['user']['role']; ?>/change-password" class="sidebar-link">
                <i class="fas fa-lock"></i>
                Change Password
            </a>
            <a href="/<?php echo $_SESSION['user']['role']; ?>/payout-methods" class="sidebar-link">
                <i class="fas fa-credit-card"></i>
                Payout Methods
            </a>
        </div>

        <!-- Main Content -->
        <div class="settings-content">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="cover-photo-container">
                    <img id="cover-photo" src="\assets\images\placeholders\cover-photo-empty.jpg" alt="Cover Photo" class="cover-photo" style="height: 100%; width: 100%; object-fit: cover;">
                    <i class="fas fa-camera edit-icon" id="cover-photo-edit"></i>
                    <input type="file" id="cover-photo-input" hidden accept="image/*">
                </div>
                <div class="profile-info-section">
                    <div class="profile-photo-wrapper">
                        <div class="profile-photo-container">
                            <img id="profile-photo" src="\assets\images\placeholders\dp-empty.png" alt="Profile Photo" class="profile-photo">
                            <i class="fas fa-camera edit-icon" id="profile-photo-edit"></i>
                            <input type="file" id="profile-photo-input" hidden accept="image/*">
                        </div>
                    </div>
                    <div class="profile-title">
                        <h1>Edit Profile</h1>
                        <p>Update your personal information and profile settings</p>
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <form id="profile-form">
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Basic Information</h2>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" value="Not set">
                    </div>
                    <div class="form-group">
                        <label for="title">Professional Title</label>
                        <input type="text" id="title" value="Graphic & UX/UI Design">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" rows="4">Ravi Fernando is a seasoned designer specializing in graphic and UX/UI design...</textarea>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Contact Information</h2>
                    </div>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" value="ravi.fernando@example.com">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" value="+94123456789">
                        </div>
                        <!-- <div class="form-group">
                            <label for="website">Website</label>
                            <input type="url" id="website" value="https://ravifernando.com">
                        </div> -->
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" value="Colombo, Sri Lanka">
                        </div>
                    </div>
                </div>

                <!-- Professional Skills -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Professional Skills</h2>
                    </div>
                    <div class="form-group">
                        <label for="specialties">Specialties</label>
                        <input type="text" id="specialties" value="Graphic Design, UX/UI Design, Branding">
                    </div>
                    <div class="form-group">
                        <label for="tools">Tools Used</label>
                        <input type="text" id="tools" value="Adobe Photoshop, Sketch, Figma">
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Social Media Links</h2>
                    </div>
                    <div id="social-media-container"></div>
                    <button type="button" id="add-social-media" class="add-button">
                        <i class="fas fa-plus"></i>
                        Add Social Media Link
                    </button>
                </div>

                <!-- Portfolio -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Portfolio Projects</h2>
                    </div>
                    <div id="portfolio-container"></div>
                    <button type="button" id="add-portfolio" class="add-button">
                        <i class="fas fa-plus"></i>
                        Add Portfolio Project
                    </button>
                </div>

                <!-- Save Button -->
                <div class="form-section">
                    <button type="submit" class="save-button">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        async function handleSubmit(event) {
            event.preventDefault();

                try {
                    const formData = new FormData(this.form);
                    
                    // formData.append('test0', document.getElementById('gigTitle').value);
                    formData.append('test1', "Kavinda Fernando");
                    formData.append('test2', "Isuranga Fernando");
                    

                    // Log the data to be sent to the backend for debugging
                    // console.log('Data to be sent to the backend:', {
                    //     title: document.getElementById('gigTitle').value,
                    //     description: document.getElementById('gigDescription').value,
                    //     serviceType: document.getElementById('serviceType').value,
                    // });

                    // Make API call to update gig
                    const response = await fetch(`/api/update-user`, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error('Failed to update gig');
                    }

                    // setTimeout(() => {
                    //     window.location.href = '/designer/my-gigs';
                    // }, 1500);

                } catch (error) {
                    console.error('Error updating gig:', error);
                }
            }


        document.addEventListener('DOMContentLoaded', function() {

            // Fetch user data from the server
            fetch('/api/user/me')
                .then(response => response.json())
                .then(data => {
                    // Populate the form with user data
                    populateForm(data);
                    console.log(data);
                })
                .catch(error => console.error('Error fetching user data:', error));


            // Populate edit profile form
            function populateForm(userData){

                document.getElementById('cover-photo').src = userData.cover_picture;
                document.getElementById('profile-photo').src = userData.profile_picture;

                document.getElementById('fullname').value = userData.name;
                document.getElementById('title').value = userData.professional_title || "Not set";
                document.getElementById('bio').value = userData.bio;

                document.getElementById('email').value = userData.email;
                document.getElementById('phone').value = userData.phone || "Not set";
                // document.getElementById('website').value = userData.website;
                document.getElementById('location').value = userData.location || "Not set";
                
                document.getElementById('specialties').value = userData.specialties || "Not set";
                document.getElementById('tools').value = userData.tools || "Not set";
            }

            // Image upload functionality
            function setupImageUpload(inputId, imgId, editId) {
                const input = document.getElementById(inputId);
                const img = document.getElementById(imgId);
                const edit = document.getElementById(editId);

                edit.addEventListener('click', () => input.click());
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = e => img.src = e.target.result;
                        reader.readAsDataURL(file);
                    }
                });
            }

            setupImageUpload('cover-photo-input', 'cover-photo', 'cover-photo-edit');
            setupImageUpload('profile-photo-input', 'profile-photo', 'profile-photo-edit');

            // Social Media functionality
            let socialMediaCounter = 0;
            document.getElementById('add-social-media').addEventListener('click', function() {
                const container = document.getElementById('social-media-container');
                const socialMediaGroup = document.createElement('div');
                socialMediaGroup.classList.add('social-media-item');

                socialMediaGroup.innerHTML = `
                    <div class="item-header">
                        <h3>Social Media Link ${++socialMediaCounter}</h3>
                        <button type="button" class="remove-btn">Remove</button>
                    </div>
                    <div class="form-group">
                        <label for="social-media-${socialMediaCounter}-name">Social Media Name</label>
                        <input type="text" id="social-media-${socialMediaCounter}-name">
                    </div>
                    <div class="form-group
                        <label for="social-media-${socialMediaCounter}-url">Social Media URL</label>
                        <input type="url" id="social-media-${socialMediaCounter}-url">
                    </div>
                `;
                container.appendChild(socialMediaGroup);
                
                socialMediaGroup.querySelector('.remove-btn').addEventListener('click', function() {
                    socialMediaGroup.remove();
                    socialMediaCounter--;
                });
            });

            // Portfolio functionality
            let portfolioCounter = 0;
            document.getElementById('add-portfolio').addEventListener('click', function() {
                const container = document.getElementById('portfolio-container');
                const portfolioGroup = document.createElement('div');
                portfolioGroup.classList.add('portfolio-item');

                portfolioGroup.innerHTML = `
                    <div class="item-header">
                        <h3>Portfolio Project ${++portfolioCounter}</h3>
                        <button type="button" class="remove-btn">Remove</button>
                    </div>
                    <div class="form-group">
                        <label for="portfolio-${portfolioCounter}-title">Project Title</label>
                        <input type="text" id="portfolio-${portfolioCounter}-title">
                    </div>
                    <div class="form-group
                        <label for="portfolio-${portfolioCounter}-description">Project Description</label>
                        <textarea id="portfolio-${portfolioCounter}-description" rows="4"></textarea>
                    </div>
                    <div class="form-group
                        <label for="portfolio-${portfolioCounter}-url">Project URL</label>
                        <input type="url" id="portfolio-${portfolioCounter}-url">
                    </div>
                `;
                container.appendChild(portfolioGroup);

                portfolioGroup.querySelector('.remove-btn').addEventListener('click', function() {
                    portfolioGroup.remove();
                    portfolioCounter--;
                });
            });

            

            // Form submission
            document.getElementById('profile-form').addEventListener('submit', function(e) {
                // e.preventDefault();
                // const formData = new FormData(this);
                // console.log(Object.fromEntries(formData));

                // const test = "Kavinda Fernando";

                // fetch('/api/update-user', {
                //     method: 'POST',
                //     body: test
                // })
                //     .then(response => response.json())
                //     .then(result => {
                //         // statusMsg.textContent = result.message;
                //     })
                //     .catch(error => {
                //         console.error('Error updating profile:', error);
                //         // statusMsg.textContent = 'Failed to update profile.';
                //     });

                handleSubmit(e);
            });
        });
    </script>


</body>
</html>
