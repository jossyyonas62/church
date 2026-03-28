<?php
include "includes/db.php";

$message = "";
$status = "";

if (isset($_POST['submit_prayer'])) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $request = htmlspecialchars($_POST['prayer_text']);
    $is_private = isset($_POST['is_private']) ? 1 : 0; // 1 = Only Pastor sees, 0 = Public/Church group

    // 1. Prepare Statement
    $stmt = $conn->prepare("INSERT INTO prayer_requests (requester_name, phone, request_body, is_private) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $phone, $request, $is_private);

    if ($stmt->execute()) {
        $message = "Your prayer request has been received. We are praying for you! / የጸሎት ጥያቄዎ ደርሶናል፣ እየጸለይንላችሁ ነው!";
        $status = "success";
    } else {
        $message = "Error submitting request. Please try again.";
        $status = "danger";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Request | Mekane Yesus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        .prayer-header { 
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('images/2.jpg'); 
            background-size: cover; background-position: center; color: white; padding: 100px 0;
        }
        .prayer-card { border: none; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .form-control:focus { border-color: #004a99; box-shadow: none; }
    </style>
</head>
<body>

<div class="prayer-header text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Prayer Requests / የጸሎት ጥያቄ</h1>
        <p class="lead">"Cast all your anxiety on him because he cares for you." - 1 Peter 5:7</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <?php if($message != ""): ?>
                <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
                    <?= $message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="card prayer-card p-4 p-md-5">
                <h3 class="text-center mb-4">How can we pray for you today?</h3>
                
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Your Name (Optional)</label>
                            <input type="text" name="name" class="form-control" placeholder="Anonymous">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="For follow-up">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Your Request / የጸሎት ርዕስ</label>
                        <textarea name="prayer_text" class="form-control" rows="6" placeholder="Write your prayer request here..." required></textarea>
                    </div>

                    <div class="mb-4 form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_private" id="privateSwitch">
                        <label class="form-check-label" for="privateSwitch">
                            Keep this private (Only for the Pastor)
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="submit_prayer" class="btn btn-primary btn-lg py-3">
                            <i class="bi bi-send-fill me-2"></i> Submit Prayer Request
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-5">
                <a href="index.php" class="text-decoration-none text-muted">← Back to Homepage</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>