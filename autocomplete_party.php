<?php
include 'dbconfig.php';

$query = $_GET['query'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT party_address, party_gst FROM parties WHERE party_name LIKE CONCAT('%', ?, '%') LIMIT 1");
$stmt->bind_param('s', $query);

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(null);
}

$stmt->close();
$conn->close();
?>
