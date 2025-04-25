<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>BrandBoost - Chat</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c63ff;
            --secondary-color: #f7f8fc;
            --accent-color: #564af5;
            --text-primary: #333;
            --text-secondary: #666;
            --text-muted: #888;
            --border-color: #e6e6e6;
            --light-bg: #fff;
            --hover-bg: #f0f0f0;
            --sent-message-bg: #e6e6ff;
            --received-message-bg: #fff;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-primary);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 300px;
            background-color: var(--light-bg);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 24px;
            padding-left: 12%;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            background: linear-gradient(270deg, #8A2BE2, #4169E1);
        }

        .sidebar-header .brand {
            font-weight: 700;
            font-size: 20px;
            /* color: var(--primary-color); */
            color: white;
        }

        .sidebar-header .back-button {
            margin-right: 10px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .sidebar input {
            margin: 15px 20px;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .sidebar input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 1px 5px rgba(108, 99, 255, 0.2);
        }

        .sidebar .all-messages {
            padding: 0 20px 10px;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar .all-messages .message-count {
            background-color: var(--primary-color);
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 12px;
        }

        .sidebar .message-list {
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar .message-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .sidebar .message-item:hover {
            background-color: var(--hover-bg);
        }

        .sidebar .message-item.active {
            background-color: rgba(108, 99, 255, 0.1);
        }

        .sidebar .message-item .avatar {
            position: relative;
        }

        .sidebar .message-item .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #2ecc71;
            position: absolute;
            bottom: 0;
            right: 0;
            border: 2px solid white;
        }

        .sidebar .message-item img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            border: 1px solid var(--border-color);
        }

        .sidebar .message-item .message-info {
            flex-grow: 1;
            overflow: hidden;
        }

        .sidebar .message-item .message-info .name-time {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }

        .sidebar .message-item .message-info .name {
            font-weight: 600;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar .message-item .message-info .time {
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .sidebar .message-item .message-info .text {
            color: var(--text-secondary);
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar .message-item .unread-badge {
            width: 18px;
            height: 18px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }

        .avatar a {
            display: block;
            position: relative;
            color: inherit;
            text-decoration: none;
        }

        .avatar a:hover {
            opacity: 0.9;
        }

        /* Chat Container Styles */
        .chat-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: var(--secondary-color);
            position: relative;
        }

        .chat-header {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            /* background-color: var(--light-bg); */
            /* background-color: var(--primary-color); */
            background: linear-gradient(135deg, #8A2BE2, #4169E1);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow);
            z-index: 10;
        }

        .chat-header img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 1px solid var(--border-color);
        }

        .chat-header a {
            color: inherit;
            text-decoration: none;
        }

        .chat-header a:hover img {
            border-color: #ffffff;
        }

        .chat-header .chat-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .chat-header .chat-info .name {
            font-weight: 600;
            /* color: var(--text-primary); */
            color: white;
            font-size: 16px;
        }

        .chat-header .chat-info .status {
            /* color: var(--text-muted); */
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
        }

        .chat-header .chat-info .status .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #2ecc71;
            margin-right: 5px;
        }

        .chat-header .chat-options {
            /* color: var(--text-muted); */
            color: white;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            gap: 15px;
        }

        .chat-header .chat-options i:hover {
            color: var(--primary-color);
        }

        .empty-state {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            padding: 30px;
            text-align: center;
        }

        .empty-state i {
            font-size: 60px;
            margin-bottom: 20px;
            color: var(--primary-color);
            opacity: 0.5;
        }

        .empty-state h3 {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--text-primary);
        }

        .empty-state p {
            max-width: 400px;
            line-height: 1.5;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: var(--secondary-color);
            display: flex;
            flex-direction: column;
        }

        .chat-messages .date-divider {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .chat-messages .date-divider span {
            padding: 5px 10px;
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 15px;
            font-size: 12px;
            color: var(--text-muted);
            margin: 0 auto;
        }

        .chat-messages .message {
            display: flex;
            align-items: flex-end;
            margin-bottom: 15px;
            max-width: 80%;
        }

        .chat-messages .message a {
            text-decoration: none;
            display: block;
        }

        .chat-messages .message a:hover img {
            border-color: var(--primary-color);
        }

        .chat-messages .message.received {
            align-self: flex-start;
        }

        .chat-messages .message.sent {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .chat-messages .message img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin: 0 10px;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        .chat-messages .message .message-content {
            display: flex;
            flex-direction: column;
        }

        .chat-messages .message .message-content .text {
            padding: 12px 15px;
            border-radius: 18px;
            font-size: 14px;
            position: relative;
            max-width: 450px;
            word-wrap: break-word;
            line-height: 1.5;
        }

        .chat-messages .message.received .message-content .text {
            background-color: var(--received-message-bg);
            color: var(--text-primary);
            border-bottom-left-radius: 4px;
            box-shadow: var(--shadow);
        }

        .chat-messages .message.sent .message-content .text {
            background-color: var(--primary-color);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .chat-messages .message .message-content .time {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 3px;
            display: flex;
            align-items: center;
        }

        .chat-messages .message.sent .message-content .time {
            justify-content: flex-end;
        }

        .chat-messages .message .message-content .time i {
            font-size: 10px;
            margin-left: 4px;
        }

        .chat-input-container {
            padding: 15px 20px;
            background-color: var(--light-bg);
            border-top: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
        }

        .chat-input {
            display: flex;
            align-items: center;
            background-color: var(--secondary-color);
            border-radius: 24px;
            padding: 0 5px 0 20px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .chat-input .input-wrapper {
            flex-grow: 1;
            position: relative;
        }

        .chat-input textarea {
            width: 100%;
            border: none;
            padding: 12px 0;
            font-size: 14px;
            resize: none;
            background: transparent;
            max-height: 120px;
            outline: none;
            font-family: 'Inter', sans-serif;
        }

        .chat-input .actions {
            display: flex;
            align-items: center;
        }

        .chat-input .action-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
            font-size: 18px;
        }

        .chat-input .action-button:hover {
            background-color: var(--hover-bg);
            color: var(--primary-color);
        }

        .chat-input .send-button {
            margin-left: 5px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 18px;
        }

        .chat-input .send-button:hover {
            background-color: var(--accent-color);
        }

        /* Hide elements when not active */
        .hidden {
            display: none !important;
        }

        /* Mobile view */
        .mobile-toggle {
            display: none;
            font-size: 18px;
        }

        /* Loading spinner */
        .spinner {
            width: 30px;
            height: 30px;
            border: 3px solid rgba(108, 99, 255, 0.2);
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 1s ease-in-out infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Chat interface container */
        .chat-interface {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            max-height: 100vh;
        }

        /* Loaders and Animations */
        .typing-indicator {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-left: 15px;
        }

        .typing-indicator span {
            height: 8px;
            width: 8px;
            border-radius: 50%;
            background-color: var(--text-muted);
            display: inline-block;
            margin-right: 3px;
            animation: typing 1s infinite;
        }

        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                transform: translateX(-100%);
                z-index: 100;
                width: 80%;
                max-width: 300px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .chat-header .mobile-toggle {
                display: block;
                margin-right: 10px;
                cursor: pointer;
                color: var(--text-muted);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Chat Sidebar -->
        <div class="sidebar active" id="sidebar">
            <div class="sidebar-header">
                <a href="/" class="brand">BrandBoost</a>
            </div>
            <input type="text" placeholder="Search contacts..." id="contact-search">
            <div class="all-messages">
                <span>Conversations</span>
                <span class="message-count" id="conversation-count">0</span>
            </div>
            <div class="message-list" id="conversation-list">
                <!-- Conversation list will be loaded dynamically -->
                <div class="spinner" id="conversations-loader"></div>
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="chat-container">
            <!-- Empty State (shown when no chat is selected) -->
            <div class="empty-state" id="empty-state">
                <i class="far fa-comments"></i>
                <h3>Your Messages</h3>
                <p>Select a conversation or start a new one to chat with your collaborators.</p>
            </div>

            <!-- Chat Interface (hidden initially) -->
            <div class="chat-interface hidden" id="chat-interface">
                <div class="chat-header">
                    <div class="mobile-toggle" id="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </div>
                    <a href="#" id="chat-user-profile-link">
                        <img src="" alt="Profile picture" id="chat-user-avatar">
                    </a>
                    <div class="chat-info">
                        <div class="name" id="chat-user-name"></div>
                        <div class="status"><span class="status-dot"></span> <span id="chat-user-status">Active now</span></div>
                    </div>
                </div>

                <div class="chat-messages" id="chat-messages">
                    <!-- Messages will be loaded dynamically -->
                    <div class="spinner" id="messages-loader"></div>
                </div>

                <div class="chat-input-container">
                    <div class="chat-input">
                        <div class="input-wrapper">
                            <textarea id="message-input" placeholder="Type a message..." rows="1"></textarea>
                        </div>
                        <div class="actions">
                            <button class="send-button" id="send-button" title="Send message">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const sidebar = document.getElementById('sidebar');
            const conversationList = document.getElementById('conversation-list');
            const conversationsLoader = document.getElementById('conversations-loader');
            const conversationCount = document.getElementById('conversation-count');
            const contactSearch = document.getElementById('contact-search');
            const chatInterface = document.getElementById('chat-interface');
            const emptyState = document.getElementById('empty-state');
            const chatMessages = document.getElementById('chat-messages');
            const messagesLoader = document.getElementById('messages-loader');
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');
            const sidebarToggle = document.getElementById('sidebar-toggle');

            // Chat user elements
            const chatUserAvatar = document.getElementById('chat-user-avatar');
            const chatUserName = document.getElementById('chat-user-name');
            const chatUserStatus = document.getElementById('chat-user-status');
            const chatUserStatusDot = document.querySelector('.chat-info .status .status-dot');
            const chatUserProfileLink = document.getElementById('chat-user-profile-link');

            // WebSocket connection
            let socket;
            let currentUserId = null; // The logged-in user's ID
            let activeConversation = null; // The currently selected conversation
            let conversationsData = []; // Store all conversations
            let messagesData = {}; // Store messages by conversation ID
            let currentToken = ''; // Authentication token
            let typingTimeout = null; // For typing indicator
            let reconnectAttempts = 0; // Track reconnection attempts

            // Initialize chat application
            function initChat() {
                // Get user session token from cookie
                currentToken = getCookie('session_token');

                if (!currentToken) {
                    // Redirect to login if not authenticated
                    window.location.href = '/login';
                    return;
                }

                // Connect to WebSocket server
                connectWebSocket();

                // Set up event listeners
                setupEventListeners();

                // Auto-resize textarea
                autoResizeTextarea();
            }

            // Connect to WebSocket server
            function connectWebSocket() {
                const protocol = window.location.protocol === 'https:' ? 'wss:' : 'ws:';
                const wsUrl = `${protocol}//${window.location.hostname}:8080`;

                socket = new WebSocket(wsUrl);

                socket.addEventListener('open', () => {
                    console.log('WebSocket connection established');
                    // Reset reconnect attempts on successful connection
                    reconnectAttempts = 0;

                    // // Authenticate with token
                    // socket.send(JSON.stringify({
                    //     type: 'auth',
                    //     token: currentToken
                    // }));
                });

                socket.addEventListener('message', handleSocketMessage);

                socket.addEventListener('close', () => {
                    console.log('WebSocket connection closed');

                    // Exponential backoff for reconnection
                    const delay = Math.min(30000, Math.pow(2, reconnectAttempts) * 1000);
                    reconnectAttempts++;

                    console.log(`Attempting to reconnect in ${delay/1000} seconds...`);
                    setTimeout(connectWebSocket, delay);
                });

                socket.addEventListener('error', (error) => {
                    console.error('WebSocket error:', error);
                });
            }

            // Handle incoming socket messages
            function handleSocketMessage(event) {
                const data = JSON.parse(event.data);
                console.log('Received message:', data);

                switch (data.type) {
                    case 'auth_success':
                        // Authentication successful
                        currentUserId = data.userId;
                        // Fetch conversations once authenticated
                        fetchConversations();
                        break;

                    case 'auth_failed':
                        // Authentication failed
                        console.error('Authentication failed');
                        // Redirect to login
                        window.location.href = '/login';
                        break;

                    case 'auth_required':
                        // Authentication required
                        if (currentToken) {
                            socket.send(JSON.stringify({
                                type: 'auth',
                                token: currentToken
                            }));
                        } else {
                            window.location.href = '/login';
                        }
                        break;

                    case 'message':
                        // New message received
                        const {
                            from, id, message, created_at
                        } = data;

                        // Add message to conversation
                        if (activeConversation && activeConversation.userId == from) {
                            addMessageToChat({
                                message_id: id,
                                sender_id: from,
                                message: message,
                                read_status: 'delivered',
                                created_at: created_at
                            }, true);

                            // Mark as read if the conversation is currently active
                            socket.send(JSON.stringify({
                                type: 'mark_read',
                                to: from
                            }));
                        }

                        // Update conversation in the list
                        updateConversationPreview(from, message, created_at);

                        // Play notification sound if not active conversation
                        if (!activeConversation || activeConversation.userId != from) {
                            playNotificationSound();
                        }
                        break;

                    case 'history':
                        // Chat history received
                        if (data.messages && data.withUserId) {
                            const userId = data.withUserId;
                            messagesData[userId] = data.messages;

                            if (activeConversation && activeConversation.userId == userId) {
                                displayMessages(data.messages);
                            }
                        }
                        messagesLoader.classList.add('hidden');
                        break;

                    case 'message_sent':
                        // Confirmation message was sent
                        if (activeConversation && activeConversation.userId == data.to) {
                            // Update the last sent message status
                            updateLastMessageStatus('sent', data.id);
                        }
                        break;

                    case 'messages_read':
                        // Messages have been read by recipient
                        if (data.by && activeConversation && activeConversation.userId == data.by) {
                            // Update all sent messages to read status
                            updateAllMessagesStatus('read');
                        }
                        break;

                    case 'error':
                        console.error('Socket error:', data.message);
                        // Show error toast/notification to user
                        showErrorToast(data.message);
                        break;

                    case 'conversations':
                        // Received list of conversations
                        conversationsData = data.conversations;
                        displayConversations(conversationsData);
                        conversationsLoader.classList.add('hidden');
                        break;

                    case 'user_status':
                        // User status update (online/offline)
                        updateUserStatus(data.userId, data.status);
                        break;

                    case 'typing':
                        // User is typing
                        if (activeConversation && activeConversation.userId == data.userId) {
                            showTypingIndicator();
                        }
                        break;

                    case 'typing_stop':
                        // User stopped typing
                        if (activeConversation && activeConversation.userId == data.userId) {
                            hideTypingIndicator();
                        }
                        break;
                }
            }

            // Set up event listeners
            function setupEventListeners() {
                // Send message on button click
                sendButton.addEventListener('click', sendMessage);

                // Send message on Enter (but new line on Shift+Enter)
                messageInput.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter' && !event.shiftKey) {
                        event.preventDefault();
                        sendMessage();
                    }
                });

                // Typing indicator
                messageInput.addEventListener('input', handleTypingIndicator);

                // Toggle sidebar on mobile
                if (sidebarToggle) {
                    sidebarToggle.addEventListener('click', () => {
                        sidebar.classList.toggle('active');
                        // Add overlay when sidebar is active (for mobile)
                        if (sidebar.classList.contains('active')) {
                            createOverlay('sidebar-overlay', () => {
                                sidebar.classList.remove('active');
                            });
                        } else {
                            removeOverlay('sidebar-overlay');
                        }
                    });
                }

                // Search contacts
                contactSearch.addEventListener('input', (e) => {
                    const searchTerm = e.target.value.toLowerCase();
                    filterConversations(searchTerm);
                });
            }

            // Handle typing indicator
            function handleTypingIndicator() {
                if (!activeConversation) return;

                // Send typing status
                socket.send(JSON.stringify({
                    type: 'typing',
                    to: activeConversation.userId
                }));

                // Clear existing timeout if any
                if (typingTimeout) {
                    clearTimeout(typingTimeout);
                }

                // Set timeout to send typing_stop after 3 seconds of inactivity
                typingTimeout = setTimeout(() => {
                    socket.send(JSON.stringify({
                        type: 'typing_stop',
                        to: activeConversation.userId
                    }));
                }, 3000);
            }

            // Show typing indicator in chat
            function showTypingIndicator() {
                // Check if indicator already exists
                if (document.querySelector('.typing-indicator')) return;

                const typingIndicator = document.createElement('div');
                typingIndicator.className = 'typing-indicator';
                typingIndicator.innerHTML = `
                    <span></span>
                    <span></span>
                    <span></span>
                `;

                chatMessages.appendChild(typingIndicator);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Hide typing indicator
            function hideTypingIndicator() {
                const indicator = document.querySelector('.typing-indicator');
                if (indicator) {
                    indicator.remove();
                }
            }

            // Create overlay for mobile views
            function createOverlay(id, closeCallback) {
                let overlay = document.getElementById(id);
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.id = id;
                    overlay.style.position = 'fixed';
                    overlay.style.top = '0';
                    overlay.style.left = '0';
                    overlay.style.width = '100%';
                    overlay.style.height = '100%';
                    overlay.style.backgroundColor = 'rgba(0,0,0,0.5)';
                    overlay.style.zIndex = '90';
                    document.body.appendChild(overlay);

                    overlay.addEventListener('click', () => {
                        closeCallback();
                        removeOverlay(id);
                    });
                }
            }

            // Remove overlay
            function removeOverlay(id) {
                const overlay = document.getElementById(id);
                if (overlay) {
                    document.body.removeChild(overlay);
                }
            }

            // Auto-resize textarea
            function autoResizeTextarea() {
                messageInput.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
            }

            // Fetch conversations list
            function fetchConversations() {
                conversationsLoader.classList.remove('hidden');

                // Request conversations list - this was using the wrong message type
                socket.send(JSON.stringify({
                    type: 'fetch_conversations'
                }));

                // If no response in 5 seconds, show an error
                setTimeout(() => {
                    if (conversationsLoader.classList.contains('hidden') === false) {
                        conversationsLoader.classList.add('hidden');
                        conversationList.innerHTML = '<div class="message-item">Failed to load conversations. Please reload the page.</div>';
                    }
                }, 5000);
            }

            // Display conversations in the sidebar
            function displayConversations(conversations) {
                // Clear the list
                conversationList.innerHTML = '';

                // Update conversation count
                conversationCount.textContent = conversations.length;

                // No conversations state
                if (conversations.length === 0) {
                    const emptyItem = document.createElement('div');
                    emptyItem.className = 'message-item';
                    emptyItem.innerHTML = '<div class="message-info">No conversations yet</div>';
                    conversationList.appendChild(emptyItem);
                    return;
                }

                // Sort conversations by last message time (newest first)
                conversations.sort((a, b) => {
                    return new Date(b.lastMessageTime) - new Date(a.lastMessageTime);
                });

                // Create conversation items
                conversations.forEach(conversation => {
                    const conversationItem = createConversationItem(conversation);
                    conversationList.appendChild(conversationItem);
                });
            }

            // Create a conversation item element
            function createConversationItem(conversation) {
                const {
                    userId,
                    name,
                    avatar,
                    lastMessage,
                    lastMessageTime,
                    unread,
                    status
                } = conversation;

                const item = document.createElement('div');
                item.className = 'message-item';
                item.dataset.userId = userId;

                // Format time
                const timeFormatted = formatMessageTime(lastMessageTime);

                // Status indicator for online/offline
                const statusClass = status === 'online' ? 'status-indicator' : 'hidden';

                // Modified HTML structure with clickable avatar
                item.innerHTML = `
                <div class="avatar">
                    <a href="/user/${userId}" onclick="event.stopPropagation();">
                        <img src="${avatar}" alt="Profile picture of ${name}" width="40" height="40">
                        <div class="${statusClass}"></div>
                    </a>
                </div>
                <div class="message-info">
                    <div class="name-time">
                        <span class="name">${name}</span>
                        <span class="time">${timeFormatted}</span>
                    </div>
                    <div class="text">${lastMessage || 'Start a conversation'}</div>
                </div>
                ${unread > 0 ? `<div class="unread-badge">${unread}</div>` : ''}
            `;

                // Click event to open the conversation
                item.addEventListener('click', () => {
                    openConversation(conversation);
                });

                return item;
            }

            // Open a conversation
            function openConversation(conversation) {
                // Update active conversation
                activeConversation = conversation;

                // Remove active class from all conversation items
                const items = conversationList.querySelectorAll('.message-item');
                items.forEach(item => item.classList.remove('active'));

                // Add active class to selected conversation
                const selectedItem = conversationList.querySelector(`.message-item[data-user-id="${conversation.userId}"]`);
                if (selectedItem) {
                    selectedItem.classList.add('active');

                    // Remove unread badge if exists
                    const unreadBadge = selectedItem.querySelector('.unread-badge');
                    if (unreadBadge) {
                        unreadBadge.remove();
                    }

                    // Update the unread count in the conversation data
                    conversation.unread = 0;
                }

                // Show chat interface, hide empty state
                emptyState.classList.add('hidden');
                chatInterface.classList.remove('hidden');

                // Update chat header with user info
                chatUserAvatar.src = conversation.avatar;
                chatUserAvatar.alt = `Profile picture of ${conversation.name}`;
                chatUserName.textContent = conversation.name;

                // Set the profile link URL
                chatUserProfileLink.href = `/user/${conversation.userId}`;

                // Update status indicator
                updateStatusDisplay(conversation.status);

                // Show loading spinner
                messagesLoader.classList.remove('hidden');
                chatMessages.innerHTML = '';
                chatMessages.appendChild(messagesLoader);

                // Request chat history
                socket.send(JSON.stringify({
                    type: 'fetch_history',
                    withUserId: conversation.userId
                }));

                // Mark messages as read
                socket.send(JSON.stringify({
                    type: 'mark_read',
                    to: conversation.userId
                }));

                // Focus the message input
                setTimeout(() => {
                    messageInput.focus();
                }, 300);

                // If we already have messages for this conversation, display them
                if (messagesData[conversation.userId]) {
                    setTimeout(() => {
                        displayMessages(messagesData[conversation.userId]);
                    }, 300);
                }

                // Hide any typing indicator
                hideTypingIndicator();
            }

            // Update status display in chat header
            function updateStatusDisplay(status) {
                chatUserStatus.textContent = status === 'online' ? 'Active now' : 'Offline';
                chatUserStatusDot.style.backgroundColor = status === 'online' ? '#2ecc71' : '#ccc';
            }

            // Display messages in the chat window
            function displayMessages(messages) {
                // Clear the messages area
                chatMessages.innerHTML = '';

                if (!messages || messages.length === 0) {
                    const emptyState = document.createElement('div');
                    emptyState.className = 'empty-state';
                    emptyState.innerHTML = `
                        <i class="far fa-comment"></i>
                        <h3>No messages yet</h3>
                        <p>Start the conversation by sending a message below.</p>
                    `;
                    chatMessages.appendChild(emptyState);
                    return;
                }

                // Sort messages by time
                messages.sort((a, b) => {
                    return new Date(a.created_at) - new Date(b.created_at);
                });

                // Group messages by date
                let currentDate = null;

                messages.forEach(message => {
                    // Check if we need to add a date divider
                    const messageDate = new Date(message.created_at).toDateString();
                    if (messageDate !== currentDate) {
                        currentDate = messageDate;
                        const dateDivider = document.createElement('div');
                        dateDivider.className = 'date-divider';
                        dateDivider.innerHTML = `<span>${formatDateForDivider(new Date(message.created_at))}</span>`;
                        chatMessages.appendChild(dateDivider);
                    }

                    // Add the message
                    addMessageToChat(message);
                });

                // Scroll to the bottom of the chat
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Add a single message to the chat
            function addMessageToChat(message, isNew = false) {
                const isSent = message.sender_id == currentUserId;

                const messageEl = document.createElement('div');
                messageEl.className = `message ${isSent ? 'sent' : 'received'}`;
                messageEl.dataset.messageId = message.message_id || '';

                // Avatar HTML (only for received messages)
                const avatarHtml = isSent ? '' : `
                <a href="/user/${activeConversation.userId}">
                    <img src="${activeConversation.avatar}" alt="Profile picture">
                </a>`;

                // Format time
                const time = new Date(message.created_at);
                const timeFormatted = time.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Add read/delivered status icon for sent messages
                const statusIcon = isSent ?
                    (message.read_status === 'read' ?
                        '<i class="fas fa-check-double" style="color: #2ecc71;"></i>' :
                        message.read_status === 'delivered' ?
                        '<i class="fas fa-check-double"></i>' :
                        '<i class="fas fa-check"></i>') :
                    '';

                messageEl.innerHTML = `
                ${avatarHtml}
                <div class="message-content">
                    <div class="text">${formatMessageText(message.message)}</div>
                    <div class="time">${timeFormatted} ${statusIcon}</div>
                </div>
            `;

                // Add the message to the chat
                chatMessages.appendChild(messageEl);

                // If it's a new message, scroll to it
                if (isNew) {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            }

            // Send a message
            function sendMessage() {
                if (!activeConversation || !messageInput) return;

                const message = messageInput.value.trim();
                if (message === '') return;

                // Clear input
                messageInput.value = '';
                messageInput.style.height = 'auto';

                // Send message to server
                socket.send(JSON.stringify({
                    type: 'message',
                    to: activeConversation.userId,
                    message: message
                }));

                // Add message to the chat (optimistic UI update)
                const now = new Date();
                addMessageToChat({
                    sender_id: currentUserId,
                    message: message,
                    created_at: now.toISOString(),
                    read_status: 'sent'
                }, true);

                // Update conversation preview
                updateConversationPreview(activeConversation.userId, message, now.toISOString());

                // Send typing_stop since we've sent the message
                socket.send(JSON.stringify({
                    type: 'typing_stop',
                    to: activeConversation.userId
                }));

                // Clear typing timeout
                if (typingTimeout) {
                    clearTimeout(typingTimeout);
                    typingTimeout = null;
                }
            }

            // Update conversation preview in sidebar
            function updateConversationPreview(userId, message, timestamp) {
                // Find the conversation in our data
                let conversation = conversationsData.find(c => c.userId == userId);

                if (conversation) {
                    // Update the conversation data
                    conversation.lastMessage = message;
                    conversation.lastMessageTime = timestamp;

                    // If the message is from someone else and not the active conversation, increment unread
                    if (userId != currentUserId && (!activeConversation || activeConversation.userId != userId)) {
                        conversation.unread = (conversation.unread || 0) + 1;
                    }
                } else {
                    // If conversation doesn't exist yet, fetch user details and create it
                    // This handles the case of a new conversation
                    fetchUserDetails(userId).then(user => {
                        if (user) {
                            conversation = {
                                userId: userId,
                                name: user.name,
                                avatar: user.avatar,
                                lastMessage: message,
                                lastMessageTime: timestamp,
                                unread: userId != currentUserId ? 1 : 0,
                                status: user.status || 'offline'
                            };

                            conversationsData.push(conversation);

                            // Create a new conversation item
                            const newItem = createConversationItem(conversation);
                            conversationList.insertBefore(newItem, conversationList.firstChild);

                            // Update conversation count
                            conversationCount.textContent = conversationsData.length;
                        }
                    });
                    return;
                }

                // Find the conversation item in the DOM
                const conversationItem = conversationList.querySelector(`.message-item[data-user-id="${userId}"]`);

                if (conversationItem) {
                    // Update the item
                    const messageText = conversationItem.querySelector('.text');
                    const timeElement = conversationItem.querySelector('.time');
                    messageText.textContent = message;
                    timeElement.textContent = formatMessageTime(timestamp);

                    // Update unread badge
                    let unreadBadge = conversationItem.querySelector('.unread-badge');
                    if (conversation.unread > 0) {
                        if (!unreadBadge) {
                            unreadBadge = document.createElement('div');
                            unreadBadge.className = 'unread-badge';
                            conversationItem.appendChild(unreadBadge);
                        }
                        unreadBadge.textContent = conversation.unread;
                    } else if (unreadBadge) {
                        unreadBadge.remove();
                    }

                    // Move the conversation to the top
                    conversationList.insertBefore(conversationItem, conversationList.firstChild);
                } else {
                    // Create a new conversation item
                    const newItem = createConversationItem(conversation);
                    conversationList.insertBefore(newItem, conversationList.firstChild);
                }
            }

            // Fetch user details for a new conversation
            function fetchUserDetails(userId) {
                // This would typically be an API call to get user details
                // For now, we'll return a mock user
                return Promise.resolve({
                    name: `User ${userId}`,
                    avatar: '/assets/default-avatar.png',
                    status: 'offline'
                });
            }

            // Update last message status
            function updateLastMessageStatus(status, messageId) {
                // If message ID provided, find that specific message
                if (messageId) {
                    const messageEl = document.querySelector(`.message[data-message-id="${messageId}"]`);
                    if (messageEl) {
                        updateMessageStatusIcon(messageEl, status);
                    }
                    return;
                }

                // Otherwise find the last sent message
                const sentMessages = chatMessages.querySelectorAll('.message.sent');
                if (sentMessages.length === 0) return;

                const lastMessage = sentMessages[sentMessages.length - 1];
                updateMessageStatusIcon(lastMessage, status);
            }

            // Update message status icon
            function updateMessageStatusIcon(messageEl, status) {
                const statusIcon = messageEl.querySelector('.time i');

                if (statusIcon) {
                    switch (status) {
                        case 'sent':
                            statusIcon.className = 'fas fa-check';
                            statusIcon.style.color = '';
                            break;
                        case 'delivered':
                            statusIcon.className = 'fas fa-check-double';
                            statusIcon.style.color = '';
                            break;
                        case 'read':
                            statusIcon.className = 'fas fa-check-double';
                            statusIcon.style.color = '#2ecc71';
                            break;
                    }
                }
            }

            // Update all messages to a certain status
            function updateAllMessagesStatus(status) {
                const sentMessages = chatMessages.querySelectorAll('.message.sent');
                sentMessages.forEach(message => {
                    updateMessageStatusIcon(message, status);
                });
            }

            // Update user status in conversation list
            function updateUserStatus(userId, status) {
                // Update in conversation data
                const conversation = conversationsData.find(c => c.userId == userId);
                if (conversation) {
                    conversation.status = status;
                }

                // Update in UI
                const conversationItem = conversationList.querySelector(`.message-item[data-user-id="${userId}"]`);
                if (conversationItem) {
                    const statusIndicator = conversationItem.querySelector('.status-indicator');
                    if (status === 'online') {
                        statusIndicator.classList.remove('hidden');
                    } else {
                        statusIndicator.classList.add('hidden');
                    }
                }

                // Update in active conversation if applicable
                if (activeConversation && activeConversation.userId == userId) {
                    updateStatusDisplay(status);
                }
            }

            // Filter conversations by search term
            function filterConversations(searchTerm) {
                if (!searchTerm) {
                    // If search is empty, show all conversations
                    displayConversations(conversationsData);
                    return;
                }

                // Filter conversations that match the search term
                const filtered = conversationsData.filter(conversation => {
                    return conversation.name.toLowerCase().includes(searchTerm);
                });

                displayConversations(filtered);
            }

            // Show error toast
            function showErrorToast(message) {
                const toast = document.createElement('div');
                toast.className = 'error-toast';
                toast.textContent = message;
                toast.style.position = 'fixed';
                toast.style.bottom = '20px';
                toast.style.right = '20px';
                toast.style.padding = '10px 15px';
                toast.style.backgroundColor = '#e74c3c';
                toast.style.color = 'white';
                toast.style.borderRadius = '5px';
                toast.style.zIndex = '1000';
                toast.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';

                document.body.appendChild(toast);

                // Remove after 5 seconds
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 500);
                }, 5000);
            }

            // Play notification sound for new messages
            function playNotificationSound() {
                // Create audio element if needed
                let audio = document.getElementById('notification-sound');
                if (!audio) {
                    audio = document.createElement('audio');
                    audio.id = 'notification-sound';
                    audio.src = '/assets/notification.mp3'; // You'll need to provide this file
                    audio.style.display = 'none';
                    document.body.appendChild(audio);
                }

                audio.play().catch(e => {
                    console.log('Could not play notification sound:', e);
                    // This often fails due to browser autoplay restrictions
                });
            }

            // Insert text at cursor position in textarea
            function insertTextAtCursor(input, text) {
                const start = input.selectionStart;
                const end = input.selectionEnd;
                const value = input.value;

                input.value = value.substring(0, start) + text + value.substring(end);

                // Move cursor after inserted text
                input.selectionStart = input.selectionEnd = start + text.length;
                input.focus();

                // Trigger resize
                const event = new Event('input', {
                    bubbles: true
                });
                input.dispatchEvent(event);
            }

            // Utility Functions

            // Format message time
            function formatMessageTime(timestamp) {
                if (!timestamp) return '';

                const date = new Date(timestamp);
                const now = new Date();

                // If it's today, show time
                if (date.toDateString() === now.toDateString()) {
                    return date.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }

                // If it's yesterday, show "Yesterday"
                const yesterday = new Date(now);
                yesterday.setDate(now.getDate() - 1);
                if (date.toDateString() === yesterday.toDateString()) {
                    return 'Yesterday';
                }

                // If it's this year, show month and day
                if (date.getFullYear() === now.getFullYear()) {
                    return date.toLocaleDateString([], {
                        month: 'short',
                        day: 'numeric'
                    });
                }

                // Otherwise show date
                return date.toLocaleDateString([], {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }

            // Format date for the date divider
            function formatDateForDivider(date) {
                const now = new Date();

                // If it's today
                if (date.toDateString() === now.toDateString()) {
                    return 'Today';
                }

                // If it's yesterday
                const yesterday = new Date(now);
                yesterday.setDate(now.getDate() - 1);
                if (date.toDateString() === yesterday.toDateString()) {
                    return 'Yesterday';
                }

                // If it's within the last 7 days
                const oneWeekAgo = new Date(now);
                oneWeekAgo.setDate(now.getDate() - 7);
                if (date > oneWeekAgo) {
                    return date.toLocaleDateString([], {
                        weekday: 'long'
                    });
                }

                // Otherwise show full date
                return date.toLocaleDateString([], {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }

            // Format message text (process URLs, etc.)
            function formatMessageText(text) {
                if (!text) return '';

                // Escape HTML to prevent XSS
                text = text.replace(/</g, '&lt;').replace(/>/g, '&gt;');

                // Convert URLs to links
                text = text.replace(
                    /(https?:\/\/[^\s]+)/g,
                    '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>'
                );

                // Replace line breaks with <br>
                text = text.replace(/\n/g, '<br>');

                return text;
            }

            // Get cookie by name
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }

            // Initialize the chat application
            initChat();
        });
    </script>
</body>

</html>