<!DOCTYPE html>
<html lang="en">

<head>
  <title>Keranjang | Nusaibah</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <style>
    :root {
      --primary: #27ae60;
      --primary-dark: #2ecc71;
      --secondary: #f39c12;
      --dark: #2c3e50;
      --light: #ecf0f1;
      --gray: #95a5a6;
      --danger: #e74c3c;
      --border-radius: 8px;
      --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      color: #333;
      line-height: 1.6;
      padding: 0;
      margin: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      /* border: 1px solid red; */
    }

    .cart-header {
      text-align: center;
      margin: 30px 0;
    }

    .cart-header h1 {
      color: var(--dark);
      font-size: 2.2rem;
      margin-bottom: 10px;
    }

    .cart-header p {
      color: var(--gray);
    }

    .cart-container {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      margin-bottom: 40px;
    }

    .cart-items {
      flex: 1;
      min-width: 300px;
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: 25px;
    }

    .cart-summary {
      /* width: 300px; */
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: 25px;
      align-self: flex-start;
    }

    .cart-table {
      width: 100%;
      border-collapse: collapse;
    }

    .cart-table thead th {
      text-align: left;
      padding: 12px 10px;
      border-bottom: 2px solid var(--light);
      color: var(--dark);
      font-weight: 600;
    }

    .cart-table tbody td {
      padding: 20px 10px;
      border-bottom: 1px solid var(--light);
      vertical-align: middle;
    }

    .product-cell {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .product-image {
      width: 80px;
      height: 80px;
      object-fit: contain;
      border-radius: 4px;
      border: 1px solid #eee;
    }

    .product-info h3 {
      margin: 0 0 5px 0;
      font-size: 1rem;
      color: var(--dark);
    }

    .product-info p {
      margin: 0;
      color: var(--gray);
      font-size: 0.9rem;
    }

    .quantity-control {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .quantity-btn {
      width: 30px;
      height: 30px;
      border: 1px solid #ddd;
      background: white;
      border-radius: 4px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
    }

    .quantity-btn:hover {
      background: #f5f5f5;
    }

    .quantity-input {
      width: 50px;
      text-align: center;
      padding: 5px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .remove-btn {
      color: var(--danger);
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1.2rem;
      padding: 5px;
    }

    .remove-btn:hover {
      color: #c0392b;
    }

    .price {
      font-weight: 600;
      color: var(--dark);
    }

    .summary-title {
      font-size: 1.2rem;
      color: var(--dark);
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid var(--light);
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
    }

    .summary-row.total {
      font-weight: 600;
      font-size: 1.1rem;
      margin-top: 20px;
      padding-top: 15px;
      border-top: 1px solid var(--light);
    }

    .checkout-btn {
      width: 100%;
      padding: 15px;
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: var(--border-radius);
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 20px;
      transition: background-color 0.3s;
    }

    .checkout-btn:hover {
      background-color: var(--primary-dark);
    }

    .continue-btn {
      display: inline-block;
      margin-top: 20px;
      color: var(--primary);
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .continue-btn:hover {
      text-decoration: underline;
    }

    .empty-cart {
      text-align: center;
      padding: 50px 0;
    }

    .empty-cart i {
      font-size: 3rem;
      color: var(--gray);
      margin-bottom: 20px;
    }

    .empty-cart h2 {
      color: var(--dark);
      margin-bottom: 15px;
    }

    .empty-cart p {
      color: var(--gray);
      margin-bottom: 25px;
    }

    .action-btns {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .btn {
      padding: 12px 20px;
      border-radius: var(--border-radius);
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-danger {
      background-color: var(--danger);
      color: white;
      border: none;
    }

    .btn-danger:hover {
      background-color: #c0392b;
    }

    .btn-outline {
      background-color: white;
      color: var(--dark);
      border: 1px solid var(--gray);
    }

    .btn-outline:hover {
      background-color: #f5f5f5;
    }

    /* New styles for the form section */

    .customer-form {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: 25px;
      margin-top: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: var(--dark);
    }

    .form-control {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
    }

    .form-note {
      font-size: 0.875rem;
      color: var(--gray);
      margin-top: 5px;
    }

    .form-section {
      background: white;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
      padding: 25px;
      /* width: 70%; */
      margin-top: 30px;
    }

    .asterisk {
      color: red;
    }

    /* Copy Modal Styles */
    .copy-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .copy-modal-content {
      background-color: white;
      padding: 25px;
      border-radius: var(--border-radius);
      width: 90%;
      max-width: 600px;
      max-height: 80vh;
      overflow-y: auto;
    }

    .copy-modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .copy-modal-title {
      font-size: 1.3rem;
      color: var(--dark);
      font-weight: 600;
    }

    .copy-modal-close {
      background: none;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--gray);
    }

    .copy-modal-body {
      margin-bottom: 20px;
    }

    .copy-modal-message {
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: var(--border-radius);
      border: 1px solid #ddd;
      white-space: pre-wrap;
      font-family: monospace;
      overflow-x: auto;
    }

    .copy-modal-footer {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .copy-modal-btn {
      padding: 10px 20px;
      border-radius: var(--border-radius);
      cursor: pointer;
      font-weight: 600;
    }

    .copy-modal-btn-primary {
      background-color: var(--primary);
      color: white;
      border: none;
    }

    .copy-modal-btn-primary:hover {
      background-color: var(--primary-dark);
    }

    .copy-modal-btn-secondary {
      background-color: white;
      color: var(--dark);
      border: 1px solid var(--gray);
    }

    .copy-modal-btn-secondary:hover {
      background-color: #f5f5f5;
    }

    .copy-success-message {
      color: var(--primary);
      margin-top: 10px;
      text-align: center;
      font-weight: 600;
      width: 100%;
      animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @media (max-width: 768px) {
      .form-section {
        width: 100%;
      }
    }

    .form-title {
      font-size: 1.3rem;
      color: var(--dark);
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid var(--light);
    }

    @media (max-width: 768px) {
      .cart-container {
        flex-direction: column;
      }

      .cart-summary {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="cart-header">
      <h1>Checkout Page</h1>
      <p>Review belanjaan kamu sebelum checkout</p>
      <!-- <p>Review and manage your items before checkout</p> -->
    </div>

    <style>
      .checkout-wrapper {
        display: grid;
        grid-template-columns: 2.5fr 1fr;
        /* grid-template-rows: 1fr 1fr; */
        gap: 1rem;
        /* border: 1px solid pink; */
      }


      @media (max-width: 650px) {

        .cart-container {
          grid-column: span 2;

        }


        .form-section {
          grid-row-start: 2;
          grid-column: span 2;
        }

        /* .cart-container {
          grid-column: span 2;
        } */

        .cart-summary {
          width: 400px !important;
        }

      }
    </style>

    <div class="checkout-wrapper">
      <div class="cart-container">
        <div class="cart-items">
          <table class="cart-table">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="cartItems">
              <!-- Cart items will be inserted here by JavaScript -->
            </tbody>
          </table>

          <div id="emptyCart" class="empty-cart" style="display: none;">
            <i class="fas fa-shopping-cart"></i>
            <h2>Keranjang kamu kosong nih!</h2>
            <p>Sepertinya kamu belum menambahkan produk apapun ke keranjang belanja.</p>
            <!-- <p>Looks like you haven't added any items to your cart yet.</p> -->
            <!-- <a href="index.php" class="continue-btn">
            <i class="fas fa-arrow-left"></i> Continue Shopping
          </a> -->
          </div>

          <div class="action-btns">
            <a href="index.php" class="btn btn-outline">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button id="button-clear" onclick="clearCart()" class="btn btn-danger">
              <i class="fas fa-trash"></i> Kosongkan Keranjang
            </button>
          </div>
        </div>

      </div>


      <div class="cart-summary">
        <h3 class="summary-title">Order Summary</h3>
        <!-- <div class="summary-row">
          <span>Subtotal</span>
          <span id="subtotalAmount">Rp 0</span>
        </div> -->
        <!-- <div class="summary-row">
          <span>Shipping</span>
          <span>Free</span>
        </div> -->
        <!-- <div class="summary-row">
          <span>Tax</span>
          <span>Rp 0</span>
        </div> -->
        <div class="summary-row total">
          <span>Total</span>
          <span id="totalAmount">Rp 0</span>
        </div>
        <span id="shippingEstimate" style=" font-size: 0.875rem; color: #888;">
          *Estimasi total, belum termasuk ongkos kirim
        </span>
        <button class="checkout-btn" id="button-whatsapp" onclick="validateAndSendToWhatsApp()">
          <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
        </button>
      </div>

      <!-- Customer Information Form -->
      <div class="form-section" id="customerFormSection" style="display: none;">
        <h3 class="form-title">Informasi Pelanggan</h3>
        <form id="customerForm">
          <div class="form-group">
            <label for="customerName">Nama Lengkap <span class="asterisk">*</span></label>
            <input type="text" id="customerName" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="customerPhone">Nomor Telepon <span class="asterisk">*</span></label>
            <input type="tel" id="customerPhone" class="form-control" required>
            <p class="form-note">Pastikan nomor aktif untuk konfirmasi pesanan</p>
          </div>

          <div class="form-group">
            <label for="customerAddress">Alamat Lengkap <span class="asterisk">*</span></label>
            <textarea id="customerAddress" class="form-control" rows="3" required></textarea>
            <p class="form-note">Sertakan kecamatan dan kode pos</p>
          </div>

          <div class="form-group">
            <label for="customerNotes">Catatan Tambahan (optional)</label>
            <textarea id="customerNotes" class="form-control" rows="2"></textarea>
          </div>

          <!-- <button type="button" class="checkout-btn" onclick="validateAndSendToWhatsApp()">
          <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
        </button> -->
        </form>
      </div>
    </div>
  </div>






  <!-- Copy Modal -->
  <div id="copyModal" class="copy-modal">
    <div class="copy-modal-content">
      <div class="copy-modal-header">
        <h3 class="copy-modal-title">Manual WhatsApp Order</h3>
        <button class="copy-modal-close" onclick="closeCopyModal()">&times;</button>
      </div>
      <div class="copy-modal-body">
        <p>Jika pesan otomatis tidak berfungsi, harap copy teks di bawah dan kirim ulang atau kirim manual ke nomor:</p>
        <p><strong>082264676214</strong></p>
        <div id="whatsappMessageContent" class="copy-modal-message"></div>
      </div>
      <div class="copy-modal-footer">
        <button class="copy-modal-btn copy-modal-btn-secondary" onclick="closeCopyModal()">Tutup</button>
        <button class="copy-modal-btn copy-modal-btn-primary" onclick="copyWhatsAppMessage()">Copy Pesan</button>
      </div>
    </div>
  </div>


  <script src="js/cartDisplay.js"></script>
  <script>
    function proceedToCheckout() {
      // Add your checkout logic here
      alert('Proceeding to checkout!');
    }
  </script>

</body>

</html>