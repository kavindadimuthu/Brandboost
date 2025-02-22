<html>

<head>
    <title>
        User Management
    </title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        * {
            box-sizing: border-box;
        }

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
            width: 100%;
            background-color: #fff;
            border-radius: 20px;
            /* Add curvature */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        /* .main-content table td {
            font-size: 14px;
        } */
        .user-id-column {
            display: none;
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

        .badge.active {
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
            <div class="main-content">
                <div class="header">
                    <div class="breadcrumb">Sisyphus Ventures &gt; User management</div>
                    <div class="user-info">
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
                            width="30" />
                        <span><?php echo $_SESSION['user']['username']; ?></span>
                    </div>
                </div>
                <h2>User management</h2>
                <p>
                    Manage your team members and their account permissions here.
                </p>
                <div class="search-bar">
                    <input placeholder="Search" type="text" />
                    <div>
                        <button>Filters</button>
                        <button>Search</button>
                    </div>
                </div>
                <table id="usersTable">
                    <thead>
                        <tr>
                            <!-- <th>User ID</th> -->
                            <th>User name</th>
                            <th>Role</th>
                            <th>Account Status</th>
                            <th>Last active</th>
                            <th>Date added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="pagination">
                    <button>1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>5</button>
                    <button>6</button>
                </div>
            </div>
        
    </div>

    <script>
        let users = [];

        async function fetchUsers() {
            const response = await fetch('/api/users');
            const result = await response.json();
            console.log(result);

            users = result.users;

            renderUsers(users);
        }

        // const users = [{
        //         userName: "Florence Shaw",
        //         email: "florence@untitledui.com",
        //         role: "Influencer",
        //         accountStatus: "Verified",
        //         lastActive: "Mar 4, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     },
        //     {
        //         userName: "Amélie Laurent",
        //         email: "amelie@untitledui.com",
        //         role: "Designer",
        //         accountStatus: "Blocked",
        //         lastActive: "Mar 4, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     },
        //     {
        //         userName: "Ammar Foley",
        //         email: "ammar@untitledui.com",
        //         role: "Businessman",
        //         accountStatus: "Banned",
        //         lastActive: "Mar 2, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     },
        //     {
        //         userName: "Caitlyn King",
        //         email: "caitlyn@untitledui.com",
        //         role: "Influencer",
        //         accountStatus: "Verified",
        //         lastActive: "Mar 2, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     },
        //     {
        //         userName: "Sienna Hewitt",
        //         email: "sienna@untitledui.com",
        //         role: "Designer",
        //         accountStatus: "Blocked",
        //         lastActive: "Mar 2, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     },
        //     {
        //         userName: "Olly Shroeder",
        //         email: "olly@untitledui.com",
        //         role: "Businessman",
        //         accountStatus: "Banned",
        //         lastActive: "Mar 6, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     },
        //     {
        //         userName: "Mathilde Lewis",
        //         email: "mathilde@untitledui.com",
        //         role: "Influencer",
        //         accountStatus: "Verified",
        //         lastActive: "Mar 6, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     },
        //     {
        //         userName: "Jaya Willis",
        //         email: "jaya@untitledui.com",
        //         role: "Designer",
        //         accountStatus: "Blocked",
        //         lastActive: "Mar 6, 2024",
        //         dateAdded: "July 4, 2022",
        //         imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
        //     }
        // ];


        function renderUsers(users) {
            var tableBody = document.querySelector('#usersTable tbody');
            tableBody.innerHTML = '';
            console.log(users);


            users.forEach(function(user) {
                var row = document.createElement('tr');

                row.innerHTML = `
                    <tr>
                            <td class="user-id-column">
                                ${user.user_id}
                            </td>
                            <td>
                                <div class="user-info">
                                    <img alt="User profile picture" height="30"
                                        src="${user.profile_picture}"
                                        width="30" />
                                    <div class="user-details">
                                        <span>
                                            ${user.name} |
                                        </span>
                                        <span>
                                            ${user.email}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                ${user.role}
                            </td>
                            <td>
                                <span class="badge ${user.account_status.toLowerCase()}">
                                    ${user.account_status}
                                </span>
                            </td>
                            <td>
                                ${user.updated_at}
                            </td>
                            <td>
                                ${user.created_at}
                            </td>
                            <td>
                                <center>...</center>
                            </td>
                        </tr>
                `;
                tableBody.appendChild(row);
            });
        }

        renderUsers(users);


        const tableBody = document.querySelector('#usersTable tbody');

        tableBody.addEventListener('click', function(event) {
            const row = event.target.closest('tr');
            if (row) {
                const userId = row.cells[0].textContent; // Assuming complainId is in the first cell
                handleRowClick(userId);
            }
        });

        function handleRowClick(userId) {
            userId = userId.replace(/\D/g, '');
            // console.log('Row clicked, complaint ID:', userId);
            window.location.href = '/admin/user-profile/' + userId;
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchUsers();
        });
    </script>
</body>

</html>