<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Gigs</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/packagesTable.css">
    <link rel="stylesheet" href="../../styles/influencer/InfluencerPackages.css">
    <!-- <link rel="stylesheet" href="../../../../public/styles/influencer/orderTable.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

    <div class="container">
        <div class="title">
            <h1>Gigs</h1>
        </div>

        <div class="button">
            <a href="http://localhost:8000/DesignerViewController/createGig"><button class="packages-button">+ New Gig</button></a>
        </div>
    </div>

    <!-- Gigs Table -->
    <div class="orders-container">
        <div class="header-row">
            <h1>My Gigs</h1>
        </div>

        <table class="orders-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Basic Price</th>
                    <th>Premium Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="ordersTableBody">
                <!-- Gigs will be displayed here -->
            <script>

                document.addEventListener('DOMContentLoaded', async () => {
                    try {
                        const response = await fetch('/designerDataController/designerGigs');
                        const gigs = await response.json();

                        console.log(gigs);

                        const tableBody = document.getElementById('ordersTableBody');
                        tableBody.innerHTML = ''; // Clear existing table content

                        if (gigs.length > 0) {
                            gigs.forEach(gig => {
                                // Ensure packages are present and handle package data correctly
                                const basicPackage = gig.packages.find(pkg => pkg.package_type === 'basic');
                                const premiumPackage = gig.packages.find(pkg => pkg.package_type === 'premium');

                                const row = document.createElement('tr');

                                // Dynamically populate the table row
                                row.innerHTML = `
                                    <td>${gig.title}</td>
                                    <td>${basicPackage ? basicPackage.price : 'N/A'}</td>
                                    <td>${premiumPackage ? premiumPackage.price : 'N/A'}</td>
                                    <td>${gig.status || 'N/A'}</td> <!-- Handle if gig status is missing -->
                                    <td>
                                        <button onclick="window.location.href='/DesignerViewController/updateGig/gigId=${gig.gig_id}'" class="action-btn"><i class="fas fa-edit"></i></button>
                                        <button onclick="confirmDelete(${gig.gig_id})" class="action-btn"><i class="fas fa-trash"></i></button>
                                    </td>
                                `;

                                // Append the new row to the table
                                tableBody.appendChild(row);
                            });
                        } else {
                            // If no gigs are found, show a message
                            const row = document.createElement('tr');
                            row.innerHTML = '<td colspan="5">No gigs found.</td>';
                            tableBody.appendChild(row);
                        }
                    } catch (error) {
                        console.error('Error fetching gigs:', error);
                    }
                });

            </script>
            </tbody>
        </table>
    </div>


    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content">
            <h2>Edit Gig</h2>
            <!-- Gig Title -->
            <label>Title: <input id="editTitle" type="text"></label>
            
            <!-- Gig Description -->
            <label>Description: <textarea id="editDescription"></textarea></label>
            
            <!-- Delivery Formats -->
            <label>Delivery Formats (comma-separated): <input id="editDeliveryFormats" type="text"></label>
            
            <!-- Tags -->
            <label>Tags (comma-separated): <input id="editTags" type="text"></label>

            <!-- Basic Package Details -->
            <h3>Basic Package</h3>
            <label>Price: <input id="editBasicPrice" type="number"></label>
            <label>Benefits: <input id="editBasicBenefits" type="text"></label>
            <label>Delivery Days: <input id="editBasicDeliveryDays" type="number"></label>
            <label>Revisions: <input id="editBasicRevisions" type="number"></label>

            <!-- Premium Package Details -->
            <h3>Premium Package</h3>
            <label>Price: <input id="editPremiumPrice" type="number"></label>
            <label>Benefits: <input id="editPremiumBenefits" type="text"></label>
            <label>Delivery Days: <input id="editPremiumDeliveryDays" type="number"></label>
            <label>Revisions: <input id="editPremiumRevisions" type="number"></label>

            <!-- Save and Cancel Buttons -->
            <button id="saveEditButton">Save Changes</button>
            <button onclick="document.getElementById('editModal').style.display = 'none';">Cancel</button>
        </div>
    </div>

    <script>
        async function editGig(gigId) {
            const updatedGigData = {
                title: prompt("Enter new title:"),
                description: prompt("Enter new description:"),
                delivery_formats: prompt("Enter new delivery formats (comma-separated):").split(','),
                tags: prompt("Enter new tags (comma-separated):").split(','),
                basic: {
                    benefits: prompt("Enter basic package benefits:"),
                    delivery_days: prompt("Enter basic package delivery days:"),
                    revisions: prompt("Enter basic package revisions:"),
                    price: prompt("Enter basic package price:")
                },
                premium: {
                    benefits: prompt("Enter premium package benefits:"),
                    delivery_days: prompt("Enter premium package delivery days:"),
                    revisions: prompt("Enter premium package revisions:"),
                    price: prompt("Enter premium package price:")
                }
            };

            try {
                const response = await fetch(`/DesignerDataController/updateGig/${gigId}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(updatedGigData)
                });

                const result = await response.json();
                if (result.status === 'success') {
                    alert(result.message);
                    location.reload(); // Refresh the page
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error('Error updating gig:', error);
            }
        }

    </script>



    <!-- Delete Modal -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <p>Are you sure you want to delete this item?</p>
            <button id="confirmDelete">Yes</button>
            <button id="cancelDelete">No</button>
        </div>
    </div>

    <script>
        let selectedGigId = null;

        function confirmDelete(gigId) {
            selectedGigId = gigId;
            console.log('Selected Gig ID:', selectedGigId);
            
            document.getElementById('deleteModal').style.display = 'block';
        }

        async function deleteGig() {
            if (selectedGigId !== null) {
                console.log('Deleting Gig ID:', selectedGigId);
                
                try {
                    const response = await fetch(`/DesignerDataController/deleteGig/${selectedGigId}`, { 
                        method: 'DELETE', 
                        headers: { 
                            'Content-Type': 'application/json' 
                        },
                        // Pass the user_id in the request if needed for extra validation
                        body: JSON.stringify({ user_id: '<?php echo $_SESSION['user_id']; ?>' }) 
                    });
                    console.log('Server Response:', response); // Log server response for debugging
                    
                    const result = await response.json();
                    console.log('Server Response:', result); // Log server response for debugging


                    if (result.status === 'success') {
                        alert(result.message);
                        location.reload(); // Refresh the page
                    } else {
                        alert(result.message);
                        console.error(result.message); // Log the error in console

                    }
                } catch (error) {
                    console.error('Error deleting gig:', error);
                }
            }
        }

        document.getElementById('confirmDelete').addEventListener('click', deleteGig);
        document.getElementById('cancelDelete').addEventListener('click', () => {
        document.getElementById('deleteModal').style.display = 'none';
        selectedGigId = null;
        });
    </script>

    <script src="../scripts/common/header.js"></script>
</body>
</html>

