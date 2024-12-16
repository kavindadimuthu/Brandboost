<html>

<head>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
</head>

<body class="font-arial bg-gray-100 text-gray-800">
<div class="fixed top-0 left-0 w-full bg-gradient-to-r from-[#6201A9] to-[#6a11cb] text-white px-8 py-[15px] flex justify-between items-center z-50 rounded-b-lg">
   <div class="text-lg font-bold">
        Brand Boost
    </div>
    <div class="flex items-center space-x-8 text-[0.9rem]">
        <?php

        if (!isset($_SESSION['user']['role'])) {
            echo '<a href="/" class="hover:text-gray-300">Home</a>
          <a class="hover:text-gray-300" href="/services">Services</a>
          <a class="hover:text-gray-300" href="/influencers">Influencers</a>
          <a class="hover:text-gray-300" href="/about">About</a>
          <a class="hover:text-gray-300" href="/contact">Contact</a>
          <a class="hover:text-gray-300" href="/faq">FAQ</a>';
        } else if ($_SESSION['user']['role'] === 'businessman') {
            echo '<a class="hover:text-gray-300" href="/services">Services</a>
          <a class="hover:text-gray-300" href="/influencers">Influencers</a>
          <a class="hover:text-gray-300" href="/businessman/orders-list">Orders</a>
          <a class="hover:text-gray-300" href="/businessman/custom-packages">Custom Packages</a>';
        } else if ($_SESSION['user']['role'] === 'influencer') {
            echo '<a class="hover:text-gray-300" href="/influencer/dashboard">Dashboard</a>
          <a class="hover:text-gray-300" href="/influencer/orders-list">Orders</a>
          <a class="hover:text-gray-300" href="/influencer/custom-packages">Custom Packages</a>
          <a class="hover:text-gray-300" href="/influencer/earnings">Earnings</a>';
        } else if ($_SESSION['user']['role'] === 'designer') {
            echo '<a class="hover:text-gray-300" href="/designer/dashboard">Dashboard</a>
          <a class="hover:text-gray-300" href="/designer/my-gigs">My Gigs</a>
          <a class="hover:text-gray-300" href="/designer/orders-list">Orders</a>
          <a class="hover:text-gray-300" href="/designer/custom-packages">Custom Packages</a>
          <a class="hover:text-gray-300" href="/designer/earnings">Earnings</a>';
        }
        ?>
    </div>
    <?php if (isset($_SESSION['user']['role']) && isset($_SESSION['user']['username'])): ?>
        <div class="flex items-center space-x-4 relative">
            <div class="flex items-center space-x-4">
                <i class="fas fa-bell cursor-pointer hover:text-gray-300">
                </i>
                <i class="fas fa-comments cursor-pointer hover:text-gray-300"
                   onclick="window.location.href='/chat'">
                </i>
            </div>
            <div class="profile flex items-center cursor-pointer" onclick="toggleProfileMenu()">
                <img alt="User profile picture" class="w-9 h-9 rounded-full mr-2" height="35"
                     src="https://storage.googleapis.com/a1aa/image/BVZIkfG5F3XHY60sFbAWhIslKzm9KR8eUunlaCcIJfA5e6oPB.jpg"
                     width="35"/>
                <div class="flex flex-col items-start">
                    <div class="text-sm font-semibold">
                        <?php echo $_SESSION['user']['username']; ?>
                    </div>
                    <div class="text-xs text-gray-300">
                        <?php echo $_SESSION['user']['role']; ?>
                    </div>
                </div>
            </div>
            <div class="absolute top-12 right-0 bg-white text-gray-800 text-start text-[0.8rem] shadow-lg rounded-lg overflow-hidden hidden"
                 id="profile-menu">

                <a class="block px-4 py-2 hover:bg-gray-100" href="/<?php echo strtolower($_SESSION['user']['role']); ?>/edit-profile">
                    Change Profile
                </a>
                <a class="block px-4 py-2 hover:bg-gray-100" href="/<?php echo strtolower($_SESSION['user']['role']); ?>/change-password">
                    Change Password
                </a>
                <?php if ($_SESSION['user']['role'] === 'designer' || $_SESSION['user']['role'] === 'influencer'): ?>
                    <a class="block px-4 py-2 hover:bg-gray-100" href="/<?php echo strtolower($_SESSION['user']['role']); ?>/payout-methods">
                        Payout Methods
                    </a>
                <?php endif; ?>
                <?php if ($_SESSION['user']['role'] === 'designer'): ?>
                    <a class="block px-4 py-2 hover:bg-gray-100" href="/designer/my-gigs">My Portfolio</a>
                <?php endif; ?>
                <a class="block px-4 py-2 hover:bg-gray-100" href="/auth/logout">Logout</a>
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