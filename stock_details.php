<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Stock Details</h1>
    <form id="stockForm">
        <div class="form-group">
            <label for="description">Description of Goods:</label>
            <input type="text" id="description" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fromDate">From Date:</label>
            <input type="date" id="fromDate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="toDate">To Date:</label>
            <input type="date" id="toDate" class="form-control" required>
        </div>
        <button type="button" class="btn btn-primary" onclick="fetchReport()">Generate Report</button>
    </form>
    
    <div id="reportSection" style="margin-top: 20px;">
        <h3>Report</h3>
        <div id="reportContent"></div>
    </div>
</div>

<script>
    function fetchReport() {
        const description = $('#description').val();
        const fromDate = $('#fromDate').val();
        const toDate = $('#toDate').val();

        if (!description || !fromDate || !toDate) {
            alert('Please fill all fields');
            return;
        }

        $.ajax({
            url: 'fetch_stock_details.php',
            type: 'POST',
            data: {
                description: description,
                from_date: fromDate,
                to_date: toDate
            },
            success: function(response) {
                $('#reportContent').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                alert('An error occurred');
            }
        });
    }
</script>
</body>
</html>
