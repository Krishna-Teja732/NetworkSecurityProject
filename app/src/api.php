<?php

declare(strict_types=1);

include_once __DIR__ . "/utils/db-utils.php";

function handle_login(): void
{
	if (!isset($_POST['username']) || !isset($_POST['password'])) {
		header("Location: " . LOGIN);
		exit();
	}
	#TODO: validate input fields
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
	setcookie("session", $cookie_value, path: '/');
	exit();
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
function handle_update_profile_picture(): bool
{
	if (!isset($_FILES['profile-picture']['tmp_name']) || $_FILES['profile-picture']['error'] != 0) {
		echo "File is empty/unsupported";
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
		echo "invalid image";
		exit();
	}

	$image = @imagecreatefrompng($temp_file_name);
	if (!$image) {
		echo "invalid image";
		exit();
	}

	$image = @imagescale($image, width: 100, height: 100);
	if (!$image) {
		echo "invalid image";
		exit();
	}

	# create new file name
	$new_file_name = bin2hex(random_bytes(12)) . ".png";
	if (!imagepng($image, join(DIRECTORY_SEPARATOR, [UPLOAD_DIR, $new_file_name]))) {
		echo "invalid image";
	}
	return true;
}
