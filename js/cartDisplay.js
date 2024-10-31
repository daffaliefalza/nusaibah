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
        <td>
          <input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)" />
        </td>
        <td>Rp ${totalItemPrice}</td>
        <td>
          <button onclick="removeFromCart(${index})">Remove</button>
        </td>
      </tr>
    `;
  });

  document.getElementById("totalAmount").innerText = `Rp ${totalAmount}`;
}

// Function to add a new item to the cart
function addToCart(item) {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];

  // Check if item already exists in the cart
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.name === item.name
  );

  if (existingItemIndex >= 0) {
    // Update quantity if item exists
    cart[existingItemIndex].quantity += item.quantity;
  } else {
    // Add new item
    cart.push(item);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
  updateCartCount();
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

// Function to remove an item from the cart
function removeFromCart(index) {
  let cart = JSON.parse(localStorage.getItem("cart"));
  cart.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
  updateCartCount();
}

// Function to clear the entire cart
function clearCart() {
  localStorage.removeItem("cart");
  renderCart();
  updateCartCount();
}

// Function to display the count of items in the cart (if you have a cart icon)
function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  let count = cart.reduce((total, item) => total + item.quantity, 0);
  // Update your cart icon count if you have one, e.g., document.getElementById('cart-count').innerText = count;
}

// Initialize cart display on page load
document.addEventListener("DOMContentLoaded", function () {
  renderCart();
});
