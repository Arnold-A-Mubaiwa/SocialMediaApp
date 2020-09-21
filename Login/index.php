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
  
   
* {
  box-sizing: border-box;
}

input[type=text][type=password], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
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
        <form method="post" action=""></div>
          <div class="row"><div class="col-25"><label>Username/Email</label></div>
          <div class="col-75"><input  name="username1" type=text placehoolder="example@email.com"/></div></div>
          <div class="row"><div class="col-25"><label>Password</label></div>
          <div class="col-75"><input  name="password1" type="password" placeholder="*********"/></div></div>
          <div class="row">
      <input type="submit" value="Submit">
    </div>
        </form><br/>
        <a href="ChangePass.php">Forgot Password</a>
      </div>
      <div class="register_div container" hidden>
        <form method="post" action=""></div>
          <div class="row"><div class="col-25"><label>Name</label></div>
          <div class="col-75"><input  name="name" type="text"></div></div>
          <div class="row"><div class="col-25"><label>Surname</label></div>
          <div class="col-75"><input  name="surname" type="text"></div></div>
          <div class="row"><div class="col-25"><label>Username</label></div>
          <div class="col-75"><input  name="username" type="text"></div></div>
          <div class="row"><div class="col-25"><label>Email Adress</label></div>
          <div class="col-75"><input  name="email" type="text"></div></div>
          <div class="row"><div class="col-25"><label>Password</label></div>
          <div class="col-75"><input  name="password" type="password"></div></div>
          <div class="row"><div class="col-25"><label>Confirm Password</label></div>
          <div class="col-75"><input  name="confirm_password`" type="text"></div></div>
          <div class="row">
      <input type="submit" value="Submit">
    </div>
        </form>
      </div>
    </div>
    </div>
    <script type="text/javascript" src="../JS/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="../JS/Main.js"></script>
  </body>
</html>