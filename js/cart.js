// Cart functionality
let cart = [];
let isCartOpen = false;

// Load cart from localStorage on page load
function loadCart() {
    const savedCart = localStorage.getItem('jalWalaCart');
    if (savedCart) {
        try {
            cart = JSON.parse(savedCart);
            updateCartCount();
        } catch (error) {
            console.error('Failed to parse cart from localStorage:', error);
            cart = [];
        }
    }
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('jalWalaCart', JSON.stringify(cart));
}

// Add item to cart
function addToCart(product) {
    const existingItemIndex = cart.findIndex(item => item.id === product.id);

    if (existingItemIndex >= 0) {
        cart[existingItemIndex].quantity += 1;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1,
            image: product.image
        });
    }

    saveCart();
    updateCartCount();
    renderCart();
    toggleCart(true);
    showNotification(`${product.name} added to cart!`);
}

// Remove item from cart
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCartCount();
    renderCart();
}

// Update item quantity
function updateQuantity(productId, quantity) {
    const itemIndex = cart.findIndex(item => item.id === productId);

    if (itemIndex >= 0) {
        cart[itemIndex].quantity = quantity;
        if (quantity <= 0) {
            removeFromCart(productId);
            return;
        }
        saveCart();
        renderCart();
    }
}

// Clear cart
function clearCart() {
    cart = [];
    saveCart();
    updateCartCount();
    renderCart();
}

// Calculate cart total
function calculateCartTotal() {
    return cart.reduce((total, item) => total + (item.price * item.quantity), 0);
}

// Update cart count badge
function updateCartCount() {
    const cartCount = document.getElementById('cartCount');
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);

    cartCount.textContent = totalItems;

    if (totalItems > 0) {
        cartCount.style.display = 'flex';
    } else {
        cartCount.style.display = 'none';
    }
}

// Toggle cart dropdown
function toggleCart(forceOpen = null) {
    const cartMenu = document.getElementById('cartMenu');

    if (forceOpen !== null) {
        isCartOpen = forceOpen;
    } else {
        isCartOpen = !isCartOpen;
    }

    if (isCartOpen) {
        cartMenu.style.display = 'block';
        renderCart();
    } else {
        cartMenu.style.display = 'none';
    }
}

// Format price in Indian Rupees
function formatPrice(price) {
    return '₹' + price.toFixed(2);
}

// Render cart contents
function renderCart() {
    const cartMenu = document.getElementById('cartMenu');

    let cartHTML = `
        <div class="cart-header">
            <h3>Shopping Cart (${cart.length})</h3>
            <button class="cart-close" onclick="toggleCart(false)">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    if (cart.length === 0) {
        cartHTML += `
            <div class="cart-empty">
                <p>Your cart is empty</p>
            </div>
        `;
    } else {
        cartHTML += `<div class="cart-items">`;

        cart.forEach(item => {
            cartHTML += `
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="${item.image}" alt="${item.name}" onerror="this.src='images/placeholder.jpg'">
                    </div>
                    <div class="cart-item-details">
                        <h4 class="cart-item-name">${item.name}</h4>
                        <p class="cart-item-price">${formatPrice(item.price)} x ${item.quantity}</p>
                    </div>
                    <div class="cart-item-actions">
                        <p class="cart-item-total">${formatPrice(item.price * item.quantity)}</p>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span class="quantity-value">${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button class="remove-btn" onclick="removeFromCart(${item.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        cartHTML += `</div>`;

        const cartTotal = calculateCartTotal();

        cartHTML += `
            <div class="cart-footer">
                <div class="cart-subtotal">
                    <span>Subtotal:</span>
                    <span class="cart-subtotal-value">${formatPrice(cartTotal)}</span>
                </div>
                <div class="cart-actions">
                   <a href="order.html" onclick="goToCheckout()" class="btn btn-primary" style="width: 100%;">Checkout</a>
                    <button class="btn btn-outline" style="width: 100%;" onclick="clearCart()">Clear Cart</button>
                </div>
            </div>
        `;
    }

    cartMenu.innerHTML = cartHTML;
}

// Show notification
function showNotification(message) {
    let notification = document.getElementById('notification');

    if (!notification) {
        notification = document.createElement('div');
        notification.id = 'notification';
        notification.style.position = 'fixed';
        notification.style.bottom = '20px';
        notification.style.right = '20px';
        notification.style.backgroundColor = '#0070f3';
        notification.style.color = '#fff';
        notification.style.padding = '12px 20px';
        notification.style.borderRadius = '4px';
        notification.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        notification.style.zIndex = '3000';
        notification.style.transition = 'transform 0.3s, opacity 0.3s';
        notification.style.transform = 'translateY(100px)';
        notification.style.opacity = '0';

        document.body.appendChild(notification);
    }

    notification.textContent = message;
    notification.style.transform = 'translateY(0)';
    notification.style.opacity = '1';

    setTimeout(() => {
        notification.style.transform = 'translateY(100px)';
        notification.style.opacity = '0';
    }, 3000);
}

// Initialize cart when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    loadCart();

    const cartButton = document.getElementById('cartButton');
    cartButton.addEventListener('click', function(e) {
        e.preventDefault();
        toggleCart();
    });

    document.addEventListener('click', function(e) {
        const cartMenu = document.getElementById('cartMenu');
        const cartButton = document.getElementById('cartButton');

        if (isCartOpen && !cartMenu.contains(e.target) && e.target !== cartButton && !cartButton.contains(e.target)) {
            toggleCart(false);
        }
    });
});
// cart.js में 590–600 लाइन के बीच add करें

function goToCheckout() {
    const cartTotal = calculateCartTotal();
    if (cartTotal <= 0) {
        alert("Cart खाली है। पहले कुछ आइटम्स जोड़ें।");
        return;
    }
    window.location.href = `checkout.php?total=${cartTotal.toFixed(2)}`;
}

