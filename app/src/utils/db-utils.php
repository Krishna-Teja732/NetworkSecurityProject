<?php

declare(strict_types=1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function get_db_connection(): mysqli|null
{
	$db = null;
	try {
		$db = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'));
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
	$default_description = "No description added";
	$default_icon_name = "default-user-icon.png";
	try {
		$db = get_db_connection();
		$query = $db->prepare("insert into users values(?, ?, ?, ?, ?, ?);");
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
	$password_hash = null;
	try {
		$db = get_db_connection();
		$query = $db->prepare("select password from users where username = ?;");
		$query->bind_param("s", $username);
		$query->execute();
		$result = $query->get_result();
		if ($result->num_rows == 1) {
			$password_hash = $result->fetch_assoc()['password'];
		}
	} catch (Exception $e) {
		syslog(LOG_ERR, $e->getCode() . " " . $e->getMessage() . " " . $e->getTraceAsString());
	}

	return $password_hash;
}

function create_new_transaction(string $sender_uname, string $receiver_uname, float $amount, string $description) {}
function get_user_profile_info() {}
