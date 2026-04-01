<?php
include "../config/db.php";

if (isset($_POST['submit'])) {

    $supplier = $_POST['supplier'];
    $item = $_POST['item'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $total = $qty * $price;
    $invoice = $_FILES['invoice']['name'];
    $tmp = $_FILES['invoice']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/" . $invoice);

    $query = mysqli_query($conn, "INSERT INTO purchases 
(supplier,item,quantity,price,total,status,date,invoice)
VALUES 
('$supplier','$item','$qty','$price','$total','$status','$date','$invoice')");

    //  UPDATE INVENTORY
    $check = mysqli_query($conn, "SELECT * FROM inventory WHERE item_name='$item'");

    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE inventory SET quantity = quantity + $qty WHERE item_name='$item'");
    } else {
        mysqli_query($conn, "INSERT INTO inventory (item_name, quantity, price)
        VALUES ('$item','$qty','$price')");
    }

    if($query){

    // Generate invoice number
    $invoice = "INV-" . rand(1000,9999);

    // Insert into payments table
    mysqli_query($conn, "INSERT INTO payments (supplier, invoice_no, amount, status, due_date)
    VALUES ('$supplier','$invoice','$total','$status','$date')");

    // Redirect to payment tracker
    header("Location: track_payments.php");
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Billing &amp; Invoices - Hotel Mangalore International</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/billing.css">
</head>

<body>
    <div class="sidebar d-none d-md-flex flex-column position-fixed">
        <div class="px-4 mb-4 d-flex align-items-center gap-2">
            <div>
                <div class="fw-bold brand-color small text-uppercase">The Sovereign</div>
                <div class="text-muted" style="font-size: 10px;">Premium Concierge</div>
            </div>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" href="#"> Dashboard</a>
            <a class="nav-link" href="../billing/billing.php">Billing</a>
            <a class="nav-link" href="../inventory/inventory_dashboard.php">Inventory</a>
            <a class="nav-link" href="../supplier/supplier_directory.php"> Suppliers</a>
            <a class="nav-link" href="../purchase/create_order.php"> Purchases</a>
            <a class="nav-link" href="#">Reservations</a>
        </nav>
        <div class="mt-auto p-3 border-top">
            <button class="btn bg-brand w-100 mb-3 fw-bold">New Invoice</button>
            <a class="nav-link py-1 px-2 m-0 text-muted" href="#"><span class="material-symbols-outlined">help</span>
                Help Center</a>
            <a class="nav-link py-1 px-2 m-0 text-muted" href="#"><span class="material-symbols-outlined">logout</span>
                Logout</a>
        </div>
    </div>
    <header class="top-navbar fixed-top py-3 px-4 d-flex justify-content-between align-items-center">
        <h1 class="h5 fw-bold brand-color mb-0">Hotel Mangalore International</h1>
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-sm-block">
                <div class="small fw-bold">Admin Manager</div>
            </div>
        </div>
    </header>

    <div class="main-content">

        <div class="container-fluid">
            <a href="../supplier/supplier_directory.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to supplier directory
            </a>
            <a href="../supplier/track_payments.php" class="btn btn-primary">
                 Track Payments
            </a>
            <br><br>

            <form method="POST" enctype="multipart/form-data">
                <div class="row g-4">
                    <div class="col-lg-8">

                        <div class="card p-4 shadow-sm h-100 ">
                            <h5 class="mb-3">Transaction Details</h5>

                            <select name="supplier" class="form-control mb-3" required>
                                <option value="">Select Supplier</option>
                                <?php
                                $suppliers = mysqli_query($conn, "SELECT * FROM suppliers WHERE status='Active'");
                                while ($row = mysqli_fetch_assoc($suppliers)) {
                                    ?>
                                    <option value="<?php echo $row['name']; ?>">
                                        <?php echo $row['name']; ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <input type="text" name="item" class="form-control mb-3" placeholder="Item Name" required>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="number" name="quantity" id="qty" class="form-control"
                                        placeholder="Quantity" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Price" required>
                                </div>
                            </div>

                            <input type="date" name="date" class="form-control mt-3" required>
                        </div>

                    </div>

                    <!-- RIGHT SIDE -->
                    <div class="col-lg-4 d-flex flex-column gap-3">

                        <!-- TOTAL -->
                        <div class="card p-4 bg-primary text-white shadow-sm">
                            <h6>Total Cost</h6>
                            <h3 id="total">0</h3>
                        </div>

                        <!-- STOCK -->
                        <div class="card p-4 shadow-sm bg-warning">
                            <h6>Stock Insight</h6>
                            <p class="small mb-0">Purchase will increase inventory.</p>
                        </div>

                        <!-- QR -->
                        <div class="card p-4 shadow-sm text-center">
                            <i class="bi bi-qr-code-scan fs-1 text-muted"></i>
                            <p class="small mt-2">
                                Scan QR Code to auto-fill items
                            </p>
                            <div id="reader" style="width:100%;"></div>
                            <button type="button" class="btn btn-primary mt-2 w-100" onclick="startScanner()">
                                Start Scanner
                            </button>
                        </div>

                    </div>

                </div>

                <!-- ROW 2 (FULL WIDTH BELOW) -->
                <div class="row mt-4">
                    <div class="col-12">

                        <div class="card p-4 shadow-sm bg-dark text-white">
                            <h5 class="mb-3">Payment Status</h5>

                            <select name="status" class="form-control mb-3">
                                <option>Paid</option>
                                <option>Pending</option>
                            </select>

                            <!-- INVOICE -->
                            <div class="border rounded p-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Invoice Attachment</strong><br>
                                    <small class="text-muted">Upload supplier invoice</small>
                                </div>
                                <input type="file" name="invoice" class="form-control w-auto">
                            </div>

                        </div>

                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-success px-4" name="submit">Save Purchase</button>
                </div>

            </form>

        </div>

    </div>

    <!-- JS for total calculation -->
    <script>
        document.getElementById("qty").addEventListener("input", calc);
        document.getElementById("price").addEventListener("input", calc);

        function calc() {
            let q = parseFloat(document.getElementById("qty").value) || 0;
            let p = parseFloat(document.getElementById("price").value) || 0;
            document.getElementById("total").innerText = q * p;
        }
    </script>
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        function startScanner() {

            const html5QrCode = new Html5Qrcode("reader");

            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {

                    let cameraId = devices[0].id;

                    html5QrCode.start(
                        cameraId,
                        {
                            fps: 10,
                            qrbox: 250
                        },
                        qrCodeMessage => {
                            alert("Scanned: " + qrCodeMessage);

                            // Example: auto fill item
                            document.querySelector("input[name='item']").value = qrCodeMessage;

                            html5QrCode.stop();
                        },
                        errorMessage => {
                            console.log(errorMessage);
                        }
                    );

                }
            }).catch(err => {
                console.log(err);
            });
        }
    </script>
</body>

</html>