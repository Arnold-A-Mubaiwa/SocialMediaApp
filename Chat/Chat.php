<?php
session_start();
require_once("../connection.php");
// 
$userID = $_SESSION['User_ID'];
$sql = "SELECT * FROM Users WHERE UserID = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
  mysqli_stmt_bind_param($stmt, "i", $param_id);
  $param_id = trim($_GET["UserID"]);
  // Attempt to execute the prepared statement
  if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1) {
      /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // Retrieve individual field value
      $Receiver = $row["UserID"];
      $Name = $row["Names"];
      $Surname = $row["Surname"];
    }
  } else {
    echo "Oops! Something went wrong. Please try again later.";
  }
}

mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $message = $_POST["message"];
  $image = $_POST["image"];


  $newPost = "INSERT INTO Chat(SenderID,ReceiverID,Message,Image)
     VALUES('" . $userID . "','" . $Receiver . "','" . $message . "','" . $image . "')";
  if (mysqli_query($conn, $newPost)) {
    // echo "posted";
  } else {
    // echo  $conn->error;
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
    body {
      margin: 0 auto;
      max-width: 800px;
      padding: 0 20px;
    }

    .container {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .container::after {
      content: "";
      clear: both;
      display: table;
    }

    .container img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .container img.right {
      float: right;
      margin-left: 20px;
      margin-right: 0;
    }

    .time-right {
      float: right;
      color: #aaa;
      font-size: 11px;
    }

    .time-left {
      float: left;
      color: #999;
      font-size: 11px;
    }

    .scrolls {
      overflow: auto;
      height: 480px;
    }
    
  </style>
</head>

<body>

  <div class="chats scrolls">
    <?php
    echo $Name;
    ?>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM Chat WHERE (SenderID=$userID AND ReceiverID= $Receiver) 
      OR (SenderID=$Receiver AND ReceiverID= $userID)");
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
      $sender = $row["SenderID"];
      $getDetails = "SELECT * FROM Users WHERE UserID = $sender";
      $SenderDetails = mysqli_query($conn, $getDetails);
      $GetUserRow = mysqli_fetch_array($SenderDetails);

      if ($row["SenderID"] == $userID) {
    ?>
        <div class="container">
          <?php
          if ($row["Message"] != null) {
          ?>
            <p>
              <?php
              echo $GetUserRow["Names"] . " - " . $row["Message"];
              ?>
            </p>
          <?php
          }
          if ($row["Image"] != null) {
          ?>
            <img src="<?php echo $row["Image"] ?>">
          <?php
          }
          ?>
          <span class="time-right"><?php echo $row["Time"] ?></span>
        </div>
      <?php
      } else { ?>
        <div class="container darker">
          <?php
          if ($row["Message"] != null) {
          ?>
            <p>
              <?php
              echo $GetUserRow["Names"] . " - " . $row["Message"];
              ?>
            </p>
          <?php
          }
          if ($row["Image"] != null) {
          ?>
            <img src="<?php echo $row["Image"] ?>">
          <?php
          }
          ?>
          <span class="time-left"><?php echo $row["Time"] ?></span>
        </div>
    <?php
      }
      $i++;
    }
    ?>
  </div>
  <div class="send">
    <form method="POST">
      <textarea name="message" rows="4" cols="50">
    </textarea>
      <input type="file" name="image">
      <input type="image" src="img_submit.gif" alt="Submit" width="48" height="48">
    </form>
  </div>
</body>

</html>