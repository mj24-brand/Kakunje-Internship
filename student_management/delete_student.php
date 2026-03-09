<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

include("db.php");

/* DELETE STUDENT */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id = $id");
    header("Location: view_students.php");
    exit();
}