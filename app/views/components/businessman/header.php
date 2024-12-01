<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Boost</title>
</head>
<body>
    <header>
        <div class="brand-boost">
            <img src="../assets/Logo.svg" alt="logo">
        </div>
        <nav>
          <ul>
            <li data-tab="dashboard" class="active"><a href="http://localhost:8000/DesignerViewController/designerDashboard">Dashboard</a></li>
            <li data-tab="orders"><a href="http://localhost:8000/DesignerViewController/allOrders">Orders</a></li>
            <li data-tab="gigs"><a href="http://localhost:8000/DesignerViewController/designerPackages">Packages</a></li>
            <li data-tab="earnings"><a href="http://localhost:8000/DesignerViewController/earnings">Earnings</a></li>
          </ul>
        </nav>
        <div class="user-menu">
          <div class="search-bar">
            <input type="text" placeholder="Search...">
            <img src="../assets/search-icon.png" alt="Search Icon" class="search-icon">
          </div>
          <div class="chat-icon" onclick="window.location.href='/DesignerViewController/chat'">
            <img src="../assets/chat-icon.svg" alt="chat">
          </div>
          <div class="notification-icon" >
            <img src="../assets/notification.svg" alt="notifi">
          </div>
          <div class="user-icon">
            <img src="../assets/user-icon.svg" alt="User Icon">
            <div class="popup">
              <ul>
                <li><a href="http://localhost:8000/DesignerViewController/profile">Profile</a></li>
                <li><a href="http://localhost:8000/logincontroller/logout">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
    </header>
    <script>
        // Function to set active tab
        function setActiveTab(tab) {
          // Update active tab styling
          const navLinks = document.querySelectorAll('nav ul li');
          navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.dataset.tab === tab) {
              link.classList.add('active');
            }
          });

          // Save the active tab to localStorage
          localStorage.setItem('activeTab', tab);
        }

        // Initialize active tab on page load
        function initializeActiveTab() {
          const savedTab = localStorage.getItem('activeTab') || 'dashboard'; // Default to 'dashboard'
          setActiveTab(savedTab);
        }

        // Handle navigation link clicks for tab switching
        const navLinks = document.querySelectorAll('nav ul li');
        navLinks.forEach(link => {
          link.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default link behavior
            const currentTab = event.target.closest('li').dataset.tab;
            setActiveTab(currentTab);
            window.location.href = event.target.closest('a').href; // Navigate to the link's URL
          });
        });

        // Run the initialize function on page load
        document.addEventListener('DOMContentLoaded', initializeActiveTab);
    </script>
</body>
</html>
