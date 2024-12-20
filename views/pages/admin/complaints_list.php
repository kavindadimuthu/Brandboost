<html>

<head>
    <title>Complains Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css');

        h2,
        p,
        th,
        td {
            color: #666;
            /* Grey color for text */
            font-size: 14px;
            /* Smaller font size for elegant look */
        }

        h2 {
            margin-top: 0;
            font-size: 24px;
            /* Larger font size for header */
        }

        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 400px;
            padding: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            /* Add curvature */
        }

        .search-bar button {
            padding: 8px 16px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            /* Add curvature */
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }

        table th {
            background-color: #f9f9f9;
        }

        table td img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
            vertical-align: middle;
        }

        table td .user-info {
            display: flex;
            align-items: center;
        }

        table td .user-info img {
            margin-right: 10px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
            margin: 0 4px;
            color: #888;
        }

        .pagination button.active {
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
                            <th>Actions</th>
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
                
                            <td>
                                <center>...</center>
                            </td>
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