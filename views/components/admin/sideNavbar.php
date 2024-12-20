<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
            z-index: 1000;
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
    </style>
</head>
<body>

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
                <a href="http://localhost:8000/adminviewcontroller/allComplaints">
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
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarItems = document.querySelectorAll(".sidebar li");
        sidebarItems.forEach(item => item.classList.remove("active"));
        
        sidebarItems.forEach(item => {
            const link = item.querySelector("a");
            if (link && link.pathname === window.location.pathname) {
                item.classList.add("active");
            }
            item.addEventListener("click", function () {
                sidebarItems.forEach(i => i.classList.remove("active"));
                item.classList.add("active");
            });
        });
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const toggleIcon = document.getElementById('toggle-icon');
        const content = document.querySelector('.content');
        
        sidebar.classList.toggle('collapsed');
        if (sidebar.classList.contains('collapsed')) {
            toggleIcon.classList.remove('fa-arrow-left');
            toggleIcon.classList.add('fa-arrow-right');
            content.style.marginLeft = '100px';
        } else {
            toggleIcon.classList.remove('fa-arrow-right');
            toggleIcon.classList.add('fa-arrow-left');
            content.style.marginLeft = '250px';
        }
    }
</script>

</body>
</html>