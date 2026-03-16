<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
//Total books
$book_query = mysqli_query($conn, "SELECT COUNT(*) AS total_books FROM book_post");
$book_data = mysqli_fetch_assoc($book_query);
$total_books = $book_data['total_books'] ?? 0; 

// Total users
$user_query = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM customer");
$user_data = mysqli_fetch_assoc($user_query);
$total_users = $user_data['total_users'] ?? 0;

// Total order
$order_query = mysqli_query($conn, "SELECT COUNT(*) AS total_orders FROM orders");
$order_data = mysqli_fetch_assoc($order_query);
$total_orders = $order_data['total_orders'] ?? 0;

//Total revenue
$revenue_query = mysqli_query($conn, "
    SELECT IFNULL(SUM(total_amount), 0) AS total_revenue 
    FROM orders 
    WHERE order_status = 'delivered'
");
$revenue_data = mysqli_fetch_assoc($revenue_query);
$total_revenue = $revenue_data['total_revenue'];
?>



<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/BOOKSTORE_PROJECT/assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <header class="header">
        ADMIN DASHBOARD
    </header>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2 class="logo"><i class="bi bi-book"></i> BookStore</h2>
            <br><br>
            <ul>
                <li><i class="bi bi-speedometer2"></i> <a href="dashboard.php"> Dashboard</a></li>
                <li><i class="bi bi-book"></i><a href="view_book.php"> Products</a> </li>
                <li><i class="bi bi-tags"></i> <a href="add_type.php"> Categories</a></li>
                <li><i class="bi bi-bag"></i> <a href="manage_orders.php"> Orders</a></li>
                <li><i class="bi bi-people"></i><a href="view_users.php"> Users</a></li>
                <li><i class="bi bi-box-arrow-right"></i><a href="Login.php"> Logout</a></li>
            </ul>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard">
            <div class="cards">
                <div class="card">
                    <i class="bi bi-people"></i>
                    <h3>TOTAL USERS</h3>
                    <p><?php echo $total_users; ?></p>
                </div>

                <div class="card">
                    <i class="bi bi-book"></i>
                    <h3>TOTAL BOOKS</h3>
                    <p><?php echo $total_books; ?></p>
                </div>

                <div class="card">
                    <i class="bi bi-cart"></i>
                    <h3>TOTAL ORDERS</h3>
                    <p><?php echo $total_orders; ?></p>
                </div>

                <div class="card">
                    <i class="bi bi-currency-rupee"></i>
                    <h3>TOTAL REVENUE</h3>
                    <p>₹<?php echo $total_revenue; ?></p>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p>&copy; 2026 BookStore</p>
    </footer>
</body>

</html>