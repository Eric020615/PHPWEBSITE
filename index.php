<?php
    // function to start the session
    session_start();
    // print_r($_SESSION);
    if(isset($_SESSION["user_id"])){
        $mysqli = require __DIR__ . "/database.php";
        $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
        // now $result is in object form
        $result = $mysqli -> query($sql);
        // now $user is in associated array form
        $user = $result -> fetch_assoc();

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <!-- we check whether the user found -->
    <?php if(isset($user)):?>
        <!-- extract email field from the associated array -->
        <h1>
            <?= htmlspecialchars($user["email"]) ?>
        </h1>
        <p>You are logged in</p>
        <p><a href="logout.php">log out</a></p>
    <?php else:?>
        <p>No Cookies</p>
    <?php endif;?>
</body>
</html>