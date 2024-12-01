<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Gig</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">
    <style>

    .step {
        display: none;
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
    }

    .step.active {
        display: block;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h2 {
        font-size: 1.8rem;
        color: #2d3748;
        margin-bottom: 1.5rem;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 0.75rem;
    }

    h3 {
        font-size: 1.4rem;
        color: #4a5568;
        margin: 0 0 1rem;
        font-weight: 600;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #4a5568;
        font-size: 0.95rem;
    }

    .delivery-formats{
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background-color: #f8fafc;
        font-size: 1rem;
        transition: all 0.2s ease;
        margin-bottom: 1rem;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        outline: none;
        background-color: white;
    }

    textarea {
        resize: vertical;
        min-height: 120px;
    }

    /* Checkbox styling */
    input[type="checkbox"] {
        appearance: none;
        width: 1.2rem;
        height: 1.2rem;
        border: 2px solid #cbd5e0;
        border-radius: 4px;
        margin-right: 0.5rem;
        position: relative;
        cursor: pointer;
        vertical-align: middle;
    }

    input[type="checkbox"]:checked {
        background-color: #3182ce;
        border-color: #3182ce;
    }

    input[type="checkbox"]:checked::after {
        content: "✓";
        position: absolute;
        color: white;
        font-size: 0.8rem;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .package {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        background-color: white;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .package:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .button-container {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    button {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    button[type="button"] {
        background-color: #3182ce;
        color: white;
        border: none;
    }

    button[type="submit"] {
        background-color: #48bb78;
        color: white;
        border: none;
    }

    button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    button:active {
        transform: translateY(0);
    }

    button:disabled {
        background-color: #a0aec0;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }



    /* Responsive adjustments */
    @media (max-width: 768px) {
        .step {
            padding: 1rem;
            margin: 1rem;
        }
        
        .package {
            padding: 1rem;
        }
        
        button {
            padding: 0.5rem 1rem;
        }
    }
    </style>
</head>
<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">
                <form action="/InfluencerDataController/createPackage" method="POST">
                    <!-- Common Promotion Details -->
                    <div class="step active" id="step1">
                        <h2>Common Promotion Details</h2>
                        <label>Promotion Title: <input type="text" name="title" required></label>
                        <label>Description: <textarea name="description" required></textarea></label>
                        <label>Platforms:</label>
                        <div class="delivery-formats">
                            <div>
                                <input type="checkbox" name="platform" value="facebook" id="facebook">
                                <label for="facebook">Facebook</label>
                            </div>
                            <div>
                                <input type="checkbox" name="platform" value="youtube" id="youtube">
                                <label for="youtube">Youtube</label>
                            </div>
                            <div>
                                <input type="checkbox" name="platform" value="tiktok" id="tiktok">
                                <label for="tiktok">Tiktok</label>
                            </div>
                            <div>
                                <input type="checkbox" name="platform" value="instagram" id="instagram">
                                <label for="instagram">Instagram</label>
                            </div>
                        </div>
                        
                        <label>Tags: <input type="text" name="tags" placeholder="Comma-separated tags" required></label>
                        <button type="button" id="nextStep1">Next</button>
                    </div>

                    <!-- Package Details -->
                    <div class="step" id="step2">
                        <h2>Package Details</h2>
                        <div class="package">
                            <h3>Basic Package</h3>
                            <label>Benefits: <textarea name="basic[benefits]" required></textarea></label>
                            <label>Delivery Days: <input type="number" name="basic[delivery_days]" required></label>
                            <label>Revisions: <input type="number" name="basic[revisions]" required></label>
                            <label>Price: <input type="number" name="basic[price]" step="0.01" required></label>
                        </div>
                        <div class="package">
                            <h3>Premium Package</h3>
                            <label>Benefits: <textarea name="premium[benefits]" required></textarea></label>
                            <label>Delivery Days: <input type="number" name="premium[delivery_days]" required></label>
                            <label>Revisions: <input type="number" name="premium[revisions]" required></label>
                            <label>Price: <input type="number" name="premium[price]" step="0.01" required></label>
                        </div>
                        <button type="button" id="backStep2">Back</button>
                        <button type="submit" id="submitPromotion">Submit</button>
                    </div>
                </form>
        </div>
    </div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let currentStep = 1;

            const steps = document.querySelectorAll(".step");
            const showStep = (step) => {
                steps.forEach((el, index) => {
                    el.classList.toggle("active", index + 1 === step);
                });
            };

            document.getElementById("nextStep1").addEventListener("click", () => {
                currentStep++;
                showStep(currentStep);
            });

            document.getElementById("backStep2").addEventListener("click", () => {
                currentStep--;
                showStep(currentStep);
            });

            showStep(currentStep);
        });

    </script>
</body>
</html>
