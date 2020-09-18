<?php
session_start();
require_once("../connection.php");
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $posttext = $_POST["posttext"];
    // $postimage = $_POST["postimage"];
    $postimage = addslashes(file_get_contents($_FILES['postimage']['tmp_name']));
    $userID=$_SESSION['User_ID'];
    $comment = 0;
    $kites = 0;
    $postno = abs(crc32(uniqid()));
    $newPost = "INSERT INTO Post(PostNo,UserID,PostImage,PostText,Comments,Kites) VALUES('" . $postno . "','".$userID."','" . $postimage . "','" . $posttext . "','" . $comment . "','" . $kites . "')";

    if (mysqli_query($conn, $newPost)) {
        echo "posted";
    } else {
        echo  $conn->error;
    }
    $current_id = mysqli_insert_id($conn);
}
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
  <form method="Post">
        <textarea name="posttext">
        </textarea><br>
        <input type="file" name="postimage"><br>
        <input type="submit" value="POST">
        <input type="reset" value="CANCEL">
    </form>
    <!-- <a href="../Login/index.php">back</a> -->
  </div>
  <div class="column column2" style="background-color:#bbb;">
    <?php
      $result = mysqli_query($conn,"SELECT * FROM Post ORDER BY DateOfPost");
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