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
    <style>
         input {
      width: 50%;
      height: 40px;
      margin-bottom: 10px;
      border: 1px solid rgb(11, 19, 46);
      background-color: white;
      padding-left: 20px;
      font-size: 16px;
    }

    input[type=Submit] {
      margin-left: 10px;
      height: auto;
      padding-bottom: 20px;
      padding-top: 20px;
      width: 50%;
      background-color: rgb(11, 19, 46);
      font-variant-caps: all-petite-caps;
      font-weight: bolder;
      font-size: 22px;
      color: #fff;
      border-radius: 9px;
    }
    .container {
      width: 50%;
      margin-left: 38%;
      /* margin-right: 40%; */
      /* background-color: lawngreen; */
    }
    label{
        font-weight: bold;
    }
    </style>
</head>

<body><div class="container">
    <form method="post">
        <label>Username</label><br>
        <input type="text" name="username" /><br>
        <label>New Password</label><br>
        <input type="password" name="password" /><br>
        <label>Confirm Password</label><br>
        <input type="password" /><br>
        <input type="submit" value="CHANGE PASSWORD">
    </form>
    <a href="index.php">Back</a>
    </div>
</body>

</html>