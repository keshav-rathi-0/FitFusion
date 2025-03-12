<?php
session_start();

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process order here
    unset($_SESSION['cart']);
    header("Location: thank-you.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<main class="container">
    <h1>Checkout</h1>
    
    <form method="POST">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="address">Shipping Address</label>
        <textarea id="address" name="address" required></textarea>
        
        <button type="submit">Place Order</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>