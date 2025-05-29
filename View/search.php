<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Search Your Book</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        /* General body and container */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f8fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header-bar {
            background-color: #007BFF;
            padding: 12px 30px;
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }
        .header-bar a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 8px;
            background-color: #0056b3;
            transition: background-color 0.3s;
        }
        .header-bar a:hover {
            background-color: #003d80;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto 60px;
            background: white;
            padding: 40px 50px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            text-align: center;
            color: #222;
            margin-bottom: 25px;
            font-weight: 700;
        }

        /* Search form styling */
        .search-form {
            text-align: center;
            margin-bottom: 40px;
        }
        .search-form input[type="text"] {
            width: 70%;
            max-width: 500px;
            padding: 14px 18px;
            border: 2px solid #007BFF;
            border-radius: 30px;
            font-size: 17px;
            transition: border-color 0.3s;
            box-shadow: inset 0 2px 6px rgba(0,123,255,0.1);
        }
        .search-form input[type="text"]:focus {
            outline: none;
            border-color: #0056b3;
            box-shadow: 0 0 8px rgba(0,86,179,0.4);
        }
        .search-form input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 17px;
            margin-left: 15px;
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .search-form input[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 20px rgba(0,86,179,0.5);
        }

        /* Book result cards */
        .book {
            background-color: #e3f2fd;
            border-left: 6px solid #007BFF;
            padding: 22px 30px;
            border-radius: 15px;
            margin-bottom: 28px;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.12);
            transition: box-shadow 0.3s;
        }
        .book:hover {
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.2);
        }
        .book strong {
            color: #004085;
        }
        .book a {
            display: inline-block;
            margin-top: 10px;
            font-weight: 600;
            color: #0056b3;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }
        .book a:hover {
            color: #003d80;
            text-decoration: underline;
        }

        /* No results message */
        .no-results {
            text-align: center;
            color: #d9534f;
            font-size: 18px;
            font-weight: 600;
            margin-top: 30px;
        }

        /* Review Section */
        .review-section {
            margin-top: 50px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .review-section h2 {
            margin-bottom: 20px;
            color: #155724;
        }
        .review-section textarea {
            width: 100%;
            padding: 18px;
            font-size: 16px;
            border-radius: 12px;
            border: 1.8px solid #28a745;
            resize: vertical;
            box-shadow: inset 0 2px 8px rgba(40,167,69,0.15);
            transition: border-color 0.3s, box-shadow 0.3s;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 120px;
        }
        .review-section textarea:focus {
            outline: none;
            border-color: #19692c;
            box-shadow: 0 0 10px rgba(25,105,44,0.5);
        }
        .review-section button {
            margin-top: 15px;
            background-color: #28a745;
            color: white;
            padding: 14px 36px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            box-shadow: 0 6px 15px rgba(40,167,69,0.4);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .review-section button:hover {
            background-color: #19692c;
            box-shadow: 0 8px 25px rgba(25,105,44,0.6);
        }
        .submitted-review {
            margin-top: 25px;
            background-color: #d4edda;
            color: #155724;
            padding: 18px 24px;
            border-radius: 15px;
            font-style: italic;
            box-shadow: 0 3px 12px rgba(40,167,69,0.35);
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="header-bar">
    <a href="logout.php">Logout</a>
    
</div>

<div class="container">
    <h2>Search Your Book</h2>
    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Enter book title or author" required />
        <input type="submit" value="Search" />
    </form>

    <?php
    $showReviewBox = false;

    if (isset($_GET['search'])) {
        $conn = new mysqli("localhost", "root", "", "book");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $search = $conn->real_escape_string($_GET['search']);
        $sql = "SELECT * FROM `table` WHERE book_title LIKE '%$search%' OR author LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $showReviewBox = true;
            echo "<h3>Search Results:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book'>";
                echo "<strong>Title:</strong> " . htmlspecialchars($row['book_title']) . "<br>";
                echo "<strong>Author:</strong> " . htmlspecialchars($row['author']) . "<br>";
                echo "<strong>Genre:</strong> " . htmlspecialchars($row['genre']) . "<br>";
                echo "<strong>ISBN:</strong> " . htmlspecialchars($row['isbn']) . "<br>";
                echo "<strong>Published Date:</strong> " . htmlspecialchars($row['published_date']) . "<br>";
                if (!empty($row['description'])) {
                    echo "<strong>Description:</strong> " . htmlspecialchars($row['description']) . "<br>";
                }
                if (!empty($row['pdf_file'])) {
                    echo "<a href='uploads/" . urlencode($row['pdf_file']) . "' target='_blank'>📄 Download PDF</a><br>";
                }
                echo "</div>";
            }
        } else {
            echo "<p class='no-results'>No books found.</p>";
        }
        $conn->close();
    }

    if ($showReviewBox) {
        ?>
        <div class="review-section">
            <h2>Leave a Review (Not Saved)</h2>
            <textarea id="reviewBox" name="reviewBox" rows="6" placeholder="Write your review here..."></textarea>
            <button id="submitReview" type="button">Submit Review</button>

            <div id="submittedReview" class="submitted-review" style="display:none;"></div>
        </div>

        <script>
            const reviewBox = document.getElementById('reviewBox');
            const submitReview = document.getElementById('submitReview');
            const submittedReview = document.getElementById('submittedReview');

            submitReview.addEventListener('click', () => {
                const reviewText = reviewBox.value.trim();
                if (reviewText === '') {
                    alert('Please write something before submitting.');
                    return;
                }
                submittedReview.style.display = 'block';
                submittedReview.textContent = reviewText;
                reviewBox.value = '';
                alert('Thank you for your feedback! (Note: Review not saved)');
            });
        </script>
        <?php
    }
    ?>

</div>

</body>
</html>
