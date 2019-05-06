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
//echo "<script type='text/javascript'>alert($u_id);</script>";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>History</title>

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
    margin:30px;
    display: inline-table;
    vertical-align: middle;
    border: 2px solid black;
    border-radius: 20px ;
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

          <img src="images/b.jpeg" alt="banner" style="display: block;max-width: 100%;height:100%" ><!-- size is 1600x750 -->
          
          <div class="caption">
            
              <div class="caption-info">      
                  <!--<button style="position: absolute;right: 10px;top: 10px;" class="btn explore">Logout</button>-->
              <a href="logout.php" style="position: absolute;right: 10px;top: 10px; padding:20px;" class="btn btn-default">Logout</a>
              <a href="home.php" style="position: absolute;left: 10px;top: 10px; padding:20px;" class="btn btn-default">Back</a>
              <h3 style='position:absolute;left:100px;margin:5px;' class='animated bounceInUp'>History</h3>
                 
    		  </div>

              <div class="container">
            <table class="table" style="color:white;position:relative;top:100px;">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Mobile Number</th>
                        <th>Date and Time</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * from utest where user_id='$id'";
                 $result = mysqli_query($conn,$sql);
                    while($row= mysqli_fetch_assoc($result) ):?>
                <tr>
                    <td><?php echo $row['file'];?></td>
                    <td><?php echo $row['mobile'];?></td>
                    <td><?php echo $row['time'];?></td>
                </tr>
                <?php endwhile;?>
                </table>
</div>
          </div>

<!-- #Slider Ends -->
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
	
<!-- jquery -->
<script src="assets/jquery.js"></script>

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

