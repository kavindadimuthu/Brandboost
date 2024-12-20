<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Role</title>
    <link rel="stylesheet" href="../../styles/register/chooseRole.css">
</head>

<body>
    <header>
        <div class="header-container">
            <img src="../../assets/Logo.svg" alt="BrandBoost Logo" class="logo">
            <nav>
                <ul class="nav-icons">
                    <li><a href="#"><img src="../../assets/contact-us.png" alt="Contact Us"></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="register-container">
            <form class="register-form">
                <div class="form-header">
                    <h2>Choose your role for registration</h2>
                </div>

                <div class="button-container" >
                    <div class="button-wrapper" onclick="window.location.href='/InfluencerViewController/register'">
                        <button class="custom-button" onclick="window.location.href='/InfluencerViewController/register'">Influencer</button>
                        <img src="../../assets/influencer_logo.jpg" alt="Influencer" class="button-image">
                    </div>

                    <div class="button-wrapper" onclick="window.location.href='/DesignerViewController/register'">
                        <button class="custom-button" onclick="window.location.href='/DesignerViewController/register'">Designer</button>
                        <img src="../../assets/designer_logo.jpg" alt="Designer" class="button-image">
                    </div>

                    <div class="button-wrapper" onclick="window.location.href='/BusinessViewController/register'">
                        <button class="custom-button" onclick="window.location.href='/BusinessViewController/register'">Business Owner</button>
                        <img src="../../assets/businessman_logo.jpg" alt="Business Owner" class="button-image">
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
