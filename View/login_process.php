<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "book";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$admin_id = $_POST["admin_id"];
$password = $_POST["password"];

$sql = "SELECT * FROM `table` WHERE admin_id='$admin_id'";
$result = $conn->query($sql);

if ($result && $result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        $_SESSION["admin_id"] = $admin_id;
        header("Location: search.php");
        exit();
    } else {
        echo "Invalid credentials.";
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
