<?php
include 'dbconfig.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $expenses_date = $_POST['expenses_date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $reference = $_POST['reference'];
    
    // SQL query to insert data into the database
    $sql = "INSERT INTO expenses (expenses_date,category,amount,description,reference)
            VALUES ('$expenses_date', '$category', '$amount', '$description', '$reference')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Form submission method not allowed!";
}

$conn->close();
header('location:expensesedit.php');
?>
