<?php
include 'dbconfig.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $party_name = $_POST['partyName'];
    $address = $_POST['address'];
    $gst = $_POST['gst'];

    $sql = "INSERT INTO party_details (party_name, address, gst) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $party_name, $address, $gst);

    if ($stmt->execute()) {
        echo "New party details added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
