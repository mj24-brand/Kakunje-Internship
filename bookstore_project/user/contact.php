<?php
session_start();
include("../config/db.php");

$customer_id = $_SESSION['customer_id'];

/* Update Profile */
if(isset($_POST['message'])){

$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['msg'];

$success = "Message sent successfully!";

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/style.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand" href="home.php">
                <i class="bi bi-book-half"></i> ONLINE BOOKSTORE
            </a>

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
                        <a class="nav-link active" href="orders.php">Orders</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">
                            <i class="bi bi-telephone-forward-fill"></i>
                        </a>
                    </li>

                </ul>

                <!-- Search -->
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

    <div class="contact-body">
        <div class="container mt-5 contact-container">

            <h2 class="text-center mb-4">CONTACT</h2>

            <div class="row justify-content-center">

                <div class="col-md-6">

                    <div class="card shadow p-4">

                        <form method="POST">

                            <div class="mb-4">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name">
                            </div>

                            <div class="mb-4">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>

                            <div class="mb-4">
                                <label>Message</label>
                                <textarea name="msg" class="form-control" rows="4"
                                    placeholder="Write your message"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100" name="message">
                                Send Message
                            </button>

                        </form>
                        <?php if (isset($success)) { ?>

                            <div class="alert alert-success mt-3">
                                <?php echo $success; ?>
                            </div>

                        <?php } ?>

                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- Footer -->

    <footer class="text-center mt-5 p-3 bg-dark text-white">
        <p>&copy; 2026 OnlineBookstore | All Rights Reserved</p>
    </footer>

</body>

</html>