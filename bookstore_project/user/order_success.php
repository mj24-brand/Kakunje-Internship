<?php
$order_id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Placed</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow text-center p-4">

                    <h2 class="text-success">
                        ✔ Order Placed Successfully
                    </h2>

                    <p class="mt-3">
                        Your Order ID is <b>#<?php echo $order_id; ?></b>
                    </p>

                    <p>
                        Thank you for shopping with us!
                    </p>
                    <a href="home.php" class="btn btn-primary mt-3">
                        Continue Shopping
                    </a>
                    <a href="orders.php" class="btn btn-success mt-3">
                        View My Orders
                    </a>
                </div>

            </div>

        </div>

    </div>

</body>

</html>