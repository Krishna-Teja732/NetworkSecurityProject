<?php

declare(strict_types=1);

include_once __DIR__ . "/url-definitions.php";
include_once __DIR__ . "/src/api.php";
require_once __DIR__ . "/src/utils/input-sanatization-utils.php";

$request_uri = $_SERVER['REQUEST_URI'];

# Send 404 for any other URL
if (!in_array($request_uri, UNAUTHENTICATED_URL_LIST)) {
	header("Location: " . LOGIN);
	exit();
}

switch ($request_uri) {
	case LOGIN:
		require __DIR__ . "/views/login.php";
		exit();
	case SIGNUP:
		require __DIR__ . "/views/signup.php";
		exit();
	case LOGIN_HANDLER:
		if(
			validate_signin_inputs($_POST['username'], $_POST['password'])
		){
			handle_login();
			exit();
		}
		else{
			header("Location: /login");
        	exit();
		}
		
	case SIGNUP_HANDLER:
		if (
			validate_signup_inputs($_POST['username'], $_POST['password'], $_POST['email']) &&
			handle_create_user()
		) {
			header("Location: /login");
			$session_id = session_id();
			setcookie("signup_success", $_POST['username'], path: '/');
			exit();
		} else {
			header("Location: /signup");
        	exit();
		}
		exit();
	default:
		# This deafult is used as a fallback eventhough the URL is checked at the beginning of this file 
		header("Location: " . LOGIN);
		exit();
}
