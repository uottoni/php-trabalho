<?php
$order_id = $_GET['order_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['order_status'] == '0'){
        $error = "Selecione um status para o pedido";
    }
    else{
        //atualizar order_status no banco de dados com uma query parametizada
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $_POST['order_status'], $order_id);
        $stmt->execute();
        $stmt->close();
        header('Location: sidemenu.php');
        exit();
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
    <title>Home</title>
</head>
<body>
    <?php include "sidemenu.php"; ?>
    <form action="update_order.php?" method="POST">
    <select name="order_status" id="order_status" class="form-select" required>
        <option value="0">Selecione o status do pedido</option>
        <option value="on_hold">Pedido Recebido</option>
        <option value="paid">Pedido em Preparo</option>
        <option value="shipped">Pedido Saiu para Entrega</option>
        <option value="delivered">Pedido Entregue</option>
    </select>
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
    <span class="text-danger"><?php if(!is_null($error)) echo $error; ?></span><br><br>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</body>
</html>