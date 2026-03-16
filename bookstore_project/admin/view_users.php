<?php
include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM customer");
$status_query = mysqli_query($conn, "
SELECT 
SUM(order_status='Pending') AS pending,
SUM(order_status='Processing') AS processing,
SUM(order_status='Shipped') AS shipped,
SUM(order_status='Delivered') AS delivered,
SUM(order_status='Cancelled') AS cancelled
FROM orders
");

$status = mysqli_fetch_assoc($status_query);

$pending = $status['pending'] ?? 0;
$processing = $status['processing'] ?? 0;
$shipped = $status['shipped'] ?? 0;
$delivered = $status['delivered'] ?? 0;
$cancelled = $status['cancelled'] ?? 0;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add New Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="../assets/style.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(#acb3ec, #e7baa8);
        }
    </style>

</head>

<body>
    <header class="header d-flex align-items-center p-3">

        <h3 class="mx-auto">USERS CATALOG</h3>

    </header>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2 class="logo"><i class="bi bi-book"></i> BookStore</h2>
            <ul>
                <li><i class="bi bi-speedometer2"></i> <a href="dashboard.php"> Dashboard</a></li>
                <li><i class="bi bi-book"></i><a href="add_book.php"> Products</a> </li>
                <li><i class="bi bi-tags"></i> <a href="add_type.php"> Categories</a></li>
                <li><i class="bi bi-bag"></i> <a href="manage_orders.php"> Orders</a></li>
                <li><i class="bi bi-people"></i><a href="view_users.php"> Users</a></li>
                <li><i class="bi bi-box-arrow-right"></i><a href="Login.php"> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column align-items-center mt-4">
            <div style="width: 90%; max-width: 900px;">
                <h2 class="mb-3 text-center">Users List</h2>

                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Registered Date</th>
                        </tr>
                    </thead>
                    <tbody class="table-warning">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <h3 class="mt-5 text-center">Sales Statistics</h3>

                <div style="width:100%; max-width:500px; margin:auto;">
                    <canvas id="salesBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesBarChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
                datasets: [{
                    label: 'Orders',
                    data: [
                        <?php echo $pending; ?>,
                        <?php echo $processing; ?>,
                        <?php echo $shipped; ?>,
                        <?php echo $delivered; ?>,
                        <?php echo $cancelled; ?>
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>