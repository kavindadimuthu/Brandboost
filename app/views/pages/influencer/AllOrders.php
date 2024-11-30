<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/orderTable.css">
    <link rel="stylesheet" href="../../styles/influencer/AllOrders.css">

</head>
<body>
<?php include __DIR__ . '/../../components/common/header.php'; ?>


    <div class="container">
        <h1>Customer Orders</h1>
        <div class="search-box">
            <input type="text" placeholder="Search by Complaint ID or Username">
        </div>
    </div>
    
          <?php include __DIR__ . '/../../components/influencer/orderTable.php'; ?>
</body>
</html>