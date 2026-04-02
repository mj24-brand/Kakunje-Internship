<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../config/db.php"; 

// Handle form submission
if (isset($_POST['po_id'], $_POST['receive_qty'])) {
    $po_id = (int) $_POST['po_id'];
    $receive_qty = (int) $_POST['receive_qty'];

    // Fetch PO info
    $po = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM po WHERE id=$po_id"));
    $item_name = $po['item_name'];

    // Update inventory
    $item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM inventory WHERE item_name='$item_name'"));
    if ($item) {
        mysqli_query($conn, "UPDATE inventory SET quantity = quantity + $receive_qty WHERE item_name='$item_name'");
    } else {
        mysqli_query($conn, "INSERT INTO inventory (item_name, quantity, image) VALUES ('$item_name', $receive_qty, 'placeholder.png')");
    }

    // Update PO received quantity
    $new_received = $po['received_qty'] + $receive_qty;
    mysqli_query($conn, "UPDATE po SET received_qty=$new_received WHERE id=$po_id");

    header("Location: receive_inventory.php");
    exit;
}

// Fetch POs that are not fully received
$po_list = mysqli_query($conn, "SELECT * FROM po WHERE quantity > received_qty ORDER BY created_at DESC");

// Fetch all inventory
$inventory = mysqli_query($conn, "SELECT * FROM inventory ORDER BY id ASC");

// Calculate summary
$total_expected = 0;
$total_received = 0;
$total_missing = 0;

$po_all = mysqli_query($conn, "SELECT * FROM po");
while ($po_item = mysqli_fetch_assoc($po_all)) {
    $total_expected += $po_item['quantity'];
    $total_received += $po_item['received_qty'];
    if ($po_item['received_qty'] < $po_item['quantity']) {
        $total_missing += ($po_item['quantity'] - $po_item['received_qty']);
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
        <h1 class="h5 fw-bold brand-color mb-0">Hotel Mangalore International - Premium Service Desk</h1>
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-sm-block">
                <div class="small fw-bold">Admin Manager</div>
            </div>
        </div>
    </header>

            <!-- Main content -->
            <div class="main-content container-fluid mt-2">
                 <a href="view_orders.php" class="btn btn-primary btn-sm">
                    ← View orders
                </a>
                <br><br>
                <h2>Receive Inventory</h2>
                <div class="row">
            <div class="col-md-6">
                        <?php if (mysqli_num_rows($po_list) > 0): ?>
                            <?php while ($po = mysqli_fetch_assoc($po_list)): ?>
                                <div class="card mb-3 shadow-sm border-primary">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $po['item_name'] ?> (PO #<?= $po['id'] ?>)</h5>
                                        <p>Supplier: <?= $po['supplier'] ?></p>
                                        <p>Qty Ordered: <?= $po['quantity'] ?> | Received: <?= $po['received_qty'] ?></p>
                                        <form method="POST">
                                            <input type="hidden" name="po_id" value="<?= $po['id'] ?>">
                                            <div class="mb-2">
                                                <input type="number" name="receive_qty" class="form-control input-qty"
                                                    placeholder="Qty received" required>
                                            </div>
                                            <button type="submit" class="btn btn-success w-100">Receive</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-muted">No pending POs to receive.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Inventory Cards -->
                    <div class="col-lg-8">
                        <div class="row">
                            <?php while ($item = mysqli_fetch_assoc($inventory)): ?>
                                <div class="col-md-6 mb-3">
                                    <div class="card shadow-sm p-3 d-flex align-items-center inventory-card">
                                        <img src="../assets/images/<?= $item['image'] ?>" alt="<?= $item['item_name'] ?>"
                                            width="60" height="60">
                                        <h6 class="card-title mb-1"><?= $item['item_name'] ?></h6>
                                        <p class="mb-0">Stock: <?= $item['quantity'] ?></p>
                                        <p class="mb-0">Price: ₹<?= $item['price'] ?></p>
                                        <p class="mb-0">Threshold: <?= $item['threshold'] ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <!-- Bottom Summary Cards -->
                        <div class="row mt-4">
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm summary-card p-3 bg-light">
                                    <h6>Total Expected</h6>
                                    <h3><?= $total_expected ?> Units</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm summary-card p-3 bg-light">
                                    <h6>Total Received</h6>
                                    <h3 class="text-success"><?= $total_received ?> Units</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm summary-card p-3 bg-light">
                                    <h6>Total Missing</h6>
                                    <h3 class="text-danger"><?= $total_missing ?> Units</h3>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>