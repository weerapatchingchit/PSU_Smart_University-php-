<?php
       
      require_once('db_connect.php');
      $result = mysqli_query($con,"SELECT * FROM notification");
      
     $idList = array();
     while($value = mysqli_fetch_assoc($result)){
     $idList[] = $value["gym_id"];
   // echo $value["gym_id"];
}

     $message = array();
     $message["message"] = "Event now ";
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

?>			