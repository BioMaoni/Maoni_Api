<?php
session_start();
$_SESSION['ID'] = "abc";
if(!(isset($_SESSION['ID']) && isset($_SESSION['email']) && $_SESSION['ID'] >= 1)){
    echo "shit";
    $_SESSION['ID'] = NULL;
    $_SESSION['email'] = NULL;
    session_destroy();
    header("Location: ../views/login.php");
}