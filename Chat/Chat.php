<?php 
session_start();
require_once("../connection.php"); 
// 
$userID=$_SESSION['User_ID'];
$sql = "SELECT * FROM Users WHERE UserID = ?";

if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = trim($_GET["UserID"]);
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) == 1){
            /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            // Retrieve individual field value
            $Receiver = $row["UserID"];
            $Name = $row["Names"];
            $Surname = $row["Surname"];
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
 
mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $message = $_POST["message"];
    $image = $_POST["image"];
    
    
    $newPost = "INSERT INTO Chat(SenderID,ReceiverID,Message,Image)
     VALUES('".$userID."','".$Receiver."','".$message."','".$image."')";
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
</head>
<body>
<?php
            echo $Name;
    ?>
<?php
      $result = mysqli_query($conn,"SELECT * FROM Chat WHERE (SenderID=$userID AND ReceiverID= $Receiver) 
      OR (SenderID=$Receiver AND ReceiverID= $userID)" );
      $i=0;
      while($row = mysqli_fetch_array($result)) { 
        $sender = $row["SenderID"];
        $getDetails = "SELECT * FROM Users WHERE UserID = $sender";
        $SenderDetails =mysqli_query($conn,$getDetails);
        $GetUserRow =mysqli_fetch_array($SenderDetails);
    ?>
  
      <div>
        
        <?php 
        if($row["Message"]!=null){
        ?>
        <p>
          <?php 
            echo $GetUserRow["Names"]." - ". $row["Message"];
          ?>
        </p>
        <?php
        }
        if($row["Image"]!=null){
        ?>
        <img src="<?php echo $row["Image"]?>">
        <?php
        }
        ?>
      </div>
    <?php
    $i++;
    }
    ?>
  
<form method="POST">
    
    <textarea name="message" rows="4" cols="50">
    </textarea>
    <input type="file" name="image">
    <input type="image" src="img_submit.gif" alt="Submit" width="48" height="48">
</form>
</body>
</html>