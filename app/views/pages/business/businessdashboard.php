<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost Dashboard</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/business-owner/orderTable.css">
    <link rel="stylesheet" href="../../styles/business-owner/businessDashboard.css">

</head>
<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

<div class="all">
  <div class="container">
    <div class="metric-card1">
      <div class="metric-icon1">
        <img src="../../assets/satisfaction.png" alt="Reviews">
      </div>
      <div class="metric-value">4.9</div>
      <div class="metric-label">Reviews</div>
    </div>
    <div class="metric-card2">
      <div class="metric-icon2">
        <img src="../../assets/layer.png" alt="Total Orders">
      </div>
      <div class="metric-value">250</div>
      <div class="metric-label">Total Orders</div>
    </div>
  </div>

  <div class="total-orders">
    
  <h2>Total Orders</h2>
    <div class="order-status-chart">
      <canvas id="orderStatusChart" width="400" height="400"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Ensure Chart.js is loaded -->
    
    <script>
      // Ensure the canvas context is available after the DOM loads
      const ctx = document.getElementById('orderStatusChart').getContext('2d');
      
      // Create the chart with configuration
      const chart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Shipped', 'In Progress', 'Cancelled'],
          datasets: [{
            label: 'Order Status',
            data: [120, 100, 30],
            backgroundColor: [
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true, // Ensures the chart resizes with the container
          plugins: {
            title: {
              display: true,
              text: 'Order Status'
            }
          }
        }
      });
    </script>
        
  </div>
  <h2>Active Orders</h2>
  <div class="header-row">
            <a href="http://localhost:8000/BusinessViewController/MyOrders" class="show-all">Show All ></a>
        </div>
    
</div>
    
    <script src="/public/scripts/business/businessdashboard.js"></script>
    <?php include __DIR__ . '/../../components/businessman/orderTable.php'; ?>

    </body>
</html>