<?php

declare(strict_types=1);

include_once __DIR__ . "/utils/db-utils.php";
include_once __DIR__ . "/utils/input-sanatization-utils.php";

function handle_login(): void
{
	if (!isset($_POST['username']) || !isset($_POST['password'])) {
		header("Location: " . LOGIN);
		exit();
	}
	if (!validate_signin_inputs($_POST['username'], $_POST['password'])) {
		header("Location: " . LOGIN);
		exit();
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_hash = get_user_password($username);

	if ($password_hash == null or !password_verify($password, $password_hash)) {
		header("Location: " . LOGIN);
		exit();
	}

	# Create and set cookie, redirect to login page
	$cookie_value = bin2hex(random_bytes(16));
	$_SESSION[$cookie_value] = $username;
	header("Location: " . HOME);
	setcookie("session", $cookie_value, path: '/', secure: true, httponly: true);
	exit();
}

function handle_user_logout(string $session_id)
{
	unset($_SESSION[$session_id]);
	unset($_COOKIE["session"]);
	setcookie("session", "", time() - 3600, path: '/');
	header("Location: " . LOGIN);
	exit();
}


// Create a new user
function handle_create_user(): bool
{
	# Check if all input attributes are set
	if (!isset($_POST['username']) && !isset($_POST['password']) && !isset($_POST['confirm-password']) && !isset($_POST['email'])) {
		return false;
	}
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm-password'];

	# Redirect to signup on invalid inputs
	if (
		!validate_signup_inputs($username, $password, $email) ||
		strcmp($password, $confirm_password) != 0
	) {
		header("Location: /signup");
		exit();
	}

	if (!create_new_user($username, $email, $password) == 0) {
		header("Location: /signup");
		exit();
	}

	# User created, redirect to login
	header("Location: /login");
	setcookie("signup_success", $username, path: '/');
	exit();
}

function handle_view_profile(string $username, bool $is_owner)
{
	# Page to view other user's profile
	if (is_null($data = get_user_profile_info($username))) {
		http_response_code(404);
	} else {
		# To send the profile picture, there's an apache mod_rewrite rule to serve images directly
		# any url starting with /picture/.*\.png will be served from ./data/profile-pictures/
		$data['profile_picture_path'] = "/picture/" . $data['profile_picture_path'];
		$data['is_owner'] = $is_owner;
		require __DIR__ . "/../views/profile.php";
	}
}

function handle_view_home(string $username)
{
	$data = get_home_page_info($username);
	$data["profile_picture_path"] = GET_PROFILE_PICTURE . $data["profile_picture_path"];

	$transactions = [];
	foreach ($data["transactions"] as $transaction) {
		$formatted_transaction_row = $transaction;
		unset($formatted_transaction_row["sender_username"]);
		unset($formatted_transaction_row["receiver_username"]);
		unset($formatted_transaction_row["amount_sent"]);

		$formatted_transaction_row["username"] = $transaction["sender_username"] == $username ? $transaction["receiver_username"] : $transaction["sender_username"];
		$amount_sent = $transaction["sender_username"] == $username ? -1 * $transaction["amount_sent"] : $transaction["amount_sent"];
		$formatted_transaction_row["amount"] = floatval($amount_sent);

		array_push($transactions, $formatted_transaction_row);
	}


	$data["transactions"] = $transactions;
	require __DIR__ . "/../views/home.php";
}

function handle_update_email(string $username)
{

	if (!isset($_POST['email']) || $_POST['email'] == '') {
		header("Location: " . MY_PROFILE);
		exit();
	}
	$email = sanitize_input_string($_POST['email']);
	update_user_profile($username, "email", $email);
	header("Location: " . MY_PROFILE);
}

function handle_update_description(string $username)
{
	if (!isset($_POST['description'])) {
		header("Location: " . MY_PROFILE);
		exit();
	}
	$description = sanitize_input_string($_POST['description']);
	update_user_profile($username, "description", $description);
	header("Location: " . MY_PROFILE);
}

// Profile picture update
# The following sanitization is performed on the uploaded file 
# 1. Check if image is uploaded using is_uploaded_file()
# 2. Image mime type with Fileinfo
# 3. Check extension using pathinfo and basename
# 4. Use GD to create image 
# 5. Use GD to scale down image
# 6. Generate uuid name with time_stamp for the image
# 7. Store uuid name in sql database
# 8. Move file to /var/www/data/profile-pictures using move_uploaded_image
# 9. Remove exec permission from file 
# The images are stored in /var/www/data/profile-pictures/*.png
const UPLOAD_DIR = "/var/www/data/profile-pictures";
function handle_update_profile_picture(string $username)
{
	if (!isset($_FILES['profile-picture']['tmp_name']) || $_FILES['profile-picture']['error'] != 0) {
		header("Location: " . MY_PROFILE);
		exit();
	}
	$allowed_extensions = ['png'];
	$allowed_mime_types = ['image/png'];

	$temp_file_name = $_FILES['profile-picture']['tmp_name'];
	$file_extension = strtolower(pathinfo(basename($_FILES['profile-picture']['name']), PATHINFO_EXTENSION));
	$file_mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $temp_file_name);
	if (
		!in_array($file_mime_type, $allowed_mime_types) ||
		!in_array($file_extension, $allowed_extensions) ||
		!is_uploaded_file($temp_file_name)
	) {
		header("Location: " . MY_PROFILE);
		exit();
	}

	$image = @imagecreatefrompng($temp_file_name);
	if (!$image) {
		echo "invalid image";
		exit();
	}

	$image = @imagescale($image, width: 250, height: 250);
	if (!$image) {
		header("Location: " . MY_PROFILE);
		exit();
	}

	$old_file_name = get_profile_picture_path($username);
	if (is_null($old_file_name)) {
		header("Location: " . MY_PROFILE);
		syslog(LOG_ERR, "ERROR: Old profile picture name is null");
		exit();
	}

	# create new file name
	$new_file_name = bin2hex(random_bytes(12)) . ".png";
	if (
		!update_user_profile($username, "profile_picture_path", $new_file_name) ||
		!imagepng($image, join(DIRECTORY_SEPARATOR, [UPLOAD_DIR, $new_file_name]))
	) {
		header("Location: " . MY_PROFILE);
		exit();
	}

	# delete the old file
	if (strcmp($old_file_name, "default-user-icon.png") != 0) {
		$status = unlink(join(DIRECTORY_SEPARATOR, [UPLOAD_DIR, $old_file_name]));
		$status = $status ? "SUCCESSFUL" : "FAILED";
		syslog(LOG_INFO, "WARN: old profile picture delete status: $status");
	}

	header("Location: " . MY_PROFILE);
}
