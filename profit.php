<?php
include 'dbconfig.php';

$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';

// Initialize variables
$total_income = 0;
$total_expenses = 0;
$total_purchases = 0;

if ($from_date && $to_date) {
    // Calculate total income
    $sql_income = "SELECT SUM(amount_received) as total_income FROM income WHERE DATE(received_date) BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql_income);
    $stmt->bind_param("ss", $from_date, $to_date);
    $stmt->execute();
    $stmt->bind_result($total_income);
    $stmt->fetch();
    $stmt->close();

    // Calculate total expenses
    $sql_expenses = "SELECT SUM(amount) as total_expenses FROM expenses WHERE DATE(expenses_date) BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql_expenses);
    $stmt->bind_param("ss", $from_date, $to_date);
    $stmt->execute();
    $stmt->bind_result($total_expenses);
    $stmt->fetch();
    $stmt->close();

    // Calculate total purchases
    $sql_purchases = "SELECT SUM(grand_total) as total_purchases FROM purchase_bills WHERE DATE(purchase_date) BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql_purchases);
    $stmt->bind_param("ss", $from_date, $to_date);
    $stmt->execute();
    $stmt->bind_result($total_purchases);
    $stmt->fetch();
    $stmt->close();
}

// Calculate profit or loss
$profit_or_loss = $total_income - ($total_expenses + $total_purchases);
$profit_or_loss_status = $profit_or_loss >= 0 ? "Profit" : "Loss";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit and Loss</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .form-container form {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container form label {
            margin-right: 10px;
            font-weight: bold;
        }
        .form-container form input[type="date"] {
            padding: 5px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container form input[type="submit"] {
            padding: 5px 15px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .form-container form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .details {
            font-size: 18px;
            line-height: 2;
            text-align: center;
        }
        .highlight {
            font-weight: bold;
            color: <?php echo $profit_or_loss >= 0 ? '#28a745' : '#dc3545'; ?>;
        }
    </style>
</head>
<body>

<h1>Profit and Loss Statement</h1>

<div class="form-container">
    <form method="get" action="">
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>" required>
        <label for="to_date">To Date:</label>
        <input type="date" id="to_date" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>" required>
        <input type="submit" value="Submit">
    </form>
</div>

<div class="container">
    <div class="details">
        <?php if ($from_date && $to_date): ?>
            <p><strong>Total Income:</strong> <?php echo number_format($total_income, 2); ?></p>
            <p><strong>Total Expenses:</strong> <?php echo number_format($total_expenses, 2); ?></p>
            <p><strong>Total Purchases:</strong> <?php echo number_format($total_purchases, 2); ?></p>
            <p><strong><?php echo $profit_or_loss_status; ?>:</strong> <span class="highlight"><?php echo number_format($profit_or_loss, 2); ?></span></p>
        <?php else: ?>
            <p>Please select a date range to view the profit and loss statement.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>