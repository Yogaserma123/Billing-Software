<?php
include 'dbconfig.php';

// Get the input values from the POST request
$description = $_POST['description'] ?? '';
$fromDate = $_POST['from_date'] ?? '';
$toDate = $_POST['to_date'] ?? '';

// Validate the input values
if (empty($description) || empty($fromDate) || empty($toDate)) {
    echo '<div class="alert alert-danger">All fields are required.</div>';
    exit;
}

// Initialize total amounts to 0 in case there are no records found
$totalSalesAmount = 0;
$totalPurchaseAmount = 0;

try {
    // Query to get the total amount from the sales table within the date range
    $salesQuery = "SELECT SUM(amount) AS total_sales_amount FROM sales WHERE description = ? AND sales_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($salesQuery);
    $stmt->bind_param("sss", $description, $fromDate, $toDate);
    $stmt->execute();
    $salesResult = $stmt->get_result();
    if ($salesResult->num_rows > 0) {
        $salesRow = $salesResult->fetch_assoc();
        $totalSalesAmount = $salesRow['total_sales_amount'] ?? 0;
    }
    $stmt->close();

    // Query to get the total amount from the purchase table within the date range
    $purchaseQuery = "SELECT SUM(amount) AS total_purchase_amount FROM purchase WHERE description = ? AND purchase_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($purchaseQuery);
    $stmt->bind_param("sss", $description, $fromDate, $toDate);
    $stmt->execute();
    $purchaseResult = $stmt->get_result();
    if ($purchaseResult->num_rows > 0) {
        $purchaseRow = $purchaseResult->fetch_assoc();
        $totalPurchaseAmount = $purchaseRow['total_purchase_amount'] ?? 0;
    }
    $stmt->close();

    // Calculate the balance amount
    $balanceAmount = $totalSalesAmount - $totalPurchaseAmount;

    // Display the stock details
    echo "<center><h1>Stock Details for " . htmlspecialchars($description) . "</h1></center><br><br>";
    echo "<center><h5>Total Amount from Sales: " . htmlspecialchars($totalSalesAmount) . "</h5></center>";
    echo "<center><h5>Total Amount from Purchase: " . htmlspecialchars($totalPurchaseAmount) . "</h5></center>";
    echo "<center><h5>Balance Amount: " . htmlspecialchars($balanceAmount) . "</h5></center><br><br><br>";

    // Fetch detailed records from the sales table within the date range
    $salesDetailsQuery = "SELECT * FROM sales WHERE description = ? AND sales_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($salesDetailsQuery);
    $stmt->bind_param("sss", $description, $fromDate, $toDate);
    $stmt->execute();
    $salesDetailsResult = $stmt->get_result();

    echo "<h3>Sales Details:</h3>";
    if ($salesDetailsResult->num_rows > 0) {
        echo "<div class='table-responsive'><table class='table table-bordered'>";
        echo "<thead><tr><th>Date</th><th>Description</th><th>Customer</th><th>Amount</th></tr></thead><tbody>";
        while ($row = $salesDetailsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["sales_date"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["customer"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["amount"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<center>No Sales Records Found</center>";
    }
    $stmt->close();

    // Fetch detailed records from the purchase table within the date range
    $purchaseDetailsQuery = "SELECT * FROM purchase WHERE description = ? AND purchase_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($purchaseDetailsQuery);
    $stmt->bind_param("sss", $description, $fromDate, $toDate);
    $stmt->execute();
    $purchaseDetailsResult = $stmt->get_result();

    echo "<h3>Purchase Details:</h3>";
    if ($purchaseDetailsResult->num_rows > 0) {
        echo "<div class='table-responsive'><table class='table table-bordered'>";
        echo "<thead><tr><th>Date</th><th>Description</th><th>Supplier</th><th>Amount</th></tr></thead><tbody>";
        while ($row = $purchaseDetailsResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["purchase_date"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["supplier"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["amount"]) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<center>No Purchase Records Found</center>";
    }
    $stmt->close();

} catch (Exception $e) {
    echo '<div class="alert alert-danger">An error occurred: ' . htmlspecialchars($e->getMessage()) . '</div>';
} finally {
    // Close the database connection
    $conn->close();
}
?>
