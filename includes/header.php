<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFusion</title>
    <link rel="stylesheet" href="/fitness_ecommerce/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="index.php" class="logo">FitFusion</a>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="cart.php">Cart (<?= count($_SESSION['cart'] ?? []) ?>)</a></li>
                </ul>
            </nav>
        </div>
    </header>