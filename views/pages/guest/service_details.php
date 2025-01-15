<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Gig Details Page</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    :root {
      --primary-color: #6366f1;
      --secondary-color: #4f46e5;
      --text-color: #333;
      --light-gray: #f5f5f5;
      --border-color: #e5e7eb;
      --card-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      line-height: 1.6;
      color: var(--text-color);
      background-color: var(--light-gray);
    }

    /* Breadcrumb Styles */
    .breadcrumb {
      /* padding: 2rem; */
      padding: 2rem 2rem 0;
    }

    .breadcrumb ul {
      display: flex;
      list-style: none;
      gap: 0.5rem;
      align-items: center;
    }

    .breadcrumb li:not(:last-child)::after {
      content: "/";
      margin-left: 0.5rem;
      color: #666;
    }

    .breadcrumb a {
      color: var(--primary-color);
      text-decoration: none;
    }

    .breadcrumb i {
      font-size: 0.9rem;
    }

    /* Main Layout */
    .page-container {
      max-width: 1400px;
      margin: 2rem auto;
      padding: 0 2rem;
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 2rem;
    }

    /* Gig Content Container */
    .gig-content {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
    }

    /* Gig Header */
    .gig-header {
      padding: 1rem 2rem 2rem;
      border-bottom: 1px solid var(--border-color);
    }

    .gig-title {
      font-size: 1.75rem;
      margin-bottom: 1.5rem;
    }

    .seller-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .seller-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
    }

    .seller-details {
      display: flex;
      flex-direction: column;
    }

    .seller-name {
      font-weight: 600;
      color: var(--primary-color);
    }

    .rating {
      color: #fbbf24;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    /* Media Preview */
    .media-preview {
      position: relative;
      padding: 1rem 0;
      max-width: 850px;
      margin: 0 auto;
    }

    .preview-container {
      position: relative;
      border-radius: 8px;
      overflow: hidden;
      padding-top: 56.25%;
      background: #f5f5f5;
    }

    .preview-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      background: #f5f5f5;
    }

    .nav-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.9);
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .prev-button {
      left: 1rem;
    }

    .next-button {
      right: 1rem;
    }

    .thumbnails {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 1rem;
      margin-top: 1rem;
      max-width: 850px;
    }

    .thumbnail {
      width: 100%;
      height: 100%;
      max-height: 100px;
      object-fit: cover;
      border-radius: 4px;
      cursor: pointer;
      opacity: 0.8;
      transition: opacity 0.3s;
    }

    .thumbnail:hover {
      opacity: 0.8;
    }

    /* About Section */
    .about-section {
      padding: 2rem;
      border-top: 1px solid var(--border-color);
    }

    .section-title {
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .about-content {
      color: #666;
      line-height: 1.8;
    }

    /* Delivery Formats */
    .delivery-formats {
      padding: 2rem;
      border-top: 1px solid var(--border-color);
    }

    .format-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 1rem;
    }

    .format-card {
      background: var(--light-gray);
      padding: 1rem;
      border-radius: 8px;
      text-align: center;
      font-weight: 500;
    }

    /* Reviews Section */
    .reviews-section {
      padding: 2rem;
      border-top: 1px solid var(--border-color);
    }

    .ratings-breakdown {
      background: var(--light-gray);
      padding: 1.5rem;
      border-radius: 8px;
      margin-bottom: 2rem;
    }

    .rating-bars {
      display: grid;
      grid-template-columns: auto 1fr auto;
      gap: 1rem;
      align-items: center;
      margin-bottom: 0.5rem;
    }

    .rating-bar {
      height: 8px;
      background: #e5e7eb;
      border-radius: 4px;
      overflow: hidden;
    }

    .rating-fill {
      height: 100%;
      background: var(--primary-color);
    }

    .reviews-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }


    .review-card {
      padding: 1.5rem 1rem;
      border: 0.5px solid var(--border-color);
      border-radius: 12px;
      box-shadow: var(--card-shadow);
    }

    .review-header {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .reviewer-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    /* Tags Section */
    .tags-section {
      padding: 2rem;
      border-top: 1px solid var(--border-color);
    }

    .tags-container {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .tag {
      background: var(--light-gray);
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.875rem;
      color: #666;
    }

    /* Pricing Card */
    .pricing-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      position: sticky;
      top: 2rem;
      height: fit-content;
    }

    .tabs {
      display: flex;
      border-bottom: 1px solid var(--border-color);
    }

    .tab {
      flex: 1;
      padding: 1rem;
      text-align: center;
      cursor: pointer;
      font-weight: 600;
      color: #666;
      transition: all 0.3s;
    }

    .tab.active {
      color: var(--primary-color);
      background: #f8f8ff;
    }

    .pricing-content {
      padding: 1.5rem;
    }

    .time-info {
      display: flex;
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .time-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #666;
    }

    .features-list {
      margin: 1.5rem 0;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.75rem;
    }

    .price {
      font-size: 2rem;
      font-weight: 600;
      text-align: center;
      margin: 1.5rem 0;
    }

    .order-button {
      width: 100%;
      padding: 1rem;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s;
    }

    .order-button:hover {
      background: var(--secondary-color);
    }

    .contact-button {
      width: 100%;
      margin-top: 1rem;
      padding: 1rem;
      background: var(--light-gray);
      color: var(--primary-color);
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s;
    }

    .contact-button:hover {
      background: #e5e7eb;
    }

    @media (max-width: 1024px) {
      .page-container {
        grid-template-columns: 1fr;
      }

      .pricing-card {
        position: static;
      }
    }

    @media (max-width: 768px) {
      .media-preview {
        padding: 1rem;
      }

      .thumbnails {
        grid-template-columns: repeat(3, 1fr);
      }
    }
  </style>
</head>

<body>
  <div class="page-container">
    <!-- Main Content -->
    <div class="gig-content">
      <!-- Add breadcrumb here -->
      <nav class="breadcrumb"></nav>

      <!-- Gig Header -->
      <div class="gig-header">
        <h1 class="gig-title"></h1>
        <div class="seller-info">
          <img class="seller-avatar">
          <div class="seller-details">
            <span class="seller-name"></span>
            <div class="rating">
              <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
              </div>
              <span></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Media Preview -->
      <div class="media-preview">
        <div class="preview-container">
          <img class="preview-image">
          <button class="nav-button prev-button">
            <i class="fas fa-chevron-left"></i>
          </button>
          <button class="nav-button next-button">
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
        <div class="thumbnails"></div>
      </div>

      <!-- About Section -->
      <div class="about-section">
        <h2 class="section-title">About This Gig</h2>
        <div class="about-content"></div>
      </div>

      <!-- Delivery Formats -->
      <div class="delivery-formats">
        <h2 class="section-title">Platforms</h2>
        <div class="format-grid"></div>
      </div>

      <!-- Reviews Section -->
      <div class="reviews-section">
        <h2 class="section-title">Reviews</h2>
        <div class="ratings-breakdown">
          <div class="rating-bars">
            <span>5 stars</span>
            <div class="rating-bar">
              <div class="rating-fill"></div>
            </div>
            <span></span>
          </div>
          <div class="rating-bars">
            <span>4 stars</span>
            <div class="rating-bar">
              <div class="rating-fill"></div>
            </div>
            <span></span>
          </div>
          <div class="rating-bars">
            <span>3 stars</span>
            <div class="rating-bar">
              <div class="rating-fill"></div>
            </div>
            <span></span>
          </div>
        </div>
        <div class="reviews-list"></div>
      </div>

      <!-- Tags Section -->
      <div class="tags-section">
        <h2 class="section-title">Related Tags</h2>
        <div class="tags-container"></div>
      </div>
    </div>

    <!-- Pricing Card -->
    <div class="pricing-card">
      <div class="tabs">
        <div class="tab active" onclick="switchTab('standard')">Standard</div>
        <div class="tab" onclick="switchTab('premium')">Premium</div>
      </div>
      <div class="pricing-content" id="pricing-content"></div>
    </div>
  </div>

  <script>
    let gigData;

    document.addEventListener('DOMContentLoaded', async () => {
      try {
        // Get the gig ID from the URL path
        const pathSegments = window.location.pathname.split('/');
        const gigId = pathSegments[pathSegments.length - 1]; // Get the last segment

        if (!gigId) {
          throw new Error('Gig ID is required in the URL');
        }

        const response = await fetch(`/api/gig/${gigId}?service=true&packages=true`);
        const result = await response.json();


        console.log(result.data.service.service_type);

        console.log(result);

        if (!result.success) {
          throw new Error('Failed to fetch gig data');
        }

        const serviceType = result.data.service.service_type.charAt(0).toUpperCase() + result.data.service.service_type.slice(1) + 's';

        // Assign the complete structure to gigData before using it
        gigData = {
          breadcrumb: {
            categories: ["Services", serviceType] // Static categories for now
          },
          gig: {
            title: result.data.service.title,
            seller: {
              name: "Designer Name",
              avatar: "https://images.unsplash.com/photo-1560250097-0b93528c311a?w=48&h=48&fit=crop",
              rating: 4.8,
              reviewCount: "2k+"
            },
            media: {
              images: [`/${result.data.service.cover_image}`, ...result.data.service.media.map(path => `/${path}`)],
              thumbnails: [`/${result.data.service.cover_image}`, ...result.data.service.media.map(path => `/${path}`)]
            },
            about: {
              description: result.data.service.description,
              features: ["Wide Reach", "Platform Diversity", "Creative Strategies", "Service Guarantee"]
            },
            platforms: Array.isArray(result.data.service.platforms)
              ? result.data.service.platforms
              : JSON.parse(result.data.service.platforms || '[]'),
            reviews: {
              ratings: {
                "5": 80,
                "4": 15,
                "3": 5
              },
              list: [
                {
                  name: "Emma L.",
                  avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=40&h=40&fit=crop",
                  rating: 5,
                  text: "Amazing experience! The campaign brought in so much traffic to my site."
                }
              ]
            },
            tags: Array.isArray(result.data.service.tags)
              ? result.data.service.tags
              : JSON.parse(result.data.service.tags || '[]'),
            pricing: {
              standard: {
                duration: `${result.data.packages[0].delivery_days} days`,
                revisions: `${result.data.packages[0].revisions} revisions`,
                features: result.data.packages[0].benefits.split(','),
                price: `LKR ${result.data.packages[0].price}`
              },
              premium: {
                duration: `${result.data.packages[1].delivery_days} days`,
                revisions: `${result.data.packages[1].revisions} revisions`,
                features: result.data.packages[1].benefits.split(','),
                price: `LKR ${result.data.packages[1].price}`
              }
            }
          }
        };

        // Only call render functions after gigData is fully populated
        renderBreadcrumb();
        renderGigHeader();
        renderMediaPreview();
        renderAboutSection();
        renderPlatforms();
        renderReviews();
        renderTags();
        renderPricingContent('standard');

        // Image navigation functionality
        const thumbnails = document.querySelectorAll('.thumbnail');
        const previewImage = document.querySelector('.preview-image');
        let currentImageIndex = 0;

        thumbnails.forEach((thumbnail, index) => {
          thumbnail.addEventListener('click', () => {
            previewImage.src = gigData.gig.media.images[index];
            currentImageIndex = index;
          });
        });

        document.querySelector('.prev-button').addEventListener('click', () => {
          currentImageIndex = (currentImageIndex - 1 + thumbnails.length) % thumbnails.length;
          previewImage.src = gigData.gig.media.images[currentImageIndex];
        });

        document.querySelector('.next-button').addEventListener('click', () => {
          currentImageIndex = (currentImageIndex + 1) % thumbnails.length;
          previewImage.src = gigData.gig.media.images[currentImageIndex];
        });

      } catch (error) {
        console.error('Error fetching gig data:', error);
      }
    });

    function renderBreadcrumb() {
      const breadcrumbHtml = `
                <ul>
                    <li><a href="/"><i class="fas fa-home"></i></a></li>
                    ${gigData.breadcrumb.categories.map(category =>
        `<li><a href="#">${category}</a></li>`
      ).join('')}
                </ul>
            `;
      document.querySelector('.breadcrumb').innerHTML = breadcrumbHtml;
    }

    function renderGigHeader() {
      const { title, seller } = gigData.gig;
      document.querySelector('.gig-title').textContent = title;
      document.querySelector('.seller-avatar').src = seller.avatar;
      document.querySelector('.seller-name').textContent = seller.name;
      document.querySelector('.rating span').textContent = `${seller.rating} (${seller.reviewCount} Reviews)`;
    }

    function renderMediaPreview() {
      const { images, thumbnails } = gigData.gig.media;
      document.querySelector('.preview-image').src = images[0];

      const thumbnailsHtml = thumbnails.map((thumb, index) => `
                <img src="${thumb}" alt="Preview ${index + 1}" class="thumbnail">
            `).join('');
      document.querySelector('.thumbnails').innerHTML = thumbnailsHtml;
    }

    function renderAboutSection() {
      const { description, features } = gigData.gig.about;
      const aboutHtml = `
                <p>${description}</p>
                
            `;
      document.querySelector('.about-content').innerHTML = aboutHtml;
    }

    function renderPlatforms() {
      const platformsHtml = gigData.gig.platforms.map(platform =>
        `<div class="format-card">${platform}</div>`
      ).join('');
      document.querySelector('.format-grid').innerHTML = platformsHtml;
    }

    function renderReviews() {
      const { ratings, list } = gigData.gig.reviews;

      // Render ratings breakdown
      Object.entries(ratings).reverse().forEach(([stars, percentage]) => {
        const ratingBar = document.querySelector(`.rating-bars:nth-child(${6 - stars})`);
        ratingBar.querySelector('.rating-fill').style.width = `${percentage}%`;
        ratingBar.querySelector('span:last-child').textContent = `${percentage}%`;
      });

      // Render review list
      const reviewsHtml = list.map(review => `
                <div class="review-card">
                    <div class="review-header">
                        <img src="${review.avatar}" alt="${review.name}" class="reviewer-avatar">
                        <div>
                            <div class="reviewer-name">${review.name}</div>
                            <div class="rating">
                                ${Array(Math.floor(review.rating)).fill('<i class="fas fa-star"></i>').join('')}
                                ${review.rating % 1 ? '<i class="fas fa-star-half-alt"></i>' : ''}
                            </div>
                        </div>
                    </div>
                    <div class="review-text">${review.text}</div>
                </div>
            `).join('');
      document.querySelector('.reviews-list').innerHTML = reviewsHtml;
    }

    function renderTags() {
      const tagsHtml = gigData.gig.tags.map(tag =>
        `<span class="tag">${tag}</span>`
      ).join('');
      document.querySelector('.tags-container').innerHTML = tagsHtml;
    }

    function renderPricingContent(plan) {
      const data = gigData.gig.pricing[plan];
      const content = `
                <div class="time-info">
                    <div class="time-item">
                        <i class="far fa-clock"></i>
                        ${data.duration}
                    </div>
                    <div class="time-item">
                        <i class="fas fa-sync-alt"></i>
                        ${data.revisions}
                    </div>
                </div>
                <div class="features-list">
                    ${data.features.map(feature => `
                        <div class="feature-item">
                            <i class="fas fa-check" style="color: var(--primary-color)"></i>
                            ${feature}
                        </div>
                    `).join('')}
                </div>
                <div class="price">${data.price}</div>
                <button class="order-button">Order Now</button>
                <button class="contact-button">Contact Seller</button>
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
  </script>
</body>

</html>