<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Gigs</title>
    <link rel="stylesheet" href="../../styles/common/header.css">
    <link rel="stylesheet" href="../../styles/influencer/packagesTable.css">
    <link rel="stylesheet" href="../../styles/influencer/InfluencerPackages.css">
    <!-- <link rel="stylesheet" href="../../../../public/styles/influencer/orderTable.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php include __DIR__ . '/../../components/common/header.php'; ?>

    <div class="container">
        <div class="title">
            <h1>Gigs</h1>
        </div>

        <div class="button">
            <a href="http://localhost:8000/DesignerViewController/createGig"><button class="packages-button">+ New Gig</button></a>
        </div>
    </div>

    <!-- Gigs Table -->
    <div class="orders-container">
        <div class="header-row">
            <h1>My Gigs</h1>
        </div>

        <table class="orders-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Basic Price</th>
                    <th>Premium Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="ordersTableBody">
                <?php print_r($data['gigs']); ?>
                <?php if (!empty($data['gigs'])): ?>
                    <?php foreach ($data['gigs'] as $gig): ?>
                        <tr>
                            <td><?= htmlspecialchars($gig->title); ?></td>
                            <td><?= htmlspecialchars($gig->description); ?></td>
                            <td><?= htmlspecialchars($gig->premium_price); ?></td>
                            <td><?= htmlspecialchars($gig->status); ?></td>
                            <td>
                                <button onclick="editGig(<?= $gig->id; ?>)" class="action-btn"><i class="fas fa-edit"></i></button>
                                <button onclick="confirmDelete(<?= $gig->id; ?>)" class="action-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No gigs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <p>Are you sure you want to delete this item?</p>
            <button id="confirmDelete">Yes</button>
            <button id="cancelDelete">No</button>
        </div>
    </div>

    <script>
        let selectedGigId = null;

        function confirmDelete(gigId) {
            selectedGigId = gigId;
            document.getElementById('deleteModal').style.display = 'block';
        }

        async function deleteGig() {
            if (selectedGigId !== null) {
                try {
                    const response = await fetch(`/DesignerViewController/deleteGig/${selectedGigId}`, { method: 'DELETE' });
                    const result = await response.json();

                    if (result.status === 'success') {
                        alert(result.message);
                        location.reload(); // Refresh the page
                    } else {
                        alert(result.message);
                    }
                } catch (error) {
                    console.error('Error deleting gig:', error);
                }
            }
        }

        document.getElementById('confirmDelete').addEventListener('click', deleteGig);
        document.getElementById('cancelDelete').addEventListener('click', () => {
            document.getElementById('deleteModal').style.display = 'none';
            selectedGigId = null;
        });

        function editGig(gigId) {
            window.location.href = `/DesignerViewController/editGig/${gigId}`;
        }
    </script>
    <script src="../scripts/common/header.js"></script>
</body>
</html>

