<?php
include "../config/db.php";

$id = $_GET['id'] ?? 0;

if(isset($_POST['status'])){

    $status = $_POST['status'];

    mysqli_query($conn,"UPDATE orders SET order_status='$status' WHERE id='$id'");

    header("Location: manage_orders.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="../assets/style.css" rel="stylesheet">
    <style>
body{
    min-height:100vh;
    background: linear-gradient( #e44d5e, #91e96e);
}
</style>

<body>

    <header class="header d-flex align-items-center p-3">

        <h3 class="mx-auto">ORDERS</h3>

        <div>
            <a href="order_details.php" class="btn btn-success btn-sm me-2">Order Details</a>
            <a href="manage_orders.php" class="btn btn-success btn-sm me-2">Orders</a>
        </div>

    </header>
    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar">

            <h2 class="logo"><i class="bi bi-book"></i> BookStore</h2>

            <br><br>

            <ul>

                <li><i class="bi bi-speedometer2"></i> <a href="dashboard.php"> Dashboard</a></li>

                <li><i class="bi bi-book"></i><a href="add_book.php"> Products</a></li>

                <li><i class="bi bi-tags"></i> <a href="add_type.php"> Categories</a></li>

                <li><i class="bi bi-bag"></i> <a href="manage_orders.php"> Orders</a></li>

                <li><i class="bi bi-people"></i><a href="view_users.php"> Users</a></li>

                <li><i class="bi bi-box-arrow-right"></i><a href="Login.php"> Logout</a></li>

            </ul>

        </div>

<div class="flex-grow-1 d-flex justify-content-center align-items-start mt-5">
        <div class="card shadow p-4 content-card" style="width: 400px;">
            <h2 class="text-center mb-4">Update Order Status</h2>

            <form method="POST">
                <div class="mb-3">
                    <select name="status" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>