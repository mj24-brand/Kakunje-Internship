<?php
include("../admin/config.php");

// Fetch all categories
$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Categories - News Portal</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
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
        <li class="nav-item"><a class="nav-link active" href="category.php">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Title -->
<div class="bg-primary text-white text-center py-4">
    <h2>News Categories</h2>
</div>

<!-- Categories Section -->
<div class="container my-5">
    <div class="row g-4">

        <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
        
        <div class="col-md-4">
            <div class="card shadow text-center p-4 h-100">
                <h4><?php echo $cat['category_name']; ?></h4>
                <p>Explore latest news in <?php echo $cat['category_name']; ?>.</p>
                <a href="news-by-category.php?id=<?php echo $cat['id']; ?>" 
                   class="btn btn-outline-primary">
                   View News
                </a>
            </div>
        </div>

        <?php } ?>

    </div>
</div>

<!-- Footer -->
<footer class="text-center bg-dark text-white p-3">
    <p>© 2026 NewsPortal | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>