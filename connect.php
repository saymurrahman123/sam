<?php
$conn = new mysqli('localhost', 'root', '', 'book');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $conn->real_escape_string($_POST['admin_id']);
    $admin_name = $conn->real_escape_string($_POST['admin_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $book_title = $conn->real_escape_string($_POST['book_title']);
    $author = $conn->real_escape_string($_POST['author']);
    $genre = $conn->real_escape_string($_POST['genre']);
    $isbn = $conn->real_escape_string($_POST['isbn']);
    $published_date = $conn->real_escape_string($_POST['published_date']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if(isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == 0) {
        $pdf_name = basename($_FILES['pdf_file']['name']);
        $pdf_tmp = $_FILES['pdf_file']['tmp_name'];
        $upload_dir = 'uploads/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $pdf_path = $upload_dir . $pdf_name;

        if(move_uploaded_file($pdf_tmp, $pdf_path)) {
            $stmt = $conn->prepare("INSERT INTO info(admin_id, admin_name, email, phone, book_title, author, genre, isbn, published_date, password, pdf_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss", $admin_id, $admin_name, $email, $phone, $book_title, $author, $genre, $isbn, $published_date, $password, $pdf_name);
            if ($stmt->execute()) {
                header("Location: submitted.html");
                exit;
            } else {
                echo "Database Insert Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Failed to upload PDF file.";
        }
    } else {
        echo "No PDF file uploaded or upload error.";
    }

    $conn->close();
} else {
    header("Location: index.php");
    exit;
}
?>