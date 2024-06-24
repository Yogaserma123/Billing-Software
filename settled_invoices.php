<?php
include 'dbconfig.php';

$invoice_id = isset($_GET['invoice_id']) ? $_GET['invoice_id'] : 0;

// Fetch invoice details
$stmt = $conn->prepare("SELECT invoice_no, invoice_date, from_party_name, from_address, to_party_name, to_address, grand_total FROM invoices WHERE id = ?");
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$stmt->bind_result($invoice_no, $invoice_date, $from_party_name, $from_address, $to_party_name, $to_address, $grand_total);
$stmt->fetch();
$stmt->close();

// Fetch income details
$stmt = $conn->prepare("SELECT amount_received, balance_amount FROM income WHERE invoice_id = ?");
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$stmt->bind_result($amount_received, $balance_amount);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settled Invoice Details</title>
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
        .details {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .details h2 {
            color: #007bff;
            text-align: center;
        }
        .details p {
            font-size: 16px;
            line-height: 1.6;
        }
        .highlight {
            font-weight: bold;
            color: #28a745;
        }
        .red-highlight {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>

<h1>Settled Invoice Details</h1>
<div class="details">
    <h2>Invoice Details</h2>
    <p><strong>Invoice No:</strong> <?php echo htmlspecialchars($invoice_no); ?></p>
    <p><strong>Invoice Date:</strong> <?php echo htmlspecialchars($invoice_date); ?></p>
    <p><strong>From Details:</strong> <?php echo htmlspecialchars($from_party_name) . "<br>" . htmlspecialchars($from_address); ?></p>
    <p><strong>To Details:</strong> <?php echo htmlspecialchars($to_party_name) . "<br>" . htmlspecialchars($to_address); ?></p>
    <p><strong>Invoice Amount:</strong> <?php echo htmlspecialchars($grand_total); ?></p>
    <p class="highlight"><strong>Amount Received:</strong> <?php echo htmlspecialchars($amount_received); ?></p>
    <p class="red-highlight"><strong>Balance Amount:</strong> <?php echo htmlspecialchars($balance_amount); ?></p>
</div>

</body>
</html>

<?php
$conn->close();
?>