<?php
session_start();
include 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: products.php');
    exit;
}

$product_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: products.php');
    exit;
}
?>

<section>
    <div class="container">
        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="product-info">
                <h1><?php echo $product['name']; ?></h1>
                <p><?php echo $product['description']; ?></p>
                <div class="product-price">
                    <span class="current-price">$<?php echo $product['price']; ?></span>
                    <?php if ($product['old_price']): ?>
                        <span class="old-price">$<?php echo $product['old_price']; ?></span>
                    <?php endif; ?>
                </div>
                <div class="product-action">
                    <a href="cart_actions.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>