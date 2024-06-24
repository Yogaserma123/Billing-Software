<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST['date'];
    $material = $_POST['material'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $time = $_POST['time'];
    $vehicle = $_POST['vehicle'];
    $party = $_POST['party'];
    $weight = $_POST['weight'];

    // SQL query to insert data into the database
    $sql = "INSERT INTO unloading (unloading_date, material_name, place_from, place_to, timing, vehicle_number, party_name, weight)
            VALUES ('$date', '$material', '$from', '$to', '$time', '$vehicle', '$party', '$weight')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Form submission method not allowed!";
}

$conn->close();
header('location:unloadingedit.php');
?>
