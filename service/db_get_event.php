<?php
 
$response = array();

require_once ('../config/db_connect.php');
 
$result = mysqli_query($dbConnect,"SELECT * FROM event ORDER BY date DESC");
 
 $resultList = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      
	  $resultList[] = $row;
    }
 
}

echo json_encode($resultList);

?>