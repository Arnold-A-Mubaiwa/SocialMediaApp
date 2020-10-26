<?php
session_start();
require_once("../connection.php");
$userID = $_SESSION['User_ID'];
$sql = "SELECT * FROM Users WHERE UserID != $userID";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color:  #210124;
        }
    .contact{
        margin-bottom: 10px;
        width: 100%;
        height: 40px;
        padding-top: 5px;
        border-radius: 10px;
        text-align: center;
        color: white;
       background-color:  #750D37;
       font-size: 26px;
       text-decoration: none;
    }
    .contact a, a:visited{
        color: white;
        text-decoration: none;

    }
    .contact:active{
      background-color: #750D37;
    }
    .contact:hover{
      background-color: white;
      color: rgb(11, 19, 46);
    }
    </style>
</head>

<body>
<div >
<?php
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo  "<a href='Chat.php?UserID=" . $row['UserID'] . "' target='main2' >" .
                    "<div class='contact'>" . $row["Names"] . " " . $row["Surname"] . "</div>" . "</a>";
            }
        }
    }
    ?>
</div>
</body>
</html>