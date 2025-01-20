<?php
session_start();
header("Location: ./login.php");

setcookie("user", "", -1, "/");
?>