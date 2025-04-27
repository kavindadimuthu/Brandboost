<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Service Details | Brandboost</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    :root {
      --primary-color:rgb(103, 68, 241);
      --primary-hover:rgb(70, 58, 204);
      --secondary-color: #6c757d;
      --text-color: #333;
      --text-light: #6c757d;
      --light-gray: #f8f9fa;
      --medium-gray: #e9ecef;
      --border-color: #dee2e6;
      --card-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      --card-hover-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      --success-color: #10b981;
      --warning-color: #f59e0b;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      line-height: 1.6;
      color: var(--text-color);
      background-color: var(--light-gray);
    }

    /* Breadcrumb Styles */
    .breadcrumb {
      padding: 1.5rem 2rem 0;
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
      color: var(--secondary-color);
    }

    .breadcrumb a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s;
    }

    .breadcrumb a:hover {
      color: var(--primary-hover);
    }

    .breadcrumb i {
      font-size: 0.9rem;
    }

    /* Main Layout */
    .page-container {
      max-width: 1400px;
      margin: 1.5rem auto 3rem;
      padding: 0 2rem;
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 2rem;
    }

    /* Gig Content Container */
    .gig-content {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      transition: box-shadow 0.3s;
    }

    .gig-content:hover {
      box-shadow: var(--card-hover-shadow);
    }

    /* Gig Header */
    .gig-header {
      padding: 2rem 2.5rem;
      border-bottom: 1px solid var(--border-color);
    }

    .gig-title {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #2d3748;
      line-height: 1.3;
    }

    .seller-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .seller-avatar {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--primary-color);
    }

    .seller-details {
      display: flex;
      flex-direction: column;
    }

    .seller-name {
      font-weight: 600;
      font-size: 1.125rem;
      color: var(--primary-color);
      margin-bottom: 0.25rem;
    }

    .rating {
      color: #f59e0b;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.95rem;
    }

    /* Media Preview */
    .media-preview {
      position: relative;
      padding: 2rem;
      max-width: 900px;
      margin: 0 auto;
    }

    .preview-container {
      position: relative;
      border-radius: 12px;
      overflow: hidden;
      padding-top: 56.25%;
      background: #f5f5f5;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .preview-image {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      background: #f5f5f5;
      transition: transform 0.3s ease;
    }

    .preview-container:hover .preview-image {
      transform: scale(1.02);
    }

    .nav-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: white;
      border: none;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      z-index: 2;
      transition: all 0.2s;
    }

    .nav-button:hover {
      background: var(--primary-color);
      color: white;
      transform: translateY(-50%) scale(1.05);
    }

    .prev-button {
      left: 1.5rem;
    }

    .next-button {
      right: 1.5rem;
    }

    .thumbnails {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 1rem;
      margin-top: 1.5rem;
      max-width: 900px;
    }

    .thumbnail {
      aspect-ratio: 16/9;
      width: 100%;
      object-fit: cover;
      border-radius: 8px;
      cursor: pointer;
      border: 2px solid transparent;
      transition: all 0.2s;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .thumbnail:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-color: var(--primary-color);
    }

    .thumbnail.active {
      border-color: var(--primary-color);
    }

    /* Content Sections */
    .content-section {
      padding: 2.5rem;
      border-top: 1px solid var(--border-color);
    }

    .section-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #2d3748;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .section-title i {
      color: var(--primary-color);
      font-size: 1.25rem;
    }

    .about-content {
      color: #4a5568;
      line-height: 1.8;
      font-size: 1.05rem;
    }

    /* Platforms Section */
    .platform-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .platform-card {
      background: var(--light-gray);
      padding: 0.75rem 1.25rem;
      border-radius: 8px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      transition: all 0.2s;
    }

    .platform-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      background: #eef2ff;
    }

    .platform-card i {
      color: var(--primary-color);
    }

    /* Reviews Section */
    .reviews-section {
      background: linear-gradient(to bottom, white, var(--light-gray) 15%, white 100%);
    }

    .ratings-overview {
      display: flex;
      align-items: center;
      gap: 2rem;
      margin-bottom: 2rem;
      padding: 1.5rem;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .ratings-average {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-right: 2rem;
      border-right: 1px solid var(--border-color);
    }

    .average-score {
      font-size: 3rem;
      font-weight: 700;
      color: var(--primary-color);
      line-height: 1;
    }

    .total-reviews {
      color: var(--text-light);
      margin-top: 0.5rem;
    }

    .ratings-breakdown {
      flex: 1;
    }

    .rating-bars {
      display: grid;
      grid-template-columns: auto 1fr auto;
      gap: 1rem;
      align-items: center;
      margin-bottom: 0.75rem;
    }

    .rating-label {
      display: flex;
      align-items: center;
      gap: 0.25rem;
      color: var(--text-light);
      width: 60px;
    }

    .rating-label i {
      color: #f59e0b;
    }

    .rating-bar {
      height: 8px;
      background: var(--medium-gray);
      border-radius: 4px;
      overflow: hidden;
    }

    .rating-fill {
      height: 100%;
      background: var(--primary-color);
    }

    .rating-count {
      color: var(--text-light);
      font-size: 0.9rem;
      width: 50px;
      text-align: right;
    }

    .reviews-list {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .review-card {
      padding: 1.5rem;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .review-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .review-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
    }

    .reviewer {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .reviewer-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
    }

    .reviewer-details {
      display: flex;
      flex-direction: column;
    }

    .reviewer-name {
      font-weight: 600;
      color: #2d3748;
    }

    .review-date {
      color: var(--text-light);
      font-size: 0.9rem;
    }

    .review-rating {
      color: #f59e0b;
      display: flex;
      gap: 0.25rem;
    }

    .review-content {
      color: #4a5568;
      line-height: 1.7;
    }

    /* Tags Section */
    .tags-container {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
    }

    .tag {
      background: var(--light-gray);
      padding: 0.6rem 1.2rem;
      border-radius: 40px;
      font-size: 0.9rem;
      color: var(--text-light);
      font-weight: 500;
      transition: all 0.2s;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .tag:hover {
      background: #eef2ff;
      color: var(--primary-color);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Pricing Card */
    .pricing-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      position: sticky;
      top: 2rem;
      height: fit-content;
      transition: box-shadow 0.3s;
    }

    .pricing-card:hover {
      box-shadow: var(--card-hover-shadow);
    }

    .tabs {
      display: flex;
      border-bottom: 1px solid var(--border-color);
    }

    .tab {
      flex: 1;
      padding: 1.25rem 1rem;
      text-align: center;
      cursor: pointer;
      font-weight: 600;
      color: var(--text-light);
      transition: all 0.3s;
      background: white;
      position: relative;
    }

    .tab.active {
      color: var(--primary-color);
      background: #f8faff;
    }

    .tab.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 3px;
      background: var(--primary-color);
    }

    .pricing-content {
      padding: 2rem;
    }

    .time-info {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      background: #f8faff;
      padding: 1rem;
      border-radius: 12px;
    }

    .time-item {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: var(--text-light);
      font-weight: 500;
    }

    .time-item i {
      color: var(--primary-color);
    }

    .features-list {
      margin: 1.5rem 0;
    }

    .feature-item {
      display: flex;
      align-items: flex-start;
      gap: 0.75rem;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid var(--medium-gray);
    }

    .feature-item:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .feature-icon {
      color: var(--success-color);
      margin-top: 0.25rem;
    }

    .feature-text {
      flex: 1;
      color: #4a5568;
    }

    .price {
      font-size: 2.25rem;
      font-weight: 700;
      text-align: center;
      margin: 2rem 0;
      color: #2d3748;
    }

    .action-button {
      width: 100%;
      padding: 1.25rem;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.75rem;
    }

    .primary-button {
      background: var(--primary-color);
      color: white;
    }

    .primary-button:hover {
      background: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(65, 105, 225, 0.3);
    }

    .secondary-button {
      background: var(--light-gray);
      color: var(--primary-color);
      margin-top: 1rem;
    }

    .secondary-button:hover {
      background: var(--medium-gray);
      transform: translateY(-2px);
    }

    .guarantee-text {
      margin-top: 1.5rem;
      text-align: center;
      color: var(--text-light);
      font-size: 0.9rem;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 0.5rem;
    }

    .guarantee-text i {
      color: var(--success-color);
    }

    /* Empty state for reviews */
    .empty-state {
      padding: 3rem 2rem;
      text-align: center;
      color: var(--text-light);
    }

    .empty-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      color: var(--border-color);
    }

    .empty-text {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .empty-subtext {
      font-size: 0.95rem;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
      .page-container {
        grid-template-columns: 1fr 340px;
      }
    }

    @media (max-width: 1024px) {
      .page-container {
        grid-template-columns: 1fr;
      }

      .pricing-card {
        position: static;
        margin-bottom: 2rem;
      }

      .page-container {
        display: flex;
        /* flex-direction: column-reverse; */
        flex-direction: column;
      }
    }

    @media (max-width: 768px) {
      .gig-header {
        padding: 1.5rem;
      }

      .gig-title {
        font-size: 1.75rem;
      }

      .content-section {
        padding: 1.5rem;
      }

      .media-preview {
        padding: 1rem;
      }

      .thumbnails {
        grid-template-columns: repeat(3, 1fr);
      }

      .ratings-overview {
        flex-direction: column;
        gap: 1.5rem;
        align-items: flex-start;
      }

      .ratings-average {
        border-right: none;
        border-bottom: 1px solid var(--border-color);
        padding-right: 0;
        padding-bottom: 1.5rem;
        width: 100%;
      }
    }

    @media (max-width: 480px) {
      .page-container {
        padding: 0 1rem;
      }

      .nav-button {
        width: 40px;
        height: 40px;
      }

      .prev-button {
        left: 0.5rem;
      }

      .next-button {
        right: 0.5rem;
      }

      .thumbnails {
        grid-template-columns: repeat(2, 1fr);
      }

      .time-info {
        flex-direction: column;
        gap: 1rem;
      }
    }
  </style>
</head>

<body>
  <div class="page-container">
    <!-- Main Content -->
    <div class="gig-content">
      <!-- Breadcrumb -->
      <nav class="breadcrumb"></nav>

      <!-- Gig Header -->
      <div class="gig-header">
        <h1 class="gig-title"></h1>
        <div class="seller-info">
          <img class="seller-avatar">
          <div class="seller-details">
            <span class="seller-name"></span>
            <div class="rating">
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
      <div class="content-section">
        <h2 class="section-title">
          <i class="fas fa-info-circle"></i>
          About This Service
        </h2>
        <div class="about-content"></div>
      </div>

      <!-- Platforms Section -->
      <div class="content-section">
        <h2 class="section-title">
          <i class="fas fa-share-alt"></i>
          Platforms
        </h2>
        <div class="platform-grid"></div>
      </div>

      <!-- Reviews Section -->
      <div class="content-section reviews-section">
        <h2 class="section-title">
          <i class="fas fa-star"></i>
          Reviews
        </h2>
        <div class="ratings-overview">
          <div class="ratings-average">
            <div class="average-score">4.8</div>
            <div class="total-reviews">from 68 reviews</div>
          </div>
          <div class="ratings-breakdown">
            <div class="rating-bars">
              <div class="rating-label" id="rating-label-1">
                5 <i class="fas fa-star"></i>
              </div>
              <div class="rating-bar">
                <div class="rating-fill" style="width: 80%"></div>
              </div>
              <div class="rating-count" id="rating-count-1">80%</div>
            </div>
            <div class="rating-bars">
              <div class="rating-label" id="rating-label-2">
                4 <i class="fas fa-star"></i>
              </div>
              <div class="rating-bar">
                <div class="rating-fill" style="width: 15%"></div>
              </div>
              <div class="rating-count" id="rating-count-2">15%</div>
            </div>
            <div class="rating-bars">
              <div class="rating-label" id="rating-label-3">
                3 <i class="fas fa-star"></i>
              </div>
              <div class="rating-bar">
                <div class="rating-fill" style="width: 5%"></div>
              </div>
              <div class="rating-count" id="rating-count-3">5%</div>
            </div>
          </div>
        </div>
        <div class="reviews-list">
          <!-- Reviews will be inserted here -->
        </div>
      </div>

      <!-- Tags Section -->
      <div class="content-section">
        <h2 class="section-title">
          <i class="fas fa-tags"></i>
          Related Tags
        </h2>
        <div class="tags-container"></div>
      </div>
    </div>
    <!-- Pricing Card (moved up for mobile) -->
    <div class="pricing-card">
      <div class="tabs">
        <div class="tab active" onclick="switchTab('standard')">Standard</div>
        <div class="tab" onclick="switchTab('premium')">Premium</div>
      </div>
      <div class="pricing-content" id="pricing-content"></div>
    </div>

  </div>

  <script>
        let currentPlan = 'standard';
    
    document.addEventListener('DOMContentLoaded', async () => {
      try {
        // Get the service ID from the URL path
        const pathSegments = window.location.pathname.split('/');
        const serviceID = pathSegments[pathSegments.length - 1]; // Get the last segment
    
        if (!serviceID) {
          throw new Error('Service ID is required in the URL');
        }
    
        const response = await fetch(`/api/service/${serviceID}?service=true&packages=true&include_user=true`);
        const result = await response.json();
        
        console.log(result);

        let total= result.reviews ? result.reviews.length : 0;

        var rating1 = 0;
        var rating2 = 0;
        var rating3 = 0;
        var rating4 = 0;
        var rating5 = 0;

        for (let i = 0; i < result.reviews.length; i++) {
          var rate = result.reviews[i].rating;

          if (rate == 1){
            rating1++;
          } else if (rate == 2){
            rating2++;
          } else if (rate == 3){
            rating3++;
          } else if (rate == 4){
            rating4++;
          } else if (rate == 5){
            rating5++;
          } else {
            continue;
          }
        }
        const totalrate = rating1 + rating2 + rating3 + rating4 + rating5;
        const rateave = (rating1*1 + rating2*2 + rating3*3 + rating4*4 + rating5*5)/totalrate;

        let rounded5 = parseFloat((rating5/totalrate*100).toFixed(1));
        let rounded4 = parseFloat((rating4/totalrate*100).toFixed(1));
        let rounded3 = parseFloat((rating3/totalrate*100).toFixed(1));

        const percentages = {
          distribution : {5: rounded5, 4: rounded4, 3: rounded3}, 
          rateave, 
          total
        };
    
        // Map platforms to icons for easier reference
        const platformIcons = {
          'facebook': 'fab fa-facebook',
          'instagram': 'fab fa-instagram',
          'twitter': 'fab fa-twitter',
          'linkedin': 'fab fa-linkedin',
          'youtube': 'fab fa-youtube',
          'tiktok': 'fab fa-tiktok',
          'pinterest': 'fab fa-pinterest'
        };
    
        // Render all UI components
        renderBreadcrumb(result);
        renderGigHeader(result, percentages);
        renderMediaPreview(result);
        renderAboutSection(result);
        renderPlatforms(result, platformIcons);
        renderReviewsSection(result, percentages);
        renderTags(result);
        renderPricingContent(currentPlan, result);
    
        // Set up image navigation
        setupImageNavigation(result);
    
      } catch (error) {
        console.error('Error fetching service data:', error);
        document.body.innerHTML = `
          <div style="text-align: center; padding: 3rem; color: #666;">
            <h2>We couldn't load this service</h2>
            <p>Please try again later or contact support.</p>
            <button onclick="window.location.href='/services'" style="margin-top: 1rem; padding: 0.75rem 1.5rem; background: #4169E1; color: white; border: none; border-radius: 8px; cursor: pointer;">
              See All Services
            </button>
          </div>
        `;
      }
    });
    
    function renderBreadcrumb(result) {
      const serviceType = result.service_type;
      const serviceTypeName = serviceType.charAt(0).toUpperCase() + serviceType.slice(1) + 's';
      
      const breadcrumbHtml = `
        <ul>
          <li><a href="/"><i class="fas fa-home"></i></a></li>
          <li><a href="/services">Services</a></li>
          <li><a href="/services">${serviceTypeName}</a></li>
        </ul>
      `;
      document.querySelector('.breadcrumb').innerHTML = breadcrumbHtml;
    }
    
    function renderGigHeader(result, percentages) {
      // Default review stats
      const reviewCount = result.reviews ? result.reviews.length : 0;
      const reviewRating = parseFloat(percentages.rateave.toFixed(1)); // Default or calculate based on reviews if available
      
      document.querySelector('.gig-title').textContent = result.title;
      document.querySelector('.seller-avatar').src = result.user.profile_picture || '/assets/images/default-avatar.png';
      document.querySelector('.seller-name').textContent = result.user.name;
      document.querySelector('.rating span').textContent = `${reviewRating} (${reviewCount} Reviews)`;
    }
    
    function renderMediaPreview(result) {
      const coverImage = result.cover_image;
      const mediaImages = result.media || [];
      
      // Set the main preview image
      const previewImage = document.querySelector('.preview-image');
      previewImage.src = coverImage;
      previewImage.alt = result.title;
    
      // Create all images array including cover
      const allImages = [coverImage, ...mediaImages];
    
      // Create thumbnail images
      const thumbnailsHtml = allImages.map((image, index) => `
        <img src="${image}" alt="Preview ${index + 1}" class="thumbnail ${index === 0 ? 'active' : ''}" data-index="${index}">
      `).join('');
      
      document.querySelector('.thumbnails').innerHTML = thumbnailsHtml;
    }
    
    function setupImageNavigation(result) {
      const thumbnails = document.querySelectorAll('.thumbnail');
      const previewImage = document.querySelector('.preview-image');
      let currentImageIndex = 0;
      
      const coverImage = result.cover_image;
      const mediaImages = result.media || [];
      const allImages = [coverImage, ...mediaImages];
    
      // Thumbnail click handler
      thumbnails.forEach((thumbnail, index) => {
        thumbnail.addEventListener('click', () => {
          previewImage.src = allImages[index];
          currentImageIndex = index;
          updateActiveThumbnail(index);
        });
      });
    
      // Previous button click handler
      document.querySelector('.prev-button').addEventListener('click', () => {
        currentImageIndex = (currentImageIndex - 1 + allImages.length) % allImages.length;
        previewImage.src = allImages[currentImageIndex];
        updateActiveThumbnail(currentImageIndex);
      });
    
      // Next button click handler
      document.querySelector('.next-button').addEventListener('click', () => {
        currentImageIndex = (currentImageIndex + 1) % allImages.length;
        previewImage.src = allImages[currentImageIndex];
        updateActiveThumbnail(currentImageIndex);
      });
    
      // Update active thumbnail styling
      function updateActiveThumbnail(activeIndex) {
        thumbnails.forEach((thumb, i) => {
          if (i === activeIndex) {
            thumb.classList.add('active');
          } else {
            thumb.classList.remove('active');
          }
        });
      }
    }
    
    function renderAboutSection(result) {
      const aboutHtml = `<p>${result.description}</p>`;
      document.querySelector('.about-content').innerHTML = aboutHtml;
    }
    
    function renderPlatforms(result, platformIcons) {
      let platforms = [];
      
      // Handle platforms depending on format returned
      if (result.platforms) {
        platforms = Array.isArray(result.platforms) 
          ? result.platforms 
          : JSON.parse(result.platforms || '[]');
      }
      
      if (!platforms || platforms.length === 0) {
        document.querySelector('.platform-grid').innerHTML = `
          <div class="empty-state">
            <i class="fas fa-share-alt empty-icon"></i>
            <p class="empty-text">No platforms specified</p>
          </div>
        `;
        return;
      }
      
      const platformsHtml = platforms.map(platform => {
        const icon = platformIcons[platform.toLowerCase()] || 'fas fa-globe';
        return `
          <div class="platform-card">
            <i class="${icon}"></i>
            ${platform}
          </div>
        `;
      }).join('');
      
      document.querySelector('.platform-grid').innerHTML = platformsHtml;
    }
    
    function renderReviewsSection(result, percentages) {
      
      // Update ratings overview
      document.querySelector('.average-score').textContent = percentages.rateave.toFixed(1);
      document.querySelector('.total-reviews').textContent = `from ${percentages.total} reviews`;
      
      // Update rating bars
      Object.entries(percentages.distribution).forEach(([stars, percentage]) => {
        const selector = `.rating-bars:nth-child(${6 - parseInt(stars)})`;
        const ratingBar = document.querySelector(selector);
        if (ratingBar) {
          ratingBar.querySelector('.rating-fill').style.width = `${percentage}%`;
          ratingBar.querySelector('.rating-count').textContent = `${percentage}%`;
        }
      });
      
      // Show reviews or empty state
      if (result.reviews && result.reviews.length > 0) {
        const reviewsHtml = result.reviews.map(review => {
          // Format date if available
          const reviewDate = review.created_at ? new Date(review.created_at).toLocaleDateString() : '';
          const rating = review.rating || 5;
          
          return `
            <div class="review-card">
              <div class="review-header">
                <div class="reviewer">
                  <img src="${review.avatar || '/assets/images/default-avatar.png'}" alt="${review.name}" class="reviewer-avatar">
                  <div class="reviewer-details">
                    <div class="reviewer-name">${review.name}</div>
                    <div class="review-date">${reviewDate}</div>
                  </div>
                </div>
                <div class="review-rating">
                  ${Array(Math.floor(rating)).fill('<i class="fas fa-star"></i>').join('')}
                  ${rating % 1 ? '<i class="fas fa-star-half-alt"></i>' : ''}
                </div>
              </div>
              <div class="review-content">${review.content}</div>
            </div>
          `;
        }).join('');
        
        document.querySelector('.reviews-list').innerHTML = reviewsHtml;
      } else {
        document.querySelector('.reviews-list').innerHTML = `
          <div class="empty-state">
            <i class="far fa-comment-dots empty-icon"></i>
            <p class="empty-text">No reviews yet</p>
            <p class="empty-subtext">Be the first to leave a review for this service</p>
          </div>
        `;
      }
    }
    
    function renderTags(result) {
      let tags = [];
      
      // Handle tags depending on format returned
      if (result.tags) {
        tags = Array.isArray(result.tags) 
          ? result.tags 
          : JSON.parse(result.tags || '[]');
      }
      
      if (!tags || tags.length === 0) {
        document.querySelector('.tags-container').innerHTML = `
          <div class="empty-state">
            <i class="fas fa-tags empty-icon"></i>
            <p class="empty-text">No tags available</p>
          </div>
        `;
        return;
      }
      
      const tagsHtml = tags.map(tag => `<span class="tag">${tag}</span>`).join('');
      document.querySelector('.tags-container').innerHTML = tagsHtml;
    }
    
    function renderPricingContent(plan, result) {
      currentPlan = plan; // Update current plan state
      
      // Safely access package data
      const packages = result.packages || [];
      if (packages.length < 2) {
        console.error('Missing package data');
        return;
      }
      
      // Select the appropriate package for the current plan (0 = standard, 1 = premium)
      const packageIndex = plan === 'standard' ? 0 : 1;
      const packageData = packages[packageIndex];
      
      // Parse features
      const features = packageData.benefits
        .split(',')
        .map(item => item.trim())
        .filter(item => item);
      
      const serviceId = result.service_id;
      const serviceType = result.service_type;
      const isGig = serviceType === 'gig';
      
      // Generate features list HTML
      const featuresHtml = features.map(feature => `
        <div class="feature-item">
          <div class="feature-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <div class="feature-text">${feature}</div>
        </div>
      `).join('');
      
      // Generate button text and icons based on service type
      const primaryBtnText = isGig ? "Order Now" : "Request to Order";
      const primaryBtnIcon = isGig ? "fas fa-shopping-cart" : "fas fa-paper-plane";
      const primaryBtnUrl = `/businessman/place-order?service_id=${serviceId}&package_id=${packageData.package_id}`;
      
      // Custom package button only for promotions
      const customPackageBtn = !isGig 
        ? `<button class="action-button secondary-button" onclick="window.location.href='/businessman/request-package?service_id=${serviceId}'">
            <i class="fas fa-box"></i> Request Custom Package
          </button>` 
        : '';
      
      // Determine contact text based on service type
      const contactText = isGig ? "Designer" : "Influencer";
      
      const content = `
        <div class="time-info">
          <div class="time-item">
            <i class="far fa-clock"></i>
            ${packageData.delivery_days} days
          </div>
          <div class="time-item">
            <i class="fas fa-sync-alt"></i>
            ${packageData.revisions} revisions
          </div>
        </div>
        
        <div class="features-list">
          ${featuresHtml}
        </div>
        
        <div class="price">LKR ${packageData.price}</div>
        
        <button class="action-button primary-button" onclick="window.location.href='${primaryBtnUrl}'">
          <i class="${primaryBtnIcon}"></i> ${primaryBtnText}
        </button>
        
        ${customPackageBtn}
        
        <button class="action-button secondary-button" onclick="window.location.href='#'">
          <i class="far fa-comment-dots"></i> Contact ${contactText}
        </button>
        
        <div class="guarantee-text">
          <i class="fas fa-shield-alt"></i> 100% Satisfaction Guarantee
        </div>
      `;
      
      document.getElementById('pricing-content').innerHTML = content;
    }
    
    function switchTab(plan) {
      // Update active tab UI
      document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
      });
      document.querySelector(`.tab:${plan === 'premium' ? 'last-child' : 'first-child'}`).classList.add('active');
      
      // Re-fetch current API data and re-render the pricing content
      const pathSegments = window.location.pathname.split('/');
      const serviceID = pathSegments[pathSegments.length - 1];
      
      fetch(`/api/service/${serviceID}?service=true&packages=true&include_user=true`)
        .then(response => response.json())
        .then(result => {
          renderPricingContent(plan, result);
        })
        .catch(error => {
          console.error('Error fetching service data for tab switch:', error);
        });
    }
  </script>
</body>
</html>