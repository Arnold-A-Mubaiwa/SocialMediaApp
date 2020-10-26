<?php
session_start();
require_once("../connection.php");
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

  if (empty($_POST['name'])) {
    $newName = NULL;
    $password = mysqli_real_escape_string($conn, $_POST['password1']);
    $Email = $_POST['username1'];
    $findUser = "SELECT * from Users Where Email = '$Email' Or Username = '$Email'AND PassWord='$password'";
    $QueryTable = mysqli_query($conn, $findUser);
    $row = mysqli_fetch_array($QueryTable, MYSQLI_ASSOC);
    $currentUser = $row["UserID"];
    $name = $row["Names"];
    $surname = $row["surname"];
    $count = mysqli_num_rows($QueryTable);
    if ($count === 1) {
      $_SESSION['User_ID'] = $currentUser;
      $_SESSION['UserName'] = $name;
      $_SESSION['Surname'] = $surname;
      header("location: ../Profile/frame.php");
    } else {
      
    }
  } else {
    $userID = abs(crc32(uniqid()));
    $newEmail = $_POST["email"];
    $newName = $_POST['name'];
    $newSurname = $_POST["surname"];
    $newUsername = $_POST["username"];
    $newPassword = $_POST["password"];
    $userTable = $newName . $newSurname;
    $newUser = "INSERT INTO Users(UserID,Email,Names,Surname,Username,PassWord ) VALUES('" . $userID . "','" . $newEmail . "','" . $newName . "','" . $newSurname . "','" . $newUsername . "','" . $newPassword . "')";
    if (mysqli_query($conn, $newUser) === true) {
    } else {
      echo "user not inserted into users" . $conn->error;
    }
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
    .container {
      width: 50%;
      margin-left: 38%;
      /* margin-right: 40%; */
      /* background-color: lawngreen; */
    }

    .signin_tab,
    .signup_tab {
      width: 25%;
      margin-left: 4px;
      height: 40px;
      background-color: #750D37;
      color: white;
      opacity: 0.5;
    }

    .signin_tab:hover,
    .signup_tab:hover {
      opacity: 0.8;
    }

    input {
      width: 50%;
      height: 40px;
      margin-bottom: 10px;
      border: 1px solid #750D37;
      background-color: white;
      padding-left: 20px;
      font-size: 16px;
    }

    input[type=Submit] {
      margin-left: 10px;
      height: auto;
      padding-bottom: 20px;
      padding-top: 20px;
      width: 50%;
      background-color: #750D37;
      font-variant-caps: all-petite-caps;
      font-weight: bolder;
      font-size: 22px;
      color: #fff;
      border-radius: 9px;
    }

    label {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="top_bar">
      <a href="#"> <button class="signin_tab a">Sign In</button></a>
      <a href="#"> <button class="signup_tab a">Sign up</button></a>
    </div>
    <div class="main">
      <div class="login_div">
        <form method="post" action=""><br>
          <label>Username/Email</label><br>
          <input name="username1" type=text placehoolder="example@email.com" /><br>
          <label>Password</label><br>
          <input name="password1" type="password" placeholder="*********" /><br>
          <input type="submit" value="SIGN IN">
        </form><br />
        <a href="ChangePass.php">Forgot Password</a>
      </div>
      <div class="register_div" hidden>
        <form method="post" action=""><br>
          <label>Name</label><br>
          <input name="name" type="text"><br>
          <label>Surname</label><br>
          <input name="surname" type="text"><br>
          <label>Username</label><br>
          <input name="username" type="text"><br>
          <label>Email Adress</label><br>
          <input name="email" type="text"><br>
          <label>Password</label><br>
          <input name="password" type="password"><br>
          <label>Confirm Password</label><br>
          <input name="confirm_password`" type="text"><br>
          <div class="row">
            <input type="submit" value="SIGN UP">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="../JS/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="../JS/Main.js"></script>
</body>

</html>