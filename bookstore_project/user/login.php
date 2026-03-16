<?php
session_start();
include "../config/db.php";

$error = '';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user by email
    $query = mysqli_query($conn, "SELECT * FROM customer WHERE email='$email' LIMIT 1");
    if(mysqli_num_rows($query) > 0){
        $user = mysqli_fetch_assoc($query);

        // Verify password
        if(password_verify($password, $user['password'])){
            $_SESSION['customer_id'] = $user['id'];
            $_SESSION['customer_name'] = $user['name'];
            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - Online Bookstore</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/style.css" rel="stylesheet">
</head>
<body class="login-body">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="login-card p-4 shadow rounded">
                <h3 class="text-center mb-3">CUSTOMER LOGIN</h3>

                <?php if(!empty($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form method="POST">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center mt-3">Don't have an account? <a href="register.php">Register</a></p>
                <button type="submit" name="welcome" class="btn btn-primary w-100"><a href="../welcome.html" style="color:white">WELCOME PAGE</a></button>
            </div>
        </div>
    </div>
</div>

</body>
</html>