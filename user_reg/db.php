<?php

$conn = mysqli_connect("localhost", "root", "", "user_login");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>