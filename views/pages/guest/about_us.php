<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brandboost | About Us</title>
    <link rel="stylesheet" href="../../styles/common/index.css">
    <link rel="stylesheet" href="../../styles/common/guestHeader.css">
    <link rel="stylesheet" href="../../styles/common/About.css">
    <link rel="stylesheet" href="../../styles/common/footer.css">

    <style>
        :root {
            --purple-color: #636ae8;
        }

        *,
        *::after,
        *::before {
            box-sizing: border-box;
        }

        body {

            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333;
            /* font-family: 'Roboto', sans-serif; */
            margin: 0;
            padding: 0;
            background-color: #f5f7ff;
        }

        /* Headings */
        .heading {
            text-align: center;
            font-size: 3rem;
            font-weight: 600;
        }

        /* Common containers & wrappers */
        header,
        section,
        footer {
            width: 100%;
        }

        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        /* ------------------------- */


        /* Buttons */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 24px;
            color: #fff;
            display: inline-block;
            font-family: Inter;
            font-weight: bold;
            font-size: 1rem;
        }

        .login-btn {
            background-color: transparent;
            color: var(--purple-color);
            color: #333;
            font-weight: 600;
        }

        .register-btn {
            background-color: var(--purple-color);
            color: #fff;
            /* background-color: #4a6cf7; */
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .scroll-btn {
            background-color: #fff;
            color: #6358FF;
        }

        .learn-more-btn {
            font-family: Inter;
            color: #636AE8FF;
            background: #FFFFFFFF;
            opacity: 1;
            border-radius: 26px;
            border-width: 1px;
            border-color: #636AE8FF;
            border-style: solid;
        }

        .cta-btn {
            color: #FFFFFFFF;
            background: #E8618CFF;
            padding: 10px 40px;
        }

        /* ------------------------------ */
        /* About Us Section Styles */
        .aboutus {
            padding: 80px 0;
        }

        .aboutus>.wrapper {
            display: flex;
        }

        .aboutus-content {}

        .aboutus-content>.heading {
            text-align: left;
        }

        .aboutus-content>.heading::after {
            content: "";
            display: block;
            margin-bottom: 2rem;
        }

        .aboutus .description {
            font-size: 1.4rem;
            line-height: 36px;
            font-weight: 400;
            color: #6E7787FF;
            margin-right: 3rem;
        }

        .aboutus-image {
            max-width: 700px;
        }

        /* -------------------- */




        /* Our Values section styles */
        .our-values {
            padding: 80px 0;
            background-color: #ebebeb;
        }

        .our-values>.wrapper>.heading::after {
            content: "";
            display: block;
            margin-bottom: 50px;
        }

        .values-container {
            display: flex;
            justify-content: space-between;
        }

        .value-card {
            max-width: 30%;
            background-color: rgb(255, 255, 255);
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .value-card img {
            width: 100%;
        }

        .value-card>.description {
            text-align: center;
            margin: 0 20px;
        }

        .value-card>.description::after {
            content: "";
            display: block;
            height: 1rem;
        }

        /* ------------------------- */






        /* Our mission Section Styles */

        .our-mission {
            padding: 80px 0;
            background-color: #f3f3f3;
            background-image: url('../../assets/images/about/Group\ 60.png');
            /* background-size: 120%; */
            background-position: right center;
        }

        .our-mission>.wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .our-mission p {
            font-family: Inter;
            /* Body */
            font-size: 24px;
            line-height: 36px;
            font-weight: 400;
            color: #323842FF;
        }





        /* -------------------- */

    </style>
</head>
<body>

<section class="aboutus">
    <div class="wrapper">
        <div class="aboutus-content">
            <div class="heading">About Us</div>
            <div class="description">
                Welcome to Brandboost, the ultimate destination where creativity meets opportunity!<br><br>
                Our platform bridges the gap between influencers, designers, and businesses, creating a seamless marketplace for promoting and designing services. We believe in empowering individuals and organizations by fostering meaningful collaborations that drive growth, creativity, and success.
            </div>
        </div>
        <div class="aboutus-image">
            <img src="../../assets/images/about/aboutus-main-group.png" alt="">
        </div>
</section>

<section class="our-values">
    <div class="wrapper">
        <div class="heading">Our Values</div>
        <div class="values-container">
            <div class="value-card">
                <img src="../../assets/images/about/Image 62 (1).png" alt="">
                <h3>Diverse Talent Pool</h3>
                <div class="description">Access a curated network of skilled influencers and designers</div>
            </div>
            <div class="value-card">
                <img src="../../assets/images/about/Image 60.png" alt="">
                <h3>Transparent Process</h3>
                <div class="description">Enjoy clear pricing, secure payments, and straightforward communication</div>
            </div>
            <div class="value-card">
                <img src="../../assets/images/about/Image 61.png" alt="">
                <h3>Growth-Focused</h3>
                <div class="description">We’re here to help you grow, whether you’re building your brand or expanding your portfolio</div>
            </div>
        </div>
</section>

<section class="our-mission">
    <div class="wrapper">
        <div class="heading">Our Mission</div>
        <p>Our mission is to create a thriving ecosystem where businesses, influencers, and designers come together to achieve mutual success. We are committed to fostering innovation, collaboration, and trust in every interaction.</p>
    </div>
</section>


</body>
</html>