<?php

   require_once('../config/db_connect.php');

   $deviceId = $_POST['device_id']; 
   $fcmId = $_POST["fcm_id"];


   $stringQuery = "SELECT * FROM psu_account WHERE device_id = '$deviceId'";

   $queryCheck = mysqli_query($dbConnect, $stringQuery);

   if(mysqli_num_rows($queryCheck) == 1)
   {
		$stringUpdate = "UPDATE psu_account SET fcm_id = '$fcmId' WHERE device_id = '$deviceId'";

		$queryUpdate = mysqli_query($dbConnect, $stringUpdate);
		
		if($queryUpdate)
			echo 'success';
		else
			echo 'fail';
		
   }
   else
   {
		$stringInsert = "INSERT INTO psu_account (id,device_id,fcm_id) VALUES (null,'$deviceId','$fcmId')";
		$queryInsert = mysqli_query($dbConnect,$stringInsert);
		
		if($queryInsert)
			echo 'success';
		else
			echo 'fail';
   }
   
 
?>		