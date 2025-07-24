<?php
include "db.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $expense_date = $_POST['expense_date'];
    $party_name = $_POST['party_name'];
    $payment_mode = $_POST['payment_mode'];
    $payment_reason = $_POST['payment_reason'];
    $remarks = $_POST['remarks'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO expenses (username, expense_date, party_name, payment_mode, payment_reason, remarks, amount)
            VALUES ('$username', '$expense_date', '$party_name', '$payment_mode', '$payment_reason', '$remarks', '$amount')";
    mysqli_query($conn, $sql);
    $msg = "Expense added successfully.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Expense Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2>Add Expense</h2>
        <?php if (!empty($msg)) echo "<p style='color: green;'>$msg</p>"; ?>
        <form method="POST" class="form-box">
            <label for="expense_date">Date:</label>
            <input type="date" name="expense_date" required>

            <label for="party_name">Party Name:</label>
            <input type="text" name="party_name" required>

            <label for="payment_mode">Payment Mode:</label>
            <input type="text" name="payment_mode" required>

            <label for="payment_reason">Payment Reason:</label>
            <input type="text" name="payment_reason" required>

            <label for="remarks">Remarks:</label>
            <textarea name="remarks"></textarea>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" required>

            <input type="submit" value="Add Expense">
        </form>
    </div>
</body>
</html>
