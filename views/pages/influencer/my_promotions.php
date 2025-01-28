<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My promotions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .hero {
            background: linear-gradient(135deg, #4169E1, #8A2BE2);
            color: white;
            padding: 20px 20px;
            text-align: center;
            position: relative;
            margin-bottom: 40px;
        }

        .hero-container{
            max-width: 1200px;
            margin: auto;
            /* display: flex;
            justify-content: space-between;
            align-items: center; */
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .packages-button {
            background: white;
            color: #4169E1;
            border: none;
            padding: 15px 35px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .packages-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .orders-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 40px;
        }

        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .orders-table th {
            text-align: left;
            padding: 16px;
            background: #f8f9fa;
            color: #4169E1;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
        }

        .orders-table td {
            text-align: left;
            padding: 16px;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .orders-table tr:hover td {
            background-color: #f8f9fa;
        }

        .promotion-title-cell{
            display: flex;
            align-items: center;
            transition: transform 0.2s ease;
        }
        .promotion-title-cell:hover{
            transform: scale(1.01);
        }

        .promotion-thumb {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 12px;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #4169E1;
            font-size: 1.2em;
            transition: all 0.3s ease;
            padding: 8px;
            margin: 0 5px;
        }

        .action-btn:hover {
            color: #8A2BE2;
            transform: translateY(-2px);
        }

        /* Modal Styles */

        .modal {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
        }

        .modal-content {
            text-align: center;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 90%;
            transform: translateY(-50%);
            top: 50%;
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .modal-content p {
            margin: 0 0 20px;
            font-size: 1.1em;
            color: #333;
        }

        #confirmDelete, #cancelDelete {
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 10px;
        }

        #confirmDelete {
            background: #4169E1;
            color: white;
        }

        #cancelDelete {
            background: #dc3545;
            color: white;
        }

        #confirmDelete:hover, #cancelDelete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .hero {
                padding: 40px 20px;
            }
            
            .orders-container {
                padding: 15px;
            }

            .orders-table th, .orders-table td {
                padding: 12px;
            }
        }
    </style>
</head>

<body>
<div class="hero">
        <div class="hero-container">
            <h1>My Promotions</h1>
            <button class="packages-button" onclick="window.location.href='/influencer/add-promotion'">+ Create Promotion</button>
        </div>
    </div>


<div class="container">
        <div class="orders-container">
            <table class="orders-table" id="promotions-table">
                <!-- Keep existing table structure -->
                <thead>
                    <tr>
                        <th>Promotion</th>
                        <th>Basic Price</th>
                        <th>Premium Price</th>
                        <th>Updated</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody id="ordersTableBody">
                        <!-- promotions will be displayed here -->
                        <script>
                            document.addEventListener('DOMContentLoaded', async () => {
                                try {
                                    const queryParams = new URLSearchParams({
                                        current_user: true
                                    });

                                    const response = await fetch(`/api/services?${queryParams}`);
                                    const result = await response.json();

                                    const promotions = result.services;

                                    console.log(promotions);
                                    

                                    const tableBody = document.getElementById('ordersTableBody');
                                    tableBody.innerHTML = ''; // Clear existing table content

                                    if (promotions.length > 0) {
                                        promotions.forEach(promotion => {

                                            // Ensure packages are present and handle package data correctly
                                            // const basicPackage = promotion.package;
                                            const basicPackage = promotion.packages.find(pkg => pkg.package_type === 'basic');
                                            // const basicPackage = promotion.packages.find(pkg => pkg.package_type === 'basic');
                                            const premiumPackage = promotion.packages.find(pkg => pkg.package_type === 'premium');

                                            const row = document.createElement('tr');

                                            // Dynamically populate the table row
                                            row.innerHTML = `
                                                <td onclick="window.location.href='/services/${promotion.service_id}'" style="cursor: pointer;">
                                                    <div class="promotion-title-cell">
                                                        <img src="/${promotion.cover_image}" class="promotion-thumb me-2" alt="thumbnail">
                                                        ${promotion.title}
                                                    </div>
                                                </td>
                                                <td>${basicPackage ? basicPackage.price : 'N/A'}</td>
                                                <td>${premiumPackage ? premiumPackage.price : 'N/A'}</td>
                                                <td>${new Date(promotion.updated_at).toLocaleDateString()}</td>
                                                <td>${new Date(promotion.created_at).toLocaleDateString()}</td>
                                                <td>${promotion.status || 'Active'}</td> <!-- Handle if promotion status is missing -->
                                                <td>
                                                    <button onclick="window.location.href='/influencer/edit-promotion/${promotion.service_id}'" class="action-btn"><i class="fas fa-edit"></i></button>
                                                    <button onclick="confirmDelete(${promotion.service_id})" class="action-btn"><i class="fas fa-trash"></i></button>
                                                </td>
                                            `;

                                            // Append the new row to the table
                                            tableBody.appendChild(row);
                                        });
                                    } else {
                                        // If no promotions are found, show a message
                                        const row = document.createElement('tr');
                                        row.innerHTML = '<td colspan="5">No promotions found.</td>';
                                        tableBody.appendChild(row);
                                    }
                                } catch (error) {
                                    console.error('Error fetching promotions:', error);
                                }
                            });
                        </script>
                </tbody>
            </table>
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
        let selectedpromotionId = null;

        function confirmDelete(serviceId) {
            selectedpromotionId = serviceId;
            console.log('Selected promotion ID:', selectedpromotionId);

            document.getElementById('deleteModal').style.display = 'block';
        }

        async function deletepromotion() {
            if (selectedpromotionId !== null) {
                console.log('Deleting promotion ID:', selectedpromotionId);

                // const response = await fetch(`/api/delete-promotion/45`);
                // const response = await fetch(`/api/delete-promotion/${selectedpromotionId}`, {
                //         method: 'DELETE'
                //     });
                // services = await response.json();

                // console.log(services)

                try {
                    // const response = await fetch(`/api/delete-promotion/45`);
                    const response = await fetch(`/api/delete-promotion/${selectedpromotionId}`, {
                        method: 'GET'
                    });

                    console.log(response)

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Failed to delete promotion.');
                    }
                } catch (error) {
                    console.error('Error deleting promotion:', error);
                } finally {
                    selectedpromotionId = null; // Reset selected promotion ID
                    document.getElementById('deleteModal').style.display = 'none'; // Hide modal
                }
            }
        }

        // const tableBody = document.querySelector('#promotions-table tbody');

        // tableBody.addEventListener('click', function (event) {
        //     const cell = event.target.closest('td');
        //     if (cell) {
        //         const promotionId = cell.getAttribute('data-promotion-id');
        //         handleRowClick(promotionId);
        //     }
        // });

        // function handleRowClick(promotionId) {
        //     console.log('Row clicked, Verification ID:');
        //     window.location.href = '/services/' + promotionId;
        // }

        // Add event listeners to the confirm and cancel buttons
        document.getElementById('confirmDelete').addEventListener('click', deletepromotion);
        document.getElementById('cancelDelete').addEventListener('click', () => {
            selectedpromotionId = null;
            document.getElementById('deleteModal').style.display = 'none'; // Hide modal
        });
    </script>
</body>

</html>