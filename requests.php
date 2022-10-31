<?php
session_start();

//ini_set('display_errors',0);
include_once('config/app.php');
include_once('Classes/Database.php');
include_once('Classes/user.php');

if(isset($_POST['request_name']) && $_POST['request_name'] === 'login') {
	
    $message = ''; 
	$response = array();


	$email = $_POST['email'];
	$password = $_POST['password'];

	$user = new User();

	$check_status = User::emptyInput($email, $password);

	if (!$check_status['status']) {
		$response['message'] = $check_status['message'];
		echo json_encode($response);
	}
	else {
		$login_status = $user->login($email,$password);

		 if($login_status['status'] == 0){

		 	$response['message'] = $login_status['message'];
		 	echo json_encode($response);

		}
		else{
			$response['status'] = $login_status['status'];
			$url = $login_status['redirect_url'];
			$response['redirect_url'] = $url;
			echo json_encode($response);
		}	
			

		
	}

   
}

?>