<?php

    require_once('config/db_connect.php');

	session_start();

	if(empty($_SESSION['studentId']))
	{
		header('Location: index.html');
	}



    $studentId =  $_SESSION['studentId'];
	
	if($studentId == 'Admin')
	{
		$stringQuery = "SELECT * FROM event";
	}
	else
	{
		$stringQuery = "SELECT * FROM event WHERE add_id = '$studentId'";
	}
    

    $query = mysqli_query($dbConnect,$stringQuery);

    $valueList = array();

    while($value = mysqli_fetch_assoc($query))
    {
        $valueList[] = $value;
    }

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
        table tr th,td{
                text-align: center;
            }
      </style>
      
    <style type="text/css">
        div.inline { float:left; }
        .clearBoth { clear:both; }
    </style>
      
  </head>


    <body>
              <div class="container" >
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
	  <th>จัดการ<th>
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
						<td>
							<form action="edit_select.php" method="post">
								<input class="btn btn-primary" type='hidden' name='priKey' value='<?=$valueList[$i]['pri_key']?>' /> 
								<input class="btn btn-primary" type="submit" value="แก้ไข" />
							</form>
							<form action="delete_select.php" method="post">
								<input class="btn btn-primary" type='hidden' name='priKey' value='<?=$valueList[$i]['pri_key']?>' /> 
								<input class="btn btn-primary" type="submit" value="ลบ" />
							</form>

						<td>
                    </tr>

            <?php
				$num++;
                }
            ?>
    
            
            
</table>
    </div>
                  
                  <br>
                  <br>

	<div style="text-align: center;">
		<form action="event.php">
			<input class="btn btn-primary" type="submit" value="กลับ" />
		</form>
	</div>
        </div>
    </body>


</html>