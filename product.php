<?php
require_once "config/auth.php";
require_once "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - HenryMart</title>
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
            </ul>
        </nav>
    </header>

    <section class="section" style="max-width:1100px; margin:0 auto;">
        <div id="product-detail" style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:center;">
            <!-- Dynamically filled by JavaScript -->
        </div>
    </section>

    <footer>
        <p>&copy; 2026  HenryMart • Henrymart.store</p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/products.js"></script>
    <script>
        function loadProductDetails() {
            const urlParams = new URLSearchParams(window.location.search);
            const productId = parseInt(urlParams.get('id'));
            const product = products.find(p => p.id === productId);

            if (!product) {
                document.getElementById('product-detail').innerHTML = `<h2>Product not found</h2>`;
                return;
            }

            document.getElementById('product-detail').innerHTML = `
                <div>
                    <img src="${product.image}" style="width:100%; border-radius:16px;" alt="${product.name}">
                </div>
                <div>
                    <h1>${product.name}</h1>
                    <p style="font-size:2.2rem; color:var(--primary); margin:1rem 0;">₦${product.price.toLocaleString()}</p>
                    <p><strong>Category:</strong> ${product.category}</p>
                    <p style="margin:1.5rem 0; line-height:1.8;">High-quality fresh ${product.name.toLowerCase()}. Perfect for your kitchen needs.</p>
                    
                    <button onclick='addToCart(${JSON.stringify(product)})' class="cta-button" style="width:100%; padding:1.2rem; font-size:1.1rem;">Add to Cart</button>
                    <button onclick="history.back()" style="width:100%; margin-top:1rem; padding:1rem; background:#eee; border:none; border-radius:50px; cursor:pointer;">← Back to Products</button>
                </div>
            `;
        }

        document.addEventListener('DOMContentLoaded', loadProductDetails);
    </script>
</body>
</html>