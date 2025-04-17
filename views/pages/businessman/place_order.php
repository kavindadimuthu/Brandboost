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
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            margin-top: 20px;
        }

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

        .info-box {
            background: #eff6ff;
            border-radius: 6px;
            padding: 15px;
            display: flex;
            gap: 12px;
            align-items: start;
            margin: 20px 0;
        }

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

        .payment-terms {
            background: #fef3c7;
            border-left: 4px solid #d97706;
            padding: 16px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .payment-terms h4 {
            color: #d97706;
            margin-bottom: 8px;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 25px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-close {
            cursor: pointer;
            font-size: 1.5rem;
            color: #6b7280;
            transition: color 0.3s;
        }

        .modal-close:hover {
            color: #1f2937;
        }

        .payment-method-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            margin: 15px 0;
            font-size: 1rem;
        }

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

            .modal-content {
                padding: 15px;
            }
        }
        /* Add to CSS */
        .loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
            margin-left: -10px;
            margin-top: -10px;
        }
    </style>
</head>
<body>
    <!-- Payment Modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Payment</h3>
                <span class="modal-close" onclick="closePaymentModal()">&times;</span>
            </div>
            <div class="form-group">
                <label>Payment Method</label>
                <select class="payment-method-select" id="paymentMethod">
                    <option value="paypal">PayPal</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="stripe">Stripe</option>
                </select>
            </div>
            <div class="form-group">
                <label>Total Amount</label>
                <div class="feature-value price" id="modalTotalAmount" style="font-size: 1.5rem; margin: 10px 0;">$0</div>
            </div>
            <button class="btn-primary" id="paymentButton" onclick="proceedToPayment()">Proceed to Pay</button>
        </div>
    </div>

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

                <div class="payment-terms">
                    <h4><i class="fas fa-shield-alt"></i> Secure Escrow Payment</h4>
                    <p>
                        Your payment of $<span id="escrowAmount">0</span> will be held securely in our system. 
                        Funds will be automatically released to the seller on <span id="releaseDate"></span>.
                    </p>
                </div>

                <div class="button-group">
                    <button type="button" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-primary">Place Order</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Global variables
        let currentPackageDetails = null;
        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = urlParams.get('service_id');
        const packageId = urlParams.get('package_id');

        // File Upload Handling
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');

        // Initialize service details
        if (!serviceId) {
            throw new Error('Service ID is required in the URL');
        }

        // Fetch service details
        async function fetchServiceDetails(serviceId) {
            try {
                const response = await fetch(`/api/service/${serviceId}?service=true&packages=true&include_user=true`);
                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(`API Error: ${errorText}`);
                }
                        
                const result = await response.json();
                console.log('Service Details:', result);
                
                updateGigFeatures(result);
            } catch (error) {
                console.error('Error fetching service details:', error);
            }
        }

        // Update gig features with package details
        function updateGigFeatures(data) {
            const packageDetails = data.packages.find(pkg => pkg.package_id == packageId);
            if (packageDetails) {
                currentPackageDetails = packageDetails;
                
                // Update visible elements
                document.querySelector('.feature-value.delivery-time').textContent = `${packageDetails.delivery_days} Days`;
                document.querySelector('.feature-value.revisions').textContent = `${packageDetails.revisions} Revisions`;
                document.querySelector('.feature-value.price').textContent = `$${packageDetails.price}`;
                document.getElementById('escrowAmount').textContent = packageDetails.price;
                
                // Update release date
                const releaseDate = new Date();
                releaseDate.setDate(releaseDate.getDate() + parseInt(packageDetails.delivery_days));
                document.getElementById('releaseDate').textContent = releaseDate.toLocaleDateString();

                // Update package badge
                const badgeElement = document.querySelector('.badge');
                badgeElement.textContent = packageDetails.package_type === 'basic' 
                    ? 'Basic Package' 
                    : 'Premium Package';
            }
        }

        // File handling events
        dropZone.addEventListener('click', () => fileInput.click());
        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('dragleave', handleDragLeave);
        dropZone.addEventListener('drop', handleDrop);
        fileInput.addEventListener('change', handleFileSelect);

        function handleDragOver(e) {
            e.preventDefault();
            dropZone.style.borderColor = '#3b82f6';
        }

        function handleDragLeave() {
            dropZone.style.borderColor = '#e5e7eb';
        }

        function handleDrop(e) {
            e.preventDefault();
            dropZone.style.borderColor = '#e5e7eb';
            handleFiles(e.dataTransfer.files);
        }

        function handleFileSelect() {
            handleFiles(fileInput.files);
        }

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

        // Form submission handling
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (currentPackageDetails) {
                showPaymentModal();
            }
        });

        // Payment modal functions
        function showPaymentModal() {
            document.getElementById('modalTotalAmount').textContent = `$${currentPackageDetails.price}`;
            document.getElementById('paymentModal').style.display = 'flex';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        async function proceedToPayment() {
            const paymentButton = document.getElementById('paymentButton');
            paymentButton.classList.add('loading');
            paymentButton.disabled = true;
            
            try {
                const paymentMethod = document.getElementById('paymentMethod').value;
                
                const formData = new FormData();
                formData.append('requirements', document.getElementById('requirements').value);
                formData.append('description', document.getElementById('description').value);
                Array.from(fileInput.files).forEach(file => {
                    formData.append('documents[]', file);
                });
                formData.append('service_id', serviceId);
                formData.append('package_id', packageId);
                formData.append('payment_type', paymentMethod);
                formData.append('promises', JSON.stringify({
                    accepted_service: ['business_plan'],
                    delivery_days: currentPackageDetails.delivery_days,
                    number_of_revisions: currentPackageDetails.revisions,
                    price: currentPackageDetails.price
                }));            

                // Submit form data
                const response = await fetch('/api/create-order', {
                    method: 'POST',
                    body: formData
                });

                const responseText = await response.text();
                
                try {
                    const data = JSON.parse(responseText);
                    if (data.success) {
                        alert('Order placed successfully!');
                        window.location.href = '/dashboard/orders';
                    } else {
                        alert(`Failed to place order: ${data.message || 'Unknown error'}`);
                    }
                } catch (jsonError) {
                    console.error('Failed to parse JSON response:', jsonError);
                    alert(`Error processing response: ${responseText.slice(0, 100)}`);
                }
            } catch (error) {
                console.error('Error:', error);
                alert(`Payment failed: ${error.message}`);
            } finally {
                paymentButton.classList.remove('loading');
                paymentButton.disabled = false;
                closePaymentModal();
            }
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('paymentModal');
            if (event.target === modal) {
                closePaymentModal();
            }
        }

        // Initialization
        fetchServiceDetails(serviceId);
    </script>
</body>
</html>