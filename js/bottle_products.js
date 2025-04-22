// Sample products data
const products = [
    {
        id: 1,
        name: "Water Bottle - 1L 3x Combo",
        description: "Premium quality water bottle with 1L capacity",
        price: 49,
        image: "img/bottle3.jpeg"
    },
    {
        id: 2,
        name: "Water Bottle - 1L 5x Combo",
        description: "Premium copper water bottle ...........",
        price: 99,
        image: "img/bottle5.jpeg"
    },
    {
        id: 3,
        name: "Water Filter 20l",
        description: "5 L Bisleri Water Bottle........................",
        price: 170,
        image: "img/10litter.jpeg"
    },
    {
        id: 4,
        name:  "Water Filter 5l X2",
        description: "Ayurvedic copper water bottle for health benefits",
        price: 65,
        image: "img/bottle-sum.jpeg"
    },
    {
        id: 5,
        name: "Water Bottle - 1L X5",
        description: "Premium quality water bottle with 1L capacity",
        price: 79,
        image: "img/acua-bottle1l.jpg"
    },
    {
        id: 6,
        name: "Tata Water Plus 1l X5",
        description: "With Copper Based........................ ........................",
        price: 99,
        image: "img/bottle1.jpg"
    },
    {
        id: 7,
        name: "Bisleri 500ml X10",
        description: "Bisleri Small bottle ........................ ........................",
        price: 80,
        image: "img/bisleri-bottle500.jpeg"
    },
    {
        id: 8,
        name: "Aqua Water Bottle 500ml X5",
        description: "Ayurvedic copper water bottle for health benefits",
        price: 35,
        image: "img/acua-bottle2.jpeg"
    }
];

// Function to format price in Indian Rupees
function formatPrice(price) {
    return '₹' + price.toFixed(2);
}

// Function to render products on the page
function renderProducts() {
    const productsGrid = document.getElementById('productsGrid');
    if (!productsGrid) return;

    let productsHTML = '';

    products.forEach(product => {
        productsHTML += `
            <div class="product-card">
                <div class="product-image">
                    <img src="${product.image}" alt="${product.name}" onerror="this.src='images/placeholder.jpg'">
                </div>
                <div class="product-content">
                    <h3 class="product-title">${product.name}</h3>
                    <p class="product-description">${product.description}</p>
                    <p class="product-price">${formatPrice(product.price)}</p>
                </div>
                <div class="product-footer">
                    <button class="btn btn-primary add-to-cart-btn" data-id="${product.id}" style="width: 100%;">
                        Add to Cart
                    </button>
                </div>
            </div>
        `;
    });

    productsGrid.innerHTML = productsHTML;

    // Add event listeners to "Add to Cart" buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = parseInt(this.getAttribute('data-id'));
            const product = products.find(p => p.id === productId);
            
            if (product) {
                addToCart(product);
            }
        });
    });
}

// Initialize products when DOM is loaded
document.addEventListener('DOMContentLoaded', renderProducts);