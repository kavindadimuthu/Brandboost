<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Package Request - Brandboost</title>
    <style>
        .form-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 40px 10%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            font-size: 36px;
            color: #333;
            margin-bottom: 15px;
        }

        .form-header p {
            color: #666;
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 25px;
        }
        .lower-form-group {
            display: flex;
            justify-content: space-between;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: black;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #4169E1;
            outline: none;
        }

        .form-group textarea {
            min-height: 200px;
            resize: vertical;
        }

        .form-group input[type="number"] {
            max-width: 200px;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .submit-btn {
            background: linear-gradient(135deg, #4169E1, #8A2BE2);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 35px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin: 20px;
            }

            .form-header h2 {
                font-size: 28px;
            }

            .form-header p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h2>Request Custom Package</h2>
            <p>Tell us about your ideal package, and we'll create a tailored solution for your business needs.</p>
        </div>

        <form id="customPackageForm" action="process_request.php" method="POST">
            <div class="form-group">
                <label for="title">Promotion Title*</label>
                <span id="promotion-title"></span>
            </div>

            <div class="form-group">
                <label for="description">Promotion Description*</label>
                <span id="promotion-description"></span>
            </div>

            <div class="form-group">
                <label for="benefits">Expected Benefits*</label>
                <textarea id="benefits" name="benefits" placeholder="List the key benefits you'd like to receive..." required></textarea>
                <div class="error-message" id="benefitsError">Please list the expected benefits</div>
            </div>

            <div class="lower-form-group">
                <div class="form-group">
                    <label for="delivery_days">Delivery Days*</label>
                    <input type="number" id="delivery_days" name="delivery_days" min="1" placeholder="e.g. 30" required>
                    <div class="error-message" id="deliveryError">Please enter the number of delivery days</div>
                </div>
                <div class="form-group">
                    <label for="revisions">Number of Revisions</label>
                    <input type="number" id="revisions" name="revisions" min="0" placeholder="e.g. 3">
                </div>
                <div class="form-group">
                    <label for="price">Budget (LKR)*</label>
                    <input type="number" id="price" name="price" min="1" placeholder="e.g. 5000" required>
                    <div class="error-message" id="priceError">Please enter your budget</div>
                </div>
            </div>

            <button type="submit" class="submit-btn">Submit Request</button>
        </form>
    </div>

    <script>
        // Update the form action to remove the PHP file
        document.getElementById('customPackageForm').action = '';
        
        // Replace the existing script with this updated version
        const urlParams = new URLSearchParams(window.location.search);
        const serviceId = urlParams.get('service_id');
        
        async function fetchPromotion(serviceId) {
            try {
                const response = await fetch(`/api/service/${serviceId}?service=true`);
                const data = await response.json();
                document.getElementById('promotion-title').innerText = data.title;
                document.getElementById('promotion-description').innerText = data.description;
            } catch (error) {
                console.error('Error fetching promotion:', error);
            }
        }
        
        document.getElementById('customPackageForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(msg => {
                msg.style.display = 'none';
            });
        
            let isValid = true;          
        
            // Validate benefits
            const benefits = document.getElementById('benefits').value.trim();
            if (!benefits) {
                document.getElementById('benefitsError').style.display = 'block';
                isValid = false;
            }
        
            // Validate delivery days
            const deliveryDays = document.getElementById('delivery_days').value;
            if (!deliveryDays || deliveryDays < 1) {
                document.getElementById('deliveryError').style.display = 'block';
                isValid = false;
            }
        
            // Validate price
            const price = document.getElementById('price').value;
            if (!price || price < 1) {
                document.getElementById('priceError').style.display = 'block';
                isValid = false;
            }
        
            if (isValid) {
                try {
                    const formData = {
                        service_id: serviceId,
                        benefits_requested: benefits,
                        delivery_days_requested: parseInt(deliveryDays),
                        revisions_requested: parseInt(document.getElementById('revisions').value) || 0,
                        price_requested: parseFloat(price)
                    };
        
                    const response = await fetch('/api/create-custom-package', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(formData)
                    });
        
                    const result = await response.json();
        
                    if (result.success) {
                        alert('Custom package request submitted successfully!');
                        window.location.href = `/services/${serviceId}`; // Redirect to dashboard or appropriate page
                    } else {
                        alert('Failed to submit custom package request. Please try again.');
                    }
                } catch (error) {
                    console.error('Error submitting form:', error);
                    alert('An error occurred. Please try again.');
                }
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            if (serviceId) {
                fetchPromotion(serviceId);
            } else {
                console.error('No service ID provided');
            }
        });
    </script>
</body>
</html>