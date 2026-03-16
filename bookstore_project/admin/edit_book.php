<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("../config/db.php");

/* get book data */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM book_post WHERE id=$id");
    $post = mysqli_fetch_assoc($result);
} else {
    header("Location: view_book.php");
    exit();
}

/* update book */
if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $book_id = $_POST['book_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    /* check img uploaded */
    if ($_FILES['image']['name'] != "") {

        $image = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $image);

        // delete old image
        unlink("uploads/" . $post['image']);

        mysqli_query($conn, "UPDATE book_post SET
            title='$title',
            author='$author',
            description='$description',
            price='$price',
            stock='$stock',
            book_id='$book_id',
            image='$image'
            WHERE id=$id
        ");

    } else {

        mysqli_query($conn, "UPDATE book_post SET
            title='$title',
            author='$author',
            description='$description',
            price='$price',
            stock='$stock',
            book_id='$book_id'
            WHERE id=$id
        ");
    }

    header("Location: view_book.php");
    exit();
}

/* FETCH BOOK TYPES */
$types = mysqli_query($conn, "SELECT * FROM product_book");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="../assets/style.css" rel="stylesheet">

</head>

<body>

    <header class="header d-flex align-items-center p-3">

        <h3 class="mx-auto">PRODUCTS CATALOG</h3>

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
                <li><i class="bi bi-book"></i><a href="add_book.php"> Products</a></li>
                <li><i class="bi bi-tags"></i> <a href="add_type.php"> Categories</a></li>
                <li><i class="bi bi-bag"></i> <a href="manage_orders.php"> Orders</a></li>
                <li><i class="bi bi-people"></i><a href="view_users.php"> Users</a></li>
                <li><i class="bi bi-box-arrow-right"></i><a href="Login.php"> Logout</a></li>
            </ul>
        </div>


        <div class="flex-grow-1 d-flex justify-content-center align-items-start bg-warning"
            style="min-height: 80vh; padding: 40px;">
            <div class="shadow p-4 rounded bg-white" style="width: 500px;">
                <h2 class="text-center mb-4">Edit Book</h2>
                <form method="POST" enctype="multipart/form-data"></form>
                <div class="mb-3">
                    <label class="form-label">Book Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Book Type</label>

                    <select name="book_id" class="form-select" required>

                        <?php while ($type = mysqli_fetch_assoc($types)) { ?>

                            <option value="<?php echo $type['id']; ?>" <?php if ($type['id'] == $post['book_id'])
                                   echo "selected"; ?>>

                                <?php echo $type['book_type']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea name="description" class="form-control" rows="5" required>
<?php echo $post['description']; ?>
</textarea>

                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="<?php echo $post['price']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="<?php echo $post['stock']; ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>

                    <img src="uploads/<?php echo $post['image']; ?>" width="120" class="img-thumbnail mb-2">

                </div>

                <div class="mb-3">
                    <label class="form-label">Change Image (Optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" name="update" class="btn btn-success">
                    Update Book
                </button>

                <a href="view_book.php" class="btn btn-secondary">
                    Cancel
                </a>

                </form>
            </div>
        </div>

</body>

</html>