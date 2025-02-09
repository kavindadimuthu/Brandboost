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
$user = $_SESSION['user'] ?? null;
$userRole = $user['role'] ?? 'guest';
?>

<body>
  <main class="container mx-auto p-4">
    <!-- Profile Header: common for all roles -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
      <img alt="Cover Photo" class="w-full h-52 object-cover"
           src="<?php echo $user['cover_photo'] ?? '/assets/images/default-cover.jpg'; ?>" />
      <div class="p-6 flex items-center">
        <img alt="Profile Picture" class="w-24 h-24 rounded-full border-4 border-white -mt-12"
             src="<?php echo $user['profile_picture'] ?? '/assets/images/dp-empty.png'; ?>" />
        <div class="ml-6">
          <h1 class="text-2xl font-bold"><?php echo $user['username'] ?? 'Unknown User'; ?></h1>
          <p class="text-gray-600"><?php echo ucfirst($userRole); ?></p>
        </div>
      </div>
    </div>

    <!-- Bio Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-indigo-700">Bio</h3>
        <p class="text-gray-700 mt-4"></p>
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
      <!-- Portfolio Highlights Section (loaded dynamically) -->
      <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-indigo-700">Portfolio Highlights</h3>
        <div class="mt-4" id="dynamic-portfolio">
          <!-- Portfolio items will be loaded here via JavaScript -->
        </div>
    </div>


    <!-- Gigs Section -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-8">
<?php if (in_array($userRole, ['influencer'])): ?>
  <h3 class="text-lg font-semibold text-indigo-700">Promotions</h3>
  <?php endif; ?>

  <?php if (in_array($userRole, ['designer'])): ?>
  <h3 class="text-lg font-semibold text-indigo-700">Gigs</h3>
  <?php endif; ?>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6" id="gigs-container">
    <!-- Gig items will be loaded here dynamically via JavaScript -->
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
        <h3 class="text-lg font-semibold text-indigo-700">Reviews from sellers</h3>
        <p class="text-gray-700 mt-4">Order history and details go here...</p>
      </div>
    <?php endif; ?>

  </main>

  <script>
        // let UserData;

        document.addEventListener('DOMContentLoaded', async () => {
            // Get the gig ID from the URL path
            const pathSegments = window.location.pathname.split('/');
            const userId = pathSegments[pathSegments.length - 1]; // Get the last segment

            if (!userId) {
            throw new Error('User ID is required in the URL');
            }

            const response = await fetch(`/api/user/${userId}?service=true&packages=true`);
            const userData = await response.json();

            // console.log(result);
            // Update DOM elements with user data
            document.querySelector('h1.text-2xl').textContent = userData.name || 'Name Not Available';
            document.querySelector('img.w-24.h-24').src = userData.profile_picture || 'default-profile-picture.jpg';
            document.querySelector('p.text-gray-700.mt-4').textContent = userData.bio || 'No bio available';
            document.querySelector('#userRole-container').textContent = userData.role || 'role not available';
            
            // Update page title
            document.title = `${userData.name}'s Profile`;
        });
    </script>

    
<script>
// Fetch gigs data using your updated parameters and render them into the gigs-container
document.addEventListener('DOMContentLoaded', async () => {
  try {
    // Build query parameters based on your changes (current_user: true)
    const queryParams = new URLSearchParams({ current_user: true });
    // Fetch gigs data from your API endpoint (adjust the URL as needed)
    const response = await fetch(`/api/services?${queryParams}`);
    const result = await response.json();
    const gigs = result.services;

    console.log(gigs);
    
    // Render the gigs using the renderGigs function
    renderGigs(gigs);
  } catch (error) {
    console.error('Error fetching gigs:', error);
  }
});

// Function to render the gigs into the gigs-container
function renderGigs(gigs) {
  const gigsContainer = document.getElementById('gigs-container');
  
  if (!gigs || gigs.length === 0) {
    gigsContainer.innerHTML = '<p class="text-gray-600">No gigs available at the moment.</p>';
    return;
  }
  
  gigs.forEach(gig => {
    const basicPackage = gig.packages.find(pkg => pkg.package_type === 'basic');
    const gigHTML = `
      <div class="bg-white rounded-lg shadow-lg p-4"  onclick="window.location.href='/services/${gig.service_id}'" style="cursor: pointer;">
        <img alt="Gig Image for ${escapeHtml(gig.title)}" 
             class="w-full h-40 object-cover rounded-lg" 
             <img src="/${gig.cover_image}" class="gig-thumb me-2" alt="thumbnail">
        <h4 class="text-md font-semibold text-gray-700 mt-2">${escapeHtml(gig.title)}</h4>
        <p class="text-gray-600 text-sm mt-2">Starting at $${escapeHtml(basicPackage.price)}</p>
      </div>
    `;
    gigsContainer.innerHTML += gigHTML;
  });
}

// Utility function to safely escape HTML
function escapeHtml(text) {
  const div = document.createElement('div');
  div.innerText = text;
  return div.innerHTML;
}
</script>
    
</body>

</html>