<?php
session_start();
include("../config/db.php");

$customer_id = $_SESSION['customer_id'];

//Fetch user data 
$user_query = mysqli_query($conn, "SELECT * FROM customer WHERE id='$customer_id'");
$user = mysqli_fetch_assoc($user_query);
$updated = true; 

if (isset($_POST['edit'])) {
    $updated = false;
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    mysqli_query($conn, "
        UPDATE customer 
        SET name='$name', phone='$phone' 
        WHERE id='$customer_id'
    ");

    $updated = true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Profile</title>

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

    <div class="profile-body">
    <div class="container mt-5 profile-container" style="max-width:700px;">
        <h2 class="text-center mb-4">MY PROFILE</h2>

        <div class="card shadow p-4 mx-auto">

        <?php if ($updated) { ?>
            <!-- Updated profile card -->
            <div class="text-center mb-3">
                <i class="bi bi-person-circle" style="font-size: 50px; color: #656fcb;"></i>
            </div>
            <h4 class="text-center mb-2"><?php echo $user['name']; ?></h4>
            <p class="text-center mb-1">
                <i class="bi bi-envelope" style="font-size:16px;"></i> <?php echo $user['email']; ?>
            </p>
            <p class="text-center mb-2">
                <i class="bi bi-telephone" style="font-size:16px;"></i> <?php echo $user['phone']; ?>
            </p>

            <form method="POST">
                <button name="edit" class="btn btn-primary w-100 mt-3">Update Profile</button>
            </form>

        <?php } else { ?>
            <!-- Edit form -->
            <form method="POST">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="<?php echo $user['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control form-control-sm" value="<?php echo $user['email']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control form-control-sm" value="<?php echo $user['phone']; ?>" required>
                </div>
                <button name="update" class="btn btn-primary w-100 mt-3">Save Changes</button>
            </form>
        <?php } ?>

        </div>
    </div>
</div>
    <!-- Footer -->

    <footer class="text-center mt-5 p-3 bg-dark text-white">
        <p>&copy; 2026 OnlineBookstore | All Rights Reserved</p>
    </footer>
</body>

</html>