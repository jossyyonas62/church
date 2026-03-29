<?php
session_start();
include "../includes/db.php";

// Fetch Real-Time Counts
$members_res = $conn->query("SELECT COUNT(*) as total FROM members");
$members_count = $members_res ? $members_res->fetch_assoc()['total'] : 0;

$events_res = $conn->query("SELECT COUNT(*) as total FROM events");
$events_count = $events_res ? $events_res->fetch_assoc()['total'] : 0;

$prayers_res = $conn->query("SELECT COUNT(*) as total FROM prayer_requests");
$prayers_count = $prayers_res ? $prayers_res->fetch_assoc()['total'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SODO ADMIN | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --sidebar-bg: #212529; --primary-blue: #0d6efd; --success-green: #198754; --warning-orange: #f39c12; }
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background: var(--sidebar-bg); min-height: 100vh; position: fixed; width: 250px; padding-top: 20px; transition: 0.3s; }
        .main-content { margin-left: 250px; padding: 40px; }
        .nav-link { color: #cfd0d1; padding: 12px 25px; border-radius: 5px; margin: 5px 15px; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.1); color: #fff; }
        .stat-card { border: none; border-radius: 15px; color: white; transition: 0.3s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="sidebar shadow">
    <div class="text-center mb-4">
        <h4 class="text-info fw-bold">SODO ADMIN</h4>
        <p class="text-muted small">Church Management System</p>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link active" href="dashboard.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
        <a class="nav-link" href="view_events.php"><i class="bi bi-calendar-event me-2"></i> Events</a>
        <a class="nav-link" href="view_members.php"><i class="bi bi-people me-2"></i> Members</a>
        <a class="nav-link" href="view_prayers.php"><i class="bi bi-heart-pulse me-2"></i> Prayers</a>
        <hr class="mx-3 text-secondary">
        <a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-left me-2"></i> Logout</a>
    </nav>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-0">Admin Dashboard</h2>
            <p class="text-muted">Welcome back, Yosef.</p>
        </div>
        <div class="badge bg-white text-dark p-2 border shadow-sm rounded-pill">
            <i class="bi bi-calendar3 text-primary me-2"></i> <?php echo date('l, M d, Y'); ?>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="stat-card p-4 shadow-sm" style="background-color: var(--primary-blue);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-0"><?php echo $members_count; ?></h2>
                        <span>Total Members</span>
                    </div>
                    <i class="bi bi-people-fill display-5 opacity-50"></i>
                </div>
                <a href="view_members.php" class="text-white-50 small mt-3 d-block text-decoration-none">View List <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card p-4 shadow-sm" style="background-color: var(--success-green);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-0"><?php echo $events_count; ?></h2>
                        <span>Church Events</span>
                    </div>
                    <i class="bi bi-calendar-check display-5 opacity-50"></i>
                </div>
                <a href="view_events.php" class="text-white-50 small mt-3 d-block text-decoration-none">Manage Events <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card p-4 shadow-sm" style="background-color: var(--warning-orange);">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold mb-0"><?php echo $prayers_count; ?></h2>
                        <span>Prayer Requests</span>
                    </div>
                    <i class="bi bi-chat-heart-fill display-5 opacity-50"></i>
                </div>
                <a href="view_prayers.php" class="text-white-50 small mt-3 d-block text-decoration-none">Read Requests <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold mb-4">Quick Management</h5>
            <div class="d-flex gap-3">
                <a href="add_event.php" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i> Add New Event
                </a>
                <a href="../index.php" target="_blank" class="btn btn-outline-dark px-4 py-2 rounded-pill">
                    <i class="bi bi-eye me-2"></i> Visit Live Site
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>