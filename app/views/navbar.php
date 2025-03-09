<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .navbar-custom {
            background-color: #f8f9fa;
            /* Light grey background */
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 30px;
        }

        .circle {
            border-radius: 50%;
        }

        .logo {
            width: 60px;
            /* Bigger for logo */
            height: 60px;
            background-color: red;
        }

        .profile-image {
            width: 40px;
            /* Smaller for user profile */
            height: 40px;
            background-color: black;
        }

        .nav-center {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
        }

        .nav-center a {
            text-decoration: none;
            color: black;
            margin: 0 15px;
            padding: 5px 10px;
            transition: background-color 0.3s ease;
            font-family: 'Georgia', serif;
            font-weight: normal;
            /* No bold */
            font-size: 18px;
        }

        .nav-center a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            /* Light hover effect */
            border-radius: 5px;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .bank-name {
            margin-left: 10px;
            font-family: 'Georgia', serif;
            font-size: 18px;
            font-weight: normal;
            /* Not bold */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-custom">
        <div class="logo-container">
            <div class="circle logo"></div>
            <span class="bank-name">BANK NAME</span>
        </div>
        <div class="nav-center">
            <a href="/home" class="nav-active">Home</a>
            <a href="/transfer_money">Transfer Money</a>
            <a href="/profile">Profile</a>
            <a href="/api/logout-handler">Logout</a>
        </div>
    </nav>

</body>

</html>
