<?php
session_start();
include 'includes/header.php';

// Fetch all products
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="featured-products">
    <div class="container">
        <div class="section-title">
            <h2>ALL PRODUCTS</h2>
        </div>
        <div class="featured-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <span class="product-badge"><?php echo $product['category']; ?></span>
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="product-info">
                        <div class="product-category"><?php echo $product['category']; ?></div>
                        <h3 class="product-name"><?php echo $product['name']; ?></h3>
                        <div class="product-price">
                            <span class="current-price">$<?php echo $product['price']; ?></span>
                            <?php if ($product['old_price']): ?>
                                <span class="old-price">$<?php echo $product['old_price']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="product-action">
                            <a href="cart_actions.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-primary">Add to Cart</a>
                            <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-outline">Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>