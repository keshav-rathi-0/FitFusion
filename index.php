<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
$products = getProducts($conn);
?>

<?php include 'includes/header.php'; ?>

<main class="container">
    <section class="hero">
        <h1>Transform Your Fitness Journey</h1>
        <a href="products.php" class="cta-button">Shop Now</a>
    </section>

    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="featured-grid">
            <?php foreach(array_slice($products, 0, 3) as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                </div>
                <h3><?= $product['name'] ?></h3>
                <p>$<?= $product['price'] ?></p>
                <a href="product-detail.php?id=<?= $product['id'] ?>">View Product</a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>