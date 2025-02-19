<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placement Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
            /* padding: 20px; */
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            margin-top: 20px;
        }

        /* Cards */
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            color: #1f2937;
        }

        .badge {
            background: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Gig Details */
        .gig-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
            padding: 20px 0;
            border-top: 1px solid #e5e7eb;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .feature-icon {
            color: #3b82f6;
            font-size: 1.25rem;
        }

        .feature-label {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .feature-value {
            font-weight: 600;
            color: #1f2937;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #4b5563;
        }

        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            min-height: 120px;
            resize: vertical;
            transition: border-color 0.3s;
        }

        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .file-upload {
            border: 2px dashed #e5e7eb;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .file-upload:hover {
            border-color: #3b82f6;
        }

        .file-upload i {
            font-size: 2rem;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .file-list {
            margin-top: 15px;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            background: #f9fafb;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        /* Info Box */
        .info-box {
            background: #eff6ff;
            border-radius: 6px;
            padding: 15px;
            display: flex;
            gap: 12px;
            align-items: start;
            margin: 20px 0;
        }

        .info-box i {
            color: #3b82f6;
            margin-top: 3px;
        }

        /* Buttons */
        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
        }

        button {
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: white;
            color: #4b5563;
            border: 1px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .gig-features {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Gig Details Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Professional Business Plan Writing</h2>
                <span class="badge">Premium Service</span>
            </div>
            <p style="color: #6b7280; margin-bottom: 20px;">Complete business planning solution for your venture</p>
            <div class="gig-features">
                <div class="feature-item">
                    <i class="fas fa-clock feature-icon"></i>
                    <div>
                        <div class="feature-label">Delivery Time</div>
                        <div class="feature-value delivery-time">0 Days</div>
                    </div>
                </div>
                <div class="feature-item">
                    <i class="fas fa-sync feature-icon"></i>
                    <div>
                        <div class="feature-label">Revisions</div>
                        <div class="feature-value revisions">0 Revisions</div>
                    </div>
                </div>
                <div class="feature-item">
                    <i class="fas fa-dollar-sign feature-icon"></i>
                    <div>
                        <div class="feature-label">Price</div>
                        <div class="feature-value price">$0</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Form -->
        <div class="card">
            <h2 class="card-title" style="margin-bottom: 20px;">Project Requirements</h2>
            <form id="orderForm">
                <div class="form-group">
                    <label for="requirements">Detailed Requirements</label>
                    <textarea id="requirements" placeholder="Please describe your specific requirements..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Project Description</label>
                    <textarea id="description" placeholder="Additional details about your business..." required></textarea>
                </div>

                <div class="form-group">
                    <label>Supporting Documents</label>
                    <div class="file-upload" id="dropZone">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Drag and drop files here or click to browse</p>
                        <input type="file" id="fileInput" multiple style="display: none">
                    </div>
                    <div class="file-list" id="fileList"></div>
                </div>

                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <p>Your order will be handled with priority. Our expert team will review your requirements and may contact you if additional information is needed.</p>
                </div>

                <div class="button-group">
                    <button type="button" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-primary">Place Order</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // File Upload Handling
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');

        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = urlParams.get('service_id');
        const packageId = urlParams.get('package_id');

        if (!serviceId) {
          throw new Error('Gig ID is required in the URL');
        }

        async function fetchServiceDetails(serviceId) {
            try {
                const response = await fetch(`/api/service/${serviceId}?service=true&packages=true&include_user=true`);
                const result = await response.json();
                console.log(result);
                updateGigFeatures(result);
            } catch (error) {
                console.error('Error fetching service details:', error);
            }
        }

        function updateGigFeatures(data) {
            console.log(data);
            const packageDetails = data.packages.find(pkg => pkg.package_id == packageId);
            console.log(packageDetails);
            if (packageDetails) {
                document.querySelector('.feature-value.delivery-time').textContent = `${packageDetails.delivery_days} Days`;
                document.querySelector('.feature-value.revisions').textContent = `${packageDetails.revisions} Revisions`;
                document.querySelector('.feature-value.price').textContent = `$${packageDetails.price}`;
            }
        }

        fetchServiceDetails(serviceId);

        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#3b82f6';
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = '#e5e7eb';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#e5e7eb';
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', () => {
            handleFiles(fileInput.files);
        });

        function handleFiles(files) {
            fileList.innerHTML = '';
            Array.from(files).forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <i class="fas fa-file"></i>
                    <span>${file.name}</span>
                `;
                fileList.appendChild(fileItem);
            });
        }

        // Form Submission
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const urlParams = new URLSearchParams(window.location.search);
            const serviceId = urlParams.get('service_id');
            const packageId = urlParams.get('package_id');

            const formData = new FormData();
            formData.append('requirements', document.getElementById('requirements').value);
            formData.append('description', document.getElementById('description').value);
            Array.from(fileInput.files).forEach(file => {
                formData.append('documents[]', file);
            });
            formData.append('service_id', serviceId);
            formData.append('package_id', packageId);
            formData.append('payment_type', 'paypal');
            formData.append('promises', JSON.stringify({
                accepted_service: ['business_plan'],
                delivery_days: 7,
                number_of_revisions: 2,
                price: 500
            }));

            // Simulated API call
            console.log('Form submitted:', Object.fromEntries(formData));
            fetch('/api/create-order', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Order placed successfully!');
                            } else {
                                alert('Failed to place order. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
        });
    </script>
</body>
</html>
