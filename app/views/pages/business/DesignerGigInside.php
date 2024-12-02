<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UI Layout with Flexbox</title>
  <link rel="stylesheet" href="../../styles/common/designerPackageView.css">
  <link rel="stylesheet" href="../../styles/common/header.css">
  <script src="../../scripts/common/designerPackageView.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      width: 100%;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .outer-container {
      display: flex;
      flex-direction: column;
      height: 100%;
      width: 100%;
    }

    .header {
      /* background-color: blue; */
      height: 50px; /* Fixed height for the header */
      flex-shrink: 0;
    }

    .main-content {
      display: flex;
      flex-grow: 1;
      height: auto;
      margin: 20px;
    }

    .main {
      /* background-color: white; */
      flex-grow: 1; /* Fill the remaining space */
    }

    .sidebar {
      /* background-color: red; */
      width: 370px; /* Fixed width for the sidebar */
      flex-shrink: 0; /* Prevent shrinking */
      margin-top:20px;
    }

    .bottombar {
      background-color: white;
      height: 600px; /* Fixed height for the footer */
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #686de0;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="outer-container">
    <div class="header">
        <?php include __DIR__ . '/../../components/common/header.php'; ?>
    </div>
    <div class="main-content">
      <div class="main">
        <?php include __DIR__ . '/../../components/common/designerPackageView.php'; ?>
      </div>
      <div class="sidebar">
        <?php include __DIR__ . '/../../components/common/packageCard.php'; ?>
      </div>
    </div>
    <!-- <div class="bottombar">
    </div> -->
  </div>
</body>
</html>
