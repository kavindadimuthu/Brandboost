<html>

<head>
    <title>
        User Management
    </title>
    <link rel="stylesheet" href="../styles/admin/tableViewContainer.css">
</head>

<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/admin/sideNavbar.php'; ?>
        <div class="content">
            <div class="main-content">
                <div class="header">
                    <div class="breadcrumb">Sisyphus Ventures &gt; User management</div>
                    <div class="user-info">
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
                            width="30" />
                        <span><?php echo $_SESSION['user_name']; ?></span>
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
                            <th>User name</th>
                            <th>Role</th>
                            <th>Account Status</th>
                            <th>Last active</th>
                            <th>Date added</th>
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
    </div>

    <script>
        const users = [
            {
                userName: "Florence Shaw",
                email: "florence@untitledui.com",
                role: "Influencer",
                accountStatus: "Verified",
                lastActive: "Mar 4, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                userName: "Amélie Laurent",
                email: "amelie@untitledui.com",
                role: "Designer",
                accountStatus: "Blocked",
                lastActive: "Mar 4, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                userName: "Ammar Foley",
                email: "ammar@untitledui.com",
                role: "Businessman",
                accountStatus: "Banned",
                lastActive: "Mar 2, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                userName: "Caitlyn King",
                email: "caitlyn@untitledui.com",
                role: "Influencer",
                accountStatus: "Verified",
                lastActive: "Mar 2, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                userName: "Sienna Hewitt",
                email: "sienna@untitledui.com",
                role: "Designer",
                accountStatus: "Blocked",
                lastActive: "Mar 2, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                userName: "Olly Shroeder",
                email: "olly@untitledui.com",
                role: "Businessman",
                accountStatus: "Banned",
                lastActive: "Mar 6, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                userName: "Mathilde Lewis",
                email: "mathilde@untitledui.com",
                role: "Influencer",
                accountStatus: "Verified",
                lastActive: "Mar 6, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                userName: "Jaya Willis",
                email: "jaya@untitledui.com",
                role: "Designer",
                accountStatus: "Blocked",
                lastActive: "Mar 6, 2024",
                dateAdded: "July 4, 2022",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            }
        ];


        function renderUsers(users) {
            var tableBody = document.querySelector('#usersTable tbody');
            tableBody.innerHTML = '';
            console.log(users);


            users.forEach(function (user) {
                var row = document.createElement('tr');

                row.innerHTML = `
                    <tr>
                            <td>
                                <div class="user-info">
                                    <img alt="User profile picture" height="30"
                                        src="${user.imagePath}"
                                        width="30" />
                                    <div class="user-details">
                                        <span>
                                            ${user.userName}
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
                                <span class="badge ${user.accountStatus.toLowerCase()}">
                                    ${user.accountStatus}
                                </span>
                            </td>
                            <td>
                                ${user.lastActive}
                            </td>
                            <td>
                                ${user.dateAdded}
                            </td>
                        </tr>
                `;
                tableBody.appendChild(row);
            });
        }

        renderUsers(users);


        const tableBody = document.querySelector('#usersTable tbody');

        tableBody.addEventListener('click', function (event) {
            const row = event.target.closest('tr');
            if (row) {
                const userId = row.cells[0].textContent; // Assuming complainId is in the first cell
                handleRowClick(userId);
            }
        });

        function handleRowClick(userId) {
            console.log('Row clicked, complaint ID:', userId);
            window.location.href = '/AdminViewController/singleuserview';
        }
    </script>
</body>

</html>