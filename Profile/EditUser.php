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
            $userID = $row["UserID"];
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

mysqli_stmt_close($stmt);
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $name = $_POST['name'];
    $Surname = $_POST['surname'];
    $usernames = $_POST['username'];
    $number = $_POST['number'];
    $about = $_POST['about'];
    $DateOfBirth = $_POST['dob'];
    $gender = $_POST['gender'];
    //
    $findUser = "SELECT * from UserDetails Where UserID = $userID";

    $QueryTable = mysqli_query($conn, $findUser);
    $count = mysqli_num_rows($QueryTable);
    
        $newPost = "INSERT INTO UserDetails(UserID,PhoneNumber,DateOfBirth,About,Gender)
        VALUES('" . $userID . "','" . $number . "','" . $DateOfBirth . "','" . $about . "','" . $gender . "')";
        mysqli_query($conn, $newPost);
        $current_id = mysqli_insert_id($conn);
        mysqli_query($conn, "UPDATE Users set Names='" .$name . "', Surname='" . $Surname . "' Username='" . $usernames. "' WHERE UserID='" . $userID . "'");
 
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
    <form method="post">
        <label>Name</label><br>
        <input name="name" type="text"><br>
        <label>Surname</label><br>
        <input name="surname" type="text"><br>
        <label>Username</label><br>
        <input name="username" type="text"><br>
        <label>Phone Number</label><br>
        <input name="number" type="text"><br>
        <label>About</label><br>
        <input name="about" type="text"><br>
        <label>Date Of Birth</label><br>
        <input name="dob" type="Date"><br>
        <label>Gender</label><br>
        <select name="gender">
            <option>Male</option>
            <option>FEMALE</option>
        </select>
        <input type="submit">
    
</body>

</html>