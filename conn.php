<?php 
$servername = 'aagakem9zh18dm.c5jc6ljre57q.us-east-1.rds.amazonaws.com';
$user = 'mydatabase';
$pass = 'dharam99';
$dbname = 'company';
$conn = new mysqli($servername, $user, $pass, $dbname) or die("Could not connect: ");
$rs = @mysqli_select_db($conn, $dbname) or die("Sorry - cannot find the database"); 
if(mysqli_connect_errno($conn))
{
		//echo "Failed to connect";
		echo "<script type='text/javascript'>alert('failed');</script>"; 
}
?>																