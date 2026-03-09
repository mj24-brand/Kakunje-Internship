<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("config.php");

/* GET CATEGORY ID */
if(!isset($_GET['id'])){
    header("Location: manage-categories.php");
    exit();
}

$id = $_GET['id'];

/* FETCH CATEGORY */
$result = mysqli_query($conn, "SELECT * FROM categories WHERE id = $id");
$category = mysqli_fetch_assoc($result);

if(!$category){
    header("Location: manage-categories.php");
    exit();
}

/* UPDATE CATEGORY */
if(isset($_POST['update'])){
    $category_name = $_POST['category_name'];

    mysqli_query($conn, "UPDATE categories 
                         SET category_name='$category_name' 
                         WHERE id=$id");

    header("Location: manage-categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Category</title>
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
    <h2>Edit Category</h2>

    <div class="card shadow p-4 mt-3 col-md-6">
        <form method="POST">
            <div class="mb-3">
                <label>Category Name</label>
                <input type="text" 
                       name="category_name" 
                       value="<?php echo $category['category_name']; ?>" 
                       class="form-control" 
                       required>
            </div>

            <button type="submit" name="update" class="btn btn-primary">
                Update Category
            </button>

            <a href="manage-categories.php" class="btn btn-secondary">
                Cancel
            </a>
        </form>
    </div>
</div>

</div>
</body>
</html>