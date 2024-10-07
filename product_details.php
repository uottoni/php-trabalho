<?php
include 'header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
    $quantity = intval($_POST['quantity']);
    $product_id = intval($_POST['product_id']);
    $product_price = floatval($_POST['product_price']);
    if ($quantity > 0) {
        $cart_item = [
            'product_id' => $product_id,
            'product_name' => $_POST['product_name'],
            'product_price' => $product_price,
            'quantity' => $quantity
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if the product is already in the cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $product_id) {
                $item['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $cart_item;
        }

        // Redirect to the cart page or show a success message
        header('Location: cart.php');
        exit;
    } else {
        echo "Quantidade inválida.";
        exit;
    }
}

// Verifique se o product_id está presente na URL
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    // Prepare a consulta SQL para buscar os dados do produto
    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se o produto foi encontrado
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "ID do produto não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <?php include 'links.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo htmlspecialchars($product['product_image']); ?>" class="d-block w-100"
                                alt="Imagem do Produto">
                        </div>
                        <?php for ($i = 2; $i <= 4; $i++): ?>
                            <?php if (!empty($product['product_image' . $i])): ?>
                                <div class="carousel-item">
                                    <img src="<?php echo htmlspecialchars($product['product_image' . $i]); ?>"
                                        class="d-block w-100" alt="Imagem do Produto <?php echo $i; ?>">
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
                <p><?php echo htmlspecialchars($product['product_description']); ?></p>
                <h3>Preço: R$ <?php echo number_format($product['product_price'], 2, ',', '.'); ?></h3>
                <form action="product_details.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
                    <div class="form-group">
                        <label for="quantity">Quantidade:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>