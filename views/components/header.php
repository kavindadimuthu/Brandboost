<html>

<head>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
</head>

<body class="font-inter bg-gray-100 text-gray-800">
<div
        class="fixed top-0 left-0 w-full bg-gradient-to-r from-[#6201A9] to-[#6a11cb] text-white py-3 px-6 flex justify-between items-center z-50 rounded-b-lg">
    <div class="text-lg font-bold">
        Brand Boost
    </div>
    <div class="flex items-center space-x-4">
        <?php
        // session_start();
//        $_SESSION['role'] = 'designer';
//        $_SESSION['user_name'] = 'John Doe';
         session_destroy();

        if (!isset($_SESSION['role'])) {
            echo '<a href="/" class="hover:text-gray-300">Home</a>
          <a class="hover:text-gray-300" href="/services">Services</a>
          <a class="hover:text-gray-300" href="/influencers">Influencers</a>
          <a class="hover:text-gray-300" href="/about">About</a>
          <a class="hover:text-gray-300" href="/contact">Contact</a>
          <a class="hover:text-gray-300" href="/faq">FAQ</a>';
        } else if ($_SESSION['role'] === 'businessman') {
            echo '<a class="hover:text-gray-300" href="/businessman/orders-list">Orders</a>
          <a class="hover:text-gray-300" href="/businessman/request-order">Request Order</a>
          <a class="hover:text-gray-300" href="/businessman/custom-packages">Custom Packages</a>
          <a class="hover:text-gray-300" href="/businessman/edit-profile">Edit Profile</a>
          <a class="hover:text-gray-300" href="/businessman/change-password">Change Password</a>';
        } else if ($_SESSION['role'] === 'influencer') {
            echo '<a class="hover:text-gray-300" href="/influencer/dashboard">Dashboard</a>
          <a class="hover:text-gray-300" href="/influencer/orders-list">Orders</a>
          <a class="hover:text-gray-300" href="/influencer/custom-packages">Custom Packages</a>
          <a class="hover:text-gray-300" href="/influencer/earnings">Earnings</a>
          <a class="hover:text-gray-300" href="/influencer/edit-profile">Edit Profile</a>
          <a class="hover:text-gray-300" href="/influencer/change-password">Change Password</a>';
        } else if ($_SESSION['role'] === 'designer') {
            echo '<a class="hover:text-gray-300" href="/designer/dashboard">Dashboard</a>
          <a class="hover:text-gray-300" href="/designer/my-gigs">My Gigs</a>
          <a class="hover:text-gray-300" href="/designer/orders-list">Orders</a>
          <a class="hover:text-gray-300" href="/designer/custom-packages">Custom Packages</a>
          <a class="hover:text-gray-300" href="/designer/earnings">Earnings</a>
          <a class="hover:text-gray-300" href="/designer/edit-profile">Edit Profile</a>
          <a class="hover:text-gray-300" href="/designer/change-password">Change Password</a>';
        }
        ?>
    </div>
    <?php if (isset($_SESSION['role']) && isset($_SESSION['user_name'])): ?>
        <div class="flex items-center space-x-4 relative">
            <div class="flex items-center space-x-4">
                <i class="fas fa-bell cursor-pointer hover:text-gray-300">
                </i>
                <i class="fas fa-comments cursor-pointer hover:text-gray-300"
                   onclick="window.location.href='/homecontroller/chat'">
                </i>
            </div>
            <div class="flex items-center cursor-pointer" onclick="toggleProfileMenu()">
                <img alt="User profile picture" class="w-9 h-9 rounded-full mr-2" height="35"
                     src="https://storage.googleapis.com/a1aa/image/BVZIkfG5F3XHY60sFbAWhIslKzm9KR8eUunlaCcIJfA5e6oPB.jpg"
                     width="35"/>
                <div>
                    <div class="text-sm font-semibold">
                        <?php echo $_SESSION['user_name']; ?>
                    </div>
                    <div class="text-xs text-gray-300">
                        <?php echo $_SESSION['role']; ?>
                    </div>
                </div>
            </div>
            <div class="absolute top-12 right-0 bg-white text-gray-800 shadow-lg rounded-lg overflow-hidden hidden"
                 id="profile-menu">
                <a class="block px-4 py-2 hover:bg-gray-100" href="/&lt;?php echo strtolower($_SESSION['role']); ?&gt;/edit-profile">
                    Profile
                </a>
                <?php if ($_SESSION['role'] === 'designer'): ?>
                    <a class="block px-4 py-2 hover:bg-gray-100" href="/designer/my-gigs">My Portfolio</a>
                <?php endif; ?>
                    <a class="block px-4 py-2 hover:bg-gray-100" href="/login">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <div class="flex space-x-4">
            <button
                    class="bg-transparent text-white font-semibold py-2 px-4 rounded-full hover:bg-white hover:text-gray-800"
                    onclick="window.location.href='/login'">
                Login
            </button>
            <button class="bg-white text-gray-800 font-semibold py-2 px-4 rounded-full hover:bg-gray-200"
                    onclick="window.location.href='/register'">
                Sign Up
            </button>
        </div>
    <?php endif; ?>
</div>
<script>
    function toggleProfileMenu() {
        const profileMenu = document.getElementById('profile-menu');
        profileMenu.classList.toggle('hidden');
    }

    window.onclick = function (event) {
        if (!event.target.matches('.profile') && !event.target.matches('.profile *')) {
            const profileMenu = document.getElementById('profile-menu');
            if (!profileMenu.classList.contains('hidden')) {
                profileMenu.classList.add('hidden');
            }
        }
    }
</script>
</body>

</html>