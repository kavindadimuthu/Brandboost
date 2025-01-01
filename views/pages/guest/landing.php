<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Brandboost</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 20px;
        }


        /* Button Styles */
        .cta-button,
        .cta-button-mini {
            background: white;
            color: #4169E1;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .cta-button {
            padding: 15px 35px;
            font-size: 18px;
        }

        .cta-button-mini {
            padding: 10px 20px;
            font-size: 16px;
        }

        .cta-button:hover,
        .cta-button-mini:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .secondary-button {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .secondary-button:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Hero Section */
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

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Card Sections */
        .stats,
        .testimonials {
            background: #f8f9fa;
            padding: 60px 20px;
        }

        .stats-grid,
        .features-grid,
        .testimonials-grid {
            display: grid;
            gap: 30px;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .features-grid,
        .testimonials-grid {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .stat-card,
        .testimonial-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card h3 {
            font-size: 36px;
            color: #4169E1;
            margin-bottom: 10px;
        }

        /* Features Section */
        .features {
            padding: 80px 20px;
        }

        .features h2,
        .testimonials h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 60px;
        }

        .feature-card {
            text-align: center;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .feature-icon {
            background: #e6f0ff;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: #4169E1;
        }

        .feature-card h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #4169E1, #8A2BE2);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 20px;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        /* Testimonials */
        .testimonial-content {
            font-style: italic;
            margin-bottom: 20px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #4169E1;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .author-details h4 {
            margin: 0;
            color: #333;
        }

        .author-details p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }

        

        /* Animations */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .header-content {
                justify-content: center;
            }

            .hero h1 {
                font-size: 36px;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .stat-card h3 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <section class="hero">
        <div class="container">
            <h1>Where Influencers, Designers & Businesses Unite</h1>
            <p>The ultimate marketplace connecting influencers, designers, and business owners. Transform your brand
                with world-class talent.</p>
            <button class="cta-button">Get Started →</button>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card fade-up">
                    <h3>50K+</h3>
                    <p>Active Professionals</p>
                </div>
                <div class="stat-card fade-up">
                    <h3>100K+</h3>
                    <p>Projects Completed</p>
                </div>
                <div class="stat-card fade-up">
                    <h3>98%</h3>
                    <p>Client Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="fade-up">Why Choose Our Platform</h2>
            <div class="features-grid">
                <div class="feature-card fade-up">
                    <div class="feature-icon">★</div>
                    <h3>Verified Professionals</h3>
                    <p>Every influencer and designer is thoroughly vetted to ensure top-quality service</p>
                </div>
                <div class="feature-card fade-up">
                    <div class="feature-icon">⚡</div>
                    <h3>Quick Matching</h3>
                    <p>Find the perfect professional for your project in minutes</p>
                </div>
                <div class="feature-card fade-up">
                    <div class="feature-icon">👥</div>
                    <h3>Secure Collaboration</h3>
                    <p>Built-in tools for seamless communication and project management</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2 class="fade-up">Ready to Transform Your Business?</h2>
            <p class="fade-up">Join thousands of successful businesses who have found their perfect creative partners
            </p>
            <div class="cta-buttons fade-up">
                <button class="cta-button">Sign Up Now</button>
                <button class="secondary-button">Learn More</button>
            </div>
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <div class="container">
            <h2 class="fade-up">What Our Users Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card fade-up">
                    <div class="testimonial-content">
                        "Found an amazing designer within hours. The collaboration tools made the entire process
                        seamless."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">JD</div>
                        <div class="author-details">
                            <h4>John Doe</h4>
                            <p>Business Owner</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card fade-up">
                    <div class="testimonial-content">
                        "As an influencer, this platform has connected me with great brands that align with my values."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">SS</div>
                        <div class="author-details">
                            <h4>Sarah Smith</h4>
                            <p>Social Media Influencer</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card fade-up">
                    <div class="testimonial-content">
                        "The platform's rating system helps me showcase my work and build trust with clients."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">MJ</div>
                        <div class="author-details">
                            <h4>Mike Johnson</h4>
                            <p>Graphic Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <script>
        // Intersection Observer for fade-up animations
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

        // Observe all elements with fade-up class
        document.querySelectorAll('.fade-up').forEach((element) => {
            observer.observe(element);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
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

        // Button click handlers
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', () => {
                // Add your navigation logic here
                console.log('Button clicked:', button.textContent.trim());
            });
        });

        // Logo click handler
        document.querySelector('.logo').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>