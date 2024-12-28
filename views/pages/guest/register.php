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

        .logo {
            position: absolute;
            top: 30px;
            left: 30px;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #1d1d1d;
            gap: 10px;
        }

        .logo img {
            height: 40px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
        }

        .button-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.5s cubic-bezier(0.19, 1, 0.22, 1),
            box-shadow 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .custom-button {
            width: 350px;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            background: linear-gradient(135deg, #4b0082 0%, #6a11cb 100%);
            border: none;
            border-radius: 10px 10px 0 0;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 8px 15px rgba(0, 123, 255, 0.2);
            position: relative;
        }

        .custom-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
        }

        .button-wrapper img {
            height: 350px;
            width: 350px;
            border-radius: 0 0 10px 10px;
            transition: transform 0.5s cubic-bezier(0.19, 1, 0.22, 1),
            box-shadow 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .button-wrapper:hover {
            box-shadow: 0px 15px 20px rgba(0, 123, 255, 0.4);
            transform: translateY(-5px) scale(1.05);
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

<div class="button-container">
    <div class="button-wrapper" onclick="window.location.href='/homecontroller/registerBusiness'">
        <button class="custom-button">Register as Business</button>
        <img src="../../assets/businessman_logo.jpg" alt="Business Owner">
    </div>

    <div class="button-wrapper" onclick="window.location.href='/homecontroller/registerInfluencer'">
        <button class="custom-button">Register as Influencer</button>
        <img src="../../assets/influencer_logo.jpg" alt="Influencer">
    </div>

    <div class="button-wrapper" onclick="window.location.href='/homecontroller/registerDesigner'">
        <button class="custom-button">Register as Designer</button>
        <img src="../../assets/designer_logo.jpg" alt="Designer">
    </div>
</div>

<div>
    <button class="custom-button" onclick="window.location.href='/login'">Go to Login</button>
</div>

</body>

</html>
