<html>
 <head>
  <title>
   Verification Request Details
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
        h2, p, th, td {
            color: #666;
            font-size: 12px; /* Smaller font size for more elegant look */
        }
        h2 {
            margin-top: 0;
            font-size: 20px; /* Slightly smaller font size for header */
        }
        .verification-details {
            margin-bottom: 20px;
        }
        .verification-details div {
            margin-bottom: 10px;
        }
        .verification-details div span {
            font-weight: bold;
        }
        .attachments {
            margin-bottom: 20px;
        }
        .attachments h3 {
            font-size: 16px; /* Slightly smaller font size for subheader */
            margin-bottom: 10px;
        }
        .attachments img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .response {
            margin-bottom: 20px;
        }
        .response h3 {
            font-size: 16px; /* Slightly smaller font size for subheader */
            margin-bottom: 10px;
        }
        .response textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            resize: none;
        }
        .actions {
            display: flex;
            justify-content: flex-end;
        }
        .actions button {
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
  <link href="../../styles/admin/tableViewContainer.css" rel="stylesheet" />
 </head>
 <body>
  
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
