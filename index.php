<?php
session_start();
include 'includes/header.php';

// Fetch products from the database
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero">
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1>ELEVATE YOUR FITNESS JOURNEY</h1>
                <p>Discover premium equipment and innovative workout gear designed to push your limits and transform your training experience.</p>
                <a href="products.php" class="btn btn-primary">EXPLORE COLLECTION</a>
            </div>
            <div class="hero-image">
                <div class="product-3d">
                    <img src="/api/placeholder/400/400" alt="Smart Fitness Watch">
                </div>
                <div class="product-shadow"></div>
            </div>
        </div>
    </div>
</section>
</section>

<section class="featured-products">
    <div class="container">
        <div class="section-title">
            <h2>TRENDING NOW</h2>
        </div>
        <div class="featured-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="product-info">
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