<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business owner Register</title>
    <link rel="stylesheet" href="../../styles/register/register.css">
</head>

<body>
    <header>
        <div class="header-container">
            <img src="../../assets/Logo.svg" alt="Brandboost Logo" class="logo">
            <nav>
                <ul class="nav-icons">
                    <!-- <li><a href="#"><img src="message-icon.png" alt="Messages"></a></li> -->
                    <li><a href="#"><img src="../../assets/contact-us.png" alt="contact"></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="register-container">


            <form class="register-form" method="post" action="/RegisterController/register" enctype="multipart/form-data">
                <div class="form-header">
                    <h2>Business Owner Register</h2>
                </div>

                <div class="form-group">
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>

                <div class="form-group">
                    <input type="tel" name="phone_number" placeholder="Phone Number" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                    <!-- <input type="text" name="business_name" placeholder="Business/Company Name" required> -->
                    <!-- <input type="text" name="address" placeholder="Address" required> -->
                    <!-- <input type="url" name="website_url" placeholder="Business/Company Web Page URL"> -->
                    <!-- <input type="url" name="social_media_url" placeholder="Social Media Platform URL"> -->
                </div>

                <!-- <div class="form-group">
                    <div class="upload-section">
                        <h3>Upload Business Registration Details</h3>
                        <label for="file-upload">Choose file to upload:</label>
                        <input type="file" id="file-upload" name="business_document"
                            accept="image/*, .pdf, .doc, .docx">
                    </div>
                </div> -->

                <div class="form-group">
                    <input type="checkbox" id="privacy" name="privacy_policy" required>
                    <label for="privacy">I agree to all statements in <a href="#">Privacy Policy for
                            BRANDBOOST</a></label>
                </div>

                <div class="form-group">
                    <button class="submit-button" type="submit">Register</button>
                </div>

                <div class="form-group" style="font-size: small;">
                    <label>Already registered? <a href="#">Login here</a></label>
                </div>
            </form>


        </div>
    </main>
</body>

</html>