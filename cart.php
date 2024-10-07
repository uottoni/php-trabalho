<?php
include "header.php";

function calculateTotal($cart)
{
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['product_price'] * $item['quantity'];
    }
    return $total;
}

if (isset($_POST['remove'])) {
    $id = $_POST['remove'];
    unset($_SESSION['cart'][$id]);
}

if (isset($_POST['update'])) {
    $quantity = intval($_POST['quantity']);
    $product_id = intval($_POST['update']);
    //$product_price = floatval($_POST['product_price']);
    if ($quantity > 0) {
        // $cart_item = [
        //     'product_id' => $product_id,
        //     'product_name' => $_POST['product_name'],
        //     'product_price' => $product_price,
        //     'quantity' => $quantity
        // ];

        // if (!isset($_SESSION['cart'])) {
        //     $_SESSION['cart'] = [];
        // }

        // Check if the product is already in the cart
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $product_id) {
                $item['quantity'] = $quantity;
                $found = true;
                break;
            }
        }

        // if (!$found) {
        //     $_SESSION['cart'][] = $cart_item;
        // }

        // Redirect to the cart page or show a success message
        header('Location: cart.php');
        exit;
    } else {
        echo "Quantidade inválida.";
        exit;
    }
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = calculateTotal($cart);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Shopping Cart</h2>
        <a href="clear_vars.php?url=cart.php" class="btn btn-primary mb-4">Limpar VARS</a>
        <div class="row">
            <div class="col-9">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $id => $item): ?>
                            <tr>
                                <td><?php echo $item['product_name']; ?></td>
                                <td><?php echo number_format($item['product_price'] ?? 0, 2); ?></td>
                                <td>
                                    <form method="post" class="form-inline">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>"
                                            class="form-control mr-2" min="1">
                                        <button type="submit" name="update" value="<?php echo $item['product_id']; ?>"
                                            class="btn btn-primary">Update</button>
                                    </form>
                                </td>
                                <td><?php echo number_format($item['product_price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <form method="post">
                                        <button type="submit" name="remove" value="<?php echo $item['product_id']; ?>"
                                            class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="col-3 text-right">
                <div class="text-right">
                    <h4>Total: <?php echo number_format($total, 2); ?></h4>
                </div>
                <a href="products.php" class="btn btn-primary w-100 mt-3">Continuar Comprando</a>
                <a href="checkout.php" class="btn btn-success w-100 mt-3">Checkout</a>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
</form>