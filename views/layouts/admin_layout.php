<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            width: 100%;
        }

        main {
            padding-left: 250px;
            width: 100%;
            height: 100vh;
            background-color: #f4f4f4;
            float: left;
        }
    </style>
</head>
<body>
    <nav>
        <?php include '../views/components/sideNavbar.php' ?>
    </nav>

    <main>
        <!-- Inject dynamic content -->
        <?php echo $content ?>
    </main>
</body>
</html>

