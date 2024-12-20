<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../styles/admin/sidebar.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
    </style>
</head>
<body>
    <div>
        <h1>SingleUser page</h1>
        <p>Here shows profile view of a user</p>
        <button onclick="window.location.href='/adminviewcontroller/allusers'">Go back to all users view</button>
        <button onclick="window.location.href='/adminviewcontroller/singleuserpackage'">Go to single user package view</button>
    </div>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Profile - Harley Quinn</title>
    <link rel="stylesheet" href="../../styles/admin/singleInfluencer.css">
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
<div class="container">
        <div id="sidebar-container">
            <!-- <div id="sidebar"></div> -->
            <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>

          </div>
          <div class="main-content">
            <div class="heading">
                <h1>Influencer</h1>
                <div class="back-button">
                    <div class="back-btn" onclick="window.location.href='/adminviewcontroller/allusers'">Back to all users</div>
                </div>
            </div>

        <!-- Profile Section -->
        <section class="profile">
            <div class="profile-header">
                <img src="https://via.placeholder.com/150" alt="Anna Jones" class="profile-image">
                <div class="profile-info">
                    <h1>Anna Jones</h1>
                    <div class="ratings">
                        <div class="score">
                            <span>SCORE</span>
                            <div class="score-value">
                                4.8
                                <div class="stars">
                                    ★★★★★
                                </div>
                            </div>
                        </div>
                        <div class="social-score">
                            <span>SOCIAL</span>
                            <div class="social-value">
                                1600+
                                <i class="fa-brands fa-social"></i>
                            </div>
                        </div>
                    </div>
                    <div class="expertise">
                        <span>Areas expert at</span>
                        <div class="tags">
                            <span class="tag">Travel</span>
                            <span class="tag">Sport</span>
                            <span class="tag">Life</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about">
            <h2>About</h2>
            <p>Cupidatat sunt culpatur justo online clinic ehenderit we labore consectetur volupt elit sin item ut volupt volves. Deserunt sint consequat sed sunt id reprehenderit we labore consectetur justo elit sin item ut volupt volves Lorem supply sunt deserunt mogna nulla.</p>
        </section>

        <!-- Social Section -->
        <section class="social">
            <h2>Social</h2>
            <div class="social-grid">
                <div class="social-card">
                    <img src="https://via.placeholder.com/80" alt="Social Profile">
                    <div class="social-info">
                        <h3>TravelWithAnna</h3>
                        <span>1.2M+</span>
                        <i class="fab fa-youtube"></i>
                    </div>
                    <button class="follow-btn">Follow</button>
                </div>
                <div class="social-card">
                    <img src="https://via.placeholder.com/80" alt="Social Profile">
                    <div class="social-info">
                        <h3>QueenPlanet</h3>
                        <span>940k+</span>
                        <i class="fab fa-facebook"></i>
                    </div>
                    <button class="follow-btn">Follow</button>
                </div>
                <div class="social-card">
                    <img src="https://via.placeholder.com/80" alt="Social Profile">
                    <div class="social-info">
                        <h3>Kawaii</h3>
                        <span>1.3M+</span>
                        <i class="fab fa-instagram"></i>
                    </div>
                    <button class="follow-btn">Follow</button>
                </div>
                <div class="social-card">
                    <img src="https://via.placeholder.com/80" alt="Social Profile">
                    <div class="social-info">
                        <h3>ThanaSEY</h3>
                        <span>850k+</span>
                        <i class="fab fa-tiktok"></i>
                    </div>
                    <button class="follow-btn">Follow</button>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services">
            <div class="section-header">
                <h2>Services</h2>
                <a href="#" class="see-all">See all ›</a>
            </div>
            <div class="services-grid" id="servicesGrid"></div>
        </section>

        <!-- Reviews Section -->
        <section class="reviews">
            <div class="section-header">
                <h2>Reviews</h2>
                <a href="#" class="see-all">See all ›</a>
            </div>
            <div class="reviews-grid" id="reviewsGrid"></div>
        </section>
    </div>
    <script src="../../scripts/admin/singleInfluencer.js"></script>

</body>
</html>