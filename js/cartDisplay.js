// Function to format the price with thousands separator
// function formatCurrency(amount) {
//   return amount.toLocaleString("id-ID"); // Format the number with Indonesian locale
// }

// // Function to calculate and update the total amount
// function updateTotalAmount() {
//   const cart = JSON.parse(localStorage.getItem("cart")) || [];
//   let totalAmount = 0;

//   cart.forEach((item) => {
//     totalAmount += item.price * item.quantity;
//   });

//   document.getElementById("totalAmount").innerText = `Rp ${formatCurrency(
//     totalAmount
//   )}`;
// }

// // Function to render cart items on the cart page with proper styling
// function renderCart() {
//   const cart = JSON.parse(localStorage.getItem("cart")) || [];
//   const cartItems = document.getElementById("cartItems");
//   const emptyCart = document.getElementById("emptyCart");
//   const shippingEstimate = document.getElementById("shippingEstimate"); // Add this line

//   cartItems.innerHTML = ""; // Clear current items

//   if (cart.length === 0) {
//     emptyCart.style.display = "block";
//     if (shippingEstimate) shippingEstimate.style.display = "none"; // Hide estimate
//     updateTotalAmount(); // Update total when cart is empty
//     return;
//   }

//   if (shippingEstimate) shippingEstimate.style.display = "block"; // Show estimate

//   emptyCart.style.display = "none";

//   cart.forEach((item, index) => {
//     const totalItemPrice = item.price * item.quantity;

//     cartItems.innerHTML += `
//       <tr>
//         <td>
//           <div class="product-cell">

//             <div class="product-info">
//               <h3>${item.name}</h3>
//               <p>${item.description || ""}</p>
//             </div>
//           </div>
//         </td>
//         <td class="price">Rp ${formatCurrency(item.price)}</td>
//         <td>
//           <div class="quantity-control">
//             <button class="quantity-btn" onclick="updateQuantity(${index}, ${
//       item.quantity - 1
//     })">-</button>
//             <input type="number" class="quantity-input" value="${
//               item.quantity
//             }" min="1"
//                    onchange="updateQuantity(${index}, this.value)">
//             <button class="quantity-btn" onclick="updateQuantity(${index}, ${
//       item.quantity + 1
//     })">+</button>
//           </div>
//         </td>
//         <td class="price">Rp ${formatCurrency(totalItemPrice)}</td>
//         <td>
//           <button class="remove-btn" onclick="removeFromCart(${index})">
//             <i class="fas fa-trash"></i>
//           </button>
//         </td>
//       </tr>
//     `;
//   });

//   updateTotalAmount(); // Update the total after rendering items
// }

// // Function to add a new item to the cart
// function addToCart(item) {
//   const cart = JSON.parse(localStorage.getItem("cart")) || [];

//   // Check if item already exists in the cart
//   const existingItemIndex = cart.findIndex(
//     (cartItem) => cartItem.name === item.name
//   );

//   if (existingItemIndex >= 0) {
//     // Update quantity if item exists
//     cart[existingItemIndex].quantity += item.quantity;
//   } else {
//     // Add new item
//     cart.push(item);
//   }

//   localStorage.setItem("cart", JSON.stringify(cart));
//   renderCart();
//   updateCartCount();
// }

// // Function to update item quantity in the cart
// function updateQuantity(index, quantity) {
//   let cart = JSON.parse(localStorage.getItem("cart"));
//   if (quantity > 0) {
//     cart[index].quantity = parseInt(quantity);
//     localStorage.setItem("cart", JSON.stringify(cart));
//     renderCart(); // This will call updateTotalAmount
//     updateCartCount();
//   }
// }

// // Function to remove an item from the cart
// function removeFromCart(index) {
//   let cart = JSON.parse(localStorage.getItem("cart"));
//   cart.splice(index, 1);
//   localStorage.setItem("cart", JSON.stringify(cart));
//   renderCart();
//   updateCartCount();
//   updateTotalAmount(); // Explicitly update total
// }

// // Function to clear the entire cart
// function clearCart() {
//   localStorage.removeItem("cart");
//   renderCart();
//   updateCartCount();
//   updateTotalAmount(); // Explicitly update total
// }

// // Function to display the count of items in the cart
// function updateCartCount() {
//   const cart = JSON.parse(localStorage.getItem("cart")) || [];
//   let count = cart.reduce((total, item) => total + item.quantity, 0);
//   // Update your cart icon count if you have one
//   const cartCountElement = document.getElementById("cart-count");
//   if (cartCountElement) {
//     cartCountElement.innerText = count;
//   }
// }

// // Function to format cart items into a WhatsApp message
// function sendCartToWhatsApp() {
//   const cart = JSON.parse(localStorage.getItem("cart")) || [];
//   if (cart.length === 0) {
//     alert("Keranjang Anda kosong!");
//     return;
//   }

//   let message = "Halo, saya ingin memesan:\n\n";
//   let totalAmount = 0;

