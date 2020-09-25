<?php
session_start();
require_once("../connection.php");
// 
$userID = $_SESSION['User_ID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color:rgb(11, 19, 46);
  color: white;
  font-weight: bolder;
  font-style: New Century Schoolbook;
}

.topnav-right {
  float: right;
}
</style>
</head>
<body>
    <div class="topnav">
        <a class="active" href="timeline.php" target="main">NOYOLO</a>
        <a href="../Chat/chatframe.php" target="main">CHATS</a>
        <?php echo  "<a href='UserProfile.php?UserID=" . $userID. "' target='main' >".$_SESSION['UserName']." ".$_SESSION['Surname'] ?></a>
        <div class="topnav-right">
          <a href="" onclick="logout()" target="main">LOGOUT</a>
        </div>
  <script>
     function logout() {
            window.top.document.location ="../Login/index.php";
        }
  </script>
</body>
</html>
