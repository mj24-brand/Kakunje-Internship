<?php
include "../config/db.php";
$result = mysqli_query($conn, "SELECT * FROM inventory");
$totalItems = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM inventory"))['total'];
$available = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM inventory WHERE quantity > 0"))['total'];
$lowStock = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM inventory WHERE quantity < threshold"))['total'];
$valueData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(quantity * price) as total FROM inventory"));
$totalValue = $valueData['total'] ?? 0;
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
                <h2 class="fw-bold">Inventory Dashboard</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="add_inventory.php" class="btn btn-success btn-sm">
                    <i class="bi bi-plus"></i> Add Item
                </a>

                <a href="record_sale.php" class="btn btn-danger btn-sm">
                    <i class="bi bi-wallet-fill"></i> Record Sale
                </a>

                <a href="low_stock.php" class="btn btn-warning btn-sm">
                    <i class="bi bi-exclamation-diamond"></i> Low Stock
                </a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card-box">Total Items
                    <h5>
                        <?php echo $totalItems; ?>
                    </h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box">Available
                    <h5>
                        <?php echo $available; ?>
                    </h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box text-danger">Low Stock
                    <h5>
                        <?php echo $lowStock; ?>
                    </h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box text-primary">Value
                    <h5>₹
                        <?php echo $totalValue; ?>
                    </h5>
                </div>
            </div>
        </div>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">

                <table class="table table-hover align-middle ">
                    <thead class="table-dark text-white">
                        <tr class="text-muted small text-uppercase">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                    <img src="../assets/images/<?php echo $row['image']; ?>" width="50" height="50"
                                        style="object-fit:cover; border-radius:8px;">
                                </td>

                                <td class="fw-bold">
                                    <?php echo $row['item_name']; ?>
                                </td>

                                <td><?php echo $row['quantity']; ?></td>

                                <td>₹ <?php echo $row['price']; ?></td>

                                <td>
                                    <?php
                                    if ($row['quantity'] < $row['threshold']) {
                                        echo "<span class='badge bg-danger'>LOW</span>";
                                    } else {
                                        echo "<span class='badge bg-success'>IN STOCK</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>

            </div>
        </div>

    </div>

</body>

</html>