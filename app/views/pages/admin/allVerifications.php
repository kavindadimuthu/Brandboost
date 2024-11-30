<html>

<head>
    <title>
        Verifications
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
            window.location.href = '/AdminViewController/singleVerification';
        }
    </script>
</body>

</html>