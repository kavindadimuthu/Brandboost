<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        * {
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 50px;
            min-height: 100vh;
            margin: 0;
        }

        button {
            background-color: white;
            color: #6772e5;
            border: none;
            padding: 18px 30px;
            border-radius: 25px;
            font-size: 1.3rem;
            cursor: pointer;
            /* width: 100%; */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Drop shadow */
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

        a {
            font-size: 1.2rem;
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>

    <a href="http://localhost:8000/homecontroller/index">
        <div class="logo">
            <img src="../assets/images/sample-logo.png" alt="">
            <span>Brandboost</span>
        </div>
    </a>

    <!-- <h1>This is Register Selection Page</h1> -->
    <div class="wrapper">
        <button onclick="window.location.href='/homecontroller/registerBusiness'">Register as Business</button>
        <button onclick="window.location.href='/homecontroller/registerInfluencer'">Register as Influencer</button>
        <button onclick="window.location.href='/homecontroller/registerDesigner'">Register as Designer</button>
        <!-- <button onclick="window.location.href='/homecontroller/login'">Go to login</button> -->
    </div>
    <div>
        <a href="http://localhost:8000/homecontroller/login">Go to login</a>
    </div>

</body>

</html>