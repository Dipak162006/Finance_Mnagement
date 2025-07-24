<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username already taken.";
    } else {
        $sql = "INSERT INTO users (username, password, email, full_name, phone)
                VALUES ('$username', '$password', '$email', '$full_name', '$phone')";
        mysqli_query($conn, $sql);
        $success = "Registered successfully. You can now log in.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2>Register</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
        <form method="POST" class="form-box">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phone" placeholder="Phone Number">
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
