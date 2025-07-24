<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Expense Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_SESSION['username'])) include "header.php"; ?>

    <div class="container">
        <h2 style=" text-align:center ;">Login</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST" class="form-box">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Login"><br>
            <p>Don't have an account? <a href="register.php">Register here</a></p>

        </form>
    </div>
</body>
</html>
