<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Gigs</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* myGigs.css */

        .title {
            text-align: center;
            margin: 20px 0;
        }

        h1 {
            font-size: 2.5em;
            color: #333; /* Darker text for better readability */
        }

        .button {
            text-align: center;
            margin-bottom: 20px;
        }

        .packages-button {
            background-color: #28a745; /* Green background for the button */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .packages-button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .orders-container {
            background: white; /* White background for the table container */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            overflow: hidden; /* Prevent content overflow */
            padding: 20px; /* Padding inside the container */
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse; /* Collapsed borders for a cleaner look */
        }

        .orders-table th {
            text-align: left; /* Left-align text in headers */
            padding: 12px 16px; /* Padding for headers */
            background: #f8f9fa; /* Header background color */
            color: #666; /* Header text color */
            font-weight: 500; /* Medium weight for header text */
            font-size: 14px; /* Font size for header */
            border-bottom: 1px solid #eee; /* Bottom border for separation */
        }

        .orders-table td {
            padding: 16px; /* Padding for table cells */
            color: #333; /* Dark text color for cells */
            font-size: 14px; /* Font size for cell text */
            border-bottom: 1px solid #eee; /* Bottom border for cells */
            transition: all 0.3s ease; /* Transition for hover effects */
        }

        .orders-table tr:hover td {
            color: #007bff; /* Blue text color on row hover */
            cursor: pointer;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #007bff; /* Blue color for action buttons */
            font-size: 1.2em;
            transition: color 0.3s ease;
        }

        .action-btn:hover {
            color: #0056b3; /* Darker blue on hover */
        }

        /* Modal Styles */
        .modal {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            position: fixed;
            top: 0; /* Align to the top */
            left: 0; /* Align to the left */
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            background-color: rgba(0, 0, 0, 0.7); /* Darker semi-transparent background */
            z-index: 1000; /* On top of other elements */
        }

        .modal-content {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%); /* Soft gradient background */
            padding: 30px; /* Increased padding for a spacious feel */
            border-radius: 10px; /* More rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); /* Deeper shadow for more depth */
            max-width: 500px; /* Restrict maximum width */
            width: 90%; /* Responsive width */
            transform: translateY(-50%); /* Adjust vertical position for perfect centering */
            top: 50%; /* Center vertically */
            position: absolute; /* Change to absolute for centering */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Adjust to center perfectly */
        }

        .modal-content p {
            margin: 0 0 20px; /* Margin for text in modal */
            font-size: 1.1em; /* Slightly larger font for better readability */
            color: #333; /* Darker text for better contrast */
        }

        #confirmDelete, #cancelDelete {
            background-color: #007bff; /* Blue button background */
            color: white;
            border: none;
            padding: 12px 20px; /* Increased padding for larger buttons */
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease; /* Added transform transition */
            font-size: 1em; /* Font size for better readability */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow for buttons */
        }

        #confirmDelete:hover, #cancelDelete:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: translateY(-2px); /* Slight lift on hover */
        }

        #cancelDelete {
            background-color: #dc3545; /* Red background for cancel button */
        }

        #cancelDelete:hover {
            background-color: #c82333; /* Darker red on hover */
            transform: translateY(-2px); /* Slight lift on hover */
        }

    </style>
</head>
<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">

                <div class="title">
                    <h1>My Promotions</h1>
                </div>

                <div class="button">
                    <a href="http://localhost:8000/InfluencerViewController/createPackage">
                        <button class="packages-button">+ New Promotion</button>
                    </a>
                </div>

                <!-- Gigs Table -->
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
                                    const response = await fetch('/influencerDataController/influencerpromotions');
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
        </div>
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
                    const response = await fetch(`/influencerDataController/deletePromotion/${selectedGigId}`, { 
                        method: 'DELETE' 
                    });

                    if (response.ok) {
                        // Remove the gig from the table
                        const rowToDelete = document.querySelector(`tr[data-gig-id="${selectedGigId}"]`);
                        if (rowToDelete) rowToDelete.remove();
                        alert('Gig deleted successfully.');
                    } else {
                        alert('Failed to delete gig.');
                    }
                } catch (error) {
                    console.error('Error deleting gig:', error);
                } finally {
                    selectedGigId = null; // Reset selected gig ID
                    document.getElementById('deleteModal').style.display = 'none'; // Hide modal
                }
            }
        }

        // Add event listeners to the confirm and cancel buttons
        document.getElementById('confirmDelete').addEventListener('click', deletePromotion);
        document.getElementById('cancelDelete').addEventListener('click', () => {
            selectedGigId = null;
            document.getElementById('deleteModal').style.display = 'none'; // Hide modal
        });
    </script>
</body>
</html>
