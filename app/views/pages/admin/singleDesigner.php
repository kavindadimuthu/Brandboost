<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designer Profile - Harley Quinn</title>
    <link rel="stylesheet" href="../../styles/admin/singleDesigner.css">
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div id="sidebar-container">
            <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>
        <!-- <div id="sidebar"></div> -->
          </div>
          <div class="main-content">
            <div class="heading">
                <h1>Designer</h1>
                <div class="back-button">
                    <div class="back-btn" onclick="window.location.href='/adminviewcontroller/allusers'">Back to all users</div>
                </div>
            </div>

        <!-- Profile Section -->
        <section class="profile">
            <div class="profile-header">
                <img src="https://via.placeholder.com/150" alt="Harley Quinn" class="profile-image">
                <div class="profile-info">
                    <h1>Harley Quinn</h1>
                    <p class="role">Designer</p>
                    <div class="ratings">
                        <div class="score">
                            <span>SCORE</span>
                            <div class="score-value">
                                4.8
                                <div class="stars">★★★★★</div>
                            </div>
                        </div>
                        <div class="social-score">
                            <span>SOCIAL</span>
                            <div class="social-value">
                                1600+
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                        </div>
                    </div>
                    <div class="expertise">
                        <span>Areas expert at</span>
                        <div class="tags">
                            <span class="tag">Design</span>
                            <span class="tag">Product</span>
                            <span class="tag">Web</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about">
            <h2>About</h2>
            <div id="aboutContent"></div>
        </section>

        <!-- Skills Section -->
        <section class="skills">
            <h2>Skills</h2>
            <div class="skills-grid" id="skillsGrid"></div>
        </section>

        <!-- Designer Gallery Section -->
        <section class="gallery">
            <h2>Designer Gallery</h2>
            <div class="gallery-grid" id="galleryGrid"></div>
        </section>

        <!-- Services Section -->
        <section class="services">
            <div class="section-header">
                <h2>Services</h2>
                <a href="#" class="see-all">See all ›</a>
            </div>
            <div class="services-grid" id="servicesGrid"></div>
        </section>

        <!-- Experience Section -->
         <section class="experience-education">
            <section class="experience">
                <h2>Experience</h2>
                <div class="timeline-ex" id="experienceTimeline"></div>
            </section>
            <section class="education">
                <h2>Education</h2>
                <div class="timeline-edu" id="educationTimeline"></div>
            </section>
        </section>
        <br>

        <!-- Reviews Section -->
        <section class="reviews">
            <div class="section-header">
                <h2>Reviews</h2>
                <a href="#" class="see-all">See all ›</a>
            </div>
            <div class="reviews-grid" id="reviewsGrid"></div>
        </section>
    </div>
    <script src="../../scripts/admin/singleDesigner.js"></script>
</body>
</html>