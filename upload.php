<?php

include 'conn.php';
require 'vendor/autoload.php';
include 'credentials.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

if (!isset($_SESSION['id'])){
    echo "<script type='text/javascript'>alert('Login first');</script>"; 
    echo '<script> window.location="index.php";</script>';
}else{
    $id = $_SESSION['id'];
    $result = mysqli_query($conn,"SELECT * FROM users WHERE id ='$id'");
    $row = mysqli_fetch_assoc($result);
    $fName = $row['firstName'];
    $lName = $row['lastName'];
    $pic = $row['pic'];
    $u_id = $row['id'];
}

$bucketName = bucketName;
	$IAM_KEY =  IAM_KEY;
	$IAM_SECRET = IAM_SECRET;
 
    try {
		$s3 = S3Client::factory(
			array(
				'credentials' => array(
					'key' => $IAM_KEY,
					'secret' => $IAM_SECRET
				),
				'version' => 'latest',
				'region'  => 'us-east-1'
			)
		);
	} catch (Exception $e) {
		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
		// return a json object.
        die("Error: " . $e->getMessage());
        echo "<script type='text/javascript'>alert('$e');</script>";
  }

  if(isset($_FILES['profilePic'])){
    $keyName =  $fName.'/profilePic/'.basename($_FILES["profilePic"]['name']);
    $pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;
    // Add it to S3
    try {
        // Uploaded:
        $file = $_FILES["profilePic"]['tmp_name'];
        $result = $s3->putObject(
            array(
                'Bucket'=>$bucketName,
                'Key' =>  $keyName,
        'SourceFile' => $file,
        'StorageClass' => 'REDUCED_REDUNDANCY',
        'ACL'    => 'public-read' 
            )
        );
        $uu = $result->get('ObjectURL');
        //echo "<script type='text/javascript'>alert('$url');</script>"; 
    } catch (Aws\S3\Exception\S3Exception $e) {    
    die('Error:' . $e->getMessage());
    echo "<script type='text/javascript'>alert('$e');</script>";
    } catch (Exception $e) {
    die('Error:' . $e->getMessage());
    echo "<script type='text/javascript'>alert('$e');</script>";
  }

}
	
	if(isset($_FILES['file'])){
  // For this, I would generate a unqiue random string for the key name. But you can do whatever.
  $total = count($_FILES['file']['name']);
  for( $i=0 ; $i < $total ; $i++ ){ 
  $keyN = basename($_FILES["file"]['name'][$i]);
	$keyName =  $fName.'/'.basename($_FILES["file"]['name'][$i]);
	$pathInS3 = 'https://s3.us-east-1.amazonaws.com/' . $bucketName . '/' . $keyName;
	// Add it to S3
	try {
		// Uploaded:
		$file = $_FILES["file"]['tmp_name'][$i];
		$result = $s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
        'SourceFile' => $file,
        'StorageClass' => 'REDUCED_REDUNDANCY',
        'ACL'    => 'public-read' 
			)
        );
        $url = $result->get('ObjectURL');
        //echo "<script type='text/javascript'>alert('$url');</script>"; 
	} catch (Aws\S3\Exception\S3Exception $e) {    
    die('Error:' . $e->getMessage());
    echo "<script type='text/javascript'>alert('$e');</script>";
	} catch (Exception $e) {
    die('Error:' . $e->getMessage());
    echo "<script type='text/javascript'>alert('$e');</script>";
  }
  
  include 'conn.php';
  if(isset($_POST['submit'])&& !empty($url)){
    mysqli_query($conn,"INSERT INTO user_data(url,u_id,fileName) values ('$url','$u_id','$keyN')");
  }
}

}

include 'conn.php';
if(isset($_POST['profilePicBtn'])&& !empty($uu)){
  mysqli_query($conn,"UPDATE users set pic='$uu' where id='$u_id'");
}

?>