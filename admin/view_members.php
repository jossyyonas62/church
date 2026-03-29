<?php
session_start();
include "../includes/db.php";

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all members from the database
$result = $conn->query("SELECT * FROM members ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Members | Sodo Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; }
        .member-card { border: none; border-radius: 15px; }
        .table thead { background-color: #212529; color: white; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="dashboard.php" class="btn btn-dark btn-sm shadow-sm">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
                <h3 class="fw-bold mb-0 text-primary">Registered Church Members</h3>
                <span class="badge bg-primary fs-6"><?php echo $result->num_rows; ?> Total</span>
            </div>

            <div class="card member-card shadow-sm p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="py-3">ID</th>
                                <th class="py-3">Full Name</th>
                                <th class="py-3">Email Address</th>
                                <th class="py-3">Phone</th>
                                <th class="py-3">Join Date</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold">#<?php echo $row['id']; ?></td>
                                        <td><?php echo $row['fullname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <td class="text-muted small"><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                                        <td class="text-center">
                                            <a href="mailto:<?php echo $row['email']; ?>" class="btn btn-sm btn-outline-info" title="Send Email">
                                                <i class="bi bi-envelope"></i>
                                            </a>
                                            </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">No members have registered yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>