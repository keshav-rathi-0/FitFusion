<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFusion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="container">
        <div class="header-inner">
            <a href="index.php" class="logo">FitFusion</a>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Shop</a></li>
                    <li><a href="workouts.php">Workouts</a></li>
                    <li><a href="nutrition.php">Nutrition</a></li>
                    <li><a href="community.php">Community</a></li>
                </ul>
            </nav>
            <div class="header-icons">
                <div>🔍</div>
                <div>👤</div>
                <div>❤️</div>
                <div class="cart-icon">
                    🛒
                    <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                </div>
            </div>
        </div>
    </div>
</header>