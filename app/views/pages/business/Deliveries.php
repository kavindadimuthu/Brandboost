<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/business-owner/DeliveriesTable.css">
    <link rel="stylesheet" href="../../styles/business-owner/allOrders.css">

</head>
<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

    <div class="container">
        <h1>Deliveries</h1>
        <div class="search-box">
            <input type="text" placeholder="Search by Order ID or Username">
        </div>
    </div>
    
          <?php include __DIR__ . '/../../pages/business/DeliveriesTable.php'; ?>
</body>
</html>