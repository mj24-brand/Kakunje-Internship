<?php
include("../config/db.php");

// fetch bookss
$query = "
SELECT book_post.*, product_book.book_type
FROM book_post
JOIN product_book
ON book_post.book_id = product_book.id
ORDER BY book_post.id DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONLINE BOOKSTORE - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="home.php"><i class="bi bi-book-half"></i> ONLINE BOOKSTORE</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">

                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><i class="bi bi-telephone-forward-fill"></i></a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex" action="search.php" method="GET">

                    <input class="form-control me-2" type="search" name="search" placeholder="Search books">

                    <button class="btn btn-success">Search</button>

                </form>

                <a class="btn btn-danger ms-3" href="logout.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero text-center">

        <div class="container">

            <h1 class="display-4 fw-bold">WELCOME TO ONLINE BOOKSTORE</h1>

            <p class="lead">
                Make Online Book Purchases. Free Shipping with 50% OFF..HURRY UP!!!
            </p>

            <a href="home.php" class="btn btn-warning btn-lg mt-3">
                Explore Categories
            </a>

        </div>

    </section>

    <!-- Latest Books -->
    <div class="container-books my-5">
        <h2 class="text-center mb-4">TRENDING BOOKS</h2>
        <div class="row g-4">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="col-md-4">
                    <div class="card shadow h-100">

                        <img src="../admin/uploads/<?php echo $row['image']; ?>" class="card-img-top"
                            style="height:200px; object-fit:cover;">

                        <div class="card-body">

                            <h6 class="text-muted">
                                <a href="category.php?id=<?php echo $row['book_id']; ?>" class="text-decoration-none">
                                    <?php echo $row['book_type']; ?>
                                </a>
                            </h6>

                            <h5 class="card-title">
                                <?php echo $row['title']; ?>
                            </h5>

                            <p class="card-text">
                                <?php echo substr($row['description'], 0, 80); ?>...
                            </p>

                            <p class="fw-bold text-success">
                                ₹<?php echo $row['price']; ?>
                            </p>
                            <a href="cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                                Add to Cart
                            </a>

                            <a href="book_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

    <footer class="text-center">
        <p>&copy; 2026 OnlineBookstore | All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>