<?php
include "../config/db.php";

$id = $_POST['id'];
$supplies = $_POST['supplies'];

mysqli_query($conn, "UPDATE suppliers SET supplies='$supplies' WHERE id=$id");

header("Location: supplier_directory.php");
?>