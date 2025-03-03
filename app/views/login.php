<?php
if (isset($_COOKIE["signup_success"])) {
    $cookie_value = $_COOKIE["signup_success"];
	// Display the message using a simple HTML alert box
    echo "<script>alert('" . htmlspecialchars("Signup successful for username: " . $cookie_value, ENT_QUOTES) . "');</script>";
	setcookie("signup_success", "", time() - 3600, path: '/');
}
?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page</title>
	<link href="/public/css/bootstrap.min.css" rel="stylesheet">
	<script src="/public/scripts/jquery-3.7.1.slim.min.js"></script>
	<script src="/public/scripts/bootstrap.min.js"></script>
</head>

<body>
	<form method="post" action="/api/login-handler">
		<input name="username" id="username" type="text" placeholder="Username" class="form-control" required>
		<input name="password" id="password" type="password" placeholder="Password" class="form-control" required>
		<input type="submit" class="btn btn-primary">
	</form>

	<button onclick="location.href='/signup';" class="btn btn-primary">Signup</button>
</body>

</html>
