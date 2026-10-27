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
    <title>Checkout - HenryMart</title>
    <link rel="stylesheet" href="assets/css/style.css">
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

    <section class="section">
        <h2 style="text-align:center;">Checkout</h2>
        <div style="max-width:600px; margin:0 auto; background:white; padding:3rem; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
            <h3>Order Summary</h3>
            <div id="checkout-summary" style="margin:2rem 0;"></div>
            
            <input type="text" placeholder="Full Name" value="<?= htmlspecialchars($userName); ?>" style="width:100%; padding:15px; margin:10px 0; border-radius:8px; box-sizing:border-box; border:1px solid #ddd;" required>
            <input type="tel" placeholder="Phone Number" style="width:100%; padding:15px; margin:10px 0; border-radius:8px; box-sizing:border-box; border:1px solid #ddd;" required>
            <input type="text" placeholder="Delivery Address" style="width:100%; padding:15px; margin:10px 0; border-radius:8px; box-sizing:border-box; border:1px solid #ddd;" required>
            
            <button onclick="completeOrder()" class="cta-button" style="width:100%; margin-top:2rem;">Place Order (Cash on Delivery)</button>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Store • Henrymart.store</p>
    </footer>

    <script src="assets/js/script.js"></script>
    <script>
        function renderCheckoutSummary() {
            const container = document.getElementById('checkout-summary');
            let total = 0;
            let html = '<ul style="list-style:none; padding:0;">';
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                html += `<li style="padding:8px 0; border-bottom:1px solid #eee;">${item.name} × ${item.quantity} — <strong>₦${itemTotal.toLocaleString()}</strong></li>`;
            });
            html += '</ul><h3 style="margin-top:15px; color:#28a745;">Total: ₦' + total.toLocaleString() + '</h3>';
            container.innerHTML = html;
        }

        function completeOrder() {
            alert("✅ Order placed successfully! Thank you.");
            localStorage.removeItem('cart');
            window.location.href = "index.php";
        }

        document.addEventListener('DOMContentLoaded', renderCheckoutSummary);
    </script>
</body>
</html>
