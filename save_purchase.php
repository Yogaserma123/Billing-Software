<?php
include 'dbconfig.php';

$data = json_decode(file_get_contents('php://input'), true);

$purchaseBillNo = $data['purchaseBillNo'];
$supplierInvoiceNo = $data['supplierInvoiceNo'];
$purchaseDate = $data['purchaseDate'];
$partyName = $data['partyName'];
$partyAddress = $data['partyAddress'];
$partyGST = $data['partyGST'];
$totalAmount = $data['totalAmount'];
$totalCGST = $data['totalCGST'];
$totalSGST = $data['totalSGST'];
$grandTotal = $data['grandTotal'];

$sql = "INSERT INTO purchase_bills (purchase_bill_no, supplier_invoice_no, purchase_date, party_name, party_address, party_gst, total_amount, total_cgst, total_sgst, grand_total) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $purchaseBillNo, $supplierInvoiceNo, $purchaseDate, $partyName, $partyAddress, $partyGST, $totalAmount, $totalCGST, $totalSGST, $grandTotal);

if ($stmt->execute()) {
    $purchaseBillId = $stmt->insert_id;

    // Insert items
    $sql = "INSERT INTO items (purchase_bill_id, description, qty, unit, hsn_code, price, total_price) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($data['items'] as $item) {
        $stmt->bind_param("issssss", $purchaseBillId, $item['description'], $item['qty'], $item['unit'], $item['code'], $item['price'], $item['total_price']);
        $stmt->execute();
    }

    // Insert taxes
    $sql = "INSERT INTO taxes (purchase_bill_id, cgst, cgst_value, sgst, sgst_value, total_value) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($data['taxes'] as $tax) {
        $stmt->bind_param("isssss", $purchaseBillId, $tax['cgst'], $tax['cgst_value'], $tax['sgst'], $tax['sgst_value'], $tax['total_value']);
        $stmt->execute();
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

$conn->close();
?>