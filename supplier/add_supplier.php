<?php
include "../config/db.php";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $supplies = $_POST['supplies'];
    $status = $_POST['status'];

    $query = "INSERT INTO suppliers(name, category, email, phone, address, supplies, status)
              VALUES('$name','$category','$email','$phone','$address','$supplies','$status')";

    mysqli_query($conn, $query);

    header("Location: supplier_directory.php");
}
?>