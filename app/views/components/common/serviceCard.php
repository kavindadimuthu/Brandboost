<div class="service-card">
    <div class="main-image">
        <img src="<?php echo $data['imageUrl']; ?>" alt="<?php echo $data['serviceTitle']; ?>">
    </div>
    <div class="user-info">
        <div class="user-avatar">
            <img src="<?php echo $data['userAvatar']; ?>${data.userAvatar}"
                alt="<?php echo $data['username']; ?>${data.username}">
        </div>
        <div class="user-details">
            <div class="username">
                <?php echo $data['username']; ?>
                <?php echo $data['isVerified'] ? '<span class="verified-badge">Verified</span>' : ''; ?>
            </div>
        </div>
    </div>
    <div class="service-title">
        <?php echo $data['serviceTitle']; ?>
    </div>
    <div class="service-stats">
        <div class="rating">
            <span class="star-icon">★</span>
            <span class="rating-number"><?php echo $data['rating']; ?></span>
            <span class="rating-count">(<?php echo $data['ratingCount']; ?>)</span>
        </div>
        <div class="price"><?php echo $data['price']; ?></div>
    </div>
</div>