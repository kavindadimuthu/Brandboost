<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        header{
            display: flex;
            justify-content: space-between;
        }
        .menu-links {
            display: flex;
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
</body>
</html>
