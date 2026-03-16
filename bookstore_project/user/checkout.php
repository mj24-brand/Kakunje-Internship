<?php
session_start();
include("../config/db.php");

$customer = $_SESSION['customer_id'];

//Create new order 
mysqli_query($conn, "
INSERT INTO orders(customer_id,order_status)
VALUES('$customer','Pending')
");

$order_id = mysqli_insert_id($conn);

// Get cart items 
$cart = mysqli_query($conn, "
SELECT * FROM cart
WHERE customer_id='$customer'
");

while ($row = mysqli_fetch_assoc($cart)) {

    $product = $row['product_id'];
    $qty = $row['quantity'];

    // Get book price 
    $book = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT price FROM book_post WHERE id='$product'
"));

    $price = $book['price'];

    // Insert order items 
    mysqli_query($conn, "
INSERT INTO order_items(order_id,product_id,quantity,price)
VALUES('$order_id','$product','$qty','$price')
");

}

// Clear cart 
mysqli_query($conn, "
DELETE FROM cart WHERE customer_id='$customer'
");

//Redirect to success page 
header("Location: order_success.php?id=" . $order_id);
exit();
?>