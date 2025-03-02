<?php

declare(strict_types=1);

include_once __DIR__ . "/url-definitions.php";
include_once __DIR__ . "/src/api.php";

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
		handle_login();
		exit();
	case SIGNUP_HANDLER:
		if (
			isset($_POST['username']) &&
			isset($_POST['password']) &&
			isset($_POST['confirm-password']) &&
			isset($_POST['email']) &&
			handle_create_user($_POST['username'], $_POST['password'], $_POST['confirm-password'], $_POST['email'])
		) {
			echo "Created user";
		} else {
			echo "Create user failed";
		}
		exit();
	default:
		# This deafult is used as a fallback eventhough the URL is checked at the beginning of this file 
		header("Location: " . LOGIN);
		exit();
}
