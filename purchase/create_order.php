<?php
include "../config/db.php";

$suppliers = mysqli_query($conn, "SELECT * FROM suppliers");
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
        
         <a href="receive_inventory.php" class="btn btn-primary btn-sm ml-200px">
                    Receive Inventory
                </a>
                <br><br>

        <div class="row">
            <div class="col-md-6">

                <h2 class="mb-4">Create Purchase Order</h2>

                <div class="card p-4 shadow-sm">

                    <form id="orderForm" action="save_order.php" method="POST">

                        <div class="mb-3">
                            <label>Supplier</label>
                            <select name="supplier" class="form-control">
                                <option value="">Select Supplier</option>

                                <?php while ($row = mysqli_fetch_assoc($suppliers)) { ?>
                                    <option value="<?php echo $row['name']; ?>">
                                        <?php echo $row['name']; ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>

                        <button type="button" class="btn btn-success mb-3" onclick="addRow()">+ Add Item</button>
                        <table class="table table-bordered" id="orderTable">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th width="120">Qty</th>
                                    <th width="150">Price</th>
                                    <th width="150">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><input type="text" name="item[]" class="form-control"></td>
                                    <td><input type="number" name="qty[]" class="form-control qty" value="1"></td>
                                    <td><input type="number" name="price[]" class="form-control price" value="0"></td>
                                    <td><input type="text" name="total[]" class="form-control total" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mb-3 mt-3">
                            <label class="form-label">Instructions</label>
                            <textarea name="instructions" class="form-control" rows="3"
                                placeholder="Enter delivery instructions..."></textarea>
                        </div>

                    </form>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 mb-3 shadow-sm bg-warning">

                    <h5>Order Summary</h5>

                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span id="subtotal">₹0</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Tax (10%)</span>
                        <span id="tax">₹0</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Delivery</span>
                        <span id="delivery">₹50</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span id="grandTotal">₹0</span>
                    </div>

                </div>

                <div class="alert alert-warning">
                    <strong>Budget Alert:</strong><br>
                    <span id="budgetText">0% used</span>
                </div>


                <div class="card p-3 mb-3 shadow-sm bg-dark text-white">
                    <h6>Quick Actions</h6>

                    <button onclick="printPage()" class="btn btn-light w-100 mb-2"><i class="bi bi-printer-fill"></i>
                        Print</button>
                    <button onclick="sharePage()" class="btn btn-light w-100"><i class="bi bi-share-fill"></i>
                        Share</button>
                </div>

                <button type="button" onclick="submitForm()" class="btn btn-success w-100">
                    Generate Order
                </button>

            </div>

        </div>

    </div>

    <script>
        function calculateTotal() {
            let qty = document.getElementById("qty").value;
            let price = document.getElementById("price").value;

            let total = qty * price;
            document.getElementById("total").value = total;
        }

        document.addEventListener("input", function (e) {

            if (e.target.classList.contains("qty") || e.target.classList.contains("price")) {

                let row = e.target.closest("tr");

                calculateRow(row);
                calculateAll();
            }

        });
    </script>
    <script>
        function calculateRow(row) {
            let qty = row.querySelector(".qty").value || 0;
            let price = row.querySelector(".price").value || 0;

            let total = qty * price;
            row.querySelector(".total").value = total;

            return total;
        }

        function calculateAll() {
            let rows = document.querySelectorAll("#orderTable tbody tr");

            let subtotal = 0;

            rows.forEach(row => {
                subtotal += calculateRow(row);
            });

            let tax = subtotal * 0.10;
            let delivery = subtotal > 2000 ? 0 : 50;
            let grandTotal = subtotal + tax + delivery;

            document.getElementById("subtotal").innerText = "₹" + subtotal.toFixed(2);
            document.getElementById("tax").innerText = "₹" + tax.toFixed(2);
            document.getElementById("grandTotal").innerText = "₹" + grandTotal.toFixed(2);

            let monthlyBudget = 20000;
            let percent = (grandTotal / monthlyBudget) * 100;

            document.getElementById("budgetText").innerText =
                percent.toFixed(1) + "% of budget used";

            let alertBox = document.querySelector(".alert");

            if (percent > 80) {
                alertBox.className = "alert alert-danger";
            } else if (percent > 50) {
                alertBox.className = "alert alert-warning";
            } else {
                alertBox.className = "alert alert-success";
            }
        }
        calculateAll();
        function addRow() {
            let table = document.querySelector("#orderTable tbody");

            let newRow = `
        <tr>
            <td><input type="text" name="item[]" class="form-control"></td>
            <td><input type="number" name="qty[]" class="form-control qty" value="1"></td>
            <td><input type="number" name="price[]" class="form-control price" value="0"></td>
            <td><input type="text" name="total[]" class="form-control total" readonly></td>
        </tr>
    `;

            table.insertAdjacentHTML("beforeend", newRow);
        }
        function printPage() {
            window.print();
        }
        function sharePage() {

            if (navigator.share) {
                navigator.share({
                    title: "Purchase Order",
                    text: "Check this order",
                    url: window.location.href
                });
            } else {
                alert("Sharing not supported on this device");
            }
        }
        function submitForm() {
            document.getElementById("orderForm").submit();
        }
    </script>

</body>

</html>