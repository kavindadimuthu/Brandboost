<?php
// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: /login');
    exit;
}

// Get request parameters from URL
$id = $_GET['id'] ?? null;
$type = $_GET['type'] ?? null;

if (!$id || !$type) {
    header('Location: /admin/verifications-list');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verification Request Details</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            display: flex;
        }
        
        .content {
            flex-grow: 1;
            /* padding: 20px; */
            transition: margin-left 0.3s;
            background-color: #f0f0f0;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .header .breadcrumb {
            font-size: 14px;
            color: #333;
        }
        
        .header .user-info {
            display: flex;
            align-items: center;
        }
        
        .header .user-info img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }
        
        .main-content {
            background-color: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            /* margin-left: 20px; */
        }
        
        .main-content h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        
        .verification-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .verification-details .full-width {
            grid-column: span 2;
        }
        
        .verification-details div {
            margin-bottom: 10px;
        }
        
        .verification-details div span:first-child {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        
        .verification-details div span:last-child {
            color: #333;
        }
        
        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge.pending {
            background-color: #f0ad4e;
        }
        
        .badge.verified {
            background-color: #28a745;
        }
        
        .badge.rejected {
            background-color: #dc3545;
        }
        
        .attachments {
            margin-bottom: 30px;
        }
        
        .attachments h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }
        
        .doc-preview {
            width: 200px;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #ddd;
            margin-right: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            cursor: pointer;
        }
        
        .doc-preview:hover {
            transform: scale(1.05);
        }
        
        .response {
            margin-bottom: 30px;
        }
        
        .response h3 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }
        
        .response textarea {
            width: 100%;
            height: 120px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            resize: none;
            font-family: inherit;
            font-size: 14px;
        }
        
        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 30px;
        }
        
        .left-actions {
            display: flex;
        }
        
        .right-actions {
            display: flex;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.2s;
            font-size: 14px;
            display: flex;
            align-items: center;
            margin-left: 10px;
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-primary {
            background-color: #6a11cb;
            color: #fff;
        }
        
        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }
        
        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 400px;
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-left-color: #6a11cb;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }
        
        .notification.success {
            background-color: #28a745;
        }
        
        .notification.error {
            background-color: #dc3545;
        }
        
        .notification.show {
            opacity: 1;
        }
        
        .document-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .document-modal img {
            max-width: 90%;
            max-height: 90%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
        
        .document-modal .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="main-content">
                <div class="header">
                    <div class="breadcrumb">
                        Admin Portal &gt; <a href="/admin/verifications-list">Verifications</a> &gt; Verification Details
                    </div>
                    <div class="user-info">
                        <img alt="User profile picture" src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['username']); ?>&background=6a11cb&color=fff" width="30" height="30" />
                        <span><?php echo $_SESSION['user']['username']; ?></span>
                    </div>
                </div>
                
                <div id="loading" class="loading">
                    <div class="spinner"></div>
                </div>
                
                <div id="verification-content" style="display: none;">
                    <h2 id="verification-title">Verification Request Details</h2>
                    
                    <div class="verification-details" id="verification-details">
                        <!-- Content will be populated via JavaScript -->
                    </div>
                    
                    <div class="attachments" id="attachments">
                        <h3>Document Preview</h3>
                        <div id="documents-container">
                            <!-- Documents will be populated via JavaScript -->
                        </div>
                    </div>
                    
                    <!-- <div class="response">
                        <h3>Admin Review Notes</h3>
                        <textarea id="admin-notes" placeholder="Enter notes about this verification request..."></textarea>
                    </div> -->
                    
                    <div class="actions">
                        <div class="left-actions">
                            <button class="btn btn-secondary" onclick="window.location.href='/admin/verifications-list'">
                                <i class="fas fa-arrow-left"></i> Back to Verifications
                            </button>
                        </div>
                        <div class="right-actions" id="action-buttons">
                            <!-- Action buttons will be populated via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    <div id="notification" class="notification">
        <span id="notification-message"></span>
    </div>
    
    <div id="document-modal" class="document-modal">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <img id="modal-image" src="" alt="Document Preview" />
    </div>
    
    <script>
        // Get verification details from URL parameters
        const id = '<?php echo $id; ?>';
        const type = '<?php echo $type; ?>';
        let verificationData = null;
        
        // Fetch verification details on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetchVerificationDetails();
        });
        
        // Fetch verification details from API
        function fetchVerificationDetails() {
            fetch(`/api/verification/${type}/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch verification details');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        verificationData = data.data;
                        displayVerificationDetails(verificationData);
                        document.getElementById('loading').style.display = 'none';
                        document.getElementById('verification-content').style.display = 'block';
                    } else {
                        showNotification('Error: ' + data.error, 'error');
                        window.location.href = '/admin/verifications-list';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error fetching verification details', 'error');
                });
        }
        
        // Display verification details
        function displayVerificationDetails(data) {
            // Set title based on verification type
            document.getElementById('verification-title').innerText = 
                data.type === 'business' ? 'Business Verification Request' : 'Social Media Account Verification';
            
            // Build details HTML based on verification type
            const detailsContainer = document.getElementById('verification-details');
            let detailsHTML = '';
            
            // Common details
            detailsHTML += `
                <div>
                    <span>Request ID:</span>
                    <span>${data.id}</span>
                </div>
                <div>
                    <span>Request Type:</span>
                    <span>${data.type === 'business' ? 'Business Registration' : 'Social Media Account'}</span>
                </div>
                <div>
                    <span>Status:</span>
                    <span class="badge ${data.status}">${data.status.charAt(0).toUpperCase() + data.status.slice(1)}</span>
                </div>
                <div>
                    <span>Last Updated:</span>
                    <span>${formatDate(data.updatedAt)}</span>
                </div>
            `;
            
            // User details
            detailsHTML += `
                <div>
                    <span>User Full Name:</span>
                    <span>${data.user.fullName}</span>
                </div>
                <div>
                    <span>User Email:</span>
                    <span>${data.user.email}</span>
                </div>
                <div>
                    <span>Phone Number:</span>
                    <span>${data.user.phone || 'Not provided'}</span>
                </div>
                <div>
                    <span>User ID:</span>
                    <span>${data.user.id}</span>
                </div>
            `;
            
            // Type-specific details
            if (data.type === 'business') {
                detailsHTML += `
                    <div>
                        <span>Business Name:</span>
                        <span>${data.businessName}</span>
                    </div>
                `;
                detailsHTML += `
                    <div>
                        <span>Business Type:</span>
                        <span>${data.businessType}</span>
                    </div>
                `;
                
                // Display document
                const documentsContainer = document.getElementById('documents-container');
                documentsContainer.innerHTML = `
                    <img src="/${data.brDocument}" alt="Business Registration Document" 
                         class="doc-preview" onclick="openModal('/${data.brDocument}')" />
                `;
                
            } else if (data.type === 'social_media') {
                detailsHTML += `
                    <div>
                        <span>Platform:</span>
                        <span>${data.platform}</span>
                    </div>
                    <div>
                        <span>Username:</span>
                        <span>${data.username}</span>
                    </div>
                    <div class="full-width">
                        <span>Link:</span>
                        <span><a href="${data.link}" target="_blank">${data.link}</a></span>
                    </div>
                    <div>
                        <span>Submitted On:</span>
                        <span>${formatDate(data.createdAt)}</span>
                    </div>
                `;
                
                // For social media accounts, we just show a link button
                const documentsContainer = document.getElementById('documents-container');
                documentsContainer.innerHTML = `
                    <a href="${data.link}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-external-link-alt"></i> Visit ${data.platform} Account
                    </a>
                `;
            }
            
            // Update the details container
            detailsContainer.innerHTML = detailsHTML;
            
            // Add action buttons based on current status
            updateActionButtons(data.status);
        }
        
        // Update action buttons based on verification status
        function updateActionButtons(status) {
            const actionButtons = document.getElementById('action-buttons');
            
            if (status === 'pending') {
                actionButtons.innerHTML = `
                    <button class="btn btn-success" onclick="updateStatus('verified')">
                        <i class="fas fa-check"></i> Verify
                    </button>
                    <button class="btn btn-danger" onclick="updateStatus('rejected')">
                        <i class="fas fa-times"></i> Reject
                    </button>
                `;
            } else {
                actionButtons.innerHTML = `
                    <div class="badge ${status}" style="margin-right: 10px; display: flex; align-items: center;">
                        <i class="fas fa-${status === 'verified' ? 'check-circle' : 'times-circle'}" style="margin-right: 5px;"></i>
                        ${status === 'verified' ? 'Verified' : 'Rejected'}
                    </div>
                    <button class="btn btn-primary" onclick="updateStatus('pending')">
                        <i class="fas fa-redo"></i> Set Back to Pending
                    </button>
                `;
            }
        }
        
        // Update verification status
        function updateStatus(newStatus) {
            // const notes = document.getElementById('admin-notes').value;
            
            // Confirmation dialog
            if (!confirm(`Are you sure you want to mark this verification as ${newStatus.toUpperCase()}?`)) {
                return;
            }
            
            // Create request body
            const requestBody = {
                id: id,
                type: type,
                status: newStatus,
                // notes: notes // Optional notes field
            };
            
            // Send update request
            fetch('/api/update-verification-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestBody)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to update verification status');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification(`Verification status updated to ${newStatus}`, 'success');
                    
                    // Update the displayed status and buttons
                    const statusBadge = document.querySelector('.verification-details .badge');
                    statusBadge.className = `badge ${newStatus}`;
                    statusBadge.innerText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    
                    // Update action buttons
                    updateActionButtons(newStatus);
                    
                    // Update the stored data
                    verificationData.status = newStatus;
                } else {
                    showNotification('Error: ' + data.error, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating verification status', 'error');
            });
        }
        
        // Format date for display
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        
        // Show notification
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            const notificationMessage = document.getElementById('notification-message');
            
            notification.className = `notification ${type}`;
            notificationMessage.innerText = message;
            
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 5000);
        }
        
        // Document modal functions
        function openModal(imageSrc) {
            const modal = document.getElementById('document-modal');
            const modalImage = document.getElementById('modal-image');
            
            modalImage.src = imageSrc;
            modal.style.display = 'flex';
            
            // Prevent scrolling when modal is open
            document.body.style.overflow = 'hidden';
        }
        
        function closeModal() {
            const modal = document.getElementById('document-modal');
            modal.style.display = 'none';
            
            // Re-enable scrolling
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside the image
        document.getElementById('document-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>