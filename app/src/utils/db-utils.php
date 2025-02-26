<?php

declare(strict_types=1);

#TODO: Make these as env variables, use the env in docker-compose.yaml to set the user and passwords
$DB_NAME = 'app_database';
$HOST_NAME = 'mysql';
$USER = 'root';
$PASSWORD = 'secret';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function get_db_connection(): mysqli
{
	global $DB_NAME, $HOST_NAME, $USER, $PASSWORD;
	$db = null;
	try {
		$db = new mysqli($HOST_NAME, $USER, $PASSWORD, $DB_NAME);
	} catch (mysqli_sql_exception $e) {
		syslog(LOG_ERR, $e->getMessage() . $e->getTraceAsString());
	}
	return $db;
}

// This function does not perform input validation before creating the user, add the login in the calling function
// Returns the 0 if successful, non zero error code
function create_new_user(string $username, string $email, string $password, int $balance = 100): int
{
	$password_hash = password_hash($password, PASSWORD_BCRYPT);
	$db = get_db_connection();
	$query = $db->prepare("insert into users values(?, ?, ?, ?, ?, ?);");
	$default_description = "No description added";
	$default_icon_name = "default-user-icon.png";
	try {
		$query->bind_param("sssssi", $username, $email, $default_description, $default_icon_name, $password_hash, $balance);
		$query->execute();
	} catch (Exception $e) {
		syslog(LOG_ERR, $e->getCode() . " " . $e->getMessage() . " " . $e->getTraceAsString());
		return $query->errno;
	}

	return $query->errno;
}


// Return password hash if user exists or null 
function get_user_password(string $username): string|null
{
	$result = null;
	$db = get_db_connection();
	$query = $db->prepare("select password from users where username = ?;");
	try {
		$query->bind_param("s", $username);
		$query->execute();
		$result = $query->get_result()->fetch_assoc()['password'];
	} catch (Exception $e) {
		syslog(LOG_ERR, $e->getCode() . " " . $e->getMessage() . " " . $e->getTraceAsString());
	}

	return $result;
}

function create_new_transaction(string $sender_uname, string $receiver_uname, float $amount, string $description) {}
function get_user_profile_info() {}
