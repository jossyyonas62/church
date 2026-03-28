<?php
// Include your database connection
include "includes/db.php";

$message = "";
$status = "";

if (isset($_POST['register'])) {
    // 1. Sanitize inputs (Basic protection)
    $name     = htmlspecialchars($_POST['name']);
    $phone    = htmlspecialchars($_POST['phone']);
    $email    = htmlspecialchars($_POST['email']);
    $gender   = $_POST['gender'];
    $age      = (int)$_POST['age'];
    $address  = htmlspecialchars($_POST['address']);
    $ministry = $_POST['ministry'];

    // 2. USE PREPARED STATEMENTS (Highly Secure)
    $stmt = $conn->prepare("INSERT INTO members (full_name, phone, email, gender, age, address, ministry) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // "ssssiss" means: string, string, string, string, integer, string, string
    $stmt->bind_param("ssssiss", $name, $phone, $email, $gender, $age, $address, $ministry);

    if ($stmt->execute()) {
        $message = "🎉 Member registered successfully! / አባል በተሳካ ሁኔታ ተመዝግቧል!";
        $status = "success";
    } else {
        $message = "❌ Error: Could not register member. " . $conn->error;
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
    <title>Member Registration | የቤተክርስቲያን አባላት ምዝገባ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .registration-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #004a99; border: none; padding: 12px; font-weight: 600; }
        .btn-primary:hover { background-color: #003366; }
        .form-label { font-weight: 600; color: #444; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <?php if($message != ""): ?>
                <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
                    <?= $message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card registration-card p-4">
                <div class="text-center mb-4">
                    <img src="images/church.png" alt="Church Logo" height="80" class="mb-3">
                    <h2 class="fw-bold">Member Registration</h2>
                    <p class="text-muted">የአባላት ምዝገባ ፎርም</p>
                </div>

                <form method="POST" action="">
                    <div class="row">
                        <div class="mb-3 col-12">
                            <label class="form-label">Full Name / ሙሉ ስም</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Phone / ስልክ</label>
                            <input type="tel" name="phone" class="form-control" placeholder="09..." required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Email / ኢሜል</label>
                            <input type="email" name="email" class="form-control" placeholder="example@mail.com">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Gender / ጾታ</label>
                            <select name="gender" class="form-select">
                                <option value="Male">Male / ወንድ</option>
                                <option value="Female">Female / ሴት</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label">Age / እድሜ</label>
                            <input type="number" name="age" class="form-control">
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Address / አድራሻ</label>
                            <input type="text" name="address" class="form-control" placeholder="City, Sub-city, Woreda">
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Ministry / የሚያገለግሉበት ክፍል</label>
                            <select name="ministry" class="form-select" required>
                                <option value="" selected disabled>Select Ministry...</option>
                                <option value="Choir">Choir / መዘምራን</option>
                                <option value="Youth">Youth / ወጣቶች</option>
                                <option value="Sunday School">Sunday School / ሰንበት ትምህርት ቤት</option>
                                <option value="Evangelism">Evangelism / ወንጌል ስርጭት</option>
                                <option value="Other">Other / ሌላ</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="register" class="btn btn-primary btn-lg">
                            Register Member / አባል መዝግብ
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-4">
                <a href="index.php" class="text-decoration-none">← Back to Homepage</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>