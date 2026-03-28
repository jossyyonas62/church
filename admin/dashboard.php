<?php 
// 1. Security Check
include "auth_check.php"; 
include "../includes/db.php";

// 2. Get Statistics
$total_members = $conn->query("SELECT COUNT(*) as total FROM members")->fetch_assoc()['total'];
$total_prayers = $conn->query("SELECT COUNT(*) as total FROM prayer_requests")->fetch_assoc()['total'];
$new_messages  = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard | Mekane Yesus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar { background: #2c3e50; min-height: 100vh; color: white; padding: 20px; }
        .stat-card { border: none; border-radius: 15px; transition: 0.3s; color: white; }
        .stat-card:hover { transform: scale(1.05); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block">
            <h4 class="text-center mb-4">Church Admin</h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="dashboard.php" class="nav-link text-info fw-bold"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li class="nav-item mb-2"><a href="members.php" class="nav-link text-white"><i class="bi bi-people me-2"></i> Members</a></li>
                <li class="nav-item mb-2"><a href="prayers.php" class="nav-link text-white"><i class="bi bi-heart-pulse me-2"></i> Prayers</a></li>
                <li class="nav-item mb-2 mt-4"><a href="logout.php" class="nav-link text-danger fw-bold"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </div>

        <div class="col-md-10 p-4">
            <h2 class="mb-4">Welcome, <?= $_SESSION['admin_user']; ?>!</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card bg-primary p-4 shadow">
                        <h3><?= $total_members; ?></h3>
                        <p class="mb-0">Total Members</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card bg-danger p-4 shadow">
                        <h3><?= $total_prayers; ?></h3>
                        <p class="mb-0">Prayer Requests</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card bg-success p-4 shadow">
                        <h3><?= $new_messages; ?></h3>
                        <p class="mb-0">Contact Messages</p>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h4>Quick Actions</h4>
                <div class="d-flex gap-2">
                    <a href="../index.php" target="_blank" class="btn btn-outline-dark">View Website</a>
                    <a href="members.php" class="btn btn-outline-primary">Manage Members</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>