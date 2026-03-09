<?php
session_start();
if (!isset($_SESSION['userss'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Management System Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 bg-dark min-vh-100 p-3">

                <h4 class="text-white text-center mb-4">Dashboard</h4>

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

            </div>

            <!-- Content -->
            <div class="col-md-10 p-4">

                <h2>Student Management System</h2>

                <div class="row mt-4">

                    <div class="col-md-3">
                        <div class="card shadow p-3 text-center">
                            <a href="add_student.php">Add Student</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card shadow p-3 text-center">
                            <a href="view_students.php">View Students</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card shadow p-3 text-center">
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>