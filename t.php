
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <input type="text">
    <!--<input type="submit" name="submit" value="hello">-->
    <button type="submit" name="submit">HEll</button>
    </form>
</body>
</html>
<?php

include 'conn.php';
     //$sql = "INSERT INTO user_data(url,u_id) values ('sa',1)";
     //$res = mysqli_query($conn,$sql);
     if(isset($_POST['submit'])){
     mysqli_query($conn,"INSERT INTO user_data(url,u_id) values ('url',1)");

     }
    
?>