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
        .add-party {
            cursor: pointer;
            color: #0d6efd;
        }
        .total-amount, .totalCGST, .totalSGST {
            margin-top: 20px;
        }
        .party-details {
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
      
    <div class="container mt-5">
    <h1 class="mb-4">Purchase Bill</h1>
    <form id="purchaseForm" onsubmit="submitData(event)">
        <div class="mb-3 row">
            <label for="purchaseBillNo" class="col-sm-2 col-form-label">Purchase Bill No:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="purchaseBillNo">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="supplierInvoiceNo" class="col-sm-2 col-form-label">Supplier Invoice No:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="supplierInvoiceNo">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="purchaseDate" class="col-sm-2 col-form-label">Date:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="purchaseDate">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="partyName" class="col-sm-2 col-form-label">Party Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="partyName" oninput="fetchPartyDetails()">
                <span class="add-party" onclick="showPartyDetails()">+ Add New</span>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="partyAddress" class="col-sm-2 col-form-label">Party Address:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="partyAddress" disabled>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="partyGST" class="col-sm-2 col-form-label">Party GST:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="partyGST" disabled>
            </div>
        </div>
        <div class="party-details" id="partyDetails" style="display:none;">
            <div class="mb-3 row">
                <label for="partyNameDetails" class="col-sm-2 col-form-label">Party Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="partyNameDetails">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="partyAddressDetails" class="col-sm-2 col-form-label">Address:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="partyAddressDetails">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="partyGSTDetails" class="col-sm-2 col-form-label">GST:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="partyGSTDetails">
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="savePartyDetails()">Save</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="itemTable">
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>HSN Code</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><input type="text" class="form-control description" oninput="calculateRowTotal(this)"></td>
                        <td><input type="text" class="form-control qty" oninput="calculateRowTotal(this)"></td>
                        <td><input type="text" class="form-control unit"></td>
                        <td><input type="text" class="form-control code"></td>
                        <td><input type="text" class="form-control price" oninput="calculateRowTotal(this)"></td>
                        <td><input type="number" class="form-control total_price" readonly></td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-secondary mb-4" onclick="addRow()">Add Item</button>
        <div class="total-amount">
            <div class="mb-3 row">
                <label for="totalAmount" class="col-sm-2 col-form-label">Total Amount:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="totalAmount" readonly>
                </div>
            </div>
        </div>
        <h3>Tax Details:</h3>
        <div class="table-responsive">
            <table class="table table-bordered" id="taxTable">
                <thead>
                    <tr>
                        <th>SL No</th>
                        <th>CGST</th>
                        <th>VALUE</th>
                        <th>SGST</th>
                        <th>VALUE</th>
                        <th>TOTAL VALUE</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><input type="text" class="form-control cgst" oninput="calculateTaxTotal(this)"></td>
                        <td><input type="text" class="form-control cgst_value" oninput="calculateTaxTotal(this)"></td>
                        <td><input type="text" class="form-control sgst" oninput="calculateTaxTotal(this)"></td>
                        <td><input type="text" class="form-control sgst_value" oninput="calculateTaxTotal(this)"></td>
                        <td><input type="number" class="form-control total_value" readonly></td>
                        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-secondary mb-4" onclick="addTaxRow()">Add Tax</button>
        <div class="totalCGST mb-3 row">
            <label for="totalCGST" class="col-sm-2 col-form-label">Total CGST:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="totalCGST" readonly>
            </div>
        </div>
        <div class="totalSGST mb-3 row">
            <label for="totalSGST" class="col-sm-2 col-form-label">Total SGST:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="totalSGST" readonly>
            </div>
        </div>
        <div class="total-amount mb-3 row">
            <label for="grandTotal" class="col-sm-2 col-form-label">Grand Total:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="grandTotal" readonly>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    function showPartyDetails() {
        document.getElementById('partyDetails').style.display = 'block';
    }

    function savePartyDetails() {
        const partyName = document.getElementById('partyNameDetails').value;
        const partyAddress = document.getElementById('partyAddressDetails').value;
        const partyGST = document.getElementById('partyGSTDetails').value;

        fetch('save_party.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ partyName, partyAddress, partyGST })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                document.getElementById('partyName').value = partyName;
                document.getElementById('partyAddress').value = partyAddress;
                document.getElementById('partyGST').value = partyGST;
                document.getElementById('partyDetails').style.display = 'none';
            } else {
                alert('Error: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function fetchPartyDetails() {
        const partyName = document.getElementById('partyName').value;

        fetch('fetch_party.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ partyName })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success && result.party) {
                document.getElementById('partyAddress').value = result.party.address;
                document.getElementById('partyGST').value = result.party.gst;
            } else {
                document.getElementById('partyAddress').value = '';
                document.getElementById('partyGST').value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function addRow() {
        const table = document.getElementById('itemTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <td></td>
            <td><input type="text" class="form-control description" oninput="calculateRowTotal(this)"></td>
            <td><input type="number" class="form-control qty" oninput="calculateRowTotal(this)"></td>
            <td><input type="text" class="form-control unit"></td>
            <td><input type="text" class="form-control code"></td>
            <td><input type="number" class="form-control price" oninput="calculateRowTotal(this)"></td>
            <td><input type="number" class="form-control total_price" readonly></td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
        updateSerialNumbers('itemTable');
    }

    function addTaxRow() {
        const table = document.getElementById('taxTable').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <td></td>
            <td><input type="text" class="form-control cgst" oninput="calculateTaxTotal(this)"></td>
            <td><input type="number" class="form-control cgst_value" oninput="calculateTaxTotal(this)"></td>
            <td><input type="text" class="form-control sgst" oninput="calculateTaxTotal(this)"></td>
            <td><input type="number" class="form-control sgst_value" oninput="calculateTaxTotal(this)"></td>
            <td><input type="number" class="form-control total_value" readonly></td>
            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
        updateSerialNumbers('taxTable');
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateSerialNumbers(row.parentNode.parentNode.id);
        calculateTotalAmount();
        calculateGrandTotal();
    }

    function updateSerialNumbers(tableId) {
        const table = document.getElementById(tableId);
        const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            rows[i].cells[0].textContent = i + 1;
        }
    }

    function calculateRowTotal(input) {
        const row = input.parentNode.parentNode;
        const qty = parseFloat(row.querySelector('.qty').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        const total = qty * price;
        row.querySelector('.total_price').value = total.toFixed(2);
        calculateTotalAmount();
    }

    function calculateTotalAmount() {
        let totalAmount = 0;
        document.querySelectorAll('#itemTable .total_price').forEach(function(input) {
            totalAmount += parseFloat(input.value) || 0;
        });
        document.getElementById('totalAmount').value = totalAmount.toFixed(2);
        calculateGrandTotal();
    }

    function calculateTaxTotal(input) {
        const row = input.parentNode.parentNode;
        const cgstValue = parseFloat(row.querySelector('.cgst_value').value) || 0;
        const sgstValue = parseFloat(row.querySelector('.sgst_value').value) || 0;
        const totalValue = cgstValue + sgstValue;
        row.querySelector('.total_value').value = totalValue.toFixed(2);
        calculateTotalCGST();
        calculateTotalSGST();
    }

    function calculateTotalCGST() {
        let totalCGST = 0;
        document.querySelectorAll('#taxTable .cgst_value').forEach(function(input) {
            totalCGST += parseFloat(input.value) || 0;
        });
        document.getElementById('totalCGST').value = totalCGST.toFixed(2);
        calculateGrandTotal();
    }

    function calculateTotalSGST() {
        let totalSGST = 0;
        document.querySelectorAll('#taxTable .sgst_value').forEach(function(input) {
            totalSGST += parseFloat(input.value) || 0;
        });
        document.getElementById('totalSGST').value = totalSGST.toFixed(2);
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        const totalAmount = parseFloat(document.getElementById('totalAmount').value) || 0;
        const totalCGST = parseFloat(document.getElementById('totalCGST').value) || 0;
        const totalSGST = parseFloat(document.getElementById('totalSGST').value) || 0;
        const grandTotal = totalAmount + totalCGST + totalSGST;
        document.getElementById('grandTotal').value = grandTotal.toFixed(2);
    }

    function submitData(event) {
        event.preventDefault();

        const purchaseBillNo = document.getElementById('purchaseBillNo').value;
        const supplierInvoiceNo = document.getElementById('supplierInvoiceNo').value;
        const purchaseDate = document.getElementById('purchaseDate').value;
        const partyName = document.getElementById('partyName').value;
        const partyAddress = document.getElementById('partyAddress').value;
        const partyGST = document.getElementById('partyGST').value;
        const totalAmount = document.getElementById('totalAmount').value;
        const totalCGST = document.getElementById('totalCGST').value;
        const totalSGST = document.getElementById('totalSGST').value;
        const grandTotal = document.getElementById('grandTotal').value;

        const items = [];
        document.querySelectorAll('#itemTable tbody tr').forEach(function(row) {
            const description = row.querySelector('.description').value;
            const qty = row.querySelector('.qty').value;
            const unit = row.querySelector('.unit').value;
            const code = row.querySelector('.code').value;
            const price = row.querySelector('.price').value;
            const total_price = row.querySelector('.total_price').value;

            items.push({ description, qty, unit, code, price, total_price });
        });

        const taxes = [];
        document.querySelectorAll('#taxTable tbody tr').forEach(function(row) {
            const cgst = row.querySelector('.cgst').value;
            const cgst_value = row.querySelector('.cgst_value').value;
            const sgst = row.querySelector('.sgst').value;
            const sgst_value = row.querySelector('.sgst_value').value;
            const total_value = row.querySelector('.total_value').value;

            taxes.push({ cgst, cgst_value, sgst, sgst_value, total_value });
        });

        const data = {
            purchaseBillNo, supplierInvoiceNo, purchaseDate, partyName, partyAddress, partyGST, totalAmount, totalCGST, totalSGST, grandTotal, items, taxes
        };

        fetch('save_purchase.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                window.location.href = 'display_purchase.php';
            } else {
                alert('Error: ' + result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
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

