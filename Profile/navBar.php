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
  background-color: #750D37;
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
  background-color: #210124;
  color: white;
  font-weight: bolder;
  font-style: New Century Schoolbook;
}

.topnav-right {
  float: right;
}
.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #210124;
  color: white;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

</style>
</head>
<body>
    <div class="topnav">
        <a class="active" href="timeline.php" target="main">LetsChatCode</a>
       
        <?php echo  "<a href='UserProfile.php?UserID=" . $userID. "' target='main' >".$_SESSION['UserName']." ".$_SESSION['Surname'] ?></a>
        <a href="../Chat/chatframe.php" target="main">CHATS</a>
          <a href="" onclick="logout()" target="main">LOGOUT</a>
        <!-- <div class="topnav-right">
       
        </div> -->
         <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">SEARCH</i></button>
    </form>
  </div>
  <script>
     function logout() {
            window.top.document.location ="../Login/index.php";
        }
  </script>
</body>
</html>
