<?php
include "../includes/db.php";
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-5">

<h2>Church Admin Dashboard</h2>

<div class="row mt-4">

<div class="col-md-3">
<div class="card p-3 text-center">
<h4>Members</h4>
<a href="members.php" class="btn btn-primary">Manage</a>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h4>Prayer Requests</h4>
<a href="prayers.php" class="btn btn-primary">View</a>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h4>Gallery</h4>
<a href="gallery.php" class="btn btn-primary">Upload</a>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h4>Events</h4>
<a href="events.php" class="btn btn-primary">Manage</a>
</div>
</div>

</div>

</div>

</body>
</html>