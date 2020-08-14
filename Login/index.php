<?php
        require_once("../connection.php");
        if($_SERVER["REQUEST_METHOD"]=='POST'){
        
          if(empty($_POST['name'])){
            $newName=NULL;
            $password = mysqli_real_escape_string($conn,$_POST['password1']);
            $Email = $_POST['username1'];
            $findUser = "SELECT Username from Users Where Email = '$Email' Or Username = '$Email'AND PassWord='$password'";
     
            $QueryTable = mysqli_query($conn,$findUser);
            $count = mysqli_num_rows($QueryTable);
            if ($count===1) {
              echo "welcome";
            }else{
              echo "fu";
            }
          }else{
            $newEmail = $_POST["email"];
            $newName = $_POST['name'];
            $newSurname = $_POST["surname"];
            $newUsername = $_POST["username"];
            $newPassword =$_POST["password"];
            $newUser = "INSERT INTO Users(Email,Names,Surname,Username,PassWord ) VALUES('".$newEmail."','".$newName."','".$newSurname."','".$newUsername."','".$newPassword."')";
            mysqli_query($conn,$newUser);
            $current_id = mysqli_insert_id($conn);
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