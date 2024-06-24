<?php
include 'dbconfig.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$partyName = $data['partyName'];

//

$stmt = $conn->prepare("SELECT address, gst FROM parties WHERE name = ?");
$stmt->bind_param('s', $partyName);
$stmt->execute();
$stmt->bind_result($address, $gst);

if ($stmt->fetch()) {
    echo json_encode(['success' => true, 'party' => ['address' => $address, 'gst' => $gst]]);
} else {
    echo json_encode(['success' => false, 'message' => 'Party not found']);
}

$stmt->close();
$conn->close();
?>