<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #f7fafc;
            font-family: 'Inter', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .bg-white {
            background-color: white;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .w-full {
            width: 100%;
        }

        .h-52 {
            height: 13rem;
        }

        .object-cover {
            object-fit: cover;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .w-24 {
            width: 6rem;
        }

        .h-24 {
            height: 6rem;
        }

        .rounded-full {
            border-radius: 9999px;
        }

        .border-4 {
            border-width: 4px;
        }

        .border-white {
            border-color: white;
        }

        .-mt-12 {
            margin-top: -3rem;
        }

        .ml-6 {
            margin-left: 1.5rem;
        }

        .text-2xl {
            font-size: 1.5rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-indigo-700 {
            color: #4338ca;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .text-gray-700 {
            color: #374151;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        .gap-6 {
            gap: 1.5rem;
        }

        .transform {
            transform: translateX(0) translateY(0) rotate(0) skewX(0) skewY(0) scaleX(1) scaleY(1);
        }

        .transition {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        .hover\:scale-105:hover {
            transform: scale(1.05);
        }

        .h-48 {
            height: 12rem;
        }

        .p-4 {
            padding: 1rem;
        }

        .text-gray-900 {
            color: #111827;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-800 {
            color: #1f2937;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .px-3 {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .py-1 {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .bg-green-100 {
            background-color: #dcfce7;
        }

        .text-green-800 {
            color: #166534;
        }

        .bg-gray-100 {
            background-color: #f3f4f6;
        }

        .bg-indigo-100 {
            background-color: #e0e7ff;
        }

        .text-indigo-900 {
            color: #312e81;
        }

        .text-center {
            text-align: center;
        }

        .text-xl {
            font-size: 1.25rem;
        }

        .text-indigo-600 {
            color: #4f46e5;
        }

        .hover\:underline:hover {
            text-decoration: underline;
        }

        .col-span-full {
            grid-column: 1 / -1;
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .md\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        .analytics-container {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .analytics-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    /* .analytics-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #4338ca;
    } */

    .analytics-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .analytics-card {
        position: relative;
        padding: 1.5rem;
        border-radius: 0.75rem;
        background: #fafafa;
        transition: transform 0.3s ease;
        shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.8);
    }

    .analytics-card:hover {
        transform: translateY(-5px);
    }

    .analytics-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        /* background: #4338ca; */
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .analytics-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #4338ca;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .analytics-value {
        font-size: 2rem;
        font-weight: 700;
        color: #312e81;
        margin-bottom: 0.25rem;
    }

    .analytics-trend {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #059669;
    }

    .analytics-trend.positive {
        color: #059669;
    }

    .analytics-trend.negative {
        color: #dc2626;
    }

    .analytics-icon {
        width: 40px;
        height: 40px;
        background: rgba(67, 56, 202, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .no-underline {
        text-decoration: none;
        color: inherit;
    }

    /* For any hover states you want to preserve */
    .no-underline:hover {
        text-decoration: none;
        color: inherit;
    }

    .service-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
    }

    .service-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .service-card:hover {
        transform: scale(1.05);
    }

    .service-image {
        width: 100%;
        height: 160px; /* Fixed height for images */
        object-fit: cover;
    }

    .service-content {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .service-title {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
        margin-bottom: 50rem;
        line-height: 1.4;
    }

    .service-price {
        font-size: 0.875rem;
        color: #4b5563;
        margin-bottom: 0.25rem;
    }

    .service-status {
        margin-top: auto;
        padding-top: 0.5rem;
    }

    @media (min-width: 768px) {
        .service-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .service-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .analytics-grid {
            grid-template-columns: 1fr;
        }

        .analytics-card {
            padding: 1.25rem;
        }
    }
    </style>
</head>

<?php
    $user = $combinedData['userData'] ?? []; // Ensure $userData is available
    $userRole = $user['role'] ?? 'guest'; // Default to 'guest' if role is missing
    $services = $combinedData['serviceData'] ?? []; // Ensure $serviceData is available
?>

<body>
    <main class="container">
        <!-- Profile Header: common for all roles -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <img alt="Cover Photo" class="w-full h-52 object-cover"
                src="<?php echo $user['cover_picture'] ?? 'https://placehold.co/1200x300?text=Cover+Photo'; ?>" />
            <div class="p-6 flex items-center">
                <img alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-white -mt-12"
                    src="<?php echo $user['profile_picture'] ?? 'https://placehold.co/100x100?text=Profile+Picture'; ?>" />
                <div class="ml-6">
                    <h1 class="text-2xl font-bold"><?php echo $user['name'] ?? 'Unknown User'; ?></h1>
                    <p class="text-gray-600"><?php echo ucfirst($userRole); ?></p>
                </div>
            </div>
        </div>

        <!-- Bio Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Bio</h3>
            <p class="text-gray-700 mt-4"><?php echo $user['bio'] ?? 'Not specified'; ?></p>
            <p class="text-gray-700 mt-2">Location: <?php echo $user['location'] ?? 'Not specified'; ?></p>
        </div>

        <?php if (in_array($userRole, ['designer'])): ?>
        <!-- Design Expertise Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Design Expertise</h3>
            <div class="mt-4">
                <h4 class="text-md font-semibold text-indigo-700">Specialties:</h4>
                <p class="text-gray-700 mt-2"><?php echo $user['specialties'] ?? 'Not specified'; ?></p>
                <h4 class="text-md font-semibold text-indigo-700 mt-4">Tools Used:</h4>
                <p class="text-gray-700 mt-2"><?php echo $user['tools_used'] ?? 'Not specified'; ?></p>
            </div>
        </div>
       

        <!-- Portfolio Highlights Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Portfolio Highlights</h3>
            <div class="mt-4" id="dynamic-portfolio">
                <!-- Portfolio items will be loaded here via JavaScript -->
            </div>
        </div>
        <?php endif; ?>
        <?php if (in_array($userRole, ['influencer'])): ?>
        <!-- Social Media Accounts Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Social Media Accounts</h3>
            <div class="mt-4">
                <h4 class="text-md font-semibold text-indigo-700">Specialties:</h4>
                <p class="text-gray-700 mt-2"><?php echo $user['specialties'] ?? 'Not specified'; ?></p>
                <h4 class="text-md font-semibold text-indigo-700 mt-4">Tools Used:</h4>
                <p class="text-gray-700 mt-2"><?php echo $user['tools_used'] ?? 'Not specified'; ?></p>
            </div>
        </div>
        <?php endif; ?>

        <?php if (in_array($userRole, ['designer', 'influencer'])): ?>
        <!-- Gigs Section -->
        <?php
        // Extract user ID from the URL
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/'));
        $userId = end($segments); // Gets the last segment (user ID)
        ?>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700 mb-8">Services Offered</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($services) && is_array($services)): ?>
                <?php foreach ($services as $service): ?>
                <?php
                // Ensure the service belongs to the correct user
                if (!isset($service['user_id']) || $service['user_id'] != $userId) {
                    continue;
                }

                $serviceId = $service['service_id'] ?? '';
                $title = $service['title'] ?? 'Untitled';
                $coverImage = $service['cover_image'] ?? 'https://placehold.co/300x200?text=Service+Image';
                $status = $service['status'] ?? 'Active';
                $updatedAt = !empty($service['updated_at']) ? date('m/d/Y', strtotime($service['updated_at'])) : 'N/A';

                $basicPrice = 'N/A';
                $premiumPrice = 'N/A';

                if (!empty($service['packages']) && is_array($service['packages'])) {
                    foreach ($service['packages'] as $package) {
                        if ($package['package_type'] === 'basic') {
                            $basicPrice = $package['price'] ?? 'N/A';
                        } elseif ($package['package_type'] === 'premium') {
                            $premiumPrice = $package['price'] ?? 'N/A';
                        }
                    }
                }
                ?>
                <a href="/services/<?php echo htmlspecialchars($serviceId); ?>" style="text-decoration: none; color: inherit;" class="block no-underline">

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition hover:scale-105">
                    <img src="<?php echo '/' . ltrim($service['cover_image'] ?? 'assets/images/dp-empty.png', '/'); ?>"
                        class="w-full h-48 object-cover" alt="Service thumbnail" />
                    <div class="p-4">
                        <h4 class="font-semibold text-lg text-gray-900 mb-8"><?= htmlspecialchars($title) ?></h4>
                        <p class="text-sm text-gray-600">Starting From: <span
                                class="font-semibold text-gray-800">$<?= htmlspecialchars($basicPrice) ?></span></p>
                        
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="col-span-full text-center text-gray-700 py-4">
                    No services found.
                </div>
                <?php endif; ?>
            </a>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="analytics-container">
    <div class="analytics-header">
        <h3 class="text-lg font-semibold text-indigo-700">Analytics Overview</h3>
    </div>
    
    <div class="analytics-grid">
        <div class="analytics-card">
            <div class="analytics-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4338ca" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline>
                    <polyline points="7.5 19.79 7.5 14.6 3 12"></polyline>
                    <polyline points="21 12 16.5 14.6 16.5 19.79"></polyline>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
            </div>
            <div class="analytics-label">Total Projects</div>
            <div class="analytics-value"><?php echo $user['total_projects'] ?? '0'; ?></div>
            <div class="analytics-trend positive">
                ↑ 12% from last month
            </div>
        </div>

        <div class="analytics-card">
            <div class="analytics-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4338ca" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
            </div>
            <div class="analytics-label">Average Rating</div>
            <div class="analytics-value"><?php echo $user['average_rating'] ?? '0'; ?></div>
            <div class="analytics-trend positive">
                ↑ 0.5 from last month
            </div>
        </div>

        <div class="analytics-card">
            <div class="analytics-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4338ca" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div class="analytics-label">Years Experience</div>
            <div class="analytics-value"><?php echo $user['experience_years'] ?? '0'; ?></div>
            <div class="analytics-trend">
                Years in industry
            </div>
        </div>
    </div>
</div>

        <?php elseif ($userRole === 'businessman'): ?>
        <!-- BUSINESSMAN: Show order history -->

        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Business Informations</h3>
            <p class="text-gray-700 mt-4">Business Name:
                <?php echo $user['br_details']['business_name'] ?? 'Not specified'; ?></p>
            <p class="text-gray-700 mt-4">BR Status:
                <?php echo $user['br_details']['br_status'] ?? 'Not specified'; ?></p>
            <p class="text-gray-700 mt-4">
                BR Document:
                <?php 
                if (!empty($user['br_details']['br_document'])) {
                    $documentPath = $user['br_details']['br_document']; 
                    echo "<a href='$documentPath' download class='text-indigo-600 hover:underline'>Download</a>"; 
                } else {
                    echo 'Not specified';
                }
                ?>
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Reviews from sellers</h3>
            <div id="seller-reviews"></div>
        </div>

        <?php endif; ?>

    </main>
</body>

</html>