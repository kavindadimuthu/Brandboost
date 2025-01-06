<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Faq - Brandboost
    </title>
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
            padding: 80px 20px 50px;
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
            padding: 0 1rem;
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

        .about-section p {
            font-size: 18px;
            padding: 0 20px;
            line-height: 1.8rem;
            color: #2e2e2e;
        }

        .about-section h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 40px;
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

        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-card,
        .testimonial-card,
        .stat-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover,
        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .stat-card,
        .testimonial-card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .testimonials {
            background: linear-gradient(to bottom, #f8f9fa, white);
        }

        .testimonial-card {
            padding: 40px;
            background: white;
        }

        .search-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .search-section h1 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .categories {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
        }

        .category-btn {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            background-color: #fff;
            color: #666;
            transition: all 0.3s;
        }

        .category-btn.active {
            background-color: #5b6bff;
            color: white;
        }

        .faq-list {
            max-width: 800px;
            margin: 0 auto;
            margin-bottom: 5rem;
        }

        .faq-item {
            background: white;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #333;
            font-weight: 500;
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            color: #666;
        }

        .faq-answer.active {
            padding: 0 1.5rem 1.5rem;
            max-height: 500px;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>
    <section class="hero">
        <img alt="Illustration of collaboration among influencers, designers, and business owners" height="600"
            src="https://storage.googleapis.com/a1aa/image/WvoCXvuz4JqFDZ7he3vIM6UQqzerPLbQmeRw0Tv3Ooa598AoA.jpg"
            width="1200" />
        <div class="container">
            <h1>
                How can we help?
            </h1>
            <p>
                Got Questions? We’ve Got Answers! Check out our FAQ section to learn more about Brandboost.
            </p>
            <div class="search-section">
                <div class="search-box">
                    <span class="search-icon">🔍</span>
                    <input type="text" class="search-input" placeholder="Type your keyword" id="searchInput">
                </div>
            </div>
        </div>
    </section>
    <div class="container">

        <div class="categories">
            <button class="category-btn active" data-category="general">General</button>
            <button class="category-btn" data-category="companies">Companies</button>
            <button class="category-btn" data-category="pricing">Pricing</button>
            <button class="category-btn" data-category="product">Product</button>
        </div>

        <div class="faq-list">
            <!-- FAQ items will be populated by JavaScript -->
        </div>
    </div>
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
    <script>
        // Sample FAQ data - in a real application, this would come from a database
        const faqData = {
            general: [
                {
                    question: "What is Brandboost?",
                    answer: "Brandboost is a comprehensive marketing platform that helps businesses grow their online presence."
                },
                {
                    question: "How do I get started?",
                    answer: "Sign up for an account, complete your profile, and our team will guide you through the setup process."
                },
                {
                    question: "Is Brandboost suitable for small businesses?",
                    answer: "Absolutely! Brandboost offers tools and resources tailored to businesses of all sizes."
                },
                {
                    question: "Does Brandboost offer customer support?",
                    answer: "Yes, we provide 24/7 customer support through chat, email, and phone."
                }
            ],
            companies: [
                {
                    question: "Can I use Brandboost for multiple companies?",
                    answer: "Yes, our platform supports multiple company profiles under a single account."
                },
                {
                    question: "Is there a limit to the number of users per company?",
                    answer: "No, you can add as many team members as needed to collaborate effectively."
                }
            ],
            pricing: [
                {
                    question: "What are your pricing plans?",
                    answer: "We offer flexible pricing plans starting from $29/month. Contact us for custom enterprise solutions."
                },
                {
                    question: "Do you offer a free trial?",
                    answer: "Yes, we offer a 14-day free trial with access to all features."
                },
                {
                    question: "Are there any discounts available?",
                    answer: "We offer discounts for annual subscriptions and non-profits. Contact us for details."
                },
                {
                    question: "What payment methods do you accept?",
                    answer: "We accept major credit cards, PayPal, and bank transfers for enterprise customers."
                }
            ],
            product: [
                {
                    question: "What features are included?",
                    answer: "Our platform includes social media management, analytics, content creation tools, and more."
                },
                {
                    question: "Can I integrate other tools with Brandboost?",
                    answer: "Yes, Brandboost integrates with popular tools like Google Analytics, Slack, and HubSpot."
                },
                {
                    question: "Is there a mobile app available?",
                    answer: "Yes, our mobile app is available for both iOS and Android devices."
                },
                {
                    question: "Can I customize the features for my needs?",
                    answer: "Yes, our platform is highly customizable to suit your specific business requirements."
                }
            ],
            security: [
                {
                    question: "Is my data secure on Brandboost?",
                    answer: "We use industry-standard encryption and follow strict security protocols to protect your data."
                },
                {
                    question: "Do you comply with GDPR regulations?",
                    answer: "Yes, Brandboost is fully compliant with GDPR and other global data protection standards."
                }
            ]
        };

        // Function to populate FAQ items
        function populateFAQs(category) {
            const faqList = document.querySelector('.faq-list');
            faqList.innerHTML = '';

            faqData[category].forEach(faq => {
                const faqItem = document.createElement('div');
                faqItem.className = 'faq-item';
                faqItem.innerHTML = `
                    <div class="faq-question">
                        ${faq.question}
                        <span class="toggle">▼</span>
                    </div>
                    <div class="faq-answer">
                        ${faq.answer}
                    </div>
                `;
                faqList.appendChild(faqItem);
            });
        }

        // Initialize with general category
        populateFAQs('general');

        // Category switching
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                populateFAQs(btn.dataset.category);
            });
        });

        // FAQ toggle
        document.addEventListener('click', (e) => {
            if (e.target.closest('.faq-question')) {
                const answer = e.target.closest('.faq-item').querySelector('.faq-answer');
                answer.classList.toggle('active');
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', (e) => {
            const searchText = e.target.value.toLowerCase();
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question').textContent.toLowerCase();
                const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

                if (question.includes(searchText) || answer.includes(searchText)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>