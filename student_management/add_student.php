<?php
session_start();
include 'db.php';

if (!isset($_SESSION['userss'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if (isset($_POST['add_student'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $course = isset($_POST['course']) ? $_POST['course'] : '';

    if (!empty($name) && !empty($email) && !empty($course)) {

        $query = "INSERT INTO students (name,email,course) 
                  VALUES ('$name','$email','$course')";

        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert alert-success'>Student Added Successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }

    } else {
        $message = "<div class='alert alert-warning'>All fields are required!</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<div class="list-group">

    <a href="dashboard.php" class="list-group-item list-group-item-action">
        Dashboard
    </a>

    <a href="add_student.php" class="list-group-item list-group-item-action">
        Add Student
    </a>

    <a href="view_students.php" class="list-group-item list-group-item-action">
        View Students
    </a>

    <a href="logout.php" class="list-group-item list-group-item-action">
        Logout
    </a>

</div>

<body class="bg-light">

    <div class="container mt-5">

        <h2 class="mb-4">Add Student</h2>

        <?php echo $message; ?>

        <div class="card shadow p-4 col-md-6">

            <form method="POST">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="name" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Course</label>
                    <input type="text" name="course" class="form-control" required>
                </div>

                <button type="submit" name="add_student" class="btn btn-primary w-100">
                    Add Student
                </button>

            </form>

        </div>

    </div>

</body>

</html>