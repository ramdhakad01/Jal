// Sample products data
const camper_products = [
    {
        id: 11,
        name: "Water Camper  - 15L",
        description: "Premium quality water Camper  with 15L capacity",
        price: 40,
        image: "img/camper1.jpeg"
    },
    {
        id: 12,
        name: "Sherya Water camper",
        description: "Advanced water purifier with RO technology",
        price: 35,
        image: "img/camper2.jpeg"
    },
    {
        id: 13,
        name: "Shree ganesh Water Camper 20L",
        description: "Advanced RO technology",
        price: 50,
        image: "img/camper3.jpeg"
    },
    {
        id: 14,
        name: "Nil dhara 2x Combo  20 L",
        description: "Ayurvedic copper water bottle for health benefits",
        price: 50,
        image: "img/2camper1.jpeg"
    },
    {
        id: 15,
        name: "Water Camper 4X 15 L",
        description: "Premium quality water Camper  with 15L capacity",
        price: 189,
        image: "img/4camper.jpg"
    },
    {
        id: 16,
        name: "Water Camper 5x 15 L",
        description: "Advanced water purifier with RO technology",
        price: 199,
        image: "img/5camper.webp"
    },
    {
        id: 17,
        name: "Bisleri Water Camper ",
        description: "Added with menirals and Ro Techonology ",
        price: 49,
        image: "img/20-litre-bisleri-water-camper.webp"
    },
    {
        id: 18,
        name: "Jaldhara",
        description: "Water Camper in 15 L with 2X purify Water ",
        price: 30,
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