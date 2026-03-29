<?php
session_start();
include "../includes/db.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$msg = "";

if (isset($_POST['add_event'])) {
    // Fixed: using real_escape_string to prevent SQL crashes
    $name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $date = $_POST['event_date'];
    $loc  = mysqli_real_escape_string($conn, $_POST['location']);
    
    // Image Logic: matches the 'event_image' name in the HTML form
    $image_name = $_FILES['event_image']['name'];
    $image_temp = $_FILES['event_image']['tmp_name'];
    $target_folder = "../images/" . $image_name;

    // Check if images folder exists
    if (!is_dir('../images')) { mkdir('../images', 0777, true); }

    $sql = "INSERT INTO events (event_name, event_date, location, image) 
            VALUES ('$name', '$date', '$loc', '$image_name')";
    
    if ($conn->query($sql)) {
        if (move_uploaded_file($image_temp, $target_folder)) {
            $msg = "<div class='alert alert-success'>Event Added Successfully!</div>";
        } else {
            $msg = "<div class='alert alert-warning'>Event saved, but image upload failed. Check folder permissions.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
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
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="dashboard.php" class="btn btn-dark btn-sm mb-3">Back to Dashboard</a>
            <div class="card shadow p-4">
                <h3 class="text-center mb-4">Add New Church Event</h3>
                <?php echo $msg; ?>
                <form action="add_event.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Event Name</label>
                        <input type="text" name="event_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date & Time</label>
                        <input type="datetime-local" name="event_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Event Image</label>
                        <input type="file" name="event_image" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" name="add_event" class="btn btn-primary w-100">Publish Event</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>