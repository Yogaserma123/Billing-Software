<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice History</title>
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
        .buttons {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        .button {
            padding: 20px 40px;
            font-size: 18px;
            margin: 0 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-green {
            background-color: #28a745;
            color: #fff;
        }
        .button-green:hover {
            background-color: #218838;
        }
        .button-red {
            background-color: #dc3545;
            color: #fff;
        }
        .button-red:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h1>Invoice History</h1>
<div class="buttons">
    <button class="button button-green" onclick="window.location.href='settled_invoices_history.php'">Settled Amount</button>
    <button class="button button-red" onclick="window.location.href='unsettled_invoices_history.php'">Unsettled Amount</button>
</div>

</body>
</html>