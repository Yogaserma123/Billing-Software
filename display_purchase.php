<?php
include 'dbconfig.php';

$sql = "SELECT id, purchase_bill_no, supplier_invoice_no, purchase_date, party_name, party_address, party_gst FROM purchase_bills";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Purchases</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
    </style>
    <script>
        function deletePurchase(purchaseId) {
            if (confirm("Are you sure you want to delete this purchase?")) {
                fetch('delete_purchase.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + encodeURIComponent(purchaseId)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Purchase deleted successfully');
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

        function viewPurchase(purchaseId) {
            window.location.href = 'view_purchase.php?id=' + purchaseId;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="text-primary">Purchase Bills</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Purchase Bill ID</th>
                    <th>Purchase Bill No</th>
                    <th>Supplier Invoice No</th>
                    <th>Purchase Date</th>
                    <th>Party Name</th>
                    <th>Party Address</th>
                    <th>Party GST</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $purchaseBillId = $row['id'];
                        echo "<tr>";
                        echo "<td>" . $purchaseBillId . "</td>";
                        echo "<td>" . $row['purchase_bill_no'] . "</td>";
                        echo "<td>" . $row['supplier_invoice_no'] . "</td>";
                        echo "<td>" . $row['purchase_date'] . "</td>";
                        echo "<td>" . $row['party_name'] . "</td>";
                        echo "<td>" . $row['party_address'] . "</td>";
                        echo "<td>" . $row['party_gst'] . "</td>";
                        echo "<td>";
                        echo "<button class='btn btn-info btn-sm' onclick='viewPurchase($purchaseBillId)'>View</button> ";
                        echo "<button class='btn btn-danger btn-sm' onclick='deletePurchase($purchaseBillId)'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
