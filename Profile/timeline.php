<?php
session_start();
require_once("../connection.php");
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $posttext = $_POST["posttext"];
    // $postimage = $_POST["postimage"];
    // $postimage = addslashes(file_get_contents($_FILES['postimage']['tmp_name']));
    $userID=$_SESSION['User_ID'];
    $comment = 0;
    $kites = 0;
    $postno = abs(crc32(uniqid()));
    // $newPost = "INSERT INTO Post(PostNo,UserID,PostImage,PostText,Comments,Kites) VALUES('" . $postno . "','".$userID."','" . $postimage . "','" . $posttext . "','" . $comment . "','" . $kites . "')";
///
$status ='';
if(!empty($_FILES["image"]["name"])) { 
  // Get file info 
  $fileName = basename($_FILES["image"]["name"]); 
  $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
   
  // Allow certain file formats 
  $allowTypes = array('jpg','png','jpeg','gif'); 
  if(in_array($fileType, $allowTypes)){ 
      $image = $_FILES['image']['tmp_name']; 
      $imgContent = addslashes(file_get_contents($image)); 
   
      // Insert image content into database 
      $insert = $conn->query("INSERT INTO Post(PostNo,UserID,PostImage,PostText,Comments,Kites) VALUES('" . $postno . "','".$userID."','" . $imgContent . "','" . $posttext . "','" . $comment . "','" . $kites . "'"); 
       
      if($insert){ 
          $status = 'success'; 
          $statusMsg = "File uploaded successfully."; 
      }else{ 
          // $statusMsg = "File upload failed, please try again."; 
          echo  $conn->error;
      } 
    
  } else {
          echo  $conn->error;
      }
  } else {
      echo  $conn->error;
  }

    $current_id = mysqli_insert_id($conn);
    }
   else {
        echo  $conn->error;
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
.post{
  width: 90%;
  margin-top:20px;
  margin-bottom: 20px;
  padding-left: 3%;
  padding-right: 5%;
  background-color: white;
}
.textPost{
  font-size: 24px;
  font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}
label{
  font-weight: bolder;
}
    </style>
</head>

<body>
<div class="row">
  <div class="column column1" style="background-color:#aaa;">
  <form method="Post">
        <textarea name="posttext">
        </textarea><br>
        <input type="file" name="image"><br>
        <input type="submit" value="POST">
        <input type="reset" value="CANCEL">
    </form>

  </div>
  <div class="column column2" style="background-color:#bbb;">
    <?php
    $status;
      $result = mysqli_query($conn,"SELECT * FROM Post ORDER BY DateOfPost");
      $i=0;
      while($row = mysqli_fetch_array($result)) {
        $posterID = $row["UserID"];
        $poster = mysqli_query($conn,"SELECT Names,Surname,Username FROM Users WHERE UserID = $posterID");
        $row1 = mysqli_fetch_array($poster);
    ?>
      <div class="post">
        <label><?php echo $row1["Names"]." ".$row1["Surname"]; ?></label><span> <?php echo $row["DateOfPost"];?></span><br>
        <span> <?php echo "#".$row1["Username"];?></span>
        <?php 
        if($row["PostText"]!=null){
        ?>
        <p class="textPost">
          <?php 
            echo $row["PostText"];
          ?>
        </p>
        <?php
        }
        if($row["PostImage"]!=null){
        ?>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['PostIymage']); ?>" /> 
        
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