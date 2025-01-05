<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Package Request - Brandboost</title>
    <style>
        .form-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 40px;
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

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
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
            min-height: 120px;
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
                <label for="title">Package Title*</label>
                <input type="text" id="title" name="title" placeholder="e.g., Premium Brand Design Package" required>
                <div class="error-message" id="titleError">Please enter a package title</div>
            </div>

            <div class="form-group">
                <label for="description">Package Description*</label>
                <textarea id="description" name="description" placeholder="Describe what services you're looking for..." required></textarea>
                <div class="error-message" id="descriptionError">Please provide a package description</div>
            </div>

            <div class="form-group">
                <label for="benefits">Expected Benefits*</label>
                <textarea id="benefits" name="benefits" placeholder="List the key benefits you'd like to receive..." required></textarea>
                <div class="error-message" id="benefitsError">Please list the expected benefits</div>
            </div>

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

            <button type="submit" class="submit-btn">Submit Request</button>
        </form>
    </div>

    <script>
        document.getElementById('customPackageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Reset error messages
            document.querySelectorAll('.error-message').forEach(msg => {
                msg.style.display = 'none';
            });

            let isValid = true;
            
            // Validate title
            const title = document.getElementById('title').value.trim();
            if (!title) {
                document.getElementById('titleError').style.display = 'block';
                isValid = false;
            }

            // Validate description
            const description = document.getElementById('description').value.trim();
            if (!description) {
                document.getElementById('descriptionError').style.display = 'block';
                isValid = false;
            }

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
                this.submit();
            }
        });
    </script>
</body>
</html>