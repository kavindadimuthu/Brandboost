<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="/styles/tailwind.css">
    <style>
        *,
        *::after,
        *::before {
            box-sizing: border-box;
        }
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
            /*padding: 20px;*/
            padding-top: 50px;
            min-height: 80vh;
        }
        footer {
            /*background-color: #333;*/
            /*color: white;*/
            /*text-align: center;*/
            /*padding: 10px 0;*/
            /*position: absolute;*/
            /*bottom: 0;*/
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <?php include APP_ROOT.'/views/components/header.php' ?>
    </header>

    <main>
        <!-- Inject dynamic content -->
        <?php echo $content ?>
    </main>

    <footer>
        <?php include APP_ROOT.'/views/components/footer.php' ?>
    </footer>
</body>
</html>
