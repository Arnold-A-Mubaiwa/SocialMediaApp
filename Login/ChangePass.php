<?php
require_once("../connection.php");
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $newPass = "UPDATE Users set PassWord ='$password'  WHERE Username ='$username' OR Email='$username'";
    mysqli_query($conn, $newPass);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <label>Username</label><br>
        <input type="text" name="username" /><br>
        <label>New Password</label><br>
        <input type="password" name="password" /><br>
        <label>Confirm Password</label><br>
        <input type="password" /><br>
        <button type="submit" value="">Submit</button>
    </form>
    <a href="index.php">Back</a>
</body>

</html>