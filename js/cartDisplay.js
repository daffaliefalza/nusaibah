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
  const buttonWhatsapp = document.getElementById("button-whatsapp");
  const shippingEstimate = document.getElementById("shippingEstimate");
  const customerFormSection = document.getElementById("customerFormSection");

  cartItems.innerHTML = "";

  // Handle empty cart
  if (cart.length === 0) {
    emptyCart.style.display = "block";
    if (shippingEstimate) shippingEstimate.style.display = "none";
    if (buttonClear) buttonClear.style.display = "none";
    if (buttonWhatsapp) buttonWhatsapp.style.display = "none";
    if (customerFormSection) customerFormSection.style.display = "none";
    updateTotalAmount();
    return;
  }

  emptyCart.style.display = "none";
  if (buttonClear) buttonClear.style.display = "block";
  if (buttonWhatsapp) buttonClear.style.display = "block";
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

// Show copy modal with WhatsApp message
function showCopyModal(message) {
  const modal = document.getElementById("copyModal");
  const messageContent = document.getElementById("whatsappMessageContent");

  messageContent.textContent = message;
  modal.style.display = "flex";

  // Store message in global variable for copying
  window.currentWhatsAppMessage = message;
}

// Close copy modal
function closeCopyModal() {
  document.getElementById("copyModal").style.display = "none";
}

// Copy WhatsApp message to clipboard
function copyWhatsAppMessage() {
  const message = window.currentWhatsAppMessage;

  // Try modern clipboard API first
  if (navigator.clipboard) {
    navigator.clipboard
      .writeText(message)
      .then(() => {
        // Show success message without closing modal
        const successMsg = document.createElement("div");
        successMsg.textContent = "Pesan telah disalin ke clipboard!";
        successMsg.style.color = "green";
        successMsg.style.marginTop = "10px";
        successMsg.style.textAlign = "center";

        // Remove any existing success message
        const existingMsg = document.querySelector(".copy-success-message");
        if (existingMsg) existingMsg.remove();

        successMsg.className = "copy-success-message";
        document.querySelector(".copy-modal-footer").prepend(successMsg);

        // Remove the message after 3 seconds
        setTimeout(() => {
          successMsg.remove();
        }, 3000);
      })
      .catch(() => fallbackCopyText(message));
  } else {
    fallbackCopyText(message);
  }
}

// Fallback copy method for older browsers
function fallbackCopyText(text) {
  const textarea = document.createElement("textarea");
  textarea.value = text;
  document.body.appendChild(textarea);
  textarea.select();

  try {
    document.execCommand("copy");

    // Show success message without closing modal
    const successMsg = document.createElement("div");
    successMsg.textContent = "Pesan telah disalin!";
    successMsg.style.color = "green";
    successMsg.style.marginTop = "10px";
    successMsg.style.textAlign = "center";

    // Remove any existing success message
    const existingMsg = document.querySelector(".copy-success-message");
    if (existingMsg) existingMsg.remove();

    successMsg.className = "copy-success-message";
    document.querySelector(".copy-modal-footer").prepend(successMsg);

    // Remove the message after 3 seconds
    setTimeout(() => {
      successMsg.remove();
    }, 3000);
  } catch (err) {
    alert("Gagal menyalin pesan, silakan copy manual dari kotak teks.");
  }

  document.body.removeChild(textarea);
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
  const whatsappUrl = `https://wa.me/6282264676214?text=${encodeURIComponent(
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
  const newWindow = window.open(whatsappUrl, "_blank");

  // Show copy modal after a short delay
  setTimeout(() => {
    showCopyModal(message);
  }, 1000);

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

  // if (confirm("Kosongkan keranjang belanja?")) {
  //   localStorage.removeItem("pendingOrder");
  //   localStorage.removeItem("cart");
  // }
  renderCart();
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
