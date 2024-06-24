<?php
include 'dbconfig.php';




header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$partyName = $data['partyName'];
$partyAddress = $data['partyAddress'];
$partyGST = $data['partyGST'];



// Prepare and bind
$stmt = $conn->prepare("INSERT INTO parties (name, address, gst) VALUES (?, ?, ?)
                        ON DUPLICATE KEY UPDATE address = VALUES(address), gst = VALUES(gst)");
$stmt->bind_param('sss', $partyName, $partyAddress, $partyGST);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save party details']);
}

$stmt->close();
$conn->close();
?>