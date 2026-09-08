<?php
 include "Database/connection.php";

 if(isset($_POST["register"])){
    $student_no = $_POST["student_no"];
    $full_name = $_POST["full_name"];
    $course = $_POST["course"];
    
    $sql = "INSERT INTO students(
                    student_no,
                    student_name,
                    course
                )
                VALUES(
                    '$student_no',
                    '$full_name',
                    '$course'
                )
    ";

    if(mysqli_query($conn, $sql)){
        header("Location: registration_page.php?info=Student registered successfully!");
        exit();
    }
    else{
        header("Location: registration_page.php?info=".urlencode(mysqli_error($conn)));
        exit();
    }

 }
?>