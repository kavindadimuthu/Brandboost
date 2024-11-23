<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/common/Login.css">
</head>

<body>
    <a href="http://localhost:8000/homecontroller/index">
        <div class="logo">
            <img src="../assets/images/sample-logo.png" alt="">
            <span>Brandboost</span>
        </div>
    </a>
    <div class="login-container">
        <h1>Log In</h1>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter at least 8 characters" required>
            </div>
            <button type="submit" class="btn">Sign In</button>
        </form>
        <p>Don't you have an account? <a href="#">Register</a></p>
    </div>

</body>

</html>