// Sample products data
const products = [
    {
        id: 1,
        name: "Water Bottle - 1L",
        description: "Premium quality water bottle with 1L capacity",
        price: 299,
        image: "img/blog-1.jpg"
    },
    {
        id: 2,
        name: "Water Purifier",
        description: "Advanced water purifier with RO technology",
        price: 12999,
        image: "img/blog-2.jpg"
    },
    {
        id: 3,
        name: "Water Filter Cartridge",
        description: "Replacement filter cartridge for water purifiers",
        price: 799,
        image: "img/blog-3.jpg"
    },
    {
        id: 4,
        name: "Copper Water Bottle",
        description: "Ayurvedic copper water bottle for health benefits",
        price: 599,
        image: "img/blog-1.jpg"
    },
    {
        id: 1,
        name: "Water Bottle - 1L",
        description: "Premium quality water bottle with 1L capacity",
        price: 299,
        image: "img/blog-2.jpg"
    },
    {
        id: 2,
        name: "Water Purifier",
        description: "Advanced water purifier with RO technology",
        price: 12999,
        image: "img/blog-3.jpg"
    },
    {
        id: 3,
        name: "Water Filter Cartridge",
        description: "Replacement filter cartridge for water purifiers",
        price: 799,
        image: "img/blog-1.jpg"
    },
    {
        id: 4,
        name: "Copper Water Bottle",
        description: "Ayurvedic copper water bottle for health benefits",
        price: 599,
        image: "img/blog-2.jpg"
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