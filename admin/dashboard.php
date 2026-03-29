<?php
// Start session for security
session_start();

// 1. Database Connection - Make sure this path is correct!
include "../includes/db.php";

// 2. CHECK LOGIN: If not logged in, send to login page
// If you haven't set up the session yet, you can temporarily comment these out to see the page
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// 3. Fetch Stats (Using 'members' instead of 'messages' to avoid errors)
$res_members = $conn->query("SELECT COUNT(*) as total FROM members");
$count_members = ($res_members) ? $res_members->fetch_assoc()['total'] : 0;

$res_events = $conn->query("SELECT COUNT(*) as total FROM events");
$count_events = ($res_events) ? $res_events->fetch_assoc()['total'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Sodo Mekane Yesus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background: #212529; min-height: 100vh; color: white; padding-top: 20px; }
        .nav-link { color: #ccc; transition: 0.3s; }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,0.1); }
        .stat-card { border: none; border-radius: 15px; color: white; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h5 class="text-center fw-bold text-info mb-4">SODO ADMIN</h5>
            <nav class="nav flex-column">
                <a class="nav-link active" href="dashboard.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                <a class="nav-link" href="#"><i class="bi bi-calendar-event me-2"></i> Events</a>
                <a class="nav-link" href="#"><i class="bi bi-people me-2"></i> Members</a>
                <hr>
                <a class="nav-link text-danger" href="logout.php"><i class="bi bi-box-arrow-left me-2"></i> Logout</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <h2 class="fw-bold">Admin Dashboard</h2>
            <p class="text-muted">Welcome back, Yosef.</p>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="stat-card bg-primary p-4 shadow-sm">
                        <h2 class="fw-bold"><?php echo $count_members; ?></h2>
                        <p class="mb-0">Total Members Registered</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-success p-4 shadow-sm">
                        <h2 class="fw-bold"><?php echo $count_events; ?></h2>
                        <p class="mb-0">Church Events</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>