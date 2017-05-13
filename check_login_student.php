<?php
	
	$studentId = $_POST['student_id'];
	$password = $_POST['password'];

	//$studentId = '5335512153';
	//$password = '10019112';

	$urlRequest = "https://passport.psu.ac.th/authentication/authentication.asmx?WSDL";
	$resultLogin = array( 'username' => $studentId,'password' => $password);



	$soap_client = new SoapClient($urlRequest);

$soapResult  = $soap_client->Authenticate($resultLogin);

$resutlLogin = $soapResult->AuthenticateResult;

if($resutlLogin == '1')
		 {


$resultDetailStudent = $soap_client->GetUserDetails($resultLogin);
        
	$studentIdGet = $resultDetailStudent->GetUserDetailsResult->string[0];
	$studentName = $resultDetailStudent->GetUserDetailsResult->string[1] . ' ' . $resultDetailStudent->GetUserDetailsResult->string[2];
        
			 $faculty = $resultDetailStudent->GetUserDetailsResult->string[8];

	
	$arrList = array();
	
	$arrList['student_id'] = $studentIdGet;
	 $arrList['student_name'] = $studentName;
$arrList['faculty'] = $faculty;


echo json_encode($arrList);



}
else
{
echo 'correct';
}


?>



