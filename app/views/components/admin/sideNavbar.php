<div class="sidebar" id="sidebar">
    <div>
        <div class="sidebar-top-container">
            <h1>Admin Portal</h1>
            <button class="toggle-sidebar" onclick="toggleSidebar()">
                <i class="fas fa-arrow-left" id="toggle-icon"></i>
            </button>
        </div>
        <ul>
            <li>
                <a href="http://localhost:8000/adminviewcontroller/adminDashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="link-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="http://localhost:8000/adminviewcontroller/allusers">
                    <i class="fas fa-users"></i>
                    <span class="link-text">User management</span>
                </a>
            </li>
            <li>
                <a class="active" href="http://localhost:8000/adminviewcontroller/allComplaints">
                    <i class="fas fa-exclamation-circle"></i>
                    <span class="link-text">Complains</span>
                </a>
            </li>
            <li>
                <a href="http://localhost:8000/adminviewcontroller/allVerifications">
                    <i class="fa-brands fa-cloudversify"></i>
                    <span class="link-text">Verifications</span>
                </a>
            </li>
            <li>
                <a href="http://localhost:8000/adminviewcontroller/viewAllFaqs">
                    <i class="fa-regular fa-circle-question"></i>
                    <span class="link-text">Faq</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="bottom-links">
        <ul>
            <li>
                <a href="http://localhost:8000/logincontroller/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-text">Log out</span>
                </a>
            </li>
        </ul>
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


    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const toggleIcon = document.getElementById('toggle-icon');
        sidebar.classList.toggle('collapsed');
        if (sidebar.classList.contains('collapsed')) {
            toggleIcon.classList.remove('fa-arrow-left');
            toggleIcon.classList.add('fa-arrow-right');
        } else {
            toggleIcon.classList.remove('fa-arrow-right');
            toggleIcon.classList.add('fa-arrow-left');
        }
    }

</script>