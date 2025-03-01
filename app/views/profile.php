<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<script src="/public/scripts/jquery-3.7.1.slim.min.js"></script>
	<link href="/public/css/bootstrap.min.css" rel="stylesheet">
	<script src="/public/scripts/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Website</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav" style="list-style-type: none;">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Features</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Pricing</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
			</ul>
		</div>
	</nav>

	<div>
		<img src=<?php echo $data['profile_picture_path'] ?>>
		<form method="post" action="/api/update-profile-picture" enctype="multipart/form-data">
			<input name="profile-picture" type="file" required>
			<input type="submit">
		</form>
		<p>Username: <?php echo $data['username'] ?></p>
		<p>Email: <?php echo $data['email'] ?></p>
		<p>Description: <?php echo $data['description'] ?></p>
	</div>

</body>

</html>
