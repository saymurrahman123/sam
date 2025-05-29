<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="sam.css" />
</head>
<body>
    <div class="registration-form">
        <h2>Admin Login</h2>
        <form action="login_process.php" method="POST" novalidate>
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
        <p><a href="index.php">Register here if you don't have an account</a></p>
    </div>
</body>
</html>