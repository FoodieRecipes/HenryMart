<?php
require_once "config/auth.php";
require_once "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - HenryMart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/products.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">🍔 HenryMart</div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart (<span id="cart-count">0</span>)</a></li>
                <li><a href="checkout.php">Checkout</a></li>
            </ul>
        </nav>
    </header>

    <section class="section">
        <h2>All Products</h2>
        <div class="products-grid" id="all-products"></div>
    </section>

    <footer>
        <p>&copy; 2026  HenryMart • Henrymart.store</p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/products.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => renderProducts('all-products', products));
    </script>
</body>
</html>