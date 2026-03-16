<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include "../config/db.php";

$message = "";

if(isset($_POST['add_type'])){
    echo "Form Submitted";
    $book_type = mysqli_real_escape_string($conn, $_POST['book_type']);
    if(!empty($book_type)){
        $query = "INSERT INTO product_book (book_type) VALUES ('$book_type')";
        if(mysqli_query($conn, $query)){
            $message = "<div class='alert alert-success'>Book Added Successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error Adding Books</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Books Name Cannot Be Empty</div>";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
<title>Add Books</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="/BOOKSTORE_PROJECT/assets/style.css">
<style>
.addtype-bg{
    background-image: url('../assets/addtype1.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 80vh;
}
</style>
</head>
<body>
    <body class="bg-light">
    <header class="header d-flex align-items-center p-3">

    <h3 class="mx-auto">CATEGORIES CATALOG</h3>

    <div>
        <a href="manage_type.php" class="btn btn-warning btn-sm">Edit Category</a>
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

<!------Main section--->
<div class="container-fluid p-4 addtype-bg">
    <h2 class="text-center mt-5">ADD BOOKS</h2>

    <?php echo $message; ?>

    <div class="d-flex justify-content-center">

        <div class="card shadow p-4 mt-5" style="width:500px;">
            <form method="POST">
                <div class="mb-3">
                    <label>Book Name</label>
                    <input type="text" name="book_type" class="form-control" required>
                </div>

                <button type="submit" name="add_type" class="btn btn-primary w-100">
                    Add Book Type
                </button>
            </form>
        </div>

    </div>
</div>

</div>
 <footer class="footer">
        <p>&copy; 2026 BookStore</p>
    </footer>
</body>
</html>