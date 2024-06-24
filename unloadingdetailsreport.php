<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <!-- <h2 class="mb-4">Report</h2> -->
        <?php
        // Check if from date and to date are set and not empty
        if (isset($_GET['fromDate']) && isset($_GET['toDate']) && !empty($_GET['fromDate']) && !empty($_GET['toDate'])) {
            // Get the from date and to date from the URL parameters
            $fromDate = $_GET['fromDate'];
            $toDate = $_GET['toDate'];

            // Your database connection code
            include 'dbconfig.php';

            // SQL query to select data within the specified date range
            $sql_select = "SELECT * FROM unloading WHERE unloading_date BETWEEN '$fromDate' AND '$toDate'";
            $result = $conn->query($sql_select);

            if ($result->num_rows > 0) {
                // Display the data in a table
                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Date</th>';
                echo '<th>Material Name</th>';
                echo '<th>Place From</th>';
                echo '<th>Place To</th>';
                echo '<th>Time</th>';
                echo '<th>Vehicle Number</th>';
                echo '<th>Party Name</th>';
                echo '<th>Weight</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["unloading_date"] . '</td>';
                    echo '<td>' . $row["material_name"] . '</td>';
                    echo '<td>' . $row["place_from"] . '</td>';
                    echo '<td>' . $row["place_to"] . '</td>';
                    echo '<td>' . $row["timing"] . '</td>';
                    echo '<td>' . $row["vehicle_number"] . '</td>';
                    echo '<td>' . $row["party_name"] . '</td>';
                    echo '<td>' . $row["weight"] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo "No results found.";
            }

            // Close the database connection
            $conn->close();
        } else {
            echo "Please select a date range.";
        }
        ?>
        <br>
       <!--  <a href="index.html" class="btn btn-primary">Back to Home</a> -->
    </div>
</body>

</html>
