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

        /* Business Registration Styles */
        .document-upload-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .document-preview {
            flex: 1;
            background: #f8f9fa;
            border: 1px dashed #ccc;
            border-radius: 8px;
            padding: 15px;
            display: flex;
            align-items: center;
            min-height: 50px;
        }

        .document-upload-btn {
            background: #f0f2f5;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 10px 15px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #4a4a4a;
        }

        .document-upload-btn:hover {
            background: #e1e5eb;
        }

        .form-hint {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .document-preview img {
            max-height: 100px;
            max-width: 100%;
            border-radius: 4px;
            display: none;
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

        /* Portfolio Image preview are styles */
        .project-images-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .project-image-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .project-image-preview {
            width: 100%;
            height: 150px;
            background: #f8f9fa;
            border: 1px dashed #ccc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .project-image-preview.has-image {
            border-style: solid;
        }

        .project-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .project-image-actions {
            display: flex;
            gap: 8px;
        }

        .image-upload-btn {
            flex: 1;
            background: #f0f2f5;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #4a4a4a;
            font-size: 12px;
        }

        .image-remove-btn {
            background: #fff0f0;
            border: 1px solid #ffcaca;
            color: #dc3545;
            border-radius: 8px;
            padding: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 12px;
        }

        .image-upload-btn:hover {
            background: #e1e5eb;
        }

        .image-remove-btn:hover {
            background: #ffe0e0;
        }

        @media (max-width: 768px) {
            .project-images-container {
                grid-template-columns: 1fr;
            }
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
            <?php if ($_SESSION['user']['role'] !== 'businessman'): ?>
                <a href="/<?php echo $_SESSION['user']['role']; ?>/payout-methods" class="sidebar-link">
                    <i class="fas fa-credit-card"></i>
                    Payout Methods
                </a>
            <?php endif; ?>
        </div>

        <!-- Main Content -->
        <div class="settings-content">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="cover-photo-container">
                    <img id="cover-photo" src='https://placehold.co/1200x300?text=Cover+Photo' alt="Cover Photo" class="cover-photo" style="height: 100%; width: 100%; object-fit: cover;">
                    <i class="fas fa-camera edit-icon" id="cover-photo-edit"></i>
                    <input type="file" id="cover-photo-input" hidden accept="image/*">
                </div>
                <div class="profile-info-section">
                    <div class="profile-photo-wrapper">
                        <div class="profile-photo-container">
                            <img id="profile-photo" src='https://placehold.co/200x200?text=Profile' alt="Profile Photo" class="profile-photo">
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
                <!-- Basic Information -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Basic Information</h2>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="full_name" value="Not set">
                    </div>
                    <div class="form-group">
                        <label for="title">Professional Title</label>
                        <input type="text" id="title" name="professional_title" value="Graphic & UX/UI Design">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" rows="4">
                            Ravi Fernando is a seasoned designer specializing in graphic and UX/UI design...
                        </textarea>
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
                            <input type="email" id="email" name="email" value="ravi.fernando@example.com">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" value="+94123456789">
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" value="Colombo, Sri Lanka">
                        </div>
                    </div>
                </div>

                <!-- Professional Skills -->
                <div class="form-section" id="professional-skills-section">
                    <div class="section-header">
                        <h2 class="section-title">Professional Skills</h2>
                    </div>
                    <div class="form-group">
                        <label for="specialties">Specialties</label>
                        <input type="text" id="specialties" name="specialties" value="Graphic Design, UX/UI Design, Branding">
                    </div>
                    <div class="form-group">
                        <label for="tools">Tools Used</label>
                        <input type="text" id="tools" name="tools" value="Adobe Photoshop, Sketch, Figma">
                    </div>
                </div>

                <!-- Business Registration Section -->
                <div class="form-section" id="business-registration-section">
                    <div class="section-header">
                        <h2 class="section-title">Business Registration</h2>
                    </div>
                    <div class="form-group">
                        <label for="business-name">Business Name</label>
                        <input type="text" id="business-name" name="business_name" placeholder="Enter your registered business name">
                    </div>
                    <div class="form-group">
                        <label for="br-document">Business Registration Document</label>
                        <div class="document-upload-container">
                            <div id="br-document-preview" class="document-preview">
                                <span id="br-document-name">No document uploaded</span>
                            </div>
                            <button type="button" id="br-document-upload-btn" class="document-upload-btn">
                                <i class="fas fa-upload"></i> Upload Document
                            </button>
                            <input type="file" id="br-document-input" name="br_document" hidden accept="image/*,.pdf">
                        </div>
                        <p class="form-hint">Upload a scanned copy of your business registration certificate (PDF or image)</p>
                    </div>
                </div>

                <!-- Social Media Links -->
                <div class="form-section">
                    <div class="section-header">
                        <h2 class="section-title">Social Media Links</h2>
                    </div>
                    <div id="social-media-container">
                        <!-- Dynamically added social media fields should use name="social_links[]" -->
                    </div>
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
                    <div id="portfolio-container">
                        <!-- Dynamically added portfolio fields should use name="portfolio_projects[]" -->
                    </div>
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
        // ===============================
        // 1. Constants & Configuration
        // ===============================
        const API_USER_URL = '/api/user/me';
        const API_UPDATE_USER_URL = '/api/update-user';

        // ===============================
        // 2. DOM Element Selections
        // ===============================
        const coverPhoto = document.getElementById('cover-photo');
        const profilePhoto = document.getElementById('profile-photo');
        const form = document.getElementById('profile-form');
        const addSocialMediaBtn = document.getElementById('add-social-media');
        const addPortfolioBtn = document.getElementById('add-portfolio');
        const socialMediaContainer = document.getElementById('social-media-container');
        const portfolioContainer = document.getElementById('portfolio-container');

        const businessRegistrationSection = document.getElementById('business-registration-section');
        const businessNameInput = document.getElementById('business-name');
        const brDocumentInput = document.getElementById('br-document-input');
        const brDocumentUploadBtn = document.getElementById('br-document-upload-btn');
        const brDocumentPreview = document.getElementById('br-document-preview');
        const brDocumentName = document.getElementById('br-document-name');

        const coverPhotoInput = document.getElementById('cover-photo-input');
        const profilePhotoInput = document.getElementById('profile-photo-input');
        const coverPhotoEdit = document.getElementById('cover-photo-edit');
        const profilePhotoEdit = document.getElementById('profile-photo-edit');

        // ===============================
        // 3. Utility Functions
        // ===============================
        function setupImageUpload(input, img, editBtn) {
            editBtn.addEventListener('click', () => input.click());

            input.addEventListener('change', e => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = e => img.src = e.target.result;
                    reader.readAsDataURL(file);
                }
            });
        }

        // Setup document upload for business registration
        function setupDocumentUpload(inputId, previewContainerId, nameElementId, uploadBtnId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewContainerId);
            const nameElement = document.getElementById(nameElementId);
            const uploadBtn = document.getElementById(uploadBtnId);

            uploadBtn.addEventListener('click', () => input.click());

            input.addEventListener('change', e => {
                const file = e.target.files[0];
                if (file) {
                    nameElement.textContent = file.name;

                    // If it's an image, show a preview
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        const reader = new FileReader();
                        reader.onload = e => {
                            img.src = e.target.result;
                            img.style.display = 'block';

                            // Clear the preview and add the image
                            preview.innerHTML = '';
                            preview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });
        }

        function setupPortfolioImageUploads(portfolioItem) {
            const imageInputs = portfolioItem.querySelectorAll('.project-image-input');
            const uploadButtons = portfolioItem.querySelectorAll('.image-upload-btn');
            const removeButtons = portfolioItem.querySelectorAll('.image-remove-btn');

            // Setup upload buttons
            uploadButtons.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    imageInputs[index].click();
                });
            });

            // Setup file inputs
            imageInputs.forEach(input => {
                input.addEventListener('change', e => {
                    const file = e.target.files[0];
                    if (!file) return;

                    const imageNum = input.dataset.imageNum;
                    const previewContainer = input.closest('.project-image-item').querySelector('.project-image-preview');
                    const actionsContainer = input.closest('.project-image-item').querySelector('.project-image-actions');

                    // Update preview
                    const reader = new FileReader();
                    reader.onload = e => {
                        previewContainer.innerHTML = `<img src="${e.target.result}" alt="Project Image ${imageNum}">`;
                        previewContainer.classList.add('has-image');

                        // Add remove button if it doesn't exist
                        if (!actionsContainer.querySelector('.image-remove-btn')) {
                            const removeBtn = document.createElement('button');
                            removeBtn.type = 'button';
                            removeBtn.className = 'image-remove-btn';
                            removeBtn.textContent = 'Remove';
                            actionsContainer.appendChild(removeBtn);

                            // Setup remove functionality
                            removeBtn.addEventListener('click', () => {
                                // Reset preview
                                previewContainer.innerHTML = '<span>No image</span>';
                                previewContainer.classList.remove('has-image');

                                // Reset file input
                                input.value = '';

                                // Reset path input
                                const pathInput = input.closest('.project-image-item').querySelector('.project-image-path');
                                pathInput.value = '';

                                // Remove the remove button
                                removeBtn.remove();
                            });
                        }
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Setup existing remove buttons
            removeButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const imageItem = btn.closest('.project-image-item');
                    const previewContainer = imageItem.querySelector('.project-image-preview');
                    const fileInput = imageItem.querySelector('.project-image-input');
                    const pathInput = imageItem.querySelector('.project-image-path');

                    // Reset preview
                    previewContainer.innerHTML = '<span>No image</span>';
                    previewContainer.classList.remove('has-image');

                    // Reset inputs
                    fileInput.value = '';
                    pathInput.value = '';

                    // Remove the remove button
                    btn.remove();
                });
            });
        }

        // ===============================
        // 4. API Functions
        // ===============================
        async function fetchUserData() {
            const res = await fetch(API_USER_URL);
            if (!res.ok) throw new Error('Failed to fetch user data');
            return await res.json();
        }

        async function updateUserData(formData) {
            const res = await fetch(API_UPDATE_USER_URL, {
                method: 'POST',
                body: formData
            });

            if (!res.ok) throw new Error('Failed to update profile');
            return await res.json();
        }

        // ===============================
        // 5. UI Functions
        // ===============================
        function populateForm(user) {
            coverPhoto.src = "/" + user.cover_picture;
            profilePhoto.src = "/" + user.profile_picture;

            document.getElementById('fullname').value = user.name;
            document.getElementById('title').value = user.professional_title || "Not set";
            document.getElementById('bio').value = user.bio;
            document.getElementById('email').value = user.email;
            document.getElementById('phone').value = user.phone || "Not set";
            document.getElementById('location').value = user.location || "Not set";
            document.getElementById('specialties').value = user.specialties || "Not set";
            document.getElementById('tools').value = user.tools || "Not set";

            // Show/hide role-specific sections based on user role
            const socialMediaSection = document.querySelector('.form-section:has(#social-media-container)');
            const portfolioSection = document.querySelector('.form-section:has(#portfolio-container)');
            const businessRegistrationSection = document.getElementById('business-registration-section');
            const professionalSkillsSection = document.getElementById('professional-skills-section');

            // Default: hide both special sections
            if (socialMediaSection) socialMediaSection.style.display = 'none';
            if (portfolioSection) portfolioSection.style.display = 'none';
            if (businessRegistrationSection) businessRegistrationSection.style.display = 'none';

            // Show sections based on user role
            if (user.role === 'influencer' && socialMediaSection) {
                socialMediaSection.style.display = 'block';

                // Clear existing social media items
                socialMediaContainer.innerHTML = '';
                socialMediaCounter = 0;

                // Populate social media accounts if they exist
                if (user.social_accounts && Array.isArray(user.social_accounts) && user.social_accounts.length > 0) {
                    user.social_accounts.forEach(account => {
                        socialMediaCounter++;
                        const item = createSocialMediaItem(socialMediaCounter, account);

                        // Populate the item with data
                        const platformInput = item.querySelector(`.social-platform`);
                        const usernameInput = item.querySelector(`.social-username`);
                        const urlInput = item.querySelector(`.social-url`);

                        if (platformInput && account.platform) platformInput.value = account.platform;
                        if (usernameInput && account.username) usernameInput.value = account.username;
                        if (urlInput && account.link) urlInput.value = account.link;

                        // Store the account_id for update operations
                        if (account.account_id) {
                            item.dataset.accountId = account.account_id;
                        }

                        socialMediaContainer.appendChild(item);
                    });
                }
            }

            if (user.role === 'designer' && portfolioSection) {
                portfolioSection.style.display = 'block';

                // Clear existing portfolio items
                portfolioContainer.innerHTML = '';
                portfolioCounter = 0;

                // Populate portfolio projects if they exist
                if (user.portfolio_projects && Array.isArray(user.portfolio_projects) && user.portfolio_projects.length > 0) {
                    user.portfolio_projects.forEach(project => {
                        portfolioCounter++;

                        // Create portfolio item with all project data including images
                        const item = createPortfolioItem(portfolioCounter, {
                            project_id: project.project_id,
                            title: project.title,
                            description: project.description,
                            image_1: project.image_1,
                            image_2: project.image_2,
                            image_3: project.image_3
                        });

                        portfolioContainer.appendChild(item);
                    });
                }
            }

            if (user.role === 'businessman' && businessRegistrationSection) {
                businessRegistrationSection.style.display = 'block';
                professionalSkillsSection.style.display = 'none'; // Hide professional-skills-section for only businessmen

                // Populate business registration data if it exists
                if (user.business_registration) {
                    businessNameInput.value = user.business_registration.business_name || '';

                    // If there's a BR document, show its name
                    if (user.business_registration.br_document) {
                        const docPath = user.business_registration.br_document;
                        const fileName = docPath.split('/').pop();
                        brDocumentName.textContent = fileName;

                        // If it's an image, show preview
                        if (/\.(jpe?g|png|gif)$/i.test(docPath)) {
                            const img = document.createElement('img');
                            img.src = '/' + docPath;
                            img.style.display = 'block';

                            // Clear the preview and add the image
                            brDocumentPreview.innerHTML = '';
                            brDocumentPreview.appendChild(img);
                        }
                    }
                }
            }
        }

        function createSocialMediaItem(counter, accountData = {}) {
            const group = document.createElement('div');
            group.classList.add('social-media-item');
            group.dataset.id = counter;

            // Store account_id if it exists (for existing accounts)
            if (accountData.account_id) {
                group.dataset.accountId = accountData.account_id;
            }

            group.innerHTML = `
            <div class="item-header">
                <h3>Social Media Link ${counter}</h3>
                <button type="button" class="remove-btn">Remove</button>
            </div>
            <div class="form-group">
                <label for="social-platform-${counter}">Platform</label>
                <input type="text" id="social-platform-${counter}" name="social_platform_${counter}" class="social-platform" value="${accountData.platform || ''}">
            </div>
            <div class="form-group">
                <label for="social-username-${counter}">Social Media Username</label>
                <input type="text" id="social-username-${counter}" name="social_username_${counter}" class="social-username" value="${accountData.username || ''}">
            </div>
            <div class="form-group">
                <label for="social-url-${counter}">URL for profile</label>
                <input type="url" id="social-url-${counter}" name="social_url_${counter}" class="social-url" value="${accountData.url || accountData.link || ''}">
            </div>
            `;

            // Set up remove button with special handling for existing accounts
            const removeBtn = group.querySelector('.remove-btn');
            removeBtn.addEventListener('click', () => {
                // If this is an existing account (has account_id), mark it for deletion
                if (group.dataset.accountId) {
                    // Create a hidden field to track deleted accounts
                    const deletedAccountInput = document.createElement('input');
                    deletedAccountInput.type = 'hidden';
                    deletedAccountInput.name = `deleted_social_account_${group.dataset.accountId}`;
                    deletedAccountInput.value = group.dataset.accountId;
                    form.appendChild(deletedAccountInput);
                }

                // Remove the item from the DOM
                group.remove();
            });

            return group;
        }

        function createPortfolioItem(counter, projectData = {}) {
            const group = document.createElement('div');
            group.classList.add('portfolio-item');
            group.dataset.id = counter;

            // Add project_id as data attribute if it exists
            if (projectData.project_id) {
                group.dataset.projectId = projectData.project_id;
            }

            group.innerHTML = `
            <div class="item-header">
                <h3>Portfolio Project ${counter}</h3>
                <button type="button" class="remove-btn">Remove</button>
            </div>
            <div class="form-group">
                <label for="portfolio-${counter}-title">Project Title</label>
                <input type="text" id="portfolio-${counter}-title" name="portfolio_projects-${counter}-title" class="portfolio-title" value="${projectData.title || ''}">
            </div>
            <div class="form-group">
                <label for="portfolio-${counter}-description">Project Description</label>
                <textarea id="portfolio-${counter}-description" rows="3" name="portfolio_projects-${counter}-description" class="portfolio-description">${projectData.description || ''}</textarea>
            </div>
            <div class="form-group project-images">
                <label>Project Images (Up to 3)</label>
                <div class="project-images-container">
                    <!-- Image 1 -->
                    <div class="project-image-item">
                        <div class="project-image-preview ${projectData.image_1 ? 'has-image' : ''}">
                            ${projectData.image_1 ? `<img src="/${projectData.image_1}" alt="Project Image 1">` : '<span>No image</span>'}
                        </div>
                        <div class="project-image-actions">
                            <button type="button" class="image-upload-btn">Upload Image</button>
                            ${projectData.image_1 ? '<button type="button" class="image-remove-btn">Remove</button>' : ''}
                        </div>
                        <input type="file" class="project-image-input" data-image-num="1" name="portfolio_projects-${counter}-image-1" hidden accept="image/*">
                        <input type="hidden" class="project-image-path" data-image-num="1" name="portfolio_projects-${counter}-image-1-path" value="${projectData.image_1 || ''}">
                    </div>
                    
                    <!-- Image 2 -->
                    <div class="project-image-item">
                        <div class="project-image-preview ${projectData.image_2 ? 'has-image' : ''}">
                            ${projectData.image_2 ? `<img src="/${projectData.image_2}" alt="Project Image 2">` : '<span>No image</span>'}
                        </div>
                        <div class="project-image-actions">
                            <button type="button" class="image-upload-btn">Upload Image</button>
                            ${projectData.image_2 ? '<button type="button" class="image-remove-btn">Remove</button>' : ''}
                        </div>
                        <input type="file" class="project-image-input" data-image-num="2" name="portfolio_projects-${counter}-image-2" hidden accept="image/*">
                        <input type="hidden" class="project-image-path" data-image-num="2" name="portfolio_projects-${counter}-image-2-path" value="${projectData.image_2 || ''}">
                    </div>
                    
                    <!-- Image 3 -->
                    <div class="project-image-item">
                        <div class="project-image-preview ${projectData.image_3 ? 'has-image' : ''}">
                            ${projectData.image_3 ? `<img src="/${projectData.image_3}" alt="Project Image 3">` : '<span>No image</span>'}
                        </div>
                        <div class="project-image-actions">
                            <button type="button" class="image-upload-btn">Upload Image</button>
                            ${projectData.image_3 ? '<button type="button" class="image-remove-btn">Remove</button>' : ''}
                        </div>
                        <input type="file" class="project-image-input" data-image-num="3" name="portfolio_projects-${counter}-image-3" hidden accept="image/*">
                        <input type="hidden" class="project-image-path" data-image-num="3" name="portfolio_projects-${counter}-image-3-path" value="${projectData.image_3 || ''}">
                    </div>
                </div>
            </div>
            `;

            // Set up image upload functionality
            setupPortfolioImageUploads(group);

            // Set up remove button with special handling for existing projects
            const removeBtn = group.querySelector('.remove-btn');
            removeBtn.addEventListener('click', () => {
                // If this is an existing project (has project_id), mark it for deletion
                if (group.dataset.projectId) {
                    // Create a hidden field to track deleted projects
                    const deletedProjectInput = document.createElement('input');
                    deletedProjectInput.type = 'hidden';
                    deletedProjectInput.name = `deleted_project_${group.dataset.projectId}`;
                    deletedProjectInput.value = group.dataset.projectId;
                    form.appendChild(deletedProjectInput);
                }

                // Remove the item from the DOM
                group.remove();
            });

            return group;
        }

        // ===============================
        // 6. Event Handlers
        // ===============================
        async function handleFormSubmit(event) {
            event.preventDefault();
            const formData = new FormData(form);

            // Get the user role from the initial data (we should store this when loading the profile)
            const userRole = currentUserData.role; // You'll need to store this when fetching user data

            // Handle file uploads
            if (coverPhotoInput.files[0]) {
                formData.append('cover-photo', coverPhotoInput.files[0]);
            }

            if (profilePhotoInput.files[0]) {
                formData.append('profile-photo', profilePhotoInput.files[0]);
            }

            // Only include BR document if a new one was selected
            if (userRole === 'businessman' && brDocumentInput.files[0]) {
                formData.append('br_document', brDocumentInput.files[0]);
            }

            // Only collect and submit social media links for influencers
            if (userRole === 'influencer') {
                const socialMediaItems = document.querySelectorAll('.social-media-item');
                const socialMediaAccounts = [];

                // Collect deleted account IDs
                const deletedAccountInputs = document.querySelectorAll('input[name^="deleted_social_account_"]');
                const deletedAccounts = Array.from(deletedAccountInputs).map(input => {
                    return {
                        account_id: input.value,
                        delete: true
                    };
                });

                // Add deleted accounts to the accounts array
                socialMediaAccounts.push(...deletedAccounts);

                // Remove the hidden inputs from the form to keep it clean
                deletedAccountInputs.forEach(input => input.remove());

                socialMediaItems.forEach(item => {
                    const itemId = item.dataset.id;
                    const accountId = item.dataset.accountId;
                    const platform = item.querySelector(`.social-platform`).value;
                    const username = item.querySelector(`.social-username`).value;
                    const url = item.querySelector(`.social-url`).value;

                    if (platform || username || url) {
                        const accountData = {
                            platform,
                            username,
                            url
                        };

                        if (accountId) {
                            accountData.account_id = accountId;
                        }

                        socialMediaAccounts.push(accountData);

                        // Remove individual form fields
                        formData.delete(`social_platform_${itemId}`);
                        formData.delete(`social_username_${itemId}`);
                        formData.delete(`social_url_${itemId}`);
                    }
                });

                if (socialMediaAccounts.length > 0) {
                    formData.append('influencer_accounts', JSON.stringify(socialMediaAccounts));
                }
            }

            // Only collect and submit portfolio projects for designers
            if (userRole === 'designer') {
                const portfolioItems = document.querySelectorAll('.portfolio-item');
                const portfolioProjects = [];

                // Collect deleted project IDs
                const deletedProjectInputs = document.querySelectorAll('input[name^="deleted_project_"]');
                const deletedProjects = Array.from(deletedProjectInputs).map(input => {
                    return {
                        project_id: input.value,
                        delete: true
                    };
                });

                // Add deleted projects to the projects array
                portfolioProjects.push(...deletedProjects);

                // Remove the hidden inputs from the form to keep it clean
                deletedProjectInputs.forEach(input => input.remove());

                portfolioItems.forEach(item => {
                    const itemId = item.dataset.id;
                    const projectId = item.dataset.projectId;
                    const title = item.querySelector(`.portfolio-title`).value;
                    const description = item.querySelector(`.portfolio-description`).value;

                    // Get image paths (existing images) or leave empty if no image is set
                    const image1Path = item.querySelector(`.project-image-path[data-image-num="1"]`).value || null;
                    const image2Path = item.querySelector(`.project-image-path[data-image-num="2"]`).value || null;
                    const image3Path = item.querySelector(`.project-image-path[data-image-num="3"]`).value || null;

                    if (title || description || image1Path || image2Path || image3Path) {
                        const projectData = {
                            title,
                            description,
                            image_1: image1Path,
                            image_2: image2Path,
                            image_3: image3Path
                        };

                        if (projectId) {
                            projectData.project_id = projectId;
                        }

                        portfolioProjects.push(projectData);

                        // Remove individual form fields
                        formData.delete(`portfolio_projects-${itemId}-title`);
                        formData.delete(`portfolio_projects-${itemId}-description`);
                        formData.delete(`portfolio_projects-${itemId}-image-1-path`);
                        formData.delete(`portfolio_projects-${itemId}-image-2-path`);
                        formData.delete(`portfolio_projects-${itemId}-image-3-path`);

                        // Add new image files to the form data with specific naming
                        const imageInputs = item.querySelectorAll('.project-image-input');
                        imageInputs.forEach(input => {
                            if (input.files.length > 0) {
                                const imageNum = input.dataset.imageNum;
                                const projectIndex = portfolioProjects.length - 1;

                                // Add file with a name that identifies the project and image number
                                formData.append(`project_${projectIndex}_image_${imageNum}`, input.files[0]);

                                // Store the file input name in the project data so backend knows which file belongs to which project
                                projectData[`image_${imageNum}_input`] = `project_${projectIndex}_image_${imageNum}`;
                            }
                        });
                    }
                });

                if (portfolioProjects.length > 0) {
                    formData.append('designer_projects', JSON.stringify(portfolioProjects));
                }
            }

            try {
                await updateUserData(formData);
                alert('Profile updated successfully!');
            } catch (err) {
                console.error(err);
                alert('An error occurred while updating profile.');
            }
        }

        function handleAddSocialMedia() {
            socialMediaCounter++;
            const item = createSocialMediaItem(socialMediaCounter);
            socialMediaContainer.appendChild(item);
        }

        function handleAddPortfolio() {
            portfolioCounter++;
            const item = createPortfolioItem(portfolioCounter);
            portfolioContainer.appendChild(item);
        }

        // ===============================
        // 7. Initialization
        // ===============================
        let socialMediaCounter = 0;
        let portfolioCounter = 0;
        let currentUserData = null; // Store user data for later reference

        async function init() {
            try {
                const user = await fetchUserData();
                console.log(user);
                currentUserData = user; // Store for later reference
                populateForm(user);
            } catch (error) {
                console.error('Error fetching user data:', error);
            }

            setupImageUpload(coverPhotoInput, coverPhoto, coverPhotoEdit);
            setupImageUpload(profilePhotoInput, profilePhoto, profilePhotoEdit);

            // Set up document upload handler
            setupDocumentUpload('br-document-input', 'br-document-preview', 'br-document-name', 'br-document-upload-btn');

            // Always attach these event listeners, but the sections will only be visible for appropriate roles
            addSocialMediaBtn.addEventListener('click', handleAddSocialMedia);
            addPortfolioBtn.addEventListener('click', handleAddPortfolio);
            form.addEventListener('submit', handleFormSubmit);
        }

        document.addEventListener('DOMContentLoaded', init);
    </script>

</body>

</html>