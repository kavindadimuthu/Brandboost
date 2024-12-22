<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brandboost</title>
    <style>
        /* Hero Section Styles */
.hero {
  background-image: url('../../assets/images/hero-bg.png');
  background-size: cover;
  background-position: center;
  padding: 80px 0;
  min-height: 90vh;
}

.hero-content {
  text-align: center;
  color: #fff;
}

.heading-upper-text {
  font-size: 1.5rem;
}

.heading-text {
  font-size: 3.8rem;
}

/* commeted part */
.hero-images {
  display: flex;
  justify-content: center;
  margin-top: 40px;
  gap: 2rem;
}

.image-circle {
  width: 80px;
  height: 80px;
  background-color: #baf3eb;
  border-radius: 50%;
  overflow: hidden;
}

.image-circle img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* -------------------- */





/* About Us Section Styles */
.about-us {
  padding: 80px 0;
}

.about-us>.wrapper {
  display: flex;
}

.about-us-content {
  max-width: 40%;
  display: flex;
  flex-direction: column;
  gap: 20px;
  align-items: left;
  text-align: left;
  font-size: 20px;
  line-height: 30px;
  font-weight: 400;
  color: #323842FF;
}

.about-us-content>img {
  max-width: 400px;
}

.image-box>img {
  max-width: 700px;
}

/* -------------------- */




/* Why Choose Us Section Styles */
.why-choose-us {
  padding: 80px 0;
}

.why-choose-us .box-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.box-item {
  padding: 20px 20px 30px 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  position: relative;
  overflow: hidden;
}

.box-item .box-item-heading {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 10px;
}

.box-item p {
  font-size: 1rem;
  color: #555;
}

.box-container>div:nth-child(1) {
  background-color: #BAF3EBFF;
  /* Light Red */
}

.box-container>div:nth-child(2) {
  background-color: #CED0F8FF;
  /* Light Green */
}

.box-container>div:nth-child(3) {
  background-color: #F8DBD0FF;
  /* Light Blue */
}

.box-container>div:nth-child(4) {
  background-color: #FDF1F5FF;
  /* Light Yellow */
}

.box-item::before {
  content: '';
  position: absolute;
  background-size: cover;
  width: 120px;
  aspect-ratio: 1/1;
}

.box-container>div:nth-child(1)::before {
  background-image: url('../../assets/images/why-choose-us-images/Image 50.png');
  bottom: 10%;
  right: 10%;
}

.box-container>div:nth-child(2)::before {
  background-image: url('../../assets/images/why-choose-us-images/Image 51.png');
  bottom: 10%;
  right: 10%;
}

.box-container>div:nth-child(3)::before {
  background-image: url('../../assets/images/why-choose-us-images/Image 52.png');
  bottom: 10%;
  right: 10%;
}

.box-container>div:nth-child(4)::before {
  background-image: url('../../assets/images/why-choose-us-images/Image 53.png');
  bottom: 10%;
  right: 10%;
}




/* Success Stories Section Styles */
.success-stories {
  padding: 80px 0;
}

.story-boxes-container {
  padding: 40px 30px 70px 30px;
  border-radius: 20px;
  display: flex;
  gap: 20px;
  background-color: var(--purple-color);
}

.story-box {
  background-color: #F5F5F5;
  border-radius: 10px;
  padding: 20px 20px 50px 20px;
}

.story-box-upper-content {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 20px;
}

.yellow-stars {
  color: rgb(195, 179, 2);
}

/* ------------------------ */




/* Call to Action Section Styles */
.call-to-action {
  padding: 80px 0;
  text-align: center;
  font-size: 2rem;
  line-height: 56px;
  font-weight: 600;
  color: #FFFFFFFF;
}

.call-to-action>.wrapper {
  padding: 40px;
  border-radius: 20px;
  background-color: #2C35E0FF;
  position: relative;
}

.arrow-icon {
  position: absolute;
  width: 100px;
  bottom: 15%;
  right: 32%;
}

/* -------------------------- */
    </style>
