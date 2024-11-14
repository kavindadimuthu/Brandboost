<div class="sidebar">
    <img class="logo" src="/assets/Logo.svg" alt="logo">

    <ul>
        <li><a href="http://localhost:8000/adminviewcontroller/adminDashboard">Dashboard</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/allusers">Users</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/registrationRequests">Registrations</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/customerComplaints">Complaints</a></li>
    </ul>

    <div class="user-section">
        <img src="/assets/user_logo.png" alt="User Image">
        <span class="username">John Doe</span>
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