<?php
session_start();
include "../includes/db.php";

$error = "";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check if admin exists
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Simple password check (For advanced, use password_verify)
        if ($pass == $row['password']) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_user'] = $user;
            header("Location: dashboard.php"); // Send to dashboard
            exit();
        } else {
            $error = "Invalid Password!";
        }
    } else {
        $error = "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login | Mekane Yesus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #2c3e50; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 400px; border-radius: 15px; border: none; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
    </style>
</head>
<body>

<div class="card login-card">
    <div class="text-center mb-4">
        <h3 class="fw-bold">Church Admin</h3>
        <p class="text-muted">Please sign in to continue</p>
    </div>

    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary w-100 py-2">Login</button>
    </form>
    
    <div class="text-center mt-3">
        <a href="../index.php" class="small text-decoration-none">← Back to Website</a>
    </div>
</div>

</body>
</html>