<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gig</title>
    <link rel="stylesheet" href="../../styles/common/header.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            height: 100vh;
        }

        .edit-form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 1200px;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .section-heading {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }

        button.cancel {
            background-color: #f44336;
        }

        button.cancel:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
<?php include __DIR__ . '/../../components/common/header.php'; ?>
    <div class="edit-form-container">
        <h2>Edit Package</h2>

        <!-- Gig Title -->
        <label for="editTitle">Title:</label>
        <input id="editTitle" type="text" placeholder="Enter gig title" required>

        <!-- Gig Description -->
        <label for="editDescription">Description:</label>
        <textarea id="editDescription" placeholder="Enter gig description" required></textarea>

        <!-- Delivery Formats -->
        <label for="editPlatform">Platforms (comma-separated):</label>
        <input id="editPlatform" type="text" placeholder="e.g. Facebbok, Tiktok, Youtube, Instagram" required>

        <!-- Tags -->
        <label for="editTags">Tags (comma-separated):</label>
        <input id="editTags" type="text" placeholder="e.g. web design, graphics" required>

        <!-- Basic Package Details -->
        <p class="section-heading">Basic Package</p>
        <label for="editBasicPrice">Price:</label>
        <input id="editBasicPrice" type="number" placeholder="Basic price" required>

        <label for="editBasicBenefits">Benefits:</label>
        <input id="editBasicBenefits" type="text" placeholder="Basic package benefits" required>

        <label for="editBasicDeliveryDays">Delivery Days:</label>
        <input id="editBasicDeliveryDays" type="number" placeholder="Days for delivery" required>

        <label for="editBasicRevisions">Revisions:</label>
        <input id="editBasicRevisions" type="number" placeholder="Number of revisions" required>

        <!-- Premium Package Details -->
        <p class="section-heading">Premium Package</p>
        <label for="editPremiumPrice">Price:</label>
        <input id="editPremiumPrice" type="number" placeholder="Premium price" required>

        <label for="editPremiumBenefits">Benefits:</label>
        <input id="editPremiumBenefits" type="text" placeholder="Premium package benefits" required>

        <label for="editPremiumDeliveryDays">Delivery Days:</label>
        <input id="editPremiumDeliveryDays" type="number" placeholder="Days for delivery" required>

        <label for="editPremiumRevisions">Revisions:</label>
        <input id="editPremiumRevisions" type="number" placeholder="Number of revisions" required>

        <!-- Save and Cancel Buttons -->
        <div class="form-buttons">
            <button id="saveEditButton">Save Changes</button>
            <button class="cancel" onclick="window.history.back()">Cancel</button>
        </div>
    </div>

    <script>
    // Function to fetch and populate gig details
        document.addEventListener('DOMContentLoaded', () => {
            fetchGigDetails();
        });

        async function fetchGigDetails() {
            const gigId = new URLSearchParams(window.location.search).get('gigId');
            console.log("Gig ID:", gigId);

            if (!gigId) {
                alert('Gig ID not provided.');
                return;
            }

            try {
                // Use the correct endpoint based on your router's route structure
                const response = await fetch(`/InfluencerDataController/fetchSinglePromotion/${gigId}`);
                if (!response.ok) {
                    throw new Error(`Failed to fetch gig details. Status: ${response.status}`);
                }

                const gig = await response.json();
                console.log("Gig details:", gig);

                // Populate form fields with fetched gig details
                document.getElementById('editTitle').value = gig.title || '';
                document.getElementById('editDescription').value = gig.description || '';
                document.getElementById('editPlatform').value = Array.isArray(gig.platform)
                    ? gig.platform.join(', ')
                    : (gig.platform || '');
                document.getElementById('editTags').value = Array.isArray(gig.tags)
                    ? gig.tags.join(', ')
                    : (gig.tags || '');

                // Basic Package
                document.getElementById('editBasicPrice').value = gig.packages[0].price || '';
                document.getElementById('editBasicBenefits').value = gig.packages[0].benefits || '';
                document.getElementById('editBasicDeliveryDays').value = gig.packages[0].delivery_days || '';
                document.getElementById('editBasicRevisions').value = gig.packages[0].revisions || '';

                // Premium Package
                document.getElementById('editPremiumPrice').value = gig.packages[1].price || '';
                document.getElementById('editPremiumBenefits').value = gig.packages[1].benefits || '';
                document.getElementById('editPremiumDeliveryDays').value = gig.packages[1].delivery_days || '';
                document.getElementById('editPremiumRevisions').value = gig.packages[1].revisions || '';
            } catch (error) {
                console.error("Error fetching gig details:", error);
                alert("Failed to fetch gig details. Please try again.");
            }
        }

        async function saveGigDetails() {
            const gigId = new URLSearchParams(window.location.search).get('gigId');
            if (!gigId) {
                alert("No gig ID provided in the URL.");
                return;
            }

            // Construct the updated gig object
            const updatedPromotion = {
                title: document.getElementById('editTitle').value,
                description: document.getElementById('editDescription').value,
                platform: document.getElementById('editPlatform').value
                    .split(',')
                    .map(format => format.trim()), // Trim whitespace from each format
                tags: document.getElementById('editTags').value.split(',').map(tag => tag.trim()), // Trim whitespace
                basic: {
                    price: parseFloat(document.getElementById('editBasicPrice').value) || 0, // Ensure numeric value
                    benefits: document.getElementById('editBasicBenefits').value || '',
                    delivery_days: parseInt(document.getElementById('editBasicDeliveryDays').value) || 0, // Ensure integer
                    revisions: parseInt(document.getElementById('editBasicRevisions').value) || 0 // Ensure integer
                },
                premium: {
                    price: parseFloat(document.getElementById('editPremiumPrice').value) || 0, // Ensure numeric value
                    benefits: document.getElementById('editPremiumBenefits').value || '',
                    delivery_days: parseInt(document.getElementById('editPremiumDeliveryDays').value) || 0, // Ensure integer
                    revisions: parseInt(document.getElementById('editPremiumRevisions').value) || 0 // Ensure integer
                }
            };

            try {
                const response = await fetch(`/InfluencerDataController/updatePromotion/${gigId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(updatedPromotion)
                });

                if (!response.ok) {
                    throw new Error(`Failed to save gig details. Status: ${response.status}`);
                }

                const result = await response.json();
                alert(result.message || "Gig updated successfully.");
                if (result.status === "success") {
                    window.location.href = "/InfluencerViewController/influencerPackages"; // Redirect to the gigs page after successful update
                }
            } catch (error) {
                console.error("Error saving gig details:", error);
                alert("Failed to save changes. Please try again.");
            }
        }

        // Attach event listener to the Save button after DOM is fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            const saveButton = document.getElementById('saveEditButton');
            if (saveButton) {
                saveButton.addEventListener('click', saveGigDetails);
            } else {
                console.error("Save button not found in the DOM.");
            }
        });

    </script>
</html>