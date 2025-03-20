// Sample products data
const camper_products = [
    {
        id: 11,
        name: "Water Bottle - 1L",
        description: "Premium quality water bottle with 1L capacity",
        price: 299,
        image: "img/camper1.jpeg"
    },
    {
        id: 12,
        name: "Water Purifier",
        description: "Advanced water purifier with RO technology",
        price: 12999,
        image: "img/camper2.jpeg"
    },
    {
        id: 13,
        name: "Water Filter Cartridge",
        description: "Replacement filter cartridge for water purifiers",
        price: 799,
        image: "img/camper3.jpeg"
    },
    {
        id: 14,
        name: "Copper Water Bottle",
        description: "Ayurvedic copper water bottle for health benefits",
        price: 599,
        image: "img/2camper1.jpeg"
    },
    {
        id: 15,
        name: "Water Bottle - 1L",
        description: "Premium quality water bottle with 1L capacity",
        price: 299,
        image: "img/4camper.jpg"
    },
    {
        id: 16,
        name: "Water Purifier",
        description: "Advanced water purifier with RO technology",
        price: 12999,
        image: "img/5camper.webp"
    },
    {
        id: 17,
        name: "Water Filter Cartridge",
        description: "Replacement filter cartridge for water purifiers",
        price: 799,
        image: "img/20-litre-bisleri-water-camper.webp"
    },
    {
        id: 18,
        name: "Copper Water Bottle",
        description: "Ayurvedic copper water bottle for health benefits",
        price: 599,
        image: "img/camper1.jpeg"
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

    camper_products.forEach(product => {
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
            const product = camper_products.find(p => p.id === productId);
            
            if (product) {
                addToCart(product);
            }
        });
    });
}

// Initialize products when DOM is loaded
document.addEventListener('DOMContentLoaded', renderProducts);