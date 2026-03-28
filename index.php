<?php
// 1. Database Connection
include "includes/db.php";

// 2. Fetch latest 3 events from your database
$events_result = $conn->query("SELECT * FROM events ORDER BY event_date DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wolaita Sodo Mekane Yesus | ወላይታ ሶዶ መካነ የሱስ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Segoe UI', sans-serif; transition: 0.3s; }
        
        .lang-am { display: none; }
        body.is-amharic .lang-en { display: none; }
        body.is-amharic .lang-am { display: inline-block; }

        .hero {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url("images/1.jpg");
            background-size: cover;
            background-position: center;
            height: 80vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero h1 { font-size: 3.5rem; font-weight: 800; text-shadow: 2px 2px 10px rgba(0,0,0,0.5); }
        .section-padding { padding: 80px 0; }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: 0.3s; }
        .card:hover { transform: translateY(-10px); }
        .footer { background: #111; color: #ccc; padding: 50px 0; }

        .live-pulse {
            width: 12px;
            height: 12px;
            background: #ff0000;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            box-shadow: 0 0 0 rgba(255, 0, 0, 0.4);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(255, 0, 0, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 0, 0, 0); }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">SODO MEKANE YESUS</a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="index.php"><span class="lang-en">Home</span><span class="lang-am">መነሻ</span></a></li>
                <li class="nav-item"><a class="nav-link" href="register.php"><span class="lang-en">Join Us</span><span class="lang-am">አባል ይሁኑ</span></a></li>
                <li class="nav-item"><a class="nav-link" href="prayer_request.php"><span class="lang-en">Prayer</span><span class="lang-am">ጸሎት</span></a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php"><span class="lang-en">Contact</span><span class="lang-am">ያግኙን</span></a></li>
            </ul>
            <div class="ms-lg-3">
                <button class="btn btn-sm btn-outline-light" onclick="toggleLanguage('en')">EN</button>
                <button class="btn btn-sm btn-outline-light" onclick="toggleLanguage('am')">አማ</button>
            </div>
        </div>
    </div>
</nav>

<header class="hero">
    <div class="container">
        <h1>
            <span class="lang-en">Wolaita Sodo Mekane Yesus</span>
            <span class="lang-am">ወላይታ ሶዶ መካነ የሱስ</span>
        </h1>
        <p class="lead mt-3 fs-3">
            <span class="lang-en">Worshiping Christ in Spirit and Truth</span>
            <span class="lang-am">በመንፈስ እና በእውነት ክርስቶስን ማምለክ</span>
        </p>
        <div class="mt-4">
            <a href="https://youtube.com/live" target="_blank" class="btn btn-danger btn-lg px-5 me-2 shadow-lg fw-bold">
                <i class="bi bi-broadcast me-2"></i> <span class="lang-en">Watch Live</span><span class="lang-am">በቀጥታ ይከታተሉ</span>
            </a>
            <a href="register.php" class="btn btn-light btn-lg px-5 fw-bold">
                <span class="lang-en">Register</span><span class="lang-am">ተመዝገብ</span>
            </a>
        </div>
    </div>
</header>

<section class="py-3 bg-dark text-white shadow-sm border-bottom border-danger border-3">
    <div class="container text-center text-md-start">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="live-pulse"></span> 
                <span class="fw-bold lang-en">LIVE NOW: Sunday Morning Service from Sodo</span>
                <span class="fw-bold lang-am">የቀጥታ ስርጭት፡ እሁድ ጠዋት አምልኮ ከሶዶ</span>
            </div>
            <div class="col-md-4 text-md-end mt-2 mt-md-0">
                <a href="https://facebook.com" class="btn btn-primary btn-sm"><i class="bi bi-facebook me-1"></i> Facebook</a>
                <a href="https://youtube.com" class="btn btn-danger btn-sm"><i class="bi bi-youtube me-1"></i> YouTube</a>
            </div>
        </div>
    </div>
</section>

<section class="section-padding container text-center">
    <h2 class="mb-5 fw-bold"><span class="lang-en">Service Times</span><span class="lang-am">የአምልኮ ጊዜያት</span></h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="p-4 border shadow-sm rounded-4 h-100 bg-white">
                <i class="bi bi-calendar-heart fs-1 text-primary"></i>
                <h4 class="mt-3"><span class="lang-en">Sunday Worship</span><span class="lang-am">የሰንበት አምልኮ</span></h4>
                <p class="text-muted">9:00 AM — 12:30 PM</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 border shadow-sm rounded-4 h-100 bg-white">
                <i class="bi bi-people fs-1 text-primary"></i>
                <h4 class="mt-3"><span class="lang-en">Youth Program</span><span class="lang-am">የወጣቶች ፕሮግራም</span></h4>
                <p class="text-muted">Saturday 3:00 PM</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 border shadow-sm rounded-4 h-100 bg-white">
                <i class="bi bi-shield-lock fs-1 text-primary"></i>
                <h4 class="mt-3"><span class="lang-en">Prayer Meeting</span><span class="lang-am">የጸሎት ጊዜ</span></h4>
                <p class="text-muted">Wednesday 5:30 PM</p>
            </div>
        </div>
    </div>
</section>

<section id="about" class="section-padding bg-white pt-0">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="images/1.jpg" class="img-fluid rounded-4 shadow-lg" alt="About Church">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">
                    <span class="lang-en">Rooted in Faith, Serving the Community</span>
                    <span class="lang-am">በእምነት የጸናን፣ ማህበረሰቡን የምናገለግል</span>
                </h2>
                <p class="text-muted">
                    <span class="lang-en">The Wolaita Sodo Mekane Yesus Church has been a pillar of the Gospel in Southern Ethiopia for decades. We are committed to preaching the Word and serving the whole person.</span>
                    <span class="lang-am">የወላይታ ሶዶ መካነ የሱስ ቤተክርስቲያን በደቡብ ኢትዮጵያ ለብዙ አስርት ዓመታት የወንጌል ብርሃን ሆና ቆይታለች። የእግዚአብሔርን ቃል ለመስበክና ሰውን በሙሉ ለማገልገል ቆርጠን ተነስተናል።</span>
                </p>
                <a href="register.php" class="btn btn-primary">Join Us Today</a>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container text-center">
        <h2 class="mb-5 fw-bold"><span class="lang-en">Church Events</span><span class="lang-am">መጪ ክንውኖች</span></h2>
        <div class="row g-4">
            <?php if ($events_result && $events_result->num_rows > 0): ?>
                <?php while($row = $events_result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card h-100 text-start overflow-hidden border-0 shadow">
                        <img src="images/<?= $row['image']; ?>" class="card-img-top" style="height:220px; object-fit:cover;" onerror="this.src='images/church.png'">
                        <div class="card-body">
                            <h5 class="fw-bold"><?= $row['event_name']; ?></h5>
                            <p class="text-primary mb-1 small fw-bold"><i class="bi bi-clock me-2"></i><?= $row['event_date']; ?></p>
                            <p class="text-muted small"><i class="bi bi-geo-alt me-2"></i><?= $row['location']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12"><p class="text-muted">No scheduled events. Please check back later.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<footer class="footer text-center mt-5">
    <div class="container">
        <h4 class="text-white mb-3">Wolaita Sodo Mekane Yesus Church</h4>
        <p class="mb-1 text-muted">Sodo Town, Wolaita Zone, Ethiopia</p>
        <p class="small text-muted mb-4">Email: info@sodomekaneyesus.org | Phone: +251 46 000 0000</p>
        <div class="d-flex justify-content-center gap-4 mb-4">
            <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white fs-4"><i class="bi bi-youtube"></i></a>
            <a href="#" class="text-white fs-4"><i class="bi bi-telegram"></i></a>
        </div>
        <hr class="bg-secondary opacity-25">
        <p class="small opacity-50 mb-0">© 2026 Wolaita Sodo Mekane Yesus Church. Built by Yosef Yonas.</p>
        
        <div class="mt-3">
            <a href="admin/login.php" class="text-muted small text-decoration-none">
                <i class="bi bi-lock-fill"></i> Staff Portal / የአስተዳዳሪ መግቢያ
            </a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleLanguage(lang) {
        if (lang === 'am') {
            document.body.classList.add('is-amharic');
        } else {
            document.body.classList.remove('is-amharic');
        }
        localStorage.setItem('sodoChurchLang', lang);
    }

    window.onload = function() {
        const savedLang = localStorage.getItem('sodoChurchLang') || 'en';
        toggleLanguage(savedLang);
    }
</script>

</body>
</html>