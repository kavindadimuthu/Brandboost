<div class="sidebar">
    <img class="logo" src="/assets/Logo.svg" alt="logo">

    <ul>
        <li><a href="http://localhost:8000/adminviewcontroller/adminDashboard">Dashboard</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/allusers">Users</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/allRegistrationRequests">Registrations</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/allCustomerComplaints">Complaints</a></li>
    </ul>

    <div class="user-section">
        <img src="/assets/user_logo.png" alt="User Image">
        <span class="username">John Doe</span>
        <!-- <button onclick="window.location.href='/homecontroller/login'">Logout</button> -->
    </div>
    <div class="logout-button">
        <img src="/assets/logout-icon.png" alt="logout icon">
        <span class="logout-btn">Logout</span>
    </div>
</div>

<script>
    // Function to dynamically change the active class
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarItems = document.querySelectorAll(".sidebar li");

        sidebarItems.forEach(item => {
            item.addEventListener("click", function () {
                // Remove 'active' class from all sidebar items
                sidebarItems.forEach(i => i.classList.remove("active"));

                // Add 'active' class to the clicked item
                this.classList.add("active");
            });
        });
    });
</script>

<!-- End of sidebar.html -->