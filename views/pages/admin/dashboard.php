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

        .content {
            flex-grow: 1;
            padding: 20px;
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



        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            /* Reduced gap between header and breadcrumb */
        }

        .header .breadcrumb {
            font-size: 14px;
            color: #333;
            /* Make breadcrumb font color visible */
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .header .user-info span {
            font-size: 14px;
        }

        .main-content {
            background-color: #fff;
            border-radius: 20px;
            /* Add curvature */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            /* Add gap between sidebar and main content */
            color: #333;
        }

        .main-content h2,
        .main-content p,
        .main-content th,
        .main-content td {
            color: #666;
            /* Grey color for text */
            font-size: 14px;
            /* Smaller font size for elegant look */
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
            /* Larger font size for header */
        }

        .main-content .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .main-content .search-bar input {
            width: 400px;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            /* Add curvature */
        }

        .main-content .search-bar button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            /* Add curvature */
            cursor: pointer;
        }

        .main-content table {
            width: 100%;
            border-collapse: collapse;
        }

        .main-content table th,
        .main-content table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }

        .main-content table th {
            background-color: #f9f9f9;
        }

        .main-content table td img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .main-content table td .user-info {
            display: flex;
            align-items: center;
        }

        .main-content table td .user-info img {
            margin-right: 10px;
        }

        .main-content .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .main-content .pagination button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
            margin: 0 4px;
            color: #888;
        }

        .main-content .pagination button.active {
            font-weight: bold;
            color: #000;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
        }

        .badge.verified {
            background-color: #28a745;
        }

        .badge.blocked {
            background-color: #dc3545;
        }

        .badge.banned {
            background-color: #6c757d;
        }





        /* Action buttons Styles.......... */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .action-buttons .edit-btn {
            background-color: #007bff;
        }

        .action-buttons .delete-btn {
            background-color: #dc3545;
        }

        /* ................................ */
    </style>
</head>

<body>
    <div class="container">
        
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
                
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .chart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* padding: 20px; */
        }
        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 20px;
            width: 100%;
            /* max-width: 600px; */
        }
        .card h2 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }
        .legend {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
        .legend div {
            display: flex;
            align-items: center;
            margin-left: 10px;
        }
        .legend div span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;
        }
        .income {
            background-color: #2d6a4f;
        }
        .expenses {
            background-color: #a8df65;
        }
        .revenue {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .revenue h1 {
            margin: 0;
            font-size: 2.5em;
            color: #333;
        }
        .revenue p {
            margin: 5px 0;
            color: #333;
        }
        .revenue p span {
            color: #2d6a4f;
        }
        .bar-chart, .bar-chart-horizontal {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            height: 150px;
            margin-top: 20px;
        }
        .bar {
            width: 20px;
            background-color: #2d6a4f;
        }
        .bar.expenses {
            background-color: #a8df65;
        }
        .bar-chart-horizontal {
            flex-direction: column;
            align-items: flex-start;
            height: auto;
        }
        .bar-horizontal {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .bar-horizontal div {
            height: 20px;
            background-color: #a8df65;
            margin-right: 10px;
        }
        .bar-horizontal div.income {
            background-color: #2d6a4f;
        }
        .bar-horizontal span {
            color: #333;
        }
        .ellipsis {
            display: flex;
            justify-content: flex-end;
            margin-top: -20px;
        }
        .ellipsis i {
            color: #333;
        }
    </style>
</head>

    <div class="chart-container">
        <div class="card">
            <h2>Sales Report</h2>
            <div class="legend">
                <div><span class="income"></span> Income</div>
                <div><span class="expenses"></span> Withdrawals</div>
            </div>
            <div class="revenue">
                <h1 id="revenue-amount">$0</h1>
                <p id="revenue-change"><span>&#9650; 0%</span> from last month</p>
            </div>
            <div class="bar-chart" id="revenue-chart">
                <!-- Bars will be generated dynamically -->
            </div>
        </div>
        <div class="card">
            <div class="ellipsis">
                <i class="fas fa-ellipsis-h"></i>
            </div>
            <h2>User counts</h2>
            <div class="bar-chart-horizontal" id="sales-chart">
                <!-- Horizontal bars will be generated dynamically -->
            </div>
        </div>
    </div>

    <script>
        // Data for charts
        const revenueData = [
            { type: 'income', height: 60 },
            { type: 'expenses', height: 40 },
            { type: 'income', height: 80 },
            { type: 'expenses', height: 60 },
            { type: 'income', height: 100 },
            { type: 'expenses', height: 80 },
            { type: 'income', height: 60 },
            { type: 'income', height: 60 },
            { type: 'expenses', height: 40 },
            { type: 'income', height: 80 },
            { type: 'expenses', height: 60 },
            { type: 'income', height: 100 },
            { type: 'expenses', height: 80 },
            { type: 'income', height: 60 },
            { type: 'income', height: 60 },
            { type: 'expenses', height: 40 },
            { type: 'income', height: 80 },
            { type: 'expenses', height: 60 },
            { type: 'income', height: 100 },
            { type: 'expenses', height: 80 },
            { type: 'income', height: 60 },
        ];

        const salesData = [
            { type: 'expenses', width: 233, label: 'Businesses (233)' },
            { type: 'income', width: 23, label: 'Designers (23)' },
            { type: 'expenses', width: 482, label: 'Influencers (482)' },
        ];

        const revenueAmount = 193000;
        const revenueChange = '+35%';

        // Populate revenue chart
        const revenueChart = document.getElementById('revenue-chart');
        revenueData.forEach((bar) => {
            const barDiv = document.createElement('div');
            barDiv.className = `bar ${bar.type}`;
            barDiv.style.height = `${bar.height}px`;
            revenueChart.appendChild(barDiv);
        });

        // Update revenue details
        document.getElementById('revenue-amount').textContent = `$${revenueAmount.toLocaleString()}`;
        document.getElementById('revenue-change').innerHTML = `<span>&#9650; ${revenueChange}</span> from last month`;

        // Populate sales chart
        const salesChart = document.getElementById('sales-chart');
        salesData.forEach((bar) => {
            const barContainer = document.createElement('div');
            barContainer.className = 'bar-horizontal';

            const barDiv = document.createElement('div');
            barDiv.className = `${bar.type}`;
            barDiv.style.width = `${bar.width}px`;

            const labelSpan = document.createElement('span');
            labelSpan.textContent = bar.label;

            barContainer.appendChild(barDiv);
            barContainer.appendChild(labelSpan);
            salesChart.appendChild(barContainer);
        });
    </script>



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