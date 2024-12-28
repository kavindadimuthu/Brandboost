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
       
        .container {
            display: flex;
        }

        .content {
            flex-grow: 1;
            padding: 10px 20px;
            min-height: 80vh;
            background-color: #f0f0f0;
            border-radius: 20px;
            font-size: 14px;
        }

        .main-content {
            margin-top: 60px;
            background-color: #fff;
            border-radius: 20px;
            padding: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        footer {
            /* background-color: #333; */
            /* color: white; */
            /* text-align: center; */
            /* padding: 10px 0; */
            /* position: absolute; */
            /* bottom: 0; */
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <?php include APP_ROOT.'/views/components/header.php' ?>
    </header>

    <div class="container">
        <div class="content">
            <div class="main-content">
                <!-- Inject dynamic content -->
                <?php echo $content ?>
            </div>
        </div>
    </div>

    <footer>
        <?php include APP_ROOT.'/views/components/footer.php' ?>
    </footer>
</body>
</html>
