<?php
include 'dbconfig.php';

$invoice_id = isset($_GET['invoice_id']) ? $_GET['invoice_id'] : 0;

// Fetch purchase invoice details
$stmt = $conn->prepare("SELECT purchase_bill_no, supplier_invoice_no, purchase_date, party_name, party_address, party_gst, grand_total FROM purchase_bills WHERE id = ?");
if (!$stmt) {
    die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$stmt->bind_result($purchase_bill_no, $supplier_invoice_no, $purchase_date, $party_name, $party_address, $party_gst, $grand_total);
$stmt->fetch();
$stmt->close();

// Fetch items
$items_sql = "SELECT description, qty, unit, hsn_code, price, total_price FROM items WHERE purchase_bill_id = ?";
$items_stmt = $conn->prepare($items_sql);
$items_stmt->bind_param("i", $invoice_id);
$items_stmt->execute();
$items_result = $items_stmt->get_result();
$items = $items_result->fetch_all(MYSQLI_ASSOC);
$items_stmt->close();

// Fetch taxes
$taxes_sql = "SELECT cgst, cgst_value, sgst, sgst_value, total_value FROM taxes WHERE purchase_bill_id = ?";
$taxes_stmt = $conn->prepare($taxes_sql);
$taxes_stmt->bind_param("i", $invoice_id);
$taxes_stmt->execute();
$taxes_result = $taxes_stmt->get_result();
$taxes = $taxes_result->fetch_all(MYSQLI_ASSOC);
$taxes_stmt->close();

// Fetch payments
$payments_sql = "SELECT amount_paid, balance_amount, payment_date FROM payments WHERE invoice_id = ?";
$payments_stmt = $conn->prepare($payments_sql);
$payments_stmt->bind_param("i", $invoice_id);
$payments_stmt->execute();
$payments_result = $payments_stmt->get_result();
$payments = $payments_result->fetch_all(MYSQLI_ASSOC);
$payments_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Details</title>
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
            width: 80%;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<h1>Purchase Details</h1>
<div class="details">
    <h2>Invoice Details</h2>
    <p><strong>Purchase Bill No:</strong> <?php echo htmlspecialchars($purchase_bill_no); ?></p>
    <p><strong>Supplier Invoice No:</strong> <?php echo htmlspecialchars($supplier_invoice_no); ?></p>
    <p><strong>Purchase Date:</strong> <?php echo htmlspecialchars($purchase_date); ?></p>
    <p><strong>Party Name:</strong> <?php echo htmlspecialchars($party_name); ?></p>
    <p><strong>Party Address:</strong> <?php echo htmlspecialchars($party_address); ?></p>
    <p><strong>Party GST:</strong> <?php echo htmlspecialchars($party_gst); ?></p>
    <p><strong>Grand Total:</strong> <?php echo htmlspecialchars($grand_total); ?></p>

    <h2>Items</h2>
    <table>
        <tr>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit</th>
            <th>HSN Code</th>
            <th>Price</th>
            <th>Total Price</th>
        </tr>
        <?php foreach ($items as $item) : ?>
        <tr>
            <td><?php echo htmlspecialchars($item['description']); ?></td>
            <td><?php echo htmlspecialchars($item['qty']); ?></td>
            <td><?php echo htmlspecialchars($item['unit']); ?></td>
            <td><?php echo htmlspecialchars($item['hsn_code']); ?></td>
            <td><?php echo htmlspecialchars($item['price']); ?></td>
            <td><?php echo htmlspecialchars($item['total_price']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Taxes</h2>
    <table>
        <tr>
            <th>CGST</th>
            <th>CGST Value</th>
            <th>SGST</th>
            <th>SGST Value</th>
            <th>Total Value</th>
        </tr>
        <?php foreach ($taxes as $tax) : ?>
        <tr>
            <td><?php echo htmlspecialchars($tax['cgst']); ?></td>
            <td><?php echo htmlspecialchars($tax['cgst_value']); ?></td>
            <td><?php echo htmlspecialchars($tax['sgst']); ?></td>
            <td><?php echo htmlspecialchars($tax['sgst_value']); ?></td>
            <td><?php echo htmlspecialchars($tax['total_value']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Payments</h2>
    <table>
        <tr>
            <th>Amount Paid</th>
            <th>Balance Amount</th>
            <th>Payment Date</th>
        </tr>
        <?php foreach ($payments as $payment) : ?>
        <tr>
            <td><?php echo htmlspecialchars($payment['amount_paid']); ?></td>
            <td><?php echo htmlspecialchars($payment['balance_amount']); ?></td>
            <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>