<?php
session_start();
include "../config/database.php";
if(!isset($_SESSION['role']) || $_SESSION["role"] != "admin"){
    header("location: ../index.php");
    exit();
}
$student = mysqli_query($conn, "SELECT id FROM users WHERE role = 'student'");
$subject = mysqli_query($conn, "SELECT id FROM subjects");
$enrollment = mysqli_query($conn, "SELECT id FROM enrollments");

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link
        href="../assets/vendor/bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Custom CSS -->
    <link
        href="../assets/css/style.css"
        rel="stylesheet"
    >
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">

            <span class="navbar-brand">
                Student Portal Admin
            </span>

            <a
                class="btn btn-outline-light btn-sm"
                href="../logout.php"
            >
                Logout
            </a>

        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">

        <h2>Admin Dashboard</h2>

       <p class="text-muted">
    Welcome, <?php echo isset($_SESSION["full_name"]) ? htmlspecialchars($_SESSION["full_name"]) : "NO NAME IN SESSION"; ?>.
</p>
        <div class="row g-3">

            <!-- Student Accounts -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                        <h6>Student Accounts</h6>

                        <h2><?php echo mysqli_num_rows($student)?></h2>

                        <a
                            href="students/index.php"
                            class="btn btn-primary btn-sm"
                        >
                            Manage Students
                        </a>

                    </div>
                </div>
            </div>

            <!-- Subjects -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                        <h6>Subjects</h6>

                        <h2><?php echo mysqli_num_rows($subject)?></h2>

                        <a
                            href="subjects/index.php"
                            class="btn btn-primary btn-sm"
                        >
                            Manage Subjects
                        </a>

                    </div>
                </div>
            </div>

            <!-- Enrollments -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                        <h6>Enrollments</h6>

                        <h2><?php echo mysqli_num_rows($enrollment)?></h2>

                        <span class="text-muted small">
                            Managed from Student Records
                        </span>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>