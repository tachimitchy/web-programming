<?php 
session_start();/* multiple page in one file */
include "config/database.php";

//update the dashboard to the right dashboard base on role
if(isset($_SESSION["role"])){
    if(($_SESSION["role"]=="admin")){
        header ("Location: admin/dashboard.php");
    }
    else{
         header ("Location: student/dashboard.php");
    }
    exit();
}
$error = "";
if(isset($_POST["login"])){
    //get data from login form
    $username = mysqli_escape_string($conn, $_POST["username"]);
    $passsword = $_POST["password"];
    //find the user by username
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn,$sql);
    if ($result === false) {
    die("SQL Error: " . mysqli_error($conn));
}
    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        if(password_verify($passsword,$user["password"])){
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["full_name"] = $user['full_name'];
            $_SESSION["role"] = $user['role'];
            if($user['role'] == "admin"){
                header("Location: admin/dashboard.php");
            }
            else{
                header("Location: student/dashboard.php");
            }
            exit();
        }
    }
    $error = "Invalid username or password";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Student Portal</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="login-box">
        <div class="card"><div class="card-body p-4">
            <h2 class="text-center">Student Portal</h2>
            <p class="text-center text-muted">Admin and Student Login</p>
            <?php if($error != ""){?>
            <div class = "alert alert-danger"><?php echo $error; ?></div>
            <?php }?>
            <form method = "POST" >
                <div class="mb-3"><label class="form-label">Username</label><input type="text" name = "username" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Password</label><input type="password" name = "password" class="form-control"></div>
                <button class="btn btn-primary w-100" type="submit" name = "login">Login</button>
            </form>
        </div></div>
    </div>
</div>
</body>
</html>
