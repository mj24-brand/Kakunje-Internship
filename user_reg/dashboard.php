<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location:login.php");
}

echo "Welcome".$_SESSION['email'];
?>

<br>
<br>
<a href="logout.php">Logout</a>