<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - BrandBoost</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            min-height: 100vh;
        }

        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        /* Profile Header Styles */
        .profile-header {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .cover-photo-container {
            position: relative;
            height: 240px;
        }

        .cover-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info-in-page {
            padding: 1.5rem;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .profile-photo-wrapper {
            position: absolute;
            top: -80px;
            left: 2rem;
        }

        .profile-photo-container {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 4px solid white;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            margin-left: 160px;
        }

        .profile-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .profile-role-in-page {
            font-size: 1rem;
            color: #6b7280;
            display: inline-block;
            background: #f3f4f6;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            margin-left: -10px;
            margin-bottom: 0.5rem;
        }

        .profile-stats {
            margin-left: auto;
            display: flex;
            gap: 2rem;
            padding-top: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4338ca;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Content Grid Layout */
        .profile-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* Left Column - Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Right Column - Sidebar */
        .profile-sidebar {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Card Component */
        .profile-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .card-badge {
            background: #e0e7ff;
            color: #4338ca;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
        }

        .card-content {
            color: #4b5563;
            line-height: 1.6;
        }

        /* Expertise Lists */
        .expertise-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .expertise-tag {
            background: #f3f4f6;
            color: #4b5563;
            font-size: 0.875rem;
            padding: 0.4rem 0.75rem;
            border-radius: 0.5rem;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .service-card {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .service-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }

        .service-details {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .service-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .service-price {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .price-value {
            font-weight: 600;
            color: #4338ca;
            font-size: 1rem;
        }

        /* Enhanced Analytics Styles */
        .analytics-section {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .insights-badge {
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
            background: #f3f4f6;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
        }
        
        .analytics-content {
            padding: 0.5rem 0;
        }
        
        /* Main metrics styling */
        .analytics-main-metrics {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .analytics-metric-card {
            padding: 1.25rem;
            border-radius: 0.75rem;
            background: #f9fafc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .analytics-metric-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        }
        
        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(67, 56, 202, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: #4338ca;
        }
        
        .metric-info {
            flex-grow: 1;
            padding: 0 1rem;
        }
        
        .metric-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.1;
        }
        
        .metric-label {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        
        .metric-trend {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .metric-trend.positive {
            color: #059669;
        }
        
        .metric-trend.negative {
            color: #dc2626;
        }
        
        .metric-trend.neutral {
            color: #6b7280;
            font-size: 0.75rem;
            max-width: 70px;
            text-align: right;
        }
        
        .metric-trend i {
            margin-right: 0.25rem;
            font-size: 0.75rem;
        }
        
        /* Secondary metrics styling */
        .analytics-secondary-metrics {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 0 0.5rem;
        }
        
        .analytics-metric-mini {
            text-align: center;
            padding: 1rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s ease;
        }
        
        .analytics-metric-mini:hover {
            background-color: #f9fafc;
        }
        
        .mini-metric-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        
        .mini-metric-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }
        
        .mini-metric-trend {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.1rem 0.5rem;
            border-radius: 1rem;
        }
        
        .mini-metric-trend.positive {
            color: #059669;
            background-color: rgba(5, 150, 105, 0.1);
        }
        
        .mini-metric-trend.negative {
            color: #dc2626;
            background-color: rgba(220, 38, 38, 0.1);
        }

        /* Portfolio Section */
        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .portfolio-item {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .portfolio-item:hover {
            transform: scale(1.05);
        }

        .portfolio-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        /* Social Media Links */
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background: #f3f4f6;
            border-radius: 0.5rem;
            text-decoration: none;
            color: #4b5563;
            transition: background 0.2s ease;
        }

        .social-link:hover {
            background: #e0e7ff;
            color: #4338ca;
        }

        .social-icon {
            font-size: 1.25rem;
        }

        /* Enhanced Portfolio Section Styles */
        .portfolio-projects {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .portfolio-project {
            background: #f9fafc;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .project-header {
            margin-bottom: 0.75rem;
        }

        .project-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .project-description {
            margin-bottom: 1rem;
            color: #4b5563;
            line-height: 1.5;
        }

        .project-images {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
        }

        .no-images {
            color: #6b7280;
            font-style: italic;
        }

        /* Lightbox Styles */
        .portfolio-lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }

        .lightbox-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #lightbox-image {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }

        .lightbox-close {
            position: absolute;
            top: -40px;
            right: 0;
            font-size: 2rem;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
            z-index: 1010;
        }

        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 2rem;
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .lightbox-nav:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .lightbox-prev {
            left: -75px;
        }

        .lightbox-next {
            right: -75px;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
            
            .analytics-main-metrics {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .analytics-secondary-metrics {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .profile-details {
                margin-left: 0;
                margin-top: 70px;
                width: 100%;
            }

            .profile-stats {
                margin-left: 0;
                width: 100%;
                justify-content: space-around;
                margin-top: 1rem;
            }
            
            .analytics-main-metrics {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .analytics-secondary-metrics {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }
            
            .metric-info {
                padding: 0 0.75rem;
            }
            
            .metric-value {
                font-size: 1.5rem;
            }
            
            .lightbox-nav {
                width: 40px;
                height: 40px;
                font-size: 1.5rem;
            }

            .lightbox-prev {
                left: -50px;
            }

            .lightbox-next {
                right: -50px;
            }
        }

        @media (max-width: 640px) {
            .services-grid,
            .portfolio-grid {
                grid-template-columns: 1fr;
            }
            
            .lightbox-nav {
                top: auto;
                bottom: -60px;
                transform: none;
            }

            .lightbox-prev {
                left: 30%;
            }

            .lightbox-next {
                right: 30%;
            }
        }
        
        @media (max-width: 480px) {
            .analytics-secondary-metrics {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
            
            .analytics-metric-mini {
                display: flex;
                align-items: center;
                justify-content: space-between;
                text-align: left;
                padding: 0.75rem 1rem;
            }
            
            .mini-metric-label {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <?php
    // Initialize variables from the combined data
    $user = $combinedData['userData'] ?? [];
    $userRole = $user['role'] ?? 'guest';
    $services = $combinedData['serviceData'] ?? [];
    $isAdminView = $combinedData['isAdminView'] ?? false;
    ?>

    <main class="profile-container">
        <?php include_once __DIR__ . '/../../components/admin_options_bar.php'; ?>
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="cover-photo-container">
                <img class="cover-photo"
                    src="<?php echo !empty($user['cover_picture']) ? '/' . ltrim($user['cover_picture'], '/') : 'https://placehold.co/1200x300?text=Cover+Photo'; ?>"
                    alt="Cover Photo">
            </div>
            <div class="profile-info-in-page">
                <div class="profile-photo-wrapper">
                    <div class="profile-photo-container">
                        <img class="profile-photo"
                            src="<?php echo !empty($user['profile_picture']) ? '/' . ltrim($user['profile_picture'], '/') : 'https://placehold.co/200x200?text=Profile'; ?>"
                            alt="Profile Photo">
                    </div>
                </div>
                <div class="profile-details">
                    <h1 class="profile-name"><?php echo htmlspecialchars($user['name'] ?? 'Unknown User'); ?></h1>
                    <span class="profile-role-in-page"><?php echo ucfirst(htmlspecialchars($userRole)); ?></span>
                    <?php if (!empty($user['professional_title'])): ?>
                        <p><?php echo htmlspecialchars($user['professional_title']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value"><?php echo intval($user['total_projects'] ?? 0); ?></div>
                        <div class="stat-label">Projects</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value"><?php echo number_format((float)($user['average_rating'] ?? 0), 1); ?></div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Main Content Column -->
            <div class="main-content">
                <!-- Bio Section -->
                <div class="profile-card">
                    <div class="card-header">
                        <h2 class="card-title">About</h2>
                    </div>
                    <div class="card-content">
                        <p><?php echo htmlspecialchars($user['bio'] ?? 'No bio available.'); ?></p>
                    </div>
                </div>

                <?php if ($userRole === 'designer'): ?>
                    <!-- Designer Expertise -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">Design Expertise</h2>
                        </div>
                        <div class="card-content">
                            <h3 style="font-size: 1rem; margin-bottom: 0.5rem; color: #4b5563;">Specialties</h3>
                            <div class="expertise-list">
                                <?php
                                if (!empty($user['specialties'])) {
                                    $specialties = explode(',', $user['specialties']);
                                    foreach ($specialties as $specialty) {
                                        echo '<span class="expertise-tag">' . trim(htmlspecialchars($specialty)) . '</span>';
                                    }
                                } else {
                                    echo '<p>No specialties specified</p>';
                                }
                                ?>
                            </div>

                            <h3 style="font-size: 1rem; margin: 1.5rem 0 0.5rem; color: #4b5563;">Tools & Software</h3>
                            <div class="expertise-list">
                                <?php
                                if (!empty($user['tools'])) {
                                    $tools = explode(',', $user['tools']);
                                    foreach ($tools as $tool) {
                                        echo '<span class="expertise-tag">' . trim(htmlspecialchars($tool)) . '</span>';
                                    }
                                } else {
                                    echo '<p>No tools specified</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Portfolio Section with Enhanced UI -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">Portfolio</h2>
                        </div>
                        <div class="card-content">
                            <?php if (!empty($user['portfolio_projects']) && is_array($user['portfolio_projects'])): ?>
                                <div class="portfolio-projects">
                                    <?php foreach ($user['portfolio_projects'] as $projectIndex => $project): ?>
                                        <div class="portfolio-project">
                                            <div class="project-header">
                                                <h3 class="project-title"><?php echo htmlspecialchars($project['title'] ?? 'Untitled Project'); ?></h3>
                                            </div>

                                            <?php if (!empty($project['description'])): ?>
                                                <div class="project-description">
                                                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                                                </div>
                                            <?php endif; ?>

                                            <?php
                                            // Collect all images for this project
                                            $projectImages = [];
                                            for ($i = 1; $i <= 3; $i++) {
                                                if (!empty($project['image_' . $i])) {
                                                    $projectImages[] = [
                                                        'src' => '/' . ltrim($project['image_' . $i], '/'),
                                                        'alt' => htmlspecialchars($project['title'] ?? 'Project Image ' . $i)
                                                    ];
                                                }
                                            }

                                            if (!empty($projectImages)):
                                            ?>
                                                <div class="project-images">
                                                    <?php foreach ($projectImages as $index => $image): ?>
                                                        <div class="portfolio-item"
                                                            data-project-index="<?php echo $projectIndex; ?>"
                                                            data-image-index="<?php echo $index; ?>">
                                                            <img src="<?php echo htmlspecialchars($image['src']); ?>"
                                                                alt="<?php echo htmlspecialchars($image['alt']); ?>"
                                                                class="portfolio-image">
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php else: ?>
                                                <p class="no-images">No images for this project</p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Lightbox for Portfolio Images -->
                                <div id="portfolio-lightbox" class="portfolio-lightbox">
                                    <div class="lightbox-content">
                                        <button class="lightbox-close">&times;</button>
                                        <div class="lightbox-image-container">
                                            <img id="lightbox-image" src="" alt="Project Image">
                                        </div>
                                        <button class="lightbox-nav lightbox-prev">&lsaquo;</button>
                                        <button class="lightbox-nav lightbox-next">&rsaquo;</button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p>No portfolio projects available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($userRole === 'influencer'): ?>
                    <!-- Influencer Social Media Section -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">Social Media Presence</h2>
                        </div>
                        <div class="card-content">
                            <?php if (!empty($user['social_accounts']) && is_array($user['social_accounts'])): ?>
                                <div class="social-links">
                                    <?php foreach ($user['social_accounts'] as $account): ?>
                                        <a href="<?php echo htmlspecialchars($account['link']); ?>" class="social-link" target="_blank" rel="noopener">
                                            <span class="social-icon">
                                                <?php
                                                $platform = strtolower($account['platform'] ?? '');
                                                if ($platform === 'instagram') {
                                                    echo '<i class="fab fa-instagram"></i>';
                                                } elseif ($platform === 'youtube') {
                                                    echo '<i class="fab fa-youtube"></i>';
                                                } elseif ($platform === 'tiktok') {
                                                    echo '<i class="fab fa-tiktok"></i>';
                                                } elseif ($platform === 'twitter' || $platform === 'x') {
                                                    echo '<i class="fab fa-twitter"></i>';
                                                } elseif ($platform === 'facebook') {
                                                    echo '<i class="fab fa-facebook"></i>';
                                                } elseif ($platform === 'linkedin') {
                                                    echo '<i class="fab fa-linkedin"></i>';
                                                } else {
                                                    echo '<i class="fas fa-globe"></i>';
                                                }
                                                ?>
                                            </span>
                                            <span><?php echo htmlspecialchars($account['username'] ?? ''); ?></span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p>No social media accounts available.</p>
                            <?php endif; ?>

                            <?php if (!empty($user['specialties'])): ?>
                                <h3 style="font-size: 1rem; margin: 1.5rem 0 0.5rem; color: #4b5563;">Content Specialties</h3>
                                <div class="expertise-list">
                                    <?php
                                    $specialties = explode(',', $user['specialties']);
                                    foreach ($specialties as $specialty) {
                                        echo '<span class="expertise-tag">' . trim(htmlspecialchars($specialty)) . '</span>';
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($userRole === 'businessman'): ?>
                    <!-- Business Information -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">Business Information</h2>
                            <?php if (!empty($user['business_registration']['br_status'])): ?>
                                <span class="card-badge"><?php echo ucfirst(htmlspecialchars($user['business_registration']['br_status'])); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <p><strong>Business Name:</strong> <?php echo htmlspecialchars($user['business_registration']['business_name'] ?? 'Not specified'); ?></p>

                            <?php if (!empty($user['business_registration']['br_document'])): ?>
                                <p style="margin-top: 1rem;">
                                    <a href="/<?php echo htmlspecialchars($user['business_registration']['br_document']); ?>" download style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #e0e7ff; color: #4338ca; border-radius: 0.5rem; text-decoration: none; font-weight: 500;">
                                        <i class="fas fa-file-download"></i> Download BR Document
                                    </a>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (in_array($userRole, ['designer', 'influencer'])): ?>
                    <!-- Services Offered -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">Services Offered</h2>
                        </div>
                        <div class="card-content">
                            <?php
                            // Extract user ID from the URL
                            $requestUri = $_SERVER['REQUEST_URI'] ?? '';
                            $segments = explode('/', trim($requestUri, '/'));
                            $userId = end($segments); // Gets the last segment (user ID)

                            // Filter services for this user
                            $userServices = [];
                            if (is_array($services)) {
                                $userServices = array_filter($services, function ($service) use ($userId) {
                                    return isset($service['user_id']) && $service['user_id'] == $userId;
                                });
                            }
                            ?>

                            <?php if (!empty($userServices)): ?>
                                <div class="services-grid">
                                    <?php foreach ($userServices as $service): ?>
                                        <?php
                                        $serviceId = $service['service_id'] ?? '';
                                        $title = $service['title'] ?? 'Untitled';
                                        $coverImage = $service['cover_image'] ?? 'assets/images/dp-empty.png';

                                        $basicPrice = 'N/A';
                                        if (!empty($service['packages']) && is_array($service['packages'])) {
                                            foreach ($service['packages'] as $package) {
                                                if (isset($package['package_type']) && $package['package_type'] === 'basic') {
                                                    $basicPrice = $package['price'] ?? 'N/A';
                                                    break;
                                                }
                                            }
                                        }
                                        ?>
                                        <a href="/services/<?php echo htmlspecialchars($serviceId); ?>" class="service-card">
                                            <img src="/<?php echo htmlspecialchars(ltrim($coverImage, '/')); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="service-image">
                                            <div class="service-details">
                                                <h3 class="service-title"><?php echo htmlspecialchars($title); ?></h3>
                                                <div class="service-price">
                                                    Starting from <span class="price-value">$<?php echo htmlspecialchars($basicPrice); ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p>No services currently offered.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar Column -->
            <div class="profile-sidebar">
                <!-- Contact Section with Enhanced Analytics-Style UI -->
                <div class="profile-card analytics-section">
                    <div class="card-header">
                        <h2 class="card-title">Contact Information</h2>
                        <span class="insights-badge">Verified</span>
                    </div>
                    <div class="analytics-content">
                        <div class="analytics-main-metrics">
                            <?php if (!empty($user['email'])): ?>
                                <div class="analytics-metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="metric-info">
                                        <div class="metric-label">Email Address</div>
                                        <div class="metric-value" style="font-size: 1.1rem;"><?php echo htmlspecialchars($user['email']); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                
                            <?php if (!empty($user['phone'])): ?>
                                <div class="analytics-metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="metric-info">
                                        <div class="metric-label">Phone Number</div>
                                        <div class="metric-value" style="font-size: 1.1rem;"><?php echo htmlspecialchars($user['phone']); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                
                            <?php if (!empty($user['location'])): ?>
                                <div class="analytics-metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="metric-info">
                                        <div class="metric-label">Location</div>
                                        <div class="metric-value" style="font-size: 1.1rem;"><?php echo htmlspecialchars($user['location']); ?></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                
                            <?php if (empty($user['email']) && empty($user['phone']) && empty($user['location'])): ?>
                                <div class="analytics-metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="metric-info">
                                        <div class="metric-label">No Contact Information</div>
                                        <div class="metric-value" style="font-size: 1.1rem;">Unavailable</div>
                                    </div>
                                    <div class="metric-trend neutral">
                                        <span>Private</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <?php if (in_array($userRole, ['designer', 'influencer'])): ?>
                    <!-- Enhanced Analytics Overview Section -->
                    <div class="profile-card analytics-section">
                        <div class="card-header">
                            <h2 class="card-title">Analytics Overview</h2>
                            <span class="insights-badge">Last 30 days</span>
                        </div>
                        <div class="analytics-content">
                            <!-- Main metrics row -->
                            <div class="analytics-main-metrics">
                                <div class="analytics-metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <div class="metric-info">
                                        <div class="metric-value"><?php echo intval($user['total_projects'] ?? 0); ?></div>
                                        <div class="metric-label">Total Projects</div>
                                    </div>
                                    <div class="metric-trend positive">
                                        <i class="fas fa-arrow-up"></i>
                                        <span>12%</span>
                                    </div>
                                </div>
                                
                                <div class="analytics-metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="metric-info">
                                        <div class="metric-value"><?php echo number_format((float)($user['average_rating'] ?? 0), 1); ?></div>
                                        <div class="metric-label">Average Rating</div>
                                    </div>
                                    <div class="metric-trend positive">
                                        <i class="fas fa-arrow-up"></i>
                                        <span>0.2</span>
                                    </div>
                                </div>
                                
                                <div class="analytics-metric-card">
                                    <div class="metric-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="metric-info">
                                        <div class="metric-value"><?php echo intval($user['experience_years'] ?? 0); ?></div>
                                        <div class="metric-label">Years Experience</div>
                                    </div>
                                    <div class="metric-trend neutral">
                                        <span>Industry experience</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($userRole === 'businessman'): ?>
                    <!-- Order History Placeholder -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h2 class="card-title">Recent Orders</h2>
                        </div>
                        <div class="card-content">
                            <p>No recent orders found.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script>
    // Enhanced JavaScript for Portfolio Lightbox
    document.addEventListener('DOMContentLoaded', () => {
        // Store all portfolio projects and their images for the lightbox
        const portfolioData = [];

        <?php if (!empty($user['portfolio_projects']) && is_array($user['portfolio_projects'])): ?>
            <?php foreach ($user['portfolio_projects'] as $projectIndex => $project): ?>
                {
                    // Create a new scope for each project to avoid variable redeclaration
                    const projectImages = [];

                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <?php if (!empty($project['image_' . $i])): ?>
                            projectImages.push({
                                src: '/<?php echo addslashes($project['image_' . $i]); ?>',
                                alt: '<?php echo addslashes(htmlspecialchars($project['title'] ?? 'Project Image ' . $i)); ?>'
                            });
                        <?php endif; ?>
                    <?php endfor; ?>

                    if (projectImages.length > 0) {
                        portfolioData.push({
                            title: '<?php echo addslashes(htmlspecialchars($project['title'] ?? 'Untitled Project')); ?>',
                            images: projectImages
                        });
                    }
                }
            <?php endforeach; ?>
        <?php endif; ?>

        // Get DOM elements
        const lightbox = document.getElementById('portfolio-lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxClose = document.querySelector('.lightbox-close');
        const lightboxPrev = document.querySelector('.lightbox-prev');
        const lightboxNext = document.querySelector('.lightbox-next');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        // Skip if no lightbox found
        if (!lightbox || portfolioData.length === 0) return;

        // Current project and image being viewed
        let currentProjectIndex = 0;
        let currentImageIndex = 0;

        // Open lightbox when clicking on a portfolio item
        portfolioItems.forEach(item => {
            item.addEventListener('click', () => {
                currentProjectIndex = parseInt(item.dataset.projectIndex || 0, 10);
                currentImageIndex = parseInt(item.dataset.imageIndex || 0, 10);
                openLightbox();
            });
        });

        // Close lightbox when clicking the close button
        if (lightboxClose) {
            lightboxClose.addEventListener('click', closeLightbox);
        }

        // Navigate to previous image
        if (lightboxPrev) {
            lightboxPrev.addEventListener('click', showPreviousImage);
        }

        // Navigate to next image
        if (lightboxNext) {
            lightboxNext.addEventListener('click', showNextImage);
        }

        // Close lightbox when clicking outside the image
        if (lightbox) {
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!lightbox || !lightbox.style.display || lightbox.style.display === 'none') return;

            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowLeft') {
                showPreviousImage();
            } else if (e.key === 'ArrowRight') {
                showNextImage();
            }
        });

        // Function to open lightbox with current image
        function openLightbox() {
            // Make sure portfolioData is properly populated
            if (!portfolioData || portfolioData.length === 0) {
                console.error("Portfolio data is empty");
                return;
            }
            
            // Validate indices
            if (currentProjectIndex >= portfolioData.length) {
                console.error("Invalid project index:", currentProjectIndex);
                currentProjectIndex = 0;
            }
            
            const project = portfolioData[currentProjectIndex];
            if (!project || !project.images || !project.images[currentImageIndex]) {
                console.error("Invalid image data for project", currentProjectIndex, "image", currentImageIndex);
                return;
            }

            // Set image source
            const imageData = project.images[currentImageIndex];
            lightboxImage.src = imageData.src;
            lightboxImage.alt = imageData.alt;

            // Show the lightbox
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when lightbox is open

            updateNavigationButtons();
        }

        // Function to close lightbox
        function closeLightbox() {
            if (lightbox) {
                lightbox.style.display = 'none';
                document.body.style.overflow = ''; // Restore scrolling
            }
        }

        // Function to show previous image
        function showPreviousImage() {
            if (!portfolioData || portfolioData.length === 0) return;
            
            // Check if we're at the first image of the current project
            if (currentImageIndex > 0) {
                currentImageIndex--;
            } else {
                // Go to the previous project's last image
                if (currentProjectIndex > 0) {
                    currentProjectIndex--;
                    currentImageIndex = portfolioData[currentProjectIndex].images.length - 1;
                } else {
                    // If we're at the first image of the first project, loop to the last project's last image
                    currentProjectIndex = portfolioData.length - 1;
                    currentImageIndex = portfolioData[currentProjectIndex].images.length - 1;
                }
            }

            openLightbox();
        }

        // Function to show next image
        function showNextImage() {
            if (!portfolioData || portfolioData.length === 0) return;
            
            // Check if we're at the last image of the current project
            if (currentImageIndex < portfolioData[currentProjectIndex].images.length - 1) {
                currentImageIndex++;
            } else {
                // Go to the next project's first image
                if (currentProjectIndex < portfolioData.length - 1) {
                    currentProjectIndex++;
                    currentImageIndex = 0;
                } else {
                    // If we're at the last image of the last project, loop to the first project's first image
                    currentProjectIndex = 0;
                    currentImageIndex = 0;
                }
            }

            openLightbox();
        }

        // Function to update navigation button visibility
        function updateNavigationButtons() {
            if (!portfolioData || portfolioData.length === 0 || !lightboxPrev || !lightboxNext) {
                return;
            }
            
            // Always show navigation buttons if there's more than one image total
            let totalImages = portfolioData.reduce((count, project) => count + project.images.length, 0);
            if (totalImages <= 1) {
                lightboxPrev.style.display = 'none';
                lightboxNext.style.display = 'none';
            } else {
                lightboxPrev.style.display = 'flex';
                lightboxNext.style.display = 'flex';
            }
        }

        // Initialize - log debug info if needed
        if (portfolioItems.length > 0) {
            // console.log("Portfolio items found:", portfolioItems.length);
            // console.log("Portfolio data:", portfolioData);
        }
    });
    </script>
</body>

</html>