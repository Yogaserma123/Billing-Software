<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Billing Software</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <style>
    .invoice-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-custom {
        background-color: #007bff;
        color: white;
    }

    .totals {
        margin-top: 20px;
    }

    .tax-details {
        margin-top: 20px;
    }
</style>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search Projects.." aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-lg-flex d-none">
                <button type="button" class="btn btn-info font-weight-bold">+ Create New</button>
            </li>
          <li class="nav-item dropdown d-flex">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="icon-air-play mx-0"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
              <a class="dropdown-item preview-item">               
                  <i class="icon-head"></i> Profile
              </a>
              <a class="dropdown-item preview-item">
                  <i class="icon-inbox"></i> Logout
              </a>
            </div>
          </li>
          <li class="nav-item dropdown mr-4 d-lg-flex d-none">
            <a class="nav-link count-indicatord-flex align-item s-center justify-content-center" href="#">
              <i class="icon-grid"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-profile">
        <div class="user-image">
            <img src="images/faces/face28.png">
        </div>
        <div class="user-name">
        </div>
        <div class="user-designation">
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#purchase-details" aria-expanded="false" aria-controls="purchase-details">
                <i class="icon-bag menu-icon"></i>
                <span class="menu-title">Purchase</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="purchase-details">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="purchase.php">Purchase Entry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="display_purchase.php">Display</a></li>
                    <li class="nav-item"> <a class="nav-link" href="purchase_income.php">Purchase Payment</a></li>
                    <li class="nav-item"> <a class="nav-link" href="purchase_report.php">Report</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sales-details" aria-expanded="false" aria-controls="sales-details">
                <i class="icon-server menu-icon"></i>
                <span class="menu-title">Sales</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sales-details">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="sales.php">Sales Entry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="display_sales.php">Display</a></li>
                    <li class="nav-item"> <a class="nav-link" href="sales_report.php">Report</a></li>
                </ul>
            </div>
            <li class="nav-item">
            <a class="nav-link" href="stock.php">
                <i class="icon-pie-graph menu-icon"></i>
                <span class="menu-title">Stock</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#income-details" aria-expanded="false" aria-controls="income-details">
                <i class="icon-box menu-icon"></i>
                <span class="menu-title">Income</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="income-details">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="incomeentry.php">Income Entry </a></li>
                    <li class="nav-item"> <a class="nav-link" href="incomeedit.php">Income History </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#expenses-details" aria-expanded="false" aria-controls="expenses-details">
                <i class="icon-disc menu-icon"></i>
                <span class="menu-title">Expenses</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="expenses-details">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="expensesentry.php">New Entry</a></li>
                    <li class="nav-item"> <a class="nav-link" href="expensesedit.php">Edit/Delete</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profit.php">
                <i class="icon-pie-graph menu-icon"></i>
                <span class="menu-title">Profit/loss</span>
            </a>
        </li>
    </ul>
</nav>
      <!-- partial -->

      
