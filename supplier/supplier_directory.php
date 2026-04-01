<?php
include "../config/db.php";
$result = mysqli_query($conn, "SELECT * FROM suppliers");
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

       <div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="fw-bold">Supplier Directory</h3>
        <small class="text-muted">Manage your suppliers</small>
    </div>

    <!-- BUTTON GROUP -->
    <div class="d-flex gap-2">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Add Supplier
        </button>

        <a href="../supplier/record_purchase.php" class="btn btn-success">
            <i class="bi bi-cart-plus"></i> Record Purchase
        </a>
    </div>

</div>

        <input type="text" id="search" class="form-control mb-4 bg-white" placeholder="Search Supplier...">

        <div class="row">

            <div class="col-md-8">
                <div class="row">

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <div class="col-md-6 mb-4">
                            <div class="card p-3 shadow-sm bg-dark text-white">

                                <h5><i class="bi bi-person-circle"></i> <?php echo $row['name']; ?></h5>
                                <p class="text-muted"><?php echo $row['category']; ?></p>

                                <p><i class="bi bi-envelope-fill"></i> <b>Email:</b> <?php echo $row['email']; ?></p>
                                <p><i class="bi bi-phone-fill"></i> <b>Phone:</b> <?php echo $row['phone']; ?></p>
                                <p><i class="bi bi-fork-knife"></i><b>Supplies:</b> <?php echo $row['supplies']; ?></p>


                                <?php if ($row['status'] == "Active") { ?>
                                    <span class="badge bg-success">Active</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning text-dark">Inactive</span>
                                <?php } ?>

                                <!-- UPDATE STATUS -->
                                <form method="POST" action="update_status.php" class="d-flex align-items-center gap-1 mt-5">

                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                    <select name="status" class="form-select form-select-sm w-auto">
                                        <option value="Active" <?php if ($row['status'] == "Active")
                                            echo "selected"; ?>>
                                            Active</option>
                                        <option value="Inactive" <?php if ($row['status'] == "Inactive")
                                            echo "selected"; ?>>
                                            Inactive</option>
                                    </select>
                                    <button class="btn btn-primary btn-sm px-2 py-0">
                                        Update
                                    </button>

                                </form>

                                <!-- UPDATE ITEMS -->
                                <form method="POST" action="update_items.php" class="d-flex align-items-center gap-2 mt-2">

                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="text" name="supplies" class="form-control form-control-sm w-auto "
                                        style="max-width: 140px;" value="<?php echo $row['supplies']; ?>">

                                    <button class="btn btn-primary btn-sm px-2 py-0">
                                        Save
                                    </button>

                                </form>

                                <div class="text-end mt-2">
                                    <a href="delete_supplier.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this supplier?');">
                                        Delete
                                    </a>
                                </div>

                            </div>
                        </div>

                    <?php } ?>

                </div>

            </div>

            <div class="col-md-4">
                <div class="card p-4 shadow-sm mb-4 bg-warning">
                    <h6 class="fw-bold text-uppercase text-muted">Onboarding Status</h6>

                    <?php
                    $inactive = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM suppliers WHERE status='Inactive'"));
                    ?>

                    <?php if ($inactive['total'] == 0) { ?>
                        <span class="badge bg-success">All Verified</span>
                    <?php } else { ?>
                        <span class="badge bg-danger text-dark">Some Pending</span>
                    <?php } ?>

                    <p class="small text-muted mt-2">
                        Supplier remains draft until status is set to Active.
                    </p>
                </div>

                <div class="card p-4 shadow-sm mb-4 bg-warning text-dark">
                    <h6 class="fw-bold text-uppercase text-muted">Data Verification</h6>
                    <p class="small text-muted">
                        Email and supplier details are validated.
                    </p>
                </div>


                <div class="card shadow-sm p-3 bg-warning text-dark">
                    <?php
                    $latest = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM suppliers ORDER BY id DESC LIMIT 1"));
                    ?>
                    <h6 class="text-muted">Latest Supplier</h6>
                    <img src="../assets/images/supplier.jpg" class="img-fluid">

                    <?php if ($latest) { ?>
                        <p class="fw-bold mb-1">
                            <?php echo $latest['name']; ?>
                        </p>
                        <small class="text-muted">
                            <?php echo $latest['category']; ?>
                        </small>
                    <?php } else { ?>
                        <p class="text-muted">No suppliers added yet</p>
                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <form method="POST" action="add_supplier.php">

                    <div class="modal-header bg-dark text-white">
                        <h5>Add Supplier</h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="text" name="name" class="form-control mb-2 bg-warning" placeholder="Supplier Name"
                            required>

                        <input type="text" name="category" class="form-control mb-2 bg-warning" placeholder="Category">

                        <input type="email" name="email" class="form-control mb-2 bg-warning" placeholder="Email">

                        <input type="text" name="phone" class="form-control mb-2 bg-warning" placeholder="Phone">

                        <textarea name="address" class="form-control mb-2 bg-warning" placeholder="Address"></textarea>

                        <input type="text" name="supplies" class="form-control mb-2 bg-warning" placeholder="Supplies">

                        <select name="status" class="form-control bg-warning">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>

                    </div>

                    <div class="modal-footer bg-dark">
                        <button class="btn btn-success" name="submit">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById("search").addEventListener("keyup", function () {
            let value = this.value.toLowerCase();
            let cards = document.querySelectorAll(".card");

            cards.forEach(card => {
                card.style.display = card.innerText.toLowerCase().includes(value) ? "" : "none";
            });
        });
    </script>

</body>

</html>