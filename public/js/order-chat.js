/**
 * Order Chat Implementation
 * Handles WebSocket communication for order-specific chats
 */

// We'll use an IIFE (Immediately Invoked Function Expression) to avoid polluting the global scope
(function() {
    // Chat variables
    let socket;
    let currentUserId;
    let orderId = null;
    let otherUserId = null;
    let orderChatConnected = false;
    let typingTimeout = null;
    
    // Initialize chat when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Get order details from the parent page
        if (window.getOrderChatDetails) {
            const orderDetails = window.getOrderChatDetails();
            orderId = orderDetails.orderId;
            otherUserId = orderDetails.otherUserId;
            console.log("Order chat initialized with:", { orderId, otherUserId });
        } else {
            // Fallback to getting order ID from URL path
            const pathSegments = window.location.pathname.split('/');
            orderId = pathSegments[pathSegments.length - 1];
            console.log("Fallback: Order ID from URL:", orderId);
        }
        
        // Set up event listeners
        setupChatEventListeners();
        
        // Initialize WebSocket connection
        initOrderChat();

        // Expose update function to allow parent page to update participant later
        window.updateChatParticipant = function(newOtherUserId) {
            if (newOtherUserId && newOtherUserId !== otherUserId) {
                console.log("Updating chat participant from:", otherUserId, "to:", newOtherUserId);
                otherUserId = newOtherUserId;
                
                // Re-fetch chat if we're already connected
                if (orderChatConnected) {
                    fetchOrderChat();
                }
            }
        };
    });
    
    // Set up the WebSocket connection
    function initOrderChat() {
        const protocol = window.location.protocol === 'https:' ? 'wss:' : 'ws:';
        const wsUrl = `${protocol}//${window.location.hostname}:8080`;
        
        console.log('Connecting to WebSocket server at:', wsUrl);
        
        socket = new WebSocket(wsUrl);
        
        socket.addEventListener('open', () => {
            console.log('WebSocket connection established');
            
            // Authenticate with session token
            // const sessionToken = getCookie('session_token');
            // if (sessionToken) {
            //     socket.send(JSON.stringify({
            //         type: 'auth',
            //         token: sessionToken
            //     }));
            // } else {
            //     console.error('No session token found');
            //     displayChatError('Authentication error. Please try refreshing the page.');
            // }
        });
        
        socket.addEventListener('message', handleSocketMessage);
        
        socket.addEventListener('close', () => {
            console.log('WebSocket connection closed');
            orderChatConnected = false;
            
            // Try to reconnect after 5 seconds
            setTimeout(initOrderChat, 5000);
        });
        
        socket.addEventListener('error', (error) => {
            console.error('WebSocket error:', error);
            displayChatError('Connection error. Trying to reconnect...');
        });
    }
    
    // Handle incoming WebSocket messages
    function handleSocketMessage(event) {
        const data = JSON.parse(event.data);
        console.log('Received message:', data);
        
        switch (data.type) {
            case 'auth_required':
                // Authentication required, send token
                const sessionToken = getCookie('session_token');
                if (sessionToken) {
                    socket.send(JSON.stringify({
                        type: 'auth',
                        token: sessionToken
                    }));
                }
                break;
                
            case 'auth_success':
                console.log('Authentication successful');
                currentUserId = data.userId;
                orderChatConnected = true;
                
                // Wait a brief moment to ensure otherUserId is available
                setTimeout(() => {
                    // Check one more time if otherUserId is available from window
                    if (!otherUserId && window.otherUserId) {
                        otherUserId = window.otherUserId;
                        console.log("Updated otherUserId from window before fetch:", otherUserId);
                    }
                    fetchOrderChat();
                }, 200);
                break;
                
            case 'auth_failed':
                console.error('Authentication failed');
                displayChatError('Authentication failed. Please try refreshing the page.');
                break;
                
            case 'order_chat':
                // Order chat details received
                console.log('Order chat details:', data);
                otherUserId = data.participant.userId;
                
                // Update UI with participant info
                document.getElementById('username').textContent = data.participant.name;
                updateUserStatus(data.participant.status);
                
                // Clear any existing messages
                clearChatMessages();
                break;
                
            case 'history':
                // Chat history received
                console.log('Chat history:', data);
                displayChatHistory(data.messages);
                break;
                
            case 'message':
                // New message received
                if (data.from == otherUserId) {
                    addMessageToChat({
                        sender_id: data.from,
                        message: data.message,
                        created_at: data.created_at || new Date().toISOString(),
                        read_status: 'delivered'
                    });
                    
                    // Mark as read
                    socket.send(JSON.stringify({
                        type: 'mark_read',
                        to: data.from,
                        orderId: orderId
                    }));
                    
                    // Play notification sound if page is not focused
                    if (!document.hasFocus()) {
                        playNotificationSound();
                    }
                }
                break;
            
            case 'message_sent':
                // Confirmation our message was sent
                updateLastMessageStatus(data.message_id || 'sent');
                break;
                
            case 'messages_read':
                // The other user has read our messages
                updateAllMessagesStatus('read');
                break;
                
            case 'typing':
                // Other user is typing
                if (data.userId == otherUserId && data.orderId == orderId) {
                    showTypingIndicator();
                }
                break;
                
            case 'typing_stop':
                // Other user stopped typing
                if (data.userId == otherUserId && data.orderId == orderId) {
                    hideTypingIndicator();
                }
                break;
                
            case 'user_status':
                // User status update
                if (data.userId == otherUserId) {
                    updateUserStatus(data.status);
                }
                break;
                
            case 'error':
                console.error('Socket error:', data.message);
                displayChatError(data.message);
                
                // If the error is about the chat participant and we have the orderId,
                // this might be because otherUserId wasn't available yet
                if (data.message === "Cannot determine chat participant" && window.otherUserId) {
                    console.log("Trying to recover from participant error with window.otherUserId:", window.otherUserId);
                    otherUserId = window.otherUserId;
                    // Try fetching again after a short delay
                    setTimeout(fetchOrderChat, 1000);
                }
                break;
        }
    }
    
    // Set up event listeners for chat interface
    function setupChatEventListeners() {
        // Send button
        const sendButton = document.getElementById('sendMessage');
        if (sendButton) {
            sendButton.addEventListener('click', sendOrderMessage);
        }
        
        // Message input field
        const messageInput = document.getElementById('messageInput');
        if (messageInput) {
            // Send on Enter key (but not with Shift key)
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendOrderMessage();
                }
            });
            
            // Typing indicator
            messageInput.addEventListener('input', sendTypingIndicator);
        }
    }
    
    // Fetch order chat - modify to check for otherUserId
    function fetchOrderChat() {
        if (!orderChatConnected || !orderId) return;
        
        // Check if otherUserId is available yet
        if (!otherUserId) {
            console.log("Waiting for otherUserId before fetching chat...");
            // Try to get it from window again, in case it was set after we initialized
            if (window.otherUserId) {
                otherUserId = window.otherUserId;
                console.log("Got otherUserId from window:", otherUserId);
            } else {
                // Show a temporary message
                addSystemMessage("Connecting to chat...");
                setTimeout(fetchOrderChat, 1000); // Try again in 1 second
                return;
            }
        }
        
        console.log("Fetching order chat with:", { orderId, otherUserId });
        socket.send(JSON.stringify({
            type: 'fetch_order_chat',
            orderId: orderId,
            otherUserId: otherUserId
        }));
    }
    
    // Display chat history
    function displayChatHistory(messages) {
        clearChatMessages();
        
        if (!messages || messages.length === 0) {
            addSystemMessage('No messages yet. Start the conversation!');
            return;
        }
        
        // Sort messages by time
        messages.sort((a, b) => {
            return new Date(a.created_at) - new Date(b.created_at);
        });
        
        // Add each message to the chat
        messages.forEach(message => {
            addMessageToChat(message);
        });
        
        // Scroll to the latest message
        scrollToLatestMessage();
    }
    
    // Add a message to the chat
    function addMessageToChat(message) {
        const chatBox = document.getElementById('chatBox');
        if (!chatBox) return;
        
        const messageEl = document.createElement('div');
        
        const isSent = message.sender_id == currentUserId;
        messageEl.className = `message ${isSent ? 'sent' : 'received'}`;
        
        // Format the message time
        const messageTime = new Date(message.created_at);
        const timeString = messageTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        
        // Status indicator for sent messages
        let statusHtml = '';
        if (isSent) {
            if (message.read_status === 'read') {
                statusHtml = '<span class="status-indicator">✓✓</span>';
            } else if (message.read_status === 'delivered') {
                statusHtml = '<span class="status-indicator">✓✓</span>';
            } else {
                statusHtml = '<span class="status-indicator">✓</span>';
            }
        }
        
        // Add the message content with proper HTML escaping
        const messageText = document.createTextNode(message.message);
        const messageContainer = document.createElement('div');
        messageContainer.appendChild(messageText);
        
        messageEl.innerHTML = `
            ${messageContainer.innerHTML}
            <div class="message-time">${timeString} ${statusHtml}</div>
        `;
        
        chatBox.appendChild(messageEl);
        
        // Remove loading message if present
        const loadingMsg = chatBox.querySelector('.chat-loading');
        if (loadingMsg) {
            loadingMsg.remove();
        }
        
        // Always scroll to the latest message
        scrollToLatestMessage();
        
        // If this is a message we're sending, add an ID so we can update its status later
        if (isSent && !message.message_id) {
            messageEl.dataset.tempId = Date.now().toString();
        }
    }
    
    // Add a system message
    function addSystemMessage(text) {
        const chatBox = document.getElementById('chatBox');
        if (!chatBox) return;
        
        const messageEl = document.createElement('div');
        messageEl.className = 'system-message';
        messageEl.style.textAlign = 'center';
        messageEl.style.padding = '10px';
        messageEl.style.color = '#6b7280';
        messageEl.style.fontStyle = 'italic';
        messageEl.textContent = text;
        
        // Clear any loading messages
        const loadingMsg = chatBox.querySelector('.chat-loading');
        if (loadingMsg) {
            loadingMsg.remove();
        }
        
        chatBox.appendChild(messageEl);
    }
    
    // Display an error message in the chat
    function displayChatError(message) {
        const chatBox = document.getElementById('chatBox');
        if (!chatBox) return;
        
        const errorEl = document.createElement('div');
        errorEl.className = 'chat-error';
        errorEl.style.textAlign = 'center';
        errorEl.style.padding = '10px';
        errorEl.style.color = '#ef4444';
        errorEl.textContent = message;
        
        // Clear any loading messages
        const loadingMsg = chatBox.querySelector('.chat-loading');
        if (loadingMsg) {
            loadingMsg.remove();
        }
        
        chatBox.appendChild(errorEl);
    }
    
    // Clear chat messages
    function clearChatMessages() {
        const chatBox = document.getElementById('chatBox');
        if (chatBox) {
            chatBox.innerHTML = '';
        }
    }
    
    // Scroll to the latest message
    function scrollToLatestMessage() {
        const chatBox = document.getElementById('chatBox');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }
    
    // Send a message
    function sendOrderMessage() {
        const messageInput = document.getElementById('messageInput');
        if (!messageInput) return;
        
        const message = messageInput.value.trim();
        
        if (!message || !orderChatConnected || !otherUserId) return;
        
        // Get current timestamp
        const now = new Date();
        
        // Add message to chat immediately (don't wait for server response)
        addMessageToChat({
            sender_id: currentUserId,
            message: message,
            created_at: now.toISOString(),
            read_status: 'sent'
        });
        
        // Send the message through WebSocket
        socket.send(JSON.stringify({
            type: 'message',
            to: otherUserId,
            message: message,
            orderId: orderId
        }));
        
        // Clear the input
        messageInput.value = '';
        
        // Stop typing indicator
        sendTypingStop();
    }
    
    // Update user status
    function updateUserStatus(status) {
        const statusEl = document.getElementById('userStatus');
        if (!statusEl) return;
        
        if (status === 'online') {
            statusEl.textContent = 'Online';
            statusEl.className = 'user-status online';
        } else {
            statusEl.textContent = 'Offline';
            statusEl.className = 'user-status';
        }
    }
    
    // Show typing indicator
    function showTypingIndicator() {
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.style.display = 'flex';
            scrollToLatestMessage();
        }
    }
    
    // Hide typing indicator
    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.style.display = 'none';
        }
    }
    
    // Send typing indicator
    function sendTypingIndicator() {
        if (!orderChatConnected || !otherUserId) return;
        
        socket.send(JSON.stringify({
            type: 'typing',
            to: otherUserId,
            orderId: orderId
        }));
        
        // Clear existing timeout
        if (typingTimeout) {
            clearTimeout(typingTimeout);
        }
        
        // Set a new timeout to send typing_stop after 3 seconds of inactivity
        typingTimeout = setTimeout(sendTypingStop, 3000);
    }
    
    // Send typing stop indicator
    function sendTypingStop() {
        if (!orderChatConnected || !otherUserId) return;
        
        socket.send(JSON.stringify({
            type: 'typing_stop',
            to: otherUserId,
            orderId: orderId
        }));
        
        if (typingTimeout) {
            clearTimeout(typingTimeout);
            typingTimeout = null;
        }
    }
    
    // Update last message status
    function updateLastMessageStatus(status) {
        const chatBox = document.getElementById('chatBox');
        if (!chatBox) return;
        
        const sentMessages = chatBox.querySelectorAll('.message.sent');
        
        if (sentMessages.length === 0) return;
        
        const lastMessage = sentMessages[sentMessages.length - 1];
        updateMessageStatus(lastMessage, status);
    }
    
    // Update all messages status
    function updateAllMessagesStatus(status) {
        const chatBox = document.getElementById('chatBox');
        if (!chatBox) return;
        
        const sentMessages = chatBox.querySelectorAll('.message.sent');
        
        sentMessages.forEach(message => {
            updateMessageStatus(message, status);
        });
    }
    
    // Update message status
    function updateMessageStatus(messageEl, status) {
        const statusIndicator = messageEl.querySelector('.status-indicator');
        
        if (!statusIndicator) return;
        
        if (status === 'read') {
            statusIndicator.innerHTML = '✓✓';
            statusIndicator.style.color = '#10b981'; // green
        } else if (status === 'delivered') {
            statusIndicator.innerHTML = '✓✓';
        } else if (status === 'sent') {
            statusIndicator.innerHTML = '✓';
        }
    }
    
    // Play notification sound
    function playNotificationSound() {
        // Create audio element
        const audio = new Audio('/assets/notification.mp3'); // Update path to your sound file
        audio.volume = 0.5;
        audio.play().catch(err => {
            console.log('Error playing notification sound:', err);
            // Often browsers block autoplay without user interaction
        });
    }
    
    // Get cookie by name (utility function)
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
})();