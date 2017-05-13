<?php
	session_start(); 
    require_once('config/db_connect.php');

	if(isset($_POST['logout']))
	{
		echo "AA";
		session_destroy();
		header('Location: index.html');
	}

	if(empty($_SESSION['studentId']))
	{
		header('Location: index.html');
	}

   
    $name = $_SESSION['name'];
    $faculty = $_SESSION['faculty'];
    $studentId =  $_SESSION['studentId'];

    $stringQuery = "SELECT * FROM event";

    $query = mysqli_query($dbConnect,$stringQuery);

    $valueList = array();

    while($value = mysqli_fetch_assoc($query))
    {
        $valueList[] = $value;
    }

//echo '<pre>';
//    print_r($valueList);
//echo '</pre>';

    mysqli_close($dbConnect);

?>


<html>

  <head>
      <title>PSU Smart University</title>
      <meta charset="utf-8">

      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
body, html {
    height: 100%;
    line-height: 1.8;
}
/* Full height image header */
.bgimg-1 {
    background-position: center;
    background-size: cover;
    background-image: url("/w3images/tablet_pen.jpg");
    min-height: 100%;
}
.w3-navbar li a {
    padding: 16px;
    float: left;
}
table tr th{
                text-align: center;
            }
</style>

      
      
  </head>

    <body>
            <div class="w3-top">
  <ul class="w3-navbar" id="myNavbar">
    <li>
      <a href="event.php" class="w3-wide">HOME</a>
    </li>
    <li>
      <a><?=$studentId?> <?=$name?> <?=$faculty?></a>
    </li>
    <!-- Float links to the right -->
    <li class="w3-right w3-hide-small">
      
      <a href="show_list_event.php">LISTEVENT</a>
      <a href="index.html">LOGOUT</a>
    </li>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
    <li>
      <a href="javascript:void(0)" class="w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
        <i class="fa fa-bars w3-padding-right w3-padding-left"></i>
      </a>
    </li>
  </ul>
</div>

<!-- Sidenav on small screens when clicking the menu icon -->
<nav class="w3-sidenav w3-black w3-card-2 w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidenav">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-large w3-padding-16">Close ×</a>
  <a href="event.php">CREATE</a>
      <a href="scoreboard.php">SCOREBOARD</a>
      <a href="index.html">LOGOUT</a>
</nav>









        
        <div class="container" >
        
        <div style="text-align: center; margin-top:50px;">
        
            
        <br>

        <h2 class="form-signin-heading" style="text-align: center;">รายชื่อกิจกรรม</h2>
        <br><br>
        <div style="height:300px; overflow-y: scroll;">
            <table class="table table-bordered">
            <tr>
                <th>ลำดับ</th>
                <th>รายชื่อกิจกรรม</th>
                <th>รายละเอียด</th>
                <th>คณะ</th>
                <th>สถานที่</th>
                <th>วันที่</th>
                <th>เริ่มเวลา</th>
                <th>สิ้นสุดเวลา</th>
                <th>เบอร์โทรศัพท์</th>
            </tr>
            
            <?php
				$num = 1;
                for($i = count($valueList)-1; $i >= 0; $i--)
                {
            ?>		
                    <tr>
                        <td><?=$num?></td>
                        <td><?=$valueList[$i]['event_name']?></td>
                        <td><?=$valueList[$i]['detail']?></td>
                        <td><?=$valueList[$i]['faculty']?></td>
                        <td><?=$valueList[$i]['place']?></td>
                        <td><?=$valueList[$i]['date']?></td>
                        <td><?=$valueList[$i]['start_time']?></td>
                        <td><?=$valueList[$i]['end_time']?></td>
                        <td><?=$valueList[$i]['phone_no']?></td>
                    </tr>

            <?php
				$num++;
                }
            ?>
    
            
            
            </table>
        </div>

        <br><br>
        <div class="form-inline" style="text-align: center;"> 
            <button class="btn btn-primary" onclick="location.href='input_event.php'" type="button">เพิ่มกิจกรรม</button>        
            <button class="btn btn-primary" onclick="location.href='edit_event.php'" type="button">แก้ไขกิจกรรม</button>        
	    </div>
    </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>


</html>