<?php include 'header.php'; 
//carregar os dados do usuário
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
?>
<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //processar o pedido
    $order_cost = 100.00;
    $order_status = 'Pendente';
    $shipping_city = 'São Paulo';
    $shipping_uf = 'SP';
    $shipping_address = 'Rua Exemplo, 123';
    $order_date = date('Y-m-d H:i:s');

    //supondo que você tenha uma conexão com o banco de dados em $conn
    $sql = "INSERT INTO orders (order_cost, order_status, user_id, shipping_city, shipping_uf, shipping_address, order_date) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dsissss", $order_cost, $order_status, $user_id, $shipping_city, $shipping_uf, $shipping_address, $order_date);

    if ($stmt->execute()) {
        echo '<p>Pedido criado com sucesso!</p>';
    } else {
        echo '<p>Erro ao criar o pedido: ' . $stmt->error . '</p>';
    }

    $stmt->close();
}


if (!isset($_SESSION['user_id'])) {
    echo '<p>Você precisa estar logado para finalizar a compra. <a href="cadastro.php">Cadastre-se aqui</a></p>';
} else {
    // Confirmar endereço do usuário
    $user_id = $_SESSION['user_id'];
    // Supondo que você tenha uma função para buscar o endereço do usuário
    $endereco = getUserAddress($user_id);
    
    if ($endereco) {
        echo '<p>Endereço de entrega: ' . htmlspecialchars($endereco) . '</p>';
        echo '<button onclick="checkoutPaypal()">Finalizar Compra com PayPal</button>';
    } else {
        echo '<p>Por favor, confirme seu endereço de entrega. <a href="endereco.php">Atualizar endereço</a></p>';
    }
}
?>
<script>
function checkoutPaypal() {
    // Chame a função de checkout do PayPal aqui
    console.log('Iniciando checkout do PayPal...');
    // Exemplo: paypal.Buttons().render('#paypal-button-container');
}
</script>

