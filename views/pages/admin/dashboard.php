<style>
    .dashboard-container {
        /* background-color: white; */
        border-radius: 8px;
        margin: 0 auto;
        padding: 20px 0;
    }
    .cards {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 20px;
    }

    .card {
        /* background-color: #f5f6fa; */
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        flex: 1;
    }

    .card h2 {
        font-size: 18px;
        margin: 0;
        color: #333;
    }

    .card .value {
        font-size: 32px;
        font-weight: 600;
        margin: 10px 0;
        color: #2d6a4f;
    }

    .card .change {
        font-size: 14px;
        color: #28a745;
    }

    .card .change.negative {
        color: #dc3545;
    }

    .card p {
        font-size: 14px;
        color: #666;
        margin: 10px 0 0;
    }

    /* Charts styles */
    .chart-container {
        margin: 20px 0;
    }

    .chart-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .legend {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }

    .income-color {
        background-color: #2d6a4f;
    }

    .expenses-color {
        background-color: #a8df65;
    }

    .revenue-summary {
        text-align: center;
        margin: 20px 0;
    }

    .revenue-amount {
        font-size: 2.5em;
        font-weight: bold;
        color: #2d6a4f;
    }

    .revenue-change {
        color: #28a745;
    }

    /* Table styles */
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .data-table th {
        background-color: #f5f6fa;
        padding: 12px;
        text-align: left;
        color: #333;
    }

    .data-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .progress-bar-container {
        background-color: #f5f6fa;
        border-radius: 10px;
        height: 8px;
        width: 100%;
        margin-top: 10px;
    }

    .progress-bar {
        height: 100%;
        border-radius: 10px;
        background-color: #2d6a4f;
    }
</style>

<div class="dashboard-container">
    <div class="cards">
        <div class="card">
            <h2>Gross Revenue</h2>
            <div class="value">$2,480.32</div>
            <div class="change positive">+2.15%</div>
            <p>From Jan 01, 2024 - March 30, 2024</p>
        </div>
        <div class="card">
            <h2>Avg. Order Value</h2>
            <div class="value">$56.12</div>
            <div class="change negative">-2.15%</div>
            <p>From Jan 01, 2024 - March 30, 2024</p>
        </div>
        <div class="card">
            <h2>Total Orders</h2>
            <div class="value">230</div>
            <div class="change positive">+2.15%</div>
            <p>From Jan 01, 2024 - March 30, 2024</p>
        </div>
    </div>
    
    <div class="chart-container">
        <div class="chart-card">
            <h2>Sales Report</h2>
            <div class="legend">
                <div class="legend-item">
                    <span class="legend-color income-color"></span>
                    <span>Income</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color expenses-color"></span>
                    <span>Withdrawals</span>
                </div>
            </div>
            <div class="revenue-summary">
                <div class="revenue-amount" id="revenue-amount">$0</div>
                <div class="revenue-change" id="revenue-change">↑ 0% from last month</div>
            </div>
            <div id="revenue-chart"></div>
        </div>
    
        <div class="chart-card">
            <h2>User Counts</h2>
            <div id="user-chart"></div>
        </div>
    </div>
    
    <div class="chart-card">
        <h2>Top Posts</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Post</th>
                    <th>Revenue</th>
                    <th>Sales</th>
                    <th>Reviews</th>
                    <th>Views</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Premium T-Shirt</td>
                    <td>$26,680.90</td>
                    <td>1,072</td>
                    <td>1,727</td>
                    <td>2,680</td>
                </tr>
                <tr>
                    <td>Vintage T-Shirt</td>
                    <td>$16,729.19</td>
                    <td>1,016</td>
                    <td>720</td>
                    <td>2,186</td>
                </tr>
                <tr>
                    <td>New Premium Polo</td>
                    <td>$12,872.24</td>
                    <td>987</td>
                    <td>964</td>
                    <td>1,872</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="chart-card">
        <h2>Active Users by Country</h2>
        <div style="margin-top: 20px;">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <img src="https://storage.googleapis.com/a1aa/image/8LuXfpHgIzyhdyEVNaQvvhYidMb9PbXLZJcnxPEknaSeVA2TA.jpg"
                     alt="England Flag"
                     style="width: 24px; height: 24px; margin-right: 10px;">
                <div style="flex: 1;">
                    <div style="margin-bottom: 5px;">England</div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: 72%;"></div>
                    </div>
                </div>
                <div style="margin-left: 10px;">72%</div>
            </div>
    
            <div style="display: flex; align-items: center;">
                <img src="https://storage.googleapis.com/a1aa/image/5v5H3QTzFFpQL9P2oYePnIGOWVLSHYrbDHepPlOyco0erAsnA.jpg"
                     alt="Germany Flag"
                     style="width: 24px; height: 24px; margin-right: 10px;">
                <div style="flex: 1;">
                    <div style="margin-bottom: 5px;">Germany</div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: 52%;"></div>
                    </div>
                </div>
                <div style="margin-left: 10px;">52%</div>
            </div>
        </div>
    </div>
</div>

<script>
const revenueData = [
    { type: 'income', height: 60 },
    { type: 'expenses', height: 40 },
    { type: 'income', height: 80 },
    { type: 'expenses', height: 60 },
    { type: 'income', height: 100 },
    { type: 'expenses', height: 80 },
    { type: 'income', height: 60 }
];

const userData = [
    { type: 'expenses', width: 233, label: 'Businesses (233)' },
    { type: 'income', width: 23, label: 'Designers (23)' },
    { type: 'expenses', width: 482, label: 'Influencers (482)' }
];

const revenueAmount = 193000;
const revenueChange = '+35%';

document.addEventListener('DOMContentLoaded', function() {
    // Initialize revenue amount and change
    document.getElementById('revenue-amount').textContent = `$${revenueAmount.toLocaleString()}`;
    document.getElementById('revenue-change').innerHTML = `↑ ${revenueChange} from last month`;

    // Initialize charts
    initializeRevenueChart();
    initializeUserChart();
});

function initializeRevenueChart() {
    const chart = document.getElementById('revenue-chart');
    chart.style.display = 'flex';
    chart.style.justifyContent = 'space-around';
    chart.style.alignItems = 'flex-end';
    chart.style.height = '150px';
    chart.style.marginTop = '20px';

    revenueData.forEach(bar => {
        const barDiv = document.createElement('div');
        barDiv.style.width = '20px';
        barDiv.style.height = `${bar.height}px`;
        barDiv.style.backgroundColor = bar.type === 'income' ? '#2d6a4f' : '#a8df65';
        barDiv.style.borderRadius = '2px';
        chart.appendChild(barDiv);
    });
}

function initializeUserChart() {
    const chart = document.getElementById('user-chart');
    chart.style.marginTop = '20px';

    userData.forEach(bar => {
        const barContainer = document.createElement('div');
        barContainer.style.display = 'flex';
        barContainer.style.alignItems = 'center';
        barContainer.style.marginBottom = '10px';

        const barDiv = document.createElement('div');
        barDiv.style.height = '20px';
        barDiv.style.width = `${bar.width}px`;
        barDiv.style.backgroundColor = bar.type === 'income' ? '#2d6a4f' : '#a8df65';
        barDiv.style.marginRight = '10px';
        barDiv.style.borderRadius = '2px';

        const label = document.createElement('span');
        label.textContent = bar.label;
        label.style.color = '#333';

        barContainer.appendChild(barDiv);
        barContainer.appendChild(label);
        chart.appendChild(barContainer);
    });
}
</script>