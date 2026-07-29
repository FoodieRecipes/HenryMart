const products = [
    { 
        id: 1, 
        name: "Fresh Tomatoes", 
        price: 1200, 
        image: "assets/images/tomatoes.jpg",   
        category: "Vegetables" 
    },
    { 
        id: 2, 
        name: "Rice (5kg)", 
        price: 8500, 
        image: "assets/images/rice.jpg",       
        category: "Grains" 
    },
    { 
        id: 3, 
        name: "Whole Chicken", 
        price: 4500, 
        image: "assets/images/chicken.jpg",     
        category: "Meat" 
    },
    { 
        id: 4, 
        name: "Fresh Eggs (Dozen)", 
        price: 1800, 
        image: "assets/images/eggs.jpg",        
        category: "Dairy" 
    },
    { 
        id: 5, 
        name: "Cooking Oil (5L)", 
        price: 6500, 
        image: "assets/images/oil.jpg",         
        category: "Oil" 
    }
];

function renderProducts(containerId, productList) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = '';

    productList.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <img src="${product.image}" alt="${product.name}" onerror="this.src='https://picsum.photos/id/1080/300/300'">
            <div class="product-info">
                <h3>${product.name}</h3>
                <p>${product.category}</p>
                <div class="price">₦${product.price.toLocaleString()}</div>
                <div style="display:flex; gap:10px; margin-top:15px;">
                    <button class="add-to-cart" onclick='addToCart(${JSON.stringify(product)})'>Add to Cart</button>
                    <a href="product.php?id=${product.id}" class="view-details">View Details</a>
                </div>
            </div>
        `;
        container.appendChild(card);
    });
}

// Auto render featured and all products
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('featured-products')) {
        renderProducts('featured-products', products.slice(0, 4));
    }
    if (document.getElementById('all-products')) {
        renderProducts('all-products', products);
    }
});