//   cart.forEach((item) => {
//     const itemTotal = item.price * item.quantity;
//     totalAmount += itemTotal;
//     message += `*${item.name}*\n`; // Using asterisks for bold in WhatsApp
//     message += `   Jumlah: ${item.quantity}\n`;
//     message += `   Harga: Rp ${formatCurrency(item.price)}/pcs\n`;
//     message += `   Subtotal: Rp ${formatCurrency(itemTotal)}\n\n`;
//   });

//   message += `TOTAL: Rp ${formatCurrency(totalAmount)}\n\n`;
//   message += `Mohon konfirmasi ketersediaan barang dan total pembayaran. Terima kasih!`;

//   // Encode the message for the WhatsApp URL
//   const whatsappMessage = encodeURIComponent(message);
//   const whatsappUrl = `https://wa.me/6281384166485?text=${whatsappMessage}`;

//   // Open WhatsApp
//   window.open(whatsappUrl, "_blank");

//   setTimeout(() => {
//     if (
//       confirm(
//         "Pesanan sudah terkirim via WhatsApp. Kosongkan keranjang sekarang?"
//       )
//     ) {
//       localStorage.removeItem("cart");
//       renderCart();
//     }
//   }, 1000); // Short delay to ensure WhatsApp opens

//   // Optional: Clear the cart after sending
//   // localStorage.removeItem("cart");
//   // renderCart();
// }

// // Initialize cart display on page load
// document.addEventListener("DOMContentLoaded", function () {
//   renderCart();
// });

// Format price with thousands separator
function formatCurrency(amount) {
  return amount.toLocaleString("id-ID");
}

// Calculate and update total amount
function updateTotalAmount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const totalAmount = cart.reduce(
    (sum, item) => sum + item.price * item.quantity,
    0
  );
  document.getElementById("totalAmount").innerText = `Rp ${formatCurrency(
    totalAmount
  )}`;
}

// Render cart items with proper styling
function renderCart() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartItems = document.getElementById("cartItems");
  const emptyCart = document.getElementById("emptyCart");
  const buttonClear = document.getElementById("button-clear");
  const shippingEstimate = document.getElementById("shippingEstimate");
  const customerFormSection = document.getElementById("customerFormSection");

  cartItems.innerHTML = "";

  // Handle empty cart
  if (cart.length === 0) {
    emptyCart.style.display = "block";
    if (shippingEstimate) shippingEstimate.style.display = "none";
    if (buttonClear) buttonClear.style.display = "none";
    if (customerFormSection) customerFormSection.style.display = "none";
    updateTotalAmount();
    return;
  }

  emptyCart.style.display = "none";
  if (buttonClear) buttonClear.style.display = "block";
  if (shippingEstimate) shippingEstimate.style.display = "block";
  if (customerFormSection) customerFormSection.style.display = "block";

  console.log(customerFormSection);
  // Render each cart item
  cart.forEach((item, index) => {
    const totalItemPrice = item.price * item.quantity;
    cartItems.innerHTML += `
      <tr>
        <td>
          <div class="product-cell">
            <div class="product-info">
              <h3>${item.name}</h3>
              <p>${item.description || ""}</p>
            </div>
          </div>
        </td>
        <td class="price">Rp ${formatCurrency(item.price)}</td>
        <td>
          <div class="quantity-control">
            <button class="quantity-btn" onclick="updateQuantity(${index}, ${
      item.quantity - 1
    })">-</button>
            <input type="number" class="quantity-input" value="${
              item.quantity
            }" min="1" 
                   onchange="updateQuantity(${index}, this.value)">
            <button class="quantity-btn" onclick="updateQuantity(${index}, ${
      item.quantity + 1
    })">+</button>
          </div>
        </td>
        <td class="price">Rp ${formatCurrency(totalItemPrice)}</td>
        <td>
          <button class="remove-btn" onclick="removeFromCart(${index})">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    `;
  });

  updateTotalAmount();
}

// Add item to cart
function addToCart(item) {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const existingItemIndex = cart.findIndex(
    (cartItem) => cartItem.name === item.name
  );

  if (existingItemIndex >= 0) {
    cart[existingItemIndex].quantity += item.quantity;
  } else {
    cart.push(item);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
  updateCartCount();
}

// Update item quantity
function updateQuantity(index, quantity) {
  const cart = JSON.parse(localStorage.getItem("cart"));
  if (quantity > 0) {
    cart[index].quantity = parseInt(quantity);
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCart();
    updateCartCount();
  }
}

// Remove item from cart
function removeFromCart(index) {
  const cart = JSON.parse(localStorage.getItem("cart"));
  cart.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart();
  updateCartCount();
}

// Clear entire cart
function clearCart() {
  if (confirm("Yakin ingin mengosongkan keranjang belanja?")) {
    localStorage.removeItem("cart");
    renderCart();
    updateCartCount();
  }
}

// Update cart count indicator
function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const count = cart.reduce((total, item) => total + item.quantity, 0);
  const cartCountElement = document.getElementById("cart-count");
  if (cartCountElement) cartCountElement.innerText = count;
}

