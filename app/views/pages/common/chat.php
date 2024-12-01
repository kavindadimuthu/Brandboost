<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>
      Chat Application
   </title>
   <link rel="stylesheet" href="../../styles/common/header.css">
   <!-- <link rel="stylesheet" href="../../styles/business-owner/chat2.css"> -->
   <style>
      body {
         display: block;
      }

      .container {
         font-family: 'Inter', sans-serif;
         /* margin: 0; */
         /* margin-top: 60px; */
         padding: 0;
         padding-top: 60px;
         display: flex;
         height: 100vh;
         background-color: #f7f8fc;
      }

      .sidebar {
         width: 300px;
         background-color: #fff;
         border-right: 1px solid #e6e6e6;
         display: flex;
         flex-direction: column;
      }

      .sidebar input {
         margin: 20px;
         padding: 10px;
         border: 1px solid #e6e6e6;
         border-radius: 5px;
         font-size: 16px;
      }

      .sidebar .all-messages {
         padding: 0 20px;
         font-weight: 600;
         color: #333;
      }

      .sidebar .message-list {
         flex-grow: 1;
         overflow-y: auto;
      }

      .sidebar .message-item {
         display: flex;
         align-items: center;
         padding: 10px 20px;
         cursor: pointer;
      }

      .sidebar .message-item:hover {
         background-color: #f0f0f0;
      }

      .sidebar .message-item img {
         width: 40px;
         height: 40px;
         border-radius: 50%;
         margin-right: 10px;
      }

      .sidebar .message-item .message-info {
         flex-grow: 1;
      }

      .sidebar .message-item .message-info .name {
         font-weight: 500;
         color: #333;
      }

      .sidebar .message-item .message-info .text {
         color: #888;
         font-size: 14px;
      }

      .sidebar .message-item .message-time {
         color: #888;
         font-size: 12px;
      }

      .chat-container {
         flex-grow: 1;
         display: flex;
         flex-direction: column;
      }

      .chat-header {
         display: flex;
         align-items: center;
         padding: 20px;
         background-color: #fff;
         border-bottom: 1px solid #e6e6e6;
      }

      .chat-header img {
         width: 50px;
         height: 50px;
         border-radius: 50%;
         margin-right: 10px;
      }

      .chat-header .chat-info {
         flex-grow: 1;
      }

      .chat-header .chat-info .name {
         font-weight: 600;
         color: #333;
      }

      .chat-header .chat-info .status {
         color: #888;
         font-size: 14px;
      }

      .chat-header .chat-options {
         color: #888;
         font-size: 20px;
         cursor: pointer;
      }

      .chat-messages {
         flex-grow: 1;
         padding: 20px;
         overflow-y: auto;
         background-color: #f7f8fc;
      }

      .chat-messages .message {
         display: flex;
         align-items: flex-start;
         margin-bottom: 20px;
      }

      .chat-messages .message img {
         width: 40px;
         height: 40px;
         border-radius: 50%;
         margin-right: 10px;
      }

      .chat-messages .message .message-content {
         max-width: 60%;
      }

      .chat-messages .message .message-content .text {
         background-color: #fff;
         padding: 10px;
         border-radius: 10px;
         margin-bottom: 5px;
         font-size: 14px;
         color: #333;
      }

      .chat-messages .message .message-content .file {
         background-color: #f0f0f0;
         padding: 10px;
         border-radius: 10px;
         font-size: 14px;
         color: #333;
         display: flex;
         align-items: center;
      }

      .chat-messages .message .message-content .file i {
         margin-right: 10px;
      }

      .chat-messages .message .message-content .time {
         font-size: 12px;
         color: #888;
      }

      .chat-input {
         display: flex;
         align-items: center;
         padding: 20px;
         background-color: #fff;
         border-top: 1px solid #e6e6e6;
      }

      .chat-input input {
         flex-grow: 1;
         padding: 10px;
         border: 1px solid #e6e6e6;
         border-radius: 5px;
         font-size: 16px;
         margin-right: 10px;
      }

      .chat-input button {
         padding: 10px 20px;
         background-color: #6c63ff;
         color: #fff;
         border: none;
         border-radius: 5px;
         font-size: 16px;
         cursor: pointer;
      }

      .profile-sidebar {
         width: 300px;
         background-color: #fff;
         border-left: 1px solid #e6e6e6;
         display: flex;
         flex-direction: column;
         align-items: center;
         padding: 20px;
      }

      .profile-sidebar img {
         width: 100px;
         height: 100px;
         border-radius: 50%;
         margin-bottom: 10px;
      }

      .profile-sidebar .name {
         font-weight: 600;
         color: #333;
         margin-bottom: 5px;
      }

      .profile-sidebar .role {
         color: #888;
         font-size: 14px;
         margin-bottom: 10px;
      }

      .profile-sidebar .email {
         color: #6c63ff;
         font-size: 14px;
         margin-bottom: 20px;
         display: flex;
         align-items: center;
      }

      .profile-sidebar .email i {
         margin-right: 5px;
      }

      .profile-sidebar .images {
         width: 100%;
      }

      .profile-sidebar .images .header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         margin-bottom: 10px;
      }

      .profile-sidebar .images .header .title {
         font-weight: 600;
         color: #333;
      }

      .profile-sidebar .images .header .view-all {
         color: #6c63ff;
         font-size: 14px;
         cursor: pointer;
      }

      .profile-sidebar .images .image-list {
         display: flex;
         flex-wrap: wrap;
         gap: 10px;
      }

      .profile-sidebar .images .image-list img {
         width: 60px;
         height: 60px;
         border-radius: 5px;
      }
   </style>
