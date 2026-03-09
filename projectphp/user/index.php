<?php
include("../admin/config.php");

// Fetch latest 6 posts with category name
$query = "
    SELECT category1.*, categories.category_name 
    FROM category1 
    JOIN categories ON category1.category_id = categories.id
    ORDER BY category1.id DESC
    LIMIT 6
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>News Portal - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
            padding: 80px 0;
        }
        .card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }
        footer {
            background: #111;
            color: white;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">NewsPortal</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="category.php">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        <li class="nav-item">
            <a class="nav-link btn btn-primary text-white ms-2 px-3" href="login.php">
                Login
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<section class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Welcome to News Portal</h1>
        <p class="lead">Stay Updated with Latest News & Trending Stories</p>
        <a href="category.php" class="btn btn-light btn-lg mt-3">
            Explore Categories
        </a>
    </div>
</section>

<!-- Latest News -->
<div class="container my-5">
    <h2 class="text-center mb-4">Latest News</h2>
    <div class="row g-4">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <div class="col-md-4">
            <div class="card shadow h-100">
                <img src="../admin/uploads/<?php echo $row['image']; ?>" 
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">

                <div class="card-body">
                    <h6 class="text-muted">
                        <?php echo $row['category_name']; ?>
                    </h6>

                    <h5 class="card-title">
                        <?php echo $row['title']; ?>
                    </h5>

                    <p class="card-text">
                        <?php echo substr($row['description'], 0, 80); ?>...
                    </p>

                    <a href="news-details.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-primary">
                       Read More
                    </a>
                </div>
            </div>
        </div>

        <?php } ?>

    </div>
</div>

<footer class="text-center">
    <p>© 2026 NewsPortal | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>