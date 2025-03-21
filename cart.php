<?php
session_start();
include 'db_config.php';

// Fetch cart items from session
$cart = $_SESSION['cart'] ?? [];

// Fetch product details from the database
$cartItems = [];
$total = 0;

if (!empty($cart)) {
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($cart));
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate total price
    foreach ($cartItems as $item) {
        $total += $item['price'] * $cart[$item['id']];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - FitFusion</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Your Cart</h1>
    <?php if (!empty($cartItems)): ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $cart[$item['id']]; ?></td>
                    <td>$<?php echo number_format($item['price'] * $cart[$item['id']], 2); ?></td>
                    <td>
                        <a href="cart_actions.php?action=remove&id=<?php echo $item['id']; ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><strong>Total:</strong> $<?php echo number_format($total, 2); ?></p>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>