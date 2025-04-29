<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Nusaibah menghadirkan jamu dan bumbu masak dari resep warisan keluarga, dibuat dengan bahan alami dan rasa khas tradisional Indonesia." />
  <title>Tentang Kami | Nusaibah</title>
  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/home.css" />
  <link rel="icon" type="image/x-icon" href="/images/logo.jpg">




</head>

<body>
  <!-- nav start -->

  <nav>
    <div class="container">
      <a href="index.php" class="logo">
        <img src="images/logo.jpg" alt="logo" style="width: 80px" />
      </a>
      <ul class="nav-links">
        <li><a href="index.php">Produk</a></li>
        <li><a href="about.php" class="active">Tentang Kami</a></li>
        <li><a href="galeri.php">Galeri</a></li>
        <li><a href="kontak.php">Kontak</a></li>
      </ul>
      <div class="cart">
        <a href="cart.php">
          <img src="images/cart.png" alt="cart" />
          <span id="cart-count">0</span>
        </a>
      </div>
    </div>
  </nav>
  <!-- nav end -->

  <main>
    <div class="container">
      <h1 class="main-title">Who We Are</h1>
      <div class="content-wrapper">
        <div class="image-container">
          <img src="images/logo.jpg" alt="Nusaibah Logo" class="brand-logo">
        </div>
        <div class="text-content">
          <p class="description">
            Kami membawa kembali resep-resep warisan keluarga yang telah dipercaya sejak dulu. Dari jamu segar hingga bumbu masak, setiap produk diracik dengan bahan-bahan alami berkualitas dan sentuhan tradisi. Di balik setiap racikan, ada cerita turun-temurun dan rasa khas yang terus dijaga. Nusaibah hadir untuk menghadirkan pilihan yang lebih sehat dan lezat, tanpa meninggalkan akar budaya Indonesia yang kaya akan rempah dan kearifan lokal.
          </p>
          <blockquote class="tagline">
            - Dari dapur keluarga ke dapur Anda — bumbu dan jamu racikan Nusaibah dibuat dari resep lama dan bahan alami, untuk rasa yang lebih nendang dan manfaat yang nyata.
          </blockquote>
        </div>
      </div>
    </div>
  </main>

  <style>
    main {
      color: #333;
      line-height: 1.6;
      padding: 40px 0;
    }

    .main-title {
      font-size: 2.5rem;
      font-weight: 300;
      color: #2a2a2a;
      text-align: center;
      margin-bottom: 50px;
      letter-spacing: 1px;
      position: relative;
      font-family: "prata", "sans-serif";
    }


    .content-wrapper {
      display: flex;
      gap: 5px;
    }

    .image-container {
      flex: 1;
      min-width: 400px;
    }



    .brand-logo {
      width: 90%;
      height: auto;
      border-radius: 4px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .brand-logo:hover {
      transform: scale(1.02);
    }

    .text-content {
      flex: 1;
    }

    .description {
      font-size: 1.1rem;
      margin-bottom: 30px;
      text-align: justify;
      color: #555;
    }

    .tagline {
      font-style: italic;
      color: #777;
      border-left: 3px solid #c8a97e;
      padding-left: 20px;
      margin: 30px 0 0;
      font-size: 1rem;
    }

    @media (max-width: 768px) {
      .content-wrapper {
        flex-direction: column;
      }

      .image-container {
        min-width: 100%;
        margin-bottom: 30px;
      }

      .main-title {
        font-size: 2rem;
      }
    }
  </style>

  <!-- footer start -->
  <footer>
    &copy; 2024 - Afiat Barokah Mandiri | All rights reserved. Designed By
    <a
      style="text-decoration: underline; color: #fff"
      href="https://webwirausahamuda.com"
      target="_blank">Wimuda</a>
  </footer>


  <!-- footer end -->


  <a
    href="https://wa.me/6281213567170?text=Halo admin, %20saya%20ingin%20bertanya"
    target="_blank">
    <img
      class="whatsapp-redirect"
      src="images/whatsapp.svg"
      alt="WhatsApp icon"
      style="
          width: 65px;
          position: fixed;
          bottom: 2rem;
          right: 2rem;
          cursor: pointer;
          z-index: 50;
        " />
  </a>


  <script src="js/cart.js"></script>

</body>

</html>