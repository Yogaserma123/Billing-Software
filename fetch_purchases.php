<?php
include 'dbconfig.php';

$data = json_decode(file_get_contents('php://input'), true);
$fromDate = $data['fromDate'];
$toDate = $data['toDate'];

$sql = "SELECT * FROM purchase_bills WHERE purchase_date BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $fromDate, $toDate);
$stmt->execute();
$result = $stmt->get_result();

$purchases = [];
while ($row = $result->fetch_assoc()) {
    $purchases[] = $row;
}

echo json_encode($purchases);

$stmt->close();
$conn->close();
?>