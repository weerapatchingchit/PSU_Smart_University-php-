<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();


// include db connect class
require_once ('db_connect.php');
 

 
// get all products from products table
$result = mysqli_query($con,"SELECT * FROM `room` ");
 
// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["room"] = array();
 
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $room = array();
        $room["floor"] = $row["floor"];
		$room["building"] = $row["building"];
		$room["link"] = $row["link"];

    
 
        // push single product into final response array
        array_push($response["room"], $room);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>