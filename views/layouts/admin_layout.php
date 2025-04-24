php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 270px;
            --sidebar-collapsed-width: 80px;
            --primary-color: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --hover-color: rgba(255, 255, 255, 0.1);
            --active-color: rgba(255, 255, 255, 0.3);
            --active-text-color: #ffffff;
            --text-color: #f8f9fa;
            --transition-speed: 0.3s;
            --transition-timing: cubic-bezier(0.4, 0, 0.2, 1);
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --radius: 8px;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-600: #4b5563;
            --gray-800: #1f2937;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9fafb;
            color: var(--gray-800);
            line-height: 1.5;
            overflow-x: hidden;
        }

        /* Sidebar styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            position: fixed;
            left: 0;
            top: 0;
            /* padding: 1rem 0.75rem; */
            padding: 1rem 0 1rem 0.75rem;
            transition: width var(--transition-speed) var(--transition-timing), 
                        transform var(--transition-speed) var(--transition-timing);
            /* box-shadow: var(--shadow); */
            display: flex;
            flex-direction: column;
            z-index: 1000;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            color: var(--text-color);
            position: relative;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            font-size: 1.25rem;
            flex-shrink: 0;
            transition: transform var(--transition-speed) var(--transition-timing);
        }

        .sidebar.collapsed .logo-icon {
            transform: scale(1.1);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 600;
            white-space: nowrap;
            transition: opacity var(--transition-speed) var(--transition-timing),
                        width var(--transition-speed) var(--transition-timing),
                        margin var(--transition-speed) var(--transition-timing);
        }

        .sidebar.collapsed .logo-text, 
        .sidebar.collapsed .logo-icon {
            opacity: 0;
            width: 0;
            margin-left: 0;
            overflow: hidden;
        }

        .toggle-btn-container {
            position: absolute;
            right: 17px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1010;
            transition: right var(--transition-speed) var(--transition-timing);
        }

        .sidebar.collapsed .toggle-btn-container {
            right: 20px;
        }

        .toggle-btn {
            background: var(--primary-light);
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            color: var(--text-color);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background var(--transition-speed) var(--transition-timing);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }

        .toggle-btn:hover {
            background: var(--primary-dark);
        }

        .toggle-btn i {
            transition: transform var(--transition-speed) var(--transition-timing);
        }

        .sidebar-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .menu-section {
            margin-bottom: 1rem;
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 0.35rem;
            position: relative;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.25rem;
            color: var(--text-color);
            text-decoration: none;
            position: relative;
            white-space: nowrap;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #ffffff;
        }

        .nav-item.active {
            /* background: rgb(255, 255, 255); */
            background: #f9fafb;
        }

        .nav-item.active .nav-link {
            color: var(--primary-color);
            font-weight: 600;
        }

        .nav-item.active::before {
            content: "";
            position: absolute;
            right: 0;
            top: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px 35px 0 10px #f9fafb;
            pointer-events: none;
        }

        .nav-item.active::after {
            content: "";
            position: absolute;
            right: 0;
            bottom: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px -35px 0 10px #f9fafb;
            pointer-events: none;
        }

        .nav-item:hover{
            background: var(--hover-color);
        }
        .nav-item.active:hover{
            background: white;
        }

        /* .sidebar.collapsed .nav-item:hover::before,
        .sidebar.collapsed .nav-item.active::before,
        .sidebar.collapsed .nav-item:hover::after,
        .sidebar.collapsed .nav-item.active::after {
            display: none;
        } */


        /* .sidebar.collapsed .nav-item:hover::before,
        .sidebar.collapsed .nav-item:hover::after{
            display: none;
        } */
        

        .nav-icon {
            position: relative;
            min-width: 50px;
            display: flex;
            justify-content: start;
            font-size: 1.25rem;
            transition: transform var(--transition-speed) var(--transition-timing);
        }

        .nav-link:hover .nav-icon {
            transform: scale(1.1);
            /* background: var(--hover-color); */
        }

        .link-text {
            font-size: 0.9rem;
            position: relative;
            white-space: nowrap;
            transition: opacity var(--transition-speed) var(--transition-timing),
                        visibility var(--transition-speed) var(--transition-timing);
        }

        .sidebar.collapsed .link-text {
            opacity: 0;
            visibility: hidden;
        }

        .badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            margin-left: auto;
            font-weight: 600;
            transition: opacity var(--transition-speed) var(--transition-timing),
                        transform var(--transition-speed) var(--transition-timing),
                        visibility var(--transition-speed) var(--transition-timing);
        }

        .sidebar.collapsed .badge {
            opacity: 0;
            transform: scale(0);
            visibility: hidden;
        }

        .bottom-nav {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
        }

        /* Main content area */
        #main {
            position: absolute;
            width: calc(100% - var(--sidebar-width));
            left: var(--sidebar-width);
            min-height: 100vh;
            background-color: #f9fafb;
            padding: 0 1.5rem 1.5rem;
            transition: width var(--transition-speed) var(--transition-timing),
                        left var(--transition-speed) var(--transition-timing);
        }

        #main.expanded {
            width: calc(100% - var(--sidebar-collapsed-width));
            left: var(--sidebar-collapsed-width);
        }

        /* Mobile hamburger menu */
        .mobile-header {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            padding: 1rem;
            z-index: 1001;
            box-shadow: var(--shadow);
            justify-content: space-between;
            align-items: center;
        }

        .mobile-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary-color);
        }

        .hamburger-btn {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: var(--gray-800);
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        .hamburger-btn:hover {
            background-color: var(--gray-100);
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all var(--transition-speed) var(--transition-timing);
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive styles */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: var(--shadow);
                width: var(--sidebar-width);
            }

            .sidebar.collapsed {
                width: var(--sidebar-width);
            }

            .sidebar.collapsed .logo-text,
            .sidebar.collapsed .link-text,
            .sidebar.collapsed .badge {
                opacity: 1;
                visibility: visible;
                width: auto;
                margin-left: auto;
            }

            #main {
                width: 100%;
                left: 0;
                padding-top: 4.5rem;
            }

            #main.expanded {
                width: 100%;
                left: 0;
            }

            .mobile-header {
                display: flex;
            }
            
            .toggle-btn-container {
                display: none;
            }

            .nav-item::before,
            .nav-item::after,
            .nav-item:hover::before,
            .nav-item:hover::after,
            .nav-item.active::before,
            .nav-item.active::after {
                display: none;
            }
        }

        /* Additional common admin styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .header .breadcrumb {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header .user-info img {
            border-radius: 50%;
            width: 2.5rem;
            height: 2.5rem;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .header .user-info span {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .page-title {
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-800);
        }

        .page-description {
            color: var(--gray-600);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .profile-container {
            margin: 0 auto !important;
            padding: 0 !important;
        }
    </style>
</head>
<body>
    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="mobile-logo">
            <i class="fas fa-shield-alt"></i>
            <span>BrandBoost Admin</span>
        </div>
        <button class="hamburger-btn" id="hamburger-btn" aria-label="Toggle navigation menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar" aria-label="Admin navigation sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h1 class="logo-text">BrandBoost</h1>
            </div>
            <div class="toggle-btn-container">
                <button class="toggle-btn" id="toggle-btn" aria-label="Toggle sidebar">
                    <i class="fas fa-chevron-left" id="toggle-icon"></i>
                </button>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-section">
                <ul class="nav-list">
                    <li class="nav-item" data-page="dashboard">
                        <a href="/admin/dashboard" class="nav-link" aria-label="Dashboard">
                            <span class="nav-icon">
                                <i class="fas fa-chart-line"></i>
                            </span>
                            <span class="link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item" data-page="users">
                        <a href="/admin/users-list" class="nav-link" aria-label="Users">
                            <span class="nav-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <span class="link-text">Users</span>
                            <span class="badge">23</span>
                        </a>
                    </li>
                    <li class="nav-item" data-page="verifications">
                        <a href="/admin/verifications-list" class="nav-link" aria-label="Verifications">
                            <span class="nav-icon">
                                <i class="fas fa-check-circle"></i>
                            </span>
                            <span class="link-text">Verifications</span>
                        </a>
                    </li>
                    <li class="nav-item" data-page="complaints">
                        <a href="/admin/complaints-list" class="nav-link" aria-label="Complaints">
                            <span class="nav-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                            <span class="link-text">Complaints</span>
                            <span class="badge">5</span>
                        </a>
                    </li>
                    <li class="nav-item" data-page="orders">
                        <a href="/admin/orders-list" class="nav-link" aria-label="Orders">
                            <span class="nav-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <span class="link-text">Orders</span>
                        </a>
                    </li>
                    <li class="nav-item" data-page="actions">
                        <a href="/admin/actions-list" class="nav-link" aria-label="Actions">
                            <span class="nav-icon">
                                <i class="fas fa-tasks"></i>
                            </span>
                            <span class="link-text">Actions</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-nav">
                <ul class="nav-list">
                    <li class="nav-item" data-page="logout">
                        <a href="/auth/logout" class="nav-link" aria-label="Sign Out">
                            <span class="nav-icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span class="link-text">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main id="main">
        <?php echo $content ?>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggle-btn');
            const toggleIcon = document.getElementById('toggle-icon');
            const main = document.getElementById('main');
            const navItems = document.querySelectorAll('.nav-item');
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const overlay = document.getElementById('overlay');
            
            // Detect if user is on mobile/tablet
            const isMobile = window.innerWidth <= 991;
            
            // Set active nav item based on current page
            function setActiveNavItem() {
                const currentPath = window.location.pathname;
                
                navItems.forEach(item => {
                    const link = item.querySelector('.nav-link');
                    const href = link.getAttribute('href');
                    
                    // Check if the current path starts with the link's href
                    if (currentPath === href || 
                        (href !== '/admin/dashboard' && currentPath.startsWith(href))) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            }
            
            // Initialize sidebar state
            if (isMobile) {
                sidebar.classList.remove('collapsed');
            } else {
                // Check localStorage for sidebar state
                const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (sidebarCollapsed) {
                    sidebar.classList.add('collapsed');
                    main.classList.add('expanded');
                    toggleIcon.classList.replace('fa-chevron-left', 'fa-chevron-right');
                }
            }
            
            // Set active nav item
            setActiveNavItem();
            
            // Toggle sidebar function for desktop
            function toggleSidebar() {
                sidebar.classList.toggle('collapsed');
                main.classList.toggle('expanded');
                
                const isCollapsed = sidebar.classList.contains('collapsed');
                
                if (isCollapsed) {
                    toggleIcon.classList.replace('fa-chevron-left', 'fa-chevron-right');
                } else {
                    toggleIcon.classList.replace('fa-chevron-right', 'fa-chevron-left');
                }
                
                // Save state to localStorage
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            }
            
            // Toggle sidebar for mobile
            function toggleMobileSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                
                // Toggle hamburger icon
                const icon = hamburgerBtn.querySelector('i');
                if (sidebar.classList.contains('active')) {
                    icon.classList.replace('fa-bars', 'fa-times');
                    document.body.style.overflow = 'hidden'; // Prevent body scrolling
                } else {
                    icon.classList.replace('fa-times', 'fa-bars');
                    document.body.style.overflow = ''; // Enable body scrolling
                }
            }
            
            // Event Listeners
            toggleBtn.addEventListener('click', function() {
                if (!isMobile) {
                    toggleSidebar();
                }
            });
            
            hamburgerBtn.addEventListener('click', toggleMobileSidebar);
            
            overlay.addEventListener('click', function() {
                if (sidebar.classList.contains('active')) {
                    toggleMobileSidebar();
                }
            });
            
            // Handle hover effect for nav items (similar to sample.html)
            navItems.forEach(item => {
                // Skip on mobile
                if (!isMobile) {
                    item.addEventListener('mouseenter', function() {
                        navItems.forEach(i => {
                            if (!i.classList.contains('active')) {
                                i.classList.remove('hovered');
                            }
                        });
                        if (!this.classList.contains('active')) {
                            this.classList.add('hovered');
                        }
                    });
                }
                
                // Add touch effect for mobile
                item.addEventListener('touchstart', function() {
                    this.style.background = 'var(--hover-color)';
                });
                
                item.addEventListener('touchend', function() {
                    setTimeout(() => {
                        this.style.background = '';
                    }, 200);
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                const newIsMobile = window.innerWidth <= 991;
                
                // Handle transition from mobile to desktop view
                if (!newIsMobile && isMobile) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                    
                    const hamburgerIcon = hamburgerBtn.querySelector('i');
                    if (hamburgerIcon.classList.contains('fa-times')) {
                        hamburgerIcon.classList.replace('fa-times', 'fa-bars');
                    }
                    
                    // Restore desktop sidebar state
                    const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                    sidebar.classList.toggle('collapsed', sidebarCollapsed);
                    main.classList.toggle('expanded', sidebarCollapsed);
                }
            });
        });
    </script>
</body>
</html>