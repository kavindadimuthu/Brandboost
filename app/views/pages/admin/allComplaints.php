<html>

<head>
    <title>Complains Management</title>
    <link href="../../styles/admin/tableViewContainer.css" rel="stylesheet" />

</head>

<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/admin/sideNavbar.php'; ?>
        <div class="content">
            <div class="main-content">
                <div class="header">
                    <div class="breadcrumb">
                        Sisyphus Ventures &gt; Complains
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
                            width="30" />
                        <span><?php echo $_SESSION['user_name']; ?></span>
                    </div>
                </div>
                <h2>Complains Management</h2>
                <p>Review and manage all user complains submitted to the platform.</p>
                <div class="search-bar">
                    <input placeholder="Search" type="text" />
                    <div>
                        <button>Filters</button>
                        <button>Search</button>
                    </div>
                </div>
                <table id="complaintsTable">
                    <thead>
                        <tr>
                            <th>Complain ID</th>
                            <th>User name</th>
                            <th>Complain</th>
                            <th>Status</th>
                            <th>Assigned Admin</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
        const complaints = [
            {
                complainId: "001",
                userName: "Florence Shaw",
                complain: "Unable to access account",
                status: "Resolved",
                assignedAdmin: "John Doe",
                dateSubmitted: "Mar 4, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            },
            {
                complainId: "002",
                userName: "Amélie Laurent",
                complain: "Payment issues",
                status: "Pending",
                assignedAdmin: "",
                dateSubmitted: "Mar 4, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            },
            {
                complainId: "003",
                userName: "Ammar Foley",
                complain: "App crashes frequently",
                status: "In Progress",
                assignedAdmin: "John Doe",
                dateSubmitted: "Mar 2, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            },
            {
                complainId: "004",
                userName: "Caitlyn King",
                complain: "Unable to upload files",
                status: "Resolved",
                assignedAdmin: "Jane Smith",
                dateSubmitted: "Mar 2, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            },
            {
                complainId: "005",
                userName: "Sienna Hewitt",
                complain: "Slow performance",
                status: "Pending",
                assignedAdmin: "",
                dateSubmitted: "Mar 2, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            },
            {
                complainId: "006",
                userName: "Olly Shroeder",
                complain: "Feature request: Dark mode",
                status: "In Progress",
                assignedAdmin: "Jane Smith",
                dateSubmitted: "Mar 6, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            },
            {
                complainId: "007",
                userName: "Mathilde Lewis",
                complain: "Notification issues",
                status: "Resolved",
                assignedAdmin: "John Doe",
                dateSubmitted: "Mar 6, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            },
            {
                complainId: "008",
                userName: "Jaya Willis",
                complain: "Account suspension",
                status: "Pending",
                assignedAdmin: "",
                dateSubmitted: "Mar 6, 2024",
                imagePath: "https://storage.googleapis.com/a1aa/image/sh0djlbBORIiKpa1H4WzsuqnYbqkqqh0GXDnxykdWDDdfy6JA.jpg"
            }
        ];

        function renderComplaints(complaints) {
            var tableBody = document.querySelector('#complaintsTable tbody');
            tableBody.innerHTML = '';

            complaints.forEach(function (complaint) {
                var row = document.createElement('tr');

                var badgeSatatus = null;
                if (complaint.status === "Resolved") {
                    badgeSatatus = "Verified";
                } else if (complaint.status === "Pending") {
                    badgeSatatus = "Blocked";
                } else if (complaint.status === "In Progress") {
                    badgeSatatus = "Banned";
                }

                row.innerHTML = `
            <tr>
                <td>${complaint.complainId}</td>
                <td>
                    <div class="user-info">
                        <img alt="User  profile picture" height="30"src="${complaint.imagePath}"
                            width="30" />
                        <span>${complaint.userName}</span>
                    </div>
                </td>
                <td>${complaint.complain}</td>
                <td>
                    <span class="badge ${badgeSatatus.toLowerCase()}">
                        ${complaint.status}
                    </span>
                </td>
                <td>${complaint.assignedAdmin}</td>
                <td>${complaint.dateSubmitted}</td>
            </tr>
        `;


                tableBody.appendChild(row);
            });
        }

        renderComplaints(complaints);

        const tableBody = document.querySelector('#complaintsTable tbody');

        tableBody.addEventListener('click', function (event) {
            const row = event.target.closest('tr');
            if (row) {
                const complainId = row.cells[0].textContent; // Assuming complainId is in the first cell
                handleRowClick(complainId);
            }
        });

        function handleRowClick(complainId) {
            console.log('Row clicked, complaint ID:', complainId);
            window.location.href = '/AdminViewController/singleComplaint';
        }
    </script>
</body>

</html>