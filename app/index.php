<?php

declare(strict_types=1);

openlog("app-log", LOG_PID | LOG_PERROR, LOG_LOCAL0);

include_once __DIR__ . "/src/utils/db-utils.php";

// Authentication code.
$is_valid_cookie = false;
if (isset($_COOKIE['session'])) {
	$session_cookie = $_COOKIE['session'];
	$is_valid_cookie = isset($_SESSION[$session_cookie]) && username_exists($_SESSION[$session_cookie]);
}

if (!$is_valid_cookie) {
	require __DIR__ . "/unauthenticated-url-handlers.php";
	exit();
} else {
	# To make the username of the user accessing the session set this variable
	$session_username = $_SESSION[$_COOKIE['session']];
	require __DIR__ . "/authenticated-url-handlers.php";
	exit();
}
