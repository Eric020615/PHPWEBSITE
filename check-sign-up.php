<!-- output -->
<?php
    // make sure the email field not empty
    if(empty($_POST["email"])){
        // exit() program
        die("Name is required");
    }
    // filter_var()
    if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
        die("Please type the correct email");
    }
    if(strlen($_POST["password"])<8){
        die("Password must be at least 8 characters");
    }
    // RegExp i Modifier means case-insensitive
    // compare password with the character a to z if found then correct
    if(!preg_match("/[a-z]/",$_POST["password"])){
        die("Password must contain at least one lowercase letter");
    }
    if(!preg_match("/[A-Z]/",$_POST["password"])){
        die("Password must contain at least one uppercase letter");
    }
    if(!preg_match("/[0-9]/i",$_POST["password"])){
        die("Password must contain at least one number");
    }
    $password_hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
    // import it and assign to this variable
    $mysqli = require __DIR__ . "/database.php";
    // ??? means we use placeholder
    $sql = "INSERT INTO users (email,phone_number,password_hash) 
    VALUES (?,?,?)";
    $stmt = $mysqli -> stmt_init();
    if(!$stmt -> prepare($sql)){
        die("SQL error: ".$mysqli->error);
    };
    $stmt -> bind_param("sss",
                        $_POST["email"],
                        $_POST["phone_num"],
                        $password_hash,);
    if($stmt -> execute()){
        // redirect to render sign-up-success html
        header("Location: sign-up-success.html");
        exit;
    }
    else{
        if($mysqli->errno===1062){
            die("email already taken");
        }
        else{
            // use $mysqli object find "error" properties
            die($mysqli->error . "". $mysqli -> errno);
        }
    }

    // echo "Sign Up Successful!";
    // // superglobal variable
    // print_r($_POST);
    // // to view the details of password_hash
    // var_dump($password_hash);
?>
