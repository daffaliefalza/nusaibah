<?php
include 'config.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Nusaibah | Bumbu & Rempah | Herbs & Spices</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    name="description"
    content="Nusaibah adalah produsen bumbu dan rempah terbaik " />

  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/home.css" />

</head>

<style>
  .cart {
    position: relative;
    color: #333;
    font-weight: bold;
  }
</style>

<body>

  <h1>Daftar Produk</h1>
  <div class="produk-list">
    <?php
    $result = $conn->query("SELECT * FROM produk");

    while ($row = $result->fetch_assoc()) {
    ?>
      <div class="produk-card">
        <img src="admin/upload/<?= $row['gambar'] ?>" alt="<?= $row['nama_produk'] ?>">
        <h3><?= $row['nama_produk'] ?></h3>
        <p>Kategori: <?= $row['kategori_produk'] ?></p>
        <p class="harga">Rp <?= number_format($row['harga'], 0, ',', '.') ?></p>
        <p><?= $row['deskripsi'] ?></p>
        <p>Stok: <?= $row['stok'] ?></p>
      </div>
    <?php } ?>
  </div>

  <!-- nav start -->

  <nav style="border: 1px solid red;">
    <div class="container">
      <a href="#" class="logo">
        <img src="images/logo.jpg" alt="logo" style="width: 80px" />
      </a>
      <ul class="nav-links">
        <li><a href="index.html" class="active">Produk</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="kontak.html">Contact</a></li>
      </ul>
      <div class="cart">
        <a href="cart.html">
          <img src="images/cart.png" alt="cart" />
        </a>
      </div>
    </div>
  </nav>

  <!-- nav end -->

  <!-- main section -->

  <main>
    <div class="container">
      <h1>Nusaibah Bumbu & Rempah</h1>
      <p>
        Temukan keotentikan rempah-rempah Nusantara bersama Nusaibah. Setiap
        bumbu kami dipilih dan diolah dengan cermat untuk menghadirkan cita
        rasa tradisional yang memperkaya setiap hidangan. Mulai dari rempah
        utuh yang mendalam hingga bubuk halus siap pakai, setiap produk kami
        menjamin kualitas dan kelezatan dalam setiap taburan.
      </p>

      <!-- <div class="filter-button-wrapper" style="margin: 2rem 0">
          <div class="container">
            <button class="all">All</button>
            <button class="rempah-bubuk">Rempah Bubuk</button>
            <button class="rempah-utuh">Rempah Utuh</button>
            <button class="krupuk">Krupuk</button>
            <button class="herbal-jamu">Herbal & Jamu</button>
            <button class="bumbu-masak">Bumbu Masak</button>
          </div>
        </div> -->

      <div class="products">
        <h2 class="products-title">Rempah Bubuk</h2>
        <div class="product-wrapper">
          <div
            class="product"
            data-id="1"
            data-price="22500"
            data-product="Bawang Putih Bubuk">
            <h2>Bawang Putih Bubuk</h2>
            <p class="harga">Rp 22.500</p>
            <img
              src="images/rempah-bubuk/bawang_putih_bubuk-removebg-preview.png"
              alt="rempah bubuk 1" />
            <a
              href="#"
              class="order"
              onclick="addToCart(1, 'Bawang Putih Bubuk', 22500)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="2"
            data-price="15000"
            data-product="Biji Pala">
            <h2>Biji Pala</h2>
            <p class="harga">Rp 15.000</p>
            <img
              src="images/rempah-bubuk/biji_pala_bubuk-removebg-preview.png"
              alt="rempah bubuk 2" />
            <a
              href="#"
              class="order"
              onclick="addToCart(2, 'Biji Pala', 15000)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="3"
            data-price="15000"
            data-product="Bunga Lawang">
            <h2>Bunga Lawang</h2>
            <p class="harga">Rp 15.000</p>
            <img
              src="images/rempah-bubuk/bunga_lawang_bubuk-removebg-preview.png"
              alt="rempah bubuk 3" />
            <a
              href="#"
              class="order"
              onclick="addToCart(3, 'Bunga Lawang', 15000)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="4"
            data-price="12500"
            data-product="Cengkeh Bubuk">
            <h2>Cengkeh Bubuk</h2>
            <p class="harga">Rp 12.500</p>
            <img
              src="images/rempah-bubuk/cengkeh_bubuk-removebg-preview.png"
              alt="rempah bubuk 4" />
            <a
              href="#"
              class="order"
              onclick="addToCart(4, 'Cengkeh Bubuk', 12500)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="5"
            data-price="15000"
            data-product="Kayu Manis">
            <h2>Kayu Manis</h2>
            <p class="harga">Rp 15.000</p>
            <img
              src="images/rempah-bubuk/kayu_manis_bubuk-removebg-preview.png"
              alt="rempah bubuk 5" />
            <a
              href="#"
              class="order"
              onclick="addToCart(5, 'Kayu Manis', 15000)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="6"
            data-price="20000"
            data-product="Kencur Bubuk">
            <h2>Kencur Bubuk</h2>
            <p class="harga">Rp 20.000</p>
            <img
              src="images/rempah-bubuk/kencur_bubuk-removebg-preview.png"
              alt="rempah bubuk 6" />
            <a
              href="#"
              class="order"
              onclick="addToCart(6, 'Kencur Bubuk', 20000)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="7"
            data-price="11000"
            data-product="Ketumbar Bubuk">
            <h2>Ketumbar Bubuk</h2>
            <p class="harga">Rp 11.000</p>
            <img
              src="images/rempah-bubuk/ketumbar_bubuk-removebg-preview.png"
              alt="rempah bubuk 7" />
            <a
              href="#"
              class="order"
              onclick="addToCart(7, 'Ketumbar Bubuk', 11000)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="8"
            data-price="15000"
            data-product="Kunyit Bubuk">
            <h2>Kunyit Bubuk</h2>
            <p class="harga">Rp 15.000</p>
            <img
              src="images/rempah-bubuk/kunyit_bubuk-removebg-preview.png"
              alt="rempah bubuk 8" />
            <a
              href="#"
              class="order"
              onclick="addToCart(8, 'Kunyit Bubuk', 15000)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="9"
            data-price="20000"
            data-product="Lada Putih Bubuk">
            <h2>Lada Putih Bubuk</h2>
            <p class="harga">Rp 20.000</p>
            <img
              src="images/rempah-bubuk/lada_putih_bubuk-removebg-preview.png"
              alt="rempah bubuk 9" />
            <a
              href="#"
              class="order"
              onclick="addToCart(9, 'Lada Putih Bubuk', 20000)">Masukkan Keranjang</a>
          </div>
          <div
            class="product"
            data-id="10"
            data-price="20000"
            data-product="Lada Hitam Bubuk">
            <h2>Lada Hitam Bubuk</h2>
            <p class="harga">Rp 20.000</p>
            <img
              src="images/rempah-bubuk/lada_hitam_bubuk-removebg-preview.png"
              alt="rempah bubuk 10" />
            <a
              href="#"
              class="order"
              onclick="addToCart(10, 'Lada Hitam Bubuk', 20000)">Masukkan Keranjang</a>
          </div>
        </div>
      </div>

      <!-- rempah utuh -->
      <div class="products"></div>

      <!-- rempah utuh end -->

      <!-- krupuk -->
      <div class="products">
        <h2 class="products-title">Krupuk</h2>
        <div class="product-wrapper"></div>
      </div>
      <!-- krupuk end -->
    </div>
  </main>

  <!-- main section end -->

  <!-- footer start -->
  <footer>
    &copy; 2024 - Afiat Barokah Mandri | All rights reserved. Designed By
    <a
      style="text-decoration: underline; color: #fff"
      href="https://webwirausahamuda.com"
      target="_blank">Wimuda</a>
  </footer>
  <!-- footer end -->

  <script src="js/cart.js"></script>
</body>

</html>