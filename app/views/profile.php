<?php include_once __DIR__ . "/../url-definitions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile Page</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar-container {
            width: 100%;
            background-color: white;
        }

        .profile-container {
            background-color: #d1d1d1;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 40%;
            margin-top: 20px;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            background-color: black;
            border-radius: 50%;
            margin: 0 auto 15px auto;
        }

        .profile-title {
            font-family: 'Georgia', serif;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .edit-btn {
            cursor: pointer;
            background: none;
            border: none;
            color: #555;
            padding: 0 10px;
        }

        .edit-btn:hover {
            color: black;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="navbar-container">
        <?php require 'navbar.php'; ?>
    </div>

    <div class="profile-container">
        <div class="profile-title">PROFILE</div>
        <img class="profile-pic" src=<?php echo $data["profile_picture_path"] ?>>
        <?php if ($data["is_owner"]) { ?>
            <div class="form-group">
                <form action="<?php echo PROFILE_PICTURE_UPDATE_HANDLER ?>" method="post" enctype="multipart/form-data">
                    <input type="file" class="form-control-file" name="profile-picture" required>
                    <input type="hidden" name="csrf-token" value="<?php echo $_SESSION['csrf-token']; ?>">
                    <input type="submit" class="form-control btn btn-danger" value="Update Profile Picture">
                </form>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" value="<?php echo $data["username"]; ?>" readonly>
            </div>

            <div class="form-group">
                <form action="<?php echo EMAIL_UPDATE_HANDLER ?>" method="post">
                    <label for="email">Email ID</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $data["email"]; ?>" required>
                    <input type="hidden" name="csrf-token" value="<?php echo $_SESSION['csrf-token']; ?>">
                    <input type="submit" class="form-control btn btn-danger" value="Update Email">
                </form>
            </div>

            <div class="form-group">
                <form action="<?php echo DESCRIPTION_UPDATE_HANDLER ?>" method="post">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?php echo $data["description"]; ?>" required>
                    <input type="hidden" name="csrf-token" value="<?php echo $_SESSION['csrf-token']; ?>">
                    <input type="submit" class="form-control btn btn-danger" value="Update Description">
                </form>
            </div>
        <?php } else { ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control form-control-plaintext" id="username" value="<?php echo $data["username"]; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="email">Email ID</label>
                <input type="email" class="form-control form-control-plaintext" id="email" value="<?php echo $data["email"]; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control form-control-plaintext" id="description" value="<?php echo $data["description"]; ?>" readonly>
            </div>
        <?php } ?>

        <?php
        if (isset($_SESSION["update-success"])) {
            $status = $_SESSION["update-success"];
            unset($_SESSION["update-success"]);
        ?>
            <button class="form-control btn btn-success mt-3 mb-3" disabled="true">
                <?php echo $status; ?>
            </button>
        <?php
        }
        ?>

        <?php
        if (isset($_SESSION["update-error"])) {
            $error = $_SESSION["update-error"];
            unset($_SESSION["udpate-error"]);
        ?>
            <button class="form-control btn btn-danger mb-3 mt-3" disabled="true">
                <?php echo $error ?>
            </button>
        <?php
        }
        ?>


</body>

</html>
