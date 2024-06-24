<?php
include 'dbconfig.php';

// Check if ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the record with the provided ID
    $sql_select = "SELECT * FROM unloading WHERE id = $id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // Record found, display the edit form
        $row = $result->fetch_assoc();
?>
        <h2>Edit Record</h2>
        <form method="post" action="unloadingdataupdate.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            Date: <input type="text" name="date" value="<?php echo $row['unloading_date']; ?>"><br>
            Material Name: <input type="text" name="material" value="<?php echo $row['material_name']; ?>"><br>
            Place From: <input type="text" name="from" value="<?php echo $row['place_from']; ?>"><br>
            Place To: <input type="text" name="to" value="<?php echo $row['place_to']; ?>"><br>
            Time: <input type="text" name="time" value="<?php echo $row['timing']; ?>"><br>
            Vehicle Number: <input type="text" name="vehicle" value="<?php echo $row['vehicle_number']; ?>"><br>
            Party Name: <input type="text" name="party" value="<?php echo $row['party_name']; ?>"><br>
            Weight: <input type="text" name="weight" value="<?php echo $row['weight']; ?>"><br>
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
