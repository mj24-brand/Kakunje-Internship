<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer = $_SESSION['customer_id'];

$query = mysqli_query($conn, "
SELECT * FROM orders
WHERE customer_id='$customer'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Orders</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="home.php">
                <i class="bi bi-book-half"></i> ONLINE BOOKSTORE
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="orders.php">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">
                            <i class="bi bi-telephone-forward-fill"></i>
                        </a>
                    </li>

                </ul>

                <!-- Search -->
                <form class="d-flex" action="search.php" method="GET">

                    <input class="form-control me-2" type="search" name="search" placeholder="Search books">

                    <button class="btn btn-success">Search</button>

                </form>

                <a class="btn btn-danger ms-3" href="logout.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

            </div>
        </div>
    </nav>


    <!-- Orders Section -->
    <div class="orders-body ">
        <div class="container mt-5 orders-container">

            <h2 class="mb-4 order-heading">MY ORDERS</h2>

            <table class="table table-bordered table-striped">

                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody class="table-warning">

                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>

                        <tr>
                            <td>#<?php echo $row['id']; ?></td>
                            <td>
                                <span class="badge bg-success">
                                    <?php echo $row['order_status']; ?>
                                </span>
                            </td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>
    </div>
    <!-- Footer -->

    <footer class="text-center mt-5 p-3 bg-dark text-white">
        <p>&copy; 2026 OnlineBookstore | All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>