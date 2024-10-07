<?php
// Conexão com o banco de dados
include ("header.php");

// Definindo o número de itens por página
$items_per_page = 5;

// Obtendo o número da página atual
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// Calculando o deslocamento (offset)
$offset = ($page - 1) * $items_per_page;

// Consulta para obter o total de produtos
$total_sql = "SELECT COUNT(*) as total FROM products";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];

// Consulta para obter os produtos com paginação
$sql = "SELECT product_id, product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4, product_price, product_special_offer, product_color FROM products LIMIT $items_per_page OFFSET $offset";
$result = $conn->query($sql);
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
                <?php include "sidemenu.php"; ?>
            </div>
            <div class="col-9">
            <h2 class="mb-4">Lista de Produtos</h2>
        <a href="new_product.php" class="btn btn-primary mb-4">Adicionar Produto</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["product_id"] . "</td>";
                        echo "<td><img src='" . $row["product_image"] . "' alt='Imagem do Produto' width='50'></td>";
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . $row["product_price"] . "</td>";
                        echo "<td>" . $row["product_category"] . "</td>";
                        echo "<td>
                                <a href='editar_imagem.php?product_id=" . $row["product_id"] . "' class='btn btn-primary btn-sm'>Editar Imagem</a>
                                <a href='edit_product.php?product_id=" . $row["product_id"] . "' class='btn btn-warning btn-sm'>Editar Produto</a>
                                <form action='remove_product.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='product_id' value='" . $row["product_id"] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Excluir</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum produto encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Paginação -->
        <nav>
            <ul class="pagination">
                <?php
                $total_pages = ceil($total_items / $items_per_page);
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($i == $page) ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' href='products.php?page=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>