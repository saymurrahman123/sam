<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Registration</title>
    <link rel="stylesheet" href="sam.css" />
    <script defer src="validation.js"></script>
</head>
<body>
    <div class="registration-form">
        <h2>Register as Admin</h2>
        <form action="connect.php" method="POST" enctype="multipart/form-data" novalidate>
            <input type="text" name="admin_id" placeholder="Admin ID" required />
            <input type="text" name="admin_name" placeholder="Admin Name" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="text" name="phone" placeholder="Phone" required />
            <input type="text" name="book_title" placeholder="Book Title" required />
            <input type="text" name="author" placeholder="Author" required />
            <input type="text" name="genre" placeholder="Genre" required />
            <input type="text" name="isbn" placeholder="ISBN" required />
            <input type="date" name="published_date" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="file" name="pdf_file" accept="application/pdf" required />
            <button type="submit">Register</button>
        </form>
        <p><a href="login.php">Already Registered? Login here</a></p>
    </div>
</body>
</html>