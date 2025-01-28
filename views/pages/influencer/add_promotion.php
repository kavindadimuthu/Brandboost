<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your promotion - Brandboost</title>
    <style>
        :root {
            --primary: #4169E1;
            --primary-gradient: linear-gradient(135deg, #4169E1, #8A2BE2);
            --secondary: #64748b;
            --success: #22c55e;
            --error: #ef4444;
            --background: #f8f9fa;
            --text: #1e293b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            position: relative;
        }

        /* Progress Timeline */
        .progress-timeline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            position: relative;
            padding: 0 2rem;
            /* background: white; */
            border-radius: 16px;
            /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); */
        }

        .progress-timeline::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--border);
            z-index: 1;
        }

        .progress-step {
            position: relative;
            z-index: 2;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--border);
            transition: all 0.3s ease;
            font-weight: 600;
            margin: 1.5rem 0;
        }

        .progress-step.active {
            border-color: #4169E1;
            background: var(--primary-gradient);
            color: white;
        }

        .progress-step.completed {
            border-color: var(--success);
            background: var(--success);
            color: white;
        }

        .step-label {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-top: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
            color: var(--secondary);
        }

        /* Main Content Area */
        .main-content {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .main-content h2 {
            font-size: 28px;
            margin-bottom: 1.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 600;
            color: var(--text);
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #4169E1;
            box-shadow: 0 0 0 4px rgba(65, 105, 225, 0.1);
            background: white;
        }

        /* Tags Input */
        .tags-input {
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 0.75rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            min-height: 50px;
            background: #f8fafc;
        }

        .tag {
            background: var(--primary-gradient);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .remove-tag {
            cursor: pointer;
            font-weight: bold;
            font-size: 1.25rem;
        }

        /* File Upload */
        .upload-area {
            border: 2px dashed var(--border);
            border-radius: 16px;
            padding: 2.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .upload-area:hover {
            border-color: #4169E1;
            background: #f1f5f9;
        }

        /* Package Panels */
        .packages {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .package-panel {
            border: 2px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            background: #f8fafc;
            transition: all 0.3s ease;
        }

        .package-panel:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .package-panel.basic {
            border-color: var(--secondary);
        }

        .package-panel.premium {
            border-color: #4169E1;
            background: linear-gradient(to bottom right, #f8fafc, #e6f0ff);
        }

        .package-panel h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
        }

        /* Buttons */
        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2.5rem;
        }

        .btn {
            padding: 0.875rem 1.75rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(65, 105, 225, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(65, 105, 225, 0.3);
        }

        .btn-secondary {
            background: white;
            border: 2px solid var(--border);
            color: var(--text);
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: var(--secondary);
        }

        /* Notifications */
        .notification {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: none;
            animation: slideIn 0.3s ease;
            border-left: 4px solid #4169E1;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .packages {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .progress-timeline {
                padding: 0 1rem;
            }

            .step-label {
                font-size: 0.75rem;
            }

            .main-content {
                padding: 1.5rem;
            }
        }

        /* Add this to your existing styles section */
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 0.5rem 0;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .checkbox-item:hover {
            border-color: var(--primary);
            background: white;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }

        .checkbox-item span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .checkbox-item input[type="checkbox"]:checked+span {
            color: var(--primary);
        }

        /* Add these styles to your CSS section */
        .image-placeholder {
            width: 300px;
            height: 200px;
            border: 2px dashed var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1rem auto;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .image-placeholder img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .additional-images-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .additional-image-placeholder {
            width: 100%;
            aspect-ratio: 3/2;
            border: 2px dashed var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .additional-image-placeholder .remove-image-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--error);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            z-index: 2;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .additional-image-placeholder .remove-image-btn:hover {
            background: #dc2626;
        }

        .additional-image-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .placeholder-text {
            text-align: center;
            color: var(--secondary);
            font-size: 0.875rem;
            z-index: 1;
        }

        @media (max-width: 768px) {
            .additional-images-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Progress Timeline -->
        <div class="progress-timeline">
            <div class="progress-step active">
                1
                <span class="step-label">promotion Details</span>
            </div>
            <div class="progress-step">
                2
                <span class="step-label">Media</span>
            </div>
            <div class="progress-step">
                3
                <span class="step-label">Packages</span>
            </div>
        </div>

        <!-- Stage 1: promotion Details -->
        <form id="promotionForm">
            <div class="main-content" id="stage1">
                <h2>promotion Details</h2>
                <div class="form-group">
                    <label for="promotionTitle">promotion Title</label>
                    <input type="text" id="promotionTitle" name="title" placeholder="e.g., Professional Logo Design" required maxlength="80">
                    <small>Make it clear and catchy (max 80 characters)</small>
                </div>

                <div class="form-group">
                    <label for="promotionDescription">promotion Description</label>
                    <textarea id="promotionDescription" name="description" rows="6" placeholder="Describe your services in detail..." required></textarea>
                    <small>Include your process, what clients will receive, and your unique value proposition</small>
                </div>

                <div class="form-group">
                    <label>Delivery Formats</label>
                    <div class="checkbox-group" id="deliveryFormats">
                        <!-- Delivery format checkboxes will be inserted here by JavaScript -->
                    </div>
                </div>

                <div class="form-group">
                    <label for="serviceType">Service Type</label>
                    <select id="serviceType" name="serviceType" required>
                        <!-- Service types will be inserted here by JavaScript -->
                    </select>
                </div>

                <div id="platforms" class="checkbox-group">
                    <!-- Platforms will be populated here -->
                </div>

                <div class="form-group">
                    <label>Tags</label>
                    <div class="tags-input" id="tagsInput">
                        <input type="text" placeholder="Type and press Enter to add tags">
                    </div>
                    <small>Add up to 5 relevant tags to help buyers find your promotion</small>
                </div>
            </div>

            <!-- Stage 2: Media -->
            <div class="main-content" id="stage2" style="display: none;">
                <h2>Media Upload</h2>
                <div class="form-group">
                    <label>Main Image</label>
                    <div class="upload-area" id="mainImageUpload">
                        <p>Drag and drop your main image here or click to browse</p>
                        <p><small>Max size: 5MB, Formats: JPG/PNG</small></p>
                        <input type="file" id="mainImageInput" accept="image/*" style="display: none">
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('mainImageInput').click()">
                            Choose File
                        </button>
                        <div class="image-placeholder">
                            <div class="placeholder-text" id="mainImagePlaceholder">
                                300 x 200
                            </div>
                            <img id="mainImagePreview" alt="Preview" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Additional Images</label>
                    <div class="upload-area" id="additionalImagesUpload">
                        <p>Add up to 4 more images</p>
                        <p><small>Max size: 5MB each, Formats: JPG/PNG</small></p>
                        <input type="file" id="additionalImagesInput" accept="image/*" multiple style="display: none">
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('additionalImagesInput').click()">
                            Choose Files
                        </button>
                        <div class="additional-images-grid">
                            <div class="additional-image-placeholder" data-index="0">
                                <div class="placeholder-text">300 x 200</div>
                            </div>
                            <div class="additional-image-placeholder" data-index="1">
                                <div class="placeholder-text">300 x 200</div>
                            </div>
                            <div class="additional-image-placeholder" data-index="2">
                                <div class="placeholder-text">300 x 200</div>
                            </div>
                            <div class="additional-image-placeholder" data-index="3">
                                <div class="placeholder-text">300 x 200</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stage 3: Packages -->
            <div class="main-content" id="stage3" style="display: none;">
                <h2>Package Details</h2>
                <div class="packages">
                    <div class="package-panel basic">
                        <h3>Basic Package</h3>
                        <div class="form-group">
                            <label>Package Type</label>
                            <input type="text" value="Basic" readonly name="basic_package_type">
                        </div>
                        <div class="form-group">
                            <label>Benefits</label>
                            <textarea rows="4" placeholder="List the features included in this package..." 
                                required name="basic_package_benefits"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Delivery Days</label>
                            <input type="number" min="1" max="30" placeholder="Number of days" 
                                required name="basic_package_delivery_days">
                        </div>
                        <div class="form-group">
                            <label>Revisions</label>
                            <input type="number" min="0" max="10" placeholder="Number of revisions" 
                                name="basic_package_revisions">
                        </div>
                        <div class="form-group">
                            <label>Price (USD)</label>
                            <input type="number" min="5" step="5" placeholder="Enter price" 
                                required name="basic_package_price">
                        </div>
                    </div>

                    <div class="package-panel premium">
                        <h3>Premium Package</h3>
                        <div class="form-group">
                            <label>Package Type</label>
                            <input type="text" value="Premium" readonly name="premium_package_type">
                        </div>
                        <div class="form-group">
                            <label>Benefits</label>
                            <textarea rows="4" placeholder="List the features included in this package..." 
                                required name="premium_package_benefits"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Delivery Days</label>
                            <input type="number" min="1" max="30" placeholder="Number of days" 
                                required name="premium_package_delivery_days">
                        </div>
                        <div class="form-group">
                            <label>Revisions</label>
                            <input type="number" min="0" max="10" placeholder="Number of revisions" 
                                name="premium_package_revisions">
                        </div>
                        <div class="form-group">
                            <label>Price (USD)</label>
                            <input type="number" min="5" step="5" placeholder="Enter price" 
                                required name="premium_package_price">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="button-group">
                <button type="button" class="btn btn-secondary" id="backBtn">Back</button>
                <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
            </div>
        </form>

        <!-- Notification -->
        <div class="notification" id="notification"></div>
    </div>

    <script>
        const CONFIG = {
            DELIVERY_FORMATS: [
                { value: 'jpg', label: 'JPG' },
                { value: 'png', label: 'PNG' },
                { value: 'psd', label: 'PSD' },
                { value: 'ai', label: 'AI' },
                { value: 'svg', label: 'SVG' }
            ],
            
            SERVICE_TYPES: [
                { value: 'graphic_design', label: 'Graphic Design' },
                { value: 'web_development', label: 'Web Development' },
                { value: 'digital_marketing', label: 'Digital Marketing' }
            ],
            
            PLATFORMS: [
                { value: 'facebook', label: 'Facebook' },
                { value: 'instagram', label: 'Instagram' },
                { value: 'twitter', label: 'Twitter' },
                { value: 'linkedin', label: 'LinkedIn' }
            ],
            
            API_ENDPOINTS: {
                CREATE_PROMOTION: '/api/create-promotion'
            }
        }; 

        class ImageUploader {
            constructor() {
                this.mainImageFile = null;
                this.additionalImages = [];
                this.maxFileSize = 5; // MB
                this.allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            }

            init() {
                this.setupListeners();
            }

            setupListeners() {
                const mainImageInput = document.getElementById('mainImageInput');
                const additionalImagesInput = document.getElementById('additionalImagesInput');
                
                if (mainImageInput) {
                    mainImageInput.addEventListener('change', (e) => this.handleMainImageUpload(e));
                }
                
                if (additionalImagesInput) {
                    additionalImagesInput.addEventListener('change', (e) => this.handleAdditionalImagesUpload(e));
                }
            }

            handleMainImageUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                if (!this.validateImage(file)) {
                    return;
                }

                console.log('mainImageFile', file);

                this.mainImageFile = file;
                this.displayMainImagePreview(file);
            }

            handleAdditionalImagesUpload(event) {
                const files = Array.from(event.target.files);
                
                files.forEach(file => {
                    if (this.validateImage(file)) {
                        if (this.additionalImages.length < 4) {
                            this.additionalImages.push(file);
                            this.displayAdditionalImagePreview(file);
                        } else {
                            this.showError('Maximum 4 additional images allowed');
                        }
                    }
                });
            }

            validateImage(file) {
                // Check file type
                if (!this.allowedTypes.includes(file.type)) {
                    this.showError('Invalid file type. Please upload JPG, PNG or WebP images only.');
                    return false;
                }

                // Check file size
                if (file.size > this.maxFileSize * 1024 * 1024) {
                    this.showError(`File size must be less than ${this.maxFileSize}MB`);
                    return false;
                }

                return true;
            }

            displayMainImagePreview(file) {
                const preview = document.getElementById('mainImagePreview');
                const placeholder = document.getElementById('mainImagePlaceholder');
                
                if (preview && placeholder) {
                    // Clear any existing preview
                    preview.src = '';
                    
                    // Create object URL for the image
                    const objectUrl = URL.createObjectURL(file);
                    
                    // Set up the preview image
                    preview.src = objectUrl;
                    preview.style.display = 'block';
                    
                    // Hide the placeholder text
                    placeholder.style.display = 'none';
                    
                    // Clean up object URL after image loads
                    preview.onload = () => {
                        URL.revokeObjectURL(objectUrl);
                    };
                }
            }

            displayAdditionalImagePreview(file) {
                const grid = document.querySelector('.additional-images-grid');
                if (!grid) return;

                // Find the first empty placeholder
                const emptyPlaceholder = Array.from(grid.children).find(placeholder => {
                    return !placeholder.querySelector('img');
                });

                if (emptyPlaceholder) {
                    // Clear the placeholder text
                    const placeholderText = emptyPlaceholder.querySelector('.placeholder-text');
                    if (placeholderText) {
                        placeholderText.style.display = 'none';
                    }

                    // Create and add the image
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    
                    // Create remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.className = 'remove-image-btn';
                    removeBtn.onclick = () => {
                        this.removeAdditionalImage(file, img, emptyPlaceholder);
                    };

                    emptyPlaceholder.appendChild(img);
                    emptyPlaceholder.appendChild(removeBtn);

                    // Clean up object URL after image loads
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    };
                }
            }

            removeAdditionalImage(file, img, placeholder) {
                const index = this.additionalImages.indexOf(file);
                if (index > -1) {
                    this.additionalImages.splice(index, 1);
                    
                    // Remove the image and button
                    img.remove();
                    const removeBtn = placeholder.querySelector('.remove-image-btn');
                    if (removeBtn) {
                        removeBtn.remove();
                    }

                    // Show placeholder text again
                    const placeholderText = placeholder.querySelector('.placeholder-text');
                    if (placeholderText) {
                        placeholderText.style.display = 'block';
                    }
                }
            }

            showError(message) {
                // If NotificationManager is available, use it
                if (window.NotificationManager) {
                    window.NotificationManager.showError(message);
                } else {
                    alert(message);
                }
            }

            // Method to get all selected images
            getSelectedImages() {
                return {
                    mainImage: this.mainImageFile,
                    additionalImages: [...this.additionalImages]
                };
            }

            hasMainImage() {
                return this.mainImageFile !== null;
            }
        } 

        class NotificationManager {
            constructor() {
                this.element = document.getElementById('notification');
                this.timeout = null;
            }

            show(message, type = 'success') {
                clearTimeout(this.timeout);
                
                this.element.textContent = message;
                this.element.className = `notification ${type}`;
                this.element.style.display = 'block';
                
                this.timeout = setTimeout(() => {
                    this.hide();
                }, 3000);
            }

            hide() {
                this.element.style.display = 'none';
            }
        }
        
        class FormValidator {
            validateStage(stageNumber, formData) {
                const errors = [];
                
                switch(stageNumber) {
                    case 1:
                        this.validateStage1(formData, errors);
                        break;
                    case 2:
                        this.validateStage2(formData, errors);
                        break;
                    case 3:
                        this.validateStage3(formData, errors);
                        break;
                }
                
                return errors;
            }

            validateStage1(stageElement) {
                const title = stageElement.querySelector('#promotionTitle').value;
                const description = stageElement.querySelector('#promotionDescription').value;
                const serviceType = stageElement.querySelector('#serviceType').value;
                const deliveryFormats = stageElement.querySelectorAll('input[name="delivery_formats"]:checked');
                const platforms = stageElement.querySelectorAll('input[name="platforms"]:checked');

                if (!title || title.length > 80) {
                    this.showError('Please enter a valid title (max 80 characters)');
                    return false;
                }

                if (!description || description.length < 50) {
                    this.showError('Please enter a detailed description (min 50 characters)');
                    return false;
                }

                if (!serviceType) {
                    this.showError('Please select a service type');
                    return false;
                }

                if (deliveryFormats.length === 0) {
                    this.showError('Please select at least one delivery format');
                    return false;
                }

                if (platforms.length === 0) {
                    this.showError('Please select at least one platform');
                    return false;
                }

                return true;
            }

            validateStage2(imageUploader) {
                if (!imageUploader.hasMainImage()) {
                    this.showError('Please upload a main image');
                    return false;
                }
                return true;
            }

            validateStage3(stageElement) {
                const basicPackage = stageElement.querySelector('.package-panel.basic');
                const premiumPackage = stageElement.querySelector('.package-panel.premium');

                if (!this.validatePackage(basicPackage) || !this.validatePackage(premiumPackage)) {
                    return false;
                }

                return true;
            }

            validatePackage(packageElement) {
                const benefits = packageElement.querySelector('textarea').value;
                const deliveryDays = packageElement.querySelector('input[type="number"][placeholder="Number of days"]').value;
                const price = packageElement.querySelector('input[type="number"][placeholder="Enter price"]').value;

                if (!benefits) {
                    this.showError('Please enter package benefits');
                    return false;
                }

                if (!deliveryDays || deliveryDays < 1 || deliveryDays > 30) {
                    this.showError('Please enter valid delivery days (1-30)');
                    return false;
                }

                if (!price || price < 5) {
                    this.showError('Please enter a valid price (minimum $5)');
                    return false;
                }

                return true;
            }

            showError(message) {
                // Assuming you have a notification manager instance
                const notification = new NotificationManager();
                notification.show(message, 'error');
            }
        } 

        class PromotionForm {
            constructor() {
                this.currentStage = 1;
                this.totalStages = 3;
                this.tags = [];
                this.imageUploader = new ImageUploader();
                this.notification = new NotificationManager();
                this.validator = new FormValidator();
                
                this.elements = {
                    form: document.getElementById('promotionForm'),
                    stages: Array.from(document.querySelectorAll('.main-content')),
                    progressSteps: Array.from(document.querySelectorAll('.progress-step')),
                    nextBtn: document.getElementById('nextBtn'),
                    backBtn: document.getElementById('backBtn'),
                    tagsInput: document.querySelector('#tagsInput input')
                };
            }

            init() {
                this.setupEventListeners();
                this.populateFormOptions();
                this.showStage(1);
            }

            setupEventListeners() {
                this.elements.nextBtn.addEventListener('click', () => this.handleNext());
                this.elements.backBtn.addEventListener('click', () => this.handleBack());
                this.elements.tagsInput.addEventListener('keydown', (e) => this.handleTagInput(e));
                this.elements.form.addEventListener('submit', (e) => this.handleSubmit(e));
                
                // Setup image upload listeners
                this.imageUploader.init();
            }

            populateFormOptions() {
                // console.log('Populating form options...');
                // Populate delivery formats
                const deliveryFormatsContainer = document.getElementById('deliveryFormats');
                CONFIG.DELIVERY_FORMATS.forEach(format => {
                    deliveryFormatsContainer.innerHTML += `
                        <label class="checkbox-item">
                            <input type="checkbox" name="delivery_formats" value="${format.value}">
                            <span>${format.label}</span>
                        </label>
                    `;
                });

                // Populate service types
                const serviceTypeSelect = document.getElementById('serviceType');
                CONFIG.SERVICE_TYPES.forEach(type => {
                    serviceTypeSelect.innerHTML += `
                        <option value="${type.value}">${type.label}</option>
                    `;
                });

                // Populate platforms
                const platformsContainer = document.getElementById('platforms');
                CONFIG.PLATFORMS.forEach(platform => {
                    platformsContainer.innerHTML += `
                        <label class="checkbox-item">
                            <input type="checkbox" name="platforms" value="${platform.value}">
                            <span>${platform.label}</span>
                        </label>
                    `;
                });
            }

            showStage(stageNumber) {
                this.elements.stages.forEach((stage, index) => {
                    stage.style.display = index + 1 === stageNumber ? 'block' : 'none';
                });

                this.elements.progressSteps.forEach((step, index) => {
                    if (index + 1 === stageNumber) {
                        step.classList.add('active');
                    } else if (index + 1 < stageNumber) {
                        step.classList.add('completed');
                    } else {
                        step.classList.remove('active', 'completed');
                    }
                });

                // Update button text based on stage
                this.elements.nextBtn.textContent = stageNumber === this.totalStages ? 'Submit' : 'Next';
                this.elements.backBtn.style.display = stageNumber === 1 ? 'none' : 'block';
            }

            handleNext() {
                if (!this.validateCurrentStage()) {
                    // this.notification.show('Please fill out all required fields', 'error');
                    console.log('Please fill out all required fields');
                    return;
                }

                if (this.currentStage === this.totalStages) {
                    this.elements.form.requestSubmit();
                    return;
                }

                this.currentStage++;
                this.showStage(this.currentStage);
            }

            handleBack() {
                if (this.currentStage > 1) {
                    this.currentStage--;
                    this.showStage(this.currentStage);
                }
            }

            handleTagInput(event) {
                if (event.key === 'Enter' || event.key === ',') {
                    event.preventDefault();
                    const value = this.elements.tagsInput.value.trim();
                    
                    if (value && this.tags.length < 5) {
                        if (!this.tags.includes(value)) {
                            this.tags.push(value);
                            this.renderTags();
                        }
                    } else if (this.tags.length >= 5) {
                        this.notification.show('You can only add up to 5 tags', 'warning');
                    }
                    
                    this.elements.tagsInput.value = '';
                }
            }

            renderTags() {
                const tagsContainer = document.getElementById('tagsInput');
                const existingTags = tagsContainer.querySelectorAll('.tag');
                existingTags.forEach(tag => tag.remove());

                this.tags.forEach(tag => {
                    const tagElement = document.createElement('span');
                    tagElement.classList.add('tag');
                    tagElement.innerHTML = `
                        ${tag}
                        <span class="remove-tag" onclick="promotionForm.removeTag('${tag}')">&times;</span>
                    `;
                    tagsContainer.insertBefore(tagElement, this.elements.tagsInput);
                });
            }

            removeTag(tagToRemove) {
                this.tags = this.tags.filter(tag => tag !== tagToRemove);
                this.renderTags();
            }

            validateCurrentStage() {
                const currentStageElement = this.elements.stages[this.currentStage - 1];
                
                switch (this.currentStage) {
                    case 1:
                        return this.validator.validateStage1(currentStageElement);
                    case 2:
                        return this.validator.validateStage2(this.imageUploader);
                    case 3:
                        return this.validator.validateStage3(currentStageElement);
                    default:
                        return false;
                }
            }

            async handleSubmit(event) {
                event.preventDefault();

                if (!this.validateCurrentStage()) {
                    return;
                }

                try {
                    const formData = new FormData(this.elements.form);
                    
                    // Handle multiple checkbox selections for delivery formats and platforms
                    const deliveryFormats = Array.from(document.querySelectorAll('input[name="delivery_formats"]:checked'))
                        .map(checkbox => checkbox.value);
                    const platforms = Array.from(document.querySelectorAll('input[name="platforms"]:checked'))
                        .map(checkbox => checkbox.value);
                    
                    // Remove individual checkbox entries
                    formData.delete('delivery_formats');
                    formData.delete('platforms');
                    
                    // Add arrays as JSON strings
                    formData.append('delivery_formats', JSON.stringify(deliveryFormats));
                    formData.append('platforms', JSON.stringify(platforms));
                    
                    // Add tags to form data
                    formData.append('tags', JSON.stringify(this.tags));
                    
                    // Add images to form data
                    const images = this.imageUploader.getSelectedImages();
                    formData.append('mainImage', images.mainImage);
                    
                    images.additionalImages.forEach((image, index) => {
                        formData.append(`additionalImage${index}`, image);
                    });

                    // Structure package data as associative array
                    const packageData = {
                        'packages[basic][package_type]': formData.get('basic_package_type'),
                        'packages[basic][benefits]': formData.get('basic_package_benefits'),
                        'packages[basic][delivery_days]': formData.get('basic_package_delivery_days'),
                        'packages[basic][revisions]': formData.get('basic_package_revisions'),
                        'packages[basic][price]': formData.get('basic_package_price'),
                        
                        'packages[premium][package_type]': formData.get('premium_package_type'),
                        'packages[premium][benefits]': formData.get('premium_package_benefits'),
                        'packages[premium][delivery_days]': formData.get('premium_package_delivery_days'),
                        'packages[premium][revisions]': formData.get('premium_package_revisions'),
                        'packages[premium][price]': formData.get('premium_package_price')
                    };

                    // Structure media data as associative array of additional images uploaded
                    const media = {};


                    // Remove old package fields from FormData
                    formData.delete('basic_package_type');
                    formData.delete('basic_package_benefits');
                    formData.delete('basic_package_delivery_days');
                    formData.delete('basic_package_revisions');
                    formData.delete('basic_package_price');
                    formData.delete('premium_package_type');
                    formData.delete('premium_package_benefits');
                    formData.delete('premium_package_delivery_days');
                    formData.delete('premium_package_revisions');
                    formData.delete('premium_package_price');

                    // Add structured package data to FormData
                    Object.entries(packageData).forEach(([key, value]) => {
                        formData.append(key, value);
                    });

                    // Log FormData in a readable way
                    const formDataObj = {};
                    formData.forEach((value, key) => {
                        // Handle file objects specially
                        if (value instanceof File) {
                            formDataObj[key] = {
                                fileName: value.name,
                                fileType: value.type,
                                fileSize: `${(value.size / 1024).toFixed(2)} KB`
                            };
                        } else {
                            formDataObj[key] = value;
                        }
                    });
                    console.log('Form Data:', formDataObj);

                    const response = await fetch('/api/create-promotion', {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error('Failed to create promotion');
                    }

                    const data = await response.json();
                    this.notification.show('promotion created successfully!', 'success');
                    
                    // Redirect to the promotion page after successful creation
                    setTimeout(() => {
                        window.location.href = '/influencer/my-promotions';
                    }, 3000);

                } catch (error) {
                    console.error('Error creating promotion:', error);
                    this.notification.show('Failed to create promotion. Please try again.', 'error');
                }
            }
        } 

        let promotionForm; // Declare promotionForm in the global scope

        document.addEventListener('DOMContentLoaded', () => {
            promotionForm = new PromotionForm();
            promotionForm.init();
        }); 
    </script>
</body>

</html>