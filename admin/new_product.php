<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Produto</title>
    <?php include 'links.php'; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <?php include "sidemenu.php"; ?>
            </div>
            <div class="col-9">
                <h1>Adicionar Novo Produto</h1>
                <form action="process_new_product.php" method="post">
                    <div class="form-group">
                        <label for="product_name">Nome do Produto:</label>
                        <input type="text" id="product_name" name="product_name" class="form-control" maxlength="100"
                            required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_category">Categoria do Produto:</label>
                        <input type="text" id="product_category" name="product_category" class="form-control"
                            maxlength="100" required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_description">Descrição:</label>
                        <textarea id="product_description" name="product_description" class="form-control"
                            maxlength="250"></textarea>
                    </div><br>

                    <div class="form-group">
                        <label for="product_image">Imagem do Produto:</label>
                        <input type="text" id="product_image" name="product_image" class="form-control" maxlength="250">
                    </div><br>

                    <div class="form-group">
                        <label for="product_image2">Imagem do Produto 2:</label>
                        <input type="text" id="product_image2" name="product_image2" class="form-control"
                            maxlength="250">
                    </div><br>

                    <div class="form-group">
                        <label for="product_image3">Imagem do Produto 3:</label>
                        <input type="text" id="product_image3" name="product_image3" class="form-control"
                            maxlength="250">
                    </div><br>

                    <div class="form-group">
                        <label for="product_image4">Imagem do Produto 4:</label>
                        <input type="text" id="product_image4" name="product_image4" class="form-control"
                            maxlength="250">
                    </div><br>

                    <div class="form-group">
                        <label for="product_price">Preço:</label>
                        <input type="number" id="product_price" name="product_price" class="form-control" step="0.01"
                            required>
                    </div><br>

                    <div class="form-group">
                        <label for="product_special_offer">Oferta Especial:</label>
                        <input type="number" id="product_special_offer" name="product_special_offer"
                            class="form-control" min="0" max="99">
                    </div><br>

                    <div class="form-group">
                        <label for="product_color">Cor do Produto:</label>
                        <input type="text" id="product_color" name="product_color" class="form-control" maxlength="100">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                </form>
            </div>
        </div>

</body>

</html>