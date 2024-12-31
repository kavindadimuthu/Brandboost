<html lang="en">
 <head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <style>
   .relative .edit-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px;
            border-radius: 50%;
            cursor: pointer;
        }
  </style>
  <script>
   document.addEventListener('DOMContentLoaded', function () {
            const addPortfolioButton = document.getElementById('add-portfolio-button');
            const portfolioContainer = document.getElementById('portfolio-container');
            const addSocialMediaButton = document.getElementById('add-social-media-button');
            const socialMediaContainer = document.getElementById('social-media-container');

            addPortfolioButton.addEventListener('click', function () {
                const portfolioGroup = document.createElement('div');
                portfolioGroup.classList.add('portfolio-group', 'mb-8', 'p-4', 'border', 'border-gray-300', 'rounded-lg');

                portfolioGroup.innerHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">Portfolio</h4>
                        <button type="button" class="text-red-500 remove-portfolio"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group mb-4">
                            <label class="block font-semibold mb-2" for="portfolio-title">
                                Portfolio Title
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-title" type="text" placeholder="Project Title"/>
                        </div>
                        <div class="form-group mb-4">
                            <label class="block font-semibold mb-2" for="portfolio-cover-image">
                                Cover Image URL
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-cover-image" type="url" placeholder="https://placehold.co/300x200"/>
                        </div>
                        <div class="form-group mb-4">
                            <label class="block font-semibold mb-2" for="portfolio-first-image">
                                First Image URL
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-first-image" type="url" placeholder="https://placehold.co/300x200"/>
                        </div>
                        <div class="form-group mb-4">
                            <label class="block font-semibold mb-2" for="portfolio-second-image">
                                Second Image URL
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-second-image" type="url" placeholder="https://placehold.co/300x200"/>
                        </div>
                        <div class="form-group mb-4">
                            <label class="block font-semibold mb-2" for="portfolio-third-image">
                                Third Image URL
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-third-image" type="url" placeholder="https://placehold.co/300x200"/>
                        </div>
                        <div class="form-group mb-4">
                            <label class="block font-semibold mb-2" for="portfolio-fourth-image">
                                Fourth Image URL
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-fourth-image" type="url" placeholder="https://placehold.co/300x200"/>
                        </div>
                        <div class="form-group mb-4 col-span-1 md:col-span-2">
                            <label class="block font-semibold mb-2" for="portfolio-description">
                                Portfolio Description
                            </label>
                            <textarea class="w-full p-2 border border-gray-300 rounded" name="portfolio-description" rows="4" placeholder="Project Description"></textarea>
                        </div>
                    </div>
                `;

                portfolioContainer.appendChild(portfolioGroup);

                portfolioGroup.querySelector('.remove-portfolio').addEventListener('click', function () {
                    portfolioGroup.remove();
                });
            });

            addSocialMediaButton.addEventListener('click', function () {
                const socialMediaGroup = document.createElement('div');
                socialMediaGroup.classList.add('social-media-group', 'mb-4', 'p-4', 'border', 'border-gray-300', 'rounded-lg');

                socialMediaGroup.innerHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">Social Media</h4>
                        <button type="button" class="text-red-500 remove-social-media"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="form-group mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <label class="block font-semibold mb-2" for="social-media-platform">
                                Platform Name
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="social-media-platform" type="text" placeholder="Platform Name"/>
                        </div>
                        <div class="w-1/2">
                            <label class="block font-semibold mb-2" for="social-media-link">
                                Profile Link
                            </label>
                            <input class="w-full p-2 border border-gray-300 rounded" name="social-media-link" type="url" placeholder="https://example.com"/>
                        </div>
                    </div>
                `;

                socialMediaContainer.appendChild(socialMediaGroup);

                socialMediaGroup.querySelector('.remove-social-media').addEventListener('click', function () {
                    socialMediaGroup.remove();
                });
            });

            // Handle cover photo upload
            const coverPhotoInput = document.getElementById('cover-photo-input');
            const coverPhoto = document.getElementById('cover-photo');
            const coverPhotoEditIcon = document.getElementById('cover-photo-edit-icon');

            coverPhotoEditIcon.addEventListener('click', function () {
                coverPhotoInput.click();
            });

            coverPhotoInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        coverPhoto.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle profile photo upload
            const profilePhotoInput = document.getElementById('profile-photo-input');
            const profilePhoto = document.getElementById('profile-photo');
            const profilePhotoEditIcon = document.getElementById('profile-photo-edit-icon');

            profilePhotoEditIcon.addEventListener('click', function () {
                profilePhotoInput.click();
            });

            profilePhotoInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        profilePhoto.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
  </script>
 </head>
 <body class="bg-gray-100 font-sans">
  <div class="container mx-auto mt-10 p-6">
   <!-- Profile Header -->
   <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8 relative">
    <img alt="Cover Photo of a creative workspace with design tools" class="w-full h-52 object-cover" height="200" id="cover-photo" src="https://storage.googleapis.com/a1aa/image/GOWeaYbBRzTWCq4Z7q3E4s7v6SL5LHa2gNCJAE6NG275UMAKA.jpg" width="1200"/>
    <input accept="image/*" class="hidden" id="cover-photo-input" type="file"/>
    <i class="fas fa-edit edit-icon" id="cover-photo-edit-icon">
    </i>
    <div class="p-6 flex items-center relative">
     <img alt="Profile Picture of Ravi Fernando" class="w-24 h-24 rounded-full border-4 border-white -mt-12" height="100" id="profile-photo" src="https://storage.googleapis.com/a1aa/image/FRkKO5xHkyJAIFID04eyhjzxjpS3mA3vXFYkEcSf8xs1pYAUA.jpg" width="100"/>
     <input accept="image/*" class="hidden" id="profile-photo-input" type="file"/>
     <i class="fas fa-edit edit-icon" id="profile-photo-edit-icon" style="top: 0; right: 0;">
     </i>
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
   <!-- Update Profile Form -->
   <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
    <h3 class="text-lg font-semibold text-indigo-700">
     Update Profile
    </h3>
    <form>
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="name">
       Name
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="name" name="name" type="text" value="Ravi Fernando"/>
     </div>
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="title">
       Title
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="title" name="title" type="text" value="Graphic &amp; UX/UI Design"/>
     </div>
     <!-- Bio Section Update -->
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="bio">
       Bio
      </label>
      <textarea class="w-full p-2 border border-gray-300 rounded" id="bio" name="bio" rows="4">Ravi Fernando is a seasoned designer specializing in graphic and UX/UI design. With over 10 years of experience, Ravi has a unique style that blends creativity with functionality. His work is known for its clean aesthetics and user-centric approach.</textarea>
     </div>
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="location">
       Location
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="location" name="location" type="text" value="Colombo, Sri Lanka"/>
     </div>
     <!-- Contact Information Update -->
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="email">
       Email
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="email" name="email" type="email" value="ravi.fernando@example.com"/>
     </div>
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="phone">
       Phone
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="phone" name="phone" type="tel" value="+94123456789"/>
     </div>
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="website">
       Website
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="website" name="website" type="url" value="https://ravifernando.com"/>
     </div>
     <!-- Social Media Links Update -->
     <div id="social-media-container">
      <div class="social-media-group mb-4 p-4 border border-gray-300 rounded-lg">
       <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-semibold">
         Social Media
        </h4>
        <button class="text-red-500 remove-social-media" type="button">
         <i class="fas fa-times">
         </i>
        </button>
       </div>
       <div class="form-group mb-4 flex space-x-4">
        <div class="w-1/2">
         <label class="block font-semibold mb-2" for="social-media-platform">
          Platform Name
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="social-media-platform" type="text" placeholder="Platform Name"/>
        </div>
        <div class="w-1/2">
         <label class="block font-semibold mb-2" for="social-media-link">
          Profile Link
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="social-media-link" type="url" placeholder="https://example.com"/>
        </div>
       </div>
      </div>
     </div>
     <div class="form-group mb-4">
      <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center" id="add-social-media-button" type="button">
       <i class="fas fa-plus mr-2">
       </i>
       Add Another Social Media Link
      </button>
     </div>
     <!-- Design Expertise Update -->
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="specialties">
       Specialties
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="specialties" name="specialties" type="text" value="Graphic Design, UX/UI Design, Branding"/>
     </div>
     <div class="form-group mb-4">
      <label class="block font-semibold mb-2" for="tools">
       Tools Used
      </label>
      <input class="w-full p-2 border border-gray-300 rounded" id="tools" name="tools" type="text" value="Adobe Photoshop, Sketch, Figma"/>
     </div>
     <!-- Add Portfolio Section -->
     <div id="portfolio-container">
      <div class="portfolio-group mb-8 p-4 border border-gray-300 rounded-lg">
       <div class="flex justify-between items-center mb-4">
        <h4 class="text-lg font-semibold">
         Portfolio
        </h4>
        <button class="text-red-500 remove-portfolio" type="button">
         <i class="fas fa-times">
         </i>
        </button>
       </div>
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="form-group mb-4">
         <label class="block font-semibold mb-2" for="portfolio-title">
          Portfolio Title
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-title" type="text" placeholder="Project Title"/>
        </div>
        <div class="form-group mb-4">
         <label class="block font-semibold mb-2" for="portfolio-cover-image">
          Cover Image URL
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-cover-image" type="url" placeholder="https://placehold.co/300x200"/>
        </div>
        <div class="form-group mb-4">
         <label class="block font-semibold mb-2" for="portfolio-first-image">
          First Image URL
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-first-image" type="url" placeholder="https://placehold.co/300x200"/>
        </div>
        <div class="form-group mb-4">
         <label class="block font-semibold mb-2" for="portfolio-second-image">
          Second Image URL
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-second-image" type="url" placeholder="https://placehold.co/300x200"/>
        </div>
        <div class="form-group mb-4">
         <label class="block font-semibold mb-2" for="portfolio-third-image">
          Third Image URL
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-third-image" type="url" placeholder="https://placehold.co/300x200"/>
        </div>
        <div class="form-group mb-4">
         <label class="block font-semibold mb-2" for="portfolio-fourth-image">
          Fourth Image URL
         </label>
         <input class="w-full p-2 border border-gray-300 rounded" name="portfolio-fourth-image" type="url" placeholder="https://placehold.co/300x200"/>
        </div>
        <div class="form-group mb-4 col-span-1 md:col-span-2">
         <label class="block font-semibold mb-2" for="portfolio-description">
          Portfolio Description
         </label>
         <textarea class="w-full p-2 border border-gray-300 rounded" name="portfolio-description" rows="4" placeholder="Project Description"></textarea>
        </div>
       </div>
      </div>
     </div>
     <div class="form-group mb-4">
      <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg flex items-center" id="add-portfolio-button" type="button">
       <i class="fas fa-plus mr-2">
       </i>
       Add Another Portfolio
      </button>
     </div>
     <div class="form-group">
      <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg" type="submit">
       Update Profile
      </button>
     </div>
    </form>
   </div>
  </div>
 </body>
</html>