<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("config.php");

$message = "";

if(isset($_POST['add_category'])){
    $categoryName = mysqli_real_escape_string($conn, $_POST['category_name']);
    if(!empty($categoryName)){
        $query = "INSERT INTO categories (category_name) VALUES ('$categoryName')";
        if(mysqli_query($conn, $query)){
            $message = "<div class='alert alert-success'>Category Added Successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error Adding Category</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Category Name Cannot Be Empty</div>";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

<div class="sidebar col-md-2">
    <h4 class="text-white text-center">Admin</h4>
    <a href="dashboard.php">Dashboard</a>
    <a href="add-post.php">Add Post</a>
    <a href="manage-posts.php">Manage Posts</a>
    <a href="add-category.php" class="bg-primary text-white">Add Category</a>
    <a href="manage-categories.php">Manage Categories</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container-fluid p-4">
    <h2>Add Category</h2>
    <?php echo $message; ?>

    <div class="card shadow p-4 mt-3 col-md-6">
        <form method="POST">
            <div class="mb-3">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control" required>
            </div>
            <button type="submit" name="add_category" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</div>

</div>
</body>
</html>