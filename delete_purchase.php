<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the purchase ID from the POST request
    $purchaseId = $_POST['id'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete from the items table
        $itemSql = "DELETE FROM items WHERE purchase_bill_id = ?";
        $itemStmt = $conn->prepare($itemSql);
        $itemStmt->bind_param("i", $purchaseId);
        $itemStmt->execute();
        $itemStmt->close();

        // Delete from the taxes table
        $taxSql = "DELETE FROM taxes WHERE purchase_bill_id = ?";
        $taxStmt = $conn->prepare($taxSql);
        $taxStmt->bind_param("i", $purchaseId);
        $taxStmt->execute();
        $taxStmt->close();

        // Delete from the purchase_bills table
        $purchaseSql = "DELETE FROM purchase_bills WHERE id = ?";
        $purchaseStmt = $conn->prepare($purchaseSql);
        $purchaseStmt->bind_param("i", $purchaseId);
        $purchaseStmt->execute();
        $purchaseStmt->close();

        // Commit the transaction
        $conn->commit();

        // Return a success response
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Roll back the transaction if an error occurred
        $conn->rollback();

        // Return an error response
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>