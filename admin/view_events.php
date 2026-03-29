<?php
session_start();
include "../includes/db.php";

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all events from the database
$result = $conn->query("SELECT * FROM events ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Events | Sodo Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .event-card { border-radius: 15px; border: none; }
        .img-preview { width: 80px; height: 60px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="dashboard.php" class="btn btn-dark btn-sm shadow-sm">
            <i class="bi bi-arrow-left"></i> Dashboard
        </a>
        <h3 class="fw-bold text-primary mb-0">Church Events</h3>
        <a href="add_event.php" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Add New Event
        </a>
    </div>

    <div class="card event-card shadow-sm p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <img src="../images/<?php echo htmlspecialchars($row['image']); ?>" 
                                         class="img-preview" alt="event">
                                </td>
                                <td class="fw-bold"><?php echo htmlspecialchars($row['event_name']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($row['event_date'])); ?></td>
                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-calendar-x display-4"></i><br>
                                No events found in the database.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>