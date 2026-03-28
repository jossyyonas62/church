<?php
// 1. Connection & Security (Check paths carefully)
include "../includes/db.php";

// 2. Handle Deletion (If the admin clicks the trash icon)
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM prayer_requests WHERE id = $id");
    header("Location: prayers.php?msg=Deleted");
}

// 3. Fetch all requests - Newest first
$result = $conn->query("SELECT * FROM prayer_requests ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Prayer Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background: #2c3e50; min-height: 100vh; color: white; padding: 20px; }
        .card-prayer { border: none; border-radius: 12px; transition: 0.3s; border-left: 5px solid #0d6efd; }
        .card-prayer.private { border-left-color: #dc3545; background-color: #fff5f5; }
        .badge-private { background-color: #dc3545; color: white; }
        .time-stamp { font-size: 0.85rem; color: #6c757d; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block">
            <h4 class="text-center mb-4">Church Admin</h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="dashboard.php" class="nav-link text-white"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li class="nav-item mb-2"><a href="members.php" class="nav-link text-white"><i class="bi bi-people me-2"></i> Members</a></li>
                <li class="nav-item mb-2"><a href="prayers.php" class="nav-link text-info fw-bold"><i class="bi bi-heart-pulse me-2"></i> Prayer Requests</a></li>
                <li class="nav-item mb-2"><a href="../index.php" class="nav-link text-white"><i class="bi bi-house me-2"></i> View Site</a></li>
            </ul>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Prayer Requests / የጸሎት ጥያቄዎች</h2>
                <span class="badge bg-primary rounded-pill"><?= $result->num_rows ?> Total</span>
            </div>

            <?php if(isset($_GET['msg'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    Request removed successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row g-3">
                <?php if($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-12">
                            <div class="card card-prayer shadow-sm p-3 <?= ($row['is_private'] == 1) ? 'private' : ''; ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 fw-bold">
                                            <?= htmlspecialchars($row['requester_name'] ?: "Anonymous"); ?>
                                            <?php if($row['is_private'] == 1): ?>
                                                <span class="badge badge-private ms-2"><i class="bi bi-lock-fill"></i> Private / ሚስጥራዊ</span>
                                            <?php endif; ?>
                                        </h5>
                                        <div class="time-stamp mb-2">
                                            <i class="bi bi-calendar3 me-1"></i> <?= $row['created_at']; ?> 
                                            <span class="mx-2">|</span> 
                                            <i class="bi bi-telephone me-1"></i> <?= htmlspecialchars($row['phone'] ?: "No Phone Provided"); ?>
                                        </div>
                                    </div>
                                    <a href="?delete=<?= $row['id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this request?')">
                                        <i class="bi bi-trash fs-5"></i>
                                    </a>
                                </div>
                                <hr class="my-2">
                                <p class="card-text fs-5 text-dark italic">
                                    "<?= nl2br(htmlspecialchars($row['request_body'])); ?>"
                                </p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="text-center mt-5">
                        <i class="bi bi-chat-heart text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3">No prayer requests in the inbox yet.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>