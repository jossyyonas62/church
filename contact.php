<?php
include "includes/db.php";

$message = "";
$status = "";

// Handle Form Submission
if (isset($_POST['send_message'])) {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $body    = htmlspecialchars($_POST['message']);

    // You can save these to a 'messages' table in your DB
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $body);

    if ($stmt->execute()) {
        $message = "Your message has been sent successfully! / መልእክትዎ በትክክል ተልኳል!";
        $status = "success";
    } else {
        $message = "Error sending message. Please try again.";
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
    <title>Contact Us | Mekane Yesus Church</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .contact-header { background: #004a99; color: white; padding: 60px 0; }
        .info-card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; }
        .info-card:hover { transform: translateY(-5px); }
        .map-container { border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .btn-whatsapp { background-color: #25D366; color: white; border: none; }
        .btn-whatsapp:hover { background-color: #128C7E; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="contact-header text-center">
    <div class="container">
        <h1 class="fw-bold">Contact Us / ያግኙን</h1>
        <p class="lead">We are here to pray with you and answer your questions.</p>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        
        <div class="col-lg-4">
            <div class="card info-card p-4 mb-3">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-geo-alt-fill text-primary fs-3 me-3"></i>
                    <div>
                        <h5 class="mb-0">Address / አድራሻ</h5>
                        <p class="text-muted mb-0">Amist Kilo, Addis Ababa, Ethiopia</p>
                    </div>
                </div>
            </div>

            <div class="card info-card p-4 mb-3">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-telephone-fill text-primary fs-3 me-3"></i>
                    <div>
                        <h5 class="mb-0">Phone / ስልክ</h5>
                        <p class="text-muted mb-0">+251 911 00 00 00</p>
                    </div>
                </div>
            </div>

            <div class="card info-card p-4 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-envelope-fill text-primary fs-3 me-3"></i>
                    <div>
                        <h5 class="mb-0">Email / ኢሜል</h5>
                        <p class="text-muted mb-0">info@mekaneyesus.org</p>
                    </div>
                </div>
            </div>

            <a href="https://wa.me/251911000000" class="btn btn-whatsapp w-100 py-3 fw-bold shadow-sm">
                <i class="bi bi-whatsapp me-2"></i> Message on WhatsApp
            </a>
        </div>

        <div class="col-lg-8">
            <div class="card info-card p-4 h-100">
                <h3 class="mb-4">Send a Message</h3>
                
                <?php if($message != ""): ?>
                    <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
                        <?= $message ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Prayer Request / General Inquiry" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" name="send_message" class="btn btn-primary btn-lg px-5">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4 text-center">Our Location</h3>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.4578114620573!2d38.76180187588383!3d9.035650988636904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85923984d7cb%3A0x6d11f07f46e5b6f3!2sAmist%20Kilo%2C%20Addis%20Ababa!5e0!3m2!1sen!2set!4v1711660000000!5m2!1sen!2set" 
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-4 text-muted">
    <a href="index.php" class="text-decoration-none">← Back to Home</a>
</footer>

</body>
</html>