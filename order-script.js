// Global variables to store order data
const orderData = {
    customer: {
      firstName: "",
      lastName: "",
      email: "",
      phone: "",
    },
    shipping: {
      street: "",
      city: "",
      pin: "",
      state: "",
      country: "",
    },
    deliveryMethod: "standard",
    paymentMethod: "cod",
    items: [
      {
<<<<<<< Updated upstream
        name: "Acus bottle",
        price: 179,
        quantity: 1,
        image:"img\acua-bottle1l.jpg",
=======
        name: "Aerodynamic linen bag",
        price: 179,
        quantity: 1,
        image:
          "https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-04-22%20093143-qbUvAMm5hd946CY1bRiCAeqmdsj9AF.png",
>>>>>>> Stashed changes
      },
    ],
    shippingCost: 0,
    subtotal: 179,
    total: 179,
    orderId: "",
  }
  
  // Initialize the checkout page
  document.addEventListener("DOMContentLoaded", () => {
    // Show the first section by default
    document.getElementById("basic-details-content").style.display = "block"
  
    // Update the order summary
    updateOrderSummary()
  })
  
  // Toggle section visibility
  function toggleSection(sectionId) {
    const section = document.getElementById(sectionId)
    if (section.style.display === "none") {
      section.style.display = "block"
    } else {
      section.style.display = "none"
    }
  
    // Update the toggle icon
    const header = section.previousElementSibling
    const icon = header.querySelector(".toggle-icon")
    icon.textContent = section.style.display === "none" ? "▼" : "▲"
  }
  
  // Navigate to a specific step
  function goToStep(step) {
    // Validate current step before proceeding
    if (step === 2 && !validateBasicDetails()) {
      return
    } else if (step === 3 && !validateShipping()) {
      return
    }
  
    // Update the active step in the progress bar
    document.querySelectorAll(".step").forEach((el) => {
      el.classList.remove("active")
    })
    document.querySelector(`.step[data-step="${step}"]`).classList.add("active")
  
    // Hide all sections
    const sections = ["basic-details-content", "shipping-content", "method-content", "payment-content"]
    sections.forEach((section) => {
      document.getElementById(section).style.display = "none"
    })
  
    // Show the current section
    let currentSection
    switch (step) {
      case 1:
        currentSection = "basic-details-content"
        break
      case 2:
        currentSection = "shipping-content"
        break
      case 3:
        currentSection = "method-content"
        break
      case 4:
        currentSection = "payment-content"
        break
    }
  
    document.getElementById(currentSection).style.display = "block"
  
    // Update the toggle icons
    sections.forEach((section) => {
      const header = document.getElementById(section).previousElementSibling
      const icon = header.querySelector(".toggle-icon")
      icon.textContent = section === currentSection ? "▲" : "▼"
    })
  
    // Save data from previous step
    if (step === 2) {
      saveBasicDetails()
    } else if (step === 3) {
      saveShipping()
    } else if (step === 4) {
      saveDeliveryMethod()
    }
  }
  
  // Validate basic details
  function validateBasicDetails() {
    const firstName = document.getElementById("first-name").value
    const lastName = document.getElementById("last-name").value
    const email = document.getElementById("email").value
    const phone = document.getElementById("phone").value
  
    if (!firstName || !lastName || !email || !phone) {
      alert("Please fill in all required fields")
      return false
    }
  
    // Simple email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address")
      return false
    }
  
    return true
  }
  
  // Save basic details
  function saveBasicDetails() {
    orderData.customer.firstName = document.getElementById("first-name").value
    orderData.customer.lastName = document.getElementById("last-name").value
    orderData.customer.email = document.getElementById("email").value
    orderData.customer.phone = document.getElementById("phone").value
  
    // Include country code with phone
    const countryCode = document.getElementById("country-code").value
    orderData.customer.fullPhone = `${countryCode} ${orderData.customer.phone}`
  }
  
  // Validate shipping details
  function validateShipping() {
    const street = document.getElementById("street").value
    const city = document.getElementById("city").value
    const pin = document.getElementById("pin").value
    const state = document.getElementById("state").value
    const country = document.getElementById("country").value
  
    if (!street || !city || !pin || !state || !country) {
      alert("Please fill in all required shipping fields")
      return false
    }
  
    return true
  }
  
  // Save shipping details
  function saveShipping() {
    orderData.shipping.street = document.getElementById("street").value
    orderData.shipping.city = document.getElementById("city").value
    orderData.shipping.pin = document.getElementById("pin").value
    orderData.shipping.state = document.getElementById("state").value
    orderData.shipping.country = document.getElementById("country").value
  }
  
  // Save delivery method
  function saveDeliveryMethod() {
    const deliveryMethods = document.getElementsByName("delivery-method")
    for (const method of deliveryMethods) {
      if (method.checked) {
        orderData.deliveryMethod = method.value
        break
      }
    }
  
    // Update shipping cost based on delivery method
    if (orderData.deliveryMethod === "express") {
<<<<<<< Updated upstream
      orderData.shippingCost = 40
=======
      orderData.shippingCost = 10
>>>>>>> Stashed changes
    } else {
      orderData.shippingCost = 0
    }
  
    // Update order summary
    updateOrderSummary()
  }
  
  // Update quantity
  function updateQuantity(action) {
    const quantityInput = document.getElementById("quantity")
    let quantity = Number.parseInt(quantityInput.value)
  
    if (action === "increase") {
      quantity++
    } else if (action === "decrease" && quantity > 1) {
      quantity--
    }
  
    quantityInput.value = quantity
    orderData.items[0].quantity = quantity
  
    // Update order summary
    updateOrderSummary()
  }
  
  // Update order summary
  function updateOrderSummary() {
    // Calculate subtotal based on item quantity
    const itemPrice = orderData.items[0].price
    const quantity = orderData.items[0].quantity
<<<<<<< Updated upstream
    const subtotal = CartTotal
=======
    const subtotal = itemPrice * quantity
>>>>>>> Stashed changes
  
    // Update order data
    orderData.subtotal = subtotal
    orderData.total = subtotal + orderData.shippingCost
  
    // Update UI
    document.getElementById("shipping-cost").textContent = `$${orderData.shippingCost}`
    document.getElementById("sub-total").textContent = `$${orderData.total}`
  }
  
  // Place order
  function placeOrder() {
    // Save payment method
    const paymentMethods = document.getElementsByName("payment-method")
    for (const method of paymentMethods) {
      if (method.checked) {
        orderData.paymentMethod = method.value
        break
      }
    }
  
    // Generate random order ID
    orderData.orderId = "ORD-" + Math.floor(100000 + Math.random() * 900000)
  
    // Save order data to localStorage for retrieval on other pages
    localStorage.setItem("orderData", JSON.stringify(orderData))
  
    // Redirect to order success page
    window.location.href = "order-success.html"
  }
