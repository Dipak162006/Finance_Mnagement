<?php
include "db.php";


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch income
$incomeResult = mysqli_query($conn, "SELECT SUM(amount) AS total_income FROM income WHERE username='$username'");
$income = mysqli_fetch_assoc($incomeResult)['total_income'] ?? 0;

// Fetch expense
$expenseResult = mysqli_query($conn, "SELECT SUM(amount) AS total_expense FROM expenses WHERE username='$username'");
$expense = mysqli_fetch_assoc($expenseResult)['total_expense'] ?? 0;

$balance = $income - $expense;
?>
<html>
    <head>
           <title>Report</title>
            <link rel="stylesheet" href="style.css">
    </head>
    <body>
       <?php 
            include "header.php";
        ?>
        <div class="container">
    <h2>Financial Report</h2>
    <table>
        <tr><th>Total Income</th><td>₹<?= number_format($income, 2) ?></td></tr>
        <tr><th>Total Expense</th><td>₹<?= number_format($expense, 2) ?></td></tr>
        <tr><th>Balance</th><td>₹<?= number_format($balance, 2) ?></td></tr>
    </table>
</div>

    </body>
</html>
