<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../config/db.php");

// Delete category 
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM product_book WHERE id = $id");
    header("Location: manage_type.php");
    exit();
}

// FETCH ALL CATEGORIES 
$result = mysqli_query($conn, "SELECT * FROM product_book ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Book Types</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="../assets/style.css" rel="stylesheet">
</head>
<style>
body{
    min-height:100vh;
    background: linear-gradient( #e48fbb, #38ef7d);
}
</style>
<body>
    <header class="header d-flex align-items-center p-3">

        <h3 class="mx-auto">CATEGORIES CATALOG</h3>

        <div>
            <a href="add_type.php" class="btn btn-success btn-sm me-2">ADD BOOKS CATEGORY</a>
        </div>

    </header>

<div class="d-flex">

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

        <!----contents-->

<div class="container-fluid p-4 d-flex justify-content-center">
     <div class="card shadow p-4" style="width: 70%;">
    <h2>Manage Book Types</h2>
        <table class="table table-bordered table-striped ">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['book_type']; ?></td>
                    <td>
                        <a href="edit_type.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <a href="manage_type.php?delete=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this category?');">
                           Delete
                        </a>
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