<?php
$conn=mysqli_connect("localhost","root","","news_portal");

if(!$conn){
    die("Connection Failed:" . mysqli_connect_error());
}
?>