<div class="invoice-container">
    <div class="header">
        <h1>Tax Invoice</h1>
        <div class="invoice-info d-flex justify-content-between">
            <div class="form-group">
                <label for="invoiceNo">Invoice No.:</label>
                <input type="text" class="form-control" id="invoiceNo" required>
            </div>
            <div class="form-group">
                <label for="invoiceDate">Date:</label>
                <input type="date" class="form-control" id="invoiceDate" required>
            </div>
        </div>
    </div>

    <div class="section from-to row">
        <div class="col-md-6">
            <p><strong>From:</strong></p>
            <div class="form-group">
                <label for="fromPartyName">Party Name:</label>
                <input type="text" class="form-control" id="fromPartyName" required>
            </div>
            <div class="form-group">
                <label for="fromAddress">Address:</label>
                <textarea class="form-control" id="fromAddress" required></textarea>
            </div>
            <div class="form-group">
                <label for="fromGst">GST:</label>
                <input type="text" class="form-control" id="fromGst" required>
            </div>
        </div>
        <div class="col-md-6">
            <p><strong>To:</strong></p>
            <div class="form-group">
                <label for="toPartyName">Party Name:</label>
                <input type="text" class="form-control" id="toPartyName" required oninput="fetchPartyDetails(this.value)">
                <button type="button" class="btn btn-primary" onclick="showAddNewModal()">+ Add New</button>
            </div>
            <div class="form-group">
                <label for="toAddress">Address:</label>
                <textarea class="form-control" id="toAddress" required></textarea>
            </div>
            <div class="form-group">
                <label for="toGst">GST:</label>
                <input type="text" class="form-control" id="toGst" required>
            </div>
        </div>
    </div>

    <table class="table table-bordered details">
        <thead class="thead-light">
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
        <tbody id="itemTable">
            <!-- Dynamic rows will be added here -->
        </tbody>
    </table>
    <button type="button" class="btn btn-primary btn-block" onclick="addItem()">Add Item</button>

    <div class="totals mt-4">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Total Amount</td>
                    <td id="totalAmount">0.00</td>
                </tr>
                <tr>
                    <td>SGST</td>
                    <td id="sgst">0.00</td>
                </tr>
                <tr>
                    <td>CGST</td>
                    <td id="cgst">0.00</td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td id="grandTotal">0.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="tax-details mt-4">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>SGST %</th>
                    <th>Value</th>
                    <th>CGST %</th>
                    <th>Value</th>
                    <th>Total Value</th>
                </tr>
            </thead>
            <tbody id="taxDetailsTable">
                <!-- Dynamic rows will be added here -->
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p><strong>Amount in Words:</strong> <span id="amountInWords">___________</span></p>
        <p>For (Company Name)</p>
        <p>Authorized Signatory</p>
    </div>

    <form id="invoiceForm" action="sales_insert.php" method="post">
        <input type="hidden" name="invoiceNo" id="hiddenInvoiceNo">
        <input type="hidden" name="invoiceDate" id="hiddenInvoiceDate">
        <input type="hidden" name="fromPartyName" id="hiddenFromPartyName">
        <input type="hidden" name="fromAddress" id="hiddenFromAddress">
        <input type="hidden" name="fromGst" id="hiddenFromGst">
        <input type="hidden" name="toPartyName" id="hiddenToPartyName">
        <input type="hidden" name="toAddress" id="hiddenToAddress">
        <input type="hidden" name="toGst" id="hiddenToGst">
        <input type="hidden" name="items" id="hiddenItems">
        <input type="hidden" name="totalAmount" id="hiddenTotalAmount">
        <input type="hidden" name="sgst" id="hiddenSgst">
        <input type="hidden" name="cgst" id="hiddenCgst">
        <input type="hidden" name="grandTotal" id="hiddenGrandTotal">
        <button type="button" class="btn btn-custom btn-block mt-3" onclick="submitForm()">Submit</button>
    </form>
</div>

