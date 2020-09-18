<?php
session_start();
        require_once("../connection.php");
        if($_SERVER["REQUEST_METHOD"]=='POST'){
        
          if(empty($_POST['name'])){
            $newName=NULL;
            $password = mysqli_real_escape_string($conn,$_POST['password1']);
            $Email = $_POST['username1'];
            $findUser = "SELECT * from Users Where Email = '$Email' Or Username = '$Email'AND PassWord='$password'";
     
            $QueryTable = mysqli_query($conn,$findUser);
            $row = mysqli_fetch_array($QueryTable,MYSQLI_ASSOC);
            $currentUser = $row["UserID"];
            $count = mysqli_num_rows($QueryTable);
            if ($count===1) {
              $_SESSION['User_ID']=$currentUser;
              header("location: ../Profile/frame.php");
            }else{
              echo "fu";
            }
          }else{
            $userID = abs(crc32(uniqid()));
            $newEmail = $_POST["email"];
            $newName = $_POST['name'];
            $newSurname = $_POST["surname"];
            $newUsername = $_POST["username"];
            $newPassword =$_POST["password"];
            $userTable = $newName.$newSurname;
            // $CreateTable = "CREATE TABLE $userTable (`ID` INT(5) NOT NULL AUTO_INCREMENT,
            //  `PostNo` INT(20) NOT NULL,
            //  `PostImage` BLOB NULL,
            //  `PostText` VARCHAR(10000) NULL,
            //  `Comments` INT(12) NOT NULL,
            //  `Kites` INT(12) NOT NULL,
            //  `DateOfPost` DATETIME NOT NULL, PRIMARY KEY (`ID`))";
            $newUser = "INSERT INTO Users(UserID,Email,Names,Surname,Username,PassWord ) VALUES('".$userID."','".$newEmail."','".$newName."','".$newSurname."','".$newUsername."','".$newPassword."')";
            // if ($conn->query($CreateTable) === TRUE) {
              if(mysqli_query($conn,$newUser)===true){

              }else{
                echo "user not inserted into users". $conn -> error;
              }
        //   }else {
        //     echo "Error creating table: " . $conn->error;
        // }
            $current_id = mysqli_insert_id($conn);
            $conn->close();
          }
        }
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <link ref="stylesheet" type="text/css" href="../Css/Main.css" />
    <style>
      .signin_tab,.signup_tab {
    padding-left:50px;
    padding-right:50px;
    padding-top:5px;
    padding-bottom:5px;
  }
  .top_bar{
    /* border: 2px solid black; */
    text-align:center;
  }
  .main{
    text-align:center;
  }
  
    </style>
  </head>
  <body>
    <div class="container">
    <div class="top_bar">
      <button class="signin_tab">Sign In</button>
      <button class="signup_tab">Sign up</button>
    </div>
    <div class="main">
      <div class="login_div">
        <form method="post" action="">
          <label>Username/Email</label></br>
          <input name="username1" type=text placehoolder="example@email.com"/></br>
          <label>Password</label></br>
          <input name="password1" type="password" placeholder="*********"/></br></br>
          <button type="submit" value="">Submit</button>
        </form><br/>
        <a href="ChangePass.php">Forgot Password</a>
      </div>
      <div class="register_div" hidden>
        <form method="post" action="">
          <label>Name</label></br>
          <input name="name" type="text"></br>
          <label>Surname</label></br>
          <input name="surname" type="text"></br>
          <label>Username</label></br>
          <input name="username" type="text"></br>
          <label>Email Adress</label></br>
          <input name="email" type="text"></br>
          <label>Password</label></br>
          <input name="password" type="password"></br>
          <label>Confirm Password<label></br>
          <input name="confirm_password`" type="text"></br></br>
          <button type="submit" value="">Submit</button>
        </form>
      </div>
    </div>
    </div>
    <script type="text/javascript" src="../JS/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="../JS/Main.js"></script>
  </body>
</html>