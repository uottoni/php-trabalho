<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    if (is_null($order_id)) {
        header('Location: sidemenu.php');
        exit();
    }
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    if ($stmt->execute()) {
        $stmt->close();
        header('Location: sidemenu.php');
        exit();
    } else {
        $error = "Erro ao remover o pedido";
    }
}
?>
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
    <title>Delete Order <?php $order_id ?></title>
</head>

<body>
    <?php include "sidemenu.php"; ?>
    <h5>Tem certeza que deseja remover o pedido <?php echo $order_id ?>?</h5>
    <form action="delete_order.php" method="POST">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <span class="text-danger"><?php if (!is_null($error))
            echo $error; ?></span><br><br>
        <button type="submit" class="btn btn-primary">Remover</button>
    </form>
</body>

</html>