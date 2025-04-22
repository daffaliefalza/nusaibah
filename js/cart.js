// Function to add a product to the cart
function addToCart(id, name, price) {
  // Get cart data from local storage or create a new array if empty
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // Check if item is already in the cart
  const productIndex = cart.findIndex((item) => item.id === id);

  if (productIndex === -1) {
    // If product is not in the cart, add it
    cart.push({ id, name, price, quantity: 1 });
  } else {
    // If product exists in the cart, show an alert or other UI feedback
    alert(`${name} sudah berada dikeranjang`);
    return; // Exit the function if item already exists
  }

  // Save updated cart to local storage
  localStorage.setItem("cart", JSON.stringify(cart));

  // Update the cart icon counter
  updateCartCount();

  // Show success message
  alert(`${name}  ditambahkan ke keranjang`);
}

// Function to update the cart icon with the number of items
function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const itemCount = cart.reduce((total, item) => total + item.quantity, 0);

  // Update the cart count display
  document.getElementById("cart-count").textContent = itemCount;
}

// Initialize cart count on page load
document.addEventListener("DOMContentLoaded", function () {
  updateCartCount();
});
