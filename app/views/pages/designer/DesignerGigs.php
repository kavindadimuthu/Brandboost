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
            <h1>Gigs</h1>
        </div>

        <div class="button">
            <a href="http://localhost:8000/DesignerViewController/createGig"><button class="packages-button">+ New Gig</button></a>
        </div>
       
    </div>

    
    <?php include __DIR__ . '/../../components/designer/gigsTable.php'; ?>
    <script src="../scripts/common/header.js"></script>
</body>
</html>