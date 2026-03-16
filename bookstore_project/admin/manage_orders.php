<?php
include "../config/db.php";

// Fetch all orders
$orders_result = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="../assets/style.css" rel="stylesheet">

    <style>
        body{
            min-height:100vh;
            background: linear-gradient( #e44d5e, #509beb);
            color: #fff;
        }

        /* Main content */
        .main-content {
            margin-left: 240px; /* sidebar width */
            padding: 20px;
        }

        /* Cards */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }

        .order-card {
            background: #ffffffdd;
            color: #000;
            border-radius: 12px;
            padding: 20px;
            width: 280px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }
        .order-card:hover {
            transform: translateY(-5px);
        }
        .order-card h5 {
            margin-bottom: 10px;
        }
        .order-card p {
            margin: 4px 0;
            font-size: 0.9rem;
        }
        .order-card .btn {
            margin-top: 10px;
            width: 48%;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header d-flex align-items-center p-3">
        <h3 class="mx-auto">ORDERS</h3>
        <div>
            <a href="update_order.php" class="btn btn-success btn-sm me-2">Update Details</a>
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

        <!-- Main Content -->
        <div class="main-content">
            <h3 class="mb-4">ORDERS</h3>
            <div class="card-container">

                <?php
                if(mysqli_num_rows($orders_result) > 0){
                    while($order = mysqli_fetch_assoc($orders_result)){
                        $order_id = $order['id'];
                        $total_query = mysqli_query($conn, "
                            SELECT SUM(quantity * price) as total
                            FROM order_items
                            WHERE order_id = '$order_id'
                        ");
                        $total_row = mysqli_fetch_assoc($total_query);
                        $total_amount = $total_row['total'] ?? 0;
                        $status = $order['order_status'] ?: "Pending";
                        $created_at = date("d M, Y H:i", strtotime($order['created_at']));
                ?>
                <div class="order-card">
                    <h5>Order #<?php echo $order['id']; ?></h5>
                    <p><i class="bi bi-person"></i> User ID: <?php echo $order['user_id']; ?></p>
                    <p><i class="bi bi-currency-rupee"></i> Total: ₹<?php echo number_format($total_amount, 2); ?></p>
                    <p><i class="bi bi-info-circle"></i> Status: <?php echo $status; ?></p>
                    <p><i class="bi bi-calendar"></i> Date: <?php echo $created_at; ?></p>
                    <div class="d-flex justify-content-between">
                        <a href="order_details.php?id=<?php echo $order['id']; ?>" class="btn btn-primary btn-sm">Details</a>
                        <a href="update_order.php?id=<?php echo $order['id']; ?>" class="btn btn-primary btn-sm">Update</a>
                    </div>
                </div>
                <?php
                    }
                } else {
                    echo "<p class='text-white fs-4'>No orders found.</p>";
                }
                ?>

            </div>
        </div>
    </div>

</body>
</html>