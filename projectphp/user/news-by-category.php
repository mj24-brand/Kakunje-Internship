<?php
include("../admin/config.php");

// Check if category id exists
if(!isset($_GET['id'])){
    header("Location: category.php");
    exit();
}

$category_id = intval($_GET['id']);

// Get category details
$catQuery = mysqli_query($conn, "SELECT * FROM categories WHERE id = $category_id");
$category = mysqli_fetch_assoc($catQuery);

if(!$category){
    echo "Category not found!";
    exit();
}

// Get posts of that category
$postQuery = mysqli_query($conn, "
    SELECT * FROM category1 
    WHERE category_id = $category_id 
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $category['category_name']; ?> - News Portal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">NewsPortal</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="category.php">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Title -->
<div class="bg-primary text-white text-center py-4">
    <h2><?php echo $category['category_name']; ?> News</h2>
</div>

<!-- Posts Section -->
<div class="container my-5">
    <div class="row g-4">

        <?php if(mysqli_num_rows($postQuery) > 0){ ?>

            <?php while($post = mysqli_fetch_assoc($postQuery)){ ?>

                <div class="col-md-4">
                    <div class="card shadow h-100">
                        <img src="../admin/uploads/<?php echo $post['image']; ?>" 
                             class="card-img-top" 
                             style="height:200px; object-fit:cover;">

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['title']; ?></h5>
                            <p class="card-text">
                                <?php echo substr($post['description'], 0, 100); ?>...
                            </p>

                            <a href="news-details.php?id=<?php echo $post['id']; ?>" 
                               class="btn btn-primary">
                               Read More
                            </a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="col-12 text-center">
                <h4>No posts available in this category.</h4>
            </div>

        <?php } ?>

    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3">
    <p>© 2026 NewsPortal | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>