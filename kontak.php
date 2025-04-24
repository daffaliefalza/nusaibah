<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>

  <link rel="stylesheet" href="css/default.css" />
  <link rel="stylesheet" href="css/home.css" />

  <style></style>
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
        <li><a href="about.php">About</a></li>
        <li><a href="kontak.php" class="active">Contact</a></li>
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

  <style>
    .contact {
      padding-top: 2rem;
    }

    .social-media-wrapper img {
      width: 80px;
    }

    .social-media-wrapper a:first-child img {
      background-color: #25D366;
      border-radius: 50%;
      padding: 14px;
      box-shadow: 0px 0px 11px rgba(0, 0, 0, .5);
    }


    .location-finder {
      font-family: 'Helvetica Neue', Arial, sans-serif;
      max-width: 1000px;
      margin: 0 auto;
      padding: 2rem 1rem;
    }

    .location-finder h2 {
      color: #333;
      font-weight: 500;
      text-align: center;
      margin-bottom: 1rem;
      font-size: 1.8rem;
    }

    .intro-text {
      color: #555;
      text-align: center;
      margin-bottom: 2rem;
      line-height: 1.5;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .location-maps {
      display: grid;
      gap: 2rem;
    }

    .location-card {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .location-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .location-card h3 {
      padding: 1rem 1.5rem;
      background: #f8f8f8;
      color: #444;
      font-weight: 500;
      font-size: 1.1rem;
      margin: 0;
    }

    .location-card iframe {
      width: 100%;
      height: 300px;
      display: block;
      border: none;
    }

    @media (min-width: 768px) {
      .location-maps {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>

  <section class="contact">
    <div class="container">

      <div class="social-media-wrapper">
        <h2 class="social-title">Social Media</h2>
        <div class="social-icons">
          <a href="https://wa.me/6281213567170?text=Halo admin, %20saya%20ingin%20bertanya"
            target="_blank" class="social-icon">
            <img src="images/whatsapp.svg" alt="WhatsApp">
          </a>
          <a href="https://www.instagram.com/nusaibah_herbs_spices/" target="_blank" class="social-icon">
            <img src="images/instagram.svg" alt="Instagram">
          </a>
        </div>
      </div>



      <div class="location-finder">
        <h2>Temukan Kami</h2>
        <p class="intro-text">
          Produk kami tersebar di beberapa supermarket seperti Hypermart Kemang, Kawaraci, dan sebagainya.
        </p>

        <div class="location-maps">
          <div class="location-card">
            <h3>Hypermart Kemang Village</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4115.777121946206!2d106.8102797749907!3d-6.2612789937273226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1097407a2c3%3A0x228bb72cc4f619d6!2sHypermart%20-%20Kemang%20Village!5e1!3m2!1sid!2sid!4v1745444843677!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="location-card">
            <h3>Hypermart Cyberpark Karawaci</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4116.088824154437!2d106.61648877499044!3d-6.221604693766426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fea8f4209bf5%3A0x41ba819c77dcd849!2sHypermart%20-%20Cyberpark%20Karawaci%20LKU!5e1!3m2!1sid!2sid!4v1745445009665!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="location-card">
            <h3>Hypermart Ekalokasari Bogor</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4112.855367215133!2d106.81466987499391!3d-6.621666393372555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5fdfa2adf8f%3A0x80542062a41cc7fc!2sHypermart%20Lippo%20Plaza%20Ekalokasari%20Bogor!5e1!3m2!1sid!2sid!4v1745445110333!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="location-card">
            <h3>Hypermart Taman Yasmin</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4113.381599966561!2d106.76893817499324!3d-6.558213793434922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c586972e82af%3A0x40e0ef72245e5206!2sHypermart%20-%20Taman%20Yasmin!5e1!3m2!1sid!2sid!4v1745445161448!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="location-card">
            <h3>Hyfresh Rempoa</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4115.600371662609!2d106.75822477499086!3d-6.283665393705216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f13074cc0f9d%3A0x8478b5aee25ede9d!2sHyfresh%20-%20Supermarket%20Rempoa!5e1!3m2!1sid!2sid!4v1745445229892!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          <div class="location-card">
            <h3>Happy Harvest Summarecon Bandung</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4110.012579450077!2d107.69608897499683!3d-6.954486693045836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c3b518e5b3f9%3A0x212b94425606a2f6!2sHappy%20Harvest%20Summarecon%20Mall%20Bandung!5e1!3m2!1sid!2sid!4v1745445269820!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

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