<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            background-color: white;
            padding: 60px 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 30vw;
        }
        .login-container>h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px 15px;
            outline: none;
            border: 1px solid #ccc;
            border-radius: 18px;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #f1f1f1;
        }
        input::placeholder{
            font-size: 1rem;
            color: #ccc;
        }

        .btn {
            background-color: #6772e5;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 18px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Drop shadow */
        }

        .btn:hover {
            background-color: #5469d4;
        }

        a {
            color: #6772e5;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
        p {
            text-align: center; /* Center-align text */
            margin-top: 20px;
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
    <h1>Log In</h1>
    <form class="register-form" method="post" action="/auth/login" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="johnsena@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter at least 8 characters" required>
        </div>
        <button type="submit" class="btn">Sign In</button>
    </form>
    <p>Don't you have an account? <a href="/register">Register</a></p>
</div>

</body>

</html>