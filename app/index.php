<?php

declare(strict_types=1);

openlog("app-log", LOG_PID | LOG_PERROR, LOG_LOCAL0);

include_once __DIR__ . "/src/api.php";

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
			array_key_exists('username', $_POST) &&
			array_key_exists('password', $_POST) &&
			handle_login($_POST['username'], $_POST['password'])
		) {
			header("Location: /home", true, 303);
		} else {
			header("Location: /login", true, 303);
		}
		break;
	case "/api/create-user":
		if (
			array_key_exists('username', $_POST) &&
			array_key_exists('password', $_POST) &&
			array_key_exists('confirm-password', $_POST) &&
			array_key_exists('email', $_POST) &&
			handle_create_user($_POST['username'], $_POST['password'], $_POST['confirm-password'], $_POST['email'])
		) {
			echo "Created user";
		} else {
			echo "Create user failed";
		}

		break;
	case "/home":
		require __DIR__ . "/views/home.php";
		break;
	default:
		require __DIR__ . "/views/404.php";
}
