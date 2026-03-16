<?php
include "../config/db.php";

// Get order ID from URL safely
$order_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($order_id <= 0){
    die("Invalid order ID.");
}

// Fetch order items with product titles
$query = mysqli_query($conn, "
    SELECT order_items.*, book_post.title
    FROM order_items
    JOIN book_post ON order_items.product_id = book_post.id
    WHERE order_items.order_id = '$order_id'
");

if(!$query){
    die("Query Error: " . mysqli_error($conn));
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
</head>
<body>
    <!-- Header -->
    <header class="header d-flex align-items-center p-3">
        <h3 class="mx-auto">ORDERS</h3>
        <div>
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

        <!-- Main Content -->
        <div class="flex-grow-1 p-4 bg-success">
            <div class="container">
                <h2 class="text-center mb-4 text-white">Order Details</h2>

                <?php if(mysqli_num_rows($query) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center text-white" style="background: rgba(0,0,0,0.3); border-radius: 10px;">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($query)): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                                        <td><?php echo (int)$row['quantity']; ?></td>
                                        <td>₹<?php echo number_format($row['price'], 2); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-center text-white fs-4 mt-5">No items found for this order.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>