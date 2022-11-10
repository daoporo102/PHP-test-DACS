<?php

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    setcookie("username", $username, time() - 1209600);
    setcookie("password", $password, time() - 1209600);
    // $_SESSION['message']= "Logged Out Successfully";
}
header("Location:login.php");
?>