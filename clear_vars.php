<?php
$url = $_GET['url'];
$_SESSION['cart'] = null;
header("Location: " . $url);
die();
?>