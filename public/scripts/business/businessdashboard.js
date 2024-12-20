
document.addEventListener('DOMContentLoaded', function() {
    const orders = [
        { customer: 'Nethuru', price: '$50', status: 'In Progress' },
        { customer: 'Razan', price: '$25', status: 'In Progress' },
        { customer: 'Kavinda', price: '$30', status: 'In Progress' }
    ];

    const orderTableBody = document.getElementById('orderTableBody');

    orders.forEach(order => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${order.customer}</td>
            <td>${order.price}</td>
            <td>${order.status}</td>
            <td><button class="view-btn">View</button></td>
        `;
        orderTableBody.appendChild(row);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    fetch("../../components/influencer/header.html")
        .then(response => response.text())
        .then(data => {
            document.getElementById("header").innerHTML = data;
        });
});