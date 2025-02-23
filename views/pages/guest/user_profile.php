<html lang="en">

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: #f7fafc;
            font-family: 'Inter', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0rem auto;
            /* margin-top: 3rem; */
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .bg-white {
            background-color: #ffffff;
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

        .p-6 {
            padding: 1.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
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
            border-color: #ffffff;
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
            color: #718096;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .text-indigo-700 {
            color: #4c51bf;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .text-indigo-600 {
            color: #5a67d8;
        }

        .space-x-4 {
            margin-right: -1rem;
        }

        .space-x-4>* {
            margin-right: 1rem;
        }

        .text-gray-700 {
            color: #4a5568;
        }

        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (min-width: 1280px) {
            .xl\:grid-cols-4 {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .gap-6 {
            gap: 1.5rem;
        }

        .h-40 {
            height: 10rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6201A9 0%, #6a11cb 100%);
        }

        .text-white {
            color: #ffffff;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }
    </style>
</head>


<?php
    $user = $combinedData['userData'] ?? []; // Ensure $userData is available
    $userRole = $user['role'] ?? 'guest'; // Default to 'guest' if role is missing
    $services = $combinedData['serviceData'] ?? []; // Ensure $serviceData is available
?>


<body>
  <main class="container mx-auto p-4">
    <!-- Profile Header: common for all roles -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
      <img alt="Cover Photo" class="w-full h-52 object-cover"
           src="<?php echo $user['cover_picture'] ?? '/assets/images/default_cover.jpg'; ?>" />
      <div class="p-6 flex items-center">
        <img alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-white -mt-12"
             src="<?php echo $user['profile_picture'] ?? '/assets/images/dp-empty.png'; ?>" />
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
        <?php endif; ?>

        <!-- Portfolio Highlights Section (loaded dynamically) -->
      <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-indigo-700">Portfolio Highlights</h3>
        <div class="mt-4" id="dynamic-portfolio">
          <!-- Portfolio items will be loaded here via JavaScript -->
        </div>
    </div>


        <?php if (in_array($userRole, ['influencer'])): ?>

        <!-- Design Expertise Section -->
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

    <?php if (in_array($userRole, ['designer','influencer'])): ?>
      
        
<!-- Gigs Section -->
<?php
// Extract user ID from the URL
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/'));
$userId = end($segments); // Gets the last segment (user ID)

?>

<div class="bg-white rounded-lg shadow-lg p-6 mb-8">
    <h3 class="text-lg font-semibold text-indigo-700 mb-4">Services Offered</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($services) && is_array($services)): ?>
            <?php foreach ($services as $service): ?>
                <?php
                // Ensure the service belongs to the correct user
                if (!isset($service['user_id']) || $service['user_id'] != $userId) {
                    continue;
                }

                error_log('Service Data: ' . print_r($service, true));
                error_log('Service ID: ' . $service['cover_image']);

                $serviceId = $service['service_id'] ?? '';
                $title = $service['title'] ?? 'Untitled';
                $coverImage = $service['cover_image'] ?? '/assets/images/default-service.png';
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
                error_log('Basic Price: ' . $coverImage);
                ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                    <img src="<?php echo $service['cover_image'] ?? '/assets/images/dp-empty.png'; ?>" class="w-full h-48 object-cover" alt="Service thumbnail"/>
                    <div class="p-4">
                        <h4 class="font-semibold text-lg text-gray-900 mb-2"> <?= htmlspecialchars($title) ?> </h4>
                        <p class="text-sm text-gray-600">Basic: <span class="font-semibold text-gray-800">$<?= htmlspecialchars($basicPrice) ?></span></p>
                        <p class="text-sm text-gray-600 mb-2">Premium: <span class="font-semibold text-gray-800">$<?= htmlspecialchars($premiumPrice) ?></span></p>
                        <p class="text-xs text-gray-500 mb-2">Updated: <?= htmlspecialchars($updatedAt) ?></p>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full <?= $status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                            <?= htmlspecialchars($status) ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center text-gray-700 py-4">
                No services found.
            </div>
        <?php endif; ?>
    </div>
</div>



      <!-- Analytics Section -->
      <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-indigo-700">Analytics</h3>
        <div class="mt-4">
          <p class="text-gray-700"><strong>Total Projects Completed:</strong> <?php echo $user['total_projects'] ?? '0'; ?></p>
          <p class="text-gray-700 mt-2"><strong>Average Client Rating:</strong> <?php echo $user['average_rating'] ?? '0'; ?></p>
          <p class="text-gray-700 mt-2"><strong>Years of Experience:</strong> <?php echo $user['experience_years'] ?? '0'; ?></p>
        </div>
      </div>      
      
    <?php elseif ($userRole === 'businessman'): ?>
      <!-- BUSINESSMAN: Show order history -->

      <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
  <h3 class="text-lg font-semibold text-indigo-700">Business Informations</h3>
  <p class="text-gray-700 mt-4">Buisness Name: <?php echo $user['br_details']['business_name'] ?? 'Not specified'; ?></p>
  <p class="text-gray-700 mt-4">BR Status: <?php echo $user['br_status'] ?? 'Not specified'; ?></p>
  <p class="text-gray-700 mt-4">BR Document: <?php echo $user['br_document'] ?? 'Not specified'; ?></p>
  <div id="business-info"></div>
</div>

<div class="bg-white rounded-lg shadow-lg p-6 mb-8">
  <h3 class="text-lg font-semibold text-indigo-700">Reviews from sellers</h3>
  <div id="seller-reviews"></div>
</div>

    <?php endif; ?>

  </main>
    
</body>

</html>