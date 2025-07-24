<?php
include "db.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Update profile info
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    mysqli_query($conn, "UPDATE users SET full_name='$full_name', email='$email', phone='$phone' WHERE username='$username'");
    $msg = "Profile updated.";
}

// Change password logic
$success = $error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $result = mysqli_query($conn, "SELECT password FROM users WHERE username='$username'");
    $row = mysqli_fetch_assoc($result);

    if ($row['password'] !== $current) {
        $error = "Current password is incorrect.";
    } elseif ($new !== $confirm) {
        $error = "New password and confirm password do not match.";
    } else {
        mysqli_query($conn, "UPDATE users SET password='$new' WHERE username='$username'");
        $success = "Password changed successfully.";
    }
}

// Fetch user data
$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <h2>My Profile</h2>

    <?php if (!empty($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

    <form method="POST">
        <input type="hidden" name="update_profile">

        <label>Username:</label>
        <input type="text" value="<?= $user['username'] ?>" disabled><br><br>

        <label>Full Name:</label><br>
        <input type="text" name="full_name" value="<?= $user['full_name'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $user['email'] ?>" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?= $user['phone'] ?>" required><br><br>

        <input type="submit" value="Update Profile">
    </form>

    <hr><br>

    <h3>Change Password</h3>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST">
        <input type="hidden" name="change_password">
        <label>Current Password:</label><br>
        <input type="password" name="current_password" required><br><br>

        <label>New Password:</label><br>
        <input type="password" name="new_password" required><br><br>

        <label>Confirm New Password:</label><br>
        <input type="password" name="confirm_password" required><br><br>

        <input type="submit" value="Change Password">
    </form>

   
</div>
</body>
</html>
