<?php

declare(strict_types=1);

include_once __DIR__ . "/url-definitions.php";
include_once __DIR__ . "/src/api.php";

$request_uri = $_SERVER['REQUEST_URI'];

switch ($request_uri) {
	case HOME:
		require __DIR__ . "/views/home.php";
		exit();
	case PROFILE_PICTURE_UPDATE_HANDLER:
		handle_update_profile_picture();
		exit();
	case MY_PROFILE:
		require __DIR__ . "/views/profile.php";
		exit();
	case str_starts_with($request_uri, OTHER_USER_PROFILE):
		# Page to view other user's profile
		$username = substr($request_uri, mb_strlen("/profile/u/"));
		if (is_null($data = get_user_profile_info($username))) {
			require __DIR__ . "/views/404.php";
		} else {
			# To send the profile picture, there's an apache mod_rewrite rule to serve images directly
			# any url starting with /picture/.*\.png will be served from ./data/profile-pictures/
			$data['profile_picture_path'] = "/picture/" . $data['profile_picture_path'];
			require __DIR__ . "/views/profile.php";
		}
		break;
	case in_array($request_uri, UNAUTHENTICATED_URL_LIST):
		header("Location: " . HOME);
		exit();
	default:
		require __DIR__ . "/views/404.php";
}
