<?php
include 'dbconfig.php';

// Handle form submission for amount received and balance amount
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['invoice_id']) && isset($_POST['amount_received']) && isset($_POST['received_date'])) {
        $invoice_id = $_POST['invoice_id'];
        $amount_received = $_POST['amount_received'];
        $received_date = $_POST['received_date'];

        // Fetch the grand total for the invoice
        $stmt = $conn->prepare("SELECT grand_total FROM invoices WHERE id = ?");
        if (!$stmt) {
            die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $stmt->bind_result($grand_total);
        $stmt->fetch();
        $stmt->close();

        // Fetch the existing amount received for the invoice
        $stmt = $conn->prepare("SELECT COALESCE(SUM(amount_received), 0) as total_received FROM income WHERE invoice_id = ?");
        if (!$stmt) {
            die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $stmt->bind_result($total_received);
        $stmt->fetch();
        $stmt->close();

        $new_total_received = $total_received + $amount_received;
        $balance_amount = $grand_total - $new_total_received;

        // Insert or update income table
        $stmt = $conn->prepare("INSERT INTO income (invoice_id, amount_received, balance_amount, received_date) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE amount_received = amount_received + ?, balance_amount = ?");
        if (!$stmt) {
            die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
        }
        $stmt->bind_param("iddsdd", $invoice_id, $amount_received, $balance_amount, $received_date, $amount_received, $balance_amount);

        if ($stmt->execute()) {
            // Redirect to the details page
            header("Location: income_details.php?invoice_id=$invoice_id");
            exit();
        } else {
            echo "Error adding record: " . $conn->error;
        }
        $stmt->close();
    }
}

// Fetch sales records
$sql = "SELECT id, invoice_no, invoice_date, from_party_name, from_address, to_party_name, to_address, grand_total FROM invoices";
$result = $conn->query($sql);

// Fetch income records
$income_sql = "SELECT * FROM income";
$income_result = $conn->query($income_sql);
$income_data = [];
while ($income_row = $income_result->fetch_assoc()) {
    $income_data[$income_row['invoice_id']] = $income_row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            color: #333;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            display: inline-block;
        }
        input[type="number"], input[type="date"] {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="submit"], button {
            padding: 5px 10px;
            border: none;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #218838;
        }
        .button-view {
            background-color: #007bff;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            display: inline-block;
        }
        .button-view:hover {
            background-color: #0056b3;
        }
        .light {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .green-light {
            background-color: green;
        }
        .red-light {
            background-color: red;
        }
        .yellow-light {
            background-color: yellow;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Income Page</h1>
<div style="text-align: center; margin-bottom: 20px;">
    <a href="settled_invoices_history.php" class="button-view">View Settled Invoices</a>
    <a href="unsettled_invoices_history.php" class="button-view">View Unsettled Invoices</a>
</div>
<table>
    <tr>
        <th>Invoice No</th>
        <th>Invoice Date</th>
        <th>From Details</th>
        <th>To Details</th>
        <th>Invoice Amount</th>
        <th>Amount Received</th>
        <th>Date Received</th>
        <th>Actions</th>
        <th>Status</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        $invoice_id = $row['id'];
        $amount_received = isset($income_data[$invoice_id]) ? $income_data[$invoice_id]['amount_received'] : 0;
        $balance_amount = isset($income_data[$invoice_id]) ? $income_data[$invoice_id]['balance_amount'] : $row['grand_total'];
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['invoice_no']) . "</td>";
        echo "<td>" . htmlspecialchars($row['invoice_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['from_party_name']) . "<br>" . htmlspecialchars($row['from_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['to_party_name']) . "<br>" . htmlspecialchars($row['to_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['grand_total']) . "</td>";
        echo "<td>
                <form method='post' action=''>
                    <input type='hidden' name='invoice_id' value='" . htmlspecialchars($invoice_id) . "'>
                    <input type='number' name='amount_received' min='0' step='0.01' placeholder='Amount Received' required>
              </td>
              <td>
                    <input type='date' name='received_date' required>
                    <input type='submit' value='Add'>
                </form>
              </td>";
        echo "<td>
                <a href='income_details.php?invoice_id=" . htmlspecialchars($invoice_id) . "' class='button-view'>View</a>
              </td>";
        echo "<td>";
        if ($amount_received == 0) {
            echo "<span class='light yellow-light'></span>";
        } elseif ($balance_amount == 0) {
            echo "<span class='light green-light'></span>";
        } else {
            echo "<span class='light red-light'></span>";
        }
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Modal -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Invoice Details</h2>
        <p id="modalInvoiceDetails"></p>
        <h2>Income Details</h2>
        <table>
            <tr>
                <th>Amount Received</th>
                <th>Balance Amount</th>
                <th>Received Date</th>
            </tr>
            <tbody id="modalIncomeDetails"></tbody>
        </table>
    </div>
</div>

<script>
function openModal(invoice_id) {
    // Fetch invoice details using AJAX
    fetch(income_details.php?invoice_id=${invoice_id})
        .then(response => response.json())
        .then(data => {
            // Populate modal with fetched data
            document.getElementById('modalInvoiceDetails').innerHTML = `
                <p><strong>Invoice No:</strong> ${data.invoice_no}</p>
                <p><strong>Invoice Date:</strong> ${data.invoice_date}</p>
                <p><strong>From:</strong> ${data.from_party_name}<br>${data.from_address}</p>
                <p><strong>To:</strong> ${data.to_party_name}<br>${data.to_address}</p>
                <p><strong>Invoice Amount:</strong> ${data.grand_total}</p>
            `;

            let incomeDetails = '';
            data.income.forEach(income => {
                incomeDetails += `
                    <tr>
                        <td>${income.amount_received}</td>
                        <td>${income.balance_amount}</td>
                        <td>${income.received_date}</td>
                    </tr>
                `;
            });
            document.getElementById('modalIncomeDetails').innerHTML = incomeDetails;

            // Display the modal
            document.getElementById('viewModal').style.display = 'block';
        })
        .catch(error => console.error('Error fetching invoice details:', error));
}

function closeModal() {
    document.getElementById('viewModal').style.display = 'none';
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    const modal = document.getElementById('viewModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

</body>
</html>

<?php
$conn->close();
?>