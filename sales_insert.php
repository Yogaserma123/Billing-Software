<?php
include 'dbconfig.php';

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO invoices (invoice_no, invoice_date, from_party_name, from_address, from_gst, to_party_name, to_address, to_gst, total_amount, sgst, cgst, grand_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssdddd", $invoice_no, $invoice_date, $from_party_name, $from_address, $from_gst, $to_party_name, $to_address, $to_gst, $total_amount, $sgst, $cgst, $grand_total);

// Set parameters and execute
$invoice_no = $_POST['invoiceNo'];
$invoice_date = $_POST['invoiceDate'];
$from_party_name = $_POST['fromPartyName'];
$from_address = $_POST['fromAddress'];
$from_gst = $_POST['fromGst'];
$to_party_name = $_POST['toPartyName'];
$to_address = $_POST['toAddress'];
$to_gst = $_POST['toGst'];
$total_amount = $_POST['totalAmount'];
$sgst = $_POST['sgst'];
$cgst = $_POST['cgst'];
$grand_total = $_POST['grandTotal'];
$stmt->execute();

// Get the last inserted invoice id
$invoice_id = $stmt->insert_id;

// Prepare and bind for invoice items
$item_stmt = $conn->prepare("INSERT INTO invoice_items (invoice_id, description, qty, unit, hsn_code, gst, unit_price, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$item_stmt->bind_param("isissddd", $invoice_id, $description, $qty, $unit, $hsn_code, $gst, $unit_price, $total_price);

$items = json_decode($_POST['items'], true);
foreach ($items as $item) {
    $description = $item['description'];
    $qty = $item['qty'];
    $unit = $item['unit'];
    $hsn_code = $item['hsnCode'];
    $gst = $item['gst'];
    $unit_price = $item['unitPrice'];
    $total_price = $item['totalPrice'];
    $item_stmt->execute();
}

echo "New records created successfully";

$stmt->close();
$item_stmt->close();
$conn->close();
header('location:display_sales.php');
?>
