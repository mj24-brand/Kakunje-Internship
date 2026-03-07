<?php
include 'db.php';

if(isset($_POST['register'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="INSERT INTO user1(name,email,password) 
    values('$name','$email','$password')";

    $result=mysqli_query($conn,$sql);

    if($result){
        echo "Registration Successful";
    }else{
        echo "Error:" .  mysqli_error($conn);
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
    <h2>User Registration form</h2>
    <form action="" method="POST">
        Name:
        <input type="text" name="name" required>
        <br><br>
         Email:
        <input type="email" name="email" required>
        <br><br>
         Password:
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" name="register" value="Register">
    </form>
    <br>
    <a href="login.php">Login Here</a>
</body>
</html>