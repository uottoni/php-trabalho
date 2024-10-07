<?php
include "header.php"; 
 if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header('Location: login.php');
    exit();
} ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <?php include "sidemenu.php"; ?>
</body>
</html>