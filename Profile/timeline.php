<?php
require_once("../connection.php");
if($_SERVER["REQUEST_METHOD"]=='POST'){
$posttext = $_POST["posttext"];
$postimage = $_POST["postimage"];
$comment=0;
$kites=0;
$postno =abs( crc32( uniqid() ) );
$newPost="INSERT INTO ertyfghjk(PostNo,PostImage,PostText,Comments,Kites) VALUES('".$postno."','".$postimage."','".$posttext."','".$comment."','".$kites."')";

if (mysqli_query($conn,$newPost)) {
    echo "added";
}else{
    echo  $conn->error;
}
$current_id = mysqli_insert_id($conn);
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="Post">
        <textarea name="posttext">
        </textarea>
        <input type="file" name="postimage"><br>
        <input type="submit" value="Submit">
    </form>
    <a href="../Login/index.php">back</a>
</body>
</html>