<?php
include "../config/db.php";

$id = $_GET['id'];

mysqli_query($conn, "UPDATE payments SET status='Paid' WHERE id=$id");

header("Location: track_payments.php");
?>