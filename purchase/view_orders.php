<?php include "../config/db.php"; ?>

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
        <h1 class="h5 fw-bold brand-color mb-0">Hotel Mangalore International - Premium Service Desk</h1>
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-sm-block">
                <div class="small fw-bold">Admin Manager</div>
            </div>
        </div>
    </header>

    <div class="main-content container-fluid mt-2">
        <a href="create_order.php" class="btn btn-success btn-sm">
            ← Back to create order
        </a>
        <br><br>


        <div class="row">
            <div class="col-md-6">
                <h2>Orders List</h2>
                <table class="table table-bordered mt-3">
                    <tr>
                        <th class="bg-dark text-white">ID</th>
                        <th class="bg-dark text-white">Supplier</th>
                        <th class="bg-dark text-white">Item</th>
                        <th class="bg-dark text-white">Qty</th>
                        <th class="bg-dark text-white">Received Qty</th>
                        <th class="bg-dark text-white">Price</th>
                        <th class="bg-dark text-white">Total</th>
                    </tr>

                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM po ORDER BY created_at DESC");
                    $totalOrders = 0;
                    $totalQty = 0;
                    $totalReceived = 0;
                    $totalCost = 0;
                    $supplierCount = [];

                    while ($row = mysqli_fetch_assoc($res)) {
                        $total = $row['price'] * $row['quantity']; // total for that PO
                    
                        echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['supplier']}</td>
                    <td>{$row['item_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['received_qty']}</td>
                    <td>₹{$row['price']}</td>
                    <td>₹{$total}</td>
                  </tr>";

                        // summary calculations
                        $totalOrders++;
                        $totalQty += $row['quantity'];
                        $totalReceived += $row['received_qty'];
                        $totalCost += $total;

                        $supplierCount[$row['supplier']] = ($supplierCount[$row['supplier']] ?? 0) + 1;
                    }

                    arsort($supplierCount);
                    $topSupplier = key($supplierCount);
                    ?>
                </table>
            </div>

            <div class="col-md-5">

                <div class="card mb-3 shadow-sm text-center bg-danger" style="max-width:400px">
                    <div class="card-body">
                        <h6>Total Orders</h6>
                        <p class="fs-4 fw-bold"><?= $totalOrders ?></p>
                    </div>
                </div>

                <div class="card mb-3 shadow-sm text-center bg-warning" style="max-width:400px">
                    <div class="card-body">
                        <h6>Total Quantity</h6>
                        <p class="fs-4 fw-bold"><?= $totalQty ?></p>
                    </div>
                </div>

                <div class="card mb-3 shadow-sm text-center bg-danger" style="max-width:400px">
                    <div class="card-body">
                        <h6>Total Cost</h6>
                        <p class="fs-4 fw-bold">₹<?= number_format($totalCost, 2) ?></p>
                    </div>
                </div>

                <div class="card mb-3 shadow-sm text-center bg-warning" style="max-width:400px">
                    <div class="card-body">
                        <h6>Top Supplier</h6>
                        <p class="fs-4 fw-bold"><?= $topSupplier ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>