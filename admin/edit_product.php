<?php
// Conexão com o banco de dados
include 'header.php';
// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_image = $_POST['product_image'];
    $product_image2 = $_POST['product_image2'];
    $product_image3 = $_POST['product_image3'];
    $product_image4 = $_POST['product_image4'];

    // Atualiza os dados do produto no banco de dados
    $sql = "UPDATE products SET product_name = ?, product_category = ?, product_image = ?, product_image2 = ?, product_image3 = ?, product_image4 = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $product_name, $product_category, $product_image, $product_image2, $product_image3, $product_image4, $product_id);

    if ($stmt->execute()) {
        //echo "Produto atualizado com sucesso.";
        header("Location: products.php");
        die();
    } else {
        echo "Erro ao atualizar o produto: " . $stmt->error;
    }
}

// Verifica se o product_id foi passado na query string
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Consulta para obter os dados do produto
    $sql = "SELECT * FROM products WHERE product_id = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o produto foi encontrado
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit();
    }
} else {
    echo "ID do produto não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <?php include 'links.php'; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php include "sidemenu.php"; ?>
            </div>
            <div class="col-9">
                <h1>Editar Produto</h1>
                <form action="edit_product.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <div class="form-group">
                        <label for="product_name">Nome do Produto:</label>
                        <input type="text" id="product_name" name="product_name" class="form-control" maxlength="100"
                            value="<?php echo $product['product_name']; ?>" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_category">Categoria do Produto:</label>
                        <input type="text" id="product_category" name="product_category" class="form-control"
                            maxlength="100" value="<?php echo $product['product_category']; ?>" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_image">Imagem do Produto:</label>
                        <input type="text" id="product_image" name="product_image" class="form-control" maxlength="255"
                            value="<?php echo $product['product_image']; ?>" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_image2">Imagem do Produto 2:</label>
                        <input type="text" id="product_image2" name="product_image2" class="form-control" maxlength="255"
                            value="<?php echo $product['product_image2']; ?>" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_image3">Imagem do Produto 3:</label>
                        <input type="text" id="product_image3" name="product_image3" class="form-control" maxlength="255"
                            value="<?php echo $product['product_image3']; ?>" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_image4">Imagem do Produto 4:</label>
                        <input type="text" id="product_image4" name="product_image4" class="form-control" maxlength="255"
                            value="<?php echo $product['product_image4']; ?>" required>
                    </div><br>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>