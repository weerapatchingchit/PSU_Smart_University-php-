<?php

	require_once('config/db_connect.php');
	
	//session_start(); 
  
	$priKey = $_POST['priKey'];
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
	//$addId =  $_SESSION['studentId'];


	$stringQuery = "INSERT INTO event (pri_key,event_name,detail,faculty,place,date,start_time,end_time,phone_no,ext_link,latitude,longitude,add_id) VALUES (null,'$eventName','$eventDetail','$faculty','$place','$date','$startTime','$endTime','$phone','$extLink','$latitude','$longitude','$addId')";

	$stringQuery = "UPDATE event SET event_name = '$eventName' , detail = '$eventDetail' , faculty = '$faculty' , place = '$place' , date = '$date' , start_time = '$startTime' , end_time = '$endTime' , phone_no = '$phone' , ext_link = '$extLink' , latitude = '$latitude' , longitude = '$longitude' WHERE pri_key = '$priKey'";

	$query = mysqli_query($dbConnect,$stringQuery);

	if($query)
	{
		 header('Location: edit_event.php');
	}
	else
	{
		echo "Fail";
	}

?>