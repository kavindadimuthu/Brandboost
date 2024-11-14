<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
        .login-button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Login Page</h1>
    <div class="button-container">
        <button class="login-button" onclick="window.location.href='/influencer-login'">Log in as Influencer</button>
        <button class="login-button" onclick="window.location.href='/designer-login'">Log in as Designer</button>
        <button class="login-button" onclick="window.location.href='/business-login'">Log in as Business</button>
        <button class="login-button" onclick="window.location.href='/adminviewcontroller/adminDashboard'">Log in as Admin</button>
    </div>
</body>
</html></div></body>