<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['nome']);
    unset($_SESSION['id']);
    session_destroy();
    header('Location: index.php');
    exit();
?>
