<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $expenses_date = $_POST['expenses_date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $reference = $_POST['reference'];

    // SQL query to update the record in the database
    $sql_update = "UPDATE expenses SET 
                    expenses_date = '$expenses_date',
                    category = '$category',
                    amount = '$amount',
                    description = '$description',
                    reference = '$reference'
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
header('location:expensesedit.php');
?>
