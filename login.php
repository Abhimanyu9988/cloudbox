<?php
include 'conn.php';
$error = ''; // Variable To Store Error Message 
if (isset($_POST['submit'])) { 
  if (empty($_POST['username']) || empty($_POST['pass'])) { 
    $error = "Username or Password is blank"; 
  } 
  else{ 
    
    // Define $username and $password 
    $username = $_POST['username']; 
    $password = $_POST['pass']; 

    // mysqli_connect() function opens a new connection to the MySQL server. 
    
    // SQL query to fetch information of registerd users and finds user match. 
    $query = "SELECT * from users where username='$username' AND password='$password'"; 
    // To protect MySQL injection for Security purpose 
    $result = mysqli_query($conn,$query);
    if(!mysqli_num_rows($result)){
      $error = "check username and password";
      echo "<script type='text/javascript'>alert('$error');</script>";
    }else{
      while ($row = mysqli_fetch_array($result) ){
        $id=$row['id'];
        $image=$row['pic'];
        $firstName = $row['firstName'];
      }
      $_SESSION['id']=$id;
      $_SESSION['pic']=$image;
      $firstName['firstName']=$firstName;
      echo '<script> window.location="index.html";</script>';		
    }
  }
}
?>