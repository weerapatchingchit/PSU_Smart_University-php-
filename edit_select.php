<?php
  session_start(); 
	require_once('config/db_connect.php');

	if(empty($_SESSION['studentId']))
	{
		header('Location: index.html');
	}


	$key = $_POST['priKey'];

	$stringQuery = "SELECT * FROM event WHERE pri_key = '$key'";
 

		$query = mysqli_query($dbConnect,$stringQuery);
      $resultList = mysqli_fetch_assoc($query);
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
       #map {
        height: 300px;
        width: 300px;
       }
    </style>
      
       <style>
        h4 {
             text-align: center;
             margin-top: 20px;
        }
      </style>
  </head>
  <body>
      
      <h2 class="form-signin-heading" style="text-align: center;"><u>แก้ไขกิจกรรม</u></h2>
      
		<div class="container" style="width:300px; padding:40px 0;">

      <form class="form-signin"  action="save_edit.php" method="post" >

         <h4 class="form-signin-heading">กิจกรรม</h4>
        <input type="text" name="eventName" class="form-control" value="<?=$resultList['event_name']?>" placeholder="Event Name" required="" autofocus="">
 
               <h4 class="form-signin-heading">รายละเอียดกิจกรรม</h4>
        <input type="text" name="eventDetail" class="form-control" value="<?=$resultList['detail']?>" placeholder="Text Detail" required="" autofocus="">

				<h4 class="form-signin-heading">คณะ</h4>
        <input type="text" name="faculty" class="form-control" value="<?=$resultList['faculty']?>" placeholder="Faculty" required="" autofocus="">

		<h4 class="form-signin-heading">สถานที่</h4>
        <input type="text" name="place" class="form-control" value="<?=$resultList['place']?>" placeholder="66XX or PSU" required="" autofocus="">

		<h4 class="form-signin-heading">วันที่จัดกิจกรรม</h4>
        <input type="date" name="date" class="form-control" value="<?=$resultList['date']?>" required="" autofocus="">

	

		<h4 class="form-signin-heading">เวลาเริ่ม</h4>
        <input type="text" name="startTime" class="form-control" value="<?=$resultList['start_time']?>" placeholder="12:30" required="" autofocus="">

		<h4 class="form-signin-heading">เวลาสิ้นสุด</h4>
        <input type="text" name="endTime" class="form-control" value="<?=$resultList['end_time']?>" placeholder="16:30" required="" autofocus="">

		<br>


		<h4 class="form-signin-heading">เบอร์โทรศัพท์</h4>
        <input type="text" name="phone" class="form-control" value="<?=$resultList['phone_no']?>" placeholder="076XXXXXXX" required="" autofocus="">

		<h4 class="form-signin-heading">รายละเอียดอื่นๆ</h4>
        <input type="text" name="extLink" class="form-control" value="<?=$resultList['ext_link']?>" placeholder="http://www.abc.com" required="" autofocus="">


		    <br>
		<h4 class="form-signin-heading">ตำแหน่งสถานที่</h4>
          
		<h4>ละติจูด</h4><input id="latitude" type="text" name="latitude" class="form-control" value="<?=$resultList['latitude']?>" placeholder="x.xxxxx" required="" autofocus="">

       <h4>ลองติจูด</h4> <input id="longitude" type="text" name="longitude" class="form-control" value="<?=$resultList['longitude']?>"placeholder="x.xxxxx" required="" autofocus="">

          <h4>สามารถกดเลือกจากแผนที่ได้</h4>
            <div id="map"></div>
		<input type="hidden" name="priKey" value="<?=$resultList['pri_key']?>">
		<br><br><br>
          <div style="text-align: center;">
        <button  class="btn btn-primary" type="submit">ยืนยัน</button>
          </div>
      </form>

    </div>


     <script>

	  var markers = [];

      function initMap() {
		 
        var uluru = {lat: 7.894241, lng: 98.352687};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
      
	   setDefaultMakers();

     function setDefaultMakers()
		  {
				 var lati = <?php echo json_encode($resultList['latitude']); ?>;
				 var longi = <?php echo json_encode($resultList['longitude']); ?>;

var locationclicks = {lat: parseFloat(lati), lng: parseFloat(longi)};
				   var marker = new google.maps.Marker({
					position: locationclicks,
					map: map
					});
				 markers.push(marker);
		  }


	function clearMarkers() {
        setMapOnAll(null);
      }

	  function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

	  function clearMarkers() {
		
        setMapOnAll(null);
      }

	  function deleteMarkers() {
        clearMarkers();
        markers = [];
      }

		google.maps.event.addListener(map, "click", function(event) {

		deleteMarkers();

		var lat = event.latLng.lat();
	    var lng = event.latLng.lng();
		
		document.getElementById("latitude").value = lat;
		document.getElementById("longitude").value = lng;
	  var locationclick = {lat: lat, lng: lng};
	  var marker = new google.maps.Marker({
          position: locationclick,
          map: map
        });
		markers.push(marker);

		marker.addListener('click', function() {
          map.setZoom(8);
          map.setCenter(marker.getPosition());
        });
	

	


});

      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDow-CZW_jjBp7-ekgJIHZRKjFntHZCP7Y&callback=initMap">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>