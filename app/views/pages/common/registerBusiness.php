<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as business</title>
    <link rel="stylesheet" href="../styles/common/Register.css">
</head>

<body>
    <a href="http://localhost:8000/homecontroller/index">
        <div class="logo">
            <img src="../assets/images/sample-logo.png" alt="">
            <span>Brandboost</span>
        </div>
    </a>
    <div class="register-container">
        <h1>Register as Business</h1>

        <form class="register-form" method="post" action="/RegisterController/register" enctype="multipart/form-data">

            <input type="hidden" name="role" value="businessman">

            <div class="form-group">
                <input type="text" name="first_name" placeholder="First Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail" required>
            </div>

            <div class="form-group">
                <input type="tel" name="phone_number" placeholder="Phone Number" required>
            </div>
            
            <div class="form-group">
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <!-- <div class="form-group">
                    <div class="upload-section">
                        <div>Upload Business Registration Details</div>
                        <label for="file-upload">Upload Business Registration Details</label>
                        <input type="file" id="file-upload" name="business_document"
                            accept="image/*, .pdf, .doc, .docx">
                    </div>
            </div> -->

            <div class="form-group-tick">
                <input type="checkbox" id="privacy" name="privacy_policy" required>
                <label for="privacy">I agree to all statements in <a href="#">Privacy Policy for
                        BRANDBOOST</a></label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Register</button>
            </div>
            <p>Already registered? <a href="http://localhost:8000/homecontroller/login">Login here</a></p>

        </form>

    </div>

</body>

</html>