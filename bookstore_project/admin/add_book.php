<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../config/db.php";
$product_book = mysqli_query($conn, "SELECT * FROM product_book");
$message = "";

if (isset($_POST['add_book'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $book_id = $_POST['book_id'];

    $imageName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    if (!empty($imageName)) {
        move_uploaded_file($tempName, "uploads/" . $imageName);
    }

    $query = "INSERT INTO book_post 
    (title, author, description, price, stock, image, book_id)
    VALUES 
    ('$title','$author','$description','$price','$stock','$imageName','$book_id')";

    if (mysqli_query($conn, $query)) {
        $message = "<div class='alert alert-success'>Book Published Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error Publishing Book</div>";
    }
}
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
body{
    min-height:100vh;
    background: linear-gradient( #e48fbb, #38ef7d);
}
</style>
</head>
<body>
    <header class="header d-flex align-items-center p-3">
        <h3 class="mx-auto">PRODUCTS CATALOG</h3>
        <div>
            <a href="view_book.php" class="btn btn-success btn-sm me-2">All Book</a>
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

        <!-- Content -->

        <div class="container-fluid p-5 d-flex justify-content-center">

            <div class="card shadow p-4 mt-3" style="width:80%;">

                <h2 class="text-center mb-4">ADD NEW BOOKS</h2>

                <?php echo $message; ?>

                <form method="POST" enctype="multipart/form-data">

                    <div class="row mb-3">

                        <label class="col-sm-3 col-form-label">Book Title :</label>

                        <div class="col-sm-9">

                            <input type="text" name="title" class="form-control" required>

                        </div>

                    </div>


                    <div class="row mb-3">

                        <label class="col-sm-3 col-form-label">Book Author :</label>

                        <div class="col-sm-9">

                            <input type="text" name="author" class="form-control" required>

                        </div>

                    </div>


                    <div class="row mb-3">

                        <label class="col-sm-3 col-form-label">Book Type :</label>

                        <div class="col-sm-9">

                            <select name="book_id" class="form-select" required>

                                <option value="">Select Book Type</option>

                                <?php while ($row = mysqli_fetch_assoc($product_book)) { ?>

                                    <option value="<?php echo $row['id']; ?>">

                                        <?php echo $row['book_type']; ?>

                                    </option>

                                <?php } ?>

                            </select>

                        </div>

                    </div>


                    <div class="row mb-3">

                        <label class="col-sm-3 col-form-label">Book Image :</label>

                        <div class="col-sm-9">

                            <input type="file" name="image" class="form-control" required>

                        </div>

                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Description :</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Book Price :</label>
                        <div class="col-sm-9">
                            <input type="number" name="price" class="form-control" required>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Book Stock :</label>
                        <div class="col-sm-9">
                            <input type="number" name="stock" class="form-control" required>
                        </div>

                    </div>


                    <div class="text-center">

                        <button type="submit" name="add_book" class="btn btn-primary">

                            Publish Book

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</body>
</html>