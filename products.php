<?php
// Include header and footer
include 'header.php';
//include 'footer.php';



// Fetch products from the database
$products_per_page = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $products_per_page;

$stmt = $conn->prepare("SELECT * FROM products LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $products_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>


<?php include('layouts/header.php'); ?>

<section id="home">
    <h1>Produtos</h1>
    <div class="container">
        <div class="row">
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-3">
                    <div class="card">
                        <img src="<?= $product['product_image'] ?>" class="card-img-top"
                            alt="<?= $product['product_name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['product_name'] ?></h5>
                            <p class="card-text">Preço: R$<?= $product['product_price'] ?></p>
                            <p class="card-text">Categoria: <?= $product['product_category'] ?></p>
                            <p class="card-text">Descrição: <?= $product['product_description'] ?></p>
                            <a href="product_details.php?product_id=<?= $product['product_id'] ?>"
                                class="btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>


    </div>
    <?php
    // Pagination logic
    $total_products_query = "SELECT COUNT(*) as total FROM products";
    $total_products_result = $conn->query($total_products_query);
    $total_products = $total_products_result->fetch_assoc()['total'];
    $total_pages = ceil($total_products / $products_per_page);
    ?>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

    <?php
    // Close database connection
    $conn->close();
    ?>
</section>

<?php include('layouts/footer.php'); ?>