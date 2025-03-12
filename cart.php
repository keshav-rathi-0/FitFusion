<?php
session_start();

// Handle cart actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $productId = $_GET['id'];
    
    switch ($_GET['action']) {
        case 'add':
            if (!in_array($productId, $_SESSION['cart'] ?? [])) {
                $_SESSION['cart'][] = $productId;
            }
            break;
        case 'remove':
            $_SESSION['cart'] = array_diff($_SESSION['cart'], [$productId]);
            break;
    }
}

require_once 'includes/db.php';
require_once 'includes/functions.php';
?>

<?php include 'includes/header.php'; ?>

<main class="container">
    <h1>Shopping Cart</h1>
    
    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $productId): ?>
            <?php $product = getProductById($conn, $productId); ?>
            <div class="cart-item">
                <img src="images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <h3><?= $product['name'] ?></h3>
                <p>$<?= $product['price'] ?></p>
                <a href="cart.php?action=remove&id=<?= $productId ?>">Remove</a>
            </div>
        <?php endforeach; ?>
        <a href="checkout.php" class="checkout-button">Proceed to Checkout</a>
    <?php else: ?>
        <p>Your cart is empty</p>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>