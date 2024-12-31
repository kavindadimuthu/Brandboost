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

<body>
    <div class="container">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <img alt="Cover Photo of a creative workspace with design tools" class="w-full h-52 object-cover"
                height="200"
                src="https://storage.googleapis.com/a1aa/image/zdP2me4yHzUAcyQqJHQwjpQbwcIK2ZXubqgYsLl9OPaY6O7JA.jpg"
                width="1200" />
            <div class="p-6 flex items-center">
                <img alt="Profile Picture of Ravi Fernando" class="w-24 h-24 rounded-full border-4 border-white -mt-12"
                    height="100"
                    src="https://storage.googleapis.com/a1aa/image/cHPenI4r0MSgNKvpHTTQu8HgtqOTcVjayefFEeD7FZ3gS3ZPB.jpg"
                    width="100" />
                <div class="ml-6">
                    <h1 class="text-2xl font-bold">
                        Ravi Fernando
                    </h1>
                    <p class="text-gray-600">
                        Graphic &amp; UX/UI Design
                    </p>
                </div>
            </div>
        </div>
        <!-- Bio Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Bio
            </h3>
            <p class="text-gray-700 mt-4">
                Ravi Fernando is a seasoned designer specializing in graphic and UX/UI design. With over 10 years of
                experience, Ravi has a unique style that blends creativity with functionality. His work is known for its
                clean aesthetics and user-centric approach.
            </p>
            <p class="text-gray-700 mt-2">
                Location: Colombo, Sri Lanka
            </p>
        </div>
        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Contact Information
            </h3>
            <div class="mt-4">
                <p class="flex items-center text-gray-600">
                    <i class="fas fa-envelope mr-2">
                    </i>
                    ravi.fernando@example.com
                </p>
                <p class="flex items-center text-gray-600 mt-2">
                    <i class="fas fa-phone-alt mr-2">
                    </i>
                    +94123456789
                </p>
                <p class="flex items-center text-gray-600 mt-2">
                    <i class="fas fa-globe mr-2">
                    </i>
                    <a class="text-indigo-600" href="https://ravifernando.com">
                        https://ravifernando.com
                    </a>
                </p>
                <div class="flex mt-4 space-x-4">
                    <a class="text-gray-600" href="https://instagram.com/ravi_fernando">
                        <i class="fab fa-instagram">
                        </i>
                    </a>
                    <a class="text-gray-600" href="https://behance.net/ravi_fernando">
                        <i class="fab fa-behance">
                        </i>
                    </a>
                    <a class="text-gray-600" href="https://dribbble.com/ravi_fernando">
                        <i class="fab fa-dribbble">
                        </i>
                    </a>
                    <a class="text-gray-600" href="https://linkedin.com/in/ravi_fernando">
                        <i class="fab fa-linkedin">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Design Expertise -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Design Expertise
            </h3>
            <div class="mt-4">
                <h4 class="text-md font-semibold text-indigo-700">
                    Specialties:
                </h4>
                <p class="text-gray-700 mt-2">
                    Graphic Design
                </p>
                <p class="text-gray-700 mt-2">
                    UX/UI Design
                </p>
                <p class="text-gray-700 mt-2">
                    Branding
                </p>
                <h4 class="text-md font-semibold text-indigo-700 mt-4">
                    Tools Used:
                </h4>
                <p class="text-gray-700 mt-2">
                    Adobe Photoshop
                </p>
                <p class="text-gray-700 mt-2">
                    Sketch
                </p>
                <p class="text-gray-700 mt-2">
                    Figma
                </p>
            </div>
        </div>
        <!-- Portfolio Highlights -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Portfolio Highlights
            </h3>
            <div class="mt-4">
                <h4 class="text-md font-semibold text-indigo-700">
                    Featured Projects:
                </h4>
                <!-- <div class="mt-4">
                    <h5 class="text-sm font-semibold text-gray-700">
                        Project Title: Modern Website Redesign
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mt-2">
                        <img alt="Project Image 1 of a modern website redesign"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/edeCiwtf2Ke6XTWWeecgtwiYlNiACnM2ckRr1rc6LaLsKdn9E.jpg"
                            width="300" />
                        <img alt="Project Image 2 of a modern website redesign"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/gKatfTFEbywTMirfNHYkIBe2hnYhaIxWreZsXnlH5npNS3ZPB.jpg"
                            width="300" />
                        <img alt="Project Image 3 of a modern website redesign"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/RPtiXCIQ4rYpJJABlF5fznDaEoWvdZPk30Fwqm3N73es0d2TA.jpg"
                            width="300" />
                        <img alt="Project Image 4 of a modern website redesign"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/RLX5mcoT39p9J1ynOpdLjlpUAUWVS28BXkDWZp1wzefm0d2TA.jpg"
                            width="300" />
                        <img alt="Project Image 5 of a modern website redesign"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/MShTwQjRkV6OOtf8W0sXU8bbEtI4sPFB2aZzWcs3gZga6O7JA.jpg"
                            width="300" />
                    </div>
                    <p class="text-gray-600 text-sm mt-2">
                        A complete redesign of a corporate website to enhance user experience and visual appeal. Ravi
                        was responsible for the UX/UI design and overall visual direction.
                    </p>
                </div> -->
                <!-- <div class="mt-4">
                    <h5 class="text-sm font-semibold text-gray-700">
                        Project Title: Branding for a Tech Startup
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mt-2">
                        <img alt="Project Image 1 of branding for a tech startup"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/vRRxgAWXjjKNMdpqcg2Zeue0OlfnZsdgW5jG5Bvt1Jbap7snA.jpg"
                            width="300" />
                        <img alt="Project Image 2 of branding for a tech startup"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/sZo5TLuMc4qOIxH6GxbpeRjuEie5jtLwmeiVwSbD20Fvp7snA.jpg"
                            width="300" />
                        <img alt="Project Image 3 of branding for a tech startup"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/Suv9boHiQKLNGFYaUnZek8DTPAcuedlxCH0mxawzeD6eS3ZPB.jpg"
                            width="300" />
                        <img alt="Project Image 4 of branding for a tech startup"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/IqCJRKBThD6UCFJeJaQH11orcQ2jdzWJXBnqTXroHBJR6O7JA.jpg"
                            width="300" />
                        <img alt="Project Image 5 of branding for a tech startup"
                            class="w-full h-40 object-cover rounded-lg" height="200"
                            src="https://storage.googleapis.com/a1aa/image/Bb5eFZtbJPwafEfurAea7h3RBIDEf5ZodkmeyoloNB5lMdn9E.jpg"
                            width="300" />
                    </div>
                    <p class="text-gray-600 text-sm mt-2">
                        Developed a comprehensive branding strategy for a new tech startup, including logo design, color
                        palette, and brand guidelines. Ravi led the creative direction and execution.
                    </p>
                </div> -->

                <div class="dynamic-portfolio" id="dynamic-portfolio"></div>

                <!-- dynamic portfolio -->
                <script>
                    document.addEventListener('DOMContentLoaded', async () => {
                        try {
                            const response = await fetch(`/DesignerDataController/viewPortfolio`);
                            const portfolio = await response.json();

                            console.log(portfolio[0]);

                            renderPortfolioDetails(portfolio);
                        } catch (error) {
                            console.error('Error fetching portfolio details:', error);
                        }

                    });

                    function renderPortfolioDetails(portfolio) {
                        const portfolioContainer = document.getElementById('dynamic-portfolio');

                        console.log(portfolio);

                        portfolio.forEach(item => {
                            const portfolioHTML = `
                            <h5 class="text-sm font-semibold text-gray-700">
                            Project Title: ${escapeHtml(item.title)}
                            </h5>
                            <p class="text-gray-600 text-sm mt-2">${escapeHtml(item.description)}</p>
                            <div class="images">
                                <div class="image-gallery grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mt-2">
                                    ${item.cover_image ? `<img src="/${escapeHtml(item.cover_image)}" alt="Cover Image"
                                    class="w-full h-40 object-cover rounded-lg" height="200px">` : ''}
                                    ${item.first_image ? `<img src="/${escapeHtml(item.first_image)}" alt="First Image"
                                    class="w-full h-40 object-cover rounded-lg" height="200px">` : ''}
                                    ${item.second_image ? `<img src="/${escapeHtml(item.second_image)}" alt="Second Image" 
                                    class="w-full h-40 object-cover rounded-lg" height="200px">` : ''}
                                    ${item.third_image ? `<img src="/${escapeHtml(item.third_image)}" alt="Third Image" 
                                    class="w-full h-40 object-cover rounded-lg" height="200px">` : ''}
                                    ${item.fourth_image ? `<img src="/${escapeHtml(item.fourth_image)}" alt="Fourth Image" 
                                    class="w-full h-40 object-cover rounded-lg" height="200px">` : ''}
                                </div>
                            </div>
                `;
                            portfolioContainer.innerHTML += portfolioHTML;
                        });

                    }

                    function escapeHtml(text) {
                        const div = document.createElement('div');
                        div.innerText = text;
                        return div.innerHTML;
                    }
                </script>
                <!-- dynamic portfolio ends -->

            </div>
        </div>
        <!-- Client Testimonials -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Client Testimonials
            </h3>
            <div class="mt-4">
                <p class="text-gray-700">
                    "Ravi's design work exceeded our expectations. His attention to detail and creativity brought our
                    vision to life." - John Doe, CEO of TechCorp
                </p>
                <p class="text-gray-700 mt-2">
                    "Working with Ravi was a fantastic experience. He understood our needs and delivered exceptional
                    results." - Jane Smith, Marketing Director at Creative Solutions
                </p>
            </div>
        </div>
        <!-- Services Offered -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Services Offered
            </h3>
            <div class="mt-4">
                <p class="text-gray-700">
                    <strong>
                        Service Name:
                    </strong>
                    Logo Design
                </p>
                <p class="text-gray-700 mt-2">
                    <strong>
                        Price:
                    </strong>
                    $300 - $800
                </p>
                <p class="text-gray-700 mt-4">
                    <strong>
                        Service Name:
                    </strong>
                    Website Design
                </p>
                <p class="text-gray-700 mt-2">
                    <strong>
                        Price:
                    </strong>
                    $1000 - $5000
                </p>
                <p class="text-gray-700 mt-4">
                    <strong>
                        Service Name:
                    </strong>
                    Branding Consultation
                </p>
                <p class="text-gray-700 mt-2">
                    <strong>
                        Price:
                    </strong>
                    $500 - $2000
                </p>
            </div>
        </div>
        <!-- Gigs Section -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Gigs
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6">
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img alt="Gig Image for Logo Design" class="w-full h-40 object-cover rounded-lg" height="200"
                        src="https://storage.googleapis.com/a1aa/image/oPbkknGr7fT6IaFpDZEh5oBtrcN6AkqdtCiudvpGsrCQ6O7JA.jpg"
                        width="300" />
                    <h4 class="text-md font-semibold text-gray-700 mt-2">
                        Logo Design
                    </h4>
                    <p class="text-gray-600 text-sm mt-2">
                        Starting at $300
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img alt="Gig Image for Website Design" class="w-full h-40 object-cover rounded-lg" height="200"
                        src="https://storage.googleapis.com/a1aa/image/FCyIAWv8lTYLMROa0KwZCKH37xVEefaLWP5ZaQNnh3efR3ZPB.jpg"
                        width="300" />
                    <h4 class="text-md font-semibold text-gray-700 mt-2">
                        Website Design
                    </h4>
                    <p class="text-gray-600 text-sm mt-2">
                        Starting at $1000
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img alt="Gig Image for Branding Consultation" class="w-full h-40 object-cover rounded-lg"
                        height="200"
                        src="https://storage.googleapis.com/a1aa/image/nseMLfVsPDp1w0lw9xnAkFMnfHB11QBNQ4DPAMnmU7NLp7snA.jpg"
                        width="300" />
                    <h4 class="text-md font-semibold text-gray-700 mt-2">
                        Branding Consultation
                    </h4>
                    <p class="text-gray-600 text-sm mt-2">
                        Starting at $500
                    </p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <img alt="Gig Image for UX/UI Design" class="w-full h-40 object-cover rounded-lg" height="200"
                        src="https://storage.googleapis.com/a1aa/image/aGSe54vHvgUQIiHskC1ODfpNdcEJL0Q75ETYbhDnRJj00d2TA.jpg"
                        width="300" />
                    <h4 class="text-md font-semibold text-gray-700 mt-2">
                        UX/UI Design
                    </h4>
                    <p class="text-gray-600 text-sm mt-2">
                        Starting at $800
                    </p>
                </div>
            </div>
        </div>
        <!-- Call to Action -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Call to Action
            </h3>
            <div class="mt-4 flex space-x-4">
                <button class="gradient-bg text-white px-4 py-2 rounded-lg">
                    Hire Ravi Fernando
                </button>
                <button class="gradient-bg text-white px-4 py-2 rounded-lg">
                    View Full Portfolio
                </button>
            </div>
        </div>
        <!-- Analytics -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-indigo-700">
                Analytics
            </h3>
            <div class="mt-4">
                <p class="text-gray-700">
                    <strong>
                        Total Projects Completed:
                    </strong>
                    120
                </p>
                <p class="text-gray-700 mt-2">
                    <strong>
                        Average Client Rating:
                    </strong>
                    4.9 out of 5
                </p>
                <p class="text-gray-700 mt-2">
                    <strong>
                        Years of Experience:
                    </strong>
                    10
                </p>
            </div>
        </div>
    </div>
</body>

</html>