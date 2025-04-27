<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Package Requests | BrandBoost</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5e72e4;
            --primary-dark: #4454c3;
            --primary-light: #edf2ff;
            --secondary: #7c44f1;
            --white: #ffffff;
            --light-bg: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --success: #2dce89;
            --warning: #fb6340;
            --danger: #f5365c;
            --pending: #6b7280;
            --border-radius: 12px;
            --box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--gray-700);
            line-height: 1.5;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 40px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            bottom: -50%;
            left: -50%;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
            transform: rotate(-20deg);
        }

        .hero-container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            text-align: left;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-title-wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin-top: 5px;
        }

        .request-count {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.4);
            height: 50px;
            width: 50px;
            border-radius: 50%;
            font-size: 1.3rem;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: var(--transition);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .request-count:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .page-content {
            margin-top: -30px;
            position: relative;
            z-index: 1;
        }

        /* Requests Container */
        .requests-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            margin-bottom: 40px;
        }

        /* Request Cards */
        .requests-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .request-card {
            display: flex;
            gap: 20px;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 25px;
            transition: var(--transition);
            border: 1px solid var(--gray-200);
        }

        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-light);
        }

        .request-content {
            flex: 1;
        }

        .request-header {
            margin-bottom: 15px;
        }

        .request-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--gray-700);
            margin: 0 0 10px 0;
        }

        .request-meta {
            display: flex;
            gap: 20px;
            margin: 15px 0;
            color: var(--gray-500);
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-icon {
            color: var(--primary);
        }

        .request-description {
            color: var(--gray-600);
            margin-bottom: 20px;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .request-sidebar {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
            min-width: 180px;
        }

        .request-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            padding: 8px 16px;
            background-color: var(--primary-light);
            border-radius: 8px;
        }

        .request-actions {
            display: flex;
            gap: 10px;
            flex-direction: column;
            width: 100%;
        }

        .offer-button,
        .reject-button {
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .offer-button {
            background: var(--primary);
            color: white;
        }

        .offer-button:hover {
            background: var(--primary-dark);
        }

        .reject-button {
            background: var(--white);
            color: var(--danger);
            border: 1px solid var(--danger);
        }

        .reject-button:hover {
            background: var(--danger);
            color: var(--white);
        }

        /* Empty and Loading States */
        .empty-state, .loading-state {
            text-align: center;
            padding: 50px 0;
        }

        .empty-state i, .loading-state i {
            font-size: 3rem;
            color: var(--gray-300);
            margin-bottom: 20px;
        }

        .empty-state-text {
            color: var(--gray-500);
            font-size: 1rem;
        }

        .spinner {
            display: inline-block;
            width: 3rem;
            height: 3rem;
            border: 3px solid rgba(94, 114, 228, 0.1);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .error-message {
            background-color: rgba(245, 54, 92, 0.1);
            color: var(--danger);
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            text-align: center;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .hero {
                padding: 30px 0;
            }
            
            .hero h1 {
                font-size: 1.8rem;
            }
            
            .hero p {
                font-size: 1rem;
            }

            .hero-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .request-count {
                position: absolute;
                top: 20px;
                right: 20px;
                height: 40px;
                width: 40px;
                font-size: 1.1rem;
            }

            .request-card {
                flex-direction: column;
            }
            
            .request-sidebar {
                align-items: flex-start;
                margin-top: 15px;
            }

            .request-price {
                align-self: flex-start;
            }
            
            .request-actions {
                flex-direction: row;
            }
        }

        @media (max-width: 480px) {
            .hero-container {
                padding: 0 15px;
            }
            
            .container {
                padding: 0 15px;
            }
            
            .meta-item {
                font-size: 0.8rem;
            }
            
            .request-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-title-area">
                    <div class="hero-title-wrapper">
                        <h1><i class="fas fa-handshake"></i> Custom Package Requests</h1>
                        <div class="request-count" id="totalRequests">0</div>
                    </div>
                    <p>Browse custom requests from businesses looking for tailored solutions.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container page-content">
        <div class="requests-container">
            <div id="requestsContainer" class="requests-grid">
                <!-- Request cards will be dynamically inserted here -->
                <div class="loading-state">
                    <div class="spinner"></div>
                    <p>Loading custom package requests...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userRole = '<?php echo $_SESSION['user']['role']; ?>';
        let allRequests = [];

        // Update the request count
        function updateRequestCount(count) {
            document.getElementById('totalRequests').textContent = count;
        }

        // Format date to be more readable
        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            
            const options = { month: 'short', day: 'numeric', year: 'numeric' };
            const date = new Date(dateString);
            
            if (isNaN(date)) return dateString;
            
            return date.toLocaleDateString('en-US', options);
        }

        // Render requests to the container
        function renderRequests(requests) {
            const container = document.getElementById('requestsContainer');
            
            // Check if requests exist
            if (!requests || requests.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No custom package requests available</h3>
                        <p class="empty-state-text">Check back later for new opportunities!</p>
                    </div>
                `;
                return;
            }

            // Map requests to HTML and render them
            container.innerHTML = requests.map(request => `
                <div class="request-card" id="request-${request.custom_package_id}">
                    <div class="request-content">
                        <div class="request-header">
                            <h2 class="request-title">${request.service_title}</h2>
                            <div class="request-meta">
                                <div class="meta-item">
                                    <i class="fas fa-clock meta-icon"></i>
                                    <span>${request.delivery_days_requested} days delivery</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar-alt meta-icon"></i>
                                    <span>Requested on ${formatDate(request.created_at)}</span>
                                </div>
                            </div>
                        </div>
                        <p class="request-description">${request.benefits_requested}</p>
                    </div>
                    <div class="request-sidebar">
                        <div class="request-price">
                            LKR ${Number(request.price_requested).toLocaleString()}
                        </div>
                        <div class="request-actions">
                            <a href="/${userRole}/offer-package?request_id=${request.custom_package_id}" class="offer-button">
                                <i class="fas fa-paper-plane"></i> Make an Offer
                            </a>
                            <button class="reject-button" onclick="rejectRequest(${request.custom_package_id})">
                                <i class="fas fa-times"></i> Decline
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            // Add fade-in animation for cards
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.request-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
        }

        // Fetch requests from API
        async function fetchRequests() {
            try {
                const response = await fetch('/api/custom-packages');
                const data = await response.json();

                console.log("Data fetched successfully:", data);
                
                allRequests = data;
                updateRequestCount(allRequests.length);
                renderRequests(allRequests);
                
            } catch (error) {
                console.error("Error fetching data:", error);
                document.getElementById('requestsContainer').innerHTML = `
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>Unable to load package requests. Please try again later.</p>
                    </div>
                `;
            }
        }

        // Reject a request
        async function rejectRequest(requestId) {
            try {
                console.log(`Request ${requestId} rejected`);
                
                // Show loader in the request card
                const requestCard = document.getElementById(`request-${requestId}`);
                const originalContent = requestCard.innerHTML;
                requestCard.innerHTML = `
                    <div style="text-align: center; padding: 20px; width: 100%;">
                        <div class="spinner" style="width: 2rem; height: 2rem;"></div>
                        <p>Declining request...</p>
                    </div>
                `;
                
                const response = await fetch(`/api/delete-custom-package/${requestId}`);
                const data = await response.json();

                if (data.success) {
                    console.log('Request rejected successfully');
                    
                    // Animate removal of the card
                    requestCard.style.opacity = '0';
                    requestCard.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        requestCard.remove();
                        
                        // Update the requests and count
                        allRequests = allRequests.filter(request => request.custom_package_id !== requestId);
                        updateRequestCount(allRequests.length);
                        
                        // Check if no requests left
                        if (allRequests.length === 0) {
                            renderRequests([]);
                        }
                    }, 500);
                    
                } else {
                    console.error('Failed to reject request');
                    requestCard.innerHTML = originalContent;
                    alert('Failed to decline the request. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                const requestCard = document.getElementById(`request-${requestId}`);
                if (requestCard) {
                    requestCard.innerHTML = originalContent;
                }
                alert('An error occurred. Please try again.');
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            fetchRequests();
        });
    </script>
</body>
</html>