<?php
include 'dbconfig.php';

// Initialize variables
$total_income = 0;
$total_expenses = 0;
$profit_loss = 0;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Query to calculate total income within the selected date range
    $sql_income = "SELECT SUM(amount) AS total_income FROM income WHERE income_date BETWEEN '$start_date' AND '$end_date'";
    $result_income = $conn->query($sql_income);
    if ($result_income && $result_income->num_rows > 0) {
        $row_income = $result_income->fetch_assoc();
        $total_income = $row_income['total_income'];
    }

    // Query to calculate total expenses within the selected date range
    $sql_expenses = "SELECT SUM(amount) AS total_expenses FROM expenses WHERE expenses_date BETWEEN '$start_date' AND '$end_date'";
    $result_expenses = $conn->query($sql_expenses);
    if ($result_expenses && $result_expenses->num_rows > 0) {
        $row_expenses = $result_expenses->fetch_assoc();
        $total_expenses = $row_expenses['total_expenses'];
    }

    // Calculate profit or loss
    $profit_loss = $total_income - $total_expenses;
}

// Display the report
?>
<body>
    <h2 align="center">PROFIT OR LOSS REPORT</h2>
    <br><br>
    <h3 align="center">Report for <?php echo $start_date; ?> to <?php echo $end_date; ?></h3>
    <p align="center">Total Income: $<?php echo number_format($total_income, 2); ?></p><br>
    <p align="center">Total Expenses: $<?php echo number_format($total_expenses, 2); ?></p><br>
    <p align="center">Profit/Loss: $<?php echo number_format($profit_loss, 2); ?></p>
</body>
