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
            min-height: 100vh;
        }
        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
        main {
            background-color: #f4f4f4;
            padding: 20px;
            min-height: 80vh;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Header Section</h1>
    </header>

    <main>
        <!-- Inject dynamic content -->
        <?php echo $content ?>
    </main>

    <footer>
        <p>Footer Section</p>
    </footer>
</body>
</html>
