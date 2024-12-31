<html>

<head>
    <title>
        Verifications
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

        .content {
            flex-grow: 1;
            padding: 20px;
            transition: margin-left 0.3s;
            background-color: #f0f0f0;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
            font-size: 14px;
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
                    <div class="breadcrumb">Sisyphus Ventures &gt; User management</div>
                    <div class="user-info">
                        <img alt="User  profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
                            width="30" />
                        <span><?php echo $_SESSION['user_name']; ?></span>
                    </div>
                </div>
                <h2>Verifications</h2>
                <p>Manage your team members and their account permissions here.</p>
                <div class="search-bar">
                    <input placeholder="Search" type="text" />
                    <div>
                        <button>Filters</button>
                        <button>Search</button>
                    </div>
                </div>
                <table id="verificationTable">
                    <thead>
                        <tr>
                            <th>Verification Type</th>
                            <th>User Name</th>
                            <th>User Role</th>
                            <th>Date Requested</th>
                            <th>Verification Status</th>
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
    </div>

    <script>
        const verificationRequests = [
            {
                verificationType: "Businessman",
                userName: "Ammar Foley",
                userRole: "Businessman",
                dateRequested: "Mar 2, 2024",
                verificationStatus: "Pending",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                verificationType: "Influencer",
                userName: "Florence Shaw",
                userRole: "Influencer",
                dateRequested: "Mar 4, 2024",
                verificationStatus: "Verified",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                verificationType: "Designer",
                userName: "Amélie Laurent",
                userRole: "Designer",
                dateRequested: "Mar 4, 2024",
                verificationStatus: "Rejected",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                verificationType: "Influencer",
                userName: "Caitlyn King",
                userRole: "Influencer",
                dateRequested: "Mar 2, 2024",
                verificationStatus: "Verified",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                verificationType: "Designer",
                userName: "Sienna Hewitt",
                userRole: "Designer",
                dateRequested: "Mar 2, 2024",
                verificationStatus: "Pending",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                verificationType: "Businessman",
                userName: "Olly Shroeder",
                userRole: "Businessman",
                dateRequested: "Mar 6, 2024",
                verificationStatus: "Rejected",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                verificationType: "Influencer",
                userName: "Mathilde Lewis",
                userRole: "Influencer",
                dateRequested: "Mar 6, 2024",
                verificationStatus: "Verified",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            },
            {
                verificationType: "Designer",
                userName: "Jaya Willis",
                userRole: "Designer",
                dateRequested: "Mar 6, 2024",
                verificationStatus: "Pending",
                imagePath: "https://storage.googleapis.com/a1aa/image/UpUJRvUrTpb6AVoj3GgCR63uf4OQ1OKfIa5cBvEsd5Eg4fqnA.jpg"
            }
        ];

        function renderVerificationRequests(requests) {
            var tableBody = document.querySelector('#verificationTable tbody');
            tableBody.innerHTML = '';

            requests.forEach(function (request) {
                var row = document.createElement('tr');

                var badgeStatus = null;
                if (request.verificationStatus === "Verified") {
                    badgeStatus = "Verified";
                } else if (request.verificationStatus === "Pending") {
                    badgeStatus = "Banned";
                } else if (request.verificationStatus === "Rejected") {
                    badgeStatus = "Blocked";
                } else {
                    badgeStatus = "Pending"; // Default case if none match
                }

                row.innerHTML = `
                <tr>
            <td>${request.verificationType}</td>
            <td>
                <div class="user-info">
                    <img alt="User  profile picture" height="30" src="${request.imagePath}" width="30" />
                    <span>${request.userName}</span>
                </div>
            </td>
            <td>${request.userRole}</td>
            <td>${request.dateRequested}</td>
            <td>
                <span class="badge ${badgeStatus.toLowerCase()}">
                    ${request.verificationStatus}
                </span>
            </td>
            
                            <td>
                                <center>...</center>
                            </td>
            </tr>
        `;
                tableBody.appendChild(row);
            });
        }
        renderVerificationRequests(verificationRequests);


        const tableBody = document.querySelector('#verificationTable tbody');

        tableBody.addEventListener('click', function (event) {
            const row = event.target.closest('tr');
            if (row) {
                // const verificationId = row.cells[0].textContent; // Assuming complainId is in the first cell
                handleRowClick();
            }
        });

        function handleRowClick() {
            console.log('Row clicked, Verification ID:');
            window.location.href = '/admin/verification-details/1';
        }
    </script>
</body>

</html>