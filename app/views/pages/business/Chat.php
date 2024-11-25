<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat UI</title>
    <link rel="stylesheet" href="../../styles/business-owner/Chat.css">
    <link rel="stylesheet" href="../../styles/business-owner/header.css">
</head>
<body>
    <?php include __DIR__ . '/../../components/businessman/header.php'; ?>

    <div class="chat-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="search">
                <input type="text" placeholder="Search...">
            </div>
            <div class="messages-list">
                <div class="message-item">
                    <img src="https://via.placeholder.com/40" alt="Cynthia Snyder">
                    <div>
                        <h4>Kavindya Adhikari</h4>
                        <p>You: 😂😂😂</p>
                    </div>
                    <span>1:17 PM</span>
                </div>
                <!-- Repeat for other contacts -->
            </div>
        </aside>

        <!-- Chat Area -->
        <main class="chat-area">
            <header class="chat-header">
                <div class="profile">
                    <img src="https://via.placeholder.com/50" alt="Cynthia Snyder">
                    <div>
                        <h3>Cynthia Snyder</h3>
                        <p>Active now</p>
                    </div>
                </div>
                <div class="options">...</div>
            </header>

            <div class="chat-content">
                <div class="message">
                    <img src="https://via.placeholder.com/40" alt="Cynthia">
                    <div class="text">Lorem excepteur magna voluptate exercitation dolore exercitation amet</div>
                </div>
                <div class="message file">
                    <img src="https://via.placeholder.com/40" alt="Cynthia">
                    <div class="text">File-name-11 Oct 2021 (120 KB)</div>
                </div>
                <div class="message reply">
                    <div class="text">Sit non esse est voluptate elit eiusmod. Ad eu est.</div>
                    <img src="https://via.placeholder.com/40" alt="You">
                </div>
                <!-- Add more messages -->
            </div>

            <footer class="chat-footer">
                <input type="text" placeholder="Type a message...">
                <button>Send</button>
            </footer>
        </main>

        <!-- Profile Details -->
        <aside class="profile-details">
            <div class="profile-card">
                <img src="https://via.placeholder.com/100" alt="Cynthia Snyder">
                <h3>Cynthia Snyder</h3>
                <p>Influencer</p>
                <a href="mailto:example@gmail.com">example@gmail.com</a>
            </div>
            <div class="media">
                <h4>Image (50)</h4>
                <div class="grid">
                    <img src="https://via.placeholder.com/60" alt="Media 1">
                    <img src="https://via.placeholder.com/60" alt="Media 2">
                    <img src="https://via.placeholder.com/60" alt="Media 3">
                </div>
                <a href="#">View all</a>
            </div>
            <div class="files">
                <h4>File (12)</h4>
                <!-- File list -->
            </div>
        </aside>
    </div>
</body>
</html>
