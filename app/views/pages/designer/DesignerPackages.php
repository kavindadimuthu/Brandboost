<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/packagesTable.css">
    <link rel="stylesheet" href="../../styles/influencer/InfluencerPackages.css">

</head>
<body>
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

    
    <div class="container">
        <div class="title">
            <h1>Packages</h1>
        </div>

        <div class="button">
            <a href="http://localhost:8000/DesignerViewController/createpackage"><button class="packages-button">New Package</button></a>
        </div>
       
    </div>

    
    <?php include __DIR__ . '/../../components/designer/packagesTable.php'; ?>
    <script src="../scripts/common/header.js"></script>
</body>
</html>