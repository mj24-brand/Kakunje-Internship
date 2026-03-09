<?php
include("../admin/config.php");

// Check if ID exists
if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$post_id = intval($_GET['id']);

// Fetch post with category name using JOIN
$query = mysqli_query($conn, "
    SELECT category1.*, categories.category_name AS category_name
    FROM category1
    LEFT JOIN categories ON category1.category_id = categories.id
    WHERE category1.id = $post_id
");

$post = mysqli_fetch_assoc($query);

if(!$post){
    echo "Post not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $post['title']; ?> - News Portal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">NewsPortal</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="category.php">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- News Details Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">

                <!-- Image -->
                <img src="../admin/uploads/<?php echo $post['image']; ?>" 
                     class="card-img-top" 
                     style="max-height:400px; object-fit:cover;">

                <div class="card-body">

                    <!-- Title -->
                    <h2 class="card-title"><?php echo $post['title']; ?></h2>

                    <!-- Category + Date -->
                    <p class="text-muted">
                        Category: <?php echo $post['category_name']; ?> |
                        Date: <?php echo date("d-m-Y", strtotime($post['created_at'])); ?>
                    </p>

                    <!-- Full Description -->
                    <p><?php echo nl2br($post['description']); ?></p>

                    <a href="index.php" class="btn btn-secondary mt-3">
                        Back to Home
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3">
    © 2026 NewsPortal | All Rights Reserved
</footer>

</body>
</html>