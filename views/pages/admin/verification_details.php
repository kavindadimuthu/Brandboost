<html>
 <head>
  <title>
   Verification Request Details
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            display: flex;
        }
        
        .content {
            flex-grow: 1;
            padding: 20px;
            transition: margin-left 0.3s;
            background-color: #f0f0f0;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        .sidebar.collapsed + .content {
            margin-left: 100px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .header .breadcrumb {
            font-size: 14px;
            color: #333;
        }
        .header .user-info {
            display: flex;
            align-items: center;
        }
        .header .user-info img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        .header .user-info span {
            font-size: 14px;
        }
        .main-content {
            background-color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            color: #333;
        }
        .main-content h2, .main-content p, .main-content th, .main-content td {
            color: #666;
            font-size: 12px; /* Smaller font size for more elegant look */
        }
        .main-content h2 {
            margin-top: 0;
            font-size: 20px; /* Slightly smaller font size for header */
        }
        .main-content .verification-details {
            margin-bottom: 20px;
        }
        .main-content .verification-details div {
            margin-bottom: 10px;
        }
        .main-content .verification-details div span {
            font-weight: bold;
        }
        .main-content .attachments {
            margin-bottom: 20px;
        }
        .main-content .attachments h3 {
            font-size: 16px; /* Slightly smaller font size for subheader */
            margin-bottom: 10px;
        }
        .main-content .attachments img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .main-content .response {
            margin-bottom: 20px;
        }
        .main-content .response h3 {
            font-size: 16px; /* Slightly smaller font size for subheader */
            margin-bottom: 10px;
        }
        .main-content .response textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            resize: none;
        }
        .main-content .actions {
            display: flex;
            justify-content: flex-end;
        }
        .main-content .actions button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-left: 10px;
        }
        .toggle-sidebar {
            cursor: pointer;
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 8px;
            height: 40px;
            width: 40px;
        }
  </style>
  <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            /* Reduced gap between header and breadcrumb */
        }

        .header .breadcrumb {
            font-size: 14px;
            color: #333;
            /* Make breadcrumb font color visible */
        }

        .header .user-info {
            display: flex;
            align-items: center;
        }

        .header .user-info img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .header .user-info span {
            font-size: 14px;
        }

        .main-content {
            background-color: #fff;
            border-radius: 20px;
            /* Add curvature */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            /* Add gap between sidebar and main content */
            color: #333;
        }

        .main-content h2,
        .main-content p,
        .main-content th,
        .main-content td {
            color: #666;
            /* Grey color for text */
            font-size: 14px;
            /* Smaller font size for elegant look */
        }

        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
            /* Larger font size for header */
        }

        .main-content .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .main-content .search-bar input {
            width: 400px;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            /* Add curvature */
        }

        .main-content .search-bar button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            /* Add curvature */
            cursor: pointer;
        }

        .main-content table {
            width: 100%;
            border-collapse: collapse;
        }

        .main-content table th,
        .main-content table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }

        .main-content table th {
            background-color: #f9f9f9;
        }

        .main-content table td img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .main-content table td .user-info {
            display: flex;
            align-items: center;
        }

        .main-content table td .user-info img {
            margin-right: 10px;
        }

        .main-content .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .main-content .pagination button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
            margin: 0 4px;
            color: #888;
        }

        .main-content .pagination button.active {
            font-weight: bold;
            color: #000;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
        }

        .badge.verified {
            background-color: #28a745;
        }

        .badge.blocked {
            background-color: #dc3545;
        }

        .badge.banned {
            background-color: #6c757d;
        }


        /* Action buttons Styles.......... */
        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .action-buttons .edit-btn {
            background-color: #007bff;
        }

        .action-buttons .delete-btn {
            background-color: #dc3545;
        }

        /* ................................ */
    </style>
 </head>
 <body>
  <div class="container">
   <div class="content">
    <div class="main-content">
     <div class="header">
      <div class="breadcrumb">
       Sisyphus Ventures &gt; New Registrations &gt; Verification Request Details
      </div>
      <div class="user-info">
       <img alt="User profile picture" height="30" src="https://storage.googleapis.com/a1aa/image/KlcBuWUpSiLmMZqP2TGrGEl8xXb3RAhKMcaJi0gy4XCuie6JA.jpg" width="30"/>
       <span><?php echo $_SESSION['user_name']; ?></span>
      </div>
     </div>
     <h2>
      Verification Request Details
     </h2>
     <div class="verification-details">
      <div>
       <span>
        Request ID:
       </span>
       002
      </div>
      <div>
       <span>
        User Name:
       </span>
       John Doe
      </div>
      <div>
       <span>
        Business Name:
       </span>
       Doe Enterprises
      </div>
      <div>
       <span>
        Status:
       </span>
       <span class="badge verified">
        Pending
       </span>
      </div>
      <div>
       <span>
        Assigned Admin:
       </span>
       Jane Smith
      </div>
      <div>
       <span>
        Date Submitted:
       </span>
       Mar 5, 2024
      </div>
      <div>
       <span>
        Details:
       </span>
       The user has submitted a request to verify their business registration document. The document needs to be reviewed and verified by an admin.
      </div>
     </div>
     <div class="attachments">
      <h3>
       Attachments
      </h3>
      <img alt="Scanned copy of business registration document" height="100" src="https://storage.googleapis.com/a1aa/image/erIpL39HXbVqYab9f9dCFbYr6PMdXtjfIdMLe1TjIngaroXPB.jpg" width="100"/>
      <img alt="Scanned copy of business license" height="100" src="https://storage.googleapis.com/a1aa/image/U2PRmkEUWkKxAxq1dWsJTjGhHjrsXYDZb1fGdmDmefAqV0rnA.jpg" width="100"/>
     </div>
     <div class="response">
      <h3>
       Response
      </h3>
      <textarea placeholder="Enter your response to the verification request..."></textarea>
     </div>
     <div class="actions">
      <button>
       Back to Registrations
      </button>
      <button>
       Send Response
      </button>
     </div>
    </div>
   </div>
  </div>
  <script>
   function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggle-icon');
            sidebar.classList.toggle('collapsed');
            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.classList.remove('fa-arrow-left');
                toggleIcon.classList.add('fa-arrow-right');
            } else {
                toggleIcon.classList.remove('fa-arrow-right');
                toggleIcon.classList.add('fa-arrow-left');
            }
        }
  </script>
 </body>
</html>
