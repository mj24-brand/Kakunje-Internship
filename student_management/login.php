<?php
session_start();
include 'db.php';
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM userss WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['userss'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
<title>User Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card p-4 shadow">
                <h3 class="text-center">User Login</h3>
                <form method="POST">
    <div class="mb-3">
        <label>Email</label>
        <input name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button name="login" class="btn btn-primary w-100">Login</button>
</form>

<?php if(isset($error)){ ?>
    <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
<?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>