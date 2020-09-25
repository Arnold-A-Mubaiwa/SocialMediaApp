<?php
session_start();
require_once("../connection.php");
$status = $statusMsg = '';


$status = 'error';
if (isset($_POST["submit"])) {
  if (!empty($_FILES["image"]["name"])) {
    $posttext = $_POST["posttext"];
    $userID = $_SESSION['User_ID'];
    $comment = 0;
    $kites = 0;
    // Get file info 
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    // Allow certain file formats 
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
      $image = $_FILES['image']['tmp_name'];
      $imgContent = addslashes(file_get_contents($image));

      // Insert image content into database 
      $insert = $conn->query("INSERT INTO Post(UserID,PostText,PostImage,Comments,Kites) VALUES('" . $userID . "','" . $posttext . "','" . $imgContent . "','" . $comment . "','" . $kites . "')");

      if ($insert) {
        $status = 'success';
        $statusMsg = "File uploaded successfully.";
        echo  $conn->error;
      } else {
        $statusMsg = "File upload failed, please try again.";
        echo  $conn->error;
      }
    } else {
      $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
      echo  $conn->error;
    }
  }else {
      $posttext = $_POST["posttext"];
      $userID = $_SESSION['User_ID'];
      // if($posttext!=""){
      $comment = 0;
      $kites = 0;
      $newPost = "INSERT INTO Post(UserID,PostText,Comments,Kites) VALUES('" . $userID . "','" . $posttext . "','" . $comment . "','" . $kites . "')";
      mysqli_query($conn, $newPost);
      $current_id = mysqli_insert_id($conn);
    }
} 
// }


// Display status message 
// echo $statusMsg;

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

    .column1 {
      width: 20%;
      margin-right: 20px;

    }

    .column2 {
      width: 70%;

    }

    body {
      padding-left: 5%;
    }

    textarea {
      width: 100%;
      height: 100px;
      padding-left: 30px;
      box-sizing: border-box;
      border: 2px solid rgb(11, 19, 46);
      border-radius: 4px;
      background-color: #f8f8f8;
      resize: none;
      font-family: Arial, Helvetica, sans-serif;
    }

    .post {
      width: 90%;
      margin-top: 20px;
      margin-bottom: 20px;
      padding-left: 3%;
      padding-right: 5%;
      background-color: white;
      border-bottom: 1px solid black;
    }

    .textPost {
      font-size: 24px;
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    label {
      font-weight: bolder;
    }

    .scrolls {
      overflow: auto;
      height: 500px;
    }

    .time {
      color: black;
      font-size: 11px;
    }

    .imagePosted {
      width: 100%;
      padding-left: 40px;

    }
    a:visited{
      color: rgb(11, 19, 46);
    }
    .submit{
      width: 100%;
      background-color: rgb(11, 19, 46);
      color: white;
      padding-top: 20px;
      padding-bottom: 20px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="row">
    <div class="column column1">
      <form method="post" enctype="multipart/form-data">
        <textarea name="posttext">
        </textarea><br><br>
        <label>Select Image File:</label>
        <input type="file" name="image"><br><br>
        <input class="submit" type="submit" name="submit" value="POST">
      </form>
    </div>
    <div class="column column2 scrolls">
      <?php
      $status;
      $result = mysqli_query($conn, "SELECT * FROM Post ORDER BY DateOfPost");
      $i = 0;
      while ($row = mysqli_fetch_array($result)) {
        $posterID = $row["UserID"];
        $poster = mysqli_query($conn, "SELECT Names,Surname,Username FROM Users WHERE UserID = $posterID");
        $row1 = mysqli_fetch_array($poster);
      ?>
        <div class="post">
          <?php echo  "<a href='UserProfile.php?UserID=" . $row['UserID'] . "' target='main' >" ?>
          <label><?php echo $row1["Names"] . " " . $row1["Surname"]; ?></label><span> <?php echo "#" . $row1["Username"]; ?></span></a><br>
          <span class="time"> <?php echo $row["DateOfPost"]; ?></span><br>
          
          <?php
          if ($row["PostText"] != null) {
          ?>
            <p class="textPost">
              <?php
              echo $row["PostText"];
              ?>
            </p>
          <?php
          }
          if ($row["PostImage"] != null) {
          ?>
            <img class="imagePosted" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['PostImage']); ?>" /><br><br>
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