<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
$products = getProducts($conn);
?>

<?php include 'includes/header.php'; ?>

<main class="container">
    <h1>All Products</h1>
    
    <div class="product-grid">
        <?php foreach($products as $product): ?>
        <div class="product-card">
            <div class="product-image">
                <img src="images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
            </div>
            <h3><?= $product['name'] ?></h3>
            <p>$<?= $product['price'] ?></p>
            <a href="product-detail.php?id=<?= $product['id'] ?>">View Details</a>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>