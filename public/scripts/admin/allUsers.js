
const users = [
    { name: 'John Doe', role: 'Designer', image: '../../assets/user_logo.png' },
    { name: 'Jane Smith', role: 'Influencer', image: '../../assets/user_logo.png' },
    { name: 'Michael Brown', role: 'Business Owner', image: '../../assets/user_logo.png' },
    { name: 'Sarah Johnson', role: 'Designer', image: '../../assets/user_logo.png' },
    { name: 'David Wilson', role: 'Influencer', image: '../../assets/user_logo.png' },
    { name: 'Emily Davis', role: 'Business Owner', image: '../../assets/user_logo.png' }
];

// Function to render the user cards dynamically
function renderUserCards(users) {
    const userContainer = document.getElementById('user');
    userContainer.innerHTML = ''; // Clear previous cards if any

    users.forEach(user => {
        // Create user card HTML structure
        const userCard = `
            <div class="card-outer" onclick="window.location.href='/adminviewcontroller/singleUser'">
                <div class="user-image">
                    <img src="${user.image}" alt="${user.name}">
                </div>
                <div class="user-info">
                    <h3>${user.name}</h3>
                    <h4>${user.role}</h4>
                </div>
            </div>
        `;
        // Append user card to the container
        userContainer.innerHTML += userCard;
    });
}


window.onload = function() {
    renderUserCards(users); // Renders 6 users dynamically

};
