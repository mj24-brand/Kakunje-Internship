<?php
session_start();
include("../config/db.php");

$id = $_GET['id'];

$query = mysqli_query($conn, "
SELECT * FROM book_post WHERE id='$id'
");

$row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="book-details" style="background-image:url('../assets/addtype1.jpg'); 
background-size:cover; 
background-position:center; 
background-repeat:no-repeat; 
min-height:100vh;">

    <div class="container mt-5" style="border 2px solid black; background: linear-gradient(135deg,#fbc2eb,#a6c1ee); padding: 28px;">

        <div class="row">

            <div class="col-md-5">

                <img src="../admin/uploads/<?php echo $row['image']; ?>" class="img-fluid">

            </div>

            <div class="col-md-7">

                <h2><?php echo $row['title']; ?></h2>

                <p><b>Author:</b> <?php echo $row['author']; ?></p>

                <p><?php echo $row['description']; ?></p>

                <h4 class="text-success">₹<?php echo $row['price']; ?></h4>

                <a href="cart.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                    Add to Cart
                </a>

                <a href="home.php" class="btn btn-secondary">
                    Back
                </a>

            </div>
        </div>
    </div>
</body>

</html>