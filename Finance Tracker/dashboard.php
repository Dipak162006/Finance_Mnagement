<?php
include "db.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch totals
$username = $_SESSION['username'];
$income_result = mysqli_query($conn, "SELECT SUM(amount) AS total_income FROM income WHERE username='$username'");
$expense_result = mysqli_query($conn, "SELECT SUM(amount) AS total_expense FROM expenses WHERE username='$username'");

$income_total = mysqli_fetch_assoc($income_result)['total_income'] ?? 0;
$expense_total = mysqli_fetch_assoc($expense_result)['total_expense'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h2>Welcome, <?= $_SESSION['username'] ?>!</h2>
        <p>Use the navigation menu above to manage your finances.</p>

        <div class="chart-container">
            <canvas id="financeChart"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('financeChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Income', 'Expense'],
                datasets: [{
                    data: [<?= $income_total ?>, <?= $expense_total ?>],
                    backgroundColor: ['#2ecc71', '#e74c3c'],
                    borderColor: ['#27ae60', '#c0392b'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Income vs Expense'
                    }
                }
            }
        });
    </script>
</body>
</html>
