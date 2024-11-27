<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../../../public/styles/influencer/orderTable.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <div class="orders-container">
    <div class="header-row">
      
    </div>

    <table class="orders-table">
      <thead>
        <tr>
          <th>Package</th>
          <th>Orders</th>
          <th>Revenue</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="ordersTableBody">
        <!-- Data will be loaded here dynamically -->
      </tbody>
    </table>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="modal" style="display: none; ">
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
</body>
</html>
