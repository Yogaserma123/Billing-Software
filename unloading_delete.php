<?php
include 'dbconfig.php';

// Check if ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the record with the provided ID
    $sql_delete = "DELETE FROM unloading WHERE id = $id";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "ID parameter not provided.";
}

$conn->close();
header('location:unloadingedit.php');
?>
