<?php
include "../config/db.php";

$id = $_POST['id'];
$status = $_POST['status'];

mysqli_query($conn, "UPDATE suppliers SET status='$status' WHERE id=$id");

header("Location: supplier_directory.php");
?>