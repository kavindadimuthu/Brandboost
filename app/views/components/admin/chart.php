
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .chart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* padding: 20px; */
        }
        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 20px;
            width: 100%;
            /* max-width: 600px; */
        }
        .card h2 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }
        .legend {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }
        .legend div {
            display: flex;
            align-items: center;
            margin-left: 10px;
        }
        .legend div span {
            display: inline-block;
            width: 12px;
            height: 12px;
            margin-right: 5px;
        }
        .income {
            background-color: #2d6a4f;
        }
        .expenses {
            background-color: #a8df65;
        }
        .revenue {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .revenue h1 {
            margin: 0;
            font-size: 2.5em;
            color: #333;
        }
        .revenue p {
            margin: 5px 0;
            color: #333;
        }
        .revenue p span {
            color: #2d6a4f;
        }
        .bar-chart, .bar-chart-horizontal {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            height: 150px;
            margin-top: 20px;
        }
        .bar {
            width: 20px;
            background-color: #2d6a4f;
        }
        .bar.expenses {
            background-color: #a8df65;
        }
        .bar-chart-horizontal {
            flex-direction: column;
            align-items: flex-start;
            height: auto;
        }
        .bar-horizontal {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .bar-horizontal div {
            height: 20px;
            background-color: #a8df65;
            margin-right: 10px;
        }
        .bar-horizontal div.income {
            background-color: #2d6a4f;
        }
        .bar-horizontal span {
            color: #333;
        }
        .ellipsis {
            display: flex;
            justify-content: flex-end;
            margin-top: -20px;
        }
        .ellipsis i {
            color: #333;
        }
    </style>
</head>

    <div class="chart-container">
        <div class="card">
            <h2>Sales Report</h2>
            <div class="legend">
                <div><span class="income"></span> Income</div>
                <div><span class="expenses"></span> Withdrawals</div>
            </div>
            <div class="revenue">
                <h1 id="revenue-amount">$0</h1>
                <p id="revenue-change"><span>&#9650; 0%</span> from last month</p>
            </div>
            <div class="bar-chart" id="revenue-chart">
                <!-- Bars will be generated dynamically -->
            </div>
        </div>
        <div class="card">
            <div class="ellipsis">
                <i class="fas fa-ellipsis-h"></i>
            </div>
            <h2>User counts</h2>
            <div class="bar-chart-horizontal" id="sales-chart">
                <!-- Horizontal bars will be generated dynamically -->
            </div>
        </div>
    </div>

    <script>
        // Data for charts
        const revenueData = [
            { type: 'income', height: 60 },
            { type: 'expenses', height: 40 },
            { type: 'income', height: 80 },
            { type: 'expenses', height: 60 },
            { type: 'income', height: 100 },
            { type: 'expenses', height: 80 },
            { type: 'income', height: 60 },
            { type: 'income', height: 60 },
            { type: 'expenses', height: 40 },
            { type: 'income', height: 80 },
            { type: 'expenses', height: 60 },
            { type: 'income', height: 100 },
            { type: 'expenses', height: 80 },
            { type: 'income', height: 60 },
            { type: 'income', height: 60 },
            { type: 'expenses', height: 40 },
            { type: 'income', height: 80 },
            { type: 'expenses', height: 60 },
            { type: 'income', height: 100 },
            { type: 'expenses', height: 80 },
            { type: 'income', height: 60 },
        ];

        const salesData = [
            { type: 'expenses', width: 233, label: 'Businesses (233)' },
            { type: 'income', width: 23, label: 'Designers (23)' },
            { type: 'expenses', width: 482, label: 'Influencers (482)' },
        ];

        const revenueAmount = 193000;
        const revenueChange = '+35%';

        // Populate revenue chart
        const revenueChart = document.getElementById('revenue-chart');
        revenueData.forEach((bar) => {
            const barDiv = document.createElement('div');
            barDiv.className = `bar ${bar.type}`;
            barDiv.style.height = `${bar.height}px`;
            revenueChart.appendChild(barDiv);
        });

        // Update revenue details
        document.getElementById('revenue-amount').textContent = `$${revenueAmount.toLocaleString()}`;
        document.getElementById('revenue-change').innerHTML = `<span>&#9650; ${revenueChange}</span> from last month`;

        // Populate sales chart
        const salesChart = document.getElementById('sales-chart');
        salesData.forEach((bar) => {
            const barContainer = document.createElement('div');
            barContainer.className = 'bar-horizontal';

            const barDiv = document.createElement('div');
            barDiv.className = `${bar.type}`;
            barDiv.style.width = `${bar.width}px`;

            const labelSpan = document.createElement('span');
            labelSpan.textContent = bar.label;

            barContainer.appendChild(barDiv);
            barContainer.appendChild(labelSpan);
            salesChart.appendChild(barContainer);
        });
    </script>


