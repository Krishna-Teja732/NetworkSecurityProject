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
	<form method="post" action="/api/create-user">
		<input name="username" id="username" type="text" placeholder="Username" class="form-control" required>
		<input name="password" id="password" type="password" placeholder="Password" class="form-control" required>
		<input name="confirm-password" id="confitm-password" type="password" placeholder="Confirm Passowrd" class="form-control" required>
		<input name="email" id="email" type="email" placeholder="Email" class="form-control" required>
		<input type="submit" class="btn btn-primary">
	</form>
</body>

</html>
