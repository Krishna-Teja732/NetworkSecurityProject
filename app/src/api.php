<?php

declare(strict_types=1);

include_once __DIR__ . "/utils/db-utils.php";

function handle_login(string $username, string $password): bool
{
	$password_hash = get_user_password($username);
	syslog(LOG_INFO, $password_hash . " " . $password);
	return $password_hash != null and password_verify($password, $password_hash);
}


// Create a new user
function handle_create_user(string $username, string $password, string $confirm_password, string $email): bool
{
	if (empty($username) || empty($password) || empty($confirm_password) || empty($email)) {
		return false;
	}
	if (strcmp($password, $confirm_password) != 0) {
		return false;
	}
	return create_new_user($username, $email, $password) == 0;
}
