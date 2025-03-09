<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bank Signup Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        .outer-box {
            width: 500px;
            /* Increased width */
            height: 600px;
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
            /* Keep inner form exactly the same */
            text-align: center;
            position: relative;
        }

        .top-section {
            position: relative;
            top: -30px;
            /* Keeps the image & bank name shifted upwards */
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
            /* Space between image and fields */
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
                <form method="post" action="/api/signup-handler">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm-password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">SIGNUP</button>
                    </div>
                </form>
                <div class="register-text">
                    Already have an account? <a href="/login">Login</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
