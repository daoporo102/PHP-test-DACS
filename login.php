<?php
include 'includes/header.php'; 
require_once 'functions/myfunctions.php';
require_once 'config/connectdb.php';

if (isset($_POST['login_btn'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($pass);

    $login_query = "SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$password' ";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
       
        setcookie("username", $username, time() + 1209600);
        setcookie("password", $password, time() + 1209600);

            redirect("../admin/index.php","Welcome to Dashboard");
    } else {
        redirect("login.php","The account and password are incorrect. Please re-enter !");
    }
}
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Login Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">User name</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password">
                            </div>

                            <button type="submit" name="login_btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>




<?php include 'includes/footer.php'; ?>