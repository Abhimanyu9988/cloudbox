<?php
include 'conn.php';
$error = '';
if(isset($_POST['signup'])){
 /*$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$email = mysql_real_escape_string($_POST['email']);*/
 $username = $_POST['user'];
$password = $_POST['password'];
$email = $_POST['email'];
}
$action = array();
$action['result'] = null;
 
$text = array();
if(empty($username)){ $action['result'] = 'error';
array_push($text,'You forgot your username'); 
}
if(empty($password)){ $action['result'] = 'error';
array_push($text,'You forgot your password'); 
}
if(empty($email)){ $action['result'] = 'error';
array_push($text,'You forgot your email'); 
}
if($action['result'] != 'error'){
    //no errors, continue signup
       $password = md5($password);
	   $add = mysqli_query($conn,"INSERT INTO `users`(firstName,username,password,pic,email) VALUES('$username','$username','$password','https://avatars.servers.getgo.com/2205256774854474505_medium.jpg','$email')"	);
if($add){
 echo '<script> window.location="index.php";</script>';
    //the user was added to the database    
             
}else{
         
    $action['result'] = 'error';
    array_push($text,'User could not be added to the database. Reason: ' . mysql_error());
    
}
	   }
     
/*$action['text'] = $text;
$userid = mysql_insert_id();
             
//create a random key
$key = $username . $email . date('mY');
$key = md5($key);
             
//add confirm row
$confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')"); 
             
if($confirm){
             
    echo"Done";
}else{
                 
    $action['result'] = 'error';
    array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
                 
} */

?>