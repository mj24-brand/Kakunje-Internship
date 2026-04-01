<?php include "../config/db.php"; 
$lastSale = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT s.*, i.item_name, i.quantity, i.image 
    FROM sales s 
    JOIN inventory i ON s.item_id = i.id 
    ORDER BY s.id DESC LIMIT 1
"));
$recentSales = mysqli_query($conn, "
    SELECT s.*, i.item_name 
    FROM sales s 
    JOIN inventory i ON s.item_id = i.id 
    ORDER BY s.id DESC LIMIT 5
");

$lowStock = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT COUNT(*) as total FROM inventory WHERE quantity < threshold
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
            <a class="nav-link py-1 px-2 m-0 text-muted" href="#">
               <i class="bi bi-info-circle-fill"></i> Help Center</a>
            <a class="nav-link py-1 px-2 m-0 text-muted" href="#">
              <i class="bi bi-box-arrow-right"></i>  Logout</a>
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
                <h2 class="fw-bold">Record Sale Unit</h2>
            </div>
            <div class="d-flex gap-2">
                <a href="add_inventory.php" class="btn btn-success btn-sm">
                    <i class="bi bi-plus"></i> Add Item
                </a>

                <a href="inventory_dashboard.php" class="btn btn-primary btn-sm">
                    Dashboard
                </a>

                <a href="low_stock.php" class="btn btn-warning btn-sm">
                    <i class="bi bi-exclamation-diamond"></i> Low Stock
                </a>
            </div>
        </div>
<div class="container mt-5">
    <div class="row">

        <div class="col-md-8">
            <div class="card shadow p-4">
                <h3 class="mb-4">💰 Record Sale</h3>

                <form action="process_sale.php" method="POST">

                    <div class="mb-3">
                        <label>Select Item</label>
                        <select name="item_id" id="item" class="form-control" required onchange="getItemDetails()">
                            <option value="">-- Select Item --</option>

                            <?php
                            $items = mysqli_query($conn, "SELECT * FROM inventory");
                            while($row = mysqli_fetch_assoc($items)){
                                echo "<option value='{$row['id']}' 
                                        data-price='{$row['price']}' 
                                        data-qty='{$row['quantity']}'>
                                        {$row['item_name']}
                                      </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Available Stock</label>
                        <input type="text" id="stock" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Unit Price</label>
                        <input type="text" id="price" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Quantity Sold</label>
                        <input type="number" name="qty" id="qty" class="form-control" required min="1" onkeyup="calculateTotal()">
                    </div>

                    <div class="mb-3">
                        <label>Total</label>
                        <input type="text" id="total" class="form-control" readonly>
                    </div>

                    <button class="btn btn-danger w-100">Confirm Sale</button>
                </form>
            </div>
        </div>
       
        <div class="col-md-4">
            <div class="card shadow p-3 mb-3 bg-dark">
                <h6 class="text-white">Live Status</h6>

                <?php if($lastSale){ ?>
                    <div class="alert alert-success mt-2">
                        ✅ Sale Successful <br>
                        <small><?php echo $lastSale['item_name']; ?> updated</small>
                    </div>
                <?php } ?>

                <?php if($lowStock > 0){ ?>
                    <div class="alert alert-danger">
                        ⚠️ <?php echo $lowStock; ?> items below stock
                    </div>
                <?php } ?>
            </div>

            <div class="card shadow p-3 bg-dark">
                <h6 class="text-white">Last Scanned Item</h6>

                <?php if($lastSale){ ?>
                    <h5 class="text-white"><?php echo $lastSale['item_name']; ?></h5>
                    <p class="text-white">Qty Sold: <?php echo $lastSale['quantity']; ?></p>

                    <img src="../assets/images/<?php echo $lastSale['image']; ?>" 
                         width="70" class="rounded">
                <?php } else { ?>
                    <p class="text-white">No sales yet</p>
                <?php } ?>

            </div>

        </div>

    </div>
</div>
</div>
<div class="container mt-4" style="margin-left: 260px; max-width: 800px;">
    
    <div class="card shadow-sm mx-auto">
        <div class="card-body bg-dark">
            <h5 class="text-center text-white mb-3">Recent Sales</h5>

            <table class="table table-sm table-bordered mt-2 text-center">
                <thead class="table-light">
                    <tr>
                        <th>Time</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_assoc($recentSales)){ ?>
                        <tr>
                            <td><?php echo date("H:i", strtotime($row['created_at'])); ?></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>₹ <?php echo $row['total']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<script>
function getItemDetails() {
    let select = document.getElementById("item");
    let option = select.options[select.selectedIndex];

    let price = option.getAttribute("data-price");
    let qty = option.getAttribute("data-qty");

    document.getElementById("price").value = price;
    document.getElementById("stock").value = qty;
}

function calculateTotal() {
    let price = document.getElementById("price").value;
    let qty = document.getElementById("qty").value;

    document.getElementById("total").value = price * qty;
}
</script>

</body>
</html>