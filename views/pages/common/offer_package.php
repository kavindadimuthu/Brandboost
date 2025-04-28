<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Package Request - Brandboost</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global Styles */
        :root {
            --primary: #3b82f6;
            --primary-dark: #7c3aed;
            --primary-light: #dbeafe;
            --secondary: #7c3aed;
            --text-dark: #1e293b;
            --text-medium: #475569;
            --text-light: #64748b;
            --bg-light: #f8fafc;
            --bg-subtle: #f1f5f9;
            --white: #ffffff;
            --border-color: #e2e8f0;
            --success: #059669;
            --success-light: #d1fae5;
            --danger: #dc2626;
            --danger-light: #fee2e2;
            --warning: #f59e0b;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--bg-light);
            padding-bottom: 60px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.3;
            color: var(--text-dark);
        }

        h1 {
            font-size: 1.875rem;
            letter-spacing: -0.025em;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-dark);
        }

        p {
            margin-bottom: 1rem;
        }

        /* Layout */
        .app-wrapper {
            max-width: 1280px;
            margin: 30px auto;
            padding: 0 24px;
        }

        /* Page Header */
        .page-header {
            background: var(--white);
            border-radius: 12px;
            padding: 24px 32px;
            box-shadow: var(--shadow-md);
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary);
        }

        .page-header h1 {
            margin-bottom: 8px;
            color: var(--text-dark);
            display: flex;
            align-items: center;
        }

        .page-header h1::before {
            content: "\f1d8";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-right: 12px;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .page-header p {
            color: var(--text-medium);
            font-size: 1.05rem;
            margin-bottom: 0;
            padding-left: 36px;
        }

        /* Main Content Layout */
        .content-wrapper {
            display: grid;
            grid-template-columns: 5fr 7fr;
            gap: 32px;
        }

        /* Card Styling */
        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 32px;
            background-color: var(--bg-subtle);
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h2 {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
        }

        .card-header h2.original::before {
            content: "\f071";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-right: 12px;
            color: var(--warning);
        }

        .card-header h2.customize::before {
            content: "\f304";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-right: 12px;
            color: var(--primary);
        }

        .card-body {
            padding: 24px 32px;
        }

        /* Request Details Section */
        .detail-group {
            margin-bottom: 24px;
            position: relative;
        }

        .detail-group:last-child {
            margin-bottom: 0;
        }

        .detail-group h3 {
            color: var(--text-medium);
            font-size: 0.875rem;
            margin-bottom: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            display: flex;
            align-items: center;
        }

        .detail-group p {
            color: var(--text-dark);
            white-space: pre-line;
            background-color: var(--bg-subtle);
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* Modification Form */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-medium);
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s ease;
            color: var(--text-dark);
            background-color: var(--white);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
            outline: none;
        }

        .original-value {
            display: flex;
            align-items: center;
            margin-top: 8px;
            padding: 6px 12px;
            background-color: var(--bg-subtle);
            border-radius: 6px;
            font-size: 0.875rem;
            color: var(--text-medium);
        }

        .original-value::before {
            content: "\f05a";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-right: 8px;
            color: var(--text-medium);
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            text-align: center;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            box-shadow: 0 1px 3px rgba(37, 99, 235, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.15);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-lg {
            padding: 12px 24px;
            font-size: 1rem;
        }

        .btn-block {
            width: 100%;
        }

        .btn-icon {
            margin-right: 8px;
        }

        /* Form Actions */
        .form-actions {
            margin-top: 32px;
            display: flex;
            justify-content: flex-end;
        }

        /* Status Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 16px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 12px;
        }

        .badge-success {
            background-color: var(--success-light);
            color: var(--success);
        }

        .badge-waiting {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        /* Error States */
        .form-control.error {
            border-color: var(--danger);
            background-color: var(--danger-light);
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 6px;
            display: none;
        }

        .error-message::before {
            content: "\f071";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-right: 6px;
        }

        /* Additional Styles */
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .price-input {
            position: relative;
        }

        .price-input::before {
            content: "LKR";
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-medium);
            font-weight: 600;
        }

        .price-input input {
            padding-left: 50px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }

            .card {
                margin-bottom: 24px;
            }

            .page-header {
                padding: 20px 24px;
            }

            .card-header, .card-body {
                padding: 20px 24px;
            }
        }

        @media (max-width: 576px) {
            .page-header h1 {
                font-size: 1.5rem;
            }

            .page-header p {
                font-size: 0.95rem;
                padding-left: 32px;
            }

            .card-header h2 {
                font-size: 1.125rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
        .description-content {
    white-space: pre-wrap;
    word-break: break-word;
    max-width: 100%;
    overflow-wrap: break-word;
    line-height: 1.7;
    padding: 12px 16px;
    border-left: 3px solid var(--primary);
}
    </style>
</head>
<body>
    <div class="app-wrapper">
        <header class="page-header">
            <h1>Custom Package Request</h1>
            <p>Review and modify the package details based on client requirements</p>
        </header>

        <div class="content-wrapper">
            <!-- Read-only Request Details -->
            <section class="card">
                <div class="card-header">
                    <h2 class="original">Original Request Details</h2>
                </div>
                <div class="card-body">
                    <div class="detail-group">
                        <h3>Promotion Title</h3>
                        <p id="original-title">Website Design Package</p>
                    </div>
                    <div class="detail-group">
                        <h3>Promotion Description</h3>
                        <p id="original-description" class="description-content">Complete website design including homepage, about page, and contact form</p>
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
                        <p id="original-price">LKR 5,000</p>
                    </div>
                    <div class="detail-group">
                        <h3>Created Date</h3>
                        <p id="created-date">January 5, 2025</p>
                    </div>
                </div>
            </section>

            <!-- Modification Form -->
            <section class="card">
                <div class="card-header">
                    <h2 class="customize">Customize Package Offer</h2>
                </div>
                <div class="card-body">
                    <form id="offerForm" onsubmit="return validateForm(event)">
                        <div class="form-group">
                            <label class="form-label" for="modified-benefits">Benefits</label>
                            <textarea id="modified-benefits" class="form-control" rows="6" placeholder="Describe the benefits included in this package"></textarea>
                            <div class="original-value">Original: <span id="benefits-original"></span></div>
                            <p class="error-message" id="benefits-error">Benefits cannot be empty</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="modified-delivery">Delivery Time (Days)</label>
                            <input type="number" id="modified-delivery" class="form-control" min="1" placeholder="Enter delivery time in days">
                            <div class="original-value">Original: <span id="delivery-original"></span></div>
                            <p class="error-message" id="delivery-error">Delivery days must be greater than 0</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="modified-revisions">Revisions</label>
                            <input type="number" id="modified-revisions" class="form-control" min="0" placeholder="Enter number of revisions">
                            <div class="original-value">Original: <span id="revisions-original"></span></div>
                            <p class="error-message" id="revisions-error">Number of revisions must be valid</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="modified-price">Price</label>
                            <div class="price-input">
                                <input type="number" id="modified-price" class="form-control" min="0" step="0.01" placeholder="Enter price in LKR">
                            </div>
                            <div class="original-value">Original: <span id="price-original"></span></div>
                            <p class="error-message" id="price-error">Price must be greater than 0</p>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-paper-plane btn-icon"></i>
                                Submit Custom Package Offer
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script>
        // Populate original values in the form
        document.addEventListener('DOMContentLoaded', async () => {
            const urlParams = new URLSearchParams(window.location.search);
            const customPackageId = urlParams.get('request_id'); // Get the request_id parameter
    
            try {
                // Fetch the custom package data from the backend
                const response = await fetch(`/api/custom-package/${customPackageId}`);
                
                if (!response.ok) {
                    throw new Error('Failed to fetch package data');
                }
                
                const data = await response.json();
                console.log('Custom Package Data:', data);
        
                const originalData = data;
        
                // Set original values in the form
                document.getElementById('modified-benefits').value = originalData.benefits_requested;
                document.getElementById('modified-delivery').value = originalData.delivery_days_requested;
                document.getElementById('modified-revisions').value = originalData.revisions_requested;
                document.getElementById('modified-price').value = originalData.price_requested;
        
                // Format and display original values
                document.getElementById('benefits-original').textContent = originalData.benefits_requested;
                document.getElementById('delivery-original').textContent = originalData.delivery_days_requested + ' days';
                document.getElementById('revisions-original').textContent = originalData.revisions_requested + ' revisions';
                document.getElementById('price-original').textContent = 'LKR ' + 
                    Number(originalData.price_requested).toLocaleString('en-US');
        
                document.getElementById('original-title').textContent = originalData.service.title;
                document.getElementById('original-description').textContent = originalData.service.description;
                document.getElementById('original-price').textContent = 'LKR ' + 
                    Number(originalData.price_requested).toLocaleString('en-US');
                
                // Format the creation date nicely
                if (originalData.created_at) {
                    const createdDate = new Date(originalData.created_at);
                    document.getElementById('created-date').textContent = 
                        createdDate.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                }
            } catch (error) {
                console.error('Error fetching package data:', error);
                alert('Failed to load package details. Please try again later.');
            }
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
    
            try {
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
                    // Show a success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'alert alert-success';
                    successMessage.innerHTML = '<strong>Success!</strong> Custom package offer has been submitted.';
                    successMessage.style.padding = '12px 16px';
                    successMessage.style.marginBottom = '20px';
                    successMessage.style.backgroundColor = 'var(--success-light)';
                    successMessage.style.color = 'var(--success)';
                    successMessage.style.borderRadius = '8px';
                    
                    const formEl = document.getElementById('offerForm');
                    formEl.parentNode.insertBefore(successMessage, formEl);
                    
                    // Disable the submit button
                    document.querySelector('.btn-primary').disabled = true;
                    document.querySelector('.btn-primary').textContent = 'Offer Submitted';
                    
                    // Scroll to top of form
                    window.scrollTo({
                        top: successMessage.offsetTop - 100,
                        behavior: 'smooth'
                    });
                } else {
                    alert('Failed to submit custom package offer.');
                }
            } catch (error) {
                console.error('Error submitting package offer:', error);
                alert('An error occurred while submitting your offer. Please try again.');
            }
        }
    </script>
</body>
</html>