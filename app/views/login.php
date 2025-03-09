<?php
if (isset($_COOKIE["signup_success"])) {
    $cookie_value = $_COOKIE["signup_success"];
    // Display the message using a simple HTML alert box
    echo htmlspecialchars("Signup successful for username: " . $cookie_value, ENT_QUOTES);
    setcookie("signup_success", "", time() - 3600, path: '/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bank Login Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        .outer-box {
            width: 400px;
            /* Increased width */
            height: 520px;
            /* Increased height */
            background-color: #ddd;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .inner-form {
            width: 280px;
            /* Keep inner form same width */
            text-align: center;
            position: relative;
        }

        .top-section {
            position: relative;
            top: -30px;
            /* Keeping the bank name & image shifted upwards */
        }

        h3 {
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .image-placeholder {
            width: 80px;
            height: 80px;
            background-color: red;
            border-radius: 50%;
            margin: 10px auto 20px auto;
            /* Space between image and username field */
        }

        .form-control {
            background-color: #f2f2f2;
            border: none;
            height: 40px;
            border-radius: 5px;
        }

        .form-control::placeholder {
            color: #c0c0c0;
            font-weight: 500;
        }

        .btn-custom {
            background-color: white;
            color: black;
            border: 1px solid #ccc;
            border-radius: 25px;
            padding: 6px 25px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #f0f0f0;
        }

        .register-text {
            margin-top: 15px;
            font-size: 14px;
        }

        .register-text a {
            color: black;
            font-weight: bold;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="outer-box">
            <div class="inner-form">
                <div class="top-section">
                    <h3>BANK NAME</h3>
                    <div class="image-placeholder"></div>
                </div>
                <form method="post" action="/api/login-handler">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="username" name="username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="password" name="password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">LOGIN</button>
                    </div>
                </form>
                <div class="register-text">
                    Don’t have an account? <a href="/signup">Register</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>











<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container mt-3">
<h1>To enter our website please signup</h1>
    <form action="/api/signup-handler" method="post">
    <div class="form-group">
        <label for="name">username</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" name="pass" class="form-control" id="pass" aria-describedby="pass"> 
    </div>

    <div class="form-group">
        <label for="cpass">Confirm Password</label>
        <input type = "password" class="form-control" name="cpass" id="cpass" cols="30" rows="10"></input> 
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html> -->