</head>

<body>
   <?php include __DIR__ . '/../../components/common/header.php'; ?>
   <div class="container">


      <div class="sidebar">
         <input placeholder="Search..." type="text" />
         <div class="all-messages">
            All messages
         </div>
         <div class="message-list">
            <div class="message-item">
               <img alt="Profile picture of Cynthia Snyder" height="40"
                  src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Cynthia Snyder
                  </div>
                  <div class="text">
                     You: 😍😴😴
                  </div>
               </div>
               <div class="message-time">
                  1:17 PM
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of Jevon Raynor" height="40"
                  src="https://storage.googleapis.com/a1aa/image/5cmJ4Pixi26JP1MTcGAXVkCTI3L22FdxJ1dPUwZoQmMkyO9E.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Jevon Raynor
                  </div>
                  <div class="text">
                     Ok I will
                  </div>
               </div>
               <div class="message-time">
                  Sun
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of Jevon Raynor" height="40"
                  src="https://storage.googleapis.com/a1aa/image/5cmJ4Pixi26JP1MTcGAXVkCTI3L22FdxJ1dPUwZoQmMkyO9E.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Annie Haley
                  </div>
                  <div class="text">
                     How can I help you
                  </div>
               </div>
               <div class="message-time">
                  Mon
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of Selina Rutherford" height="40"
                  src="https://storage.googleapis.com/a1aa/image/5HNdUZp615IwM9JTOljPehh2OveMNEPFgSmw0ubzseJzU2pnA.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Selina Rutherford
                  </div>
                  <div class="text">
                     good morning
                  </div>
               </div>
               <div class="message-time">
                  Fri
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of Frank Sinat" height="40"
                  src="https://storage.googleapis.com/a1aa/image/DVT2so3FaK4EENGZY7cO05IffYniGdGeXCSrCG4HGXmVU2pnA.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Frank Sinat
                  </div>
                  <div class="text">
                     Okay
                  </div>
               </div>
               <div class="message-time">
                  Nov 3
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of Jevon Raynor" height="40"
                  src="https://storage.googleapis.com/a1aa/image/5cmJ4Pixi26JP1MTcGAXVkCTI3L22FdxJ1dPUwZoQmMkyO9E.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Stephen Emil
                  </div>
                  <div class="text">
                     My packages are in the gig. you can order
                  </div>
               </div>
               <div class="message-time">
                  Nov 4
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of James Smith" height="40"
                  src="https://storage.googleapis.com/a1aa/image/fBGOOuovyUWFBifJbdqhR0o7lKiaqwlnOJBwhL4E4cGbK70TA.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     James Smith
                  </div>
                  <div class="text">
                     How can i help you
                  </div>
               </div>
               <div class="message-time">
                  Nov 1
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of Jevon Raynor" height="40"
                  src="https://storage.googleapis.com/a1aa/image/5cmJ4Pixi26JP1MTcGAXVkCTI3L22FdxJ1dPUwZoQmMkyO9E.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Fiona Jackson
                  </div>
                  <div class="text">
                     bye
                  </div>
               </div>
               <div class="message-time">
                  Sep 28
               </div>
            </div>
            <div class="message-item">
               <img alt="Profile picture of Green William" height="40"
                  src="https://storage.googleapis.com/a1aa/image/JgqkBW82gHbjIlSUBCNpfIejTAUHwKcjWG5orNY9pDJLK70TA.jpg"
                  width="40" />
               <div class="message-info">
                  <div class="name">
                     Green William
                  </div>
                  <div class="text">
                     good bye
                  </div>
               </div>
               <div class="message-time">
                  Sep 16
               </div>
            </div>
         </div>
      </div>
      <div class="chat-container">
         <div class="chat-header">
            <img alt="Profile picture of Cynthia Snyder" height="50"
               src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
               width="50" />
            <div class="chat-info">
               <div class="name">
                  Cynthia Snyder
               </div>
               <div class="status">
                  Active now
               </div>
            </div>
            <div class="chat-options">
               <i class="fas fa-ellipsis-h">
               </i>
            </div>
         </div>
         <div class="chat-messages">
            <div class="message">
               <img alt="Profile picture of Cynthia Snyder" height="40"
                  src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
                  width="40" />
               <div class="message-content">
                  <div class="text">
                     Hi good morning this is the file.
                  </div>
                  <div class="file">
                     <i class="fas fa-paperclip">
                     </i>
                     File-name-11 Oct 2021
                     <span style="margin-left: auto;">
                        120 kB
                     </span>
                  </div>
                  <div class="time">
                     1:12 PM
                  </div>
               </div>
            </div>
            <div class="message">
               <div class="message-content" style="margin-left: auto;">
                  <div class="text" style="background-color: #e6e6ff;">
                     It's good but can you design it more colorful?
                  </div>
                  <div class="time" style="text-align: right;">
                     1:15 PM
                  </div>
               </div>
               <img alt="Profile picture of Cynthia Snyder" height="40"
                  src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
                  width="40" />
            </div>
            <div class="message">
               <img alt="Profile picture of Cynthia Snyder" height="40"
                  src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
                  width="40" />
               <div class="message-content">
                  <div class="text">
                     😍😴😴
                  </div>
                  <div class="time">
                     1:17 PM
                  </div>
               </div>
            </div>
            <div class="message">
               <img alt="Profile picture of Cynthia Snyder" height="40"
                  src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
                  width="40" />
               <div class="message-content">
                  <img alt="Image of a yellow flower in a vase" height="200"
                     src="https://storage.googleapis.com/a1aa/image/wk9Uly7YXbIhFFfOmOgGwp0yaAw3L80PXXErgNIiEcFLld6JA.jpg"
                     width="200" />
                  <div class="time">
                     1:17 PM
                  </div>
               </div>
            </div>
            <div class="message">
               <div class="message-content" style="margin-left: auto;">
                  <div class="text" style="background-color: #e6e6ff;">
                     😍😴😴
                  </div>
                  <div class="time" style="text-align: right;">
                     1:17 PM
                  </div>
               </div>
               <img alt="Profile picture of Cynthia Snyder" height="40"
                  src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
                  width="40" />
            </div>
         </div>
         <div class="chat-input">
            <i class="fas fa-paperclip" style="font-size: 20px; color: #888; margin-right: 10px;">
            </i>
            <input placeholder="Type a message..." type="text" />
            <button>
               Send
            </button>
         </div>
      </div>
      <div class="profile-sidebar">
         <img alt="Profile picture of Cynthia Snyder" height="100"
            src="https://storage.googleapis.com/a1aa/image/0oK2IMcv8d4tHhK1egxqWEc7u5YD8cc1wE1rwj3nN9QHld6JA.jpg"
            width="100" />
         <div class="name">
         <?php echo $_SESSION['user_name']; ?>
         </div>
         <div class="role">
         <?php echo $_SESSION['role']; ?>
         </div>
         <div class="email">
            <i class="fas fa-envelope">
            </i>
            cysnyder@gmail.com
         </div>
         <div class="images">
            <div class="header">
               <div class="title">
                  Image (50)
               </div>
               <div class="view-all">
                  View all
               </div>
            </div>
            <div class="image-list">
               <img alt="Image of a yellow flower in a vase" height="60"
                  src="https://storage.googleapis.com/a1aa/image/wk9Uly7YXbIhFFfOmOgGwp0yaAw3L80PXXErgNIiEcFLld6JA.jpg"
                  width="60" />
               <img alt="Image of an avocado" height="60"
                  src="https://storage.googleapis.com/a1aa/image/os1Aqoei3W2HKadtNQ0Uez4DJLb2NANEyeaKUjEjQoyqU2pnA.jpg"
                  width="60" />
               <img alt="Image of a chair" height="60"
                  src="https://storage.googleapis.com/a1aa/image/zVkYVNO1kQoeLSsHOeIq41yhMUZv27krVv0HDbbWetFxU2pnA.jpg"
                  width="60" />
               <img alt="Image of a desk" height="60"
                  src="https://storage.googleapis.com/a1aa/image/YNJLF91idSqGGxb5sY3XxlEhCAYfiBParVEc8SGgPPyIld6JA.jpg"
                  width="60" />
               <img alt="Image of cherries" height="60"
                  src="https://storage.googleapis.com/a1aa/image/j1fqEi88RPVDO6lcCCnA8yTVBKIgxKfPfw34a10fOdjxosTPB.jpg"
                  width="60" />
               <img alt="Image of a cactus" height="60"
                  src="https://storage.googleapis.com/a1aa/image/MB8ijppJuWIWIdfHf8dXU9csujVqBuLc8heQ7ueh8aOOpsTPB.jpg"
                  width="60" />
            </div>
         </div>
      </div>
   </div>
</body>

</html>