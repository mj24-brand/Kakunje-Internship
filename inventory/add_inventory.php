<?php
include "../config/db.php";

if (isset($_POST['submit'])) {

    $name = $_POST['item_name'];
    $qty = $_POST['quantity'];
    $price = $_POST['price'];
    $threshold = $_POST['threshold'];
    $imageName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];
    $folder = "../assets/images/" . $imageName;
    move_uploaded_file($tempName, $folder);
    $query = "INSERT INTO inventory (item_name, quantity, price, threshold, image)
          VALUES ('$name','$qty','$price','$threshold','$imageName')";

    mysqli_query($conn, $query);

    echo "<script>alert('Item Added Successfully'); window.location.href='inventory_dashboard.php';</script>";
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/billing.css">
</head>

<body>
    <div class="sidebar d-none d-md-flex flex-column">
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
            <a class="nav-link" href="../reservation/reservation.php">Reservations</a>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <small class="text-muted text-uppercase">Stock Engine</small>
                <h2 class="fw-bold"> Add Inventory Item</h2>
                <p>Initialize a new product entry in the professional ledger. Ensure all metadata is accurate for
                    real-time audit tracking.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="inventory_dashboard.php" class="btn btn-primary btn-sm">
                    Dashboard
                </a>

                <a href="record_sale.php" class="btn btn-danger btn-sm">
                    <i class="bi bi-wallet-fill"></i> Record Sale
                </a>

                <a href="low_stock.php" class="btn btn-warning btn-sm">
                    <i class="bi bi-exclamation-diamond"></i> Low Stock
                </a>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card shadow rounded-4">
                        <div class="card-body p-4">

                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Item Name</label>
                                    <input type="text" name="item_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload Image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Low Stock Threshold</label>
                                    <input type="range" name="threshold" min="0" max="100" value="10"
                                        class="form-range">
                                    <small id="val" class="text-muted">10</small>
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        Add Item
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            let slider = document.querySelector("[name='threshold']");
            let output = document.getElementById("val");

            output.innerHTML = slider.value;

            slider.oninput = function () {
                output.innerHTML = this.value;
            }
        </script>

</body>

</html>