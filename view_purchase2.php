<?php
include 'dbconfig.php';

// Check if the purchase_bill_no is provided in the query string
if (isset($_GET['purchase_bill_no'])) {
    $purchaseBillNo = $_GET['purchase_bill_no'];

    // Prepare and execute the SQL query to fetch the purchase record
    $sql = "SELECT * FROM purchase_bills WHERE purchase_bill_no = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }
    $stmt->bind_param("s", $purchaseBillNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the purchase details
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Purchase</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        th, td {
            text-align: left;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .heading {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">Purchase Bill Details</h1>
        <p><strong>Purchase Bill No:</strong> <?php echo $row['purchase_bill_no']; ?></p>
        <p><strong>Supplier Invoice No:</strong> <?php echo $row['supplier_invoice_no']; ?></p>
        <p><strong>Purchase Date:</strong> <input type="date" value="<?php echo $row['purchase_date']; ?>" disabled></p>
        <p><strong>Party Name:</strong> <?php echo $row['party_name']; ?></p>
        <p><strong>Party Address:</strong> <?php echo $row['party_address']; ?></p>
        <p><strong>Party GST:</strong> <?php echo $row['party_gst']; ?></p>
        
        <h2>Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>HSN Code</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display purchase items
                $itemsSql = "SELECT * FROM items WHERE purchase_bill_id = ?";
                $itemsStmt = $conn->prepare($itemsSql);
                if (!$itemsStmt) {
                    echo "Error preparing statement: " . $conn->error;
                    exit;
                }
                $itemsStmt->bind_param("i", $row['id']);
                $itemsStmt->execute();
                $itemsResult = $itemsStmt->get_result();

                if ($itemsResult->num_rows > 0) {
                    $slNo = 1;
                    while ($itemRow = $itemsResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $slNo . "</td>";
                        echo "<td>" . $itemRow['description'] . "</td>";
                        echo "<td>" . $itemRow['qty'] . "</td>";
                        echo "<td>" . $itemRow['unit'] . "</td>";
                        echo "<td>" . $itemRow['hsn_code'] . "</td>";
                        echo "<td>" . $itemRow['price'] . "</td>";
                        echo "<td>" . $itemRow['total_price'] . "</td>";
                        echo "</tr>";
                        $slNo++;
                    }
                } else {
                    echo "<tr><td colspan='7'>No items found</td></tr>";
                }
                ?>
                <tr>
                    <td colspan="6" style="text-align: right;">Total Amount</td>
                    <td><?php echo $row['total_amount']; ?></td>
                </tr>
            </tbody>
        </table>

        <h2>Taxes</h2>
        <table>
            <thead>
                <tr>
                    <th>SGST %</th>
                    <th>Value</th>
                    <th>CGST %</th>
                    <th>Value</th>
                    <th>Total Value</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display taxes
                $taxesSql = "SELECT * FROM taxes WHERE purchase_bill_id = ?";
                $taxesStmt = $conn->prepare($taxesSql);
                if (!$taxesStmt) {
                    echo "Error preparing statement: " . $conn->error;
                    exit;
                }
                $taxesStmt->bind_param("i", $row['id']);
                $taxesStmt->execute();
                $taxesResult = $taxesStmt->get_result();

                if ($taxesResult->num_rows > 0) {
                    while ($taxRow = $taxesResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $taxRow['sgst'] . "</td>";
                        echo "<td>" . $taxRow['sgst_value'] . "</td>";
                        echo "<td>" . $taxRow['cgst'] . "</td>";
                        echo "<td>" . $taxRow['cgst_value'] . "</td>";
                        echo "<td>" . $taxRow['total_value'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No taxes found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <p><strong>Total Amount:</strong> <?php echo $row['total_amount']; ?></p>
        <p><strong>Total CGST:</strong> <?php echo $row['total_cgst']; ?></p>
        <p><strong>Total SGST:</strong> <?php echo $row['total_sgst']; ?></p>
        
        <p><strong>Grand Total:</strong> <?php echo $row['grand_total']; ?></p>
    </div>
</body>
</html>
<?php
    } else {
        echo "Purchase record not found";
    }

    $stmt->close();
} else {
    echo "Invalid purchase ID";
}

$conn->close();
?>
