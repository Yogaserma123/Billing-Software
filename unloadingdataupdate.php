<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $date = $_POST['date'];
    $material = $_POST['material'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $time = $_POST['time'];
    $vehicle = $_POST['vehicle'];
    $party = $_POST['party'];
    $weight = $_POST['weight'];

    // SQL query to update the record in the database
    $sql_update = "UPDATE unloading SET 
                    unloading_date = '$date',
                    material_name = '$material',
                    place_from = '$from',
                    place_to = '$to',
                    timing = '$time',
                    vehicle_number = '$vehicle',
                    party_name = '$party',
                    weight = '$weight'
                    WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Form submission method not allowed.";
}

$conn->close();
header('location:unloadingedit.php');
?>
