<?php
session_start();
include 'includes/header.php';

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$total = 0;
?>

<section>
    <div class="container">
        <h2>Checkout</h2>
        <form action="process_order.php" method="POST">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>