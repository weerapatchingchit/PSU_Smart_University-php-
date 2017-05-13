<?php
error_reporting(0);
        require_once ('config/db_connect.php');
 
    $eventName  = $_GET['event'];

        $result = mysqli_query($dbConnect,"SELECT * FROM event ORDER BY date DESC");


    $url = 'https://psusmartuniversity-fdaa4.firebaseio.com/count_check/' . $eventName . '.json';
    
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    
    $json = json_decode($result,true);

    $arrList = array();

    $arrValList = array();

    foreach($json as $key)
    {
//        $key['student_id'];
//         $key['student_name'];
//             $key['date_in'];
//             $key['date_last'];
            if(strlen($key['student_id']) == 10)
               {
        

                   
                    $arrList[] = $key;
               }
    }
//    print_r($json);
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

        <h2 class="form-signin-heading" style="text-align: center;">รายชื่อผู้เข้าร่วม</h2>
        <br><br>
        <div style="height:300px; overflow-y: scroll;">
            <table class="table table-bordered">
            <tr>
                <th>ลำดับ</th>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อนามสกุล</th>
                <th>วันเวลาเข้าครั้งแรก</th>
                <th>วันเวลาที่จับได้ครั้งสุดท้าย</th>
            </tr>
            
            <?php
                $num = 1;
                for($i = 0; $i < count($arrList); $i++)
                {
            ?>		
                    <tr>
                        <td><?=$num?></td>
                        <td><?=$arrList[$i]['student_id']?></td>
                        <td><?=$arrList[$i]['student_name']?></td>
                        <td><?=$arrList[$i]['date_in']?></td>
                        <td><?=$arrList[$i]['date_last']?></td>
        
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