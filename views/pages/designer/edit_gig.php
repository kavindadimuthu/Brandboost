<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Gig - Brandboost</title>
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

        .page-header {
            margin-bottom: 2rem;
            padding: 1rem 0;
            border-bottom: 2px solid var(--border);
        }

        .page-header h1 {
            font-size: 2rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .main-content {
            background: white;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .section {
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border);
        }

        .section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary);
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

        .tag-remove {
            cursor: pointer;
            font-weight: bold;
            font-size: 1.25rem;
            background: none;
            border: none;
            color: white;
        }

        /* -------------------- */

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
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(65, 105, 225, 0.1);
            background: white;
        }

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
        }

        .package-panel.basic {
            border-color: var(--secondary);
        }

        .package-panel.premium {
            border-color: var(--primary);
            background: linear-gradient(to bottom right, #f8fafc, #e6f0ff);
        }

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
            border-color: var(--primary);
            background: #f1f5f9;
        }

        .image-preview {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        .preview-item {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: var(--error);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
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

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

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
            border-left: 4px solid var(--primary);
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .packages {
                grid-template-columns: 1fr;
            }

            .preview-item {
                width: 100%;
                max-width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Update Your Gig</h1>
        </div>

        <form id="updateGigForm">
            <div class="main-content">
                <!-- Basic Information Section -->
                <div class="section">
                    <h2 class="section-title">Basic Information</h2>
                    <div class="form-group">
                        <label for="gigTitle">Gig Title</label>
                        <input type="text" id="gigTitle" name="title" placeholder="e.g., Professional Logo Design" required maxlength="80">
                    </div>

                    <div class="form-group">
                        <label for="gigDescription">Gig Description</label>
                        <textarea id="gigDescription" name="description" rows="6" placeholder="Describe your services in detail..." required></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label for="serviceType">Service Type</label>
                        <select id="serviceType" name="serviceType" required>
                            <option value="gig">Gig</option>
                            <option value="service">Service</option>
                        </select>
                    </div> -->
                </div>

                <!-- Delivery & Platforms Section -->
                <div class="section">
                    <h2 class="section-title">Delivery & Platforms</h2>
                    <div class="form-group">
                        <label>Delivery Formats</label>
                        <div class="checkbox-group" id="deliveryFormats">
                            <label class="checkbox-item">
                                <input type="checkbox" name="delivery_formats" value="jpg">
                                <span>JPG</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="delivery_formats" value="png">
                                <span>PNG</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="delivery_formats" value="psd">
                                <span>PSD</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="delivery_formats" value="ai">
                                <span>AI</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="delivery_formats" value="svg">
                                <span>SVG</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Platforms</label>
                        <div class="checkbox-group" id="platforms">
                            <label class="checkbox-item">
                                <input type="checkbox" name="platforms" value="facebook">
                                <span>Facebook</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="platforms" value="instagram">
                                <span>Instagram</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="platforms" value="twitter">
                                <span>Twitter</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" name="platforms" value="linkedin">
                                <span>LinkedIn</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Tags Section -->
                <div class="section">
                    <h2 class="section-title">Tags</h2>
                    <div class="form-group">
                        <label>Tags</label>
                        <div class="tags-input" id="tagsInput">
                            <input type="text" placeholder="Type and press Enter to add tags">
                        </div>
                        <small>Add up to 5 relevant tags to help buyers find your gig</small>
                    </div>
                </div>

                <!-- Media Section -->
                <div class="section">
                    <h2 class="section-title">Media</h2>
                    <div class="form-group">
                        <label>Main Image</label>
                        <div class="upload-area" id="mainImageUpload">
                            <p>Click to update main image</p>
                            <input type="file" id="mainImageInput" accept="image/*" style="display: none">
                            <div class="image-preview" id="mainImagePreview"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Additional Images</label>
                        <div class="upload-area" id="additionalImagesUpload">
                            <p>Click to update additional images</p>
                            <input type="file" id="additionalImagesInput" accept="image/*" multiple style="display: none">
                            <div class="image-preview" id="additionalImagesPreview"></div>
                        </div>
                    </div>
                </div>

                <!-- Packages Section -->
                <div class="section">
                    <h2 class="section-title">Packages</h2>
                    <div class="packages">
                        <!-- Basic Package -->
                        <div class="package-panel basic">
                            <h3>Basic Package</h3>
                            <div class="form-group" style="display:none;">
                                <input type="hidden" name="basic_package_id" id="basic_package_id">
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

                        <!-- Premium Package -->
                        <div class="package-panel premium">
                            <h3>Premium Package</h3>
                            <div class="form-group" style="display:none;">
                                <input type="hidden" name="premium_package_id" id="premium_package_id">
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
            </div>

            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Gig</button>
            </div>
        </form>

        <div class="notification" id="notification"></div>
    </div>

    <script>
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

        class UpdateGigManager {
            constructor() {
                this.notification = new NotificationManager();
                this.setupFormElements();
                this.setupEventListeners();
                this.loadGigData();
                this.removedImages = []; // Array to track removed images
            }

            setupFormElements() {
                this.form = document.getElementById('updateGigForm');
                this.mainImageInput = document.getElementById('mainImageInput');
                this.mainImagePreview = document.getElementById('mainImagePreview');
                this.additionalImagesInput = document.getElementById('additionalImagesInput');
                this.additionalImagesPreview = document.getElementById('additionalImagesPreview');
            }

            setupEventListeners() {
                this.form.addEventListener('submit', (e) => this.handleSubmit(e));
                this.mainImageInput.addEventListener('change', (e) => this.handleMainImageChange(e));
                this.additionalImagesInput.addEventListener('change', (e) => this.handleAdditionalImagesChange(e));

                document.getElementById('mainImageUpload').addEventListener('click', () => {
                    this.mainImageInput.click();
                });
                document.getElementById('additionalImagesUpload').addEventListener('click', () => {
                    this.additionalImagesInput.click();
                });

                this.setupTagsInput();
            }

            setupTagsInput() {
                const tagsInput = document.querySelector('#tagsInput input');
                const tags = new Set();

                tagsInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter' && tags.size < 5) {
                        e.preventDefault();
                        const tag = tagsInput.value.trim();
                        if (tag && !tags.has(tag)) {
                            tags.add(tag);
                            this.addTagToDisplay(tag);
                            tagsInput.value = '';
                        }
                    }
                });
            }

            addTagToDisplay(tag) {
                const tagsContainer = document.createElement('span');
                tagsContainer.className = 'tag';
                tagsContainer.textContent = tag;

                // Create a remove button for the tag
                const removeButton = document.createElement('button');
                removeButton.className = 'tag-remove';
                removeButton.innerHTML = '×'; // You can use an icon or text for the remove button
                removeButton.onclick = () => {
                    this.removeTag(tag, tagsContainer); // Call the remove function
                };

                tagsContainer.appendChild(removeButton); // Append the remove button to the tag
                document.getElementById('tagsInput').appendChild(tagsContainer);
            }

            removeTag(tag, tagsContainer) {
                // Remove the tag from the displayed tags
                tagsContainer.remove();
                // Also remove the tag from the Set (if you are using one)
                const tags = Array.from(document.querySelectorAll('#tagsInput .tag')).map(tag => tag.textContent.replace('×', '').trim());
                const tagSet = new Set(tags);
                tagSet.delete(tag);
            }

            async loadGigData() {
                const pathSegments = window.location.pathname.split('/');
                const gigId = pathSegments[pathSegments.length - 1]; // Get the last segment

                if (!gigId) {
                    throw new Error('No gig ID provided');
                }

                const response = await fetch(`/api/service/${gigId}?packages=true&service=true`);

                if (!response.ok) {
                    throw new Error('Failed to fetch gig data');
                }

                const result = await response.json();
                console.log(result);
                try {
                    if (result) {
                        this.populateForm(result);
                    } else {
                        throw new Error('API response indicated failure');
                    }
                } catch (error) {
                    console.error('Error loading gig data:', error);
                    this.notification.show('Failed to load gig data', 'error');
                }
            }

            populateForm(data) {
                // const { service, packages } = data;
                const service = data;
                const packages = data.packages;

                // Populate basic information
                document.getElementById('gigTitle').value = service.title;
                document.getElementById('gigDescription').value = service.description;
                // document.getElementById('serviceType').value = service.service_type;

                // Populate delivery formats
                // const deliveryFormats = service.delivery_formats.split(',');
                const deliveryFormats = JSON.parse(service.delivery_formats);
                deliveryFormats.forEach(format => {
                    const checkbox = document.querySelector(`input[name="delivery_formats"][value="${format}"]`);
                    if (checkbox) checkbox.checked = true;
                });

                // Populate platforms
                // const platforms = service.platforms.split(',');
                const platforms = JSON.parse(service.platforms);
                platforms.forEach(platform => {
                    const checkbox = document.querySelector(`input[name="platforms"][value="${platform}"]`);
                    if (checkbox) checkbox.checked = true;
                });

                // Populate tags
                const tags = JSON.parse(service.tags);
                tags.forEach(tag => {
                    this.addTagToDisplay(tag);
                });

                // Populate images
                this.displayImage(this.mainImagePreview, service.cover_image, true);
                service.media.forEach(imageUrl => {
                    if (imageUrl !== service.cover_image) {
                        this.displayImage(this.additionalImagesPreview, imageUrl);
                    }
                });

                // Populate packages
                packages.forEach(pkg => {
                    const type = pkg.package_type;
                    document.querySelector(`[name="${type}_package_id"]`).value = pkg.package_id;
                    document.querySelector(`[name="${type}_package_benefits"]`).value = pkg.benefits;
                    document.querySelector(`[name="${type}_package_delivery_days"]`).value = pkg.delivery_days;
                    document.querySelector(`[name="${type}_package_revisions"]`).value = pkg.revisions;
                    document.querySelector(`[name="${type}_package_price"]`).value = parseFloat(pkg.price);
                });
            }

            displayImage(container, imageUrl, isMain = false) {
                const wrapper = document.createElement('div');
                wrapper.className = 'preview-item';

                const img = document.createElement('img');
                img.src = imageUrl;
                img.alt = 'Gig image';

                const removeButton = document.createElement('button');
                removeButton.className = 'remove-image';
                removeButton.innerHTML = '×';
                removeButton.onclick = (e) => {
                    e.stopPropagation();
                    this.removeImage(imageUrl, wrapper, isMain); // Call the remove function
                };

                wrapper.appendChild(img);
                wrapper.appendChild(removeButton);
                container.appendChild(wrapper);
            }

            removeImage(imageUrl, wrapper, isMain) {
                // Remove the image from the displayed images
                wrapper.remove();
                // Add the image URL to the removedImages array
                this.removedImages.push(imageUrl);
            }

            handleMainImageChange(event) {
                const file = event.target.files[0];
                if (file) {
                    this.mainImagePreview.innerHTML = '';
                    this.displayImage(this.mainImagePreview, URL.createObjectURL(file), true);
                }
            }

            handleAdditionalImagesChange(event) {
                const files = Array.from(event.target.files);
                files.forEach(file => {
                    if (this.additionalImagesPreview.children.length < 4) {
                        this.displayImage(this.additionalImagesPreview, URL.createObjectURL(file));
                    }
                });
            }

            async handleSubmit(event) {
                event.preventDefault();

                try {
                    const formData = new FormData(this.form);

                    // Add current images data
                    this.addImagesToFormData(formData);

                    // Add removed images to form data
                    formData.append('removedImages', JSON.stringify(this.removedImages));

                    // Add tags to form data
                    const tags = Array.from(document.querySelectorAll('#tagsInput .tag')).map(tag => tag.textContent.replace('×', '').trim());
                    formData.append('tags', JSON.stringify(tags));

                    // Convert delivery formats to JSON
                    const deliveryFormats = Array.from(this.form.querySelectorAll('input[name="delivery_formats"]:checked')).map(input => input.value);
                    formData.append('deliveryFormats', JSON.stringify(deliveryFormats));

                    // Convert platforms to JSON
                    const platforms = Array.from(this.form.querySelectorAll('input[name="platforms"]:checked')).map(input => input.value);
                    formData.append('platforms', JSON.stringify(platforms));

                    // Structure package data correctly
                    const basicPackage = {
                        package_id: document.querySelector('[name="basic_package_id"]').value,
                        benefits: document.querySelector('[name="basic_package_benefits"]').value,
                        delivery_days: document.querySelector('[name="basic_package_delivery_days"]').value,
                        revisions: document.querySelector('[name="basic_package_revisions"]').value,
                        price: document.querySelector('[name="basic_package_price"]').value
                    };
                    
                    const premiumPackage = {
                        package_id: document.querySelector('[name="premium_package_id"]').value,
                        benefits: document.querySelector('[name="premium_package_benefits"]').value,
                        delivery_days: document.querySelector('[name="premium_package_delivery_days"]').value,
                        revisions: document.querySelector('[name="premium_package_revisions"]').value,
                        price: document.querySelector('[name="premium_package_price"]').value
                    };

                    formData.append('packages[basic]', JSON.stringify(basicPackage));
                    formData.append('packages[premium]', JSON.stringify(premiumPackage));

                    const pathSegments = window.location.pathname.split('/');
                    const gigId = pathSegments[pathSegments.length - 1];
                    formData.append('id', gigId);

                    // Logging formdata for debugging
                    for (const [key, value] of formData.entries()) {
                        console.log(`${key}: ${value}`);
                    }

                    // Make API call to update gig
                    const response = await fetch(`/api/update-gig/${gigId}`, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error('Failed to update gig');
                    }

                    this.notification.show('Gig updated successfully!', 'success');
                    // setTimeout(() => {
                    //     window.location.href = '/designer/my-gigs';
                    // }, 1500);

                } catch (error) {
                    console.error('Error updating gig:', error);
                    this.notification.show('Failed to update gig. Please try again.', 'error');
                }
            }
            addImagesToFormData(formData) {
                if (this.mainImageInput.files.length > 0) {
                    formData.append('mainImage', this.mainImageInput.files[0]);
                }

                if (this.additionalImagesInput.files.length > 0) {
                    Array.from(this.additionalImagesInput.files).forEach((file, index) => {
                        formData.append(`additionalImage${index}`, file);
                    });
                }
            }
        }

        // Initialize the update gig manager when the DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new UpdateGigManager();
        });
    </script>
</body>

</html>