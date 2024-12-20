<html>

<head>
    <title>Complain Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/admin/index.css">
    <link rel="stylesheet" href="../styles/admin/tableViewContainer.css">

    <style>
        .complain-details {
            margin-bottom: 30px;
        }

        .complain-details div {
            margin-bottom: 20px;
        }

        .complain-details div span {
            font-weight: bold;
        }

        .attachments {
            margin-bottom: 20px;
        }

        .attachments h3 {
            font-size: 16px;
            /* Slightly smaller font size for subheader */
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
            font-size: 16px;
            /* Slightly smaller font size for subheader */
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

</head>

<body>
   
                <h2>Complain Details</h2>
                <div class="complain-details">
                    <div>
                        <span>Complain ID:</span> 001
                    </div>
                    <div>
                        <span>User Name:</span> Florence Shaw
                    </div>
                    <div>
                        <span>Complain:</span> Unable to access account
                    </div>
                    <div>
                        <span>Status:</span> <span class="badge verified">Resolved</span>
                    </div>
                    <div>
                        <span>Assigned Admin:</span> John Doe
                    </div>
                    <div>
                        <span>Date Submitted:</span> Mar 4, 2024
                    </div>
                    <div>
                        <span>Details:</span> The user reported that they were unable to access their account due to a
                        password reset issue. The issue was resolved by resetting the password manually and providing
                        the user with the new credentials.
                    </div>
                </div>
                <div class="attachments">
                    <h3>Attachments</h3>
                    <img alt="Screenshot of error message encountered by the user" height="100"
                        src="https://storage.googleapis.com/a1aa/image/9KrQWb039zb2PF5fAZBDBYErnZ4GjCI2XdL6VkIaBxeDpn1TA.jpg"
                        width="100" />
                    <img alt="Screenshot of account settings page" height="100"
                        src="https://storage.googleapis.com/a1aa/image/fsj0POoE9nQ7G6dtaCEzKUG2QNeE8crCBzfWfRlLKQALkeseE.jpg"
                        width="100" />
                </div>
                <div class="response">
                    <h3>Response</h3>
                    <textarea placeholder="Enter your response to the complain..."></textarea>
                </div>
                <div class="actions">
                    <button>Back to Complains</button>
                    <button>Send Response</button>
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