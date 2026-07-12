let cart = JSON.parse(localStorage.getItem('cart')) || [];

function updateCartCount() {
    const countEl = document.getElementById('cart-count');
    if (countEl) {
        countEl.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
    }
}

function addToCart(product) {
    const existing = cart.find(item => item.id === product.id);
    if (existing) {
        existing.quantity += 1;
    } else {
        cart.push({...product, quantity: 1});
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();

    const toast = document.createElement('div');
    toast.style.cssText = 'position:fixed;bottom:20px;right:20px;background:#27ae60;color:white;padding:15px 25px;border-radius:50px;z-index:10000;';
    toast.textContent = `${product.name} added to cart!`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 2500);
}

function submitComment() {
    const status = document.getElementById('comment-status');
    if (status) {
        status.style.color = 'green';
        status.textContent = '✅ Instruction received successfully!';
        setTimeout(() => document.getElementById('comment').value = '', 1500);
    }
}

document.addEventListener('DOMContentLoaded', updateCartCount);