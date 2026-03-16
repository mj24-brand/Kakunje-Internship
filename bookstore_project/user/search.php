<?php
session_start();
include("../config/db.php");

$search = $_GET['search'] ?? '';

$query = mysqli_query($conn, "
SELECT * FROM book_post
WHERE title LIKE '%$search%'
OR author LIKE '%$search%'
");
?>

<!DOCTYPE html>
<html>

<head>

    <title>Search Books</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">

        <h2>Search Results for "<?php echo $search; ?>"</h2>

        <div class="row">

            <?php

            if (mysqli_num_rows($query) > 0) {

                while ($row = mysqli_fetch_assoc($query)) {

                    ?>

                    <div class="col-md-3">

                        <div class="card mb-3">

                            <img src="../admin/uploads/<?php echo $row['image']; ?>" class="card-img-top"
                                style="height:200px; object-fit:cover;">

                            <div class="card-body">

                                <h5><?php echo $row['title']; ?></h5>

                                <p>Author: <?php echo $row['author']; ?></p>

                                <p class="text-success">₹<?php echo $row['price']; ?></p>

                                <a href="cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                                    Add to Cart
                                </a>

                            </div>
                        </div>

                    </div>

                    <?php
                }
            } else {
                echo "<p>No books found.</p>";
            }
            ?>

        </div>

    </div>

</body>

</html>