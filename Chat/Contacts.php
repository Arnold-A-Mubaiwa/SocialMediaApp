<?php 
session_start();
require_once("../connection.php");
    $sql = "SELECT * FROM Users";

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
             echo  "<a href='Chat.php?UserID=". $row['UserID'] ."' target='main2' ".
             "<div>".$row["Names"]." ".$row["Surname"]."</div><br>"."</a>";
        }
    }
}
    ?>
</body>
</html>