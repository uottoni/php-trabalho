<?php
$url = $_GET['url'];
$_SESSION['cart'] = null;
session_unset();
header("Location: " . $url);
die();
?>