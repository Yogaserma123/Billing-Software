<?php
include 'dbconfig.php';

$sql = "SELECT * FROM invoices";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Records</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .actions a {
            margin-right: 5px;
        }
        .message {
            margin: 20px auto;
            width: 90%;
            padding: 10px;
            border: 1px solid;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            border-color: #28a745;
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            border-color: #dc3545;
            background-color: #f8d7da;
            color: #721c24;
        }
        .invalid {
            border-color: #ffc107;
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
    <script>
        function deleteInvoice(invoiceId) {
            if (confirm("Are you sure you want to delete this invoice?")) {
                fetch('sales_delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + encodeURIComponent(invoiceId)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Invoice deleted successfully');
                        location.reload();
                    } else {
                        alert('Error: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2 class="text-primary">Sales Records</h2>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo "<div class='message success alert alert-success'>Record deleted successfully.</div>";
        } elseif ($_GET['status'] == 'error') {
            echo "<div class='message error alert alert-danger'>Error deleting record. Please try again.</div>";
        } elseif ($_GET['status'] == 'invalid') {
            echo "<div class='message invalid alert alert-warning'>Invalid request.</div>";
        }
    }
    ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Invoice No</th>
                    <th>Invoice Date</th>
                    <th>From Party Name</th>
                    <th>From Address</th>
                    <th>To Party Name</th>
                    <th>To Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["invoice_no"]) . "</td>";
                        $invoice_date = date('Y-m-d', strtotime($row["invoice_date"]));
                        echo "<td>" . htmlspecialchars($invoice_date) . "</td>";
                        echo "<td>" . htmlspecialchars($row["from_party_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["from_address"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["to_party_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["to_address"]) . "</td>";
                        echo '<td class="actions">';
                        echo '<a href="sales_view.php?id=' . $row["id"] . '" class="btn btn-info btn-sm">View</a>';
                        echo '<button class="btn btn-danger btn-sm" onclick="deleteInvoice(' . $row["id"] . ')">Delete</button>';
                        echo '</td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
