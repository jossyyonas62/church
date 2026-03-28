<?php
include "../includes/db.php";

if(isset($_POST['upload'])){

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"../uploads/".$image);

$conn->query("INSERT INTO gallery(image)
VALUES('$image')");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Gallery Upload</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-5">

<h2>Upload Church Photo</h2>

<form method="POST" enctype="multipart/form-data">

<input type="file" name="image" class="form-control mb-3">

<button name="upload" class="btn btn-primary">
Upload
</button>

</form>

</div>

</body>
</html>