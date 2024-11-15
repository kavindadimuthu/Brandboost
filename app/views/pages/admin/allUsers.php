<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../styles/admin/sidebar.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>
    <div>
        <h1>All Users page</h1>
        <p>Here shows list of all users registered in platform</p>
        <button onclick="window.location.href='/adminviewcontroller/singleuser'">Go to single user view</button>
    </div>
</body>
</html>