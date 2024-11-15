<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All users UI</title>
    <link rel="stylesheet" href="../../styles/admin/allUsers.css">
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <script src="../../scripts/admin/allusers.js" defer></script>
</head>
<body>
    <div class="container">
        <div id="sidebar-container">
            <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>
        </div>
        <div class="main-content">
            <h1>Users</h1>
    
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search by username or ID">
            </div>
    
            <div class="usercard">
                <div id="user"></div> <!-- This is where user cards will load -->
            </div>
    
        </div>
    
        <div class="right-sidebar">
            <!-- Right Sidebar Filters (as before) -->
             
            <div class="filter-header"><span>&#x1F50E; FILTERS</span></div>
            <div class="filter-section">
                <div class="filter-title">Sort by</div>
                <div class="filter-options">
                    <label><input type="radio" name="sort-by" checked> Name</label>
                    <label><input type="radio" name="sort-by"> Registered date</label>
                </div>
            </div>
            <div class="filter-section">
                <div class="filter-title">Sort type</div>
                <div class="filter-options">
                    <label><input type="radio" name="sort-type" checked> Ascending</label>
                    <label><input type="radio" name="sort-type"> Descending</label>
                </div>
            </div>
            <div class="filter-section">
                <div class="filter-title">User type</div>
                <div class="filter-options">
                    <label><input type="checkbox" checked> Influencers</label>
                    <label><input type="checkbox" checked> Designers</label>
                    <label><input type="checkbox"> Businesses</label>
                </div>
            </div>
            <div class="filter-actions">
                <button class="apply-button">Apply</button>
                <button class="reset-button">Reset</button>
            </div>
        </div>
    </div>
</body>
</html>
