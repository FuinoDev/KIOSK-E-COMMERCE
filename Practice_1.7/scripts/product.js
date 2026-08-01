document.addEventListener("DOMContentLoaded", function () {
    const cartPanel = document.getElementById("cart-panel");
    const overlay = document.getElementById("overlay");
    const cartCount = document.querySelector(".cart-count");
    const cartItemsContainer = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");
    const closeCartButton = document.getElementById("close-cart");
    const addToCartButtons = document.querySelectorAll(".product-button");

    let cart = [];

    // Open Cart
    function openCart() {
        cartPanel.classList.add("open");
        overlay.classList.add("active");
    }

    // Close Cart
    function closeCart() {
        cartPanel.classList.remove("open");
        overlay.classList.remove("active");
    }

    // Update Cart Display
    function updateCartDisplay() {
        cartCount.textContent = cart.length;
        cartItemsContainer.innerHTML = ""; // Clear previous items
        let total = 0;

        cart.forEach((item, index) => {
            total += item.price * item.quantity;

            const cartItem = document.createElement("div");
            cartItem.classList.add("cart-item");
            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                <div class="cart-item-details">
                    <h4>${item.name}</h4>
                    <p>Price: ₱${item.price}</p>
                    <div class="cart-item-quantity">
                        <button class="quantity-button" data-index="${index}" data-action="decrease">-</button>
                        <span>${item.quantity}</span>
                        <button class="quantity-button" data-index="${index}" data-action="increase">+</button>
                    </div>
                </div>
                <button class="delete-item" data-index="${index}">&times;</button>
            `;
            cartItemsContainer.appendChild(cartItem);
        });

        cartTotal.textContent = total;

        // Event Listeners for Quantity and Delete
        document.querySelectorAll(".quantity-button").forEach(button =>
            button.addEventListener("click", function () {
                const index = this.dataset.index;
                const action = this.dataset.action;
                if (action === "increase") {
                    cart[index].quantity += 1;
                } else if (action === "decrease" && cart[index].quantity > 1) {
                    cart[index].quantity -= 1;
                }
                updateCartDisplay();
            })
        );
        document.querySelectorAll(".delete-item").forEach(button =>
            button.addEventListener("click", function () {
                const index = this.dataset.index;
                cart.splice(index, 1);
                updateCartDisplay();
            })
        );
    }

    // Add to Cart
    addToCartButtons.forEach(button => {
        button.addEventListener("click", function () {
            const productCard = this.closest(".product-card");
            const name = productCard.querySelector("h4").textContent;
            const price = parseInt(productCard.querySelector("p").textContent.replace("₱", ""), 10);
            const image = productCard.querySelector(".product-image").src;

            const existingProduct = cart.find(item => item.name === name);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({ name, price, image, quantity: 1 });
            }
            updateCartDisplay();
        });
    });

    // Event Listeners
    document.querySelector(".cart-button").addEventListener("click", openCart);
    closeCartButton.addEventListener("click", closeCart);
    overlay.addEventListener("click", closeCart);
});

// Function to save cart to localStorage
function saveCartToStorage() {
    localStorage.setItem('cart', JSON.stringify(cart)); // Save cart array as a JSON string
}

// Update cart display and save to storage
function updateCartDisplay() {
    cartCount.textContent = cart.length;
    cartItemsContainer.innerHTML = "";
    let total = 0;

    cart.forEach((item, index) => {
        total += item.price * item.quantity;
        const cartItem = document.createElement("div");
        cartItem.classList.add("cart-item");
        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}" class="cart-item-image">
            <div class="cart-item-details">
                <h4>${item.name}</h4>
                <p>Price: ₱${item.price}</p>
                <div class="cart-item-quantity">
                    <button class="quantity-button" data-index="${index}" data-action="decrease">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-button" data-index="${index}" data-action="increase">+</button>
                </div>
            </div>
            <button class="delete-item" data-index="${index}">&times;</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    cartTotal.textContent = total;
    saveCartToStorage(); // Save cart to storage
}

// Load cart from localStorage on page load
function loadCartFromStorage() {
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart); // Parse saved cart data
        updateCartDisplay(); // Update display with saved data
    }
}

// Call loadCartFromStorage on page load
document.addEventListener("DOMContentLoaded", function () {
    loadCartFromStorage();
});

