<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $con = new mysqli("localhost", "root", "", "regis");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            // Use password_verify if password is hashed
            if ($data['password'] === $password) {
                echo "<h2>Login successful</h2>";
            } else {
                echo "<h2>Invalid password</h2>";
            }
        } else {
            echo "<h2>No user found with that email</h2>";
        }

        $stmt->close();
        $con->close();
    }
}
?>
