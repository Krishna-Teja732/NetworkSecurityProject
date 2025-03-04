<?php

declare(strict_types=1);

include_once __DIR__ . "/url-definitions.php";
include_once __DIR__ . "/src/api.php";


# Get request URL and strip trailing '/' from request URL
$request_uri = $_SERVER['REQUEST_URI'];
if ($request_uri != '/' && substr($request_uri, -1, 1) == '/') {
	$request_uri = substr($request_uri, 0, -1);
}

# Redirect to login for invalid URL 
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
		handle_create_user();
		exit();
	default:
		# This deafult is used as a fallback eventhough the URL is checked at the beginning of this file 
		header("Location: " . LOGIN);
		exit();
}
