<?php

declare(strict_types=1);

openlog("app-log", LOG_PID | LOG_PERROR, LOG_LOCAL0);

include_once __DIR__ . "/src/api.php";
include_once __DIR__ . "/src/utils/db-utils.php";

$request_uri = $_SERVER['REQUEST_URI'];

switch ($request_uri) {
	case "/":
	case "/login":
		require __DIR__ . "/views/login.php";
		break;
	case "/signup":
		require __DIR__ . "/views/signup.php";
		break;
	case "/api/login-handler":
		if (
			isset($_POST['username']) &&
			isset($_POST['password']) &&
			handle_login($_POST['username'], $_POST['password'])
		) {
			header("Location: /home", true, 303);
		} else {
			header("Location: /login", true, 303);
		}
		break;
	case "/api/create-user":
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

		break;
	case "/api/update-profile-picture":
		handle_update_profile_picture();
		break;
	case "/home":
		require __DIR__ . "/views/home.php";
		break;
	case str_starts_with($request_uri, "/profile/u/"):
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
	default:
		require __DIR__ . "/views/404.php";
}
