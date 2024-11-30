<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/designer/index.css">
    <style>



        .order-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .order-container h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        .search-box {
            flex: 1;
            margin-left: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            border-color: #007bff; /* Change border color on focus */
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>

        <div class="content">
            <div class="main-content">
                <div class="order-container">
                    <div class="search-box">
                        <input type="text" placeholder="Search by Order ID or Username">
                    </div>
                </div>

                <?php include __DIR__ . '/../../components/influencer/orderTable.php'; ?>
            </div>
        </div>
    </div>

    <script src="../scripts/common/header.js"></script>
</body>

</html>
