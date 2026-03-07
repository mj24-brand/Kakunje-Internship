<?php
include 'db.php';
session_start();

if(isset($_POST['login'])){
     $email=$_POST['email'];
     $password=$_POST['password'];

     $sql = "SELECT * FROM user1 WHERE email='$email' AND password='$password'";

     $result = mysqli_query($conn,$sql);

     if(mysqli_num_rows($result)==1){
        $_SESSION['email']=$email;
        header("Location: dashboard.php");
     }else{
        echo "invalid email or password";
     }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>User Login form</h2>
    <form action="" method="POST">
         Email:
        <input type="email" name="email" required>
        <br><br>
         Password:
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" name="login" value="login">
    </form>
    <br>
    <a href="register.php">Register Here</a>
</body>
</html>