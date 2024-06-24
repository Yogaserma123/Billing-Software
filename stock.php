<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Levels</title>
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
        h2 {
            text-align: center;
            color: #444;
            margin-top: 30px;
        }
        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 900px;
            margin: 20px auto;
        }
        form label {
            margin: 0 10px;
            font-weight: bold;
            color: #555;
        }
        form input[type="date"], form input[type="text"] {
            margin: 0 10px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        form input[type="submit"] {
            padding: 5px 15px;
            border: none;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        form input[type="submit"]:hover {
            background-color: #218838;
        }
        table {
            width: 90%;
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
        .grand-total {
            font-weight: bold;
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>
<body>

<h1>Stock Levels</h1>
<form method="get" action="">
    <label for="fromDate">From Date: </label>
    <input type="date" id="fromDate" name="fromDate" value="<?php echo isset($_GET['fromDate']) ? $_GET['fromDate'] : ''; ?>">
    <label for="toDate">To Date: </label>
    <input type="date" id="toDate" name="toDate" value="<?php echo isset($_GET['toDate']) ? $_GET['toDate'] : ''; ?>">
    <label for="description">Description: </label>
    <input type="text" id="description" name="description" value="<?php echo isset($_GET['description']) ? $_GET['description'] : ''; ?>">
    <input type="submit" value="Filter">
</form>

<?php
include 'dbconfig.php';

$fromDate = isset($_GET['fromDate']) ? $_GET['fromDate'] : '';
$toDate = isset($_GET['toDate']) ? $_GET['toDate'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';

if (!empty($description) && !empty($fromDate) && !empty($toDate)) {
    // Fetch purchases
    $purchaseSql = "SELECT purchase_bills.purchase_date, items.description, items.qty, items.unit, items.hsn_code, items.price, items.total_price 
                    FROM items 
                    JOIN purchase_bills ON items.purchase_bill_id = purchase_bills.id 
                    WHERE purchase_bills.purchase_date BETWEEN ? AND ? 
                    AND items.description = ?";
    $purchaseStmt = $conn->prepare($purchaseSql);
    $purchaseStmt->bind_param("sss", $fromDate, $toDate, $description);
    $purchaseStmt->execute();
    $purchaseResult = $purchaseStmt->get_result();

    // Fetch sales
    $salesSql = "SELECT invoices.invoice_date, invoice_items.description, invoice_items.qty, invoice_items.unit, invoice_items.hsn_code, invoice_items.unit_price, invoice_items.total_price 
                 FROM invoice_items 
                 JOIN invoices ON invoice_items.invoice_id = invoices.id 
                 WHERE invoices.invoice_date BETWEEN ? AND ? 
                 AND invoice_items.description = ?";
    $salesStmt = $conn->prepare($salesSql);
    $salesStmt->bind_param("sss", $fromDate, $toDate, $description);
    $salesStmt->execute();
    $salesResult = $salesStmt->get_result();

    // Calculate total purchased and total sold
    $totalPurchased = 0;
    $purchaseGrandTotal = 0;
    while ($purchaseData = $purchaseResult->fetch_assoc()) {
        $totalPurchased += $purchaseData['qty'];
        $purchaseGrandTotal += $purchaseData['total_price'];
    }

    $totalSold = 0;
    $salesGrandTotal = 0;
    while ($salesData = $salesResult->fetch_assoc()) {
        $totalSold += $salesData['qty'];
        $salesGrandTotal += $salesData['total_price'];
    }

    // Calculate balance
    $balance = $totalPurchased - $totalSold;

    // Display purchase details
    echo "<h2>Purchase Details for '$description' from $fromDate to $toDate</h2>";
    echo "<table>
    <tr>
    <th>Sl.no</th>
    <th>Description</th>
    <th>Qty</th>
    <th>Unit</th>
    <th>HSN Code</th>
    <th>Price</th>
    <th>Total Price</th>
    </tr>";

    $slNo = 1;
    $purchaseStmt->execute(); // Re-execute to fetch data again for display
    $purchaseResult = $purchaseStmt->get_result();
    while ($purchaseData = $purchaseResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $slNo++ . "</td>";
        echo "<td>" . $purchaseData['description'] . "</td>";
        echo "<td>" . $purchaseData['qty'] . "</td>";
        echo "<td>" . $purchaseData['unit'] . "</td>";
        echo "<td>" . $purchaseData['hsn_code'] . "</td>";
        echo "<td>" . $purchaseData['price'] . "</td>";
        echo "<td>" . $purchaseData['total_price'] . "</td>";
        echo "</tr>";
    }
    echo "<tr class='grand-total'>
            <td colspan='6'>Grand Total</td>
            <td>" . number_format($purchaseGrandTotal, 2) . "</td>
          </tr>";
    echo "</table>";

    // Display sales details
    echo "<h2>Sales Details for '$description' from $fromDate to $toDate</h2>";
    echo "<table>
    <tr>
    <th>Sl.no</th>
    <th>Description</th>
    <th>Qty</th>
    <th>Unit</th>
    <th>HSN Code</th>
    <th>Unit Price</th>
    <th>Total Price</th>
    </tr>";

    $slNo = 1;
    $salesStmt->execute(); // Re-execute to fetch data again for display
    $salesResult = $salesStmt->get_result();
    while ($salesData = $salesResult->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $slNo++ . "</td>";
        echo "<td>" . $salesData['description'] . "</td>";
        echo "<td>" . $salesData['qty'] . "</td>";
        echo "<td>" . $salesData['unit'] . "</td>";
        echo "<td>" . $salesData['hsn_code'] . "</td>";
        echo "<td>" . $salesData['unit_price'] . "</td>";
        echo "<td>" . $salesData['total_price'] . "</td>";
        echo "</tr>";
    }
    echo "<tr class='grand-total'>
            <td colspan='6'>Grand Total</td>
            <td>" . number_format($salesGrandTotal, 2) . "</td>
          </tr>";
    echo "</table>";

    // Display balance
    echo "<h2>Balance</h2>";
    echo "<table>
    <tr>
    <th>Description</th>
    <th>Total Purchased</th>
    <th>Total Sold</th>
    <th>Balance</th>
    </tr>";
    echo "<tr>";
    echo "<td>" . $description . "</td>";
    echo "<td>" . $totalPurchased . "</td>";
    echo "<td>" . $totalSold . "</td>";
    echo "<td>" . $balance . "</td>";
    echo "</tr>";
    echo "</table>";

    $purchaseStmt->close();
    $salesStmt->close();
}

$conn->close();
?>
</body>
</html>