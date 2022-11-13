<?php

if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    setcookie("username", $username, time() - 3600);
    setcookie("password", $password, time() - 3600);
    // $_SESSION['message']= "Logged Out Successfully";
}
header("Location:login.php");
?>