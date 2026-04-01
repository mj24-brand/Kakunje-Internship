<?php
include "../config/db.php";
$result = mysqli_query($conn, "SELECT * FROM payments ORDER BY id DESC");
$total_payable = mysqli_fetch_assoc(mysqli_query($conn, 
"SELECT SUM(amount) as total FROM payments"));

$pending = mysqli_fetch_assoc(mysqli_query($conn, 
"SELECT SUM(amount) as total FROM payments WHERE status='Pending'"));

$paid = mysqli_fetch_assoc(mysqli_query($conn, 
"SELECT SUM(amount) as total FROM payments WHERE status='Paid'"));
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

<div class="container-fluid" style="margin-left:260px;margin-top:70px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>💰 Payment Tracker</h2>
        <div class="d-flex gap-2">
        <a href="../supplier/record_purchase.php" class="btn btn-primary">
            + New Purchase
        </a>
        <a href="../supplier/supplier_directory.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to supplier directory
            </a>
            </div>
    </div>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card p-3 summary-card shadow-sm">
                <h6>Total Payable</h6>
                <h3>₹<?php echo $total_payable['total'] ?? 0; ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 pending-card shadow-sm">
                <h6>Pending Payments</h6>
                <h3>₹<?php echo $pending['total'] ?? 0; ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 paid-card shadow-sm">
                <h6>Paid Amount</h6>
                <h3>₹<?php echo $paid['total'] ?? 0; ?></h3>
            </div>
        </div>

    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Recent Transactions</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Supplier</th>
                        <th>Invoice</th>
                        <th>Due Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($row = mysqli_fetch_assoc($result)) { 

                    $today = date("Y-m-d");

                    // Overdue logic
                    if($row['status']=="Pending" && $row['due_date'] < $today){
                        $status = "Overdue";
                    } else {
                        $status = $row['status'];
                    }
                ?>

                    <tr>
                        <td><?php echo $row['supplier']; ?></td>

                        <td><?php echo $row['invoice_no']; ?></td>

                        <td><?php echo $row['due_date']; ?></td>

                        <td>₹<?php echo $row['amount']; ?></td>

                        <td>
                            <?php if($status=="Paid"){ ?>
                                <span class="badge bg-success">Paid</span>

                            <?php } elseif($status=="Pending"){ ?>
                                <span class="badge bg-warning text-dark">Pending</span>

                            <?php } else { ?>
                                <span class="badge bg-danger">Overdue</span>
                            <?php } ?>
                        </td>

                        <td>
                            <?php if($status!="Paid"){ ?>
                                <a href="mark_paid.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-sm btn-success">
                                   Mark Paid
                                </a>
                            <?php } else { ?>
                                <span class="text-muted">Done</span>
                            <?php } ?>
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