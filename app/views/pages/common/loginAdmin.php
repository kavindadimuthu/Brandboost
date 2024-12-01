<html>
<head>
    <title>Admin Login Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, rgba(75, 0, 130, 0.8), rgba(106, 17, 203, 0.8)), url('https://placehold.co/1920x1080') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #4b0082;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
        }
        .login-container input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            font-size: 14px;
        }
        .login-container button {
            padding: 10px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .login-container button:hover {
            background-color: #4b0082;
        }
        .login-container .forgot-password {
            margin-top: 10px;
            font-size: 12px;
            color: #6a11cb;
        }
        .login-container .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form class="login-admin-form" method="post" action="/LoginController/loginAdmin" enctype="multipart/form-data">
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="#" class="forgot-password">Forgot Password?</a>
    </div>
</body>
</html>