<?php 
session_start();
require_once("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
  .column {
  float: left;
  padding: 10px;
  /* height: 300px; Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.column1{
  width: 20%;
  margin-right: 20px;
}
.column2{
  width: 70%;
}
body{
  padding-left:5%;
}
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
  font-family: Arial, Helvetica, sans-serif;
}
    </style>
</head>

<body>
<div class="row">
  <div class="column column1" style="background-color:#aaa;">
  profile pic
  </div>
  <div class="column column2" style="background-color:#bbb;">
    <?php
      $userID=$_SESSION['User_ID'];
      $result = mysqli_query($conn,"SELECT * FROM Post Where UserID = $userID ORDER BY DateOfPost");
      $i=0;
      while($row = mysqli_fetch_array($result)) {
        $posterID = $row["UserID"];
        $poster = mysqli_query($conn,"SELECT Names,Surname,Username FROM Users WHERE UserID = $posterID");
        $row1 = mysqli_fetch_array($poster);
    ?>
      <div>
        <label><?php echo $row1["Names"]." ".$row1["Surname"]; ?></label><br>
        <?php 
        if($row["PostText"]!=null){
        ?>
        <p>
          <?php 
            echo $row["PostText"];
          ?>
        </p>
        <?php
        }
        if($row["PostImage"]!=null){
        ?>
        <img src="<?php echo $row["PostImage"]?>">
        <?php
        }
        ?>
      </div>
    <?php
    $i++;
    }
    ?>
  </div>
</div>
</body>

</html>