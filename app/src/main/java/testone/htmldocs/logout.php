<?php

session_start();

$_SESSION["loggedin"] = false;
$_SESSION["userid"] = NULL;
$_SESSION["names"] = NULL;
$_SESSION["email"] = NULL;
$_SESSION["pass"] = NULL;
$_SESSION["latecount"] = NULL;

header("location: login.php");

?>