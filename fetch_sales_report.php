<?php
include 'dbconfig.php';

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Check if the required data is present
if (isset($data['fromDate']) && isset($data['toDate'])) {
    $fromDate = $data['fromDate'];
    $toDate = $data['toDate'];

    // Fetch the sales report data
    $sql = "SELECT invoice_no, invoice_date, from_party_name, from_address, from_gst, to_party_name, to_address, to_gst, total_amount, sgst, cgst, grand_total 
            FROM invoices 
            WHERE invoice_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fromDate, $toDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // Return the data as JSON
    echo json_encode($rows);
} else {
    echo json_encode([]);
}
?>
