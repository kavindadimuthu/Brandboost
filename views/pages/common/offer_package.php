<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Package Request - Brandboost</title>
    <style>
        /* Global Styles */
        :root {
            --primary: #4169E1;
            --secondary: #8A2BE2;
            --text-dark: #333;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --white: #fff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Page Header */
        .page-header {
            /* background: linear-gradient(135deg, var(--primary), var(--secondary)); */
            background: var(--white);
            /* color: var(--white); */
            /* color: var(--primary); */
            max-width: 1200px;
            margin:  auto;
            /* padding: 0px 20px; */
            /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); */
            border-radius: 20px;
            /* text-align: center; */
        }

        .page-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        /* Main Content Layout */
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto 3rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            /* margin-top: 40px; */
        }

        /* Request Details Section */
        .request-details {
            background: var(--white);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .detail-group {
            margin-bottom: 24px;
        }

        .detail-group h3 {
            color: var(--primary);
            font-size: 18px;
            margin-bottom: 8px;
        }

        .detail-group p {
            color: var(--text-light);
        }

        /* Modification Form */
        .modification-form {
            background: var(--white);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary);
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
        }

        .original-value {
            font-style: italic;
            color: var(--text-light);
            font-size: 14px;
            margin-top: 4px;
        }

        /* Button Styles */
        .submit-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            border: none;
            border-radius: 12px;
            padding: 15px 35px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 28px;
            }
        }

        /* Error States */
        .form-control.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 4px;
            display: none;
        }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container">
            <h1>Custom Package Request</h1>
            <p>Review and modify the package details based on client requirements</p>
        </div>
    </header>

    <div class="">
        <div class="content-wrapper">
            <!-- Read-only Request Details -->
            <section class="request-details">
                <h2>Original Request Details</h2>
                <div class="detail-group">
                    <h3>Promotion Title</h3>
                    <p id="original-title">Website Design Package</p>
                </div>
                <div class="detail-group">
                    <h3>Promotion Description</h3>
                    <p id="original-description">Complete website design including homepage, about page, and contact form</p>
                </div>
                <div class="detail-group">
                    <h3>Benefits Requested</h3>
                    <p id="original-benefits">- Responsive design
                        - SEO optimization
                        - Social media integration
                        - Contact form setup
                    </p>
                </div>
                <div class="detail-group">
                    <h3>Delivery Days</h3>
                    <p id="original-delivery">14 days</p>
                </div>
                <div class="detail-group">
                    <h3>Revisions</h3>
                    <p id="original-revisions">3 revisions</p>
                </div>
                <div class="detail-group">
                    <h3>Price Requested</h3>
                    <p id="original-price">LKR5000</p>
                </div>
                <div class="detail-group">
                    <h3>Created Date</h3>
                    <p id="created-date">January 5, 2025</p>
                </div>
            </section>

            <!-- Modification Form -->
            <section class="modification-form">
                <h2>Customize Package Offer</h2>
                <form id="offerForm" onsubmit="return validateForm(event)">
                    <div class="form-group">
                        <label for="modified-benefits">Modified Benefits</label>
                        <textarea id="modified-benefits" class="form-control" rows="6" placeholder="Enter modified benefits"></textarea>
                        <p class="original-value">Original: <span id="benefits-original"></span></p>
                        <p class="error-message" id="benefits-error">Benefits cannot be empty</p>
                    </div>

                    <div class="form-group">
                        <label for="modified-delivery">Modified Delivery Days</label>
                        <input type="number" id="modified-delivery" class="form-control" min="1" placeholder="Enter number of days">
                        <p class="original-value">Original: <span id="delivery-original"></span></p>
                        <p class="error-message" id="delivery-error">Delivery days must be greater than 0</p>
                    </div>

                    <div class="form-group">
                        <label for="modified-revisions">Modified Revisions</label>
                        <input type="number" id="modified-revisions" class="form-control" min="0" placeholder="Enter number of revisions">
                        <p class="original-value">Original: <span id="revisions-original"></span></p>
                        <p class="error-message" id="revisions-error">Number of revisions must be valid</p>
                    </div>

                    <div class="form-group">
                        <label for="modified-price">Modified Price (LKR)</label>
                        <input type="number" id="modified-price" class="form-control" min="0" step="0.01" placeholder="Enter price">
                        <p class="original-value">Original: <span id="price-original"></span></p>
                        <p class="error-message" id="price-error">Price must be greater than 0</p>
                    </div>

                    <button type="submit" class="submit-btn">Submit Custom Package Offer</button>
                </form>
            </section>
        </div>
    </div>

    <script>
        // Populate original values in the form
        document.addEventListener('DOMContentLoaded', async () => {
            const urlParams = new URLSearchParams(window.location.search);
            const customPackageId = urlParams.get('request_id'); // Get the request_id parameter
    
            // Fetch the custom package data from the backend
            const response = await fetch(`/api/custom-package/${customPackageId}`);
            const data = await response.json();
    
            console.log('Custom Package Data:', data);
            console.log('Custom Package ID:', customPackageId);
    
            const originalData = data;
    
            // Set original values in the form
            document.getElementById('modified-benefits').value = originalData.benefits_requested;
            document.getElementById('modified-delivery').value = originalData.delivery_days_requested;
            document.getElementById('modified-revisions').value = originalData.revisions_requested;
            document.getElementById('modified-price').value = originalData.price_requested;
    
            // Display original values
            document.getElementById('benefits-original').textContent = originalData.benefits_requested;
            document.getElementById('delivery-original').textContent = originalData.delivery_days_requested + ' days';
            document.getElementById('revisions-original').textContent = originalData.revisions_requested + ' revisions';
            document.getElementById('price-original').textContent = 'LKR' + originalData.price_requested;
    
            document.getElementById('original-title').textContent = originalData.service.title;
            document.getElementById('original-description').textContent = originalData.service.description;
        });
    
        // Form validation and submission
        function validateForm(event) {
            event.preventDefault();
            let isValid = true;
    
            // Reset error states
            document.querySelectorAll('.error-message').forEach(msg => msg.style.display = 'none');
            document.querySelectorAll('.form-control').forEach(input => input.classList.remove('error'));
    
            // Validate Benefits
            const benefits = document.getElementById('modified-benefits').value.trim();
            if (!benefits) {
                document.getElementById('benefits-error').style.display = 'block';
                document.getElementById('modified-benefits').classList.add('error');
                isValid = false;
            }
    
            // Validate Delivery Days
            const delivery = document.getElementById('modified-delivery').value;
            if (!delivery || delivery < 1) {
                document.getElementById('delivery-error').style.display = 'block';
                document.getElementById('modified-delivery').classList.add('error');
                isValid = false;
            }
    
            // Validate Revisions
            const revisions = document.getElementById('modified-revisions').value;
            if (!revisions || revisions < 0) {
                document.getElementById('revisions-error').style.display = 'block';
                document.getElementById('modified-revisions').classList.add('error');
                isValid = false;
            }
    
            // Validate Price
            const price = document.getElementById('modified-price').value;
            if (!price || price <= 0) {
                document.getElementById('price-error').style.display = 'block';
                document.getElementById('modified-price').classList.add('error');
                isValid = false;
            }
    
            if (isValid) {
                const formData = {
                    benefits: benefits,
                    delivery: delivery,
                    revisions: revisions,
                    price: price,
                    timestamp: new Date().toISOString()
                };
    
                // Submit the form data to the backend
                updateCustomPackage(formData);
            }
    
            return false;
        }
    
        async function updateCustomPackage(formData) {
            const urlParams = new URLSearchParams(window.location.search);
            const customPackageId = urlParams.get('request_id');
    
            const response = await fetch(`/api/update-custom-package/${customPackageId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });
    
            const data = await response.json();
            console.log(data);
    
            if (data.success) {
                alert('Custom package offer submitted successfully!');
            } else {
                alert('Failed to submit custom package offer.');
            }
        }
    </script>
</body>
</html>