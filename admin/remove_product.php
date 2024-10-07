<?php
// Conexão com o banco de dados
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    // Atualiza os dados do produto no banco de dados
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        //echo "Produto atualizado com sucesso.";
        header("Location: products.php");
        die();
    } else {
        echo "Erro ao atualizar o produto: " . $stmt->error;
    }
}
?>