<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit;
}

$product = getProductById($conn, $_GET['id']);
?>

<?php include 'includes/header.php'; ?>

<main class="container">
    <div class="product-detail">
        <img src="images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <div class="product-info">
            <h1><?= $product['name'] ?></h1>
            <p class="price">$<?= $product['price'] ?></p>
            <p class="description"><?= $product['description'] ?></p>
            <a href="cart.php?action=add&id=<?= $product['id'] ?>" class="add-to-cart">Add to Cart</a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>