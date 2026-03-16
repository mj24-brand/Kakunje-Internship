<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("../config/db.php");

/* GET CATEGORY ID */
if(!isset($_GET['id'])){
    header("Location: manage_type.php");
    exit();
}

$id = $_GET['id'];

/* FETCH CATEGORY */
$result = mysqli_query($conn, "SELECT * FROM product_book WHERE id = $id");
$category = mysqli_fetch_assoc($result);

if(!$category){
    header("Location: manage_type.php");
    exit();
}

/* UPDATE CATEGORY */
if(isset($_POST['update'])){
    $category_name = $_POST['category_name'];

    mysqli_query($conn, "UPDATE product_book
                         SET book_type='$category_name' 
                         WHERE id=$id");

    header("Location: manage_type.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Category</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="../assets/style.css" rel="stylesheet">
</head>
<body>
    <header class="header d-flex align-items-center p-3">

        <h3 class="mx-auto">CATEGORIES CATALOG</h3>

        <div>
            <a href="view_book.php" class="btn btn-success btn-sm me-2">View Books</a>
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

<div class="flex-grow-1 d-flex justify-content-center align-items-start p-4" style="min-height: 80vh;">
    <div class="card shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-3">Edit Category</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Category Name</label>
                <input type="text" 
                       name="category_name" 
                       value="<?php echo $category['book_type']; ?>" 
                       class="form-control" 
                       required>
            </div>

            <button type="submit" name="update" class="btn btn-primary">
                Update Category
            </button>

            <a href="manage_type.php" class="btn btn-secondary">
                Cancel
            </a>
        </form>
    </div>
</div>

</div>
</body>
</html>