// Sample products data
const products = [
    {
        id: 21,
        name: "Water Tanker 4000 L ",
        description: "Premium quality water Tanker  with 4000L capacity",
        price: 299,
        image: "img/tractor-tanker3.jpg"
    },
    {
        id: 22,
        name: "Water Tanker 6000L ",
        description: "Advanced  purified water with RO technology with 6000 L ",
        price: 699,
        image: "img/tanker1.jpeg"
    },
    {
        id: 23,
        name: "Water Tanker 5000 L",
        description: "Advanced  purified water With Ro Technology  ",
        price: 499,
        image: "img/watersupplytanker.jpg"
    },
    {
        id: 24,
        name: "Water Tanker with 5000 L ",
        description: " 5000 L Capacity best Water Tanker .......",
        price: 599,
        image: "img/tractor-water-tanker-2.webp"
    },
    {
        id: 25,
        name: "Water Tanker  - 10000L",
        description: "Premium quality water Tanker  with 10000L capacity",
        price: 999,
        image: "img/tanker2.jpeg"
    },
    {
        id: 26,
        name: "Water Tanker with 300 L ",
        description: "Advanced  purified water with RO technology",
        price: 249,
        image: "img/watersupplytanker1.webp"
    },
    {
        id: 27,
        name: "Water Tanker with 5000L",
        description: "Comes with 5000L Capcity with Ro Technology Based ",
        price: 699,
        image: "img/Tractor-Water.jpg"
    },
    {
        id: 28,
        name: "Water Tanker 10000 L",
        description: "Best For  HomesConstructions sides .......... ",
        price: 999,
        image: "img/water-tanker2.webp"
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