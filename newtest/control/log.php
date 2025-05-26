<?php

$username = $password = "";
$usernameErr = $passwordErr = "";
$loginSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = htmlspecialchars($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        $loginSuccess = "Login successful! (This is a demo)";
    }
}


include "login.php";
?>
