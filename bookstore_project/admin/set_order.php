<?php
session_start();

if(isset($_GET['id'])){
    $_SESSION['order_id'] = $_GET['id'];
}

header("Location: order_details.php");
exit();
?>