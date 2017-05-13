<?php
    require_once('config/db_connect.php');


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

      <style>
        table tr th{
                text-align: center;
            }
      </style>
      
      
  </head>

    <body>
        
        <div class="container" >
        
        <div style="text-align: center; margin-top:20px;">
        <p><?=$name?></p>
         <p><?=$faculty?></p>
            <p><?=$studentId?></p>
            </div>
<!--
		<form style="text-align: center; margin-top:20px;" action="event.php" method="post">
			<input class="btn btn-primary" type="submit" name="logout" value="Log out" />
		</form>
            
-->
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
                <th>รายละเอียดผู้เข้าร่วม</th>
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
                        <td><button class="btn btn-primary" onclick="location.href='result_list.php?event=<?=$valueList[$i]['event_name']?>'" type="button">ดูรายชื่อเข้าร่วมกิจกรรม</button> </td>
                    </tr>

            <?php
				$num++;
                }
            ?>
    
            
            
                
            </table>
        </div>

       
    </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>


</html>