<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Faqs</title>
    <link rel="stylesheet" href="../styles/admin/tableViewContainer.css">
    <!-- <link rel="stylesheet" href="../../styles/admin/sidebar.css"> -->
    <!-- <link rel="stylesheet" href="../../styles/admin/viewAllFaqs.css"> -->
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="sidebar-container">
        <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>
    </div>
    <div class="main-content">
        <h1>FAQ List</h1>
        <div class="add-btn-container">
            <form action="/admin/searchFaq" method="GET" class="search-form">
                <input type="text" name="query" placeholder="Search FAQs..." class="search-input">
                <button type="submit" class="btn btn-search">Search</button>
            </form>
            <button id="addFaqBtn" class="btn btn-add">Add FAQ</button>
        </div>

        <table>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($data['faqs'] as $faq): ?>
                <tr>
                    <td>
                        <span class="faq-question"><?php echo $faq->question; ?></span>
                        <input type="text" class="edit-question" value="<?php echo $faq->question; ?>"
                            style="display:none;">
                    </td>
                    <td>
                        <span class="faq-answer"><?php echo $faq->answer; ?></span>
                        <textarea class="edit-answer" style="display:none;"><?php echo $faq->answer; ?></textarea>
                    </td>
                    <td class="control-buttons">
                        <button class="btn btn-edit" onclick="editFaq(this)">Edit</button>
                        <button class="btn btn-save" onclick="saveFaq(this, <?php echo $faq->id; ?>)"
                            style="display:none;">Save</button>
                        <a href="http://localhost:8000/adminDataController/deleteFaq/<?php echo $faq->id; ?>"
                            class="btn btn-delete">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- The Modal -->
    <div id="addFaqModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add FAQ</h2>
            <form action="/adminDataController/addFaq" method="POST">
                <div class="form-group">
                    <label for="question">Question:</label>
                    <input type="text" id="question" name="question" required>
                </div>
                <div class="form-group">
                    <label for="answer">Answer:</label>
                    <textarea id="answer" name="answer" required></textarea>
                </div>
                <button type="submit" class="btn btn-add">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function editFaq(button) {
            const row = button.closest('tr');
            row.querySelector('.faq-question').style.display = 'none';
            row.querySelector('.faq-answer').style.display = 'none';
            row.querySelector('.edit-question').style.display = 'block';
            row.querySelector('.edit-answer').style.display = 'block';
            button.style.display = 'none';
            row.querySelector('.btn-save').style.display = 'inline-block';
        }

        async function saveFaq(button, id) {
            const row = button.closest('tr');
            const question = row.querySelector('.edit-question').value;
            const answer = row.querySelector('.edit-answer').value;

            const response = await fetch(`/adminDataController/updateFaq/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ question, answer })
            });

            if (response.ok) {
                row.querySelector('.faq-question').textContent = question;
                row.querySelector('.faq-answer').textContent = answer;
                row.querySelector('.faq-question').style.display = 'block';
                row.querySelector('.faq-answer').style.display = 'block';
                row.querySelector('.edit-question').style.display = 'none';
                row.querySelector('.edit-answer').style.display = 'none';
                button.style.display = 'none';
                row.querySelector('.btn-edit').style.display = 'inline-block';
            } else {
                alert('Error updating FAQ');
            }
        }
    </script>

    <script>
        // Get the modal
        var modal = document.getElementById("addFaqModal");

        // Get the button that opens the modal
        var btn = document.getElementById("addFaqBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>














<html>

<head>
    <title>FAQs Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

</head>

<body>
    <div class="container">
        <div class="sidebar" id="sidebar">
            <div>
                <div class="sidebar-top-container">
                    <h1>Admin Portal</h1>
                    <button class="toggle-sidebar" onclick="toggleSidebar()">
                        <i class="fas fa-arrow-left" id="toggle-icon"></i>
                    </button>
                </div>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="link-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-users"></i>
                            <span class="link-text">User management</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-exclamation-circle"></i>
                            <span class="link-text">Complains</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="#">
                            <i class="fas fa-question-circle"></i>
                            <span class="link-text">FAQs</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-user-plus"></i>
                            <span class="link-text">New registrations</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-links">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="link-text">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="main-content">
                <div class="header">
                    <div class="breadcrumb">
                        Sisyphus Ventures &gt; FAQs
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" height="30"
                            src="https://storage.googleapis.com/a1aa/image/accd3Q73BfxYLyedAXnbEeUBI1YcvUCb3YA9Sd4Dqq46AqrnA.jpg"
                            width="30" />
                        <span>Florence Shaw</span>
                    </div>
                </div>
                <h2>FAQs Management</h2>
                <p>Manage frequently asked questions for the platform.</p>
                <div class="search-bar">
                    <input placeholder="Search FAQs" type="text" />
                    <div>
                        <button>Add FAQ</button>
                        <button>Search</button>
                    </div>
                </div>
                <table id="faqsTable">
                    <thead>
                        <tr>
                            <th>FAQ ID</th>
                            <th>Category</th>
                            <th>Question</th>
                            <th>Answer</th>
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
            </div>
        </div>
    </div>
    <script>
        const faqs = [
            {
                id: "001",
                category: "Account",
                question: "How to reset my password?",
                answer: "Go to the settings page and click on 'Reset Password'."
            },
            {
                id: "002",
                category: "Support",
                question: "How to contact support?",
                answer: "You can contact support via the 'Contact Us' page."
            },
            {
                id: "003",
                category: "Profile",
                question: "How to update my profile?",
                answer: "Go to the profile page and click on 'Edit Profile'."
            },
            {
                id: "004",
                category: "Account",
                question: "How to delete my account?",
                answer: "Contact support to request account deletion."
            },
            {
                id: "005",
                category: "Settings",
                question: "How to change my email address?",
                answer: "Go to the settings page and click on 'Change Email'."
            }
        ];

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

        function renderFAQs(faqs) {
            const tableBody = document.querySelector('#faqsTable tbody');
            tableBody.innerHTML = '';

            faqs.forEach(faq => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${faq.id}</td>
            <td>${faq.category}</td>
            <td>${faq.question}</td>
            <td>${faq.answer}</td>
            <td>
                <div class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </div>
            </td>
        `;
                tableBody.appendChild(row);
            });
        }

        // Call the function to render the FAQs
        renderFAQs(faqs);
    </script>
</body>

</html>