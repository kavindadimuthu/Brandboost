<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .container-inner {
        margin: 0 300px;
        padding: 15px 0;
        border-radius: 8px;
        text-align: left;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .search-box {
        background-color: #e9e9e9;
        padding: 15px;
        border-radius: 6px;
        display: flex;
        align-items: center;
    }

    .search-box input {
        border: none;
        background-color: transparent;
        font-size: 14px;
        width: 100%;
        outline: none;
    }
    </style>
</head>
<body>

    <div class="container-inner">
        <h1>My Orders</h1>
        <div class="search-box">
            <input type="text" placeholder="Search by Order ID or Username">
        </div>
    </div>
    
          <?php include __DIR__ . '/../../components/businessman/orderTable.php'; ?>
</body>
</html>