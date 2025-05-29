<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="sam.css">
</head>
<body>
    <div class="registration-form">
        <h2>Admin Login</h2>
        <form action="login_process.php" method="POST">
            <input type="text" name="admin_id" placeholder="Admin ID" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