</head>
<body>
    <section class="hero">
        <div class="wrapper">
            <div class="hero-content">
                <span class="heading-upper-text">Official business promoting web platform</span>
                <h1 class="heading-text">Promote Your <br>Business</h1>
                <button class="btn scroll-btn">Scroll down</button>
            </div>
            <!-- <div class="hero-images">
                <div class="image-circle"><img src="../../assets/images/Image40.png" alt=""></div>
                <div class="image-circle"><img src="../../assets/images/Image47.png" alt=""></div>
                <div class="image-circle"><img src="../../assets/images/Image48.png" alt=""></div>
                <div class="image-circle"><img src="../../assets/images/Image 41.png" alt=""></div>
                <div class="image-circle"><img src="../../assets/images/Image 42.png" alt=""></div>
                <div class="image-circle"><img src="../../assets/images/Image 43.png" alt=""></div>
                <div class="image-circle"><img src="../../assets/images/Image 44.png" alt=""></div>
            </div> -->
        </div>
    </section>
    <section class="about-us">
        <div class="wrapper">
            <div class="about-us-content">
                <span class="heading">About Us</span>
                <img src="../../assets/images/topic-line.png" alt="">
                <p class="about-us-text">Brandboost is where influencers, designers, and businesses connect to create magic! We bring together talented creators offering promotional and design services with businesses looking to elevate their brand. Whether you’re an influencer, a designer, or a business , we make collaboration easy, secure, and impactful.</p>
                <button class="btn learn-more-btn">Learn More</button>
            </div>
            <div class="image-box">
                    <img src="../../assets/images/about-us-section-image.png" alt="">
                </div>
        </div>
    </section>
    <section class="why-choose-us">
        <div class="wrapper">
            <h1 class="heading">Why choose us</h1>
            <div class="box-container">
                <div class="box-item">
                    <div class="box-item-content">
                        <div class="box-item-heading">Secure transactions</div>
                        <p>Labore proident nisi fugiat nostrud sint mollit aliqua ipsum ad veniam cupidatat</p>
                    </div>
                    <div class="box-item-image">
                    </div>
                </div>
                <div class="box-item">
                    <div class="box-item-content">
                        <div class="box-item-heading">Diverse talent pool</div>
                        <p>Labore proident nisi fugiat nostrud sint mollit aliqua ipsum ad veniam cupidatat</p>
                    </div>
                    <div class="box-item-image">
                    </div>
                </div>
                <div class="box-item">
                    <div class="box-item-content">
                        <div class="box-item-heading">Customizable solutions</div>
                        <p>Labore proident nisi fugiat nostrud sint mollit aliqua ipsum ad veniam cupidatat</p>
                    </div>
                    <div class="box-item-image">
                    </div>
                </div>
                <div class="box-item">
                    <div class="box-item-content">
                        <div class="box-item-heading">Transparent pricing</div>
                        <p>Labore proident nisi fugiat nostrud sint mollit aliqua ipsum ad veniam cupidatat</p>
                    </div>
                    <div class="box-item-image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="success-stories">
        <div class="wrapper">
            <h1 class="heading">Success stories</h1>
            <div class="story-boxes-container">
                <div class="story-box">
                    <div class="story-box-content">
                        <div class="story-box-upper-content">
                            <img src="../../assets/images/success-stories-users/Avatar 106.png" alt="">
                            <div class="name-star-box">
                                <div class="name">Ashley Robinson</div>
                                <div class="star-wrapper yellow-stars">★★★★★</div>
                            </div>
                        </div>
                        <div class="story-box-lower-content">
                            <span>I recently hired a business coach and was highly impressed with their support and expertise.</span>
                        </div>
                    </div>
                </div>
                <div class="story-box">
                    <div class="story-box-content">
                        <div class="story-box-upper-content">
                            <img src="../../assets/images/success-stories-users/Avatar 107.png" alt="">
                            <div class="name-star-box">
                                <div class="name">Ashley Robinson</div>
                                <div class="star-wrapper yellow-stars">★★★★★</div>
                            </div>
                        </div>
                        <div class="story-box-lower-content">
                            <span>I recently hired a business coach and was highly impressed with their support and expertise.</span>
                        </div>
                    </div>
                </div>
                <div class="story-box">
                    <div class="story-box-content">
                        <div class="story-box-upper-content">
                            <img src="../../assets/images/success-stories-users/Avatar 108.png" alt="">
                            <div class="name-star-box">
                                <div class="name">Ashley Robinson</div>
                                <div class="star-wrapper yellow-stars">★★★★★</div>
                            </div>
                        </div>
                        <div class="story-box-lower-content">
                            <span>I recently hired a business coach and was highly impressed with their support and expertise.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="call-to-action">
        <div class="wrapper">
            <div class="heading">Ready to create something amazing? 
                <br>Join  us today!</div>
            <button class="btn cta-btn">Get Started</button>
            <img class="arrow-icon" src="../../assets/images/curved-arrow.png" alt="">
        </div>
    </section>
   
</body>
</html>