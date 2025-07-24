<div class="header">
    <h1>Finance Tracker</h1>
   
<?php if (!isset($_SESSION['username'])): ?>
    <div class="nav-links">
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['username'])): ?>
    <div class="nav-links">
      <a href="dashboard.php">Dashboard</a>
    <a href="income_register.php">Add Income</a>
    <a href="expense_register.php">Add Expense</a>
    <a href="view_income.php">View Income</a>
    <a href="view_expenses.php">View Expenses</a>
    <a href="report.php">Report</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
    </div>
<?php endif; ?>


</div>
