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

# Return the user profile info as an associative array
# Associative array contains the following keys
#	username, email, description and profile_picture_path 
function get_user_profile_info(string $username): array|null
{
	$user_info = null;
	try {
		$db = get_db_connection();
		$query = $db->prepare("select username, email, description, profile_picture_path from users where username = ?;");
		$query->bind_param("s", $username);
		$query->execute();
		$result = $query->get_result();
		if ($result->num_rows == 1) {
			$user_info = $result->fetch_assoc();
		}
	} catch (Exception $e) {
		syslog(LOG_ERR, $e->getCode() . " " . $e->getMessage() . " " . $e->getTraceAsString());
	}

	return $user_info;
}

function username_exists(string $username): bool
{
	$user_exists = false;
	try {
		$db = get_db_connection();
		$query = $db->prepare("select username from users where username = ?;");
		$query->bind_param("s", $username);
		$query->execute();
		$result = $query->get_result();
		if ($result->num_rows == 1) {
			$user_exists = true;
		}
	} catch (Exception $e) {
		syslog(LOG_ERR, $e->getCode() . " " . $e->getMessage() . " " . $e->getTraceAsString());
	}

	return $user_exists;
}

function get_profile_picture_path(string $username): string| null
{
	$profile_picture_path = null;
	try {
		$db = get_db_connection();
		$query = $db->prepare("select profile_picture_path from users where username = ?;");
		$query->bind_param("s", $username);
		$query->execute();
		$result = $query->get_result();
		if ($result->num_rows == 1) {
			$profile_picture_path = $result->fetch_column();
		}
	} catch (Exception $e) {
		syslog(LOG_ERR, $e->getCode() . " " . $e->getMessage() . " " . $e->getTraceAsString());
	}

	return $profile_picture_path;
}

function update_profile_picture(string $username, string $new_picture_name): bool
{
	$update_success = false;
	try {
		$db = get_db_connection();
		$query = $db->prepare("update users set profile_picture_path = ? where username = ?");
		$query->bind_param("ss", $new_picture_name, $username);
		$query->execute();
		if ($query->errno == 0 && $query->affected_rows == 1) {
			$update_success = true;
		}
	} catch (Exception $e) {
		syslog(LOG_ERR, $e->getCode() . " " . $e->getMessage() . " " . $e->getTraceAsString());
	}
	return $update_success;
}

function create_new_transaction(string $sender_uname, string $receiver_uname, float $amount, string $description) {}
