<?php
     session_start(); 

	require_once('config/db_connect.php');

	$user = $_POST['studentId'];
	$password = $_POST['password'];

	$stringQuery = "SELECT * FROM admin_account WHERE user = '$user' AND password = '$password'";
	$query = mysqli_query($dbConnect, $stringQuery);

	if(mysqli_num_rows($query) == 1)
	{
		
		$value = mysqli_fetch_assoc($query);
		$_SESSION['name'] = $value['sex'] . ' ' .$value['name'] . ' ' . $value['surname'];
        $_SESSION['faculty'] = 'Admin';
        $_SESSION['studentId'] = 'Admin';

		header('Location: event.php');
	}
	else
	{
		$urlPSU = 'https://passport.psu.ac.th/authentication/authentication.asmx?WSDL';

		$login = array('username'=>$user,'password'=>$password);

		$soap_client = new SoapClient($urlPSU);
	    $soapResult  = $soap_client->Authenticate($login);



		$resutlLogin = $soapResult->AuthenticateResult;

		 if($resutlLogin == '1')
		 {
			$resultDetailStudent = $soap_client->GetUserDetails($login);
        
			 $name = $resultDetailStudent->GetUserDetailsResult->string[12] . ' ' . $resultDetailStudent->GetUserDetailsResult->string[1] . ' ' . $resultDetailStudent->GetUserDetailsResult->string[2];
        
			 $faculty = $resultDetailStudent->GetUserDetailsResult->string[8];
			$studentId = $resultDetailStudent->GetUserDetailsResult->string[3];
        
       
			$_SESSION['name'] = $name;
			 $_SESSION['faculty'] = $faculty;
			$_SESSION['studentId'] = $studentId;
			header('Location: event.php');
		 }
		 else
		{
			header('Location: index.php');
	
		}
	}
?>