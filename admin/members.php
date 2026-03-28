<?php
// 1. Database Connection
include "../includes/db.php";

// 2. Handle Search Query
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// 3. Fetch Members (Using search filter if provided)
$query = "SELECT * FROM members WHERE full_name LIKE ? OR phone LIKE ? OR ministry LIKE ? ORDER BY id DESC";
$stmt = $conn->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Member Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .sidebar { background: #2c3e50; min-height: 100vh; color: white; padding: 20px; }
        .main-content { padding: 30px; }
        .table-card { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .badge-ministry { background-color: #e3f2fd; color: #0d47a1; font-weight: 600; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block">
            <h4 class="mb-4 text-center">Church Admin</h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="dashboard.php" class="nav-link text-white"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                <li class="nav-item mb-2"><a href="members.php" class="nav-link text-info fw-bold"><i class="bi bi-people me-2"></i> Members</a></li>
                <li class="nav-item mb-2"><a href="sermons.php" class="nav-link text-white"><i class="bi bi-mic me-2"></i> Sermons</a></li>
                <li class="nav-item mb-2"><a href="../index.php" class="nav-link text-white"><i class="bi bi-house me-2"></i> View Site</a></li>
            </ul>
        </div>

        <div class="col-md-10 main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Registered Members <small class="text-muted fs-6">(የተመዘገቡ አባላት)</small></h2>
                <a href="../register.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add New Member</a>
            </div>

            <div class="card table-card mb-4 p-3">
                <form method="GET" class="row g-2">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control" placeholder="Search by name, phone, or ministry..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark w-100">Search</button>
                    </div>
                </form>
            </div>

            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Full Name / ስም</th>
                                <th>Contact / ስልክ</th>
                                <th>Gender</th>
                                <th>Ministry / ክፍል</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($result->num_rows > 0): ?>
                                <?php $count = 1; while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td class="fw-bold"><?= $row['full_name'] ?></td>
                                    <td>
                                        <div><?= $row['phone'] ?></div>
                                        <small class="text-muted"><?= $row['email'] ?></small>
                                    </td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><span class="badge badge-ministry p-2"><?= $row['ministry'] ?></span></td>
                                    <td><?= $row['address'] ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No members found. / ምንም አባል አልተገኘም።</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>