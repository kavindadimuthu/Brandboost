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
            margin: 2rem auto;
            margin-top: 3rem;
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

<body>
    <div class="container">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <img alt="Cover Photo" class="w-full h-52 object-cover"
                src="https://storage.googleapis.com/a1aa/image/28EeM6YK3QTeSEYHMLCCHdjPfJfE6i7HFbbhDcKSh3yiEwZPB.jpg" />
            <div class="p-6 flex items-center">
                <img alt="Business Logo" class="w-24 h-24 rounded-full border-4 border-white -mt-12"
                    src="https://storage.googleapis.com/a1aa/image/nlshiA8AmxaAGtXzi0iEoo1NG7fkf4vtS5fSTkeblFSJ8wZPB.jpg" />
                <div class="ml-6">
                    <h1 class="text-2xl font-bold">Business Name</h1>
                    <p class="text-gray-600">Brief Description</p>
                </div>
            </div>
        </div>
        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Contact Information</h3>
            <div class="mt-4">
                <p class="flex items-center text-gray-600">
                    <i class="fas fa-envelope mr-2"></i>
                    business@example.com
                </p>
                <p class="flex items-center text-gray-600 mt-2">
                    <i class="fas fa-phone-alt mr-2"></i>
                    +1234567890
                </p>
                <p class="flex items-center text-gray-600 mt-2">
                    <i class="fas fa-globe mr-2"></i>
                    <a class="text-indigo-600" href="https://businesswebsite.com">https://businesswebsite.com</a>
                </p>
                <div class="flex mt-4 space-x-4">
                    <a class="text-gray-600" href="https://linkedin.com/in/business">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a class="text-gray-600" href="https://facebook.com/business">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a class="text-gray-600" href="https://instagram.com/business">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Business Overview -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Business Overview</h3>
            <p class="text-gray-700 mt-4">Detailed Description of Services Offered</p>
            <p class="text-gray-700 mt-2">Industry Type</p>
            <p class="text-gray-700 mt-2">City, State, Country</p>
        </div>
        <!-- Portfolio Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Portfolio</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img alt="Work Sample 1" class="w-full h-40 object-cover rounded-lg"
                        src="https://storage.googleapis.com/a1aa/image/Wwpy5K437JalANMpYCnJW6fgR15RfLBuAQagUCgFSTufd4snA.jpg" />
                    <p class="text-gray-600 text-sm mt-2">Description of Work</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img alt="Work Sample 2" class="w-full h-40 object-cover rounded-lg"
                        src="https://storage.googleapis.com/a1aa/image/r4p4WRK0k5qEGFbk2C3AgMC313tjPKLHsj0uGBy5QFnvDn9E.jpg" />
                    <p class="text-gray-600 text-sm mt-2">Description of Work</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img alt="Work Sample 3" class="w-full h-40 object-cover rounded-lg"
                        src="https://storage.googleapis.com/a1aa/image/Qxtlbz1H2VIzBhfyJCMMyRCLYtsyJElAMzQPO7mkVgYgHO7JA.jpg" />
                    <p class="text-gray-600 text-sm mt-2">Description of Work</p>
                </div>
            </div>
        </div>
        <!-- Call to Action -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Get in Touch</h3>
            <div class="mt-4 flex space-x-4">
                <button class="gradient-bg text-white px-4 py-2 rounded-lg">Contact for Collaboration</button>
                <button class="gradient-bg text-white px-4 py-2 rounded-lg">Request a Quote</button>
            </div>
        </div>
        <!-- Analytics Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">Analytics</h3>
            <div class="mt-4">
                <p class="text-gray-700"><strong>Number of Collaborations:</strong> 50</p>
                <p class="text-gray-700 mt-2"><strong>Average Rating:</strong> 4.5</p>
                <p class="text-gray-700 mt-2"><strong>Number of Reviews:</strong> 30</p>
            </div>
        </div>
    </div>
</body>

</html>