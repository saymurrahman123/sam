<?php
// PHP validation logic


$email = $password = "";
$usernameErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $usernameErr = "Username is required";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        echo "<p style='color: green; text-align:center;'>Login successful</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <style>
        body {
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .login-box {
            background: white;
            width: 300px;
            margin: 100px auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background: #45a049;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form  action="logintest.php" method = "post">
        <div class="input-group">
            <label for="email">Username:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" name="password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
