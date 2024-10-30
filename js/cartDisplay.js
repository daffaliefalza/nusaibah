// Function to render cart items on the cart page
function renderCart() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartItems = document.getElementById("cartItems");
  cartItems.innerHTML = ""; // Clear current items

  let totalAmount = 0;

  cart.forEach((item, index) => {
    const totalItemPrice = item.price * item.quantity;
    totalAmount += totalItemPrice;

    cartItems.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>Rp ${item.price}</td>
                <td><input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)"></td>
                <td>Rp ${totalItemPrice}</td>
                <td><button onclick="removeFromCart(${index})">Remove</button></td>
            </tr>
        `;
  });

  document.getElementById("totalAmount").innerText = `Rp ${totalAmount}`;
}

// Function to update item quantity in the cart
function updateQuantity(index, quantity) {
  let cart = JSON.parse(localStorage.getItem("cart"));
  if (quantity > 0) {
    cart[index].quantity = parseInt(quantity);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart(); // Refresh cart display
    updateCartCount(); // Update cart icon
  }
}

// Function to remove item from the cart
function removeFromCart(index) {
  let cart = JSON.parse(localStorage.getItem("cart"));
  cart.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
  updateCartCount();
}

// Function to clear the cart
function clearCart() {
  localStorage.removeItem("cart");
  renderCart();
  updateCartCount();
}

// Initialize cart display on page load
window.onload = renderCart;

// cartDisplay.js
document.addEventListener("DOMContentLoaded", function () {
  const cartItemsContainer = document.getElementById("cart-items");
  const cart = JSON.parse(localStorage.getItem("cart")) || [];

  if (cart.length === 0) {
    cartItemsContainer.innerHTML = "<p>Your cart is empty.</p>";
  } else {
    cart.forEach((item) => {
      const itemDiv = document.createElement("div");
      itemDiv.className = "cart-item";
      itemDiv.innerHTML = `
                <h3>${item.name}</h3>
                <p>Price: Rp ${item.price}</p>
                <p>Quantity: ${item.quantity}</p>
                <p>Total: Rp ${item.price * item.quantity}</p>
            `;
      cartItemsContainer.appendChild(itemDiv);
    });
  }
});
