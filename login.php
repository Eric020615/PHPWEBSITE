<?php
    $is_invalid = false;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // import database php class and assign to mysqli
        $mysqli = require __DIR__ . "/database.php";
        // sprintf() placing the placeholder in the form into the string
        $sql = sprintf("SELECT * FROM users where email = '%s'", $mysqli->real_escape_string($_POST["email"]));
        // call query method in mysqli object
        // return the result
        $result = $mysqli -> query($sql);
        // return the record in associated array
        $user = $result->fetch_assoc();
        // var dump to print the properties of the variable
        // var_dump($user);
        // exit;
        if($user){
            if(password_verify($_POST["password"],$user["password_hash"])){
                // print msg and end the script
                // die("login successful");
                session_start();
                // when we start session and load login page and the session may be started alr
                session_regenerate_id();
                // store user id in the superglobal variable in the associated array form
                // Array()
                // Array([user_id]=>8)
                $_SESSION["user_id"] = $user["id"];
                header("Location: index.php");
                exit;
            }
        }
        $is_invalid = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="shortcut icon" href="Assests/img/title_logo.png" class="icon" sizes="192pxx192px">
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous"
  />
</head>
<body>
    <div class="lottie-background">
        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_bq485nmk.json" mode="bounce" background="transparent"  speed="1.5"  style="width: 100%; height: 100%;"  loop  autoplay></lottie-player>
    </div>
    <div class="sign-in">
        <div class="content">
            <h1 class="title">TickTockTasks</h1>
            <p>Hey, Welcome Back To<br>TickTokTasks</p>
            <form method="POST" id="sign-in-form">
                <?php if($is_invalid):?>
                        <em>Invalid Login</em>
                    <?php endif;?>
                <input type="email" class="user-input" name="email" placeholder="Email Address" value="<?= htmlspecialchars($_POST["email"] ?? "")?>">
                <div class="email-error">
                    <?php if($is_invalid):?>
                        <em>Invalid Login</em>
                    <?php endif;?>
                </div>
               
                <input type="password" class="user-input" name="password" id="password" placeholder="Password">
                <div class="password-error">
                    <?php if($is_invalid):?>
                        <em>Invalid Login</em>
                    <?php endif;?>
                </div>
                <a href="/forgot-password" id="forgot-password">Forgot your password?</a>
                <button class="sign-in-button" type="submit">Sign In</button>
            </form>
            <hr>
            <p class="small-text">Don't have an account? <a href="/signup">Request Now</a></p>
        </div>
    </div>

    <div class="footer">
        Copyright @ToDoList 2023 | Privacy Policy
    </div>
    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_x4nau02e.json" class="lottie" background="transparent"  speed="1"  style="width: 100%; height: 100%;"  loop  autoplay></lottie-player>
    <!-- JavaScript -->
    <script src="signup.css"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    
</body>
</html>