<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Faqs</title>
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <link rel="stylesheet" href="../../styles/admin/viewAllFaqs.css">
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
                        <a href="http://localhost:8000/AdminViewController/deleteFaq/<?php echo $faq->id; ?>"
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
            <form action="/AdminViewController/addFaq" method="POST">
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

            const response = await fetch(`/AdminViewController/updateFaq/${id}`, {
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