<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/admin/tableViewContainer.css">
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
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .modal-content h2 {
            color: #333;
            font-size: 24px;
            margin-top: 0;
        }

        .modal-content label {
            display: block;
            margin-top: 10px;
            color: #666;
            font-size: 14px;
        }

        .modal-content input,
        .modal-content textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }

        .modal-content button {
            padding: 10px 20px;
            background-color: #6a11cb;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>



<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/admin/sideNavbar.php'; ?>
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
                        <span><?php echo $_SESSION['user_name']; ?></span>
                    </div>
                </div>
                <h2>FAQs Management</h2>
                <p>Manage frequently asked questions for the platform.</p>
                <div class="search-bar">
                    <input placeholder="Search FAQs" type="text" />
                    <div>
                        <button id="addFaqBtn">Add FAQ</button>
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

    <!-- Modal -->
    <div id="addFaqModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add New FAQ</h2>
            <form id="addFaqForm" action="/adminDataController/addFaq" method="POST">
                <label for="faqCategory">Category:</label>
                <input type="text" id="faqCategory" name="category" required>
                <label for="faqQuestion">Question:</label>
                <input type="text" id="faqQuestion" name="question" required>
                <label for="faqAnswer">Answer:</label>
                <textarea id="faqAnswer" name="answer" required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>

        async function fetchAllFaqs() {
            try {
                const response = await fetch('/homedatacontroller/fetchAllFaqs');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const faqs = await response.json();
                renderFAQs(faqs);
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
            }
        }

        // Call the function to fetch and render the FAQs
        fetchAllFaqs();



        function renderFAQs(faqs) {
            const tableBody = document.querySelector('#faqsTable tbody');
            tableBody.innerHTML = '';

            faqs.forEach(faq => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${faq.id}</td>
            <td>${faq.category}</td>
            <td class="faq-question">${faq.question}</td>
            <td class="faq-answer">${faq.answer}</td>
            <td>
                <div class="action-buttons">
                    <button class="edit-btn" data-id="${faq.id}">Edit</button>
                    <button class="delete-btn" data-id="${faq.id}">Delete</button>
                </div>
            </td>
        `;
                tableBody.appendChild(row);
            });

            // Add event listeners for edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    const faqId = event.target.getAttribute('data-id');
                    makeEditable(faqId);
                });
            });

            // Add event listeners for delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', async (event) => {
                    const faqId = event.target.getAttribute('data-id');
                    await deleteFaq(faqId);
                });
            });
        }


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

        // Add a new faq functions.............
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



        function makeEditable(faqId) {
            const row = document.querySelector(`button[data-id="${faqId}"]`).closest('tr');
            if (!row) {
                console.error('Row not found for FAQ ID:', faqId);
                return;
            }

            const questionCell = row.querySelector('.faq-question');
            const answerCell = row.querySelector('.faq-answer');

            if (!questionCell || !answerCell) {
                console.error('Question or Answer cell not found for FAQ ID:', faqId);
                return;
            }

            const questionText = questionCell.textContent;
            const answerText = answerCell.textContent;

            questionCell.innerHTML = `<input type="text" value="${questionText}" class="edit-question">`;
            answerCell.innerHTML = `<textarea class="edit-answer">${answerText}</textarea>`;

            const actionButtons = row.querySelector('.action-buttons');
            actionButtons.innerHTML = `<button class="save-btn" data-id="${faqId}">Save</button>`;

            // Add event listener for save button
            const saveButton = row.querySelector('.save-btn');
            saveButton.addEventListener('click', async (event) => {
                const updatedQuestion = row.querySelector('.edit-question').value;
                const updatedAnswer = row.querySelector('.edit-answer').value;
                await updateFaq(faqId, updatedQuestion, updatedAnswer);
            });
        }

        //Edit faq function.............
        async function updateFaq(faqId, question, answer) {
            try {
                const response = await fetch(`/admindatacontroller/updateFaq/${faqId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ question, answer })
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Update the FAQ in the DOM
                const row = document.querySelector(`button[data-id="${faqId}"]`).closest('tr');
                row.querySelector('.faq-question').textContent = question;
                row.querySelector('.faq-answer').textContent = answer;

                // Restore the action buttons
                const actionButtons = row.querySelector('.action-buttons');
                actionButtons.innerHTML = `
                    <button class="edit-btn" data-id="${faqId}">Edit</button>
                    <button class="delete-btn" data-id="${faqId}">Delete</button>
                `;

                // Re-add event listeners for the buttons
                await fetchAllFaqs();
            } catch (error) {
                console.error('There was a problem with the update operation:', error);
            }
        }


        //Delete faq functions.............
        async function deleteFaq(faqId) {
            try {
                const response = await fetch(`/admindatacontroller/deleteFaq/${faqId}`, {
                    method: 'DELETE'
                });
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Remove the FAQ from the DOM
                document.querySelector(`button[data-id="${faqId}"]`).closest('tr').remove();
            } catch (error) {
                console.error('There was a problem with the delete operation:', error);
            }
        }
    </script>
</body>

</html>