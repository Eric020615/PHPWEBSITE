<?php
$host = "localhost";
$dbname = "login_db";
// name of the user == root account
$username = "root";
$password = "";
$mysqli = new mysqli(hostname:$host,
                    username:$username,
                    password:$password,
                    database:$dbname);

// proporties of mysqli object
// no error, connect_errno == 0
if($mysqli -> connect_errno){
    die("connection error".$mysqli -> connect_error);
}
// export object
return $mysqli;
?>