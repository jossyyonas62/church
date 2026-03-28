<?php
include '../includes/db.php';

if(isset($_POST['title'])){
    $title = $_POST['title'];
    $preacher = $_POST['preacher'];
    $video = $_POST['video_link'];
    $desc = $_POST['description'];

    $sql = "INSERT INTO sermons(title,preacher,video_link,description)
            VALUES('$title','$preacher','$video','$desc')";

    $conn->query($sql);
}
?>

<h2>Add Sermon</h2>

<form method="POST">
<input type="text" name="title" placeholder="Sermon Title">
<input type="text" name="preacher" placeholder="Preacher">
<input type="text" name="video_link" placeholder="YouTube Link">
<textarea name="description"></textarea>
<button type="submit">Add Sermon</button>
</form>