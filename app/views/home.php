<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-card {
            background-color: #d1d1d1;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
        }

        .profile-card .profile-pic {
            width: 80px;
            height: 80px;
            background-color: black;
            border-radius: 50%;
        }

        .profile-details {
            margin-left: 20px;
            font-family: 'Georgia', serif;
        }

        .transactions-card {
            background-color: #d1d1d1;
            border-radius: 15px;
            margin-top: 20px;
            padding: 15px;
        }

        .transactions-card h5 {
            text-align: center;
            font-family: 'Georgia', serif;
        }

        .transaction-item {
            background-color: white;
            border-radius: 10px;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .transaction-item span {
            font-family: 'Georgia', serif;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="navbar-container">
        <?php require __DIR__ . '/navbar.php'; ?>
    </div>

    <!-- Profile Card -->
    <div class="container mt-3">
        <div class="profile-card">
            <img class="profile-pic" src=<?php echo $data["profile_picture_path"] ?>>
            <div class="profile-details">
                <div><?php echo $data["username"] ?></div>
                <div> Balance: <?php echo $data["balance"] ?></div>
            </div>
        </div>
    </div>

    <!-- Transactions History -->
    <div class="container mt-3">
        <div class="transactions-card">
            <h5>TRANSACTIONS HISTORY</h5>
            <div class="transaction-item">
                <span>Date</span>
                <span>Username</span>
                <span>Message</span>
                <span>Amount</span>
            </div>
            <?php foreach ($data["transactions"] as $transaction) { ?>
                <div class="transaction-item">
                    <span><?php echo $transaction["transaction_time"] ?></span>
                    <span><?php echo $transaction["username"] ?></span>
                    <span><?php echo $transaction["transaction_remark"] ?></span>
                    <span><?php echo $transaction["amount"] ?></span>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>
