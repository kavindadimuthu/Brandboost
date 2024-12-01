<html>

<head>
    <title>Complain Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/admin/index.css">
    <link rel="stylesheet" href="../styles/admin/tableViewContainer.css">
    <link rel="stylesheet" href="../styles/admin/singlecomplaint.css">


</head>

<body>
    <div class="container" style="margin: 0!important;">
        <?php include __DIR__ . '/../../components/admin/sideNavbar.php'; ?>
        <div class="content" style="width: 1250px!important;">
                <div class="header">
                    <div class="breadcrumb">
                        Admin &gt; Users &gt; Profile
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                            width="30" />
                        <span><?php echo $_SESSION['user_name']; ?></span>
                    </div>
                </div>
                <!-- <php include __DIR__ . '/../../components/businessman/businessmanProfile.php'; ?> -->
                <?php include __DIR__ . '/../../components/designer/designerProfile.php'; ?>
                <!-- <php include __DIR__ . '/../../components/influencer/influencerProfile.php'; ?> -->
           
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