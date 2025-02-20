<?php

$request_uri = $_SERVER['REQUEST_URI'];

switch ($request_uri) {
	case "/login":
		require __DIR__ . "/public/views/login.php";
		break;
	default:
		require __DIR__ . "/public/views/404.php";
}
