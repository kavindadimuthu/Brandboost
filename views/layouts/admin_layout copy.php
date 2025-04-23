<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 270px;
            --sidebar-collapsed-width: 80px;
            --primary-color: #4361ee;
            --hover-color: #3651d4;
            --text-color: #f8f9fa;
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; */
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            /* background: var(--primary-color); */
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            position: fixed;
            left: 0;
            top: 0;
            padding: 0.5rem;
            transition: all var(--transition-speed) ease;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            margin-bottom: 2rem;
            color: var(--text-color);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo-container h1 {
            font-size: 1.25rem;
            font-weight: 600;
            white-space: nowrap;
            opacity: 1;
            transition: opacity var(--transition-speed);
        }

        .sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding: 1rem 0;
        }
        .sidebar.collapsed .logo-container h1 {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }
        .sidebar.collapsed .logo-container {
            display: none;
        }

        .toggle-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            color: var(--text-color);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background var(--transition-speed);
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 8px;
            transition: background var(--transition-speed);
            white-space: nowrap;
        }
        
        .nav-link.collapsed-links {
            justify-content: center;
        }

        .nav-link:hover {
            background: var(--hover-color);
        }

        .nav-link i {
            font-size: 1.2rem;
            /* min-width: 25px; */
            display: flex;
            justify-content: center;
        }

        .link-text {
            margin-left: 0.8rem;
            font-size: 0.95rem;
            opacity: 1;
            transition: opacity var(--transition-speed);
        }

        .sidebar.collapsed .link-text {
            opacity: 0;
            width: 0;
            /* overflow: hidden; */
            display: none;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            font-weight: 500;
        }

        .bottom-nav {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
        }

        .badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-left: auto;
        }

        .sidebar.collapsed .badge {
            display: none;
        }

        main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background-color: #f4f4f4;
            padding: 2rem;
            transition: margin-left var(--transition-speed);
        }

        main.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Admin user profile view */
        .profile-container {
            padding: 0!important;
            margin: 0 auto!important;
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <i class="fas fa-shield-alt"></i>
                <h1>Admin Portal</h1>
            </div>
            <button class="toggle-btn" id="toggle-btn">
                <i class="fas fa-chevron-left" id="toggle-icon"></i>
            </button>
        </div>

        <nav>
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        <span class="link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/users-list" class="nav-link">
                        <i class="fas fa-user"></i>
                        <span class="link-text">Users</span>
                        <span class="badge">23</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/complaints-list" class="nav-link">
                        <i class="fas fa-exclamation-circle"></i>
                        <span class="link-text">Complaints</span>
                        <span class="badge">5</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/verifications-list" class="nav-link">
                        <i class="fas fa-check-circle"></i>
                        <span class="link-text">Verifications</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/orders-list" class="nav-link">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="link-text">Orders</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/actions-list" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        <span class="link-text">Actions</span>
                    </a>
                </li>
            </ul>
        </nav>

        <nav class="bottom-nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="/auth/logout" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="link-text">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <main id="main">
        <?php echo $content ?>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggle-btn');
            const toggleIcon = document.getElementById('toggle-icon');
            const main = document.getElementById('main');
            const navLinks = document.querySelectorAll('.nav-link');

            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                main.classList.toggle('expanded');
                navLinks.forEach(link => link.classList.toggle('collapsed-links'));

                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.classList.replace('fa-chevron-left', 'fa-chevron-right');
                } else {
                    toggleIcon.classList.replace('fa-chevron-right', 'fa-chevron-left');
                }
            });

            const currentPath = window.location.pathname;

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }

                link.addEventListener('touchstart', function() {
                    this.style.background = 'var(--hover-color)';
                });

                link.addEventListener('touchend', function() {
                    setTimeout(() => {
                        this.style.background = '';
                    }, 200);
                });
            });
        });
    </script>
</body>
</html>