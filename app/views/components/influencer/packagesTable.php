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
    // Sample data structure - replace this with your actual data source
    const orders = [
      {
        id: 1,
        package: "Design post for FB",
        orders: "30",
        revenue: "$500",
        status: "Active"
      },
      {
        id: 2,
        package: "Ad Campaign",
        orders: "50",
        revenue: "$1200",
        status: "Paused"
      },
      {
        id: 3,
        package: "Ad Campaign",
        orders: "50",
        revenue: "$1200",
        status: "Active"
      }
    ];

    let selectedOrderId = null;

    // Function to load data into the table
    function loadOrdersData(data) {
      const tableBody = document.getElementById('ordersTableBody');
      tableBody.innerHTML = ''; // Clear existing content

      data.forEach(order => {
        const statusClass = order.status.toLowerCase().replace(' ', '-');
        const row = document.createElement('tr');

        row.innerHTML = `
          <td>${order.package}</td>
          <td>${order.orders}</td>
          <td>${order.revenue}</td>
          <td><span class="status ${statusClass}">${order.status}</span></td>
          <td>
            <button onclick="editOrder(${order.id})" class="action-btn"><i class="fas fa-edit"></i></button>
            <button onclick="confirmDelete(${order.id})" class="action-btn"><i class="fas fa-trash"></i></button>
          </td>
        `;

        tableBody.appendChild(row);
      });
    }

    // Function to fetch data from an API
    async function fetchOrders() {
      try {
        // Replace with your API endpoint
        // const response = await fetch('your-api-endpoint');
        // const data = await response.json();

        loadOrdersData(orders); // Using sample data for now
      } catch (error) {
        console.error('Error fetching orders:', error);
      }
    }

    // Edit order handler
    function editOrder(orderId) {
  const order = orders.find(o => o.id === orderId);
  if (order) {
    // Redirect to the create package page with the order ID as a query parameter
    window.location.href = `http://localhost:8000/InfluencerViewController/singlepackage?id=${order.id}`;
  }
}


    // Delete order confirmation
    function confirmDelete(orderId) {
      selectedOrderId = orderId;
      document.getElementById('deleteModal').style.display = 'block';
    }

    // Delete order handler
    async function deleteOrder() {
      if (selectedOrderId !== null) {
        try {
          // Call your delete API
          // await fetch(`your-api-endpoint/${selectedOrderId}`, { method: 'DELETE' });

          // For now, remove the order locally
          const index = orders.findIndex(order => order.id === selectedOrderId);
          if (index > -1) {
            orders.splice(index, 1);
            loadOrdersData(orders);
          }
          selectedOrderId = null;
          document.getElementById('deleteModal').style.display = 'none';
        } catch (error) {
          console.error('Error deleting order:', error);
        }
      }
    }

    // Modal buttons
    document.getElementById('confirmDelete').addEventListener('click', deleteOrder);
    document.getElementById('cancelDelete').addEventListener('click', () => {
      document.getElementById('deleteModal').style.display = 'none';
      selectedOrderId = null;
    });

    // Load data when page loads
    document.addEventListener('DOMContentLoaded', fetchOrders);
  </script>
</body>
</html>
