<?php

declare(strict_types=1);

openlog("app-log", LOG_PID | LOG_PERROR, LOG_LOCAL0);

include "./src/api.php";

$request_uri = $_SERVER['REQUEST_URI'];

switch ($request_uri) {
	case "/":
	case "/login":
		require __DIR__ . "/views/login.php";
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
	case "/home":
		require __DIR__ . "/views/home.php";
		break;
	default:
		require __DIR__ . "/views/404.php";
}
