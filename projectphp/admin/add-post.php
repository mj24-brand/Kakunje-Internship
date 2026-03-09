<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("config.php");

/* FETCH CATEGORIES FOR DROPDOWN */
$categories = mysqli_query($conn, "SELECT * FROM categories");

$message = "";

if(isset($_POST['add_post'])){

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = $_POST['category_id'];

    /* IMAGE UPLOAD */
    $imageName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    if(!empty($imageName)){
        move_uploaded_file($tempName, "uploads/".$imageName);
    }

    /* INSERT QUERY */
    $query = "INSERT INTO category1 (title, description, image, category_id)
              VALUES ('$title', '$description', '$imageName', '$category_id')";

    if(mysqli_query($conn, $query)){
        $message = "<div class='alert alert-success'>Post Published Successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error Publishing Post</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Post</title>
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
    <a href="add-post.php" class="bg-primary text-white">Add Post</a>
    <a href="manage-posts.php">Manage Posts</a>
    <a href="add-category.php">Add Category</a>
    <a href="manage-categories.php">Manage Categories</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
</div>

<!-- Content -->
<div class="container-fluid p-4">
    <h2>Add New Post</h2>

    <?php echo $message; ?>

    <div class="card shadow p-4 mt-3">
        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Post Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>

                    <?php while($row = mysqli_fetch_assoc($categories)) { ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['category_name']; ?>
                        </option>
                    <?php } ?>

                </select>
            </div>

            <div class="mb-3">
                <label>Post Image</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" name="add_post" class="btn btn-primary">
                Publish Post
            </button>
        </form>
    </div>
</div>

</div>
</body>
</html>