<?php
include 'dbconfig.php';

// Check if ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record with the provided ID
    $sql_select = "SELECT * FROM expenses WHERE id = $id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // Record found, display the edit form
        $row = $result->fetch_assoc();
?>
        <h2>Edit Record</h2>
        <form method="post" action="expensesdataupdate.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Date: <input type="text" name="expenses_date" value="<?php echo $row['expenses_date']; ?>"><br>
            Category: <input type="text" name="category" value="<?php echo $row['category']; ?>"><br>
            Amount: <input type="text" name="amount" value="<?php echo $row['amount']; ?>"><br>
            Description: <input type="text" name="description" value="<?php echo $row['description']; ?>"><br>
            Reference: <input type="text" name="reference" value="<?php echo $row['reference']; ?>"><br>
            <input type="submit" value="Update">
        </form>
<?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "ID parameter not provided.";
}

$conn->close();
?>
