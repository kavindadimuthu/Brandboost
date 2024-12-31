<html>

<head>
    <title>Complain Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
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
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .header .breadcrumb {
            font-size: 14px;
            color: #333;
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
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            color: #666;
        }

        .main-content h2,
        .main-content p,
        .main-content th,
        .main-content td {
            color: #666;
            font-size: 12px;
            /* Smaller font size for more elegant look */
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
            /* Slightly smaller font size for header */
            margin-bottom: 30px;
        }

        .main-content .complain-details {
            margin-bottom: 30px;
        }

        .main-content .complain-details div {
            margin-bottom: 20px;
        }

        .main-content .complain-details div span {
            font-weight: bold;
        }

        .main-content .attachments {
            margin-bottom: 20px;
        }

        .main-content .attachments h3 {
            font-size: 16px;
            /* Slightly smaller font size for subheader */
            margin-bottom: 10px;
        }

        .main-content .attachments img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .main-content .response {
            margin-bottom: 20px;
        }

        .main-content .response h3 {
            font-size: 16px;
            /* Slightly smaller font size for subheader */
            margin-bottom: 10px;
        }

        .main-content .response textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            resize: none;
        }

        .main-content .actions {
            display: flex;
            justify-content: flex-end;
        }

        .main-content .actions button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 10px;
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
    </style>


</head>

<body>
    <div class="container">
        <div class="content">
            <div class="main-content">
                <div class="header">
                    <div class="breadcrumb">
                        Sisyphus Ventures &gt; Complains &gt; Complain Details
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                            width="30" />
                        <!-- <span><?php echo $_SESSION['user_name']; ?></span> -->
                    </div>
                </div>
                <h2>Complain Details</h2>
                <div class="complain-details">
                    <div>
                        <span>Complain ID:</span> 001
                    </div>
                    <div>
                        <span>User Name:</span> Florence Shaw
                    </div>
                    <div>
                        <span>Complain:</span> Unable to access account
                    </div>
                    <div>
                        <span>Status:</span> <span class="badge verified">Resolved</span>
                    </div>
                    <div>
                        <span>Assigned Admin:</span> John Doe
                    </div>
                    <div>
                        <span>Date Submitted:</span> Mar 4, 2024
                    </div>
                    <div>
                        <span>Details:</span> The user reported that they were unable to access their account due to a
                        password reset issue. The issue was resolved by resetting the password manually and providing
                        the user with the new credentials.
                    </div>
                </div>
                <div class="attachments">
                    <h3>Attachments</h3>
                    <img alt="Screenshot of error message encountered by the user" height="100"
                        src="https://storage.googleapis.com/a1aa/image/9KrQWb039zb2PF5fAZBDBYErnZ4GjCI2XdL6VkIaBxeDpn1TA.jpg"
                        width="100" />
                    <img alt="Screenshot of account settings page" height="100"
                        src="https://storage.googleapis.com/a1aa/image/fsj0POoE9nQ7G6dtaCEzKUG2QNeE8crCBzfWfRlLKQALkeseE.jpg"
                        width="100" />
                </div>
                <div class="response">
                    <h3>Response</h3>
                    <textarea placeholder="Enter your response to the complain..."></textarea>
                </div>
                <div class="actions">
                    <button>Back to Complains</button>
                    <button>Send Response</button>
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