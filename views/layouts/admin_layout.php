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
        }
        nav {
            width: 20%;
            height: 100vh;
            background-color: #333;
            color: white;
            float: left;
        }

        main {
            width: 80%;
            height: 100vh;
            background-color: #f4f4f4;
            float: left;
        }
    </style>
</head>
<body>
    <nav>
        <h1 style="text-align: center;">Sidebar Section</h1>
    </nav>

    <main>
        <!-- Inject dynamic content -->
        <?php echo $content ?>
    </main>
</body>
</html>

