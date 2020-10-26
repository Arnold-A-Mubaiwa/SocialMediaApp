<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .star {
            visibility: hidden;
            font-size: 30px;
            cursor: pointer;
        }

        .star:before {
            content: "\2605";
            position: absolute;
            visibility: visible;
        }

        .star:checked:before {
            content: "\2606";
            position: absolute;
        }
    </style>
</head>

<body>
    <?php
    $val = 2;

    if (
        isset($_POST['formWheelchair']) &&
        $_POST['formWheelchair'] == 'Yes'
    ) {
        echo $val + 1;
    } else {
        echo  $val - 1;
    }

    ?>
    <form method="post"><input class="star" type="checkbox" title="bookmark page"><br/><br/>
<input class="star" type="checkbox" title="bookmark page" checked><br/><br/>
    
        Do you need wheelchair access?
        <input class="star" type="checkbox" name="formWheelchair" value="Yes"/>
        <input type="submit" name="formSubmit" value="Submit" />
    </form>


</body>

</html>