<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Details</title>
    <link rel="stylesheet" href="../../styles/admin/singleComplaint.css">
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <script src="../../scripts/admin/singleComplaint.js"></script>
</head>
<body>
    <div class="container">
        <div id="sidebar-container">
            <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>
        </div>
  
        <div class="main-content">
            <div class="heading">
                <h1>Complaint ID #56980036</h1>
                <div class="back-button">
                    <div class="back-btn" onclick="window.location.href='/adminviewcontroller/allCustomerComplaints'">Back</div>
                </div>
            </div>
            
        
        <div class="section">
            <h2>Complainer details</h2>
            <div id="complainerDetails"></div>
        </div>
        
        <div class="section">
            <h2>Description</h2>
            <div id="complaintDescription"></div>
        </div>
        
        <div class="section">
            <h2>Proofs Images</h2>
            <div id="proofImages" class="image-grid"></div>
        </div>
        
        <div class="section">
            <h2>Proof Documents</h2>
            <div id="proofDocuments"></div>
        </div>
        
        <div class="action-buttons">
            <button class="resolve-btn">Mark as Resolved</button>
            <button class="reject-btn">Reject</button>
        </div>
    </div>
    
</body>
</html>