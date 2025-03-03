<?php

declare(strict_types=1);

include_once __DIR__ . "/url-definitions.php";
include_once __DIR__ . "/src/api.php";

$request_uri = $_SERVER['REQUEST_URI'];
# Strip trailing '/' from request uri
if ($request_uri != '/' && substr($request_uri, -1, 1) == '/') {
	$request_uri = substr($request_uri, 0, -1);
}

switch ($request_uri) {
	case HOME:
		require __DIR__ . "/views/home.php";
		exit();
	case MY_PROFILE:
		handle_view_profile($session_username, is_owner: true);
		exit();
	case PROFILE_PICTURE_UPDATE_HANDLER:
		handle_update_profile_picture($session_username);
		exit();
	case str_starts_with($request_uri, OTHER_USER_PROFILE):
		$view_username = substr($request_uri, mb_strlen("/profile/u/"));
		handle_view_profile($view_username, is_owner: false);
		exit();
	case LOGOUT_HANDLER:
		handle_user_logout($session_id);
		exit();
	case in_array($request_uri, UNAUTHENTICATED_URL_LIST):
		header("Location: " . HOME);
		exit();
	default:
		header("Location: " . HOME);
		exit();
}
