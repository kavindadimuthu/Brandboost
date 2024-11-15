<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration requests UI</title>
    <link rel="stylesheet" href="../../styles/admin/complaints.css">
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <script src="../../scripts/admin/allRegistrationRequests.js" defer></script>
</head>
<body>
    <div class="container">
        <div id="sidebar-container">
            <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h1>All Registration Requests</h1>
    
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search by username or ID">
            </div>
    
            <div class="customer-complaints">
                <h2>Registration Requests</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Date</th>
                            <th>Request</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
    
        </div>
    
        <div class="right-sidebar">
             
            <div class="filter-header"><span>&#x1F50E; FILTERS</span></div>
            
            <div class="filter-section">
                <div class="filter-title">Sort type</div>
                <div class="filter-options">
                    <label><input type="radio" name="sort-type" checked> Newest first</label>
                    <label><input type="radio" name="sort-type"> Oldest first</label>
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
