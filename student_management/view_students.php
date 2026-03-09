<?php
session_start();
if(!isset($_SESSION['userss'])){
    header("Location: login.php");
    exit();
}
include 'db.php';

/* DELETE STUDENT */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id = $id");
    header("Location: view_students.php");
    exit();
}

/* FETCH ALLSTUDENTS */
$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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

<div class="d-flex">


<div class="container-fluid p-4">
    <h2>Student Details</h2>

    <div class="card shadow mt-3 p-3">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td>
                        <a href="edit_student.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-warning">Edit</a>

                        <a href="view_students.php?delete=<?php echo $row['id']; ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete the student?');">
                           Delete
                        </a>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>