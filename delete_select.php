<?php
	require_once('config/db_connect.php');

	$key = $_POST['priKey'];
	

	$stringQuery = "DELETE FROM event WHERE pri_key = '$key'";

	$query = mysqli_query($dbConnect, $stringQuery);

	if($query)
	{
		header('Location: edit_event.php');
		
	}
	else
	{

	}

?>