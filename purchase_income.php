<?php
include 'dbconfig.php';

// Handle form submission for amount paid and balance amount
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['invoice_id']) && isset($_POST['amount_paid']) && isset($_POST['payment_date'])) {
        $invoice_id = $_POST['invoice_id'];
        $amount_paid = $_POST['amount_paid'];
        $payment_date = $_POST['payment_date'];

        // Fetch the grand total for the purchase invoice
        $stmt = $conn->prepare("SELECT grand_total FROM purchase_bills WHERE id = ?");
        if (!$stmt) {
            die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $stmt->bind_result($grand_total);
        $stmt->fetch();
        $stmt->close();

        // Fetch the existing amount paid for the invoice
        $stmt = $conn->prepare("SELECT COALESCE(SUM(amount_paid), 0) as total_paid FROM payments WHERE invoice_id = ?");
        if (!$stmt) {
            die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $stmt->bind_result($total_paid);
        $stmt->fetch();
        $stmt->close();

        $new_total_paid = $total_paid + $amount_paid;
        $balance_amount = $grand_total - $new_total_paid;

        // Insert or update payments table
        $stmt = $conn->prepare("INSERT INTO payments (invoice_id, amount_paid, balance_amount, payment_date) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE amount_paid = amount_paid + ?, balance_amount = ?");
        if (!$stmt) {
            die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("iddsdd", $invoice_id, $amount_paid, $balance_amount, $payment_date, $amount_paid, $balance_amount);

        if ($stmt->execute()) {
            // Redirect to the details page
            header("Location: purchase_details.php?invoice_id=$invoice_id");
            exit();
        } else {
            echo "Error adding record: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch purchase records
$sql = "SELECT id, purchase_bill_no, supplier_invoice_no, purchase_date, party_name, party_address, grand_total FROM purchase_bills";
$result = $conn->query($sql);

// Fetch payment records
$payments_sql = "SELECT * FROM payments";
$payments_result = $conn->query($payments_sql);
$payments_data = [];
while ($payments_row = $payments_result->fetch_assoc()) {
    $payments_data[$payments_row['invoice_id']] = $payments_row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Entry Page</title>
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
        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            color: #333;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            display: inline-block;
        }
        input[type="number"], input[type="date"] {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="submit"], button {
            padding: 5px 10px;
            border: none;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #218838;
        }
        .button-view {
            background-color: #007bff;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            display: inline-block;
        }
        .button-view:hover {
            background-color: #0056b3;
        }
        .light {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .green-light {
            background-color: green;
        }
        .red-light {
            background-color: red;
        }
        .yellow-light {
            background-color: yellow;
        }
    </style>
</head>
<body>

<h1>Purchase Entry Page</h1>
<div style="text-align: center; margin-bottom: 20px;">
    <a href="settled_purchase_history.php" class="button-view">View Settled Purchases</a>
    <a href="unsettled_purchase_history.php" class="button-view">View Unsettled Purchases</a>
</div>
<table>
    <tr>
        <th>Purchase Bill No</th>
        <th>Supplier Invoice No</th>
        <th>Purchase Date</th>
        <th>Party Details</th>
        <th>Invoice Amount</th>
        <th>Amount Paid</th>
        <th>Date Paid</th>
        <th>Actions</th>
        <th>Status</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $invoice_id = $row['id'];
        $amount_paid = isset($payments_data[$invoice_id]) ? $payments_data[$invoice_id]['amount_paid'] : 0;
        $balance_amount = isset($payments_data[$invoice_id]) ? $payments_data[$invoice_id]['balance_amount'] : $row['grand_total'];
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['purchase_bill_no']) . "</td>";
        echo "<td>" . htmlspecialchars($row['supplier_invoice_no']) . "</td>";
        echo "<td>" . htmlspecialchars($row['purchase_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['party_name']) . "<br>" . htmlspecialchars($row['party_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['grand_total']) . "</td>";
        echo "<td>
                <form method='post' action=''>
                    <input type='hidden' name='invoice_id' value='" . htmlspecialchars($invoice_id) . "'>
                    <input type='number' name='amount_paid' min='0' step='0.01' placeholder='Amount Paid' required>
              </td>
              <td>
                    <input type='date' name='payment_date' required>
                    <input type='submit' value='Add'>
                </form>
              </td>";
        echo "<td>
                <a href='purchase_details.php?invoice_id=" . htmlspecialchars($invoice_id) . "' class='button-view'>View</a>
              </td>";
        echo "<td>";
        if ($amount_paid == 0) {
            echo "<span class='light yellow-light'></span>";
        } elseif ($balance_amount == 0) {
            echo "<span class='light green-light'></span>";
        } else {
            echo "<span class='light red-light'></span>";
        }
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>