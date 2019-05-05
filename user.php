<?php
    session_start();
    include 'conn.php';
    
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
 
    if(isset($_POST['share'])){
      $mobile =$_POST['mobile'];
      $s = $_POST['files'];  
      $count = count($s);
      for($i=0; $i < $count; $i++){
        for($j=0; $j< count($mobile); $j++){
          $var=$s[$i];
          $var1 = $mobile[$j];
          $result = mysqli_query($conn,"SELECT * FROM utest where file = '$var' && mobile='$var1' && user_id='$u_id'");
          if((mysqli_num_rows($result)>0)){
            echo "Exists"."<br>";
          }else{
            mysqli_query($conn,"INSERT INTO utest(file,mobile,user_id,time) values ('$var','$var1','$u_id',now())");
          }          
        }
      }
      for($j=0; $j< count($mobile); $j++){
        $var1 = $mobile[$j];
        $otp = rand(100000, 999999);
        mysqli_query($conn,"UPDATE utest set otp = '$otp' where mobile  ='$var1'");
        //echo $otp."<br>";
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Home</title>

<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:600' rel='stylesheet' type='text/css'>

<!-- font awesome -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

<!-- animate.css -->
<link rel="stylesheet" href="assets/animate/animate.css" />
<link rel="stylesheet" href="assets/animate/set.css" />

<!-- gallery -->
<link rel="stylesheet" href="assets/gallery/blueimp-gallery.min.css">

<!-- favicon -->
<link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">
<link rel="icon" href="images/favicon.jpg" type="image/x-icon">


<link rel="stylesheet" href="assets/style.css">
<style>
.docs {
    box-sizing: border-box;
    width: 100%;
    height:150px;
    width:150px;
    text-align:center;
    margin:12px;
    display: inline-table;
    vertical-align: middle;
    border: 2px solid white;
    border-radius: 40px ;
}
.docs:hover {
    opacity: 0.7;
    transform: scale(1.15);
    transition: opacity 0.5s, transform 0.5s ease-in;
}

#docImg {
    text-align:center;
    margin:25px 0px 10px 0px;
}
</style>
</head>
<body>

<div id="home">
<!-- Slider Starts -->
<div class="banner">

          <img src="images/b.jpeg" alt="banner" style="display: block;max-width: 100%;height:100%"> <!-- size is 1600x750 -->
          
          <div class="caption">
            <div class="caption-wrapper">
              <div class="caption-info">      
                  <!--<button style="position: absolute;right: 10px;top: 10px;" class="btn explore">Logout</button>-->
              <a href="logout.php" style="position: absolute;right: 10px;top: 10px; padding:20px;" class="btn btn-default">Logout</a>
              <a href="history.php" style="position: absolute;left: 10px;top: 10px; padding:20px;" class="btn btn-default">History</a>
            
                <?php
                
                echo "
               
              <a href='aa.php'><img src='".$pic."'data-toggle='modal' data-target='#myModal2' style='height:150px;width:150px;' class='img-circle profile'></a>
                <h1 class='animated bounceInUp'>Welcome Back ".$fName." ".$lName."</h1>";
              ?> 
              <p class="animated bounceInLeft">What are we planning to do today </p>
              
                <div class="animated bounceInDown">
                <button type="button" class="btn btn-default explore" style="padding:20px;" data-toggle="modal" data-target="#myModal">Upload</button>
                <button type="button" class="btn btn-default explore" style="padding:20px;" data-toggle="modal" data-target="#myModal1">Share</button>
			  		 </div>
			 <br>
              <div class="animated bounceInDown">
                <a href="#works" id="workBtn" name="workBtn" onclick="displayWork()" class="btn btn-default explore" style="padding: 20px;" value="My Files">My files</a>			
              </div>

			  </div>
            </div>
          </div>

<!-- #Slider Ends -->
</div>

<!--work-->
<div id="works" style="display:none; background: #200122;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #6f0000, #200122);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #6f0000, #200122); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
"  class=" grid"> 
<?php
    $result = mysqli_query($conn,"SELECT * FROM user_data where u_id ='$id'");
    if((mysqli_num_rows($result)>0)){
        while($row = mysqli_fetch_assoc($result)){          
            $ext = pathinfo($row['url']);    
            $ex =$ext['extension'] ;
            if($ex =='png' || $ex =='jpg' || $ex=='jpeg' || $ex='JPG' || $ex=='PNG'){
              $src = $row['url'];
            }else if($ex =='docx' || $ex=='doc' || $ex =='DOCX' || $ex =='DOC'){
                $src = 'images/icons/word.png';
            }else if($ex == 'pdf' || $ex == 'PDF'){
                $src = 'images/icons/pdf.png';
            }else if($ex == 'ppt' || $ex == 'pptx' || $ex == 'PPT' || $ex == 'PPTX'){
                $src = 'images/icons/ppt.png';
            }else if($ex == 'xls' || $ex == 'xlsx' || $ex == 'XLS' || $ex == 'XLSX'){
                $src = 'images/icons/xls.png';
            }else if($ex == 'zip' || $ex == 'rar' || $ex == 'ZIP' || $ex == 'RAR'){
                $src = 'images/icons/zip.png';
            }else if($ex == 'mp4' || $ex == 'MP4'){
                $src = 'images/icons/video.png';
            }else{
                $src = 'images/icons/file.png';
            }

            echo "<span class='docs' ><a href='".$row['url']."'><img id='docImg' style='height:60px;width:60px;' src='$src' ><br>
                ".$row['fileName']."</a></span>";
        }
    }else{
        echo "<h1 >You don't have any files. Please Upload!!!</h1>";
    }
    mysqli_close($conn);
?>
</div>
</div>

<!-- Footer Starts -->
<div class="footer text-center spacer">
<p class="wowload flipInX"><a href="#"><i class="fa fa-facebook fa-2x"></i></a> <a href="#"><i class="fa fa-instagram fa-2x"></i></a> <a href="#"><i class="fa fa-twitter fa-2x"></i></a> <a href="#"><i class="fa fa-flickr fa-2x"></i></a> </p>

</div>
<!-- # Footer Ends -->
<a href="#home" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title">Title</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->    
</div>
		  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" style="color:black">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center">Upload</h4>
        </div>
        <div class="modal-body">
           <form action="" method="post" enctype="multipart/form-data">
              <input type="file" require="" class="form-control-file" name="file[]" id="file" accept=" image/*,.xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" multiple>
              <button type="submit" name="submit" style="margin-top:10px;padding:5px;" class="form-control-file btn btn-default">Upload</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" style="padding:5px;" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	</div>
    
  	  <!-- Modal1 -->
      <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="color:black">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center">Share</h4>
        </div>
        <div class="modal-body">
        <form action="" method="post">
        <div style="text-align:start;" class="input_fields_wrap">
        <?php
        include 'conn.php';
        $result = mysqli_query($conn,"SELECT * FROM user_data where u_id ='$id'");
        if((mysqli_num_rows($result)>0)){
            while($row = mysqli_fetch_assoc($result)){
                echo "<input type='checkbox' id='files' class='number' style='margin-left:10px;margin-right:15px;' name='files[]' value='".$row['fileName']."'/>".$row['fileName']."<br>";   
            }
        }else{
            echo "<h6 >You don't have any files. Please Upload!!!</h6>";
        }
        mysqli_close($conn);            
        echo "<input type='button' disabled style='margin:5px;' id='continue' name='continue' class='btn-info' onclick='display()' value='Continue'>
        </div>  
		
        <div id='shareFields' style='display:none;'>
        <input type='tel' style='margin:5px;' class='form-control' name='mobile[]' id='mobile' placeholder='Enter mobile number to share....'>
        <button style='margin:5px;' class='add_field_button' name='more'>Add More</button>
        <input type='submit' style='margin:5px;display:block' name='share' class='btn-info' value='Share'>
        </div>
        </form>
        </div>
        <div class='modal-footer'>
        <div style='text-align:center;'>
        </div>
          <button type='button' class='btn btn-default' style='padding: 5px' data-dismiss='modal'>Close</button>
        </div>
      </div>
    </div>
	</div>";
    ?>
<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="color:black">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center">Upload Pic</h4>
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <input type="file" require= class="form-control-file" name="profilePic" id="profilePic" accept=" image/*">
            <button type="submit" name="profilePicBtn" style="margin-top:10px;padding:5px;" class="form-control-file btn btn-default">Upload</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" style="padding:5px;" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
	</div>
    
<!-- jquery -->
<script src="assets/jquery.js"></script>
<script type="text/javascript">
   var checker = document.getElementById('files');
 var sendbtn = document.getElementById('continue');
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}
 
}
function displayWork() {
  var e = document.getElementById('works');
  if(e.style.visibility == 'block')
    e.style.display = 'none';
  else
    e.style.display = 'block';
}


