<?php
$conn = new mysqli('localhost', 'root', '', 'book');

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hash);
    if ($stmt->fetch()) {
        if (password_verify($password, $hash)) {
            header("Location: search.php");
            exit;
        } else {
            echo "<h2 style='color:red; text-align:center;'>Incorrect password</h2>";
        }
    } else {
        echo "<h2 style='color:red; text-align:center;'>User not found</h2>";
    }
    $stmt->close();
}

$conn->close();
?>