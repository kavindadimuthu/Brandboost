<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

*{
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    color: #333;
}
.container {
    display: flex;
}


/* Side bar Styles Begin......... */

.sidebar {
    width: 250px;
    background-color: #fff;
    border-right: 1px solid #e0e0e0;
    padding: 20px;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    transition: width 0.3s;
    background: linear-gradient(135deg, #4b0082 0%, #6a11cb 100%);
    color: #fff;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
}
.sidebar.collapsed {
    width: 80px;
}
.sidebar-top-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 50px;
}
.sidebar h1 {
    font-size: 20px;
    margin-bottom: 20px;
    transition: opacity 0.3s;
}
.toggle-sidebar {
    cursor: pointer;
    padding: 10px;
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 8px;
    /* Add curvature */
    height: 40px;
    width: 40px;
}
.sidebar.collapsed h1 {
    display: none;
}
.sidebar.collapsed .sidebar-top-container {
    justify-content: center;
}
.sidebar ul {
    list-style: none;
    padding: 0;
}
.sidebar ul li {
    margin-bottom: 10px;
}
.sidebar ul li a {
    text-decoration: none;
    color: #fff;
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 8px;
    transition: padding 0.3s;
    font-size: 14px;
}
.sidebar ul li a i {
    margin-right: 10px;
    transition: margin 0.3s;
}
.sidebar.collapsed ul li a {
    padding: 10px 10px;
    justify-content: center;
}
.sidebar.collapsed ul li a i {
    margin-right: 0;
}
.sidebar.collapsed ul li a .link-text {
    display: none;
}
/* .sidebar ul li a.active {
    background-color: rgba(255, 255, 255, 0.2);
    font-weight: bold;
} */
.sidebar ul li.active {
    background-color: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    font-weight: bold;
}
.sidebar ul li a .badge {
    margin-left: auto;
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff;
    padding: 2px 6px;
    border-radius: 12px;
    font-size: 12px;
}
.sidebar .bottom-links {
    margin-top: auto;
}

/* ..........Side bar Styles Ends */



</style>


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
                <a href="/admin/dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="link-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/admin/users-list">
                    <i class="fas fa-users"></i>
                    <span class="link-text">User management</span>
                </a>
            </li>
            <li>
                <a class="active" href="/admin/complaints-list">
                    <i class="fas fa-exclamation-circle"></i>
                    <span class="link-text">Complains</span>
                </a>
            </li>
            <li>
                <a href="/admin/verifications-list">
                    <i class="fa-brands fa-cloudversify"></i>
                    <span class="link-text">Verifications</span>
                </a>
            </li>
            <li>
                <a href="/admin/orders-list">
                    <i class="fa-regular fa-circle-question"></i>
                    <span class="link-text">Orders</span>
                </a>
            </li>
            <li>
                <a href="/admin/actions-list">
                    <i class="fa-regular fa-circle-question"></i>
                    <span class="link-text">Actions</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="bottom-links">
        <ul>
            <li>
                <a href="/logincontroller/logout">
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