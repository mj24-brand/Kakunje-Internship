<?php
session_start();
include "../config/db.php";

if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $query="SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)>0){
        $_SESSION['admin']=$username;
        header("Location:dashboard.php");
        exit();
    }else{
        $error="Invalid Username or password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-dark">

    <div class="container">
        <div class="row justify-content-center mt-5">

            <div class="col-md-4">

                <div class="card p-4 shadow">

                    <h3 class="text-center">ADMIN LOGIN</h3>

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label >Username</label>
                            <input name="username" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <button name="login" class="btn btn-primary w-100">Login</button><br><br>
                        <button type="submit" name="welcome" class="btn btn-primary w-100"><a href="../welcome.html" style="color:white">WELCOME PAGE</a></button>

                    </form>
                    <?php if(isset($error)){ ?>
                    <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

</body>

</html>