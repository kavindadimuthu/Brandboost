<html>
 <head>
  <title>
   Profile Page
  </title>
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/> -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet"/> -->
  <link rel="stylesheet" href="../../styles/designer/index.css">
    <link rel="stylesheet" href="../../styles/common/header.css">
  <style>



        .profile-header {
            position: relative;
            background-color: white;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .cover-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .profile-header-content {
            display: flex;
            align-items: center;
            padding: 20px;
            position: relative;
        }
        .profile-picture{
            position: relative;
            top: -50px;
        }
        .profile-header-content img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border: 5px solid white;
        }
        .profile-header-content .info {
            flex-grow: 1;
            /* margin-top: -30px; */
        }
        .profile-header-content .info h1 {
            margin: 0;
            font-size: 20px;
        }
        .profile-header-content .info p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }
        .profile-header-content .info .location {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 14px;
        }
        .profile-header-content .info .location i {
            margin-right: 5px;
        }
        .profile-header-content .actions {
            display: flex;
            align-items: center;
        }
        .profile-header-content .actions i {
            margin: 0 10px;
            cursor: pointer;
        }
        .platform-icons {
            display: flex;
            margin-top: 10px;
        }
        .platform-icons img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
    
        .content {
            display: flex;
            justify-content: space-between;
        }
        .content .main {
            width: 68%;
            /* background-color: white; */
            border-radius: 10px;
            /* padding: 20px; */
        }
        .content .sidebar {
            width: 30%;
        }
        .content .sidebar .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .content .sidebar .card h3 {
            margin-top: 0;
            font-size: 16px;
            color: #4b0082;
        }
        .content .sidebar .card .details p {
            margin: 10px 0;
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #4b0082;
        }
        .content .sidebar .card .details p i {
            margin-right: 10px;
            color: #666;
        }
        .content .sidebar .card .details p span {
            color: #4b0082;
        }
        .content .main .section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }
        .content .main .section h3 {
            margin-top: 0;
            font-size: 16px;
            color: #4b0082;
        }
        .content .main .section p {
            font-size: 14px;
            color: #333;
        }
        .content .main .ask-me-about {
            display: flex;
            flex-wrap: wrap;
        }
        .content .main .ask-me-about .tag {
            background-color: #f5f7fb;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 5px;
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        .content .main .ask-me-about .tag i {
            margin-right: 10px;
            color: #00c853;
        }
        .portfolio {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .portfolio .project {
            background-color: white;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .portfolio .project img {
            width: 100%;
            border-radius: 10px;
        }
        .portfolio .project h4 {
            margin: 10px 0 5px;
            font-size: 14px;
            color: #4b0082;
        }
        .portfolio .project p {
            font-size: 12px;
            color: #666;
        }
  </style>
 </head>
 <body>
 <div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">


   <div class="profile-header">
    <img alt="Cover Photo" class="cover-photo" src="../../assets/aboutBanner.jpg"/>
    <div class="profile-header-content">
     <img class="profile-picture" alt="Profile Picture" height="100" src="../../assets/images/success-stories-users/Avatar 108.png" width="100"/>
     <div class="info">
      <h1>
       Assaf Rappaport
      </h1>
      <p>
       VP of Customer Operations
      </p>
      <div class="location">
       <i class="fas fa-map-marker-alt">
       </i>
       <span>
        San Francisco, CA USA
       </span>
      </div>
      <div class="platform-icons">
       <img alt="Platform Icon 1" height="30" src="../../assets/fblogo.png" width="30"/>
       <img alt="Platform Icon 2" height="30" src="../../assets/instalogo.png" width="30"/>
       <img alt="Platform Icon 3" height="30" src="../../assets/images/youtubelogo.png" width="30"/>
       <img alt="Platform Icon 4" height="30" src="../../assets/images/xlogo.png" width="30"/>
      </div>
     </div>
     <div class="actions">
      <i class="fas fa-edit">
      </i>
      <i class="fas fa-share-alt">
      </i>
      <i class="fas fa-ellipsis-h">
      </i>
     </div>
    </div>
   </div>
   
   <div class="content">
    <div class="main">
     <div class="section" id="overview">
      <h3>
       Summary
      </h3>
      <p>
       Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
      <p>
       Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </p>
      <p>
       Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
      </p>
     </div>

     <div class="section" id="posts">
      <h3>
       Posts
      </h3>
      <p>
       Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
      <p>
       Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </p>
      <p>
       Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
      </p>
     </div>


     <div class="section" id="more">
      <h3>
       More
      </h3>
      <p>
       Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </p>
      <p>
       Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </p>
      <p>
       Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
      </p>
     </div>
     <div class="section" id="portfolio">
      <h3>
       Portfolio
      </h3>
      <div class="portfolio">
       <div class="project">
        <img alt="Project 1" height="100" src="" width="100"/>
        <h4>
         Project Title 1
        </h4>
        <p>
         Description of the project goes here. It can be a brief summary of what the project is about.
        </p>
       </div>
       <div class="project">
        <img alt="Project 2" height="100" src="" width="100"/>
        <h4>
         Project Title 2
        </h4>
        <p>
         Description of the project goes here. It can be a brief summary of what the project is about.
        </p>
       </div>
       <div class="project">
        <img alt="Project 3" height="100" src="" width="100"/>
        <h4>
         Project Title 3
        </h4>
        <p>
         Description of the project goes here. It can be a brief summary of what the project is about.
        </p>
       </div>
       <div class="project">
        <img alt="Project 4" height="100" src="" width="100"/>
        <h4>
         Project Title 4
        </h4>
        <p>
         Description of the project goes here. It can be a brief summary of what the project is about.
        </p>
       </div>
       <div class="project">
        <img alt="Project 5" height="100" src="" width="100"/>
        <h4>
         Project Title 5
        </h4>
        <p>
         Description of the project goes here. It can be a brief summary of what the project is about.
        </p>
       </div>
       <div class="project">
        <img alt="Project 6" height="100" src="" width="100"/>
        <h4>
         Project Title 6
        </h4>
        <p>
         Description of the project goes here. It can be a brief summary of what the project is about.
        </p>
       </div>
      </div>
     </div>
    </div>
    <div class="sidebar">
     <div class="card">
      <h3>
       Personal Details
      </h3>
      <div class="details">
       <p>
        <i class="fas fa-envelope">
        </i>
        <span>
         influencer@example.com
        </span>
       </p>
       <p>
       <i class="fas fa-phone-alt"></i>
        <span>
         +1 (123) 456-7890
        </span>
       </p>
       <p>
        <i class="fas fa-birthday-cake"></i>
        <span>
         January 1, 1990
        </span>
       </p>
      </div>
     </div>
     <div class="card">
      <h3>
       Skills
      </h3>
      <div class="details">
       <p>
        <i class="fas fa-check"></i>
        <span>Graphic Design</span>
       </p>
       <p>
        <i class="fas fa-check"></i>
        <span>Social Media Marketing</span>
       </p>
       <p>
        <i class="fas fa-check"></i>
        <span>Content Creation</span>
       </p>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>

</div>
</body>
</html>
