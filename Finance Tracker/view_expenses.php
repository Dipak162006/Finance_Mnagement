<?php
include "db.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$search_party = $search_mode = $from_date = $to_date = "";
$total = 0;

$query = "SELECT * FROM expenses WHERE username='$username'";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_party = $_POST['party_name'];
    $search_mode = $_POST['payment_mode'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    if (!empty($search_party)) {
        $query .= " AND party_name LIKE '%$search_party%'";
    }
    if (!empty($search_mode)) {
        $query .= " AND payment_mode LIKE '%$search_mode%'";
    }
    if (!empty($from_date) && !empty($to_date)) {
        $query .= " AND expense_date BETWEEN '$from_date' AND '$to_date'";
    }

    $query .= " ORDER BY expense_date DESC";
} else {
    $query .= " ORDER BY expense_date DESC";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Expenses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
<div class="container">
    <h2>Expense List</h2>

    <form method="POST" class="form-box">
        <input type="text" name="party_name" placeholder="Party Name" value="<?= $search_party ?>">
        <input type="text" name="payment_mode" placeholder="Payment Mode" value="<?= $search_mode ?>">
        <input type="date" name="from_date" value="<?= $from_date ?>">
        <input type="date" name="to_date" value="<?= $to_date ?>">
        <input type="submit" value="Search">
    </form>

    <table>
        <tr>
            <th>Date</th>
            <th>Party Name</th>
            <th>Payment Mode</th>
            <th>Payment Reason</th>
            <th>Remarks</th>
            <th>Amount (₹)</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) {
            $total += $row['amount']; ?>
            <tr>
                <td><?= $row['expense_date'] ?></td>
                <td><?= $row['party_name'] ?></td>
                <td><?= $row['payment_mode'] ?></td>
                <td><?= $row['payment_reason'] ?></td>
                <td><?= $row['remarks'] ?></td>
                <td><?= number_format($row['amount'], 2) ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="5"><strong>Total</strong></td>
            <td><strong>₹<?= number_format($total, 2) ?></strong></td>
        </tr>
    </table>

    <br><a href="dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
