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
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
        }

        .sidebar-header .brand {
            font-weight: 700;
            font-size: 20px;
            color: var(--primary-color);
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
            padding: 15px 20px;
            background-color: var(--light-bg);
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

        .chat-header .chat-info {
            flex-grow: 1;
        }

        .chat-header .chat-info .name {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 16px;
        }

        .chat-header .chat-info .status {
            color: var(--text-muted);
            font-size: 13px;
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
            color: var(--text-muted);
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

        .chat-messages .message .message-content .file {
            background-color: var(--hover-bg);
            padding: 12px 15px;
            border-radius: 18px;
            font-size: 14px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            box-shadow: var(--shadow);
        }

        .chat-messages .message .message-content .file i {
            margin-right: 10px;
            font-size: 18px;
            color: var(--primary-color);
        }

        .chat-messages .message .message-content .image-preview {
            max-width: 250px;
            max-height: 300px;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 5px;
            box-shadow: var(--shadow);
        }

        .chat-messages .message .message-content .image-preview img {
            width: 100%;
            height: auto;
            border-radius: 0;
            margin: 0;
            border: none;
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

        /* Profile Sidebar */
        .profile-sidebar {
            width: 300px;
            background-color: var(--light-bg);
            border-left: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: all 0.3s ease;
            display: block;
        }
        /* .profile-sidebar.active{
            display: block;
        } */

        .profile-sidebar-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .profile-sidebar-header h3 {
            font-weight: 600;
            font-size: 16px;
        }

        .profile-sidebar-header .close-button {
            color: var(--text-muted);
            cursor: pointer;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s;
        }

        .profile-sidebar-header .close-button:hover {
            background-color: var(--hover-bg);
            color: var(--text-primary);
        }

        .profile-sidebar .profile-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-sidebar .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
            position: relative;
            border: 3px solid var(--primary-color);
            padding: 3px;
        }

        .profile-sidebar .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-sidebar .profile-image .status-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #2ecc71;
            position: absolute;
            bottom: 5px;
            right: 5px;
            border: 3px solid white;
        }

        .profile-sidebar .name {
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 5px;
            font-size: 18px;
            text-align: center;
        }

        .profile-sidebar .role {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 20px;
            padding: 4px 12px;
            background-color: var(--secondary-color);
            border-radius: 15px;
        }

        .profile-sidebar .bio {
            color: var(--text-secondary);
            font-size: 14px;
            line-height: 1.5;
            text-align: center;
            margin-bottom: 20px;
            padding: 0 10px;
        }

        .profile-sidebar .contact-info {
            width: 100%;
            margin-bottom: 25px;
        }

        .profile-sidebar .contact-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .profile-sidebar .contact-item i {
            width: 30px;
            color: var(--primary-color);
            font-size: 16px;
        }

        .profile-sidebar .contact-item a {
            color: var(--text-secondary);
            transition: all 0.2s;
        }

        .profile-sidebar .contact-item a:hover {
            color: var(--primary-color);
        }

        .profile-sidebar .section {
            width: 100%;
            margin-bottom: 25px;
        }

        .profile-sidebar .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .profile-sidebar .section-header h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .profile-sidebar .section-header .view-all {
            color: var(--primary-color);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .profile-sidebar .section-header .view-all:hover {
            text-decoration: underline;
        }

        .profile-sidebar .media-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .profile-sidebar .media-item {
            aspect-ratio: 1/1;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .profile-sidebar .media-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s;
        }

        .profile-sidebar .media-item:hover img {
            transform: scale(1.05);
        }

        @media (max-width: 992px) {
            .profile-sidebar {
                position: absolute;
                right: 0;
                top: 0;
                height: 100%;
                transform: translateX(100%);
                z-index: 100;
                width: 80%;
                max-width: 300px;
            }

            .profile-sidebar.active {
                transform: translateX(0);
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

        /* File upload preview */
        .upload-preview {
            padding: 10px 20px;
            background-color: var(--light-bg);
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .upload-preview .preview-item {
            display: flex;
            align-items: center;
            background-color: var(--secondary-color);
            padding: 8px 12px;
            border-radius: 8px;
            margin-right: 10px;
            font-size: 13px;
        }

        .upload-preview .preview-item i {
            margin-right: 8px;
            color: var(--primary-color);
        }

        .upload-preview .preview-item .remove {
            margin-left: 8px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .upload-preview .preview-item .remove:hover {
            color: #e74c3c;
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
                    <img src="" alt="Profile picture" id="chat-user-avatar">
                    <div class="chat-info">
                        <div class="name" id="chat-user-name"></div>
                        <div class="status"><span class="status-dot"></span> <span id="chat-user-status">Active now</span></div>
                    </div>
                    <div class="chat-options">
                        <i class="fas fa-phone" title="Call"></i>
                        <i class="fas fa-user" id="profile-toggle" title="View Profile"></i>
                        <i class="fas fa-ellipsis-v" title="More options"></i>
                    </div>
                </div>

                <div class="chat-messages" id="chat-messages">
                    <!-- Messages will be loaded dynamically -->
                    <div class="spinner" id="messages-loader"></div>
                </div>

                <!-- File upload preview area (hidden initially) -->
                <div class="upload-preview hidden" id="upload-preview">
                    <!-- Preview items will be added dynamically -->
                </div>

                <div class="chat-input-container">
                    <div class="chat-input">
                        <div class="input-wrapper">
                            <textarea id="message-input" placeholder="Type a message..." rows="1"></textarea>
                        </div>
                        <div class="actions">
                            <div class="action-button" title="Attach file">
                                <i class="fas fa-paperclip"></i>
                                <input type="file" id="file-input" hidden>
                            </div>
                            <div class="action-button" title="Send emoji">
                                <i class="far fa-smile"></i>
                            </div>
                            <button class="send-button" id="send-button" title="Send message">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Profile Sidebar -->
        <div class="profile-sidebar active" id="profile-sidebar">
            <div class="profile-sidebar-header">
                <h3>Contact Info</h3>
                <div class="close-button" id="profile-close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="profile-content">
                <div class="profile-image">
                    <img src="" alt="Profile picture" id="profile-image">
                    <div class="status-dot"></div>
                </div>
                <div class="name" id="profile-name"></div>
                <div class="role" id="profile-role"></div>
                <div class="bio" id="profile-bio">
                    <!-- Bio will be loaded dynamically -->
                </div>

                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:" id="profile-email"></a>
                    </div>
                    <div class="contact-item" id="profile-phone-container">
                        <i class="fas fa-phone"></i>
                        <a href="tel:" id="profile-phone"></a>
                    </div>
                    <div class="contact-item" id="profile-location-container">
                        <i class="fas fa-map-marker-alt"></i>
                        <span id="profile-location"></span>
                    </div>
                </div>

                <div class="section" id="shared-media-section">
                    <div class="section-header">
                        <h4>Shared Media</h4>
                        <span class="view-all">View All</span>
                    </div>
                    <div class="media-grid" id="shared-media">
                        <!-- Shared media will be loaded dynamically -->
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
            const fileInput = document.getElementById('file-input');
            const uploadPreview = document.getElementById('upload-preview');
            const profileSidebar = document.getElementById('profile-sidebar');
            const profileToggle = document.getElementById('profile-toggle');
            const profileClose = document.getElementById('profile-close');
            const sidebarToggle = document.getElementById('sidebar-toggle');

            // Chat user elements
            const chatUserAvatar = document.getElementById('chat-user-avatar');
            const chatUserName = document.getElementById('chat-user-name');
            const chatUserStatus = document.getElementById('chat-user-status');

            // Profile elements
            const profileImage = document.getElementById('profile-image');
            const profileName = document.getElementById('profile-name');
            const profileRole = document.getElementById('profile-role');
            const profileBio = document.getElementById('profile-bio');
            const profileEmail = document.getElementById('profile-email');
            const profilePhone = document.getElementById('profile-phone');
            const profilePhoneContainer = document.getElementById('profile-phone-container');
            const profileLocation = document.getElementById('profile-location');
            const profileLocationContainer = document.getElementById('profile-location-container');
            const sharedMedia = document.getElementById('shared-media');
            const sharedMediaSection = document.getElementById('shared-media-section');

            // WebSocket connection
            let socket;
            let currentUserId = null; // The logged-in user's ID
            let activeConversation = []; // The currently selected conversation
            activeConversation.userId = 2; // The ID of the user in the active conversation
            let conversationsData = []; // Store all conversations
            let messagesData = {}; // Store messages by conversation ID
            let currentToken = ''; // Authentication token

            // Initialize chat application
            function initChat() {
                // Get user session token from cookie
                currentToken = getCookie('session_token');
                console.log('Session token:', currentToken);
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
                    // Authenticate with token
                    socket.send(JSON.stringify({
                        type: 'auth',
                        token: currentToken
                    }));
                });

                socket.addEventListener('message', handleSocketMessage);

                socket.addEventListener('close', () => {
                    console.log('WebSocket connection closed');
                    // Try to reconnect after 3 seconds
                    setTimeout(connectWebSocket, 3000);
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
                        console.error('Authentication failed:', data.message);
                        // Redirect to login
                        // window.location.href = '/login';
                        break;

                    case 'auth_required':
                        // Authentication required
                        if (currentToken) {
                            socket.send(JSON.stringify({
                                type: 'auth',
                                token: currentToken
                            }));
                        } else {
                            // window.location.href = '/login';
                        }
                        break;

                    case 'message':
                        // New message received
                        const {
                            from, message, created_at
                        } = data;

                        // Add message to conversation
                        if (activeConversation && activeConversation.userId == from) {
                            addMessageToChat({
                                sender_id: from,
                                message: message,
                                read_status: 'delivered',
                                created_at: created_at
                            }, true);

                            // Update as read if the conversation is currently active
                            socket.send(JSON.stringify({
                                type: 'mark_read',
                                to: from
                            }));
                        }

                        // Update conversation in the list
                        updateConversationPreview(from, message, created_at);
                        break;

                    case 'history':
                        // Chat history received
                        console.log('Chat history function called');
                        if (data.messages && data.withUserId) {
                            const userId = data.withUserId;
                            messagesData[userId] = data.messages;
                            console.log('Messages data:', messagesData);
                            console.log('User ID:', userId);

                            if (activeConversation && activeConversation.userId == userId) {
                                console.log('Displaying messages for active conversation:', userId);
                                displayMessages(data.messages);
                            }
                        }

                        messagesLoader.classList.add('hidden');
                        break;

                    case 'message_sent':
                        // Confirmation message was sent
                        if (activeConversation && activeConversation.userId == data.to) {
                            // Update the last sent message status if needed
                            updateLastMessageStatus('sent');
                        }
                        break;

                    case 'error':
                        console.error('Socket error:', data.message);
                        break;

                    case 'conversations':
                        // Received list of conversations
                        conversationsData = data.conversations;
                        displayConversations(conversationsData);
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
            
                // Toggle profile sidebar
                profileToggle.addEventListener('click', () => {
                    profileSidebar.classList.toggle('active');
                    // Add overlay when profile sidebar is active (for mobile)
                    if (profileSidebar.classList.contains('active')) {
                        createOverlay('profile-overlay', () => {
                            profileSidebar.classList.remove('hidden');
                        });
                    } else {
                        removeOverlay('profile-overlay');
                    }
                });
            
                // Close profile sidebar
                profileClose.addEventListener('click', () => {
                    profileSidebar.classList.add('hidden');
                    removeOverlay('profile-overlay');
                });
            
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
            
                // File input change
                fileInput.addEventListener('change', handleFileInput);
                
                // Make attach file button click trigger file input
                const attachButton = document.querySelector('.action-button .fa-paperclip').parentElement;
                attachButton.addEventListener('click', () => {
                    fileInput.click();
                });
            }

            // Handle file input change
            function handleFileInput(e) {
                const files = e.target.files;

                if (files.length > 0) {
                    // Clear previous previews
                    uploadPreview.innerHTML = '';

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const preview = createFilePreview(file);
                        uploadPreview.appendChild(preview);
                    }

                    uploadPreview.classList.remove('hidden');
                }
            }

            // Create file preview element
            function createFilePreview(file) {
                const preview = document.createElement('div');
                preview.className = 'preview-item';

                // Determine icon based on file type
                let icon;
                if (file.type.startsWith('image/')) {
                    icon = 'fa-image';
                } else if (file.type.startsWith('video/')) {
                    icon = 'fa-video';
                } else if (file.type.startsWith('audio/')) {
                    icon = 'fa-music';
                } else {
                    icon = 'fa-file';
                }

                preview.innerHTML = `
      <i class="fas ${icon}"></i>
      <span>${file.name}</span>
      <i class="fas fa-times remove"></i>
    `;

                // Remove button functionality
                const removeBtn = preview.querySelector('.remove');
                removeBtn.addEventListener('click', () => {
                    preview.remove();
                    if (uploadPreview.children.length === 0) {
                        uploadPreview.classList.add('hidden');
                    }
                });

                return preview;
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

                // Request recent conversations
                socket.send(JSON.stringify({
                    type: 'fetch_history',
                    withUserId: 2 // Fetch all conversations
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
                // Clear the list except for the loader
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

                // HTML structure
                item.innerHTML = `
      <div class="avatar">
        <img src="${avatar}" alt="Profile picture of ${name}" width="40" height="40">
        <div class="${statusClass}"></div>
      </div>
      <div class="message-info">
        <div class="name-time">
          <span class="name">${name}</span>
          <span class="time">${timeFormatted}</span>
        </div>
        <div class="text">${lastMessage}</div>
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
                }

                // Show chat interface, hide empty state
                emptyState.classList.add('hidden');
                chatInterface.classList.remove('hidden');

                // Update chat header with user info
                chatUserAvatar.src = conversation.avatar;
                chatUserAvatar.alt = `Profile picture of ${conversation.name}`;
                chatUserName.textContent = conversation.name;
                chatUserStatus.textContent = conversation.status === 'online' ? 'Active now' : 'Offline';

                // Update profile sidebar
                updateProfileSidebar(conversation);

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

                // If we already have messages for this conversation, display them
                if (messagesData[conversation.userId]) {
                    setTimeout(() => {
                        displayMessages(messagesData[conversation.userId]);
                    }, 300);
                }
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

                // Avatar HTML (only for received messages or the first message in a sequence)
                const avatarHtml = isSent ? '' : `<img src="${activeConversation.avatar}" alt="Profile picture">`;

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

                // Check if there are files to send
                const files = fileInput.files;
                if (files.length > 0) {
                    // TODO: Implement file upload
                    uploadPreview.classList.add('hidden');
                    fileInput.value = '';
                }

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
            }

            // Update conversation preview in sidebar
            function updateConversationPreview(userId, message, timestamp) {
                // Find the conversation in our data
                const conversation = conversationsData.find(c => c.userId == userId);

                if (conversation) {
                    // Update the conversation data
                    conversation.lastMessage = message;
                    conversation.lastMessageTime = timestamp;

                    // If the message is from someone else and not the active conversation, increment unread
                    if (userId != currentUserId && (!activeConversation || activeConversation.userId != userId)) {
                        conversation.unread = (conversation.unread || 0) + 1;
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
            }

            // Update last message status
            function updateLastMessageStatus(status) {
                // Find the last sent message
                const sentMessages = chatMessages.querySelectorAll('.message.sent');
                if (sentMessages.length === 0) return;

                const lastMessage = sentMessages[sentMessages.length - 1];
                const statusIcon = lastMessage.querySelector('.time i');

                if (statusIcon) {
                    switch (status) {
                        case 'sent':
                            statusIcon.className = 'fas fa-check';
                            break;
                        case 'delivered':
                            statusIcon.className = 'fas fa-check-double';
                            break;
                        case 'read':
                            statusIcon.className = 'fas fa-check-double';
                            statusIcon.style.color = '#2ecc71';
                            break;
                    }
                }
            }

            // Update profile sidebar with user information
            function updateProfileSidebar(user) {
                // Update profile image and name
                profileImage.src = user.avatar;
                profileName.textContent = user.name;

                // Update role if available
                if (user.role) {
                    profileRole.textContent = user.role.charAt(0).toUpperCase() + user.role.slice(1);
                    profileRole.classList.remove('hidden');
                } else {
                    profileRole.classList.add('hidden');
                }

                // Update bio if available
                if (user.bio) {
                    profileBio.textContent = user.bio;
                    profileBio.classList.remove('hidden');
                } else {
                    profileBio.classList.add('hidden');
                }

                // Update email
                if (profileEmail && user.email) {
                    profileEmail.textContent = user.email;
                    profileEmail.href = `mailto:${user.email}`;
                }

                // Update phone
                if (user.phone) {
                    profilePhone.textContent = user.phone;
                    profilePhone.href = `tel:${user.phone}`;
                    profilePhoneContainer.classList.remove('hidden');
                } else {
                    profilePhoneContainer.classList.add('hidden');
                }

                // Update location
                if (user.location) {
                    profileLocation.textContent = user.location;
                    profileLocationContainer.classList.remove('hidden');
                } else {
                    profileLocationContainer.classList.add('hidden');
                }

                // Update shared media
                if (user.sharedMedia && user.sharedMedia.length > 0) {
                    sharedMedia.innerHTML = '';

                    user.sharedMedia.forEach(media => {
                        const mediaItem = document.createElement('div');
                        mediaItem.className = 'media-item';
                        mediaItem.innerHTML = `<img src="${media.url}" alt="${media.type} media">`;
                        sharedMedia.appendChild(mediaItem);
                    });

                    sharedMediaSection.classList.remove('hidden');
                } else {
                    sharedMediaSection.classList.add('hidden');
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

            // Utility Functions

            // Format message time
            function formatMessageTime(timestamp) {
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