<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['bookId'] ?? '';
    $review = $_POST['review'] ?? '';

    if ($bookId !== '') {
        if (!isset($_SESSION['reviews'])) {
            $_SESSION['reviews'] = [];
        }
        $_SESSION['reviews'][$bookId] = $review;
        echo "Review saved";
    } else {
        http_response_code(400);
        echo "Invalid data";
    }
} else {
    http_response_code(405);
    echo "Method not allowed";
}
?>
