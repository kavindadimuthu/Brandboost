<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/packagesTable.css">
    <link rel="stylesheet" href="../../styles/influencer/InfluencerPackages.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

    
    <div class="container">
        <div class="title">
            <h1>Promotions</h1>
        </div>

        <div class="button">
            <a href="http://localhost:8000/InfluencerViewController/createpackage"><button class="packages-button">New Promotion</button></a>
        </div>
       
    </div>

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
                        const response = await fetch('/influencerDataController/influencerPromotions');
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
                                        <button onclick="window.location.href='/InfluencerViewController/updatePromotion/?gigId=${gig.gig_id}'" class="action-btn"><i class="fas fa-edit"></i></button>
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

        async function deletePromotion() {
            if (selectedGigId !== null) {
                console.log('Deleting Gig ID:', selectedGigId);
                
                try {
                    const response = await fetch(`/InfluencerDataController/deletePromotion/${selectedGigId}`, { 
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

        document.getElementById('confirmDelete').addEventListener('click', deletePromotion);
        document.getElementById('cancelDelete').addEventListener('click', () => {
        document.getElementById('deleteModal').style.display = 'none';
        selectedGigId = null;
        });
    </script>
          
</body>
</html>