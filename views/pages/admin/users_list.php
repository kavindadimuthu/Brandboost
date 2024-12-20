<html>

<head>
    <title>
        User Management
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/admin/tableViewContainer.css">

    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

    </style>
</head>

<body>
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