<?PHP

$user_name = "u822189463_mydb";
$password = "22932024";
$database = "u822189463_mydb";
$server = "mysql.hostinger.in.th";

$con = mysqli_connect($server, $user_name, $password,$database);


if ($con) {

$SQL="INSERT INTO event VALUES ('', '$_POST[eventName]','$_POST[eventDetail]','$_POST[creator]','$_POST[place]','$_POST[date]','$_POST[start_time]','$_POST[end_time]',1,'$_POST[phone_no]','$_POST[ext_link]')";

$result = mysqli_query($con,$SQL);

mysqli_close($con);

print "Records added to the database";
require_once('send.php');

}
else {

print "Database NOT Found ";
mysqli_close($con);

}

?>
