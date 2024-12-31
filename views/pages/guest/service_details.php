<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>UI Layout with Flexbox</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    /* Main Service Section */
    .main-service {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .service-header {
      margin-bottom: 20px;
    }

    .service-header h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .rating {
      color: #ffb33e;
    }

    .rating-text {
      color: #666;
      margin-left: 10px;
    }

    .main-image {
      width: 100%;
      margin-bottom: 20px;
    }

    .main-image img {
      width: 100%;
      height: auto;
      border-radius: 4px;
    }

    .thumbnail-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 10px;
      margin-bottom: 20px;
    }

    .thumbnail {
      width: 100%;
      aspect-ratio: 1;
      object-fit: cover;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Categories Section */
    .categories-section {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .categories-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 15px;
      margin-top: 15px;
    }

    .category-card {
      padding: 10px;
      background: #e1e2e3;
      border-radius: 20px;
      text-align: center;
    }

    /* About Section */
    .about-section {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .about-content {
      margin-top: 15px;
    }

    /* Delivery Section */
    .delivery-section {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .delivery-formats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 15px;
      margin-top: 15px;
    }

    .format-card {
      padding: 10px;
      background: #e1e2e3;
      border-radius: 20px;
      text-align: center;
    }

    /* Reviews Section */
    .reviews-section {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .review-card {
      border-bottom: 1px solid #eee;
      padding: 15px 0;
    }

    .review-header {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .reviewer-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .reviewer-name {
      font-weight: bold;
    }

    .outer-container {
      display: flex;
      flex-direction: column;
      height: 100%;
      width: 100%;
    }

    .main-content {
      display: flex;
      flex-grow: 1;
      height: auto;
      margin: 20px;
      flex-direction: column;
    }

    .main {
      flex-grow: 1;
    }

    .sidebar {
      width: 100%;
      flex-shrink: 0;
      margin-top: 20px;
    }

    .pricing-card {
      width: 100%;
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    .tabs {
      display: flex;
      font-weight: 600;
      border-bottom: 1px solid #eee;
    }

    .tab {
      flex: 1;
      padding: 15px;
      text-align: center;
      cursor: pointer;
      color: #666;
      transition: all 0.3s ease;
    }

    .tab.active {
      color: #6366f1;
      background-color: #f8f8ff;
    }

    .content {
      padding: 24px;
    }

    .features {
      margin: 24px 0;
    }

    .time-info {
      display: flex;
      gap: 20px;
      margin-bottom: 24px;
      flex-direction: column;
    }

    .time-item {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #666;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 16px;
      color: #333;
    }

    .check-icon {
      color: #6366f1;
    }

    .price {
      font-size: 32px;
      font-weight: 600;
      text-align: center;
      margin: 24px 0;
    }

    .order-button {
      width: 100%;
      padding: 12px;
      background-color: #6366f1;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .order-button:hover {
      background-color: #4f46e5;
    }

    .contact-button {
      margin-top: 16px;
      width: 100%;
      padding: 12px;
      background-color: #ecf0f1;
      color: #6366f1;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .contact-button:hover {
      background-color: #bdc3c2;
    }

    @media (min-width: 768px) {
      .main-content {
        flex-direction: row;
      }

      .sidebar {
        width: 370px;
      }

      .thumbnail-grid {
        grid-template-columns: repeat(5, 1fr);
      }

      .time-info {
        flex-direction: row;
      }
    }
  </style>
</head>
<body>
  <div class="outer-container">
    <div class="main-content">
      <div class="main">
        <div class="container">
          <!-- Main Service Image -->
          <div class="main-service">
            <div class="service-header">
              <h1>Our Agency Will Boost Your Brand's Visibility with Targeted Influencer Campaigns</h1>
              <div class="rating">
                <span class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </span>
                <span class="rating-text">4.8 (2k+ Reviews)</span>
              </div>
            </div>
            <div class="main-image">
                <img src="https://fiverr-res.cloudinary.com/videos/so_58.345428,t_main1,q_auto,f_auto/lokyruezin7kdrtxkxx1/create-business-commercial-video-or-social-media-video-ad.png">
                <!-- <img alt="A professional business commercial video or social media video ad" height="800" src="https://storage.googleapis.com/a1aa/image/N5GoaqOFR0oaHZFEDTdbLfcQfoKf90HagrncrOlcKM1IGVfPB.jpg" width="1200"/> -->
            </div>
            <div class="thumbnail-grid" id="thumbnailGrid">
              <img alt="Thumbnail 1" class="thumbnail" height="200" src="https://storage.googleapis.com/a1aa/image/MyQmLiVrKmJ7EVIC6FvRdBFpiMiuo1D6XYDrtAXHkCnxo6fJA.jpg" width="200"/>
              <img alt="Thumbnail 2" class="thumbnail" height="200" src="https://storage.googleapis.com/a1aa/image/y199g5SqLLoJF5ECVl1AQHyAXYjUrvtab3t0jafHguimR1fTA.jpg" width="200"/>
              <img alt="Thumbnail 3" class="thumbnail" height="200" src="https://storage.googleapis.com/a1aa/image/JvGI4E8zWO4lC5S0DyfoPyqPL3fqAN46w1ntpWuftUIiGVfPB.jpg" width="200"/>
              <img alt="Thumbnail 4" class="thumbnail" height="200" src="https://storage.googleapis.com/a1aa/image/fvZb9PeqtRtKLEgn7q57tdUFTa3HJixmOOuJJSqOMR0IjqfnA.jpg" width="200"/>
              <img alt="Thumbnail 5" class="thumbnail" height="200" src="https://storage.googleapis.com/a1aa/image/ocA01MPxQQbxGZ3eg3Jjks6e0FfQPunp3gq7ThL4bH1fMqefE.jpg" width="200"/>
            </div>
          </div>
          <!-- Categories Section -->
          <div class="categories-section">
            <h2>Categories</h2>
            <div class="categories-grid" id="categoriesGrid">
              <div class="category-card">Instagram Promotions</div>
              <div class="category-card">YouTube Promotions</div>
              <div class="category-card">Facebook Ads</div>
              <div class="category-card">TikTok Campaigns</div>
              <div class="category-card">Twitter Promotions</div>
            </div>
          </div>
          <!-- About Section -->
          <div class="about-section">
            <h2>About this gig</h2>
            <div class="about-content" id="aboutContent">
              <p>Maximize your brand's reach with targeted influencer promotions. Connect with audiences through engaging and impactful campaigns.</p>
              <ul>
                <li>Wide Reach: Gain visibility with millions of followers</li>
                <li>Platform Diversity: Promote across multiple platforms</li>
                <li>Creative Strategies: Tailored campaigns for your audience</li>
                <li>Service Guarantee: 100% satisfaction or money back</li>
              </ul>
            </div>
          </div>
          <!-- Delivering Formats -->
          <div class="delivery-section">
            <h2>Platforms</h2>
            <div class="delivery-formats" id="deliveryFormats">
              <div class="format-card">Instagram</div>
              <div class="format-card">YouTube</div>
              <div class="format-card">Facebook</div>
              <div class="format-card">TikTok</div>
              <div class="format-card">Twitter</div>
            </div>
          </div>
          <!-- Reviews Section -->
          <div class="reviews-section">
            <h2>Reviews</h2>
            <div class="reviews-container" id="reviewsContainer">
              <div class="review-card">
                <div class="review-header">
                  <img alt="Reviewer Emma L." class="reviewer-avatar" height="100" src="https://storage.googleapis.com/a1aa/image/znYRxSozIoYxMJZqdfLimb0I3JNp2vsIwclyyxd7CAdlR1fTA.jpg" width="100"/>
                  <div>
                    <div class="reviewer-name">Emma L.</div>
                    <div class="rating">★★★★★</div>
                  </div>
                </div>
                <div class="review-comment">Amazing experience! The campaign brought in so much traffic to my site.</div>
              </div>
              <div class="review-card">
                <div class="review-header">
                  <img alt="Reviewer David R." class="reviewer-avatar" height="100" src="https://storage.googleapis.com/a1aa/image/6abcUz2T5eSeMEePFWSKNyTffQtOMdi5CrMfGnpCMRefMjqfnA.jpg" width="100"/>
                  <div>
                    <div class="reviewer-name">David R.</div>
                    <div class="rating">★★★★½</div>
                  </div>
                </div>
                <div class="review-comment">Highly professional service and great ROI. Will work again.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="sidebar">
        <div class="pricing-card">
          <div class="tabs">
            <div class="tab active" onclick="switchTab('standard')">Standard</div>
            <div class="tab" onclick="switchTab('premium')">Premium</div>
          </div>
          <div class="content" id="pricing-content"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const pricingData = {
      standard: {
        duration: "2 months",
        revisions: "2 revisions",
        features: [
          "Files Ready for Print",
          "Custom Designs",
          "Quality Graphics",
          "Modern and Trendy Styles"
        ],
        price: "LKR 5 000"
      },
      premium: {
        duration: "3 months",
        revisions: "5 revisions",
        features: [
          "Files Ready for Print",
          "Premium Support",
          "Priority Delivery",
          "Advanced Features",
          "Custom Branding"
        ],
        price: "LKR 10 000"
      }
    };

    function renderPricingContent(plan) {
      const data = pricingData[plan];
      const content = `
        <div class="time-info">
          <div class="time-item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <path d="M12 6v6l4 2"/>
            </svg>
            ${data.duration}
          </div>
          <div class="time-item">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
            </svg>
            ${data.revisions}
          </div>
        </div>
        <div class="features">
          ${data.features.map(feature => `
            <div class="feature-item">
              <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"/>
              </svg>
              ${feature}
            </div>
          `).join('')}
        </div>
        <div class="price">${data.price}</div>
        <a href="/businessman/place-order">
          <button class="order-button">Order Now</button>
        </a>
        <a href="http://localhost:8000/homecontroller/chat">
          <button class="contact-button">Contact</button>
        </a>
      `;

      document.getElementById('pricing-content').innerHTML = content;
    }

    function switchTab(plan) {
      document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
      });
      document.querySelector(`.tab:${plan === 'premium' ? 'last-child' : 'first-child'}`).classList.add('active');
      renderPricingContent(plan);
    }

    renderPricingContent('standard');
  </script>
</body>
</html>