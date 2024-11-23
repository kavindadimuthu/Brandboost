<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../../styles/common/commonregister.css">
</head>
<body>
    <div class="navbar">
        <button class="nav-button" onclick="window.location.href='/homecontroller/index'">Back</button>
        <span class="logo">Brandboost</span>
        <button class="nav-button" onclick="window.location.href='/homecontroller/login'">Login</button>
    </div>
    
<div class="container">   
        <h1>Register As</h1>
        <div class="container">
            <button class="register-btn" onclick="window.location.href='/homecontroller/registerBusiness'">Business</button>
            <button class="register-btn" onclick="window.location.href='/homecontroller/registerInfluencer'">Influencer</button>
            <button class="register-btn" onclick="window.location.href='/homecontroller/registerDesigner'">Designer</button>
            </div>
        <script src="script.js"></script>
</div>
</body>
</html>