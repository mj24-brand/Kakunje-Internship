<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("config.php");

/* DELETE POST */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    // Get image name before deleting
    $imgQuery = mysqli_query($conn, "SELECT image FROM category1 WHERE id=$id");
    $imgData = mysqli_fetch_assoc($imgQuery);

    if($imgData){
        unlink("uploads/".$imgData['image']); // delete image file
    }

    mysqli_query($conn, "DELETE FROM category1 WHERE id=$id");
    header("Location: manage-posts.php");
    exit();
}

/* FETCH POSTS WITH CATEGORY NAME */
$query = "
    SELECT category1.*, categories.category_name 
    FROM category1
    LEFT JOIN categories 
    ON category1.category_id = categories.id
    ORDER BY category1.id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Posts</title>
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
    <a href="manage-posts.php" class="bg-primary text-white">Manage Posts</a>
    <a href="add-category.php">Add Category</a>
    <a href="manage-categories.php">Manage Categories</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container-fluid p-4">
    <h2>Manage Posts</h2>

    <div class="card shadow mt-3 p-3">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>

                    <td>
                        <img src="uploads/<?php echo $row['image']; ?>" 
                             width="80" 
                             class="img-thumbnail">
                    </td>

                    <td><?php echo $row['title']; ?></td>

                    <td><?php echo $row['category_name']; ?></td>

                    <td><?php echo date("d-m-Y", strtotime($row['created_at'])); ?></td>

                    <td>
                        <a href="edit-post.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-warning">
                           Edit
                        </a>

                        <a href="manage-posts.php?delete=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this post?');">
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