// Cart functionality
document.addEventListener("DOMContentLoaded", function () {
    // Load cart from localStorage
    let cart = JSON.parse(localStorage.getItem("cart")) || {};

    // Update cart badge count
    function updateCartBadge() {
        const cartCountElement = document.querySelector(".cart-count");
        if (cartCountElement) {
            const totalItems = Object.values(cart).reduce((sum, qty) => sum + qty, 0);
            cartCountElement.textContent = totalItems;
        }
    }

    // Add item to cart
    function addToCart(productId) {
        if (cart[productId]) {
            cart[productId] += 1; // Increment quantity if product already exists
        } else {
            cart[productId] = 1; // Add new product with quantity 1
        }
        localStorage.setItem("cart", JSON.stringify(cart)); // Save cart to localStorage
        updateCartBadge(); // Update cart badge count
        alert("Product added to cart!");
    }

    // Remove item from cart
    function removeFromCart(productId) {
        delete cart[productId]; // Remove the product
        localStorage.setItem("cart", JSON.stringify(cart)); // Save updated cart
        location.reload(); // Reload the page to reflect changes
    }

    // Update cart display
    function renderCart() {
        const cartContainer = document.getElementById("cart-items");
        const cartTotalElement = document.getElementById("cart-total");
        if (!cartContainer || !cartTotalElement) return;

        // Clear previous content
        cartContainer.innerHTML = "";

        let total = 0;

        // Fetch products from the backend (simulated here)
        const products = {
            1: { id: 1, name: "PulseTrack Pro X7", price: 249.99, image: "/api/placeholder/300/250" },
            2: { id: 2, name: "FlexForce Adjustable Dumbbells", price: 179.99, image: "/api/placeholder/300/250" },
            3: { id: 3, name: "UltraFlex Compression Tights", price: 59.99, image: "/api/placeholder/300/250" },
        };

        // Render each cart item
        for (const productId in cart) {
            const product = products[productId];
            if (!product) continue;

            const quantity = cart[productId];
            const subtotal = product.price * quantity;
            total += subtotal;

            const cartItem = document.createElement("div");
            cartItem.classList.add("cart-item");

            cartItem.innerHTML = `
                <img src="${product.image}" alt="${product.name}" class="cart-item-image">
                <div class="cart-item-info">
                    <h4>${product.name}</h4>
                    <p>$${product.price.toFixed(2)}</p>
                    <div class="cart-item-quantity">
                        <button class="btn btn-small" onclick="updateCartItem(${productId}, -1)">-</button>
                        <span>${quantity}</span>
                        <button class="btn btn-small" onclick="updateCartItem(${productId}, 1)">+</button>
                    </div>
                </div>
                <div class="cart-item-actions">
                    <p class="subtotal">$${subtotal.toFixed(2)}</p>
                    <button class="btn btn-danger" onclick="removeFromCart(${productId})">Remove</button>
                </div>
            `;

            cartContainer.appendChild(cartItem);
        }

        // Update total price
        cartTotalElement.textContent = `$${total.toFixed(2)}`;
    }

    // Update cart item quantity
    window.updateCartItem = function (productId, change) {
        if (cart[productId]) {
            cart[productId] += change;
            if (cart[productId] <= 0) {
                delete cart[productId]; // Remove item if quantity is 0 or less
            }
            localStorage.setItem("cart", JSON.stringify(cart)); // Save updated cart
            renderCart(); // Re-render cart
            updateCartBadge(); // Update cart badge count
        }
    };

    // Attach event listeners to "Add to Cart" buttons
    document.querySelectorAll(".btn-primary").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            const productId = this.getAttribute("data-product-id");
            addToCart(productId);
        });
    });

    // Initialize cart
    updateCartBadge();
    renderCart();
});