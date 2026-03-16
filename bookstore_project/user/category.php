<?php
include("../config/db.php");

$id = $_GET['id'];

$query = mysqli_query($conn, "
SELECT * FROM book_post
WHERE book_id='$id'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Books</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container mt-4">

        <h2>Books</h2>

        <div class="row">

            <?php while ($row = mysqli_fetch_assoc($query)) { ?>

                <div class="col-md-4">

                    <div class="card shadow">

                        <img src="../admin/uploads/<?php echo $row['image']; ?>" class="card-img-top"
                            style="height:200px;object-fit:cover;">

                        <div class="card-body">

                            <h5><?php echo $row['title']; ?></h5>
                            <p>₹<?php echo $row['price']; ?></p>
                            <a href="book_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</body>

</html>