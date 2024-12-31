<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Register as Business
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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

        .register-container {
            background-color: white;
            margin: 10vh auto;
            padding: 40px 40px;
            border-radius: 50px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 45vw;
        }

        .register-container>h1 {
            margin-bottom: 40px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group-tick {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 20px;
            outline: none;
            border: 1px solid #ebebeb;
            border-radius: 18px;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #f1f1f1;
        }

        input::placeholder {
            font-size: 1rem;
            color: #b3b3b3;
        }

        option::placeholder {
            font-size: 1rem;
            color: #b3b3b3;
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            text-align: center;
            margin-top: 20px;
        }
  </style>
 </head>
 <body>
  <a href="/">
   <div class="logo">
    <img alt="Company logo with a stylized 'B' in blue and white" height="40" src="../assets/images/sample-logo.png" width="40"/>
    <span>
     Brandboost
    </span>
   </div>
  </a>
  <div class="register-container">
   <h1>
    Register as <?php echo $data[0]; ?>
   </h1>
   <form action="/RegisterController/register" class="register-form" enctype="multipart/form-data" method="post">
    <input name="role" type="hidden" value='<?php echo $data[0]; ?>'/>
    <div class="form-group">
     <input name="first_name" placeholder="First Name" required="" type="text"/>
    </div>
    <div class="form-group">
     <input name="last_name" placeholder="Last Name" required="" type="text"/>
    </div>
    <div class="form-group">
     <input name="email" placeholder="E-mail" required="" type="email"/>
    </div>
    <div class="form-group">
     <input name="phone_number" placeholder="Phone Number" required="" type="tel"/>
    </div>
    <div class="form-group">
     <select id="gender" name="gender">
      <option value="male">
       Male
      </option>
      <option value="female">
       Female
      </option>
     </select>
    </div>
    <div class="form-group">
     <input name="password" placeholder="Password" required="" type="password"/>
    </div>
    <div class="form-group">
     <input name="confirm_password" placeholder="Confirm Password" required="" type="password"/>
    </div>
    <div class="form-group-tick">
     <input id="privacy" name="privacy_policy" required="" type="checkbox"/>
     <label for="privacy">
      I agree to all statements in
      <a href="#">
       Privacy Policy for BRANDBOOST
      </a>
     </label>
    </div>
    <div class="form-group">
     <button class="btn" type="submit">
      Register
     </button>
    </div>
    <p>
     Already registered?
     <a href="/login">
      Login here
     </a>
    </p>
   </form>
  </div>
 </body>
</html>
