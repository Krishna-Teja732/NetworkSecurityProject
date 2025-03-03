<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home page</title>
	<script src="/public/scripts/jquery-3.7.1.slim.min.js"></script>
	<link href="public/css/bootstrap.min.css" rel="stylesheet">
	<script src="public/scripts/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Website</a>
		<div class="" id="navbarNav" style="list-style-type: none;">
			<ul class="navbar-nav" style="list-style-type:none;">
				<li class="nav-item active p4">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item p4">
					<a class="nav-link" href="#">Features</a>
				</li>
				<li class="nav-item p4">
					<a class="nav-link" href="#">Pricing</a>
				</li>
				<li class="nav-item p4">
					<form method="post" action="/api/logout-handler">
						<input type="submit" value="Logout">
					</form>
				</li>
			</ul>
		</div>
	</nav>

	<div>
	</div>

</body>

</html>
