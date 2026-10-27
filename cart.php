<?php
require_once "config/auth.php";
require_once "config/db.php";

$userName = $_SESSION['fullname'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - HenryMart</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">🍔 HenryMart</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart (<span id="cart-count">0</span>)</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="orders.php">My Orders</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php" style="color:#e74c3c; font-weight:bold;">Logout (<?= htmlspecialchars($userName); ?>)</a></li>
            </ul>
        </nav>
    </header>

    <section class="section cart-container">
        <h2>Your Shopping Cart</h2>
        <div id="cart-items"></div>
        <div class="total" id="cart-total">Total: ₦0</div>
        <button onclick="window.location.href='checkout.php'" class="cta-button" style="width:100%; margin-top:2rem;">Proceed to Checkout</button>
    </section>

    <footer>
        <p>&copy; 2026 HenryMart • Henrymart.store</p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script>
        function renderCart() {
            const container = document.getElementById('cart-items');
            let total = 0;
            container.innerHTML = '';

            if (cart.length === 0) {
                container.innerHTML = '<p style="text-align:center; padding:4rem;">Your cart is empty.</p>';
                document.getElementById('cart-total').textContent = 'Total: ₦0';
                return;
            }

            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                container.innerHTML += `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="cart-details">
                            <h3>${item.name}</h3>
                            <p>₦${item.price} × ${item.quantity}</p>
                            <div class="quantity-controls">
                                <button onclick="changeQuantity(${index}, -1)">−</button>
                                <span>${item.quantity}</span>
                                <button onclick="changeQuantity(${index}, 1)">+</button>
                            </div>
                        </div>
                        <div style="text-align:right;">
                            <strong>₦${itemTotal}</strong><br>
                            <button onclick="removeFromCart(${index})" style="color:#e74c3c; cursor:pointer;">Remove</button>
                        </div>
                    </div>`;
            });

            document.getElementById('cart-total').textContent = `Total: ₦${total.toLocaleString()}`;
        }

        function changeQuantity(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity < 1) cart[index].quantity = 1;
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
            updateCartCount();
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
            updateCartCount();
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderCart();
            updateCartCount();
        });
    </script>
</body>
</html>
