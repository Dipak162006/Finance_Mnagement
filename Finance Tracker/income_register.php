<?php include "db.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $income_date = $_POST['income_date'];
    $party_name = $_POST['party_name'];
    $payment_mode = $_POST['payment_mode'];
    $payment_reason = $_POST['payment_reason'];
    $remarks = $_POST['remarks'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO income (username, income_date, party_name, payment_mode, payment_reason, remarks, amount)
            VALUES ('$username', '$income_date', '$party_name', '$payment_mode', '$payment_reason', '$remarks', '$amount')";
    mysqli_query($conn, $sql);
    $msg = "Income added successfully.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Income Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2>Add Income</h2>
        <?php if (!empty($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
        <form method="POST" class="form-box">
            <label>Date:</label>
            <input type="date" name="income_date" required>

            <label>Party Name:</label>
            <input type="text" name="party_name" required>

            <label>Payment Mode:</label>
            <input type="text" name="payment_mode" required>

            <label>Payment Reason:</label>
            <input type="text" name="payment_reason" required>

            <label>Remarks:</label>
            <textarea name="remarks"></textarea>

            <label>Amount:</label>
            <input type="number" name="amount" required>

            <input type="submit" value="Add Income">
        </form>
    </div>
</body>
</html>
