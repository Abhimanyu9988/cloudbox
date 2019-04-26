<?php 
$servername = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'company';
$conn = new mysqli($servername, $user, $pass, $dbname) or die("Could not connect: ");
$rs = @mysqli_select_db($conn, $dbname) or die("Sorry - cannot find the database"); 
if(mysqli_connect_errno($conn))
{
		//echo "Failed to connect";
		echo "<script type='text/javascript'>alert('failed');</script>"; 
}
?>																