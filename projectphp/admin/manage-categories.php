<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("config.php");

/* DELETE CATEGORY */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM categories WHERE id = $id");
    header("Location: manage-categories.php");
    exit();
}

/* FETCH ALL CATEGORIES */
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Categories</title>
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
    <a href="add-category.php">Add Category</a>
    <a href="manage-categories.php" class="bg-primary text-white">Manage Categories</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container-fluid p-4">
    <h2>Manage Categories</h2>

    <div class="card shadow mt-3 p-3">
        <table class="table table-bordered table-striped">
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
                    <td><?php echo $row['category_name']; ?></td>
                    <td>
                        <a href="edit-category.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <a href="manage-categories.php?delete=<?php echo $row['id']; ?>" 
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