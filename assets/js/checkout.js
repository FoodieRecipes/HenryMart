// Cart Rendering Logic
function renderCart() {
    const container = document.getElementById('cart-items');
    let total = 0;
    container.innerHTML = '';

    if (cart.length === 0) {
        container.innerHTML = `
            <p style="text-align:center; padding:4rem; font-size:1.2rem;">
                Your cart is empty.<br>
                <a href="products.html" style="color:var(--primary);">Start Shopping →</a>
            </p>`;
        document.getElementById('cart-total').textContent = 'Total: ₦0';
        return;
    }

    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;

        const itemHTML = `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-details">
                    <h3>${item.name}</h3>
                    <p>₦${item.price.toLocaleString()} × ${item.quantity}</p>
                    <div class="quantity-controls">
                        <button onclick="changeQuantity(${index}, -1)">−</button>
                        <span style="font-weight:bold;">${item.quantity}</span>
                        <button onclick="changeQuantity(${index}, 1)">+</button>
                    </div>
                </div>
                <div style="text-align:right; min-width:140px;">
                    <strong>₦${itemTotal.toLocaleString()}</strong><br><br>
                    <button onclick="removeFromCart(${index})" style="color:#e74c3c; background:none; border:none; cursor:pointer;">Remove</button>
                </div>
            </div>
        `;
        container.innerHTML += itemHTML;
    });

    document.getElementById('cart-total').textContent = `Total: ₦${total.toLocaleString()}`;
}

// Change quantity
function changeQuantity(index, change) {
    cart[index].quantity += change;
    if (cart[index].quantity < 1) cart[index].quantity = 1;
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
    updateCartCount();
}

// Remove item
function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCart();
    updateCartCount();
}

// Load cart when page opens
document.addEventListener('DOMContentLoaded', () => {
    renderCart();
    updateCartCount();
});
