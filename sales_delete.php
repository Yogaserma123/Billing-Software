<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the invoice ID from the POST request
    $invoiceId = $_POST['id'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete from the invoice_items table
        $itemSql = "DELETE FROM invoice_items WHERE invoice_id = ?";
        $itemStmt = $conn->prepare($itemSql);
        $itemStmt->bind_param("i", $invoiceId);
        $itemStmt->execute();
        $itemStmt->close();

        // Delete from the invoices table
        $invoiceSql = "DELETE FROM invoices WHERE id = ?";
        $invoiceStmt = $conn->prepare($invoiceSql);
        $invoiceStmt->bind_param("i", $invoiceId);
        $invoiceStmt->execute();
        $invoiceStmt->close();

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
