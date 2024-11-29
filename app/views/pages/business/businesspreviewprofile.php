<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/business-owner/BusinessPreviewProfile.css">

</head>
<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

    <div class="profile-container">
        <div id="profile-section">
            <!-- Profile Details will be loaded here -->
        </div>
        <h2>Active Packages</h2>
        <div id="packages-section" class="card-container">
            <!-- Active Packages will be loaded here -->
        </div>
        <h2>Reviews</h2>
        <div id="reviews-section">
            <!-- Reviews will be loaded here -->
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
    // Sample data
    const profile = {
        name: "ABC Solutions",
        username: "@abcsolutions2011",
        rating: 4.9,
        profileImage: "../../assets/user_logo.png",
        reviews: [
            { reviewer: "John Doe", rating: 4.9, comment: "Ariana did an amazing job! Highly recommended." },
            { reviewer: "Jane Smith", rating: 4.8, comment: "Great results from the promotion. Very professional." },
            { reviewer: "Michael Johnson", rating: 4.7, comment: "Excellent collaboration. Will work again soon!" }
        ]
    };

    // Display profile details
    const profileSection = document.getElementById("profile-section");
    profileSection.innerHTML = `
        <img src="${profile.profileImage}" alt="Profile Picture">
        <div class="details">
            <h1>${profile.name}</h1>
            <p>${profile.username}</p>
            <p>⭐ ${profile.rating}</p>
        </div>
    `;

    // Display reviews
    const reviewsSection = document.getElementById("reviews-section");
    profile.reviews.forEach(review => {
        const reviewCard = document.createElement("div");
        reviewCard.classList.add("review");
        reviewCard.innerHTML = `
            <div class="review-header">
                <p><strong>${review.reviewer}</strong></p>
                <p>⭐ ${review.rating}</p>
            </div>
            <p>${review.comment}</p>
        `;
        reviewsSection.appendChild(reviewCard);
    });
});

    </script>
</body>
</html>
    
</html>