<?php
session_start();
include "../includes/db.php";

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

if (isset($_POST['add_event'])) {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $loc  = $_POST['location'];
    
    // IMAGE UPLOAD LOGIC
    $image = $_FILES['event_image']['name'];
    $target = "../images/" . basename($image);

    $sql = "INSERT INTO events (event_name, event_date, location, image) VALUES ('$name', '$date', '$loc', '$image')";
    
    if ($conn->query($sql)) {
        if (move_uploaded_file($_FILES['event_image']['tmp_tmp_name'], $target)) {
            $msg = "<div class='alert alert-success text-center'>Event Added Successfully!</div>";
        } else {
            $msg = "<div class='alert alert-warning text-center'>Event saved, but image upload failed. Check your 'images' folder permissions.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Event | Sodo Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .card { border: none; border-radius: 20px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="dashboard.php" class="btn btn-sm btn-dark mb-3"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
            <div class="card shadow-lg p-4">
                <h3 class="fw-bold text-center mb-4">Add New Church Event</h3>
                
                <?php echo $msg; ?>

                <form action="add_event.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Event Name</label>
                        <input type="text" name="event_name" class="form-control" placeholder="e.g. Sunday Morning Worship" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Event Date & Time</label>
                        <input type="datetime-local" name="event_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="e.g. Sodo Main Sanctuary" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Event Banner/Image</label>
                        <input type="file" name="event_image" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" name="add_event" class="btn btn-primary w-100 fw-bold py-2 mt-3">
                        <i class="bi bi-cloud-arrow-up me-2"></i> Publish Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>