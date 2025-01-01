<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>About Us - Brandboost</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        .sign-up-button {
            background: white;
            color: #4169E1;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sign-up-button:hover {
            background: #f0f0f0;
        }

        .hero {
            background: linear-gradient(135deg, #4169E1, #8A2BE2);
            color: white;
            padding: 160px 20px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        }

        .hero img {
            width: 100%;
            height: auto;
            opacity: 0.3;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .cta-button {
            background: white;
            color: #4169E1;
            padding: 15px 35px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .about-section {
            padding: 80px 20px;
            background: #f8f9fa;
        }

        .about-section h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 40px;
        }

        .about-section p {
            font-size: 18px;
            padding: 0 20px;
            line-height: 1.8rem;
            color: #2e2e2e;
        }

        .about-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: center;
        }

        .about-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            text-align: center;
        }

        .about-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .about-card h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .about-card p {
            font-size: 16px;
            color: #666;
        }

        .team-section {
            padding: 80px 20px;
        }

        .team-section h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 40px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .team-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .team-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .team-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .team-card p {
            font-size: 16px;
            color: #666;
        }


        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .header-content {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <section class="hero">
        <img alt="Illustration of collaboration among influencers, designers, and business owners" height="800"
            src="https://storage.googleapis.com/a1aa/image/WvoCXvuz4JqFDZ7he3vIM6UQqzerPLbQmeRw0Tv3Ooa598AoA.jpg"
            width="1200" />
        <div class="container">
            <h1>Bridging Creativity and Opportunity</h1>
            <p>Empowering businesses to grow through impactful collaborations with influencers and designers.</p>
            <button class="cta-button"
                onclick="document.getElementById('mission').scrollIntoView({ behavior: 'smooth' });">Learn More</button>
        </div>
    </section>
    <section class="about-section" id="mission">
        <div class="container">
            <h2>Our Mission</h2>
            <div class="about-content">
                <div class="about-card">
                    <img alt="A group of diverse professionals collaborating on a project" height="200"
                        src="https://storage.googleapis.com/a1aa/image/FiuqPHpHjiJCCZ6sqQ0e2ZKnvW4ztQKWg3UDWm4AuzlANPAKA.jpg"
                        width="300" />
                    <h3>Connecting Talent</h3>
                    <p>We aim to connect the best creative professionals with businesses that need their expertise.</p>
                </div>
                <div class="about-card">
                    <img alt="A designer working on a digital tablet with creative tools around" height="200"
                        src="https://storage.googleapis.com/a1aa/image/ax45q7vfIKRdQCxofkQSH9g6en21WJcS0mAZPRLB7ICQ08AoA.jpg"
                        width="300" />
                    <h3>Empowering Creators</h3>
                    <p>Our platform empowers creators to showcase their skills and find opportunities that match their
                        talents.</p>
                </div>
                <div class="about-card">
                    <img alt="A business owner shaking hands with a creative professional" height="200"
                        src="https://storage.googleapis.com/a1aa/image/f4ij6bhFOh3bHCgh2HsOCmflUTiK5eX5rKi8nOm1hvBV08AoA.jpg"
                        width="300" />
                    <h3>Building Trust</h3>
                    <p>We build trust between businesses and creative professionals through verified profiles and secure
                        collaboration tools.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="about-section">
        <div class="container">
            <h2>Our Story</h2>
            <p>CreativeHub was founded with the vision of bridging the gap between businesses and creative
                professionals. Our founders, inspired by their own experiences in the creative industry, saw the need
                for a platform that could facilitate meaningful collaborations. Today, CreativeHub is a thriving
                community where influencers, designers, and business owners come together to create, innovate, and grow.
            </p>
        </div>
    </section>
    <section class="about-section">
        <div class="container">
            <h2>What We Do</h2>
            <div class="about-content">
                <div class="about-card">
                    <img alt="Influencer promoting a product" height="200"
                        src="https://storage.googleapis.com/a1aa/image/dXBTf7pOILQka6VNeFFUHmKCGcAXz4jMQMfTreE6efUbsnHAF.jpg"
                        width="300" />
                    <h3>For Influencers</h3>
                    <p>Connect with businesses for promotions and grow your personal brand.</p>
                </div>
                <div class="about-card">
                    <img alt="Designer working on a project" height="200"
                        src="https://storage.googleapis.com/a1aa/image/HV8yv7sWWqpqAFfQc19ewArS0Xe3QklqzntfC3Alj5m475BQB.jpg"
                        width="300" />
                    <h3>For Designers</h3>
                    <p>Showcase your skills and find clients who need your creative expertise.</p>
                </div>
                <div class="about-card">
                    <img alt="Business owner collaborating with a creative professional" height="200"
                        src="https://storage.googleapis.com/a1aa/image/PtgOL7CpcHqfCaLfsOfipdLUgrMAnnenUJNzO3ZnfgEy2zDgC.jpg"
                        width="300" />
                    <h3>For Business Owners</h3>
                    <p>Find creative and promotional services to elevate your brand and reach new audiences.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-card">
                    <img alt="Portrait of John Doe, CEO of CreativeHub" height="100"
                        src="https://storage.googleapis.com/a1aa/image/6yVDNncLcU45F9JPN2TMPNfDNRwHKrGqblFJU3fu7ew098AoA.jpg"
                        width="100" />
                    <h3>John Doe</h3>
                    <p>CEO</p>
                </div>
                <div class="team-card">
                    <img alt="Portrait of Jane Smith, CTO of CreativeHub" height="100"
                        src="https://storage.googleapis.com/a1aa/image/2oiRP0fR0CSdDqf27iqBHGDRhRtrkhDodu2mHnRfPBvx98AoA.jpg"
                        width="100" />
                    <h3>Jane Smith</h3>
                    <p>CTO</p>
                </div>
                <div class="team-card">
                    <img alt="Portrait of Mike Johnson, Head of Design at CreativeHub" height="100"
                    src="https://storage.googleapis.com/a1aa/image/WJ6eUnFusVxhJKfLtP6T0i8198gkO71wMZErPxDBpgdze8AoA.jpg"
                    width="100" />
                <h3>Mike Johnson</h3>
                <p>Head of Design</p>
            </div>
            <div class="team-card">
                <img alt="Portrait of Sarah Williams, Marketing Director at CreativeHub" 
                     src="https://storage.googleapis.com/a1aa/image/YLF8YuFrz6ZjPNDwwd79fxcquEipjyVBj9C1kqeg8EQ1e8AoA.jpg" 
                     width="100" height="100" />
                <h3>Sarah Williams</h3>
                <p>Marketing Director</p>
            </div>
        </div>
    </div>
</section>

<script>
    // Smooth scroll animation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Header scroll effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header');
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Fade up animation on scroll
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-up').forEach((element) => {
        observer.observe(element);
    });
</script>
</body>

</html>