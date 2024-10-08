<?php include 'header.php'; ?>
<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $order_id = $conn->insert_id;
    $stmt->close();

    //inserir itens do pedido armaenados em $_SESSION['cart']

    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, order_date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $order_id, $product_id, $quantity, $order_date);
        $stmt->execute();
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <?php include 'links.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3">

                <?php
                if (!isset($_SESSION['user_id'])) {

                    echo '<p>Você precisa estar logado para finalizar a compra. <a href="cadastro.php">Cadastre-se aqui</a></p>';
                    echo '<p>Entre com suas credenciais. <a href="login.php">Entrar aqui</a></p>';
                } else {
                    // Confirmar endereço do usuário
                    $user_id = $_SESSION['user_id'];

                    // Consulta para obter os dados do produto
                    $sql = "SELECT * FROM users WHERE user_id = ? LIMIT 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Verifica se o produto foi encontrado
                    if ($result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                        $cidade = $user['shipping_city'];
                        $uf = $user['shipping_uf'];
                        $endereco = $user['shipping_address'];
                    } else {
                        echo "Usuário não encontrado.";
                        exit();
                    }



                    echo '<label for="shipping_address">Endereço:</label>';
                    echo '<input type="text" id="shipping_address" name="shipping_address" value="' . htmlspecialchars($endereco) . '" required><br>';
                    echo '<label for="shipping_city">Cidade:</label>';
                    echo '<input type="text" id="shipping_city" name="shipping_city" value="' . htmlspecialchars($cidade) . '" required><br>';
                    echo '<label for="shipping_uf">UF:</label>';
                    echo '<input type="text" id="shipping_uf" name="shipping_uf" value="' . htmlspecialchars($uf) . '" required><br>';
                    echo '<button type="submit">Finalizar Compra</button>';
                    echo '</form>';

                }
                ?>

            </div>

        </div>
    </div>

    <script>
        function checkoutPaypal() {
            // Chame a função de checkout do PayPal aqui
            console.log('Iniciando checkout do PayPal...');
            // Exemplo: paypal.Buttons().render('#paypal-button-container');
        }
    </script>
</body>

</html>