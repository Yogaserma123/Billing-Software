<?php
include 'dbconfig.php';

$invoice_id = isset($_GET['invoice_id']) ? $_GET['invoice_id'] : 0;

// Fetch invoice details
$stmt = $conn->prepare("SELECT invoice_no, invoice_date, from_party_name, from_address, to_party_name, to_address, grand_total FROM invoices WHERE id = ?");
if (!$stmt) {
    die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$stmt->bind_result($invoice_no, $invoice_date, $from_party_name, $from_address, $to_party_name, $to_address, $grand_total);
$stmt->fetch();
$stmt->close();

// Fetch income details
$stmt = $conn->prepare("SELECT amount_received, balance_amount, received_date FROM income WHERE invoice_id = ?");
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$income_details = [];
$stmt->bind_result($amount_received, $balance_amount, $received_date);
while ($stmt->fetch()) {
    $income_details[] = [
        'amount_received' => $amount_received,
        'balance_amount' => $balance_amount,
        'received_date' => $received_date,
    ];
}
$stmt->close();

// Function to convert number to words
function numberToWords($num) {
    $ones = array(
        0 => "Zero", 1 => "One", 2 => "Two", 3 => "Three", 4 => "Four", 5 => "Five", 6 => "Six", 7 => "Seven",
        8 => "Eight", 9 => "Nine", 10 => "Ten", 11 => "Eleven", 12 => "Twelve", 13 => "Thirteen", 14 => "Fourteen",
        15 => "Fifteen", 16 => "Sixteen", 17 => "Seventeen", 18 => "Eighteen", 19 => "Nineteen"
    );
    $tens = array(
        0 => "Zero", 1 => "Ten", 2 => "Twenty", 3 => "Thirty", 4 => "Forty", 5 => "Fifty", 6 => "Sixty",
        7 => "Seventy", 8 => "Eighty", 9 => "Ninety"
    );
    $hundreds = array("", "Hundred", "Thousand", "Lakh", "Crore");
    if ($num == 0) {
        return "Zero";
    } else {
        $num = number_format($num, 2, ".", ",");
        $num_arr = explode(".", $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(",", $wholenum));
        krsort($whole_arr, 1);
        $rettxt = "";
        foreach ($whole_arr as $key => $i) {
            while (substr($i, 0, 1) == "0")
                $i = substr($i, 1, 5);
            if ($i < 20) {
                $rettxt .= $ones[$i];
            } elseif ($i < 100) {
                if (substr($i, 0, 1) != "0")
                    $rettxt .= $tens[substr($i, 0, 1)];
                if (substr($i, 1, 1) != "0")
                    $rettxt .= " " . $ones[substr($i, 1, 1)];
            } else {
                if (substr($i, 0, 1) != "0")
                    $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[1];
                if (substr($i, 1, 1) != "0")
                    $rettxt .= " " . $tens[substr($i, 1, 1)];
                if (substr($i, 2, 1) != "0")
                    $rettxt .= " " . $ones[substr($i, 2, 1)];
            }
            if ($key > 0) {
                $rettxt .= " " . $hundreds[$key] . " ";
            }
        }
        if ($decnum > 0) {
            $rettxt .= " and ";
            if ($decnum < 20) {
                $rettxt .= $ones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                $rettxt .= " " . $ones[substr($decnum, 1, 1)];
            }
        }
        return $rettxt . " Rupees Only";
    }
}

$grand_total_in_words = numberToWords($grand_total);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Details</title>
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
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Income Details</h1>
<div class="details">
    <h2>Invoice Details</h2>
    <p><strong>Invoice No:</strong> <?php echo htmlspecialchars($invoice_no); ?></p>
    <p><strong>Invoice Date:</strong> <?php echo htmlspecialchars($invoice_date); ?></p>
    <p><strong>From:</strong> <?php echo htmlspecialchars($from_party_name) . "<br>" . htmlspecialchars($from_address); ?></p>
    <p><strong>To:</strong> <?php echo htmlspecialchars($to_party_name) . "<br>" . htmlspecialchars($to_address); ?></p>
    <p><strong>Invoice Amount:</strong> <?php echo htmlspecialchars($grand_total); ?></p>
    <p><strong>Amount in Words:</strong> <?php echo $grand_total_in_words; ?></p>
    <h2>Income Details</h2>
    <table>
        <thead>
            <tr>
                <th>Amount Received</th>
                <th>Balance Amount</th>
                <th>Received Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($income_details as $income) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($income['amount_received']); ?></td>
                    <td><?php echo htmlspecialchars($income['balance_amount']); ?></td>
                    <td><?php echo htmlspecialchars($income['received_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>