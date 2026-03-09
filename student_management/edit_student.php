<?php
session_start();
include 'db.php';

if(!isset($_SESSION['userss'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

/* FETCH STUDENT DATA */
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$students = mysqli_fetch_assoc($result);

/* UPDATE QUERY */
if(isset($_POST['update'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    mysqli_query($conn, "UPDATE students 
                         SET name='$name',
                             email='$email',
                             course='$course'
                         WHERE id=$id");

    header("Location: view_students.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Student</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid p-4">

<h2>Edit Student</h2>

<div class="card shadow p-4 mt-3 col-md-6">

<form method="POST">

<div class="mb-3">

<label>Student Name</label>
<input type="text" 
name="name" 
value="<?php echo $students['name']; ?>" 
class="form-control" 
required>

</div>

<div class="mb-3">

<label>Email</label>
<input type="email" 
name="email" 
value="<?php echo $students['email']; ?>" 
class="form-control" 
required>

</div>

<div class="mb-3">

<label>Course</label>
<input type="text" 
name="course" 
value="<?php echo $students['course']; ?>" 
class="form-control" 
required>

</div>

<button type="submit" name="update" class="btn btn-primary">
Update Student
</button>

<a href="view_students.php" class="btn btn-secondary">
Cancel
</a>

</form>

</div>

</div>

</body>
</html>