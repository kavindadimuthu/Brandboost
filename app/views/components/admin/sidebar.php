<div class="sidebar">
    <img class="logo" src="/assets/Logo.svg" alt="logo">

    <ul>
        <li class="active"><a href="http://localhost:8000/adminviewcontroller/adminDashboard">Dashboard</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/allusers">Users</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/allRegistrationRequests">Registrations</a></li>
        <li><a href="http://localhost:8000/adminviewcontroller/allCustomerComplaints">Complaints</a></li>
    </ul>

    <div class="bottom-section">
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
</div>

<script>
    // Function to dynamically change the active class
    document.addEventListener("DOMContentLoaded", function () {
    const sidebarItems = document.querySelectorAll(".sidebar li");

    // Remove 'active' class from all items initially
    sidebarItems.forEach(item => item.classList.remove("active"));

    // Add 'active' class based on current URL
    sidebarItems.forEach(item => {
        const link = item.querySelector("a");

        // Check if the pathname of the link matches the current page's pathname
        if (link && link.pathname === window.location.pathname) {
            item.classList.add("active");
        }

        // Add click event listener to set the active class when clicked
        item.addEventListener("click", function () {
            sidebarItems.forEach(i => i.classList.remove("active"));
            item.classList.add("active");
        });
    });
});


</script>

<!-- End of sidebar.html -->