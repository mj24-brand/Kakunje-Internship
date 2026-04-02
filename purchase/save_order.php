<?php
include "../config/db.php";

if (isset($_POST['supplier'])) {
    $supplier = $_POST['supplier'];
    $instructions = $_POST['instructions'];

    foreach ($_POST['item'] as $index => $item) {
        $qty = (int)$_POST['qty'][$index];
        $price = (float)$_POST['price'][$index];

        if (empty($item)) continue;

        // Insert each item as a separate PO row
        mysqli_query($conn, "INSERT INTO po 
        (item_name, supplier, quantity, price, created_at) 
        VALUES ('$item', '$supplier', $qty, $price, NOW())");
    }

    echo "<script>alert('Order Saved Successfully'); window.location='create_order.php';</script>";
}
?>