<<<<<<< Updated upstream




  
  function renderOrderSummary() {
    const app = document.getElementById('app');

    if (!app) return;

    if (cart.length === 0) {
        app.innerHTML = `<h2>Your order summary is empty!</h2>`;
        return;
    }

    let total = 0;
    let summaryHTML = `
        <div class="order-summary">
            <h2>ORDER DETAILS</h2>
    `;

    cart.forEach(item => {
        total += item.price * item.quantity;
        summaryHTML += `
            <div class="product-item">
                <div class="product-image">
                    <img src="${item.image}" alt="${item.name}" id="product-image">
                </div>
                <div class="product-details">
                    <div class="product-name">${item.name}</div>
                    <div class="product-quantity">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                        <input type="text" value="${item.quantity}" readonly>
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                    </div>
                </div>
            </div>
        `;
    });

    summaryHTML += `
            <div class="coupon-section">
                <div class="coupon-input">
                    <span class="coupon-icon">🔵</span>
                    <input type="text" placeholder="Apply coupon code" id="coupon-code">
                </div>
            </div>
            <div class="price-summary">
                <div class="price-row">
                    <span>Shipping</span>
                    <span id="shipping-cost">₹0</span>
                </div>
                <div class="price-row total">
                    <span>Sub-total</span>
                    <span id="sub-total">₹${formatPrice(cartTotal)}</span>
                </div>
            </div>
        </div>
    `;

    app.innerHTML = summaryHTML;
}

=======
>>>>>>> Stashed changes
  