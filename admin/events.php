<?php
include "includes/db.php";

$result = $conn->query("SELECT * FROM events ORDER BY event_date DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Church Events</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-5">

<h2 class="text-center">Church Events</h2>

<div class="row mt-4">

<?php
while($row = $result->fetch_assoc()){
?>

<div class="col-md-4">

<div class="card mb-4">

<img src="images/<?php echo $row['image']; ?>" height="200">

<div class="card-body">

<h5><?php echo $row['event_name']; ?></h5>

<p>Date: <?php echo $row['event_date']; ?></p>

<p>Location: <?php echo $row['location']; ?></p>

<p><?php echo $row['description']; ?></p>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>