<script>
    function addItem() {
        const itemTable = document.getElementById('itemTable');
        const rowCount = itemTable.rows.length;
        const row = itemTable.insertRow(rowCount);

        row.innerHTML = `
            <td>${rowCount + 1}</td>
            <td><input type="text" class="form-control description" required></td>
            <td><input type="text" class="form-control qty" value="1" oninput="updateTotals()" required></td>
            <td><input type="text" class="form-control unit" required></td>
            <td><input type="text" class="form-control hsnCode" required></td>
            <td><input type="text" class="form-control gst" value="18" oninput="updateTotals()" required></td>
            <td><input type="text" class="form-control unitPrice" value="0" oninput="updateTotals()" required></td>
            <td class="totalPrice">0.00</td>
        `;

        updateTotals();
    }

    function updateTotals() {
        const rows = document.querySelectorAll('#itemTable tr');
        let totalAmount = 0;
        let sgstTotal = 0;
        let cgstTotal = 0;

        rows.forEach(row => {
            const qty = row.querySelector('.qty').value;
            const gst = row.querySelector('.gst').value;
            const unitPrice = row.querySelector('.unitPrice').value;
            const totalPrice = qty * unitPrice;

            row.querySelector('.totalPrice').innerText = totalPrice.toFixed(2);
            totalAmount += totalPrice;

            const sgst = totalPrice * (gst / 2) / 100;
            const cgst = totalPrice * (gst / 2) / 100;

            sgstTotal += sgst;
            cgstTotal += cgst;
        });

        const grandTotal = totalAmount + sgstTotal + cgstTotal;

        document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);
        document.getElementById('sgst').innerText = sgstTotal.toFixed(2);
        document.getElementById('cgst').innerText = cgstTotal.toFixed(2);
        document.getElementById('grandTotal').innerText = grandTotal.toFixed(2);

        document.getElementById('amountInWords').innerText = numberToWords(Math.floor(grandTotal)) + ' only';

        updateTaxDetailsTable();
    }

    function updateTaxDetailsTable() {
        const taxDetailsTable = document.getElementById('taxDetailsTable');
        taxDetailsTable.innerHTML = '';

        const gstRates = [2.5, 6, 9, 14];
        const totals = gstRates.map(rate => ({
            rate: rate,
            sgstValue: 0,
            cgstValue: 0,
            totalValue: 0
        }));

        document.querySelectorAll('#itemTable tr').forEach(row => {
            const gst = parseFloat(row.querySelector('.gst').value);
            const totalPrice = parseFloat(row.querySelector('.totalPrice').innerText);

            totals.forEach(total => {
                if (total.rate === gst / 2) {
                    total.sgstValue += totalPrice * (total.rate / 100);
                    total.cgstValue += totalPrice * (total.rate / 100);
                    total.totalValue += totalPrice * (gst / 100);
                }
            });
        });

        totals.forEach(total => {
            const row = taxDetailsTable.insertRow();
            row.innerHTML = `
                <td>${total.rate}%</td>
                <td>${total.sgstValue.toFixed(2)}</td>
                <td>${total.rate}%</td>
                <td>${total.cgstValue.toFixed(2)}</td>
                <td>${total.totalValue.toFixed(2)}</td>
            `;
        });
    }

    function numberToWords(num) {
        const a = [
            '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        ];
        const b = [
            '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
        ];
        const g = [
            '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion'
        ];

        function group3Digits(num) {
            if (num < 20) return a[num];
            if (num < 100) return b[Math.floor(num / 10)] + (num % 10 !== 0 ? '-' + a[num % 10] : '');
            return a[Math.floor(num / 100)] + ' hundred' + (num % 100 !== 0 ? ' ' + group3Digits(num % 100) : '');
        }

        if (num === 0) return 'zero';
        if (num < 1000) return group3Digits(num);

        let str = '';
        let i = 0;
        while (num > 0) {
            let rem = num % 1000;
            if (rem > 0) {
                str = group3Digits(rem) + ' ' + g[i] + (str !== '' ? ' ' + str : '');
            }
            num = Math.floor(num / 1000);
            i++;
        }
        return str.trim();
    }

    function fetchPartyDetails(partyName) {
        if (partyName.length > 2) {
            fetch(`get_party_details.php?partyName=${partyName}`)
                .then(response => response.json())
                .then(data => {
                    if (data.address && data.gst) {
                        document.getElementById('toAddress').value = data.address;
                        document.getElementById('toGst').value = data.gst;
                    }
                })
                .catch(error => console.error('Error fetching party details:', error));
        }
    }

    function showAddNewModal() {
        // Display a modal or popup to enter new party details
        // For simplicity, let's use a prompt
        const partyName = prompt("Enter Party Name:");
        const address = prompt("Enter Address:");
        const gst = prompt("Enter GST:");

        if (partyName && address && gst) {
            addNewParty(partyName, address, gst);
        }
    }

    function addNewParty(partyName, address, gst) {
        const formData = new FormData();
        formData.append('partyName', partyName);
        formData.append('address', address);
        formData.append('gst', gst);

        fetch('add_party.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            // Assuming the party was added successfully, you can set the values directly
            document.getElementById('toPartyName').value = partyName;
            document.getElementById('toAddress').value = address;
            document.getElementById('toGst').value = gst;
        })
        .catch(error => console.error('Error adding party:', error));
    }

    function submitForm() {
        document.getElementById('hiddenInvoiceNo').value = document.getElementById('invoiceNo').value;
        document.getElementById('hiddenInvoiceDate').value = document.getElementById('invoiceDate').value;
        document.getElementById('hiddenFromPartyName').value = document.getElementById('fromPartyName').value;
        document.getElementById('hiddenFromAddress').value = document.getElementById('fromAddress').value;
        document.getElementById('hiddenFromGst').value = document.getElementById('fromGst').value;
        document.getElementById('hiddenToPartyName').value = document.getElementById('toPartyName').value;
        document.getElementById('hiddenToAddress').value = document.getElementById('toAddress').value;
        document.getElementById('hiddenToGst').value = document.getElementById('toGst').value;
        document.getElementById('hiddenTotalAmount').value = document.getElementById('totalAmount').innerText;
        document.getElementById('hiddenSgst').value = document.getElementById('sgst').innerText;
        document.getElementById('hiddenCgst').value = document.getElementById('cgst').innerText;
        document.getElementById('hiddenGrandTotal').value = document.getElementById('grandTotal').innerText;

        const items = [];
        document.querySelectorAll('#itemTable tr').forEach(row => {
            const item = {
                description: row.querySelector('.description').value,
                qty: row.querySelector('.qty').value,
                unit: row.querySelector('.unit').value,
                hsnCode: row.querySelector('.hsnCode').value,
                gst: row.querySelector('.gst').value,
                unitPrice: row.querySelector('.unitPrice').value,
                totalPrice: row.querySelector('.totalPrice').innerText
            };
            items.push(item);
        });

        document.getElementById('hiddenItems').value = JSON.stringify(items);
        document.getElementById('invoiceForm').submit();
    }
</script>


      
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>