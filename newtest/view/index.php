

<?php

if(isset($_SESSION['email'])){ ?>


<a href="logout.php" >Logout</a>
<?php
} ?>







<!DOCTYPE html>
<html>
<head>
    <title>Submitted</title>
    <style>
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 15px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <!-- Logout Button -->
    <form method="post" action="login.php">
        <button type="submit" class="logout-btn">Logout</button>
    </form>

    <!-- Login Success Message -->
    <h2 style="text-align: center; color: green; margin-top: 100px;">Logged in</h2>
</body>
</html>
