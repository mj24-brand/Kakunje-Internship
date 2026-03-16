<?php
$conn=mysqli_connect("localhost","root","","bookstore");

if(!$conn){
    die("Connection Error:". mysqli_connect_error());
}
?>