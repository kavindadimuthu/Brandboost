<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Tabs</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        .pricing-card {
            width: 350px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .tabs {
            display: flex;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }

        .tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            color: #666;
            transition: all 0.3s ease;
        }

        .tab.active {
            color: #6366f1;
            background-color: #f8f8ff;
        }

        .content {
            padding: 24px;
        }

        .features {
            margin: 24px 0;
        }

        .time-info {
            display: flex;
            gap: 20px;
            margin-bottom: 24px;
        }

        .time-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            color: #333;
        }

        .check-icon {
            color: #6366f1;
        }

        .price {
            font-size: 32px;
            font-weight: 600;
            text-align: center;
            margin: 24px 0;
        }

        .order-button {
            width: 100%;
            padding: 12px;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .order-button:hover {
            background-color: #4f46e5;
        }

        .contact-button {
            margin-top: 16px;
            width: 100%;
            padding: 12px;
            background-color: #ecf0f1;
            color: #6366f1;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact-button:hover {
            background-color: #bdc3c2;
        }

    </style>
</head>
<body>
    <div class="pricing-card">
        <div class="tabs">
            <div class="tab active" onclick="switchTab('standard')">Standard</div>
            <div class="tab" onclick="switchTab('premium')">Premium</div>
        </div>
        <div class="content" id="pricing-content"></div>
    </div>

    <script>
        const pricingData = {
            standard: {
                duration: "2 months",
                revisions: "2 revisions",
                features: [
                    "Files Ready for Print",
                    "Aliquip labore dolor",
                    "Commodo excepteu",
                    "Ullamco minim anim"
                ],
                price: "$ 10"
            },
            premium: {
                duration: "3 months",
                revisions: "5 revisions",
                features: [
                    "Files Ready for Print",
                    "Premium Support",
                    "Priority Delivery",
                    "Advanced Features",
                    "Custom Branding"
                ],
                price: "$ 25"
            }
        };

        function renderPricingContent(plan) {
            const data = pricingData[plan];
            const content = `
                <div class="time-info">
                    <div class="time-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                        ${data.duration}
                    </div>
                    <div class="time-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                        ${data.revisions}
                    </div>
                </div>
                <div class="features">
                    ${data.features.map(feature => `
                        <div class="feature-item">
                            <svg class="check-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5"/>
                            </svg>
                            ${feature}
                        </div>
                    `).join('')}
                </div>
                <div class="price">${data.price}</div>
                <button class="order-button">Order Now</button>
                <button class="contact-button">Contact</button>
            `;

            document.getElementById('pricing-content').innerHTML = content;
        }

        function switchTab(plan) {
            // Update active tab styling
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelector(`.tab:${plan === 'premium' ? 'last-child' : 'first-child'}`).classList.add('active');

            // Render content for selected plan
            renderPricingContent(plan);
        }

        // Initialize with standard plan
        renderPricingContent('standard');
    </script>
</body>
</html>