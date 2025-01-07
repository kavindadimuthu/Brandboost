<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Gig - Brandboost</title>
    <style>
        :root {
            --primary: #4169E1;
            --primary-gradient: linear-gradient(135deg, #4169E1, #8A2BE2);
            --secondary: #64748b;
            --success: #22c55e;
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

        .tag-remove {
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

        .upload-area.dragover {
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
    </style>
</head>

<body>
    <div class="container">
        <!-- Progress Timeline -->
        <div class="progress-timeline" id="progressTimeline">
            <div class="progress-step active">
                1
                <span class="step-label">Gig Details</span>
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

        <!-- Stage 1: Gig Details -->
        <div class="main-content" id="stage1">
            <h2>Gig Details</h2>
            <div class="form-group">
                <label for="gigTitle">Gig Title</label>
                <input type="text" id="gigTitle" placeholder="e.g., Professional Logo Design" required>
                <small>Make it clear and catchy (max 80 characters)</small>
            </div>

            <div class="form-group">
                <label for="gigDescription">Gig Description</label>
                <textarea id="gigDescription" rows="6" placeholder="Describe your services in detail..."
                    required></textarea>
                <small>Include your process, what clients will receive, and your unique value proposition</small>
            </div>

            <div class="form-group">
                <label for="deliveryFormats">Delivery Formats</label>
                <select id="deliveryFormats" multiple required>
                    <option value="jpg">JPG</option>
                    <option value="png">PNG</option>
                    <option value="psd">PSD</option>
                    <option value="ai">AI</option>
                    <option value="svg">SVG</option>
                </select>
            </div>

            <div class="form-group">
                <label for="serviceType">Service Type</label>
                <select id="serviceType" required>
                    <option value="graphic_design">Graphic Design</option>
                    <option value="web_development">Web Development</option>
                    <option value="digital_marketing">Digital Marketing</option>
                    <!-- Add other service types as needed -->
                </select>
            </div>

            <div class="form-group">
                <label>Platforms</label>
                <select id="platforms" multiple required>
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Twitter">Twitter</option>
                    <option value="LinkedIn">LinkedIn</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tags</label>
                <div class="tags-input" id="tagsInput">
                    <input type="text" placeholder="Type and press Enter to add tags">
                </div>
                <small>Add up to 5 relevant tags to help buyers find your gig</small>
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
                    <img class="image-preview" id="mainImagePreview" alt="Preview">
                </div>
            </div>

            <div class="form-group">
                <label>Additional Images</label>
                <div class="upload-area" id="additionalImagesUpload">
                    <p>Add up to 4 more images</p>
                    <p><small>Max size: 5MB each, Formats: JPG/PNG</small></p>
                    <div id="additionalImagesPreview"></div>
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
                        <input type="text" value="Basic" readonly>
                    </div>
                    <div class="form-group">
                        <label>Benefits</label>
                        <textarea rows="4" placeholder="List the features included in this package..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Delivery Days</label>
                        <input type="number" min="1" max="30" placeholder="Number of days" required>
                    </div>
                    <div class="form-group">
                        <label>Revisions</label>
                        <input type="number" min="0" max="10" placeholder="Number of revisions">
                    </div>
                    <div class="form-group">
                        <label>Price (USD)</label>
                        <input type="number" min="5" step="5" placeholder="Enter price" required>
                    </div>
                </div>

                <div class="package-panel premium">
                    <h3>Premium Package</h3>
                    <div class="form-group">
                        <label>Package Type</label>
                        <input type="text" value="Premium" readonly>
                    </div>
                    <div class="form-group">
                        <label>Benefits</label>
                        <textarea rows="4" placeholder="List the features included in this package..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Delivery Days</label>
                        <input type="number" min="1" max="30" placeholder="Number of days" required>
                    </div>
                    <div class="form-group">
                        <label>Revisions</label>
                        <input type="number" min="0" max="10" placeholder="Number of revisions">
                    </div>
                    <div class="form-group">
                        <label>Price (USD)</label>
                        <input type="number" min="5" step="5" placeholder="Enter price" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Additional Notes</label>
                <textarea rows="3" placeholder="Any additional information about your packages..."></textarea>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="button-group">
            <button type="button" class="btn btn-secondary" id="backBtn">Back</button>
            <!-- <button type="button" class="btn btn-secondary" id="saveBtn">Save Progress</button> -->
            <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
        </div>

        <!-- Notification -->
        <div class="notification" id="notification">
            Progress saved successfully
        </div>
    </div>

    <script>
        // Previous JavaScript remains the same
        // Stage Management
        let currentStage = 1;
        const totalStages = 3;

        function showStage(stageNumber) {
            document.querySelectorAll('.main-content').forEach(content => {
                content.style.display = 'none';
            });
            document.getElementById(`stage${stageNumber}`).style.display = 'block';

            // Update progress steps
            document.querySelectorAll('.progress-step').forEach((step, index) => {
                step.classList.remove('active', 'completed');
                if (index + 1 === stageNumber) {
                    step.classList.add('active');
                } else if (index + 1 < stageNumber) {
                    step.classList.add('completed');
                }
            });

            // Update button text for final stage
            const nextBtn = document.getElementById('nextBtn');
            nextBtn.textContent = stageNumber === totalStages ? 'Preview & Publish' : 'Next';
        }

        // Navigation
        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentStage < totalStages) {
                currentStage++;
                showStage(currentStage);
            } else {
                // Handle preview and publish
                showPublishConfirmation();
            }
        });

        document.getElementById('backBtn').addEventListener('click', () => {
            if (currentStage > 1) {
                currentStage--;
                showStage(currentStage);
            }
        });


        // Tags Input Functionality
        const tagsInput = document.querySelector('#tagsInput input');
        const tagsContainer = document.getElementById('tagsInput');
        let tags = [];

        tagsInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && tagsInput.value.trim() && tags.length < 5) {
                e.preventDefault();
                const tag = tagsInput.value.trim();
                if (!tags.includes(tag)) {
                    tags.push(tag);
                    renderTags();
                }
                tagsInput.value = '';
            }
        });

        function renderTags() {
            const existingTags = tagsContainer.querySelectorAll('.tag');
            existingTags.forEach(tag => tag.remove());

            tags.forEach(tag => {
                const tagElement = document.createElement('span');
                tagElement.classList.add('tag');
                tagElement.innerHTML = `
                    ${tag}
                    <span class="tag-remove" onclick="removeTag('${tag}')">&times;</span>
                `;
                tagsContainer.insertBefore(tagElement, tagsInput);
            });
        }

        function removeTag(tag) {
            tags = tags.filter(t => t !== tag);
            renderTags();
        }

        // File Upload Handling
        const mainImageUpload = document.getElementById('mainImageUpload');
        const mainImagePreview = document.getElementById('mainImagePreview');
        let mainImageFile = null;

        function handleFileUpload(file, previewElement) {
            // Validate file
            if (!file.type.startsWith('image/')) {
                alert('Please upload an image file');
                return;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert('File size should not exceed 5MB');
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = (e) => {
                previewElement.src = e.target.result;
                previewElement.style.display = 'block';
            };
            reader.readAsDataURL(file);
            return file;
        }

        // Main image upload
        mainImageUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            mainImageUpload.classList.add('dragover');
        });

        mainImageUpload.addEventListener('dragleave', () => {
            mainImageUpload.classList.remove('dragover');
        });

        mainImageUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            mainImageUpload.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            mainImageFile = handleFileUpload(file, mainImagePreview);
        });

        mainImageUpload.addEventListener('click', () => {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = (e) => {
                const file = e.target.files[0];
                mainImageFile = handleFileUpload(file, mainImagePreview);
            };
            input.click();
        });

        // Save Progress
        const saveBtn = document.getElementById('saveBtn');
        const notification = document.getElementById('saveNotification');

        function saveProgress() {
            // Collect form data
            const formData = {
                stage: currentStage,
                gigTitle: document.getElementById('gigTitle').value,
                gigDescription: document.getElementById('gigDescription').value,
                deliveryFormats: Array.from(document.getElementById('deliveryFormats').selectedOptions).map(opt => opt.value),
                tags: tags,
                mainImage: mainImageFile,
                // Add other form fields as needed
            };

            // Simulate saving to server
            console.log('Saving progress:', formData);

            // Show notification
            notification.style.display = 'block';
            notification.textContent = 'Progress saved successfully!';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        saveBtn.addEventListener('click', saveProgress);

        // Form Validation
        function validateStage(stageNumber) {
            let isValid = true;
            const stage = document.getElementById(`stage${stageNumber}`);

            // Validate required fields
            stage.querySelectorAll('input[required], textarea[required], select[required]').forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('invalid');
                }
            });

            // Stage-specific validation
            if (stageNumber === 1) {
                if (tags.length === 0) {
                    isValid = false;
                    alert('Please add at least one tag');
                }
            } else if (stageNumber === 2) {
                if (!mainImageFile) {
                    isValid = false;
                    alert('Please upload a main image');
                }
            } else if (stageNumber === 3) {
                // Validate package details
                const requiredPackageFields = ['Benefits', 'Delivery Days', 'Revisions', 'Price'];
                for (const field of requiredPackageFields) {
                    const basicField = document.querySelector(`.basic [placeholder*="${field}"]`);
                    const premiumField = document.querySelector(`.premium [placeholder*="${field}"]`);

                    if (!basicField.value.trim() || !premiumField.value.trim()) {
                        isValid = false;
                        alert('Please complete all package details');
                        break;
                    }
                }
            }

            return isValid;
        }

        // Preview & Publish
        function showPublishConfirmation() {
            if (validateStage(currentStage)) {
                if (confirm('Would you like to preview your gig before publishing?')) {
                    // Show preview (implement preview logic)
                    console.log('Showing preview');
                } else {
                    publishGig();
                }
            }
        }

        // function publishGig() {
        //     // Validate all stages
        //     for (let i = 1; i <= totalStages; i++) {
        //         if (!validateStage(i)) {
        //             currentStage = i;
        //             showStage(i);
        //             return;
        //         }
        //     }

        //     // Simulate publishing
        //     console.log('Publishing gig...');
        //     notification.style.display = 'block';
        //     notification.textContent = 'Your gig has been successfully published!';
        //     setTimeout(() => {
        //         notification.style.display = 'none';
        //         // Redirect to gig page or dashboard
        //     }, 3000);
        // }

        // Replace the publishGig function with this updated version:
        function publishGig() {
            // Validate all stages
            for (let i = 1; i <= totalStages; i++) {
                if (!validateStage(i)) {
                    currentStage = i;
                    showStage(i);
                    return;
                }
            }

            // Collect all form data
            const basicPackage = document.querySelector('.package-panel.basic');
            const premiumPackage = document.querySelector('.package-panel.premium');

            const gigData = {
                user_id: 1, // This should be dynamically set based on logged-in user
                title: document.getElementById('gigTitle').value,
                description: document.getElementById('gigDescription').value,
                cover_image: mainImageFile ? mainImageFile.name : null,
                imageUploadPaths: Array.from(document.querySelectorAll('#additionalImagesPreview img'))
                    .map(img => img.src),
                service_type: document.getElementById('serviceType').value,
                platforms: Array.from(document.getElementById('platforms').selectedOptions)
                    .map(option => option.value),
                delivery_formats: Array.from(document.getElementById('deliveryFormats').selectedOptions)
                    .map(option => option.value),
                tags: tags,
                packages: [{
                        package_type: 'Basic',
                        benefits: basicPackage.querySelector('textarea').value,
                        delivery_days: parseInt(basicPackage.querySelector('input[type="number"][placeholder*="days"]').value),
                        revisions: parseInt(basicPackage.querySelector('input[type="number"][placeholder*="revisions"]').value) || null,
                        price: parseFloat(basicPackage.querySelector('input[type="number"][placeholder*="price"]').value)
                    },
                    {
                        package_type: 'Premium',
                        benefits: premiumPackage.querySelector('textarea').value,
                        delivery_days: parseInt(premiumPackage.querySelector('input[type="number"][placeholder*="days"]').value),
                        revisions: parseInt(premiumPackage.querySelector('input[type="number"][placeholder*="revisions"]').value) || null,
                        price: parseFloat(premiumPackage.querySelector('input[type="number"][placeholder*="price"]').value)
                    }
                ]
            };

            console.log('Gig data:', gigData);

            // Send data to backend
            fetch('/api/create-gig', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(gigData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        notification.style.display = 'block';
                        notification.textContent = data.message;
                        setTimeout(() => {
                            notification.style.display = 'none';
                            window.location.href = `/gigs/${data.service_id}`;
                        }, 3000);
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    notification.style.display = 'block';
                    notification.textContent = 'Failed to create gig: ' + error.message;
                    notification.style.backgroundColor = '#ff4444';
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 3000);
                });
        }

        // Initialize
        showStage(1);

        // Auto-save
        let autoSaveTimeout;
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('input', () => {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(saveProgress, 2000);
            });
        });
    </script>
</body>

</html>