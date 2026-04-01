<?php
include "../config/db.php";

if (isset($_POST['item_id'])) {

    $id = $_POST['item_id'];
    $sold_qty = $_POST['qty'];
    $result = mysqli_query($conn, "SELECT quantity, price FROM inventory WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    $current_stock = $row['quantity'];
    $price = $row['price']; 
    if ($sold_qty > $current_stock) {
        echo "<script>alert('❌ Not enough stock!'); window.location='record_sale.php';</script>";
        exit();
    }

    $new_stock = $current_stock - $sold_qty;
    mysqli_query($conn, "UPDATE inventory SET quantity=$new_stock WHERE id=$id");

    $total = $sold_qty * $price;

    mysqli_query($conn, "INSERT INTO sales (item_id, quantity, total) 
    VALUES ($id, $sold_qty, $total)");

    echo "<script>alert('✅ Sale Recorded Successfully'); window.location='record_sale.php';</script>";
}
?>