<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("config.php");

$postCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM category1"));
$categoryCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM categories"));
?>



<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar col-md-2">
        <h4 class="text-white text-center">Admin</h4>
        <a href="dashboard.php">Dashboard</a>
        <a href="add-post.php">Add Post</a>
        <a href="manage-posts.php">Manage Posts</a>
        <a href="add-category.php">Add Category</a>
        <a href="manage-categories.php">Manage Categories</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Content -->
    <div class="container-fluid p-4">
        <h2>Dashboard</h2>
        <div class="row mt-4">

            <div class="col-md-3">
                <div class="card dashboard-card shadow p-3">
                    <h5>Total Posts</h5>
                    <h3><?php echo $postCount; ?></h3>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card dashboard-card shadow p-3">
                    <h5>Total Categories</h5>
                    <h3><?php echo $categoryCount; ?></h3>
            </div>

        </div>
    </div>

</div>

</body>
</html>