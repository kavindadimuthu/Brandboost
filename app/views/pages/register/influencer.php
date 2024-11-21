<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influencer Register</title>
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
            <form class="register-form">
                <div class="form-header">
                    <!-- <img src="brandboost-logo.png" alt="Brandboost Logo" class="form-logo"> -->
                    <h2>Influencer Register</h2>
                </div>

                <div class="form-group">
                    <input type="text" placeholder="First Name" required>
                    <input type="text" placeholder="Last Name" required>
                </div>

                <div class="form-group">
                    <input type="email" placeholder="E mail" required>
                </div>

                <div class="form-group">
                    <input type="tel" placeholder="Phone Number" required>
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Password" required>
                    <input type="password" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                </div>

                <div class="form-group">
                    <input type="url" placeholder="Facebook Profile Link">
                    <input type="url" placeholder="Instagram Profile Link">
                    <input type="url" placeholder="Youtube Channel Link">
                    <input type="url" placeholder="Tik Tok Profile Link">
                </div>

                <div class="form-group" style="padding: 10px;">
                    <input type="checkbox" id="privacy" required>
                    <label for="privacy">I agree all statements in <a href="#">Privacy Policy for BRANDBOOST</a></label>
                </div>

                <div class="form-group">
                    <button class="submit-button" type="submit">Register</button>
                </div>

                <div class="form-group" style="font-size: small;">
                    <label for="privacy">Already registerd? <a href="#">Login here</a></label>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
