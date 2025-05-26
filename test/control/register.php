<?php
// Initialize variables
$nameError = $emailError = $passwordError = $repassError = "";
$username = $email = $password = $repassword = "";

// Only validate on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];

    // Username validation
    if (empty($username)) {
        $nameError = "Name is required";
    }

    // Email validation
    if (empty($email)) {
        $emailError = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
    }

    // Password validation
    if (empty($password)) {
        $passwordError = "Password is required";
    }

    // Re-password validation
    if (empty($repassword)) {
        $repassError = "Please retype your password";
    } elseif ($password !== $repassword) {
        $repassError = "Passwords do not match";
    }

    // Redirect on success
    if (empty($nameError) && empty($emailError) && empty($passwordError) && empty($repassError)) {
        // Save to DB or perform other actions here

        header("Location: success.html");
        exit();
    }
}

// Show form with errors
include '../view/reg.php';
?>
