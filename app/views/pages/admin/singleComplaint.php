<html>

<head>
    <title>Complain Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/admin/index.css">
    <link rel="stylesheet" href="../styles/admin/tableViewContainer.css">
    <link rel="stylesheet" href="../styles/admin/singlecomplaint.css">


</head>

<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/admin/sideNavbar.php'; ?>
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
                        <span><?php echo $_SESSION['user_name']; ?></span>
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