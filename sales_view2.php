<?php
include 'dbconfig.php';

// Check if invoice ID is provided
if (isset($_GET['id'])) {
    $invoiceId = $_GET['id'];

    // Fetch invoice data
    $sql = "SELECT * FROM invoices WHERE invoice_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $invoiceId);
    $stmt->execute();
    $result = $stmt->get_result();
    $invoice = $result->fetch_assoc();

    // Fetch invoice items
    $sql_items = "SELECT * FROM invoice_items WHERE invoice_id = ?";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->bind_param("i", $invoiceId);
    $stmt_items->execute();
    $result_items = $stmt_items->get_result();
    $items = $result_items->fetch_all(MYSQLI_ASSOC);

    if (!$invoice) {
        die("Invoice not found.");
    }
} else {
    die("Invalid Invoice ID");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Invoice Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .invoice-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header, .section, .details, .totals, .tax-details, .footer {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #343a40;
            color: #fff;
        }
        .from-to {
            display: flex;
            justify-content: space-between;
        }
        .from-to div {
            padding: 10px;
            width: 48%;
            box-sizing: border-box;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .tax-details th, .tax-details td {
            text-align: center;
        }
        .footer {
            text-align: right;
        }
        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body class="bg-light">
    <div class="invoice-container">
        <div class="header text-center">
            <h1 class="text-primary">Tax Invoice</h1>
            <p><span style="float:left;">Invoice No.: <strong><?php echo htmlspecialchars($invoice['invoice_no']); ?></strong> </span>
            <span style="float:right;">Date: 
            <input type="date" value="<?php echo $invoice['invoice_date']; ?>" disabled class="form-control d-inline-block" style="width:auto;"></span></p>
        </div><br><br>

        <div class="section from-to">
            <div class="border p-3">
                <p><strong>From:</strong><br>
                    <?php echo htmlspecialchars($invoice['from_party_name']); ?><br>
                    <?php echo nl2br(htmlspecialchars($invoice['from_address'])); ?><br>
                    <strong>GST:</strong> <?php echo htmlspecialchars($invoice['from_gst']); ?>
                </p>
            </div>
            <div class="border p-3">
                <p><strong>To:</strong><br>
                    <?php echo htmlspecialchars($invoice['to_party_name']); ?><br>
                    <?php echo nl2br(htmlspecialchars($invoice['to_address'])); ?><br>
                    <strong>GST:</strong> <?php echo htmlspecialchars($invoice['to_gst']); ?>
                </p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered details">
                <thead class="thead-dark">
                    <tr>
                        <th>Sl. No</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>HSN Code</th>
                        <th>GST %</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sl_no = 1;
                    foreach ($items as $item) {
                        echo "<tr>";
                        echo "<td>{$sl_no}</td>";
                        echo "<td>" . htmlspecialchars($item['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['qty']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['unit']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['hsn_code']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['gst']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['unit_price']) . "</td>";
                        echo "<td>" . htmlspecialchars($item['total_price']) . "</td>";
                        echo "</tr>";
                        $sl_no++;
                    }
                    ?>
                    <tr>
                        <td colspan="7" style="text-align:right;"><strong>Total Amount</strong></td>
                        <td><?php echo htmlspecialchars($invoice['total_amount']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align:right;"><strong>SGST</strong></td>
                        <td><?php echo htmlspecialchars($invoice['sgst']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align:right;"><strong>CGST</strong></td>
                        <td><?php echo htmlspecialchars($invoice['cgst']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align:right;"><strong>Grand Total</strong></td>
                        <td><?php echo htmlspecialchars($invoice['grand_total']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p><strong>Authorized Signature</strong></p>
        </div>
    </div>
</body>
</html>
