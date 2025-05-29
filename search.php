<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Search Your Book</title>
    <link rel="stylesheet" href="sam.css" />
</head>
<body>
    <div class="registration-form">
        <h2>Search Book Info</h2>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Enter Book Title or Author" />
            <button type="submit">Search</button>
        </form>
        <div>
            <?php
            if (isset($_GET['search'])) {
                $conn = new mysqli('localhost', 'root', '', 'book');
                if ($conn->connect_error) {
                    die("Connection Failed: " . $conn->connect_error);
                }

                $search = $conn->real_escape_string($_GET['search']);
                $sql = "SELECT book_title, author, pdf_file FROM info WHERE book_title LIKE '%$search%' OR author LIKE '%$search%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<p><strong>Title:</strong> " . htmlspecialchars($row['book_title']) . 
                             " | <strong>Author:</strong> " . htmlspecialchars($row['author']) . 
                             " | <a href='uploads/" . urlencode($row['pdf_file']) . "' target='_blank'>PDF</a></p>";
                    }
                } else {
                    echo "<p>No results found.</p>";
                }

                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>