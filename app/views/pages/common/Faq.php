<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #f5f7ff;
        }

        

        .navbar {
            background-color: #5b6bff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        } */

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
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

        .contact-section {
            background-color: #5b6bff;
            border-radius: 12px;
            padding: 2rem;
            margin-top: 3rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contact-text {
            flex: 1;
        }

        .contact-text h2 {
            margin-bottom: 1rem;
        }

        .contact-btn {
            background-color: #ff5b8d;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .contact-btn:hover {
            background-color: #ff4077;
        }

    </style>
    <link rel="stylesheet" href="../../styles/common/index.css">
    <link rel="stylesheet" href="../../styles/common/footer.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">Brandboost</div>
        <div class="nav-links">
            <a href="#">Services</a>
            <a href="#">About us</a>
            <a href="#">Contact us</a>
            <a href="#">FAQs</a>
            <a href="#">Careers</a>
        </div>
    </nav>

    <div class="container">
        <div class="search-section">
            <h1>How can we help?</h1>
            <div class="search-box">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" placeholder="Type your keyword" id="searchInput">
            </div>
        </div>

        <div class="categories">
            <button class="category-btn active" data-category="general">General</button>
            <button class="category-btn" data-category="companies">Companies</button>
            <button class="category-btn" data-category="pricing">Pricing</button>
            <button class="category-btn" data-category="product">Product</button>
        </div>

        <div class="faq-list">
            <!-- FAQ items will be populated by JavaScript -->
        </div>

        <div class="contact-section">
            <div class="contact-text">
                <h2>Can't find your answer?</h2>
                <p>We're here to help! Contact our support team for assistance.</p>
            </div>
            <button class="contact-btn" onclick="window.location.href='/homecontroller/contact'">Contact Us</button>
        </div>
    </div>

    <?php include __DIR__ . '/../../components/common/footer.php'; ?>

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
                }
            ],
            companies: [
                {
                    question: "Can I use Brandboost for multiple companies?",
                    answer: "Yes, our platform supports multiple company profiles under a single account."
                }
            ],
            pricing: [
                {
                    question: "What are your pricing plans?",
                    answer: "We offer flexible pricing plans starting from $29/month. Contact us for custom enterprise solutions."
                }
            ],
            product: [
                {
                    question: "What features are included?",
                    answer: "Our platform includes social media management, analytics, content creation tools, and more."
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