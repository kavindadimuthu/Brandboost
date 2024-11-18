<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../styles/common/serviceCard.css">
    <style>
        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 20px;
            margin: 0;
        }
        header{
            width: 100%;
            /* border: solid 1px red; */
            display: flex;
            justify-content: space-between;
        }
        .menu-links {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .menu-links a {
            margin: 10px 10px;
        }
    </style>
</head>
<body>

    <header>
        <div><h1>Brandboost</h1></div>
        <div class="menu-links">
            <a href="http://localhost:8000/homecontroller/about">About page</a>
            <a href="http://localhost:8000/homecontroller/contact">Contact page</a>
            <button onclick="window.location.href='/homecontroller/register'">Register</button>
            <button onclick="window.location.href='/homecontroller/login'">Login</button>
        </div>
    </header>

    <center><h1>Welcome to the Home Page</h1></center>
    <?php include __DIR__ . '/../../components/common/carousel.php'; ?>
</body>
</html>
