<?php
include "../config/db.php";

$lowStockItems = mysqli_query($conn, "
    SELECT * FROM inventory 
    WHERE quantity < threshold
");

$totalLow = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM inventory 
    WHERE quantity < threshold
"))['total'];
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
    <div class="row">

        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <small class="text-muted text-uppercase">Stock Alert</small>
                    <h2 class="fw-bold text-danger">Low Stock Items</h2>
                </div>

                <a href="inventory_dashboard.php" class="btn btn-primary btn-sm">
                    ← Back to Dashboard
                </a>
            </div>

            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body text-danger fw-bold">
                    Low Stock Items: <?php echo $totalLow; ?>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">

                    <?php if(mysqli_num_rows($lowStockItems) > 0){ ?>

                    <table class="table table-hover align-middle">
                        <thead class="table-dark text-white">
                            <tr class="text-muted small text-uppercase">
                                <th>ID</th>
                                <th>Image</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Threshold</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($lowStockItems)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>

                                    <td>
                                        <img src="../assets/images/<?php echo $row['image']; ?>"
                                            width="50" height="50"
                                            style="object-fit:cover; border-radius:8px;">
                                    </td>

                                    <td class="fw-bold"><?php echo $row['item_name']; ?></td>

                                    <td class="text-danger fw-bold"><?php echo $row['quantity']; ?></td>

                                    <td><?php echo $row['threshold']; ?></td>

                                    <td>
                                        <span class="badge bg-danger">LOW</span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php } else { ?>
                        <div class="alert alert-success text-center">
                            ✅ No low stock items!
                        </div>
                    <?php } ?>

                </div>
            </div>

        </div>
        <div class="col-lg-4">

            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body bg-dark">
                    <h6 class="text-white">Low Stock Warnings</h6>
                    <h2 class="text-danger fw-bold"><?php echo $totalLow; ?></h2>
                    <p class="small text-white">
                        Items reaching critical level soon.
                    </p>
                    <button class="btn btn-danger w-100 btn-sm" data-bs-toggle="modal" data-bs-target="#reviewWarningsModal">Review Warnings</button>
                </div>
            </div>

            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body bg-dark">
                    <h6 class="text-white">Recommended Order</h6>

                    <?php
                    $valueData = mysqli_fetch_assoc(mysqli_query($conn, "
                        SELECT SUM((threshold - quantity) * price) as total 
                        FROM inventory 
                        WHERE quantity < threshold
                    "));
                    $recommendedValue = $valueData['total'] ?? 0;
                    ?>

                    <h3 class="fw-bold text-primary">
                        ₹ <?php echo number_format($recommendedValue); ?>
                    </h3>

                    <p class="small text-white">
                        Suggested restock investment
                    </p>

                   <button class="btn btn-outline-primary btn-sm w-100 bg-primary text-white" data-bs-toggle="modal" data-bs-target="#generateOrderModal">Generate Order</button>

                </div>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body bg-dark">
                    <h6 class="text-white"><i class="bi bi-exclamation-diamond"></i> Inventory Anomaly</h6>
                    <p class="fw-bold mb-1 text-white">Unusual usage detected</p>
                    <p class="small text-white">
                        Some items are selling faster than usual.
                    </p>
                    <button class="btn btn-warning btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investigateModal">Investigate</button>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="modal fade" id="reviewWarningsModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Low Stock Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <?php
        $res = mysqli_query($conn, "SELECT item_name FROM inventory WHERE quantity < threshold");

        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                echo "<p>⚠ ".$row['item_name']."</p>";
            }
        } else {
            echo "<p class='text-success'>No low stock</p>";
        }
        ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="generateOrderModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Order Suggestion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <?php
        $res = mysqli_query($conn, "SELECT item_name, (threshold - quantity) AS needed FROM inventory WHERE quantity < threshold");

        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                echo "<p>".$row['item_name']." → Order ".$row['needed']."</p>";
            }
        } else {
            echo "<p class='text-success'>No order needed</p>";
        }
        ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="investigateModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Inventory Check</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <?php
        $res = mysqli_query($conn, "SELECT item_name, quantity FROM inventory WHERE quantity <= 2");

        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res)){
                echo "<p>🔍 ".$row['item_name']." (Qty: ".$row['quantity'].")</p>";
            }
        } else {
            echo "<p class='text-success'>All items normal</p>";
        }
        ?>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>