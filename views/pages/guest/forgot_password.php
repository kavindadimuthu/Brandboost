<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../styles/common/Login.css">
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('../../assets/images/login-bg.png');
            background-size: 130%;
            background-position: center;
            background-color: #878CEDFF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            width: fit-content;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #1d1d1d;
            gap: 10px;
        }
        .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .login-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn:hover {
            background-color: #45a049;
        }

        p {
            margin-top: 15px;
        }

        p a {
            color: #4CAF50;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<a href="/">
    <div class="logo">
        <img src="../assets/images/sample-logo.png" alt="">
        <span>Brandboost</span>
    </div>
</a>
<div class="login-container">
    <h1>Forgot Password</h1>
    <form class="register-form" method="post" action="/auth/forgot-password" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="johnsena@gmail.com" required>
        </div>
        <button type="submit" class="btn">Reset Password</button>
    </form>
    <p><a href="/login">Back to Login</a></p>
    <p>Don't you have an account? <a href="/register">Register</a></p>
</div>

</body>

</html>