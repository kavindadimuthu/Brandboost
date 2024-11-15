<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Request</title>
    <link rel="stylesheet" href="../../styles/admin/singleRegistrationRequest.css" />
    <link rel="stylesheet" href="../../styles/admin/sidebar.css">
    <script src="../../scripts/admin/singleRegistrationRequest.js" defer></script>

  </head>
  <body>

    <div class="container">
      <div id="sidebar-container">
            <?php include __DIR__ . '/../../components/admin/sidebar.php'; ?>
      </div>

      <div class="main-content">
        <div class="heading">
            <h1>Registration Request</h1>
            <div class="back-button">
                    <div class="back-btn" onclick="window.location.href='/adminviewcontroller/allRegistrationRequests'">Back </div>
            </div>
        </div>

        <a href="#" class="back-link">Back to registrations page</a>

        <div class="section">
          <h2>New user details</h2>
          <div id="userDetails"></div>
        </div>

        <div class="section">
          <h2>Profile Description</h2>
          <div id="profileDescription"></div>
        </div>

        <div class="section">
          <h2>Social Links</h2>
          <div id="socialLinks"></div>
        </div>

        <div class="section">
          <h2>Business Registration Documents</h2>
          <div id="documents"></div>
        </div>

        <div class="action-buttons">
          <button class="accept-btn">Accept</button>
          <button class="reject-btn">Reject</button>
        </div>
      </div>
    </div>

  </body>
</html>