function display() {
  var e = document.getElementById('shareFields');
  if(e.style.visibility == 'block')
    e.style.display = 'none';
  else
    e.style.display = 'block';
}

</script>
<script>
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div><input type="tel" class="form-control" name="mobile[]" id="mobile" placeholder="Enter mobile number to share...."><a href="#" class="remove_field">Remove</a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});
</script>

<!-- wow script -->
<script src="assets/wow/wow.min.js"></script>

<!-- boostrap -->
<script src="assets/bootstrap/js/bootstrap.js" type="text/javascript" ></script>

<!-- jquery mobile -->
<script src="assets/mobile/touchSwipe.min.js"></script>
<script src="assets/respond/respond.js"></script>

<!-- gallery -->
<script src="assets/gallery/jquery.blueimp-gallery.min.js"></script>

<!-- custom script -->
<script src="assets/script.js"></script>

</body>
</html>

<?php
require 'vendor/autoload.php';
include 'credentials.php';
 
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

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
  }
  
  if(isset($_FILES['profilePic'])){
    $keyName =  $fName.'/profilePic/'.basename($_FILES["profilePic"]['name']);
    //$keyName =  basename($_FILES["profilePic"]['name']);
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
  echo "hhh"   ;
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
echo "<meta http-equiv='refresh' content='0'>";

}
include 'conn.php';
if(isset($_POST['profilePicBtn'])&& !empty($uu)){
  mysqli_query($conn,"UPDATE users set pic='$uu' where id='$u_id'");
  echo "<meta http-equiv='refresh' content='0'>";
}

?>
