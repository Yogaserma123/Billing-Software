<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $party_name = $_GET['partyName'];

    $sql = "SELECT address, gst FROM party_details WHERE party_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $party_name);
    $stmt->execute();
    $stmt->bind_result($address, $gst);
    $stmt->fetch();

    $result = array(
        "address" => $address,
        "gst" => $gst
    );

    echo json_encode($result);

    $stmt->close();
    $conn->close();
}
?>
