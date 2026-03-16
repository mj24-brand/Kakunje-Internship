<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}
$customer = $_SESSION['customer_id'];
// Add to cart 
if (isset($_GET['id'])) {
    $product = $_GET['id'];
    mysqli_query($conn, "
INSERT INTO cart(customer_id,product_id,quantity)
VALUES('$customer','$product','1')
");
}

// Remove from cart 
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    mysqli_query($conn, "DELETE FROM cart WHERE id='$id'");
}

// Update quantity 
if (isset($_POST['update'])) {
    $id = $_POST['cart_id'];
    $qty = $_POST['qty'];

    mysqli_query($conn, "
UPDATE cart SET quantity='$qty' WHERE id='$id'
");
}

//Fetch cart items 
$query = mysqli_query($conn, "
SELECT cart.*, book_post.title, book_post.price, book_post.image
FROM cart
JOIN book_post ON cart.product_id = book_post.id
WHERE cart.customer_id='$customer'
");

$total = 0;
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
    <p>
    <div class="container mt-5 cart-body">

        <h2 class="mb-4" style="color:white; border: 2px solid black; background-color:black;">Your Cart</h2>

        <div class="row">

            <?php while ($row = mysqli_fetch_assoc($query)) {
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
                ?>

                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <img src="../admin/uploads/<?php echo $row['image']; ?>" class="card-img-top"
                            style="height:200px; object-fit:cover;">

                        <div class="card-body">

                            <h5 class="card-title">
                                <?php echo $row['title']; ?>
                            </h5>

                            <p class="text-success fw-bold">
                                Price: ₹<?php echo $row['price']; ?>
                            </p>

                            <form method="POST" class="d-flex align-items-center mb-2">

                                <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">

                                <input type="number" name="qty" value="<?php echo $row['quantity']; ?>" min="1"
                                    class="form-control me-2" style="width:80px;">

                                <button name="update" class="btn btn-primary btn-sm">
                                    Update
                                </button>

                            </form>

                            <p class="fw-bold">
                                Subtotal: ₹<?php echo $subtotal; ?>
                            </p>

                            <a href="cart.php?remove=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
                                Remove
                            </a>

                        </div>

                    </div>

                </div>
            <?php } ?>

        </div>
        <hr>
        <h3 class="text-heading">Total Price: ₹<?php echo $total; ?></h3>
        <div class="text-end">
            <a href="checkout.php" class="btn btn-success btn-lg">
                Checkout
            </a>

        </div>

    </div>
    <footer class="text-center">
        <p>&copy; 2026 OnlineBookstore | All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>