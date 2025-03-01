<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Package Requests - Brandboost</title>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4169E1, #8A2BE2);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            --border-radius: 16px;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 15px;
        }

        .page-header p {
            color: #666;
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }

        .requests-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 40px;
        }


        .request-card {
            display: flex;
            gap: 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .request-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .request-header {
            margin-bottom: 15px;
        }

        .request-title {
            font-size: 24px;
            color: #333;
            margin: 0 0 10px 0;
        }

        .request-meta {
            display: flex;
            gap: 20px;
            margin: 15px 0;
            color: #666;
            font-size: 14px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .meta-icon {
            color: #4169E1;
        }

        .request-description {
            color: #555;
            margin-bottom: 20px;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .request-card-right-box {
            margin-left: auto;
            display: flex;
            flex-direction: column;
            align-items: end;
            justify-content: space-around;
        }

        .request-price {
            font-size: 24px;
            font-weight: 600;
            color: #4169E1;
            margin-bottom: 20px;
        }

        .request-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            align-items: center;
        }

        .offer-button,
        .reject-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            text-decoration: none;
            width: auto;
        }

        .offer-button {
            background: var(--primary-gradient);
            width: 10rem;
        }

        .reject-button {
            background: #ff4d4d;
        }

        .offer-button:hover,
        .reject-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }



        .no-requests {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .requests-grid {
                grid-template-columns: 1fr;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .request-card {
                padding: 20px;
            }

            .request-title {
                font-size: 20px;
            }

            .request-meta {
                flex-wrap: wrap;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Custom Package Requests</h1>
            <p>Browse custom package requests from businesses and make your best offer</p>
        </div>

        <div id="requestsContainer" class="requests-grid">
            <!-- Request cards will be dynamically inserted here -->
        </div>
    </div>

    <script>
        // Add this before the fetch call
        const userRole = '<?php echo $_SESSION['user']['role']; ?>';

        document.addEventListener('DOMContentLoaded', async () => {
            try {
                // const response = await fetch('/data/requestsdata.json');
                const response = await fetch('/api/custom-packages');
                const data = await response.json();

                console.log("Data fetched successfully:", data);

                // const { requests } = jsonData; // Extract the 'requests' array
                const requests = data; // Extract the 'requests' array
                const container = document.getElementById('requestsContainer');

                // Check if requests exist
                if (!requests || requests.length === 0) {
                    container.innerHTML = `
                    <div class="no-requests">
                        <h3>No custom package requests available at the moment.</h3>
                        <p>Check back later for new opportunities!</p>
                    </div>
                `;
                    return;
                }


                // Map requests to HTML and render them
                container.innerHTML = requests.map(request => `
                    <div class="request-card">
                        <div>
                            <div class="request-header">
                                <h2 class="request-title">${request.service_title}</h2>
                                <div class="request-meta">
                                    <div class="meta-item">
                                        <span class="meta-icon">⏰</span>
                                        <span>${request.delivery_days_requested} days</span>
                                    </div>
                                    <div class="meta-item">
                                        <span class="meta-icon">📅</span>
                                        <span>${new Date(request.created_at).toLocaleDateString('en-US', {
                                            month: 'short',
                                            day: 'numeric',
                                            year: 'numeric'
                                        })}</span>
                                    </div>
                                </div>
                            </div>
                            <p class="request-description">${request.benefits_requested}</p>
                        </div>
                        <div class="request-card-right-box">
                            <div class="request-price">
                                LKR ${Number(request.price_requested).toLocaleString()}
                            </div>
                            <div class="request-actions">    
                                <a href="/businessman/place-order?request_id=${request.custom_package_id}" class="offer-button">Place Order</a>
                                <button class="reject-button" onclick="rejectRequest(${request.custom_package_id})">Reject</button>
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

            } catch (error) {
                console.error("Error fetching data:", error);
                document.getElementById('requestsContainer').innerHTML = `
                <div class="error-message">
                    Unable to load package requests. Please try again later.
                </div>
            `;
            }
        });
    </script>

</body>

</html>