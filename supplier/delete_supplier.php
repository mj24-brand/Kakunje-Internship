<?php
include "../config/db.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM suppliers WHERE id=$id");

header("Location: supplier_directory.php");
?>