// Validate and send to WhatsApp
function validateAndSendToWhatsApp() {
  const customerName = document.getElementById("customerName").value.trim();
  const customerPhone = document.getElementById("customerPhone").value.trim();
  const customerAddress = document
    .getElementById("customerAddress")
    .value.trim();

  if (!customerName || !customerPhone || !customerAddress) {
    alert(
      "Harap lengkapi semua informasi yang diperlukan (Nama, Nomor Telefon, dan Alamat)"
    );
    return;
  }

  // Validate phone number
  const phoneRegex = /^[0-9]{10,15}$/;
  if (!phoneRegex.test(customerPhone)) {
    alert(
      "Nomor Telefon tidak valid. Harap masukkan nomor yang benar (10-15 digit angka)"
    );
    return;
  }

  sendCartToWhatsApp(customerName, customerPhone, customerAddress);
}

// Send cart to WhatsApp with customer info
function sendCartToWhatsApp(name, phone, address) {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  if (cart.length === 0) {
    alert("Keranjang kamu kosong!");
    return;
  }

  const notes = document.getElementById("customerNotes").value.trim();

  // Format WhatsApp message
  let message = `Halo, saya *${name}* ingin memesan:\n\n`;
  let totalAmount = 0;

  // Add cart items
  message += ` *Daftar Pesanan:*\n`;
  cart.forEach((item) => {
    const itemTotal = item.price * item.quantity;
    totalAmount += itemTotal;
    message += `\n *${item.name}*\n`;
    message += `    Jumlah: ${item.quantity}\n`;
    message += `    Harga: Rp ${formatCurrency(item.price)}/pcs\n`;
    message += `   Subtotal: Rp ${formatCurrency(itemTotal)}\n`;
  });

  // Add summary
  message += `\n *Total Pesanan: Rp ${formatCurrency(totalAmount)}*\n\n`;

  // Add customer info
  message += `*Informasi Pelanggan:*\n`;
  message += `   Nama: ${name}\n`;
  message += `   No Telepon: ${phone}\n`;
  message += `    Alamat: ${address}\n`;
  if (notes) {
    message += `    Catatan: ${notes}\n`;
  }

  message += `\nMohon konfirmasi ketersediaan barang dan total pembayaran. Terima kasih!`;

  // Create WhatsApp URL
  const whatsappUrl = `https://wa.me/6281384166485?text=${encodeURIComponent(
    message
  )}`;

  // Store pending order
  const orderId = Date.now();
  localStorage.setItem(
    "pendingOrder",
    JSON.stringify({
      id: orderId,
      cart: [...cart],
      customerInfo: { name, phone, address, notes },
      timestamp: new Date().toISOString(),
    })
  );

  // Open WhatsApp
  window.open(whatsappUrl, "_blank");

  // Setup confirmation flow
  setupOrderConfirmation(orderId);
}

// Handle order confirmation logic
function setupOrderConfirmation(orderId) {
  // Check if order was completed on return to site
  window.addEventListener("focus", function onFocus() {
    setTimeout(() => {
      checkOrderCompletion(orderId);
      window.removeEventListener("focus", onFocus);
    }, 500);
  });

  // Periodic check (every 2 minutes)
  const checkInterval = setInterval(() => {
    checkOrderCompletion(orderId, () => clearInterval(checkInterval));
  }, 120000);

  // Final check after 30 minutes
  setTimeout(() => {
    clearInterval(checkInterval);
    checkOrderCompletion(orderId);
  }, 1800000);
}

function checkOrderCompletion(orderId, callback) {
  const pendingOrder = JSON.parse(localStorage.getItem("pendingOrder"));
  if (!pendingOrder || pendingOrder.id !== orderId) {
    if (callback) callback();
    return;
  }

  if (confirm("Kosongkan keranjang belanja?")) {
    localStorage.removeItem("pendingOrder");
    localStorage.removeItem("cart");
    renderCart();
  }
  if (callback) callback();
}

// Initialize cart on page load
document.addEventListener("DOMContentLoaded", function () {
  // Check for pending orders
  const pendingOrder = JSON.parse(localStorage.getItem("pendingOrder"));
  if (pendingOrder) {
    if (confirm("Anda memiliki pesanan yang belum selesai. Lanjutkan?")) {
      localStorage.setItem("cart", JSON.stringify(pendingOrder.cart));
      // Pre-fill form if exists
      if (pendingOrder.customerInfo) {
        document.getElementById("customerName").value =
          pendingOrder.customerInfo.name || "";
        document.getElementById("customerPhone").value =
          pendingOrder.customerInfo.phone || "";
        document.getElementById("customerAddress").value =
          pendingOrder.customerInfo.address || "";
        document.getElementById("customerNotes").value =
          pendingOrder.customerInfo.notes || "";
      }
    }
    localStorage.removeItem("pendingOrder");
  }

  renderCart();
});
