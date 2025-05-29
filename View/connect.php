<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "book";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST["admin_id"];
    $admin_name = $_POST["admin_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $book_title = $_POST["book_title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $isbn = $_POST["isbn"];
    $published_date = $_POST["published_date"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // PDF upload
    $pdf_file = $_FILES["pdf_file"]["name"];
    $pdf_tmp = $_FILES["pdf_file"]["tmp_name"];
    $pdf_dest = "uploads/" . $pdf_file;

    if (move_uploaded_file($pdf_tmp, $pdf_dest)) {
        $sql = "INSERT INTO `table` (admin_id, admin_name, email, phone, book_title, author, genre, isbn, published_date, password, pdf_file)
                VALUES ('$admin_id', '$admin_name', '$email', '$phone', '$book_title', '$author', '$genre', '$isbn', '$published_date', '$password', '$pdf_file')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload PDF.";
    }
}
$conn->close();
?>
