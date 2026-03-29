<?php
session_start();
include "../includes/db.php";

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all prayer requests
$result = $conn->query("SELECT * FROM prayer_requests ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prayer Requests | Sodo Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .prayer-card { border-left: 5px solid #0d6efd; transition: 0.3s; }
        .prayer-card.private { border-left: 5px solid #dc3545; background-color: #fff5f5; }
        .prayer-card:hover { transform: scale(1.01); }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="dashboard.php" class="btn btn-dark btn-sm shadow-sm">
                    <i class="bi bi-arrow-left"></i> Dashboard
                </a>
                <h2 class="fw-bold text-primary mb-0">Prayer Requests</h2>
                <span class="badge bg-dark rounded-pill"><?php echo $result->num_rows; ?> Total</span>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="card mb-3 shadow-sm prayer-card <?php echo ($row['is_private'] == 1) ? 'private' : ''; ?>">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($row['requester_name']); ?></h5>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-telephone me-1"></i> <?php echo $row['phone']; ?> | 
                                        <i class="bi bi-clock me-1"></i> <?php echo date('M d, Y - h:i A', strtotime($row['created_at'])); ?>
                                    </p>
                                </div>
                                <?php if($row['is_private'] == 1): ?>
                                    <span class="badge bg-danger"><i class="bi bi-lock-fill"></i> Private Request</span>
                                <?php else: ?>
                                    <span class="badge bg-success"><i class="bi bi-globe"></i> Public Request</span>
                                <?php endif; ?>
                            </div>
                            
                            <hr class="opacity-10">
                            
                            <p class="card-text fs-5 text-dark italic">
                                "<?php echo nl2br(htmlspecialchars($row['request_body'])); ?>"
                            </p>
                            
                            <div class="mt-3 text-end">
                                <a href="https://wa.me/<?php echo $row['phone']; ?>" class="btn btn-sm btn-outline-success" target="_blank">
                                    <i class="bi bi-whatsapp"></i> Send WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-5 bg-white rounded shadow-sm">
                    <i class="bi bi-chat-heart text-muted display-1"></i>
                    <p class="mt-3 text-muted">No prayer requests have been submitted yet.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
</html>