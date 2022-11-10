<?php
// session_start();
require_once 'myfunctions.php';
require_once '../config/connectdb.php';

if (isset($_POST['login_btn'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($pass);

    $login_query = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password' ";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
       
        setcookie("username", $username, time() + 1209600);
        setcookie("password", $password, time() + 1209600);

            redirect("../admin/index.php","Welcome to Dashboard");
    } else {
        redirect("../login.php","The account and password are incorrect. Please re-enter !");
    }
}
