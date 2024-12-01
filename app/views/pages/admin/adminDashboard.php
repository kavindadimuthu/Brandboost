<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        * {
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

        .sidebar ul li a.active {
            background-color: rgba(255, 255, 255, 0.2);
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



        .content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s;
            background-color: #f0f0f0;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            font-size: 14px;
        }



        .sidebar.collapsed+.content {
            margin-left: 100px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header .welcome {
            font-size: 24px;
            font-weight: 600;
        }

        .header .notifications {
            font-size: 14px;
            color: #888;
        }

        .header .profile {
            display: flex;
            align-items: center;
        }

        .header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .header .profile .name {
            font-size: 16px;
            font-weight: 600;
        }

        .header .profile .role {
            font-size: 14px;
            color: #888;
        }

        .search-bar {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar input {
            /* flex: 1; */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
        }

        .cards {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card {
            background-color: #f5f6fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin-right: 20px;
        }

        .card:last-child {
            margin-right: 0;
        }

        .card h2 {
            font-size: 24px;
            margin: 0;
        }

        .card p {
            font-size: 14px;
            color: #888;
            margin: 10px 0 0;
        }

        .card .value {
            font-size: 32px;
            font-weight: 600;
            margin: 10px 0;
        }

        .card .change {
            font-size: 14px;
            color: #28a745;
        }

        .card .change.negative {
            color: #dc3545;
        }

        .chart {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .table {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table table {
            width: 100%;
            border-collapse: collapse;
        }

        .table table th,
        .table table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table table th {
            background-color: #f5f6fa;
        }

        .table table td img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .table .flag {
            display: flex;
            align-items: center;
        }

        .table .flag img {
            margin-right: 10px;
        }

        .table .progress {
            width: 100%;
            background-color: #f5f6fa;
            border-radius: 8px;
            overflow: hidden;
            height: 8px;
            margin-top: 10px;
        }

        .table .progress .progress-bar {
            height: 100%;
            background-color: #007bff;
        }
    </style>
    <!-- <link href="../../styles/admin/index.css" rel="stylesheet" /> -->
    <link href="../../styles/admin/tableViewContainer.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
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
                        <a class="active" href="http://localhost:8000/adminviewcontroller/adminDashboard">
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
        <div class="content">
            <div class="main-content">
                <div class="header">
                    <div class="breadcrumb">
                        Admin &gt; Dashboard
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                            width="30" />
                        <span><?php echo $_SESSION['user_name']; ?></span>
                    </div>
                </div>
                <h2>Dashboard</h2>
                <p>Welcome Back!</p>
                <div class="search-bar">
                    <input placeholder="Search" type="text" />
                    <div>
                        <button>Search</button>
                    </div>
                </div>
                <div class="cards">
                    <div class="card">
                        <h2>
                            Gross Revenue
                        </h2>
                        <div class="value">
                            $2,480.32
                        </div>
                        <div class="change positive">
                            +2.15%
                        </div>
                        <p>
                            From Jan 01, 2024 - March 30, 2024
                        </p>
                    </div>
                    <div class="card">
                        <h2>
                            Avg. Order Value
                        </h2>
                        <div class="value">
                            $56.12
                        </div>
                        <div class="change negative">
                            -2.15%
                        </div>
                        <p>
                            From Jan 01, 2024 - March 30, 2024
                        </p>
                    </div>
                    <div class="card">
                        <h2>
                            Total Orders
                        </h2>
                        <div class="value">
                            $230
                        </div>
                        <div class="change positive">
                            +2.15%
                        </div>
                        <p>
                            From Jan 01, 2024 - March 30, 2024
                        </p>
                    </div>
                </div>
                <!-- <div class="chart">
                    <h2>
                        Orders by time
                    </h2> -->
                <?php include __DIR__ . '/../../components/admin/chart.php'; ?>
                <!-- </div> -->

                <div class="table">
                    <h2>
                        Top Posts
                    </h2>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Post
                                </th>
                                <th>
                                    Revenue
                                </th>
                                <th>
                                    Sales
                                </th>
                                <th>
                                    Reviews
                                </th>
                                <th>
                                    Views
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Premium T-Shirt
                                </td>
                                <td>
                                    $26,680.90
                                </td>
                                <td>
                                    1,072
                                </td>
                                <td>
                                    1,727
                                </td>
                                <td>
                                    2,680
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Vintage T-Shirt
                                </td>
                                <td>
                                    $16,729.19
                                </td>
                                <td>
                                    1,016
                                </td>
                                <td>
                                    720
                                </td>
                                <td>
                                    2,186
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    New Premium Polo
                                </td>
                                <td>
                                    $12,872.24
                                </td>
                                <td>
                                    987
                                </td>
                                <td>
                                    964
                                </td>
                                <td>
                                    1,872
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table">
                    <h2>
                        Active user in countries
                    </h2>
                    <div class="flag">
                        <img alt="England Flag" height="20"
                            src="https://storage.googleapis.com/a1aa/image/8LuXfpHgIzyhdyEVNaQvvhYidMb9PbXLZJcnxPEknaSeVA2TA.jpg"
                            width="20" />
                        <div>
                            England
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 72%;">
                            </div>
                        </div>
                    </div>
                    <div class="flag">
                        <img alt="Germany Flag" height="20"
                            src="https://storage.googleapis.com/a1aa/image/5v5H3QTzFFpQL9P2oYePnIGOWVLSHYrbDHepPlOyco0erAsnA.jpg"
                            width="20" />
                        <div>
                            Germany
                        </div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 52%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
</body>

</html>