<?php

	require_once('config/db_connect.php');
	
	 session_start();

	$eventName = $_POST['eventName'];
	$faculty = $_POST['faculty'];
	$eventDetail = $_POST['eventDetail'];
	$place = $_POST['place'];
	$date = $_POST['date'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	$phone = $_POST['phone'];
	$extLink = $_POST['extLink'];
	$eventName = $_POST['eventName'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$addId =  $_SESSION['studentId'];


	$stringQuery = "INSERT INTO event (pri_key,event_name,detail,faculty,place,date,start_time,end_time,phone_no,ext_link,latitude,longitude,add_id) VALUES (null,'$eventName','$eventDetail','$faculty','$place','$date','$startTime','$endTime','$phone','$extLink','$latitude','$longitude','$addId')";

	$query = mysqli_query($dbConnect,$stringQuery);

	if($query)
	{
		 $message = 'กิจกรรม ' . $eventName .  ' เริ่มเวลา   ' . $startTime . ' สิ้นสุดเวลา  ' . $endTime . ' วันที่  ' . $date . ' สถานที่  '  . $place;
		 sendNofitication($dbConnect,$message);
		 header('Location: event.php');
	}
	else
	{
		echo "Fail";
	}


	function sendNofitication($dbConnect,$messagePass)
	{

  
      $result = mysqli_query($dbConnect,"SELECT * FROM psu_account");
      
     $idList = array();
     while($value = mysqli_fetch_assoc($result))
	 {
		$idList[] = $value["fcm_id"];
	}

     $message = array();
     $message["message"] = $messagePass;
     $message["status"] = "Status now ";
   


       $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
        'registration_ids' =>$idList ,
        'data' =>$message );

       $headers = array(
            'Authorization:key =  AIzaSyC7t2Q8kNIihGVG8b8jyMBZ5GtzBB5tiRc',
       'Content-Type: application/json');
   
     
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       echo $result;
	
	}

?>