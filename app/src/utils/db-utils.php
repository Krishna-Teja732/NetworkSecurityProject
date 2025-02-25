<?php

declare(strict_types=1);

#TODO: Make these as env variables, use the env in docker-compose.yaml to set the user and passwords
$DB_NAME = 'app_database';
$HOST_NAME = 'mysql';
$USER = 'root';
$PASSWORD = 'secret';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function list_all_users()
{
	global $DB_NAME, $HOST_NAME, $USER, $PASSWORD;
	$result = null;
	try {
		$db = new mysqli($HOST_NAME, $USER, $PASSWORD, $DB_NAME);
		$result = $db->query("select * from users;")->fetch_all(MYSQLI_ASSOC);
	} catch (mysqli_sql_exception $e) {
		syslog(LOG_ERR, $e->getMessage() . $e->getTraceAsString());
	}

	return $result;
}

function create_new_user(string $username, string $email, string $password, int $balance = 100) {}
function create_new_transaction(string $sender_uname, string $receiver_uname, float $amount, string $description) {}
function get_user_profile_info() {}

#TODO: 
# Fucntion to get username, password_hash and password salt from the database
