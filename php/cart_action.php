<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'], $_GET['id'])) {
    $action = $_GET['action'];
    $product_id = (int)$_GET['id'];

    // Validate product ID
    if ($product_id <= 0) {
        die("Invalid product ID.");
    }

    // Check if the product exists in the database
    try {
        $stmt = $pdo->prepare("SELECT id FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Product not found.");
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }

    // Initialize the cart in session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Perform the requested action
    switch ($action) {
        case 'add':
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = 1; // Add new product with quantity 1
            } else {
                $_SESSION['cart'][$product_id]++; // Increment quantity
            }
            break;

        case 'remove':
            unset($_SESSION['cart'][$product_id]); // Remove product from cart
            break;

        default:
            die("Invalid action.");
    }

    // Redirect back to the cart page
    header('Location: cart.php');
    exit;
} else {
    die("Invalid request.");
}
?>