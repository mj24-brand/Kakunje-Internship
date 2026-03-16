<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "../config/db.php";

//FETCH BOOK POSTS 
$query = "SELECT * FROM book_post ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$message = "";
if (isset($_POST['add_book'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $book_id = $_POST['book_id'];
    $imageName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    if (!empty($imageName)) {
        move_uploaded_file($tempName, "uploads/" . $imageName);
    }

    $query = "INSERT INTO book_post (title, description, image, book_id)
              VALUES ('$title', '$description', '$imageName', '$book_id')";

    if (mysqli_query($conn, $query)) {
        $message = "<div class='alert alert-success'>Book Published Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error Publishing Book</div>";
    }
}

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    // get image name
    $imgQuery = mysqli_query($conn, "SELECT image FROM book_post WHERE id=$id");
    $imgData = mysqli_fetch_assoc($imgQuery);

    if ($imgData) {
        unlink("uploads/" . $imgData['image']); // delete imaage
    }

    mysqli_query($conn, "DELETE FROM book_post WHERE id=$id");

    header("Location: view_book.php");
    exit();
}

if (isset($_POST['add_post'])) {
    $book_type = mysqli_real_escape_string($conn, $_POST['book_type']);
    if (!empty($book_type)) {
        $query = "INSERT INTO product_book (book_type) VALUES ('$book_type')";
        if (mysqli_query($conn, $query)) {
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
            <a href="add_book.php" class="btn btn-success btn-sm me-2">Publish Book</a>
        </div>

    </header>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <h2 class="logo"><i class="bi bi-book"></i> BookStore</h2>
            <br><br>
            <ul>
                <li><i class="bi bi-speedometer2"></i> <a href="dashboard.php"> Dashboard</a></li>
                <li><i class="bi bi-book"></i><a href="add_book.php"> Products</a> </li>
                <li><i class="bi bi-tags"></i> <a href="add_type.php"> Categories</a></li>
                <li><i class="bi bi-bag"></i> <a href="manage_orders.php"> Orders</a></li>
                <li><i class="bi bi-people"></i><a href="view_users.php"> Users</a></li>
                <li><i class="bi bi-box-arrow-right"></i><a href="Login.php"> Logout</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="container-fluid p-4 d-flex justify-content-center">

            <div class="card shadow p-4 mt-3" style="width:80%;">

                <h2 class="text-center mb-4">ALL BOOKS</h2>

                <div class="row mb-3">

                    <table class="table table-bordered table-striped align-middle text-center table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Book ID</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Created_at</th>
                                <th width="160">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['book_id']; ?></td>
                                    <td style="max-width:200px;">
                                        <?php echo $row['description']; ?>
                                    </td>
                                    <td>
                                        <img src="uploads/<?php echo $row['image']; ?>" width="60" height="80"
                                            style="object-fit:cover;">
                                    </td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['stock']; ?></td>

                                    <td><?php echo date("d-m-Y", strtotime($row['created_at'])); ?></td>

                                    <td>
                                        <a href="edit_book.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <a href="view_book.php?delete=<?php echo $row['id']; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this book?');">
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

    </div>
    
</body>

</html>