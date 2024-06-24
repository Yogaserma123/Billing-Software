<?php
include 'dbconfig.php';

if (isset($_POST['description']) && isset($_POST['from_date']) && isset($_POST['to_date'])) {
    $description = $_POST['description'];
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];

    // Fetch purchase details
    $purchaseSql = "SELECT pb.purchase_bill_no, pi.description, pi.qty, pi.price, pb.date
                    FROM items pi
                    JOIN purchase_bills pb ON pi.purchase_bill_id = pb.id
                    WHERE pi.description = ? AND pb.date BETWEEN ? AND ?";
    $purchaseStmt = $conn->prepare($purchaseSql);
    
    if (!$purchaseStmt) {
        die("Purchase Statement preparation failed: " . $conn->error);
    }
    
    $purchaseStmt->bind_param("sss", $description, $fromDate, $toDate);
    $purchaseStmt->execute();
    $purchaseResult = $purchaseStmt->get_result();

    // Fetch sales details
    $salesSql = "SELECT ii.invoice_id, ii.description, ii.qty, ii.unit_price, i.invoice_date
                 FROM invoice_items ii
                 JOIN invoices i ON ii.invoice_id = i.id
                 WHERE ii.description = ? AND i.invoice_date BETWEEN ? AND ?";
    $salesStmt = $conn->prepare($salesSql);
    
    if (!$salesStmt) {
        die("Sales Statement preparation failed: " . $conn->error);
    }
    
    $salesStmt->bind_param("sss", $description, $fromDate, $toDate);
    $salesStmt->execute();
    $salesResult = $salesStmt->get_result();

    echo "<h4>Purchase Details</h4>";
    if ($purchaseResult->num_rows > 0) {
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Purchase Bill No</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $purchaseResult->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['purchase_bill_no']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['qty']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['date']}</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No purchase records found.</p>";
    }

    echo "<h4>Sales Details</h4>";
    if ($salesResult->num_rows > 0) {
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $salesResult->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['invoice_id']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['qty']}</td>
                    <td>{$row['unit_price']}</td>
                    <td>{$row['invoice_date']}</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No sales records found.</p>";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
